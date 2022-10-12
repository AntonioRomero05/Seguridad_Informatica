<?php

class conexion{
   
    const user='u564711255_Micro20200766';
    const pass='Esteesmisitio20200766';
    const db='u564711255_MicroSite0766';
    const servidor='localhost';

    public function conectardb(){
        $conectar = new mysqli(self::servidor, self::user,self::pass,self::db);
        if($conectar->connect_errno){
            die("Error en la conexion".$conectar->connect_error);
        }
        return $conectar;
    }   
}

?>