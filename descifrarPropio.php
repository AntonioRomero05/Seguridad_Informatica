<?php

require_once('conexion.php');

$numreg = $_POST['numreg'];
$pass = $_POST['pass'];

$conn = new conexion();

$sql = "SELECT * FROM propio WHERE idpropio = '$numreg'";
$execute = mysqli_query($conn->conectardb(), $sql);

if($execute->num_rows > 0){
    $sql1 = "SELECT * FROM propio WHERE idpropio = '$numreg' ";
    $execute1 = mysqli_query($conn->conectardb(), $sql1);
    $row = mysqli_fetch_row($execute1);
    $direccion = $row[5];
    $identificacion = $row[6];
    $passPropio = $row[7];

    #descifrar
    $descifradoDireccion = "";
    $descifradoIdentificacion = "";
    $descifradoPass = "";

    

    $despegarPas = explode("-", $passPropio);


    for ($i=0; $i < count($despegarPas) ; $i++) { 
        $multiplicado = $despegarPas[$i] * 2;
        $desASCII = chr($multiplicado);
        $descifradoPass.=$desASCII;
    }


    
    if ($pass === $descifradoPass) {

        $despegarDir = explode("-", $direccion);
        $despegarIde = explode("-", $identificacion);

        for ($i=0; $i < count($despegarDir) ; $i++) { 
            $multiplicado = $despegarDir[$i] * 2;
            $desASCII = chr($multiplicado);
            $descifradoDireccion.=$desASCII;
        }
    
        for ($i=0; $i < count($despegarIde) ; $i++) { 
            $multiplicado = $despegarIde[$i] * 2;
            $desASCII = chr($multiplicado);
            $descifradoIdentificacion.=$desASCII;
        }


        echo "La contraseña es correcta :)";
        echo "<br>";
        echo "La direccion descifrada es: ".$descifradoDireccion;
        echo "<br>";
        echo "La identificacion descifrada es: ".$descifradoIdentificacion;

    }else{
        

        echo "La contraseña no es correcta, verifique";

    }

}else{
    echo "No existe ese registro, verifique el numero";
}

?>