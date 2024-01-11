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
    <script src="../../js/activos.js"></script>
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
                                        <li><a href="index.php" class="items">Control de activos</a></li>
                                        <li><a href="listado.php" class="items">Listado de activos</a></li>
                                        <li><a href="registro.php" class="items">Agregar activo</a></li>
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
                                        <li><a href="../Productos_Limpieza/index.php" class="items">Control de productos de limpieza</a></li>
                                        <li><a href="../Productos_Limpieza/listado.php" class="items">Listado de productos de limpieza</a></li>
                                        <li><a href="../Productos_Limpieza/registro.php" class="items">Agregar producto</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link d-flex align-items-center gap-2" href="../../Documentos/control.php">
                                    <i class=" bi bi-folder-check"></i>Control De Archivos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link d-flex align-items-center gap-2" href="../../Vacaciones/listado_vacaciones.php">
                                    <i class=" bi bi-search"></i>Solicitudes de Vacaciones
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div id="alerta_eliminar">
                </div>
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
                                            <img src="../../<?php echo $Imagen; ?>" alt="Image" class="img-fluid">
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
                                                    <!-- Button trigger modal -->
                                                    <button type="button"  
                                                        data-bs-toggle="modal" data-bs-target="#modal_nota_activo_<?php echo $id; ?>" id="btn_agregar_nota_activo" data-id="<?php echo $id;?>">
                                                        <i class="m-1 bi bi-card-checklist"></i>Añadir Nota
                                                    </button>
                                                </div>
                                            </div>
                                            <div>
                                                <a data-id="<?php echo $id;?>" class="eliminar btn btn-danger">
                                                    <i class="bi bi-eraser"></i>Eliminar
                                                </a>
                                                <a style="color: #ffffff; background-color: #001F3F;" id="btn_editar_doc" class="btn ms-auto" data-bs-toggle="modal" data_id="<?php echo $id;?>" data-bs-target="#modalEditar">
                                                    <i class="bi bi-pencil-square"></i>Editar
                                                </a>
                                                
                                            </div>
                                        </div>     
                                    </div>
                                </div>
                                <!-- Modal Nota-->
                                <div class="modal fade" id="modal_nota_activo_<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Nota</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div id="alerta_nota_<?php echo $id; ?>">
                                            </div>
                                            <form class="form_limpieza nota_activo_form" id="nota_activo_form_<?php echo $id; ?>" data-id="<?php echo $id;?>">
                                                <div class="modal-body">
                                                    
                                                    <label for="Nombre">Mensaje</label>
                                                        <textarea class="form-control" name="message_activo" id="message_activo_<?php echo $id; ?>" rows="3" placeholder="Ingrese su mensaje"></textarea>
                                                    <br>
                                                    
                                                    <div class="modal-footer">
                                                        <input type="submit" name="action" id="action" class="btn btn-success" value="Guardar" >
                                                    </div>
                                                </div>    
                                            </form>    
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