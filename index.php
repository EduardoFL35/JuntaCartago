<?php require "config.php";
session_start();
if (!isset($_SESSION["username"])) { //SI LA VARIABLE NO ESTÁ DEFINIDA
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location: http://$host/Proyecto/Git/JuntaCartago/login");// sino mandelo hacia acá
}

$query = $conn->query("select * from documento order by fecha_ingreso desc limit 3;");
//echo "<a id='cerrar'>".$_SESSION["nombre"]." ".$_SESSION["apellido"]." </a>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Junta De Cartago</title>
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./js/script.js"></script>
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
            <a href="index.php">
                <img src="img/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">
                            <i class="m-2 bi bi-house"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Documentos/registro.php">
                            <i class="m-2 bi bi-file-earmark-arrow-down"></i>Documentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Documentos/listado.php">
                            <i class="m-2 bi bi-search"></i>Búsqueda de Documentos
                        </a>
                    </li>
                    <?php if ($_SESSION["rol"] == 1) {
                        ?><li class="nav-item">
                                <a class="nav-link" href="Documentos/control.php">
                                    <i class="m-2 bi bi-folder-check"></i>Control de Archivos
                                </a>
                            </li>
                    <?php
                    } ?>
                    <?php if ($_SESSION["rol"] == 1) {
                        ?><li class="nav-item">
                                <a class="nav-link" href="Inventario/index.php">
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

    <div class="p-5">
        <div class="page-header">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Bienvenido,
                        </div>
                        <h2 class="page-title">
                            <?php echo $_SESSION["nombre"]." ".$_SESSION["apellido"];?>
                        </h2>
                        <p>En esta plataforma, puedes acceder y gestionar documentos importantes para la Junta De Educación de Cartago, como actas, contratos, etc.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">Documentos Recientes</h5>
                                <?php

                                if($query->num_rows > 0){
                                while ($row = $query->fetch_assoc()){
                                    $nombre = $row['nombre'];
                                    $fecha_ingreso = $row['fecha_ingreso'];
                                    ?>
                                <ul class="list-group">
                                    <li class="list-group-item my-2 p-2"><a><?php echo $nombre; ?></a></li>
                                </ul>
                                <?php
                                    }
                                } else {
                                    echo "No hay registros.<br>";
                                }
                                ?>
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
    
    </div>

<!-- Enlace al archivo JS de Popper.js (puedes utilizar un CDN o descargarlo localmente) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<!-- Enlace al archivo JS de Bootstrap (opcional, pero necesario para algunos componentes interactivos) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>