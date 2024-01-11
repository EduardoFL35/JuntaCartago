<?php 
session_start();
include "../config.php";
//var_dump($_POST);
//die();

//Insertar Doc
if(isset($_POST['key_vacaciones']) == "registro_vacaciones"){
    $usuario_vacaciones = $_POST['usuario_vacaciones'];
    $fecha_entrada = $_POST['fecha_entrada']; 
    $fecha_salida = $_POST['fecha_salida'];
    

    $sql = "INSERT INTO `vacaciones`( `id_usuario`, `fecha_inicio`, `fecha_final`, `estado`) 
                VALUES (".$usuario_vacaciones.",'".$fecha_entrada."','".$fecha_salida."',1)";
    

	if ($conn->query($sql) === TRUE) {
        echo "1";//Succes
      } else {
        echo "a";//Error
      }
      
      $conn->close();
	
//Subir archivo      
}
?>