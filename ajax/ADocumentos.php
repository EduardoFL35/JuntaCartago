<?php 
session_start();
include "../config.php";
//var_dump($_POST);
//die();

//Insertar Doc
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
	
//Subir archivo      
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

//Cambiar estado de eliminar
}elseif (isset($_POST['key_eliminar']) == "eliminar_tarea") {
    $id_documento = $_POST['id_documento'];
    $eliminar = "UPDATE `documento` SET `estado`= 0 WHERE id = '$id_documento';";
      
    if ($conn->query($eliminar) === TRUE) {
        echo "1";//Succes
        } else {
        echo "a";//Error
        }
        
    $conn->close();

//Editar documento    
}elseif (isset($_POST['key_editar']) == "editar_documento") {

    $id_edit = $_POST['id_edit'];
    $editDoc = "SELECT * FROM documento WHERE id = $id_edit";
    $query = $conn->query($editDoc);  

    if($query->num_rows > 0){
        while ($row = $query->fetch_assoc()){
            $id = $row['id'];
            $nombre = $row['nombre'];
            $fecha_ingreso = $row['fecha_ingreso'];
            $tipo_documento = $row['tipo_documento'];
            $descripcion = $row['descripcion'];
            $nombre_archivo = $row['url'];
            $nombre_archivo_m = str_replace("archivos/", "", $nombre_archivo);
        }
    }
    ?>
        <form id="documento_form_editar">
            <input type="hidden" id="id_activo_editar" value="<?php echo $id_edit?>">
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Nombre</label>
                    <div>
                        <input type="text" class="form-control" placeholder="Nombre" id="nombre_doc_editar" name="nombre_doc" value="<?php echo $nombre; ?>">
                    </div>
                </div>
            
                <div class="col-sm-6">
                    <label class="form-label">Fecha de Ingreso</label>
                    <div>
                        <input type="date" name="fecha_doc" id="fecha_doc_editar" class="form-control" placeholder="Fecha de Ingreso" value="<?php echo $fecha_ingreso; ?>">
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label">Tipo de Documento</label>
                    <div>
                        <select name="tipo_doc" id="tipo_doc_editar" class="form-control" placeholder="Tipo de Documento" >
                            <?php 
                                if ($tipo_documento == 1) {
                                    echo '<option value="1" selected>Acta</option>';
                                }else{
                                    echo '<option value="1" >Acta</option>';
                                }
                                if ($tipo_documento == 2) {
                                    echo '<option value="2" selected>Contrato</option>';
                                }else{
                                    echo '<option value="2" >Contrato</option>';
                                }
                                if ($tipo_documento == 3) {
                                    echo '<option value="3" selected>Adjudicación</option>';
                                }else{
                                    echo '<option value="3" >Adjudicación</option>';
                                }
                                if ($tipo_documento == 4) {
                                    echo '<option value="4" selected>Oficio</option>';
                                }else{
                                    echo '<option value="4" >Oficio</option>';
                                }
                                if ($tipo_documento == 5) {
                                    echo '<option value="5" selected>Expediente</option>';
                                }else{
                                    echo '<option value="5" >Expediente</option>';
                                }
                                if ($tipo_documento == 6) {
                                    echo '<option value="6" selected>Orden de Compra</option>';
                                }else{
                                    echo '<option value="6" >Orden de Compra</option>';
                                }
                                if ($tipo_documento == 7) {
                                    echo '<option value="7" selected>Planilla</option>';
                                }else{
                                    echo '<option value="7" >Planilla</option>';
                                }
                                if ($tipo_documento == 8) {
                                    echo '<option value="8" selected>Cheque</option>';
                                }else{
                                    echo '<option value="8" >Cheque</option>';
                                }
                            ?>
                        </select>
                        
                    </div>
                </div>
                    
                <div class="col-sm-6">
                    <label class="form-label">Descripción</label>
                    <div>
                        <textarea class="form-control" name="desc_doc" id="desc_doc_editar" rows="2" placeholder="Descripción"><?php echo $descripcion; ?>"</textarea>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="archivo" class="form-label">Cargar Documento</label>
                    <input type="file" name="archivo" class="form-control form-control-file" id="archivo">
                    <input type="hidden" id="nombre_archivo_editar" value="<?php echo $nombre_archivo_m; ?>">
                    <div id="mostrar_archivo"><a href="http://localhost/Proyecto/Git/JuntaCartago/js/archivos/<?php echo $nombre_archivo_m; ?>">Documento</a></div>
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
    <?php

}elseif (isset($_POST['key_eliminar_control']) == "eliminar_control") {
    $id_control = $_POST['id_control'];
    $eliminar = "UPDATE `control_documento` SET `estado`= 1 WHERE id = '$id_control';";
      
    if ($conn->query($eliminar) === TRUE) {
        echo "1";//Succes
        } else {
        echo "a";//Error
        }
        
    $conn->close();
}elseif(isset($_POST['key_editar_registro']) == "editar_registro_doc"){
    $id_activo_editar = $_POST['id_activo_editar'];
    $nombre_doc = $_POST['nombre_doc_editar'];
    $fecha_doc = $_POST['fecha_doc_editar']; 
    $tipo_doc = $_POST['tipo_doc_editar'];
    $desc_doc = $_POST['desc_doc_editar'];
    $nombre_archivo = "archivos/".$_POST['nombre_archivo_editar'];
    $id_usuario = $_SESSION["id_user"];


    $editar_doc = "UPDATE `documento` SET `nombre`='".$nombre_doc."',
                                          `fecha_ingreso`='".$fecha_doc."',
                                          `tipo_documento`=".$tipo_doc.",
                                          `descripcion`='".$desc_doc."',
                                          `url`='".$nombre_archivo."',
                                          `id_usuario`=".$id_usuario."
                                           WHERE id = '".$id_activo_editar."'";
      
    if ($conn->query($editar_doc) === TRUE) {
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
