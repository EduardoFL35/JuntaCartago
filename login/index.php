<?php
session_start();
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if (isset($_SESSION["username"])) { //SI LA VARIABLE ESTÁ DEFINIDA
    header("location: http://$host/Proyecto/Git/JuntaCartago/");// sino mandelo hacia acá
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Documentos - Junta De Cartago</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script src="../js/passw.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!--Fuente-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Georgia+Pro&family=Roboto:wght@400&display=swap">
</head>
</head>
<body class="fondo-login">
    <div style="max-width: 30rem;" class="container py-4">
        <div class="card card-md mb-1 mt-5">
            <div class="card-body">
            <img src="../img/logo.svg" width="200" height="200" alt="" style="display: block; margin-left: auto; margin-right: auto;">
                <h2 class="h2 text-center mb-4">Bienvenido de Vuelta!</h2>

                <form id="login_form">
                    <div class="mb-3">
                        <label class="form-label">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" placeholder="1-1111-1111">
                    </div>
                    <div class="mb-2">
                        <div class="input-group input-group-flat">
                            <input type="password" name="password" id="password"class="form-control" placeholder="Tu Contraseña">
                            <span class="input-group-text">
                                <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </span>
                        </div>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-dark w-100">Iniciar Sesión</button>
                    </div>
                    <div id="res_ajax">

                    </div>
                </form>
            </div>
        </div>
    </div>


</body>
</html>