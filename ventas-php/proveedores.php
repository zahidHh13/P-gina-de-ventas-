<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$proveedores = obtenerProveedores();
?>
<div class="container">
    <h1>
        <a class="btn btn-success btn-lg" href="agregar_proveedor.php">
            <i class="fa fa-plus"></i>
            Agregar
        </a>
        Proveedores
    </h1>
    <table class="table">
        <thead>
            <tr>
                <th>Razón Social</th>
                <th>RUC</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>URL</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($proveedores as $proveedor){
            ?>
                <tr>
                    <td><?php echo $proveedor->razon_social; ?></td>
                    <td><?php echo $proveedor->ruc; ?></td>
                    <td><?php echo $proveedor->direccion; ?></td>
                    <td><?php echo $proveedor->telefono; ?></td>
                    <td><?php echo $proveedor->email; ?></td>
                    <td><?php echo $proveedor->url; ?></td>
                    <td><a href="editar_proveedor.php?id=<?php echo $proveedor->id; ?>" class="btn btn-warning">Editar</a></td>
                    <td><a href="eliminar_proveedor.php?id=<?php echo $proveedor->id; ?>" class="btn btn-danger">Eliminar</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>