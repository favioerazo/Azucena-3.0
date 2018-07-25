<?php
  require_once ('../core/conexion.php');
//$valor_php=$_GET["action"];
  session_start();
  /*echo "<br> ".$_POST['usuario'];
  echo "<br> ".$_POST['nombre'];
  echo "<br> ".$_POST['correo'];
  echo "<br> ".$_POST['pass'];*/
   
  //$password = $_POST['pass'];


 /* $host_db = "localhost";
  $user_db = "root";
  $pass_db = "";
  $db_name = "controlac";*/
  $tbl_name = "sist_usuarios";

  /*$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

  if ($conexion->connect_error) {
   die("La conexion falló: " . $conexion->connect_error);
  }*/

  $username= $_POST['usuario'];
  $sql = "SELECT * FROM $tbl_name WHERE c_usuario = '$username' or d_correo= '".$_POST['correo']."'";

  if(!$db->conectar()){
    exit;//echo "Se conecto";
  }else 
  {
    $result = $db->conexion->query($sql);


    if ($result->num_rows > 0) {     
     
     $row = $result->fetch_array(MYSQLI_ASSOC);
        //echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=dashboard.php'>";
        //echo "<br> El usuario existe en la base de datos";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../gui/GUI.usuarios.ingreso.php?msg=EL usuario ".strtoupper($username)." Existe en la Base de datos.&alert=danger'>";
     } else { 
       //echo "Username o Password estan incorrectos.";
      //echo "<br> El usuario NO existe en la base de datos";
       //echo "<br><a href='index.php'>Volver a Intentarlo</a>";    
     $sql = "INSERT INTO sist_usuarios Values ('".strtoupper($_POST['usuario'])."','".strtoupper($_POST['nombre'])."','".$_POST['correo']."','".$_POST['pass']."',1)";
     //echo "<br> $sql";
     //$result = $conexion->query($sql);
    $db->conexion->query($sql);
    $db->desconectar();
      echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../gui/GUI.usuarios.ingreso.php?msg=El usuario ".strtoupper($username)." se ha creado Exitosamente!&alert=success'>";
     }
   }
     /*echo "
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.5/bootstrap-notify.min.js'></script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.5/bootstrap-notify.min.js'></script>
  ";
     echo "<script>
      function miFuncion() {
         $.notify({
        title: '<strong>Titulo</strong>',
        icon: 'glyphicon glyphicon-user',
        message: 'Presionado!'
      },{
        type: 'warning',
        animate: {
          enter: 'animated fadeInUp',
          exit: 'animated fadeOutRight'
        },
        placement: {
          from: 'bottom',
          align: 'left'
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
      });
      }
      
      //window.onload=miFuncion;
      </script>";
  echo '<script language="javascript">

    <?php
    echo "ghfdhdfh";
  ?>

  </script>';*/
      

      //echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=GUI.usuarios.ingreso.php?action=1'>";
      //echo "nombre: ".$_GET["nombre"];
 ?>