<?php
$id = $_GET['id'];
if (!$id) {
    echo 'No se ha seleccionado el proveedor';
    exit;
}
include_once "funciones.php";
var_dump($id); // Verifica que el ID se está recibiendo correctamente
$resultado = eliminarProveedor($id);
if(!$resultado){
    echo "Error al eliminar";
    return;
}

header("Location: proveedores.php");
?>