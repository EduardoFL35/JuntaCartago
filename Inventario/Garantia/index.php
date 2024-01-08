<?php require "../../config.php";
session_start();
if (!isset($_SESSION["username"])) { //SI LA VARIABLE NO ESTÁ DEFINIDA
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location: http://$host/Proyecto/Git/JuntaCartago/login");// sino mandelo hacia acá
}

$query = $conn->query("select * from garantia where estado = 1"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activos - Junta De Cartago</title>
    <link rel="stylesheet" href="../../css/activos.css">
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/inventario.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../js/script.js"></script>
    <script src="../../js/garantia.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!--Fuente-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Georgia+Pro&family=Roboto:wght@400&display=swap">
</head>
<body>
    <nav class="border-bottom border-2 navbar navbar-expand-lg nav-fondo">
        <div class="container-fluid">
            <a href="index.php">
                <img src="../../img/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">
                            <i class="m-2 bi bi-house"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Documentos/registro.php">
                            <i class="m-2 bi bi-file-earmark-arrow-down"></i>Documentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Documentos/listado.php">
                            <i class="m-2 bi bi-search"></i>Búsqueda de Documentos
                        </a>
                    </li>
                    <?php if ($_SESSION["rol"] == 1) {
                        ?><li class="nav-item">
                                <a class="nav-link" href="./Documentos/control.php">
                                    <i class="m-2 bi bi-folder-check"></i>Control de Archivos
                                </a>
                            </li>
                    <?php
                    } ?>
                    <?php if ($_SESSION["rol"] == 1) {
                        ?><li class="nav-item">
                                <a class="nav-link" href="./Inventario/index.php">
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
                                <a class="nav-link d-flex align-items-center gap-2 active" href="../index.php">
                                    <i class="bi bi-house-fill"></i>
                                    Panel de Control
                                </a>
                            </li>
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
                                <a class="nav-link d-flex align-items-center gap-2" href="./Garantia/index.php">
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
                                        <li><a href="../Productos_Limpieza/index.php" class="items">Control de productos de limpieza</a></li>
                                        <li><a href="../Productos_Limpieza/listado.php" class="items">Listado de productos de limpieza</a></li>
                                        <li><a href="../Productos_Limpieza/registro.php" class="items">Agregar producto</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="row pt-3 pb-2 mb-3 g-2 align-items-center border-bottom">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Listado de la garantía de los activos
                        </div>
                        <h2 class="page-title">
                            Control de Garantía
                        </h2>
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
                                                    <th class="th-list">Código</th>
                                                    <th class="th-list">Nombre</th>
                                                    <th class="th-list">Descripción</th>
                                                    <th class="th-list">Días en Garantía</th>
                                                    <th class="th-list">Fecha Inicio</th>
                                                    <th class="th-list">Fecha Finalización</th>
                                                    <th class="th-list">Factura</th>
                                                    <th class="th-list"></th>
                                                </tr>
                                            </thead>
                                            <?php
                                                if($query->num_rows > 0){
                                                    while ($row = $query->fetch_assoc()){
                                                        $id = $row['id'];
                                                        $id_activo = $row['id_activo'];
                                                        $garantia = $row['garantia'];
                                                        
                                                        
                                                        $garantias = $conn->query("select * from activo where id = ".$id_activo."");
                                                    if ($garantias->num_rows > 0) {
                                                        while ($row2 = $garantias->fetch_assoc()){
                                                            $codigo = $row2['codigo'];
                                                            $nombre = $row2['nombre'];
                                                            $descripcion = $row2['descripcion'];
                                                            $Factura = $row2['factura'];
                                                            $fecha_inicio = $row2['fecha_inicio'];
                                                            $fecha_finalizacion = $row2['fecha_finalizacion'];
                                                            $Fecha_Compra_formateada = date("d/m/Y", strtotime($fecha_inicio));
                                                            $Fecha_Finalizacion_formateada = date("d/m/Y", strtotime($fecha_finalizacion));
                                                            
                                                            
                                                        }
                                                    }
                                                    
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td class="td-list"><?php echo $codigo; ?></td>
                                                    <td class="td-list"><?php echo $nombre; ?></td>
                                                    <td class="td-list"><?php echo $descripcion; ?></td>
                                                    <td class="td-list"><?php echo $garantia; ?></td>
                                                    <td class="td-list"><?php echo $Fecha_Compra_formateada; ?></td>
                                                    <td class="td-list"><?php echo $Fecha_Finalizacion_formateada; ?></td>
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

                                                                    <a id="btn_descargar_doc" class="dropdown-item" href="#">
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
            </main>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>