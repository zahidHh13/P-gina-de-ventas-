<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$compras = [];
if(isset($_POST['generar_reporte'])){
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    if(empty($fecha_inicio) || empty($fecha_fin)){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Debes seleccionar ambas fechas.
        </div>';
    } else {
        $compras = obtenerComprasEntreFechas($fecha_inicio, $fecha_fin);
    }
}
?>
<div class="container">
    <h3>Reporte de Compras</h3>
    <form method="post">
        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio">
        </div>
        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control" id="fecha_fin">
        </div>
        <div class="text-center mt-3">
            <input type="submit" name="generar_reporte" value="Generar Reporte" class="btn btn-primary btn-lg">
        </div>
    </form>

    <?php if(!empty($compras)): ?>
    <h3 class="mt-5">Resultados del Reporte</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Tipo de Comprobante</th>
                <th>Nro de Comprobante</th>
                <th>Fecha de Emisión</th>
                <th>Proveedor</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($compras as $compra): ?>
                <tr>
                    <td><?php echo $compra->tipo_comprobante; ?></td>
                    <td><?php echo $compra->nro_comprobante; ?></td>
                    <td><?php echo $compra->fecha_emision; ?></td>
                    <td><?php echo $compra->proveedor; ?></td>
                    <td>
                        <ul>
                            <?php foreach($compra->detalles as $detalle): ?>
                                <li><?php echo $detalle->producto . " - " . $detalle->cantidad . " - " . $detalle->precio; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>