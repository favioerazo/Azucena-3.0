<?php
  require_once ('../core/conexion.php');
/*
  echo "<br> ".$_POST['checkbox-1'];
  echo "<br> ".$_POST['checkbox-2'];*/
//$post = $_POST['ch-01'];
$usr=explode(",",$_POST['ch-01']);
//echo "sjhksh ".$post[0];
$sql="";
//echo "<br>Largo arreglo: ".(sizeof($_POST)-1);
//echo "<br>usuario: ".$usr[1];
$sql.="INSERT INTO web_opciones_x_usuario_modulo VALUES ";
$n=0;

while ($post = each($_POST))
{
  if($post[0]!='dataTable_length'){
  //echo "<br> ".$post[0] . " = " . $post[1];
    if($n==0)
      $usr=explode(",",$post[1]);
    //echo "<br>POST[0]= ".$n." -->> ".$post[0];
    //echo "<br>POST[1]= ".$n." -->> ".$post[1];
  $val=explode(",",$_POST[$post[0]]);
    $sql.='("'.$usr[1].'","'.$val[0].'","NOW()",1)';
    if($n<(sizeof($_POST)-1))
      $sql.= ",";
  }
  $n++;
}

//echo "<br>$sql";

    /*$usuario = "root";
          $password = "";
          $servidor = "localhost";
          $basededatos = "controlac";
          
          // creación de la conexión a la base de datos con mysql_connect()
          $conexion = mysqli_connect( $servidor, $usuario, "" ) or die ("No se ha podido conectar al servidor de Base de datos");
          
          // Selección del a base de datos a utilizar
          $db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
          // establecer y realizar consulta. guardamos en variable.
*/
          //$consulta = "select c_usuario, d_usuario from tbl_usuarios where b_activo=1";
          //$consulta = "SELECT * FROM tbl_ac_listado";

  if(!$db->conectar()){
    exit;//echo "Se conecto";
  }else 
  {
    $sql_limpia="DELETE FROM web_opciones_x_usuario_modulo WHERE c_usuario='".$usr[1]."'";
    $db->conexion->query($sql_limpia);
    $result = $db->conexion->query($sql);
         /* mysqli_query( $conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos")*/;
          
          /*$resultado = mysqli_query( $conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");*/

          
                /*
                  while ($columna = mysqli_fetch_array( $resultado ))
                  {
                    echo "<option  value=".$columna[0].">".$columna[1]."</option>";   
                  }*/
          $db->desconectar();//mysqli_close( $conexion );
          
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../gui/GUI.usuarios.opciones.usuarios.php?msg=Se Han Modificado los Permisos de ".$usr[1]." Exitosamente!'>";
  }
//$valor_php=$_GET["action"];
  /*session_start();
  echo "<br> ".$_POST['usuario'];
  echo "<br> ".$_POST['nombre'];
  echo "<br> ".$_POST['correo'];
  echo "<br> ".$_POST['pass'];
   
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

  $username= $_POST['usuario'];
  $sql = "SELECT * FROM $tbl_name WHERE c_usuario = '$username' or d_correo= '".$_POST['correo']."'";
  $result = $conexion->query($sql);


  if ($result->num_rows > 0) {     
   
   $row = $result->fetch_array(MYSQLI_ASSOC);
      //echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=dashboard.php'>";
      echo "<br> El usuario existe en la base de datos";
      echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=GUI.usuarios.ingreso.php'>";
   } else { 
     //echo "Username o Password estan incorrectos.";
    //echo "<br> El usuario NO existe en la base de datos";
     //echo "<br><a href='index.php'>Volver a Intentarlo</a>";    
   $sql = "INSERT INTO tbl_usuarios Values ('".strtoupper($_POST['usuario'])."','".strtoupper($_POST['nombre'])."','".$_POST['correo']."','".$_POST['pass']."',1)";
   //echo "<br> $sql";
   $result = $conexion->query($sql);
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='1;URL=GUI.usuarios.ingreso.php'>";
   }

   mysqli_close($conexion);*/
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