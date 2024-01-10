<?php 
session_start();
include "../config.php";
//var_dump($_POST);
//die();

//Insertar Doc
if(isset($_POST['key_vacaciones']) == "registro_vacaciones"){
    $usuario_vacaciones = $_POST['usuario_vacaciones'];
    $fecha_entrada = $_POST['fecha_entrada']; 
    $estado_soli = $_POST['estado_soli'];
    $fecha_salida = $_POST['fecha_salida'];
    $fecha_registro = $_POST['fecha_registro'];
    

    $sql = "INSERT INTO `vacaciones`( `id_usuario`, `fecha_inicio`, `fecha_final`, `id_estado_solicitud`, `fecha_registro`, `estado`) 
                VALUES (".$usuario_vacaciones.",'".$fecha_entrada."','".$fecha_salida."','".$estado_soli."','".$fecha_registro."',1)";
    

	if ($conn->query($sql) === TRUE) {
        echo "1";//Succes
      } else {
        echo "a";//Error
      }
      
      $conn->close();
	
//Subir archivo      
}
?>