<?php

require_once('conexion.php');

#datos del registro

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$identificacion = $_POST['identificacion'];

$clave = $_POST['clave'];



function cifrar($nombre, $apellidos, $telefono, $correo, $direccion, $identificacion, $clave){
    $metodo = "AES-256-CBC";
    $iv_tamaño = openssl_cipher_iv_length($metodo);
    $iv = openssl_random_pseudo_bytes($iv_tamaño);
    $dir_encriptado1 = openssl_encrypt($direccion, $metodo, $clave, 0, $iv);
    $iden_encriptado1_2 = openssl_encrypt($identificacion, $metodo, $clave, 0, $iv);
    #
    $dir_encriptado2 = base64_encode($dir_encriptado1."--".$iv);
    $iden_encriptado2_2 = base64_encode($iden_encriptado1_2."--".$iv);

    #agregar a la base de datos

    $conn = new conexion();
    $sql = "INSERT INTO mensajes_aes(nombre, apellidos, telefono, correo, direccion, identificacion, clave) VALUES ('$nombre', '$apellidos', '$telefono', '$correo', '$dir_encriptado2', '$iden_encriptado2_2', '$clave')";
    $ejecutar= mysqli_query($conn->conectardb(), $sql);

    if($ejecutar){
        header("Location:AES.php");
    }else{
        echo "tu codigo no chibe";
    }

}

#ejecutamos la funcion creada
cifrar($nombre, $apellidos, $telefono, $correo, $direccion, $identificacion, $clave);



?>