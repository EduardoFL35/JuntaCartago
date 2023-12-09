<?php
session_start();//Siempre va de primero
include "../config.php";

if($_POST['key'] == "login"){
    $cedula = $_POST['username'];//Nombre del valor que le puse en el js
    $password = md5($_POST['password']);
    

    $verificar = 'SELECT * FROM usuario WHERE cedula = "'.$cedula.'" and password = "'.$password.'" and estado = 1 ';
    $result = $conn->query($verificar);

  if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()){
            $_SESSION["id_user"] = $row['id'];
            $_SESSION["username"] = $row['cedula'];
            $_SESSION["correo"] =$row['correo'];
            $_SESSION["nombre"] =$row['name'];
            $_SESSION["apellido"] =$row['apellido'];
            
        }
        echo "1";//Success
    } else {
        $_SESSION["error_login"] = "Usuario no encontrado";
        echo "a";//Error
    }
    
    $conn->close();
  
}elseif ($_POST['key'] == "cerrar_sesion") {
    if (isset($_SESSION["username"])) { //SI LA VARIABLE ESTÁ DEFINIDA
        $_SESSION = array();
        session_destroy();//función de php que destruye la session
        echo "1";
    }
}
?>