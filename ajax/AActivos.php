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
}elseif(isset($_FILES["imagen_activo_p"])){
    $file_img = $_FILES["imagen_activo_p"];
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
    
//Cambiar estado de eliminar                  
}elseif (isset($_POST['key_eliminar_activo']) == "eliminar_activo") {
    $id_activo = $_POST['id_activo'];
    $eliminar = "UPDATE `activo` SET `status`= 0 WHERE id = '$id_activo';";
      
    if ($conn->query($eliminar) === TRUE) {
        echo "1";//Succes
        } else {
        echo "a";//Error
        }
        
    $conn->close();
 
 //Editar activo   
}elseif (isset($_POST['key_editar']) == "editar_activo") {

    $id_edit = $_POST['id_edit_activo'];
    $editActivo = "SELECT * FROM activo WHERE id = $id_edit";
    $query = $conn->query($editActivo);  

    if($query->num_rows > 0){
        while ($row = $query->fetch_assoc()){
            $id = $row['id'];
            $Codigo = $row['codigo']; 
            $Nombre = $row['nombre']; 
            $Descripción = $row['descripcion'];
            $Color = $row['color_id'];
            $Precio = $row['precio'];
            $Cantidad = $row['cantidad'];
            $Cantidad_Mínima = $row['cantidad_minima'];
            $Imagen = $row['imagen'];
            $Imagen_m = str_replace("img/", "", $Imagen);
            $Estado = $row['estado_id'];
            $Factura = $row['factura'];
            $Factura_m = str_replace("img/", "", $Factura);
            $Nota = $row['nota'];
            $Fecha_Inicio = $row['fecha_inicio'];
            $Fecha_Finalizacion = $row['fecha_finalizacion'];

        }
    }
    ?>
    <div class="p-2">
        <div id="alerta_registro">

        </div>
        <form id="activo_form_editar">
            <input type="hidden" id="id_activo_editar" value="<?php echo $id_edit?>">            
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Código</label>
                    <div>
                        <input type="text" class="form-control" placeholder="Código" id="codigo_activo_editar" name="codigo_activo_editar" value="<?php echo $Codigo?>">
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <label class="form-label">Nombre</label>
                    <div>
                        <input type="text" class="form-control" placeholder="Nombre" id="nombre_activo_editar" name="nombre_activo_editar" value="<?php echo $Nombre?>">
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Descripción</label>
                    <div>
                        <textarea class="form-control" name="desc_activo_editar" id="desc_activo_editar" rows="2" placeholder="Descripción"><?php echo $Descripción?></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="archivo" class="form-label">Monto</label>
                    <input type="number" class="form-control" name="monto_activo_editar" id="monto_activo_editar" placeholder="Monto Total" value="<?php echo $Precio?>">
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="archivo" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad_activo_editar" id="cantidad_activo_editar" placeholder="Cantidad Total" value="<?php echo $Cantidad?>">
                </div>
                <div class="col-sm-6">
                    <label for="archivo" class="form-label">Cantidad Mínima</label>
                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Cantidad Mínima del Activo">
                        <i class="bi bi-question-circle"></i>
                    </span>
                    <input type="number" class="form-control" name="cantidad_minima_activo_editar" id="cantidad_minima_activo_editar" placeholder="Cantidad Mínima del Activo" value="<?php echo $Cantidad_Mínima?>">
                </div>
            </div>
            <br> 
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="factura_activo" class="form-label">Cargar Factura</label>
                    <input type="file" name="factura_activo" class="form-control form-control-file" id="factura_activo">
                    <input type="hidden" id="nombre_factura_editar" value="<?php echo $Factura_m; ?>">
                    <div id="mostrar_factura_activo"><a class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                                        href="http://localhost/Proyecto/Git/JuntaCartago/js/archivos/<?php echo $Factura_m; ?>">Factura</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="imagen_activo" class="form-label">Cargar Imagen</label>
                    <input type="file" name="imagen_activo" class="form-control form-control-file" id="imagen_activo">
                    <input type="hidden" id="nombre_imagen_editar" value="<?php echo $Imagen_m; ?>">
                    <div id="mostrar_imagen_activo"><a class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                                    href="http://localhost/Proyecto/Git/JuntaCartago/img/<?php echo $Imagen_m; ?>">Imagen</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Fecha de inicio de la garantía</label>
                    <div>
                        <input type="date" name="fecha_inicio_activo_editar" id="fecha_inicio_activo_editar" class="form-control" placeholder="Fecha de inicio de la garantía" value="<?php echo $Fecha_Inicio; ?>">
                    </div>
                </div>   
                <div class="col-sm-6">
                    <label class="form-label">Fecha de final de la garantía</label>
                    <div>
                        <input type="date" name="fecha_final_activo_editar" id="fecha_final_activo_editar" class="form-control" placeholder="Fecha de final de la garantía" value="<?php echo $Fecha_Finalizacion; ?>">
                    </div>
                </div>  
            </div>
            <br>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Estado</label>
                    <div>
                        <select name="estado_activo_editar" id="estado_activo_editar" class="form-select" placeholder="Estado">
                        <?php
                            if ($Estado == 1) {
                                echo '<option value="1" selected>Nuevo</option>';
                            }else{
                                echo '<option value="1" >Nuevo</option>';
                            }
                            if ($Estado == 2) {
                                echo '<option value="2" selected>Agotado</option>';
                            }else{
                                echo '<option value="2" >Agotado</option>';
                            }
                            if ($Estado == 3) {
                                echo '<option value="3" selected>Dañado</option>';
                            }else{
                                echo '<option value="3" >Dañado</option>';
                            }
                            if ($Estado == 4) {
                                echo '<option value="4" selected>En reparación</option>';
                            }else{
                                echo '<option value="4" >En reparación</option>';
                            }
                            
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Color</label>
                    <div>
                        <select name="color_activo_editar" id="color_activo_editar" class="form-select" placeholder="Color">
                            <?php 
                            if ($Color == 1) {
                                echo '<option value="1" selected>Negro</option>';
                            }else{
                                echo '<option value="1" >Negro</option>';
                            }
                            if ($Color == 2) {
                                echo '<option value="2" selected>Blanco</option>';
                            }else{
                                echo '<option value="2" >Blanco</option>';
                            }
                            if ($Color == 3) {
                                echo '<option value="3" selected>Azul</option>';
                            }else{
                                echo '<option value="3" >Azul</option>';
                            }
                            if ($Color == 4) {
                                echo '<option value="4" selected>Café</option>';
                            }else{
                                echo '<option value="4" >Café</option>';
                            }
                            if ($Color == 5) {
                                echo '<option value="5" selected>Verde</option>';
                            }else{
                                echo '<option value="5" >Verde</option>';
                            }
                            if ($Color == 6) {
                                echo '<option value="6" selected>Rojo</option>';
                            }else{
                                echo '<option value="6" >Rojo</option>';
                            }
                            if ($Color == 7) {
                                echo '<option value="7" selected>Gris</option>';
                            }else{
                                echo '<option value="7" >Gris</option>';
                            }
                            if ($Color == 8) {
                                echo '<option value="8" selected>Celeste</option>';
                            }else{
                                echo '<option value="8" >Celeste</option>';
                            }
                            ?>
                            
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Nota</label>
                    <div>
                        <textarea class="form-control" name="nota_activo_editar" id="nota_activo_editar" rows="2" placeholder="Nota"><?php echo $Nota; ?></textarea>
                    </div>
                </div>
            </div> 
            <br>
            <div class="form-footer">
                <div class="text-end">
                    <div class="d-flex">
                        <a href="#" class="btn btn-danger">Cancelar</a>
                        <button id="action" type="submit" style="color: #ffffff; background-color: #001F3F;" class="btn ms-auto">Guardar</button>
                    </div>
                </div>
            </div>           
        </form>
    </div>     
    <?php

}elseif(isset($_POST['key_editar_activo']) == "edit_activo"){
    $codigo_activo_editar = $_POST['codigo_activo_editar'];
    $nombre_activo_editar = $_POST['nombre_activo_editar'];
    $desc_activo_editar = $_POST['desc_activo_editar'];
    $color_activo_editar = $_POST['color_activo_editar'];  
    $monto_activo_editar = $_POST['monto_activo_editar'];  
    $cantidad_activo_editar = $_POST['cantidad_activo_editar'];
    $cantidad_minima_activo_editar = $_POST['cantidad_minima_activo_editar'];
    $fecha_inicio_activo_editar = $_POST['fecha_inicio_activo_editar'];
    $fecha_final_activo_editar = $_POST['fecha_final_activo_editar'];
    $estado_activo_editar = $_POST['estado_activo_editar'];
    $nota_activo_editar = $_POST['nota_activo_editar'];
    $nombre_imagen = "img/".$_POST['nombre_imagen_editar'];
    $nombre_factura = "archivos/".$_POST['nombre_factura_editar'];
    $id_activo_editar = $_POST['id_activo_editar'];
    


    $editar_activo = "UPDATE `activo` SET `codigo`='".$codigo_activo_editar."',
                                          `nombre`='".$nombre_activo_editar."',
                                          `descripcion`='".$desc_activo_editar."',
                                          `color_id`='".$color_activo_editar."',
                                          `precio`=".$monto_activo_editar.",
                                          `cantidad`=".$cantidad_activo_editar.",
                                          `cantidad_minima`=".$cantidad_minima_activo_editar.",
                                          `imagen`='".$nombre_imagen."',
                                          `estado_id`=".$estado_activo_editar.",
                                          `fecha_inicio`='".$fecha_inicio_activo_editar."',
                                          `fecha_finalizacion`='".$fecha_final_activo_editar."',
                                          `factura`='".$nombre_factura."',
                                          `nota`='".$nota_activo_editar."' WHERE id = '".$id_activo_editar."'";
      
    if ($conn->query($editar_activo) === TRUE) {
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