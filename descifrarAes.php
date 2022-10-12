<?php

require_once('conexion.php');

$numreg = $_POST['numreg'];
$clavemsj = $_POST['clavemsj'];

$conn = new conexion();

$sql = "SELECT * FROM mensajes_aes WHERE idaes = '$numreg'";
$execute = mysqli_query($conn->conectardb(), $sql);

if($execute->num_rows > 0){
    $sql1 = "SELECT * FROM mensajes_aes WHERE idaes = '$numreg' ";
    $execute1 = mysqli_query($conn->conectardb(), $sql1);
    $row = mysqli_fetch_row($execute1);
    $direccion_enc = $row[5];
    $identificacion_enc = $row[6];
    $clavebd = $row[7];
    
    if ($clavebd != $clavemsj) {
        echo "La clave no es correcta, verifique";
    }else{
        #ejecutamos la funcion creada
        $arreglo_descifrado = descifrar($direccion_enc, $identificacion_enc, $clavemsj);

        echo "La clave es correcta";
        echo "<br>";
        echo "La direccion descifrada es: ".$arreglo_descifrado[0];
        echo "<br>";
        echo "La identificacion descifrada es: ".$arreglo_descifrado[1];
    }

}else{
    echo "No existe ese registro, verifique el numero";
}

function descifrar($direccion_enc, $identificacion_enc, $clave){
    $metodo = "AES-256-CBC";
    list($dir_cifrado, $iv) = explode("--", base64_decode($direccion_enc),2);
    list($iden_cifrado, $iv1) = explode("--", base64_decode($identificacion_enc),2);

    $dir_descifrado = openssl_decrypt($dir_cifrado, $metodo, $clave, 0, $iv);
    $iden_descifrado = openssl_decrypt($iden_cifrado, $metodo, $clave, 0, $iv1);
    $arreglo = array($dir_descifrado, $iden_descifrado);
    return $arreglo;

}


?>