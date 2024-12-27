<?php
$id = $_GET['id'];
if (!$id) {
    echo 'No se ha seleccionado la compra';
    exit;
}
include_once "funciones.php";

$resultado = anularCompra($id);
if(!$resultado){
    echo "Error al anular la compra";
    return;
}

header("Location: compras.php");
?>