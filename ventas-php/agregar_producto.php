<?php
include_once "encabezado.php";
include_once "navbar.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

?>
<div class="container">
    <h3>Agregar producto</h3>
    <form method="post">
        <div class="mb-3">
            <label for="codigo" class="form-label">Código de barras</label>
            <input type="text" name="codigo" class="form-control" id="codigo" placeholder="Escribe el código de barras del producto">
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ej. Esteban">
        </div>
        <div class="row">
            <div class="col">
                <label for="compra" class="form-label">Precio compra</label>
                <input type="number" name="compra" step="any" id="compra" class="form-control" placeholder="Precio de compra" aria-label="">
            </div>
            <div class="col">
                <label for="venta" class="form-label">Precio venta</label>
                <input type="number" name="venta" step="any" id="venta" class="form-control" placeholder="Precio de venta" aria-label="">
            </div>
            <div class="col">
                <label for="existencia" class="form-label">Existencia</label>
                <input type="number" name="existencia" step="any" id="existencia" class="form-control" placeholder="Existencia" aria-label="">
            </div>
            <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Descripción del producto">
            </div>
            <div class="row">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" class="form-control" id="marca" placeholder="Marca del producto">
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" name="modelo" class="form-control" id="modelo" placeholder="Modelo del producto">
            </div>
            <div class="row">
                <div class="col">
                    <label for="stock_inicial" class="form-label">Stock inicial</label>
                    <input type="number" name="stock_inicial" step="any" id="stock_inicial" class="form-control" placeholder="Stock inicial" aria-label="">
                </div>
                <div class="col">
                    <label for="stock_actual" class="form-label">Stock actual</label>
                    <input type="number" name="stock_actual" step="any" id="stock_actual" class="form-control" placeholder="Stock actual" aria-label="">
                </div>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" name="categoria" class="form-control" id="categoria" placeholder="Ej. Laptops">
        </div>
        <div class="mb-3">
            <label for="unidad_medida" class="form-label">Unidad de medida</label>
            <input type="text" name="unidad_medida" class="form-control" id="unidad_medida" placeholder="Unidad de medida del producto">
        </div>
        <div class="text-center mt-3">
            <input type="submit" name="registrar" value="Registrar" class="btn btn-primary btn-lg">
            
            </input>
            <a class="btn btn-danger btn-lg" href="productos.php">
                <i class="fa fa-times"></i> 
                Cancelar
            </a>
        </div>
    </form>
</div>
<?php
if(isset($_POST['registrar'])){
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $compra = $_POST['compra'];
    $venta = $_POST['venta'];
    $existencia = $_POST['existencia'];
    $descripcion = $_POST['descripcion'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $stock_inicial = $_POST['stock_inicial'];
    $stock_actual = $_POST['stock_actual'];
    $categoria = $_POST['categoria'];
    $unidad_medida = $_POST['unidad_medida'];
    if(empty($codigo) 
    || empty($nombre) 
    || empty($compra) 
    || empty($venta)
    || empty($existencia)
    || empty($descripcion)
    || empty($marca)
    || empty($modelo)
    || empty($stock_inicial)
    || empty($stock_actual)
    || empty($categoria)
    || empty($unidad_medida)){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
    } 
    
    include_once "funciones.php";
    $resultado = registrarProducto($codigo, $nombre, $compra, $venta, $existencia, $descripcion, $marca, $modelo, $stock_inicial, $stock_actual, $categoria, $unidad_medida);
    if($resultado){
        echo'
        <div class="alert alert-success mt-3" role="alert">
            Producto registrado con éxito.
        </div>';
    }
    
}
?>