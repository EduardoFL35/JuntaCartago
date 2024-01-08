<?php require "../config.php";
session_start();
if (!isset($_SESSION["username"])) { //SI LA VARIABLE NO ESTÁ DEFINIDA
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location: http://$host/Proyecto/Git/JuntaCartago/login");// sino mandelo hacia acá
}

$query = $conn->query("select * from documento order by fecha_ingreso desc limit 3;");
//echo "<a id='cerrar'>".$_SESSION["nombre"]." ".$_SESSION["apellido"]." </a>";
?>
<!doctype html>
<html lang="es" data-bs-theme="auto">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - Junta De Cartago</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/inventario.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="../js/graficos.js"></script>
    <script src="../js/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!--Fuente-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Georgia+Pro&family=Roboto:wght@400&display=swap">
</head>
<body data-bs-theme="light">
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
              <a class="nav-link" href="../Documentos/registro.php">
                  <i class="m-2 bi bi-file-earmark-arrow-down"></i>Documentos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../Documentos/listado.php">
                  <i class="m-2 bi bi-search"></i>Búsqueda de Documentos
              </a>
            </li>
            <?php if ($_SESSION["rol"] == 1) {
              ?><li class="nav-item">
                    <a class="nav-link" href="../Documentos/control.php">
                        <i class="m-2 bi bi-folder-check"></i>Control de Archivos
                    </a>
                </li>
            <?php
            } ?>
            <?php if ($_SESSION["rol"] == 1) {
              ?><li class="nav-item">
                      <a class="nav-link" href="index.php">
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
                  <li><a href="./Activos/index.php" class="items">Control de activos</a></li>
                    <li><a href="./Activos/listado.php" class="items">Listado de activos</a></li>
                    <li><a href="./Activos/registro.php" class="items">Agregar activo</a></li>
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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1>Panel de Control</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
              <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
              <svg class="bi"><use xlink:href="#calendar3"/></svg>
              This week
            </button>
          </div>
        </div>

        <table class="columns">
            <tr>
                <td><div class="prueba m-2 rounded-3" id="activos_chart"></div></td>
                <td><div class="prueba m-2 rounded-3" id="garantia_chart" ></div></td>
            </tr>
            <tr>
            <td><div class="prueba m-2 rounded-3" id="limpieza_chart"></td> 
            </tr>
        </table>
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
