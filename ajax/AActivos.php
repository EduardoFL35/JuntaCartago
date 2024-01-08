<?php 
session_start();
include "../config.php";

//Insertar Activo
if(isset($_POST['key_registro_activo']) == "registro_activo"){
    $codigo_activo = $_POST['codigo_activo'];
    $nombre_activo = $_POST['nombre_activo'];
    $desc_activo = $_POST['desc_activo'];
    $color_activo = $_POST['color_activo'];  
    $monto_activo = $_POST['monto_activo'];  
    $cantidad_activo = $_POST['cantidad_activo'];
    $cantidad_minima_activo = $_POST['cantidad_minima_activo'];
    $fecha_inicio_activo = $_POST['fecha_inicio_activo'];
    $fecha_final_activo = $_POST['fecha_final_activo'];
    $estado_activo = $_POST['estado_activo'];
    $nota_activo = $_POST['nota_activo'];
    $nombre_imagen = "img/".$_POST['nombre_imagen'];
    $nombre_factura = "archivos/".$_POST['nombre_factura'];

    $sql = "INSERT INTO activo(codigo, nombre, descripcion, color_id, precio, cantidad, cantidad_minima, imagen, estado_id, 
                        fecha_inicio, fecha_finalizacion, factura, `status`, nota) 
                        VALUES ('".$codigo_activo."','".$nombre_activo."','".$desc_activo."',
                        '".$color_activo."','".$monto_activo."',".$cantidad_activo.",".$cantidad_minima_activo.",
                        '".$nombre_imagen."',".$estado_activo.",'".$fecha_inicio_activo."','".$fecha_final_activo."',
                        '".$nombre_factura."',1,'".$nota_activo."')";

    if ($conn->query($sql) === TRUE) {
        
        $id_activo = $conn->insert_id;

        // Calcular la duración de la garantía en días
        $fecha_inicio = new DateTime($fecha_inicio_activo);
        $fecha_final = new DateTime($fecha_final_activo);
        $duracion_garantia = $fecha_inicio->diff($fecha_final)->days;

        
        $sql_garantia = "INSERT INTO garantia(id_activo, garantia, estado) 
                                    VALUES ('$id_activo', '".$duracion_garantia."', 1)";

        if ($conn->query($sql_garantia) === TRUE) {
            echo "1"; // Succes
        } else {
            echo "a"; // Error
        }
    } else {
        echo "a"; // Error al insertar en activo
    }

    $conn->close();
	
//Subir archivo      
}elseif(isset($_FILES["factura_activo"])){
    $file = $_FILES["factura_activo"];
    $nombre_formato = $file["name"];
    $nombre = str_replace(" ", "", $nombre_formato);
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];//donde está ahorita el archivo en el sv
    $size = $file["size"];
    $carpeta_destino = "D:/wamp64/www/Proyecto/Git/JuntaCartago/js/archivos/";//Servidor local
    $fecha = date("d-m-Y H:i:s");
    $hoy = date("d-m-Y");
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
}elseif(isset($_FILES["imagen"])){
    $file_img = $_FILES["imagen"];
    $nombre_formato_img = $file_img["name"];
    $nombre_img = str_replace(" ", "", $nombre_formato_img);
    $tipo_img = $file_img["type"];
    $ruta_provisional_img = $file_img["tmp_name"];//donde está ahorita el archivo en el sv
    $size_img = $file["size"];
    $carpeta_destino_img = "D:/wamp64/www/Proyecto/Git/JuntaCartago/img";//Servidor local
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
}elseif(isset($_POST['key_nota_activo']) == "key_nota_activo"){
    $id_activo = $_POST['id_activo'];
    $message_activo = $_POST['message_activo'];
    

    $insert = "UPDATE `activo` SET `nota`='".$message_activo."' WHERE id = '".$id_activo."';";

    if ($conn->query($insert) === TRUE) {
        echo "1";//Succes
      } else {
        echo "a";//Error
      }
      
      $conn->close();
                      
}



?>