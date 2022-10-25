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
$arrayChar1 = str_split($direccion);
$arrayChar2 = str_split($identificacion);
$arrayChar3 = str_split($pass);

$cifradoDireccion = "";
$cifradoIdentificacion = "";
$cifradoPass = "";
#1
for ($i=0; $i < count($arrayChar1) ; $i++) { 
    $conASCII = ord($arrayChar1[$i]);
    $procesado = $conASCII / 2;
    if($i+1 >= count($arrayChar1)){
        $procesado2 = $procesado;
    }else{
        $procesado2 = $procesado ."-";
    }
    
    $cifradoDireccion.=$procesado2;
}
#2
for ($i=0; $i < count($arrayChar2) ; $i++) { 
    $conASCII = ord($arrayChar2[$i]);
    $procesado = $conASCII / 2;
    if($i+1 >= count($arrayChar2)){
        $procesado2 = $procesado;
    }else{
        $procesado2 = $procesado ."-";
    }
    
    $cifradoIdentificacion.=$procesado2;
}
#3
for ($i=0; $i < count($arrayChar3) ; $i++) { 
    $conASCII = ord($arrayChar3[$i]);
    $procesado = $conASCII / 2;
    if($i+1 >= count($arrayChar3)){
        $procesado2 = $procesado;
    }else{
        $procesado2 = $procesado ."-";
    }
    
    $cifradoPass.=$procesado2;
}
    #agregar a la base de datos

    $conn = new conexion();
    $sql = "INSERT INTO propio(nombre, apellidos, telefono, correo, direccion, identificacion, pass) VALUES ('$nombre', '$apellidos', '$telefono', '$correo', '$cifradoDireccion', '$cifradoIdentificacion', '$cifradoPass')";
    $ejecutar= mysqli_query($conn->conectardb(), $sql);

    if($ejecutar){
        header("Location:Propio.php");
    }else{
        echo "tu codigo no chibe";
    }

}

#ejecutamos la funcion creada
cifrar($nombre, $apellidos, $telefono, $correo, $direccion, $identificacion, $pass);



?>