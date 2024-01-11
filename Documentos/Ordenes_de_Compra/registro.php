<?php require "../../config.php";
session_start();
if (!isset($_SESSION["username"])) { //SI LA VARIABLE NO ESTÁ DEFINIDA
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location: http://$host/Proyecto/Git/JuntaCartago/login");// sino mandelo hacia acá
}

//echo "<a id='cerrar'>".$_SESSION["nombre"]." ".$_SESSION["apellido"]." </a>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenes de Compra - Junta De Cartago</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../js/ordenes_de_compra.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!--Fuente-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Georgia+Pro&family=Roboto:wght@400&display=swap">
</head>
</head>
<body class="bg-light">
    <nav class="border-bottom border-2 navbar navbar-expand-lg nav-fondo">
        <div class="container-fluid">
            <a href="../../index.php">
                <img src="../../img/logo.svg" width="50" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if ($_SESSION["rol"] == 1 && 2) {
                        ?><li class="nav-item">
                                <a class="nav-link" aria-current="page" href="../../index.php">
                                    <i class=" bi bi-house"></i>Inicio
                                </a>
                            </li>
                    <?php
                    } ?>
                    
                    <?php if ($_SESSION["rol"] == 1 && 3) {
                        ?><li class="nav-item">
                                <a class="nav-link" href="../../Documentos/registro.php">
                                    <i class=" bi bi-file-earmark-arrow-down"></i>Registro De Documentos
                                </a>
                            </li>                    
                    <?php
                     } ?>
                     

                    <?php if ($_SESSION["rol"] == 1 && 3) {
                        ?><div class="dropdown">
                                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class=" bi bi-list-task"></i>Documentos
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../../Documentos/Tipos/Adjudicacion.php">Adjudicaciones</a></li>
                                    <li><a class="dropdown-item" href="../../Documentos/Tipos/Contrato.php">Contratos</a></li>
                                    <li><a class="dropdown-item" href="../../Documentos/Tipos/Actas.php">Actas</a></li>
                                    <li><a class="dropdown-item" href="../../Documentos/Tipos/Oficios.php">Oficios</a></li>
                                    <li><a class="dropdown-item" href="../../Documentos/Tipos/Expedientes.php">Expedientes</a></li>
                                    <li><a class="dropdown-item" href="../../Documentos/Tipos/OrdenesDeCompra.php">Ordenes de compra</a></li>  
                                    <li><a class="dropdown-item" href="../../Documentos/Tipos/Plantillas.php">Plantillas</a></li>
                                    <li><a class="dropdown-item" href="../../Documentos/Tipos/Cheques.php">Cheques</a></li>
                                </ul>
                            </div>
                    <?php
                     } ?>

                     
                    <?php if ($_SESSION["rol"] == 1 && 3) {
                        ?><div class="dropdown">
                                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class=" bi bi-file-text"></i>Escuelas
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../../Documentos/Escuelas/EscuelaJesus.php">Escuela Jesús Jiménez Zamora</a></li>
                                    <li><a class="dropdown-item" href="../../Documentos/Escuelas/KinderJesusJimenez.php">Kinder Jesús Jimenez Zamora</a></li>
                                    <li><a class="dropdown-item" href="../../Documentos/Escuelas/EscuelaEsquivel.php">Escuela Esquivel Ibarra</a></li>
                                    <li><a class="dropdown-item" href="../../Documentos/Escuelas/KinderEsquivel.php">Kinder Esquivel Ibarra</a></li>
                                    <li><a class="dropdown-item" href="../../Documentos/Escuelas/EscuelaPadrePeralta.php">Escuela Padre Peralta</a></li>
                                    <li><a class="dropdown-item" href="../../Documentos/Escuelas/KinderPadrePeralta.php">Kinder Padre Peralta</a></li>  
                                    <li><a class="dropdown-item" href="../../Documentos/Escuelas/OficinaAdministrativa.php">Oficina administrativa</a></li>
                                </ul>
                            </div>
                    <?php
                    } ?>

                    <?php if ($_SESSION["rol"] == 1 && 3) {
                        ?><li class="nav-item">
                                <a class="nav-link" href="../../Documentos/listado.php">
                                    <i class=" bi bi-search"></i>Búsqueda De Documentos
                                </a>
                            </li>
                    <?php
                     } ?>

                    
                    
                    <?php if ($_SESSION["rol"] == 1) {
                        ?><li class="nav-item">
                                <a class="nav-link" href="../../Inventario/index.php">
                                    <i class=" bi bi-card-checklist"></i>Inventario
                                </a>
                            </li>
                    <?php
                    } ?>
                     
                     <?php if ($_SESSION["rol"] == 1) {
                        ?><li class="nav-item">
                                <a class="nav-link" href="../../Documentos/Ordenes_de_Compra/index.php">
                                    <i class=" bi bi-file-earmark-arrow-down"></i>Ordenes De Compra
                                </a>
                            </li>
                    <?php
                    } ?>

                    <?php if ($_SESSION["rol"] == 4) {
                        ?><li class="nav-item">
                                <a class="nav-link" aria-current="page" href="../../Solicitudes_Escuela/Solicitud_EscuelaEsquivel.php">
                                    <i class=" bi bi-file-earmark-arrow-down"></i>Ver Solicitudes
                                </a>
                            </li>
                    <?php
                     } ?>

                    <?php if ($_SESSION["rol"] ==6 ) {
                        ?><li class="nav-item">
                                <a class="nav-link" aria-current="page" href="../../Solicitud_EscuelaJesusJimez.php">
                                    <i class=" bi bi-file-earmark-arrow-down"></i>Ver Solicitudes
                                </a>
                            </li>
                    <?php
                    } ?>

                    <?php if ($_SESSION["rol"] == 8) {
                        ?><li class="nav-item">
                                <a class="nav-link" aria-current="page" href="../../Solicitud_EscuelaPadrePeralta.php">
                                    <i class=" bi bi-file-earmark-arrow-down"></i>Ver Solicitudes
                                </a>
                            </li>
                    <?php
                    } ?>

                    <?php if ($_SESSION["rol"] == 5) {
                        ?><li class="nav-item">
                                <a class="nav-link" aria-current="page" href="../../Solicitud_KinderEsquivel.php">
                                    <i class=" bi bi-file-earmark-arrow-down"></i>Ver Solicitudes
                                </a>
                            </li>
                    <?php
                    } ?>

                    <?php if ($_SESSION["rol"] == 7) {
                        ?><li class="nav-item">
                                <a class="nav-link" aria-current="page" href="../../Solicitud_KinderJesusJimenez.php">
                                    <i class=" bi bi-file-earmark-arrow-down"></i>Ver Solicitudes
                                </a>
                            </li>
                    <?php
                    } ?>

                    <?php if ($_SESSION["rol"] == 9) {
                        ?><li class="nav-item">
                                <a class="nav-link" aria-current="page" href="../../Solicitud_KinderPadrePeralta.php">
                                    <i class=" bi bi-file-earmark-arrow-down"></i>Ver Solicitudes
                                </a>
                            </li>
                    <?php
                    } ?>

                    
                    <?php if ($_SESSION["rol"] == 10) {
                        ?><li class="nav-item">
                                <a class="nav-link" aria-current="page" href="../../Solicitudes/Registro_Solicitud.php">
                                    <i class=" bi bi-file-earmark-arrow-down"></i>Registrar Solicitud
                                </a>
                            </li>
                    <?php
                    } ?>

                    <?php if ($_SESSION["rol"] == 1) {
                        ?><div class="dropdown">
                                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class=" bi bi-file-text"></i>Solicitudes 
                                </a>
        
                                <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="../../Solicitudes/Solicitud_EscuelaJesusJimez.php">Escuela Jesús Jiménez Zamora</a></li>
                                        <li><a class="dropdown-item" href="../../Solicitudes/Solicitud_KinderJesusJimenez.php">Kinder Jesús Jimenez Zamora</a></li>
                                        <li><a class="dropdown-item" href="../../Solicitudes/Solicitud_EscuelaEsquivel.php">Escuela Esquivel Ibarra</a></li>
                                        <li><a class="dropdown-item" href="../../Solicitudes/Solicitud_KinderEsquivel.php">Kinder Esquivel Ibarra</a></li>
                                        <li><a class="dropdown-item" href="../../Solicitudes/Solicitud_EscuelaPadrePeralta.php">Escuela Padre Peralta</a></li>
                                        <li><a class="dropdown-item" href="../../Solicitudes/Solicitud_KinderPadrePeralta.php">Kinder Padre Peralta</a></li>                         
                                </ul>                   
                            </div>
                    
                    <?php
                    } ?>

                </ul>
                <ul class="navbar-nav ms-auto">                    
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown" aria-label="Open user menu" aria-expanded="false">
                            <div class="d-none d-xl-block ps-2">
                                <div><i class="m-2 bi bi-person-circle"></i><?php  echo $_SESSION["nombre"]." ".$_SESSION["apellido"];?></div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">                    
                            <a id="" href="../../Perfil/index.php" class="dropdown-item">
                                <i class="bi bi-person-bounding-box"></i> Perfil
                            </a>    
                        
                            <a id="cerrar" href="#" class="dropdown-item">
                                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                            </a> 
                        </div>
                        
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div id="alerta_registro">
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registrar Orden de Compra</h3>  
            </div>
            <div class="card-body">

                <form id="orden_form">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label">Tipo de Orden De Compra</label>
                            <div>
                                <select name="tipo_orden" id="tipo_orden" class="form-control" placeholder="Tipo de Documento">
                                    <option value="1">PANEA</option>
                                    <option value="2">Ordinario</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Estado de la factura</label>
                            <div>
                                <select name="estado_factura" id="estado_factura" class="form-control" placeholder="Tipo de Documento">
                                    <option value="1">Pendiente</option>
                                    <option value="2">Cancelada</option>
                                    
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label">Fecha de Ingreso</label>
                            <div>
                                <input type="date" name="fecha_orden" id="fecha_orden" class="form-control" placeholder="Fecha de Ingreso">
                            </div>
                        </div>
                 
                        <div class="col-sm-6">
                            <label class="form-label">Procedencia del archivo</label>
                            <div>
                                <select name="procedencia_orden" id="procedencia_orden" class="form-control" placeholder="Tipo de Procedencia">
                                    <option value="1">Escuela Jesús Jiménez Zamora</option>
                                    <option value="2">Kinder Jesús Jimenez Zamora</option>
                                    <option value="3">Escuela Esquivel Ibarra</option>
                                    <option value="4">Kinder Esquivel Ibarra</option>
                                    <option value="5">Escuela Padre Peralta</option>
                                    <option value="6">Kinder Padre Peralta</option>
                                    <option value="7">Oficina administrativa</option>
                                </select>
                            </div>
                        </div>
                     
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="archivo" class="form-label">Cargar Documento</label>
                            <input type="file" name="archivo" class="form-control form-control-file" id="archivo">
                            <input type="hidden" id="nombre_archivo">
                        </div>
                        
                        <div class="col-sm-6">
                            <label class="form-label">Descripción</label>
                            <div>
                                <textarea class="form-control" name="desc_orden" id="desc_orden" rows="2" placeholder="Descripción"></textarea>
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
        </div>
    </div>

    <footer class="mt-5 py-3 bg-light">
        <div class="container text-center">
            <p>&copy; 2023 Junta De Cartago Centro. Todos los derechos reservados.</p>
        </div>
    </footer>
<!-- Enlace al archivo JS de Popper.js (puedes utilizar un CDN o descargarlo localmente) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<!-- Enlace al archivo JS de Bootstrap (opcional, pero necesario para algunos componentes interactivos) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>