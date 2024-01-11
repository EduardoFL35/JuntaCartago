<?php require "../../config.php";
session_start();
if (!isset($_SESSION["username"])) { //SI LA VARIABLE NO ESTÁ DEFINIDA
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location: http://$host/Proyecto/Git/JuntaCartago/login");// sino mandelo hacia acá
}
$query = $conn->query("select * from documento where tipo_documento = 5"); 

if($_SESSION["rol"] != 1){//Redirecciono a una página cuando no tiene permisos
    echo "<p>No tiene permisos</p>";
    die();
}

//echo "<a id='cerrar'>".$_SESSION["nombre"]." ".$_SESSION["apellido"]." </a>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos - Junta De Cartago</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/documentos.js"></script>
    <script src="../js/script.js"></script>
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

    <div class="page-header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                    <i class="m-1 bi bi-floppy"></i>Listado de documentos almacenados
                    </div>
                    <h2 class="page-title">
                    <i class="m-4 bi bi-folder-check"></i>Expedientes
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="../registro.php" style="color: #ffffff; background-color: #001F3F;" class="btn d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Agregar Documento
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">

                    <div class="table table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead class="table-secondary">
                                <tr>
									<th class="th-list">Nombre</th>
                                    <th class="th-list">Procedencia</th>
									<th class="th-list">Fecha Ingreso</th>
									<th class="th-list">Descripcion</th>
                                    <th class="th-list">Propietario</th>
                                  
                                    <th class="th-list"></th>
                                </tr>
                                </thead>

                                <?php

                                if($query->num_rows > 0){
                                while ($row = $query->fetch_assoc()){
                                    $id = $row['id'];
                                    $id_usuario = $row['id_usuario'];
                                   
                                            $nombre = $row['nombre'];
                                            $fecha_ingreso = $row['fecha_ingreso'];
                                            $tipo_documento = $row['tipo_documento'];
                                            $descripcion = $row['descripcion'];
                                            $nombre_archivo = $row['url'];

                                            $id_procedencia = $row ['id_procedencia'];
                                            $procedencias = $conn->query("select * from procedencia where id = ".$id_procedencia."");
                                            if ($procedencias->num_rows > 0) {
                                                while ($row3 = $procedencias->fetch_assoc()){
                                                    $nombre_procedencia = $row3['nombre'];
                                                }
                                            }
                                            $query_usuario = $conn->query("select * from usuario where id = ".$id_usuario."");
                                            if ($query_usuario->num_rows > 0) {
                                                while ($row4 = $query_usuario->fetch_assoc()){
                                                    $usuarios = $row4['name'];
                                                }
                                            }
                                    
                                    
                                    

                                    
                                    ?>
                                <tbody>
                                    <tr>
										<td class="td-list"><?php echo $nombre;?></td>
                                        <td class="td-list"><?php echo $nombre_procedencia;?></td>
										<td class="td-list"><?php echo $fecha_ingreso;?></td>
										<td class="td-list"><?php echo $descripcion;?></td>
                                        <th class="th-list"><?php echo $usuarios;?></th>
                                        <td class="td-list">
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                        Opciones
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">
                                                            <i class="bi bi-pencil-square"></i>
                                                           Editar
                                                        </a>
                                                        <form action="#" method="POST">
                                                            <input type="hidden" name="_token" value="2atWpGYdcoqQKeHMiUHLvChu6BuXb1n6aW0VWbDa" autocomplete="off">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit"  class=" eliminar_control dropdown-item text-red">
                                                                <i class="bi bi-eraser"></i>    
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                        <a class="dropdown-item" href="http://localhost/Proyecto/Git/JuntaCartago/js/<?php echo $nombre_archivo; ?>">
                                                            <i class="bi bi-download"></i>
                                                            Descargar
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                    echo "No hay registros.<br>";
                                }
                                ?>
                            </tbody>

                            </table>
                        </div>
                    </div>
                </div>
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