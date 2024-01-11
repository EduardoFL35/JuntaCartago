<?php 
session_start();
include "../config.php";
//var_dump($_POST);
//die();
if (isset($_POST['key_editar']) == "editar_documento") {

    $id_edit = $_POST['id_edit_tipo'];
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
            $tipo_procedencia = $row['id_procedencia'];
            $nombre_archivo_m = str_replace("archivos/", "", $nombre_archivo);
        }
    }
    ?>
    <div class="p-2">
        <div id="alerta_registro">
        </div>
        <form id="documento_form_editar">
            <input type="hidden" id="id_documento_editar" value="<?php echo $id_edit?>">
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
                    <label class="form-label">Procedencia del archivo</label>
                    <div>
                        <select name="tipo_doc_editar" id="tipo_procedencia_editar" class="form-control" placeholder="Tipo de Procedencia" >
                            <?php 
                                if ($tipo_procedencia == 1) {
                                    echo '<option value="1" selected>Escuela Jesús Jiménez Zamora</option>';
                                }else{
                                    echo '<option value="1" >Escuela Jesús Jiménez Zamora</option>';
                                }
                                if ($tipo_procedencia == 2) {
                                    echo '<option value="2" selected>Kinder Jesús Jimenez Zamora</option>';
                                }else{
                                    echo '<option value="2" >Kinder Jesús Jimenez Zamora</option>';
                                }
                                if ($tipo_procedencia == 3) {
                                    echo '<option value="3" selected>Escuela Esquivel Ibarra</option>';
                                }else{
                                    echo '<option value="3" >Escuela Esquivel Ibarra</option>';
                                }
                                if ($tipo_procedencia == 4) {
                                    echo '<option value="4" selected>Kinder Esquivel Ibarra</option>';
                                }else{
                                    echo '<option value="4" >Kinder Esquivel Ibarra</option>';
                                }
                                if ($tipo_procedencia == 5) {
                                    echo '<option value="5" selected>Escuela Padre Peralta</option>';
                                }else{
                                    echo '<option value="5" >Escuela Padre Peralta</option>';
                                }
                                if ($tipo_procedencia == 6) {
                                    echo '<option value="6" selected>Kinder Padre Peralta</option>';
                                }else{
                                    echo '<option value="6" >Kinder Padre Peralta</option>';
                                }
                                if ($tipo_procedencia == 7) {
                                    echo '<option value="7" selected>Oficina administrativa</option>';
                                }else{
                                    echo '<option value="7" >Oficina administrativa</option>';
                                }
                                
                            ?>
                        </select>
                        
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
                <div class="col-sm-6">
                    <label class="form-label">Descripción</label>
                    <div>
                        <textarea class="form-control" name="desc_doc" id="desc_doc_editar" rows="2" placeholder="Descripción"><?php echo $descripcion; ?>"</textarea>
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

}elseif(isset($_POST['key_editar_registro']) == "editar_registro_doc"){
    $id_documento_editar = $_POST['id_documento_editar'];
    $nombre_doc_editar = $_POST['nombre_doc_editar'];
    $fecha_doc_editar = $_POST['fecha_doc_editar']; 
    $tipo_doc_editar = $_POST['tipo_doc_editar'];
    $desc_doc_editar = $_POST['desc_doc_editar'];
    $tipo_procedencia_editar = $_POST['tipo_procedencia_editar'];
    $nombre_archivo_editar = "archivos/".$_POST['nombre_archivo_editar'];
    $id_usuario = $_SESSION["id_user"];


    $editar_doc = "UPDATE `documento` SET `nombre`='".$nombre_doc_editar."',
                                          `fecha_ingreso`='".$fecha_doc_editar."',
                                          `tipo_documento`=".$tipo_doc.",
                                          `descripcion`='".$desc_doc_editar."',
                                          `url`='".$nombre_archivo_editar."',
                                          `id_usuario`=".$id_usuario.",
                                          `id_procedencia`=".$tipo_procedencia_editar."
                                           WHERE id = '".$id_documento_editar."'";
      
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