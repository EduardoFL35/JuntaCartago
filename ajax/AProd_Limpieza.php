<?php 
session_start();
include "../config.php";

//Insertar Activo
if(isset($_POST['key_registro_producto']) == "key_registro_producto"){
    $nombre_producto = $_POST['nombre_producto'];
    $precio_producto = $_POST['precio_producto'];
    $cantidad_producto = $_POST['cantidad_producto'];
    $cantidad_minima_producto = $_POST['cantidad_minima_producto'];
    $nombre_factura = "archivos/".$_POST['nombre_factura']; 
    $nombre_imagen = "img/".$_POST['nombre_imagen'];
    $desc_producto = $_POST['desc_producto'];

    $sql = "INSERT INTO `producto_limpieza`(`nombre`, `descripcion`, `precio`, `cantidad`, `cantidad_minima`, `imagen`, `factura`, `status`) 
    VALUES ('".$nombre_producto."','".$desc_producto."',".$precio_producto.",".$cantidad_producto.",'".$cantidad_minima_producto."','".$nombre_imagen."','".$nombre_factura."',1)";

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
}elseif(isset($_FILES["imagen_producto"])){
    $file_img = $_FILES["imagen_producto"];
    $nombre_formato_img = $file_img["name"];
    $nombre_img = str_replace(" ", "", $nombre_formato_img);
    $tipo_img = $file_img["type"];
    $ruta_provisional_img = $file_img["tmp_name"];//donde está ahorita el archivo en el sv
    $size_img = $file_img["size"];
    $carpeta_destino_img = "D:/wamp64/www/Proyecto/Git/JuntaCartago/img/";//Servidor local
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
  //Agregar Nota      
}elseif(isset($_POST['key_nota_producto']) == "key_nota_producto"){
    $id_producto = $_POST['id_producto'];
    $message_limpieza = $_POST['message_limpieza'];
    

    $insert = "UPDATE `producto_limpieza` SET `nota`='".$message_limpieza."' WHERE id = '".$id_producto."';";

    if ($conn->query($insert) === TRUE) {
        echo "1";//Succes
      } else {
        echo "a";//Error
      }
      
      $conn->close();
                        
	
//Cambiar estado de eliminar                  
}elseif (isset($_POST['key_eliminar_producto']) == "eliminar_producto") {
    $id_producto = $_POST['id_producto'];
    $eliminar = "UPDATE `producto_limpieza` SET `status`= 0 WHERE id = '$id_producto';";
      
    if ($conn->query($eliminar) === TRUE) {
        echo "1";//Succes
        } else {
        echo "a";//Error
        }
        
    $conn->close();
  
}elseif (isset($_POST['key_editar']) == "editar_producto") {
    $id_edit = $_POST['id_edit_producto'];
    $editProd = "SELECT * FROM producto_limpieza WHERE id = $id_edit";
    $query = $conn->query($editProd);  


    if($query->num_rows > 0){
        while ($row = $query->fetch_assoc()){
            $id = $row['id'];
            $Nombre = $row['nombre'];
            $Descripcion = $row['descripcion']; 
            $Precio = $row['precio']; 
            $Cantidad = $row['cantidad'];
            $Cantidad_Minima = $row['cantidad_minima'];
            $Imagen = $row['imagen'];
            $Imagen_m = str_replace("img/", "", $Imagen);
            $Factura = $row['factura'];
            $Factura_m = str_replace("archivos/", "", $Factura);
            $Nota = $row['nota'];
        }
    }
    ?>
    <div class="p-2">
        <div id="alerta_registro">
        </div>
        <form id="producto_form_editar">
            <input type="hidden" id="id_producto_editar" value="<?php echo $id_edit?>">
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Nombre</label>
                    <div>
                        <input type="text" class="form-control" placeholder="Nombre" id="nombre_producto_editar" name="nombre_producto_editar" value="<?php echo $Nombre?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="archivo" class="form-label">Precio</label>
                    <input type="number" class="form-control" name="precio_producto_editar" id="precio_producto_editar" placeholder="Monto Total" value="<?php echo $Precio?>">
                </div>                                    
            </div>
            <br>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="archivo" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad_producto_editar" id="cantidad_producto_editar" placeholder="Cantidad Total" value="<?php echo $Cantidad?>">
                </div>
                <div class="col-sm-6">
                    <label for="archivo" class="form-label">Cantidad Mínima</label>
                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Cantidad mínima de un producto de limpieza almacenado">
                        <i class="bi bi-question-circle"></i>
                    </span>
                    <input type="number" class="form-control" name="cantidad_minima_producto_editar" id="cantidad_minima_producto_editar" placeholder="Cantidad mínima de un producto de limpieza almacenado" value="<?php echo $Cantidad_Minima?>">
                </div>
                
            </div>
            <br>
            <div class="form-group row">
                <div class="col-sm-6">
                        <label for="factura_producto" class="form-label">Cargar Factura</label>
                        <input type="file" name="factura_producto" class="form-control form-control-file" id="factura_producto">
                        <input type="hidden" id="nombre_factura_editar" value="<?php echo $Factura_m; ?>">
                        <div id="mostrar_factura_producto"><a class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                                        href="http://localhost/Proyecto/Git/JuntaCartago/js/archivos/<?php echo $Factura_m; ?>">Factura</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="imagen_producto" class="form-label">Cargar Imagen</label>
                        <input type="file" name="imagen_producto" class="form-control form-control-file" id="imagen_producto">
                        <input type="hidden" id="nombre_imagen_editar" value="<?php echo $Imagen_m; ?>">
                        <div id="mostrar_imagen_activo"><a class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                                    href="http://localhost/Proyecto/Git/JuntaCartago/img/<?php echo $Imagen_m; ?>">Imagen</a>
                        </div>
                    </div>
                </div>
            <br> 
            <div class="form-group row">    
                <div class="col-sm-6">
                    <label class="form-label">Descripción</label>
                    <div>
                        <textarea class="form-control" name="desc_producto" id="desc_producto_editar" rows="2" placeholder="Descripción"><?php echo $Descripcion; ?></textarea>
                    </div>
                </div>                                
                
            </div> 
            <br>
            <div class="form-footer">
                <div class="text-end">
                    <div class="d-flex">
                        <a href="../../Inventario/index.php" class="btn btn-danger">Volver atrás</a>
                        <button id="action" type="submit" style="color: #ffffff; background-color: #001F3F;" class="btn ms-auto">Guardar</button>
                    </div>
                </div>
            </div>           
        </form>
    </div>
    <?php
}elseif(isset($_POST['key_editar_producto']) == "edit_producto"){
    $id_producto_editar = $_POST['id_producto_editar'];
    $nombre_producto_editar = $_POST['nombre_producto_editar'];
    $precio_producto_editar = $_POST['precio_producto_editar'];
    $cantidad_producto_editar = $_POST['cantidad_producto_editar'];
    $cantidad_minima_producto_editar = $_POST['cantidad_minima_producto_editar'];  
    $nombre_factura = "archivos/".$_POST['nombre_factura_editar'];  
    $nombre_imagen = "img/".$_POST['nombre_imagen_editar'];
    $desc_producto_editar = $_POST['desc_producto_editar'];

    $editar_producto = "UPDATE `producto_limpieza` SET `nombre`='".$nombre_producto_editar."',
                                                       `descripcion`='".$desc_producto_editar."',
                                                       `precio`=".$precio_producto_editar.",
                                                       `cantidad`=".$cantidad_producto_editar.",
                                                       `cantidad_minima`=".$cantidad_minima_producto_editar.",
                                                       `imagen`='".$nombre_imagen."',
                                                       `factura`='".$nombre_factura."'
                                                       WHERE id = '".$id_producto_editar."'";
      
    if ($conn->query($editar_producto) === TRUE) {
        echo "1";//Succes
        } else {
        echo "a";//Error
        }
        
    $conn->close();



}else{
    //Output error
    header('HTTP/1.1 500 Error, intenta de nuevo!');
    //exit();
}



?>