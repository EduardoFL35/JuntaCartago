<?php 
session_start();
include "../config.php";
//var_dump($_POST);
//die();

//Insertar Doc
if(isset($_POST['key_registro_soli']) == "registro_soli"){
    $nombre_soli = $_POST['nombre_soli'];
    $procedencia_soli = $_POST['procedencia_soli']; 
    $desc_detallada_soli = $_POST['desc_detallada_soli'];
    $desc_fundamentada_soli = $_POST['desc_fundamentada_soli'];
    $nombre_archivo = "archivos/".$_POST['nombre_archivo'];
    $fecha_soli = $_POST['fecha_soli'];
    $id_usuario = $_SESSION["id_user"];
    
    

    $sql = "INSERT INTO `solicitudes`(`nombre_solicitud`, `descripcion_detallada`, `id_procedencia`, `solicitud`, `razon_solicitud`, `fecha`, `id_usuario`, `status` ) 
                                    VALUES ('".$nombre_soli."','".$desc_detallada_soli."',".$procedencia_soli.",'".$nombre_archivo."','".$desc_fundamentada_soli."','".$fecha_soli."', ".$id_usuario.", 1)";
    

	if ($conn->query($sql) === TRUE) {
        echo "1";//Succes
      } else {
        echo "a";//Error
      }
      
      $conn->close();
	
//Subir archivo      
}elseif(isset($_FILES["imagen_producto"])){
    $file_img = $_FILES["imagen_producto"];
    $nombre_formato_img = $file_img["name"];
    $nombre_img = str_replace(" ", "", $nombre_formato_img);
    $tipo_img = $file_img["type"];
    $ruta_provisional_img = $file_img["tmp_name"];//donde está ahorita el archivo en el sv
    $size_img = $file_img["size"];
    $carpeta_destino_img = "D:/wamp64/www/Proyecto/Git/JuntaCartago/js/archivos/";//Servidor local
    $fecha_img = date("Y-m-d H:i:s");
    $hoy_img = date("Y-m-d");
    $key_fecha_img = strtotime($fecha_img);//cambia la fecha por una cadena 

    if (!file_exists($carpeta_destino_img)) {
        mkdir($carpeta_destino_img, 0777, true);
    }
    if (!is_uploaded_file($ruta_provisional_img)) {
        // Manejar el error aquí
        echo 'El archivo no se ha cargado correctamente.';
        exit;
    }

    $nombre_archivo_img = $key_fecha_img.$nombre_img;
        $src2_img = $carpeta_destino_img.$nombre_archivo_img;
        if(move_uploaded_file($ruta_provisional_img,$src2_img)){
            $file_img=$src2_img;
            $resizedFile_img=$file_img;
            echo $nombre_archivo_img;
            die();
        }else{
            echo "a";
        }
}
?>