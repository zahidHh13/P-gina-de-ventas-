<?php
include_once "encabezado.php";
include_once "navbar.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

?>
<div class="container">
    <h3>Agregar cliente</h3>
    <form method="post">

        <!-- NOMRBE -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label> 
            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Escribe el nombre del cliente">
        </div>
        <!-- APELLIDOS -->
        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Escribe los apellidos del cliente">
        </div>
        
        <!-- TIPO DE DOCUMENTO -->
        <div class="mb-3">
            <label for="tipo_documento" class="form-label">Tipo de Documento</label>
            <input type="text" name="tipo_documento" class="form-control" id="tipo_documento" placeholder="Escribe el tipo de documento">
        </div>
        
        <!-- NRO DE DOCUMENTO -->
        <div class="mb-3">
            <label for="nro_documento" class="form-label">Nro de Documento</label>
            <input type="text" name="nro_documento" class="form-control" id="nro_documento" placeholder="Escribe el número de documento">
        </div>
        <!-- DIRECCION -->
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Ej. Av Collar 1005 Col Las Cruces">
        </div>
        <!-- TELÉFONO -->
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Ej. 984876456">
        </div>
        

        <!-- EMAIL -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Escribe el email del cliente">
        </div>
        
        <!-- BOTON REGISTRAR -->
        <div class="text-center mt-3">
            <input type="submit" name="registrar" value="Registrar" class="btn btn-primary btn-lg">
            
            </input>
            <a href="clientes.php" class="btn btn-danger btn-lg">
                <i class="fa fa-times"></i> 
                Cancelar
            </a>
        </div>
    </form>
</div>

<?php
if(isset($_POST['registrar'])){
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $tipo_documento = $_POST['tipo_documento'];
    $nro_documento = $_POST['nro_documento'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];

    if(empty($nombre) 
    || empty($apellidos) 
    || empty($tipo_documento) 
    || empty($nro_documento) 
    || empty($telefono) 
    || empty($direccion) 
    || empty($email)){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
    } 
    
    include_once "funciones.php";
    $resultado = registrarCliente($nombre, $apellidos, $tipo_documento, $nro_documento, $telefono, $direccion, $email);
    if($resultado){
        echo'
        <div class="alert alert-success mt-3" role="alert">
            Cliente registrado con éxito.
        </div>';
    }
}
?>