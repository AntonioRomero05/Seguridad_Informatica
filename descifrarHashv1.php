<?php

require_once('conexion.php');

$numreg = $_POST['numreg'];
$pass = $_POST['pass'];

$conn = new conexion();

$sql = "SELECT * FROM hashv1 WHERE idh1 = '$numreg'";
$execute = mysqli_query($conn->conectardb(), $sql);

if($execute->num_rows > 0){
    $sql1 = "SELECT * FROM hashv1 WHERE idh1 = '$numreg' ";
    $execute1 = mysqli_query($conn->conectardb(), $sql1);
    $row = mysqli_fetch_row($execute1);
    $direccion = $row[5];
    $identificacion = $row[6];
    $passh1 = $row[7];
    
    if (sha1($pass)=== $passh1) {
        echo "La contraseña es correcta";
        echo "<br>";
        echo "La direccion descifrada es: ".$direccion;
        echo "<br>";
        echo "La identificacion descifrada es: ".$identificacion;

    }else{
        

        echo "La contraseña no es correcta, verifique";

    }

}else{
    echo "No existe ese registro, verifique el numero";
}

?>