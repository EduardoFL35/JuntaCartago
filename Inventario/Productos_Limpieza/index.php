<?php require "../../config.php";
session_start();
if (!isset($_SESSION["username"])) { //SI LA VARIABLE NO ESTÁ DEFINIDA
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location: http://$host/Proyecto/Git/JuntaCartago/login");// sino mandelo hacia acá
}

$query = $conn->query("select * from producto_limpieza where status = 1"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos de Limpieza - Junta De Cartago</title>
    <link rel="stylesheet" href="../../css/activos.css">
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/inventario.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../js/script.js"></script>
    <script src="../../js/prod_limpieza.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!--Fuente-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Georgia+Pro&family=Roboto:wght@400&display=swap">
</head>
<body>
    <nav class="border-bottom border-2 navbar navbar-expand-lg nav-fondo">
        <div class="container-fluid">
            <a href="../../index.php">
                <img src="../../img/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../../index.php">
                            <i class="m-2 bi bi-house"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../Documentos/registro.php">
                            <i class="m-2 bi bi-file-earmark-arrow-down"></i>Documentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../Documentos/listado.php">
                            <i class="m-2 bi bi-search"></i>Búsqueda de Documentos
                        </a>
                    </li>
                    <?php if ($_SESSION["rol"] == 1) {
                    ?><li class="nav-item">
                            <a class="nav-link" href="../../Documentos/control.php">
                                <i class="m-2 bi bi-folder-check"></i>Control de Archivos
                            </a>
                        </li>
                    <?php
                    } ?>
                    <?php if ($_SESSION["rol"] == 1) {
                    ?><li class="nav-item">
                            <a class="nav-link" href="../index.php">
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
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
                <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="true">
                                    <i class="bi bi-box-seam"></i>Activos
                                </a>
                                <div class="collapse" id="dashboard-collapse">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                        <li><a href="../Activos/index.php" class="items">Control de activos</a></li>
                                        <li><a href="../Activos/listado.php" class="items">Listado de activos</a></li>
                                        <li><a href="../Activos/registro.php" class="items">Agregar activo</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="../Garantia/index.php">
                                    <i class="bi bi-hourglass-split"></i>
                                    Garantía
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#Limpieza" aria-expanded="true">
                                    <i class="bi bi-wrench"></i>Productos de Limpieza
                                </a>
                                <div class="collapse" id="Limpieza">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                        <li><a href="index.php" class="items">Control de productos de limpieza</a></li>
                                        <li><a href="listado.php" class="items">Listado de productos de limpieza</a></li>
                                        <li><a href="registro.php" class="items">Agregar producto</a></li>
                                    </ul>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div id="alerta_eliminar">
                </div>
                <div class="row pt-3 pb-2 mb-3 g-2 align-items-center border-bottom">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Listado de productos de limpieza
                        </div>
                        <h2 class="page-title">
                            Control de Productos de Limpieza
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
                                Agregar Activo
                            </a>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="container-xl">
                        <div class="row row-deck row-cards">
                            <div class="col-12">
                                <div class="card">
                                    <div class="table-responsive min-vh-75">
                                        <table class="table card-table table-vcenter text-nowrap datatable">
                                            <thead class="table-secondary ">
                                                <tr>
                                                    <th class="th-list">#</th>
                                                    <th class="th-list">Nombre</th>
                                                    <th class="th-list">Descripción</th>
                                                    <th class="th-list">Imagen</th>
                                                    <th class="th-list">Precio/Unidad</th>
                                                    <th class="th-list">Cantidad</th>
                                                    <th class="th-list">Cantidad Mínima</th> 
                                                    <th class="th-list">Factura</th>
                                                    <th class="th-list"></th>
                                                </tr>
                                            </thead>

                                            <?php

                                                if($query->num_rows > 0){
                                                while ($row = $query->fetch_assoc()){
                                                    $id = $row['id'];
                                                    $Nombre = $row['nombre'];
                                                    $Descripcion = $row['descripcion']; 
                                                    $Precio = $row['precio']; 
                                                    $Cantidad = $row['cantidad'];
                                                    $Cantidad_Minima = $row['cantidad_minima'];
                                                    $Imagen = $row['imagen'];
                                                    $Factura = $row['factura'];
                                                   
                                                    
                                                    
                                                ?>
                                            <tbody>
                                                <tr>
                                                    <td class="td-list"><?php echo $id; ?></td>
                                                    <td class="td-list"><?php echo $Nombre; ?></td>
                                                    <td class="td-list"><?php echo $Descripcion; ?></td>
                                                    <td class="td-list"><img src="../../img/producto_pastilla.webp" width="100"></td>
                                                    <td class="td-list">&#8353;<?php echo $Precio; ?></td>
                                                    <td class="td-list"><?php echo $Cantidad; ?></td>
                                                    <td class="td-list"><?php echo $Cantidad_Minima; ?></td>
                                                    <td class="td-list"><a class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                                                            href="http://localhost/Proyecto/Git/JuntaCartago/js/<?php echo $Factura; ?>">Ver Factura</a></td>
                                                    <td class="td-list">
                                                        <div class="btn-list flex-nowrap">
                                                            <div class="dropdown">
                                                                <a class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                                    Opciones
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a id="btn_editar_doc" class="dropdown-item" data-bs-toggle="modal" data_id="<?php echo $id;?>" data-bs-target="#modalEditar">
                                                                        <i class="bi bi-pencil-square"></i>
                                                                    Editar
                                                                    </a>
                                                                    <a data-id="<?php echo $id;?>" class=" eliminar dropdown-item text-red">
                                                                        <i class="bi bi-eraser"></i>    
                                                                        Eliminar
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
            </main>
        </div>
    </div>

<footer class="mt-5 py-3 bg-light">
    <div class="container text-center">
        <p>&copy; 2023 Junta De Cartago Centro. Todos los derechos reservados.</p>
    </div>
</footer>
<!-- Enlace al archivo JS de Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<!-- Enlace al archivo JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>