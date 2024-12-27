<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$proveedores = obtenerProveedores();
$productos = obtenerProductos(); // Asumiendo que tienes una función para obtener productos

if(isset($_POST['registrar'])){
    $tipo_comprobante = $_POST['tipo_comprobante'];
    $nro_comprobante = $_POST['nro_comprobante'];
    $fecha_emision = $_POST['fecha_emision'];
    $proveedor_id = $_POST['proveedor_id'];
    $detalles = $_POST['detalles'];

    if(empty($tipo_comprobante) || empty($nro_comprobante) || empty($fecha_emision) || empty($proveedor_id) || empty($detalles)){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
    } 
    
    $resultado = registrarCompra($tipo_comprobante, $nro_comprobante, $fecha_emision, $proveedor_id, $detalles);
    if($resultado){
        echo'
        <div class="alert alert-success mt-3" role="alert">
            Compra registrada con éxito.
        </div>';
    }
}
?>
<div class="container">
    <h3>Registrar compra</h3>
    <form method="post">
        <div class="mb-3">
            <label for="tipo_comprobante" class="form-label">Tipo de Comprobante</label>
            <input type="text" name="tipo_comprobante" class="form-control" id="tipo_comprobante" placeholder="Escribe el tipo de comprobante">
        </div>
        <div class="mb-3">
            <label for="nro_comprobante" class="form-label">Nro de Comprobante</label>
            <input type="text" name="nro_comprobante" class="form-control" id="nro_comprobante" placeholder="Escribe el número de comprobante">
        </div>
        <div class="mb-3">
            <label for="fecha_emision" class="form-label">Fecha de Emisión</label>
            <input type="date" name="fecha_emision" class="form-control" id="fecha_emision">
        </div>
        <div class="mb-3">
            <label for="proveedor_id" class="form-label">Proveedor</label>
            <select name="proveedor_id" class="form-control" id="proveedor_id">
                <?php foreach($proveedores as $proveedor): ?>
                    <option value="<?php echo $proveedor->id; ?>"><?php echo $proveedor->razon_social; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="detalles" class="form-label">Detalles</label>
            <div id="detalles">
                <div class="detalle">
                    <select name="detalles[0][producto_id]" class="form-control mb-2">
                        <?php foreach($productos as $producto): ?>
                            <option value="<?php echo $producto->id; ?>"><?php echo $producto->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="detalles[0][cantidad]" class="form-control mb-2" placeholder="Cantidad">
                    <input type="number" step="0.01" name="detalles[0][precio]" class="form-control mb-2" placeholder="Precio">
                </div>
            </div>
            <button type="button" id="agregar-detalle" class="btn btn-secondary">Agregar Detalle</button>
        </div>
        <div class="text-center mt-3">
            <input type="submit" name="registrar" value="Registrar" class="btn btn-primary btn-lg">
            <a href="compras.php" class="btn btn-danger btn-lg">Cancelar</a>
        </div>
    </form>
</div>
<script>
document.getElementById('agregar-detalle').addEventListener('click', function() {
    var detalles = document.getElementById('detalles');
    var detalleCount = detalles.getElementsByClassName('detalle').length;
    var newDetalle = document.createElement('div');
    newDetalle.classList.add('detalle');
    newDetalle.innerHTML = `
        <select name="detalles[${detalleCount}][producto_id]" class="form-control mb-2">
            <?php foreach($productos as $producto): ?>
                <option value="<?php echo $producto->id; ?>"><?php echo $producto->nombre; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" name="detalles[${detalleCount}][cantidad]" class="form-control mb-2" placeholder="Cantidad">
        <input type="number" step="0.01" name="detalles[${detalleCount}][precio]" class="form-control mb-2" placeholder="Precio">
    `;
    detalles.appendChild(newDetalle);
});
</script>