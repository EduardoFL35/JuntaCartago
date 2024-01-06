<?php require "../../config.php";
session_start();
if (!isset($_SESSION["username"])) { //SI LA VARIABLE NO ESTÁ DEFINIDA
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location: http://$host/Proyecto/Git/JuntaCartago/login");// sino mandelo hacia acá
}

$query = $conn->query("select * from activo where status = 1"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activos - Junta De Cartago</title>
    <link rel="stylesheet" href="../../css/activos.css">
    <link rel="stylesheet" href="../../css/inventario.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../js/script.js"></script>
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
                                <a class="nav-link d-flex align-items-center gap-2 active" href="index.php">
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
                                        <li><a href="index.php" class="items">Control de activos</a></li>
                                        <li><a href="listado.php" class="items">Listado de activos</a></li>
                                        <li><a href="registro.php" class="items">Agregar activo</a></li>
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
                                <a class="nav-link d-flex align-items-center gap-2" href="./Productos_Limpieza/index.php">
                                    <i class="bi bi-wrench"></i>
                                    Productos de Limpieza
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3 ">
                    <div class="border-bottom">
                        <H1>Listado de Activos</H1>
                    </div>
                </div>
                <div class="site-section bg-light">
                    <div class="container">
                        <div class="row">
                            <?php

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
                                        $Estado = $row['estado_id'];
                                        $Factura = $row['factura'];
                                        $Nota = $row['nota'];
                                        $Fecha_Compra = $row['fecha_inicio'];
                                        $Fecha_Finalizacion = $row['fecha_finalizacion'];

                                        $Total = $Cantidad * $Precio;
                                        $Fecha_Compra_formateada = date("d/m/Y", strtotime($Fecha_Compra));
                                        $Fecha_Finalizacion_formateada = date("d/m/Y", strtotime($Fecha_Finalizacion));
                                        

                                        $colores = $conn->query("select * from colores where id = ".$Color."");
                                        if ($colores->num_rows > 0) {
                                            while ($row2 = $colores->fetch_assoc()){
                                                $nombre_color = $row2['nombre'];
                                            }
                                        }
                                        $estados = $conn->query("select * from estado_activo where id = ".$Estado."");
                                    
                                        if ($estados->num_rows > 0) {
                                            while ($row3 = $estados->fetch_assoc()){
                                                $nombre_estado = $row3['nombre'];
                                            }
                                        }

                                        $garantias = $conn->query("select * from garantia where id = ".$id."");
                                        if ($garantias->num_rows > 0) {
                                            while ($row4 = $garantias->fetch_assoc()){
                                                $garantia = $row4['garantia'];   
                                            }
                                        }
                                ?>

                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="listing d-block  align-items-stretch">
                                        <div class="listing-img h-100 mr-4">
                                            <img src="../../img/activo_Computadora_Oficina.jpg" alt="Image" class="img-fluid">
                                        </div>
                                        <div class="listing-contents h-100">
                                            <h3><?php echo $Nombre; ?></h3>
                                            <div class="rent-price">
                                                <strong><?php echo $Codigo; ?></strong><span class="mx-1"></span><?php echo $Descripción; ?>
                                            </div>
                                            <div class="d-block d-md-flex mb-3 ">
                                                <div class="listing-feature pr-4 m-1">
                                                    <span class="caption">Fecha de Compra:</span>
                                                    <br>
                                                    <span class="horario"><?php echo $Fecha_Compra_formateada; ?></span>
                                                </div>
                                                <div class="listing-feature pr-4 m-1">
                                                    <span class="caption">Fin de Garantía: </span>
                                                    <br>
                                                    <span class="horario"><?php echo $Fecha_Finalizacion_formateada; ?></span>
                                                </div>
                                                <div class="listing-feature pr-4 m-1">
                                                    <span class="caption">Días en Garantía: </span>
                                                    <br>
                                                    <span style="color: #dc3545;"><?php echo $garantia; ?></span>
                                                </div>
                                                
                                            </div>
                                            <div class="d-block d-md-flex mb-3 ">
                                                <div class="listing-feature pr-4 m-1">
                                                    <span class="caption">Cantidad: </span>
                                                    <br>
                                                    <span class="horario"><?php echo $Cantidad; ?></span>
                                                </div>
                                                <div class="listing-feature pr-4 m-1">
                                                    <span class="caption">Precio/Unidad: </span>
                                                    <br>
                                                    <span class="horario">&#8353;<?php echo $Precio; ?></span>
                                                </div>
                                                <div class="listing-feature pr-4 m-1">
                                                    <span class="caption">Total: </span>
                                                    <br>
                                                    <span class="horario">&#8353;<?php echo $Total; ?></span>
                                                </div>
                                            </div>
                                            <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                                                <div class="listing-feature pr-4 m-1">
                                                    <span class="caption">Color:</span>
                                                    <br>
                                                    <span class="horario"><?php echo $nombre_color; ?></span>
                                                </div>
                                                <div class="listing-feature pr-4 m-1">
                                                    <span class="caption">Estado:</span>
                                                    <br>
                                                    <span class="horario"><?php echo $nombre_estado; ?></span>
                                                    
                                                </div>
                                                <div class="listing-feature pr-4 m-1">
                                                    <button id="agregar_nota" href=""><i class="m-1 bi bi-card-checklist"></i>Añadir Nota</button>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="#" class="btn btn-danger">Eliminar</a>
                                                <a href="#" style="color: #ffffff; background-color: #001F3F;" class="btn ms-auto">Editar</a>
                                            </div>
                                        </div>     
                                    </div>
                                </div>
                                <?php
                                    }
                                } else {
                                    echo "No hay registros.<br>";
                                }
                            ?>
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