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
    <title>Registro de Activos - Junta De Cartago</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/activos.css">
    <link rel="stylesheet" href="../../css/inventario.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../../js/activos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!--Fuente-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Georgia+Pro&family=Roboto:wght@400&display=swap">
</head>
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
                        </ul>
                    </div>
                </div>
            </div>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3 ">
                    <div class="border-bottom">
                        <H1>Nuevo Activo</H1>
                    </div>
                </div>
                <div class="container my-4">
                    <div id="alerta_registro">
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Registro de Activos</h3>  
                        </div>
                        <div class="card-body">
                            <form id="activo_form">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="form-label">Código</label>
                                        <div>
                                            <input type="text" class="form-control" placeholder="Código" id="codigo_activo" name="codigo_activo">
                                        </div>
                                    </div>
                                
                                    <div class="col-sm-6">
                                        <label class="form-label">Nombre</label>
                                        <div>
                                            <input type="text" class="form-control" placeholder="Nombre" id="nombre_activo" name="nombre_activo">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="form-label">Descripción</label>
                                        <div>
                                            <textarea class="form-control" name="desc_activo" id="desc_activo" rows="2" placeholder="Descripción"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="archivo" class="form-label">Monto</label>
                                        <input type="number" class="form-control" value="0" name="monto_activo" id="monto_activo" placeholder="Monto Total"/>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="archivo" class="form-label">Cantidad</label>
                                        <input type="number" class="form-control" value="0" name="cantidad_activo" id="cantidad_activo" placeholder="Cantidad Total"/>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="archivo" class="form-label">Cantidad Mínima</label>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Cantidad Mínima del Activo">
                                            <i class="bi bi-question-circle"></i>
                                        </span>
                                        <input type="number" class="form-control" value="0" name="cantidad_minima_activo" id="cantidad_minima_activo" placeholder="Cantidad Mínima del Activo"/>
                                    </div>
                                </div>
                                <br> 
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="factura_activo" class="form-label">Cargar Factura</label>
                                        <input type="file" name="factura_activo" class="form-control form-control-file" id="factura_activo">
                                        <input type="hidden" id="nombre_factura">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="imagen_activo" class="form-label">Cargar Imagen</label>
                                        <input type="file" name="imagen_activo" class="form-control form-control-file" id="imagen_activo">
                                        <input type="hidden" id="nombre_imagen">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="form-label">Fecha de inicio de la garantía</label>
                                        <div>
                                            <input type="date" name="fecha_inicio_activo" id="fecha_inicio_activo" class="form-control" placeholder="Fecha de inicio de la garantía">
                                        </div>
                                    </div>   
                                    <div class="col-sm-6">
                                        <label class="form-label">Fecha de final de la garantía</label>
                                        <div>
                                            <input type="date" name="fecha_final_activo" id="fecha_final_activo" class="form-control" placeholder="Fecha de final de la garantía">
                                        </div>
                                    </div>  
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="form-label">Estado</label>
                                        <div>
                                            <select name="estado_activo" id="estado_activo" class="form-select" placeholder="Estado">
                                                <option value="1">Nuevo</option>
                                                <option value="2">Agotado</option>
                                                <option value="3">Dañado</option>
                                                <option value="4">En reparación</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Color</label>
                                        <div>
                                            <select name="color_activo" id="color_activo" class="form-select" placeholder="Color">
                                                <option value="1">Negro</option>
                                                <option value="2">Blanco</option>
                                                <option value="3">Azul</option>
                                                <option value="4">Café</option>
                                                <option value="5">Verde</option>
                                                <option value="6">Rojo</option>
                                                <option value="7">Gris</option>
                                                <option value="8">Celeste</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="form-label">Nota</label>
                                        <div>
                                            <textarea class="form-control" name="nota_activo" id="nota_activo" rows="2" placeholder="Nota"></textarea>
                                        </div>
                                    </div>
                                </div> 
                                <br>
                                <div class="form-footer">
                                    <div class="text-end">
                                        <div class="d-flex">
                                            <a href="../../Inventario/index.php" class="btn btn-danger">Volver atrás</a>
                                            <button id="action" type="submit" style="color: #ffffff; background-color: #001F3F;" class="btn ms-auto">Guardar</button>
                                        </div>
                                    </div>
                                </div>           
                            </form>                                    
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>
</body>
</html>