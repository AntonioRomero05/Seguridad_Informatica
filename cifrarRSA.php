<?php

require_once('conexion.php');

$cone = new conexion();

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$identificacion = $_POST['identificacion'];

$llave = $_POST['llave'];

$sqlllave = "SELECT * FROM mensaje_rsa WHERE llave = '$llave'";
$execute_llave = mysqli_query($cone->conectardb(), $sqlllave);

if($execute_llave->num_rows== 0){

    #como no existen las llaves las creamos a partir de la clave que nos dio el usuario
    $configargs = array (
        'config' => "/opt/alt/openssl11/etc/pki/tls/openssl.cnf",
        'private_key_bits' => 2048,
        'default_md' => "sha256",
    );
    
    $generar= openssl_pkey_new($configargs);
    
    openssl_pkey_export($generar, $keypriv, NULL, $configargs);
    
    $keypub = openssl_pkey_get_details($generar);
    
    file_put_contents('privada'.$llave.'.key', $keypriv);
    file_put_contents('publica'.$llave.'.key',$keypub['key']);

    #ejecutamos la funcion creada
    cifrar($nombre, $apellidos, $telefono, $correo, $direccion, $identificacion, $llave);
}else{
    echo "esta llave ya existe";
}

function cifrar($nombre, $apellidos, $telefono, $correo, $direccion, $identificacion, $llave){

    $llavepublica = openssl_pkey_get_public(file_get_contents('publica'.$llave.'.key'));

    openssl_public_encrypt($direccion, $dir_cifrada, $llavepublica);
    openssl_public_encrypt($identificacion, $iden_cifrada, $llavepublica);
    
    #lo pasamos a base 64 para poder guardarlo en la base de datos
    $dir_cifrado64 = base64_encode($dir_cifrada);
    $iden_cifrado64 = base64_encode($iden_cifrada);

    #agregar a la base de datos

    $conn = new conexion();
    $sql = "INSERT INTO mensaje_rsa(nombre, apellidos, telefono, correo, direccion, identificacion, llave) VALUES ('$nombre', '$apellidos', '$telefono', '$correo', '$dir_cifrado64', '$iden_cifrado64', '$llave')";
    $ejecutar= mysqli_query($conn->conectardb(), $sql);

    if($ejecutar){
        header("Location:RSA.php");
    }else{
        echo "tu codigo no chibe";
    }

}
