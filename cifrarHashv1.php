<?php

require_once('conexion.php');

#datos del registro

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$identificacion = $_POST['identificacion'];

$pass = $_POST['password'];



function cifrar($nombre, $apellidos, $telefono, $correo, $direccion, $identificacion, $pass){
    #cifrar contraseña para poder guardarla
    $passh1 = sha1($pass, false);

    #agregar a la base de datos

    $conn = new conexion();
    $sql = "INSERT INTO hashv1(nombre, apellidos, telefono, correo, direccion, identificacion, pass) VALUES ('$nombre', '$apellidos', '$telefono', '$correo', '$direccion', '$identificacion', '$passh1')";
    $ejecutar= mysqli_query($conn->conectardb(), $sql);

    if($ejecutar){
        header("Location:HashV1.php");
    }else{
        echo "tu codigo no chibe";
    }

}

#ejecutamos la funcion creada
cifrar($nombre, $apellidos, $telefono, $correo, $direccion, $identificacion, $pass);



?>