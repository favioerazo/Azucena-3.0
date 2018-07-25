<?php
session_start();

//$password = $_POST['pass'];
require_once ('conexion.php');
$tbl_name = "sist_usuarios";
/*
$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "controlac";
$tbl_name = "tbl_usuarios";

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}*/

$username = $_POST['usuario'];
$password = $_POST['pass'];
 
$sql = "SELECT * FROM $tbl_name WHERE c_usuario = '$username'";
//echo "$sql";
if(!$db->conectar()){exit;
    
  }else 
  {
    //echo "No Se conecto";
  

    $result = $db->conexion->query($sql);


    if ($result->num_rows > 0) {     
     }
     $row = $result->fetch_array(MYSQLI_ASSOC);
     //echo "$password";
     //echo("Verificacion >>".password_verify($password, "abc")." >>");
     if (strcmp($password,$row['d_pass'])==0) { 
     
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = strtoupper($username).",".$row['d_usuario'];
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (3600);

        //echo "Bienvenido! " . $_SESSION['username'];
        //echo "Bienvenido! ";
       // echo "<br><br><a href=panel-control.php>Panel de Control</a>"; 
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../gui/index.php'>";

     } else { 
       echo "Username o Password estan incorrectos.";

       //echo "<br><a href='index.php'>Volver a Intentarlo</a>";
       echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../index.php?msg=Usuario o Contraseña Incorrectos'>";
     }
  } 
    $db->desconectar();
 ?>