<?php require "../config.php";
session_start();
if (!isset($_SESSION["username"])) { //SI LA VARIABLE NO ESTÁ DEFINIDA
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location: http://$host/Proyecto/Git/JuntaCartago/login");// sino mandelo hacia acá
}

$query = $conn->query("select * from documento where estado = 1");    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Documentos - Junta De Cartago</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/documentos.js"></script>
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
            <a href="../index.php">
                <img src="../img/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../index.php">
                            <i class="m-2 bi bi-house"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registro.php">
                            <i class="m-2 bi bi-file-earmark-arrow-down"></i>Documentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listado.php">
                            <i class="m-2 bi bi-search"></i>Búsqueda de Documentos
                        </a>
                    </li>
                    <?php if ($_SESSION["rol"] == 1) {
                        ?><li class="nav-item">
                                <a class="nav-link" href="control.php">
                                    <i class="m-2 bi bi-folder-check"></i>Control de Archivos
                                </a>
                            </li>
                    <?php
                    } ?>
                    <?php if ($_SESSION["rol"] == 1) {
                        ?><li class="nav-item">
                                <a class="nav-link" href="../Inventario/index.php">
                                    <i class="m-2 bi bi-card-checklist"></i>Inventario
                                </a>
                            </li>
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
                        Listado de documentos almacenados
                    </div>
                    <h2 class="page-title">
                        Listado de Documentos
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="registro.php" style="color: #ffffff; background-color: #001F3F;" class="btn d-none d-sm-inline-block">
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
                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead class="table-secondary ">
                                <tr>
									<th class="th-list">Nombre</th>
									<th class="th-list">Fecha Ingreso</th>
									<th class="th-list">Tipo Documento</th>
									<th class="th-list">Descripcion</th>
                                    <th class="th-list"></th>
                                </tr>
                                </thead>

                                <?php

                                if($query->num_rows > 0){
                                while ($row = $query->fetch_assoc()){
                                    $id = $row['id'];
                                    $nombre = $row['nombre'];
                                    $fecha_ingreso = $row['fecha_ingreso'];
                                    $tipo_documento = $row['tipo_documento'];
                                    $descripcion = $row['descripcion'];
                                    $nombre_archivo = $row['url'];
                                    $documentos = $conn->query("select * from tipo_documento where Id = ".$tipo_documento."");
                                    
                                    if ($documentos->num_rows > 0) {
                                        while ($row2 = $documentos->fetch_assoc()){
                                            $tipo = $row2['nombre'];
                                        }
                                    }

                                    ?>
                                    <tbody>
                                        <tr>
                                            <td class="td-list"><?php echo $nombre; ?></td>
                                            <td class="td-list"><?php echo $fecha_ingreso; ?></td>
                                            <td class="td-list"><?php echo $tipo; ?></td>
                                            <td class="td-list"><?php echo $descripcion; ?></td>

                                            <td class="td-list">
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                        Opciones
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a id="btn_editar_doc" class="editar-btn dropdown-item" data-bs-toggle="modal" data_id="<?php echo $id;?>" data-bs-target="#modalEditar">
                                                            <i class="bi bi-pencil-square"></i>
                                                           Editar
                                                        </a>
  
                                                        <a data-id="<?php echo $id;?>" class=" eliminar dropdown-item text-red">
                                                            <i class="bi bi-eraser"></i>    
                                                            Eliminar
                                                        </a>

                                                        <a id="btn_descargar_doc" class="dropdown-item" href="http://localhost/Proyecto/Git/JuntaCartago/js/<?php echo $nombre_archivo; ?>">
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

    <!--Modal Editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Cita</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modal_ajax">
                    
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