<?php 
session_start();
include "../config.php";
//var_dump($_POST);
//die();

if(isset($_POST['key_registro']) == "registro_doc"){
    $nombre_doc = $_POST['nombre_doc'];
    $fecha_doc = $_POST['fecha_doc']; 
    $tipo_doc = $_POST['tipo_doc'];
    $desc_doc = $_POST['desc_doc'];
    $nombre_archivo = "archivos/".$_POST['nombre_archivo'];
    $id_usuario = $_SESSION["id_user"];

    $sql = "INSERT INTO documento(nombre, fecha_ingreso, tipo_documento, descripcion, estado, url, id_usuario) 
                                VALUES ('".$nombre_doc."','".$fecha_doc."','".$tipo_doc."','".$desc_doc."',1, '".$nombre_archivo."', '".$id_usuario."')";
    

	if ($conn->query($sql) === TRUE) {
        echo "1";//Succes
      } else {
        echo "a";//Error
      }
      
      $conn->close();
	
}elseif(isset($_FILES["archivo"])){
    $file = $_FILES["archivo"];
    $nombre_formato = $file["name"];
    $nombre = str_replace(" ", "", $nombre_formato);
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];//donde está ahorita el archivo en el sv
    $size = $file["size"];
    $carpeta_destino = "D:/wamp64/www/Proyecto/Git/JuntaCartago/js/archivos/";//Servidor local
    $fecha = date("Y-m-d H:i:s");
    $hoy = date("Y-m-d");
    $key_fecha = strtotime($fecha);//cambia la fecha por una cadena 

    if (!file_exists($carpeta_destino)) {
        mkdir($carpeta_destino, 0777, true);
    }
    if (!is_uploaded_file($ruta_provisional)) {
        // Manejar el error aquí
        echo 'El archivo no se ha cargado correctamente.';
        exit;
    }

    $nombre_archivo = $key_fecha.$nombre;
        $src2 = $carpeta_destino.$nombre_archivo;
        if(move_uploaded_file($ruta_provisional,$src2)){
            $file=$src2;
            $resizedFile=$file;
            echo $nombre_archivo;
            die();
        }else{
            echo "a";
        }

}
?>