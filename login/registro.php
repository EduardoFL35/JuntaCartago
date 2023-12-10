<?php require "../config.php"; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Junta De Cartago</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!--Fuente -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Georgia+Pro&family=Roboto:wght@400&display=swap">
</head>
<body class="fondo-login">
    <div style="max-width: 30rem;" class="container my-5">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center card-title">Registro</h3>  
            </div>
            <div class="card-body">
                <form id="registro_usr">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label">Nombre</label>
                            <div>
                                <input type="text" class="form-control" id="nombre_usr" name="nombre_usr" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Apellidos</label>
                            <div>
                                <input type="text" class="form-control" id="apellido_usr" name="apellido_usr" placeholder="Apellidos">
                            </div>
                        </div>
                    </div>
                    <br>                  
                    <div class="">
                        <label class="form-label">Cédula</label>
                        <div>
                            <input type="text" class="form-control" id="cedula_usr" name="cedula_usr" placeholder="Introduce tu número de cédula">
                        </div>
                    </div>
                    <br>                  
                    <div class="">
                        <label class="form-label">Correo</label>
                        <div>
                            <input type="email" class="form-control" id="correo_usr" name="correo_usr" placeholder="Introduce tu correo electrónico">
                        </div>
                    </div>
                    <br>
                    <div class="">
                        <label class="form-label">Contraseña</label>
                        <div>
                            <input type="password" class="form-control" id="password_usr" name="password_usr" placeholder="Tu Contraseña">
                        </div>
                    </div>
                    <br>
                    <div class=" text-center form-footer">
                        <button type="submit" style="color: #ffffff; background-color: #001F3F;" class="btn ">Registrarme</button>
                    </div> 
                    <div id="res_registro">
                        
                    </div>         
                    
                </form> 
                                                   
            </div>  
        </div>
    </div>
</body>
</html>