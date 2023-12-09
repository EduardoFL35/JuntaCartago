<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "junta_cartago_centro";

$conn = new mysqli($servername,$username,$password,$database);

if($conn->connect_error){
    die("Error de conexion");
}