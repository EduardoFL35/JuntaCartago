<?php require "../config.php";
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
    <title>Página de Inicio - Junta De Cartago</title>
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

    <div class="container my-4">
        <div id="alerta_registro">
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registro de Documentos</h3>  
            </div>
            <div class="card-body">

                <form id="documento_form">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label">Nombre</label>
                            <div>
                                <input type="text" class="form-control" placeholder="Nombre" id="nombre_doc" name="nombre_doc">
                            </div>
                        </div>
                    
                        <div class="col-sm-6">
                            <label class="form-label">Fecha de Ingreso</label>
                            <div>
                                <input type="date" name="fecha_doc" id="fecha_doc" class="form-control" placeholder="Fecha de Ingreso">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label">Tipo de Documento</label>
                            <div>
                                <select name="tipo_doc" id="tipo_doc" class="form-control" placeholder="Tipo de Documento">
                                    <option value="1">Acta</option>
                                    <option value="2">Contrato</option>
                                    <option value="3">Adjudicación</option>
                                    <option value="4">Oficio</option>
                                    <option value="5">Expediente</option>
                                    <option value="6">Orden de Compra</option>
                                    <option value="7">Planilla</option>
                                    <option value="8">Cheque</option>
                                </select>
                            </div>
                        </div>
                            
                        <div class="col-sm-6">
                            <label class="form-label">Descripción</label>
                            <div>
                                <textarea class="form-control" name="desc_doc" id="desc_doc" rows="2" placeholder="Descripción"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="archivo" class="form-label">Cargar Documento</label>
                        <input type="file" name="archivo" class="form-control form-control-file" id="archivo">
                        <input type="hidden" id="nombre_archivo">
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