<?php
//$valor_php=$_GET["action"];
  session_start();
  $datos=explode(",",$_SESSION['username']);

  echo "<br> ".$_POST['aula'];
  echo "<br> ".$_POST['descripcion'];
  echo "<br> ".$_POST['piso'];
  echo "<br> ".$_POST['red'];
   
  //$password = $_POST['pass'];


  $host_db = "localhost";
  $user_db = "root";
  $pass_db = "";
  $db_name = "controlac";
  $tbl_name = "tbl_usuarios";

  $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

  if ($conexion->connect_error) {
   die("La conexion falló: " . $conexion->connect_error);
  }

  //$username= $_POST['usuario'];
 // $sql = "SELECT * FROM $tbl_name WHERE c_usuario = '$username' or d_correo= '".$_POST['correo']."'";
  //$result = $conexion->query($sql);


  //if ($result->num_rows > 0) {     
   
   //$row = $result->fetch_array(MYSQLI_ASSOC);
      //echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=dashboard.php'>";
     // echo "<br> El usuario existe en la base de datos";
     // echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=GUI.usuarios.ingreso.php'>";
   //} else { 
     //echo "Username o Password estan incorrectos.";
    //echo "<br> El usuario NO existe en la base de datos";
     //echo "<br><a href='index.php'>Volver a Intentarlo</a>";    
   //$sql = "INSERT INTO tbl_usuarios Values ('".strtoupper($_POST['usuario'])."','".strtoupper($_POST['nombre'])."','".$_POST['correo']."','".$_POST['pass']."',1)";
   $insert1 =strtoupper("INSERT INTO TBL_AC_LISTADO VALUES ('".($_POST['piso']."".$_POST['aula'])."','".$_POST['descripcion']."','".$_POST['aula']."','".$_POST['piso']."','".$_POST['red']."',NOW(),'".$datos[0]."','1')");
   echo "<br> $insert1";

   $insert2 = strtoupper("INSERT INTO TBL_AC_ESTADO VALUES ('".($_POST['piso']."".$_POST['aula'])."','0','".$datos[0]."','1')");
   echo "<br> $insert2";

   $insert3 = strtoupper("INSERT INTO TBL_TEMPORIZADOR VALUES ('".($_POST['piso']."".$_POST['aula'])."','0','0','0','".$datos[0]."','1')");
   echo "<br> $insert3";
   $conexion->query($insert1);
   $conexion->query($insert2);

   $conexion->query($insert3);
   //$result = $conexion->query($sql);
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=GUI.ac.ingreso.php?msg=El Nuevo Modulo Se Ingreso Correctamente!'>";
   //}

   //mysqli_close($conexion);
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