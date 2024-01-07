<?php 
session_start();
include "../config.php";

//Insertar Activo
if(isset($_POST['key_registro_producto']) == "key_registro_producto"){
    $nombre_producto = $_POST['nombre_producto'];
    $precio_producto = $_POST['precio_producto'];
    $cantidad_producto = $_POST['cantidad_producto'];
    $cantidad_minima_producto = $_POST['cantidad_minima_producto'];
    $factura_producto = "archivos/".$_POST['factura_producto']; 
    $imagen_producto = "img/".$_POST['imagen_producto'];
    $desc_producto = $_POST['desc_producto'];

    $sql = "INSERT INTO `producto_limpieza`(`nombre`, `descripcion`, `precio`, `cantidad`, `cantidad_minima`, `imagen`, `factura`, `status`) 
    VALUES ('".$nombre_producto."','".$desc_producto."',".$precio_producto.",".$cantidad_producto.",'".$cantidad_minima_producto."','".$imagen_producto."','".$factura_producto."',1)";

    if ($conn->query($sql) === TRUE) {
        echo "1";//Succes
      } else {
        echo "a";//Error
      }
      
      $conn->close();
                        
	
//Subir archivo      
}elseif(isset($_FILES["factura_producto"])){
    $file = $_FILES["factura_producto"];
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
}elseif(isset($_FILES["imagen_producto"])){
    $file_img = $_FILES["imagen_producto"];
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
}



?>