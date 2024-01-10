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
    //$nombre_archivo = "archivos/".$_POST['nombre_archivo'];
    $fecha_soli = $_POST['fecha_soli'];
    $id_usuario = $_SESSION["id_user"];
    
    

    $sql = "INSERT INTO `solicitudes`(`nombre_solicitud`, `descripcion_detallada`, `id_procedencia`, `razon_solicitud`, `fecha`, `estado`, `id_usuario` ) 
                                    VALUES ('".$nombre_soli."','".$desc_detallada_soli."',".$procedencia_soli.",'".$desc_fundamentada_soli."','".$fecha_soli."', 1, ".$id_usuario.")";
    

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
    $carpeta_destino = "E:/WAMP/www/Proyecto/Git/JuntaCartago/js/archivos";//Servidor local
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
    $eliminar = "UPDATE documento SET estado= 0 WHERE id = '$id_documento';";
      
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
        }
    }
    ?>
    <form id="documento_form">
        <input type="hidden" value="<?php echo $id_edit; ?>">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label">Nombre</label>
                            <div>
                                <input type="text" class="form-control" placeholder="Nombre" id="nombre_doc" name="nombre_doc" value="<?php echo $nombre; ?>">
                            </div>
                        </div>
                    
                        <div class="col-sm-6">
                            <label class="form-label">Fecha de Ingreso</label>
                            <div>
                                <input type="date" name="fecha_doc" id="fecha_doc" class="form-control" placeholder="Fecha de Ingreso" value="<?php echo $fecha_ingreso; ?>">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label">Tipo de Documento</label>
                            <div>
                                <select name="tipo_doc" id="tipo_doc" class="form-control" placeholder="Tipo de Documento">
                                    <option value="1">Acta</option>
                                    <option value="2">Contrato</option>
                                    <option value="3">Adjudicación</option>
                                    <option value="4">Oficio</option>
                                    <option value="5">Expediente</option>
                                    <option value="6">Orden de Compra</option>
                                    <option value="7">Planilla</option>
                                    <option value="8">Cheque</option>
                                </select>
                            </div>
                        </div>
                            
                        <div class="col-sm-6">
                            <label class="form-label">Descripción</label>
                            <div>
                                <textarea class="form-control" name="desc_doc" id="desc_doc" rows="2" placeholder="Descripción" value="<?php echo $fecha_ingreso; ?>"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="archivo" class="form-label">Cargar Documento</label>
                        <input type="file" name="archivo" class="form-control form-control-file" id="archivo">
                        <input type="hidden" id="nombre_archivo">
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

        $edit = "UPDATE appointment SET Appointment_Time = '".$apointment_time."', 
                                        Schedules = '".$schedule_list."',
                                        Patient_Id = ".$cedula.",
                                        Doctor_Id = ".$doctor_list.",
                                        Speciality_Id = ".$speciality_list.", 
                                        Message = '".$message."' WHERE Id = $id_edit";

        if ($conn->query($edit) === TRUE) {
            echo "1";//Succes
        } else {
            echo "a";//Error
        }
        
        $conn->close();


}elseif (isset($_POST['key_eliminar_control']) == "eliminar_control") {
    $id_control = $_POST['id_control'];
    $eliminar = "UPDATE control_documento SET estado= 1 WHERE id = '$id_control';";
      
    if ($conn->query($eliminar) === TRUE) {
        echo "1";//Succes
        } else {
        echo "a";//Error
        }
        
    $conn->close();
}
?>