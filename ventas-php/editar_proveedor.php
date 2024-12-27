<?php
include_once "encabezado.php";
include_once "navbar.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$id = $_GET['id'];
if (!$id) {
    echo 'No se ha seleccionado el proveedor';
    exit;
}
include_once "funciones.php";
$proveedor = obtenerProveedorPorId($id);
?>

<div class="container">
    <h3>Editar proveedor</h3>
    <form method="post">
        <div class="mb-3">
            <label for="razon_social" class="form-label">Razón Social</label>
            <input type="text" name="razon_social" class="form-control" value="<?php echo $proveedor->razon_social;?>" id="razon_social" placeholder="Escribe la razón social del proveedor">
        </div>
        <div class="mb-3">
            <label for="ruc" class="form-label">RUC</label>
            <input type="text" name="ruc" class="form-control" value="<?php echo $proveedor->ruc;?>" id="ruc" placeholder="Escribe el RUC del proveedor">
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="<?php echo $proveedor->direccion;?>" id="direccion" placeholder="Escribe la dirección del proveedor">
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="<?php echo $proveedor->telefono;?>" id="telefono" placeholder="Escribe el teléfono del proveedor">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $proveedor->email;?>" id="email" placeholder="Escribe el email del proveedor">
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="text" name="url" class="form-control" value="<?php echo $proveedor->url;?>" id="url" placeholder="Escribe la URL del proveedor">
        </div>
        <div class="text-center mt-3">
            <input type="submit" name="actualizar" value="Actualizar" class="btn btn-primary btn-lg">
            <a href="proveedores.php" class="btn btn-danger btn-lg">Cancelar</a>
        </div>
    </form>
</div>
<?php
if(isset($_POST['actualizar'])){
    $razon_social = $_POST['razon_social'];
    $ruc = $_POST['ruc'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $url = $_POST['url'];

    if(empty($razon_social) || empty($ruc) || empty($direccion) || empty($telefono) || empty($email) || empty($url)){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
    } 
    
    include_once "funciones.php";
    $resultado = editarProveedor($razon_social, $ruc, $direccion, $telefono, $email, $url, $id);
    if($resultado){
        echo'
        <div class="alert alert-success mt-3" role="alert">
            Información del proveedor actualizada con éxito.
        </div>';
    }
}
?>