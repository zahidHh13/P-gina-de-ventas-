<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$compras = obtenerCompras(); // Asumiendo que tienes una función para obtener compras

?>
<div class="container">
    <h1>
        <a class="btn btn-success btn-lg" href="registrar_compra.php">
            <i class="fa fa-plus"></i>
            Registrar Compra
        </a>
        Compras
    </h1>
    <table class="table">
        <thead>
            <tr>
                <th>Tipo de Comprobante</th>
                <th>Nro de Comprobante</th>
                <th>Fecha de Emisión</th>
                <th>Proveedor</th>
                <th>Detalles</th>
                <th>Anular</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($compras as $compra){
            ?>
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
                    <td><a href="anular_compra.php?id=<?php echo $compra->id; ?>" class="btn btn-danger">Anular</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>