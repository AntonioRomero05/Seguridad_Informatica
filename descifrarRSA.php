<?php

require_once('conexion.php');

$numeroreg = $_POST['numeroreg'];
$llavereg = $_POST['llavereg'];

$conn = new conexion();

$sql = "SELECT * FROM mensaje_rsa WHERE idrsa = '$numeroreg'";
$execute = mysqli_query($conn->conectardb(), $sql);

if($execute->num_rows > 0){
    $sql1 = "SELECT * FROM mensaje_rsa WHERE idrsa = '$numeroreg' ";
    $execute1 = mysqli_query($conn->conectardb(), $sql1);
    $row = mysqli_fetch_row($execute1);
    $direccion_enc = $row[5];
    $identificacion_enc = $row[6];
    $llavebd = $row[7];

    if($llavebd == $llavereg){
        $llaveprivada = openssl_pkey_get_private(file_get_contents('privada'.$llavereg.'.key'));

        openssl_private_decrypt(base64_decode($direccion_enc), $dir_descifrado, $llaveprivada);
        openssl_private_decrypt(base64_decode($identificacion_enc), $iden_descifrado, $llaveprivada);

        echo "La llave es correcta";
        echo "<br>";
        echo "La direccion descifrada es: ".$dir_descifrado;
        echo "<br>";
        echo "La identificacion descifrada es: ".$iden_descifrado;

    }else{
        echo "la llave no es correcta";
    }
    #ejecutamos la funcion creada

}else{
    echo "No existe ese mensaje, verifique el numero";
}


?>