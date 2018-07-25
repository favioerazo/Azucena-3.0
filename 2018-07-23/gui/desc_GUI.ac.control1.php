

<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

//echo "Usuario ".$_SESSION['username'] ;
$datos=explode(",",$_SESSION['username']);
$nombre=explode(" ",$datos[1]);
} else {
   /*echo "Esta pagina es solo para usuarios registrados.<br>";
   echo "<br><a href='login.html'>Login</a>";
   echo "<br><br><a href='index.html'>Registrarme</a>";*/
   echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=index.php'>";


exit;
}

$now = time();

if($now > $_SESSION['expire']) {
session_destroy();

//echo "Su sesion a terminado,<a href='http://localhost/sam_app/index.html'>Necesita Hacer Login</a>";

   echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=index.php'>";
exit;
}

//include 'formheader.php';
function conversorSegundosHoras($tiempo_en_segundos) {
    $horas = floor($tiempo_en_segundos / 3600);
    $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
    $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);

    $hora_texto = "";
    if ($horas > 0 ) {
      if($horas>9)
        $hora_texto .= $horas . ":";
      else
        $hora_texto .= "0".$horas . ":";
    }else 
        $hora_texto .= "00:";



    if ($minutos > 0 ) {
       if ($minutos > 9 )
        $hora_texto .= $minutos . ":";
      else
        $hora_texto .= "0".$minutos . ":";
    }else
        $hora_texto .= "00:";




    if ($segundos > 0 ) {
      if ($segundos > 9 )
        $hora_texto .= $segundos . "";
      else
        $hora_texto .= "0".$segundos . "";
    }else 
    $hora_texto .= "00";
    //echo "1tiempo $tiempo_en_segundos";
    //$hora_texto= $horas . ":" .$minutos . ":" . $segundos;

    return $hora_texto;
    //return "100";
}
?>

<?php 
  $usuario = "root";
  $password = "";
  $servidor = "localhost";
  $basededatos = "controlac";
  $listadoAC="";

  // creación de la conexión a la base de datos con mysql_connect()
  $conexion = mysqli_connect( $servidor, $usuario, "" ) or die ("No se ha podido conectar al servidor de Base de datos");

  // Selección del a base de datos a utilizar
  $db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
  // establecer y realizar consulta. guardamos en variable.

  $consulta = "SELECT a.C_MODULO, a.D_MODULO, a.C_AULA, a.c_direccion_red, b.b_estado,
  c.t_fin_temporizador, c.t_apagado_ac
  FROM tbl_ac_listado a, tbl_ac_estado b, tbl_temporizador c 
  where a.c_modulo=b.c_modulo and a.c_modulo=c.c_modulo and a.b_activo=1 ";
  //$consulta = "SELECT * FROM tbl_ac_listado";
  $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos AQUI ");    
  while ($columna = mysqli_fetch_array( $resultado ))
  {
    $listadoAC.=$columna[0].",";
    //echo "$listadoAC";
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SAM APP - Control AC</title>


      <!--Import Google Icon Font
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="http://localhost/materialize/css/materialize.min.css"  />-->
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <script type="text/javascript">
          var acl= "<?php echo "$listadoAC";?>";
          //alert(acl);
          //console.warn(acl);
                    //var acl = "2202";
          var listadoac=acl.split(",");
          function contador(){
            for (i=0;i<listadoac.length-1;i++)
            {
              //console.log("LAC: "+listadoac[i]);
              var cont1 = document.getElementById("htiempo"+listadoac[i]).value;
              var contador1 = document.getElementById("txttiempo"+listadoac[i]);
              var horas = Math.floor(cont1 / 3600);
              var minutos = Math.floor((cont1 - (horas * 3600)) / 60);
              var segundos = cont1 - (horas * 3600) - (minutos * 60);

              //console.warn(cont1);

              var hora_texto = "";
              if (horas > 0 ) {
                if(horas>9)
                  hora_texto+=horas + ":";
                else
                  hora_texto+="0"+horas + ":";
              }else 
                  hora_texto+="00:";


              if (minutos > 0 ) {
                 if (minutos > 9 )
                  hora_texto+=minutos +":";
                else
                  hora_texto+="0"+minutos + ":";
              }else
                  hora_texto+="00:";


              if (segundos > 0 ) {
                if (segundos > 9 )
                  hora_texto+=segundos +"";
                else
                  hora_texto+="0"+segundos+ "";
              }else 
                  hora_texto+="00";
                
                contador1.value = hora_texto +"";
                if(cont1>0){
                   cont1--;                  
                  //console.log("Valor de "+listadoac[i]+" es: "+hora_texto);
                }
                document.getElementById("htiempo"+listadoac[i]).value=cont1;
                    
                  setTimeout(function() {
                       $("#sms").fadeOut(3000);           
                  },1000);
              
            }
          }
          </script>
          <script>
            
          </script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" onLoad="setInterval('contador()',1000);">

  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="dashboard.php">
    <?php $datos=explode(",",$_SESSION['username']);
$nombre=explode(" ",$datos[1]); echo "Bienvenido ".$nombre[0];?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="dashboard.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <?php
        

  $host_db = "localhost";
  $user_db = "root";
  $pass_db = "";
  $db_name = "controlac";
  $tbl_name = "tbl_modulo_opciones";

  $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

  if ($conexion->connect_error) {
   die("La conexion falló: " . $conexion->connect_error);
  }
    $sql = "SELECT a.c_opcion, a.d_opcion, a.d_direccion from tbl_modulo_opciones a, tbl_opciones_x_usuario_modulo b where b.c_usuario='".$datos[0]."' AND a.c_opcion=b.c_opcion order by c_opcion";
    //echo "$sql";
    $n;
    $result = $conexion->query($sql);
    $n=0;
        while($n < ($result->num_rows))
        {
          $row = $result->fetch_array(MYSQLI_ASSOC); 
          if(strlen($row['c_opcion'])>2){
            echo '<li>
              <a href="'.$row['d_direccion'].'">'.$row['d_opcion'].'</a>
            </li>';

          }else{
           if($n>0)
              echo "  </ul>  </li>";

            echo '


            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="ControlAC">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapse'.$row['c_opcion'].'" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">'.$row['d_opcion'].'</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapse'.$row['c_opcion'].'">
            
            
          ';
          
          }
          ++$n;  
        }        

              echo "  </ul>  </li>";   
        //include 'formfooter.php';
   mysqli_close($conexion);
   //exit;
 ?>

        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Salir</a>
        </li>
      </ul>
    </div>
  </nav>

            
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Dashboard</a>
        </li>



  <li class="breadcrumb-item active">Control AC</li>
</ol>
      <!-- -->
      <div class="col-md-2"> 
      </div>
      <div class="card mb-3" >
        <div class="card-header">
          <i class="fa fa-table"></i> Listado de Modulos AC</div>

        <div class="card-body">
  
          <?php // Ejemplo de conexión a base de datos MySQL con PHP.
          /*
          if(isset($_GET['msg'])){
            echo "<CENTER><P style='color:#FF0000';><br>ATENCION: ".$_GET['msg']."</CENTER>";
            //miFuncion();
          }*/



            if(isset($_GET['msg'])){
              //echo "<CENTER><P style='color:#FF0000';><br>ATENCION: ".$_GET['msg']."</CENTER>";
              echo ' <div class="container">
                      <div class="alert alert-danger alert-dismissible" id="sms" >
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>ATENCION:</strong> '.$_GET['msg'].'
                      </div>
                    </div>';


             /* echo '<div id="sms" class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="false">&times;</span></button>
              <strong style="color:#FF0000";>ATENCION: </strong><P style="color:#FF0000";><br> '.$_GET['msg'].'
              </div>';*/
              //miFuncion();
            }
              
          //
          // Ejemplo realizado por Oscar Abad Folgueira: http://www.oscarabadfolgueira.com y https://www.dinapyme.com
          
          // Datos de la base de datos
         // include 'plc.php';
          $usuario = "root";
          $password = "";
          $servidor = "localhost";
          $basededatos = "controlac";
          
          // creación de la conexión a la base de datos con mysql_connect()
          $conexion = mysqli_connect( $servidor, $usuario, "" ) or die ("No se ha podido conectar al servidor de Base de datos");
          
          // Selección del a base de datos a utilizar
          $db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
          // establecer y realizar consulta. guardamos en variable.

          $consulta = "SELECT a.C_MODULO, a.D_MODULO, a.C_AULA, a.c_direccion_red, b.b_estado,
          c.t_fin_temporizador, c.t_apagado_ac
          FROM tbl_ac_listado a, tbl_ac_estado b, tbl_temporizador c 
          where a.c_modulo=b.c_modulo and a.c_modulo=c.c_modulo and a.b_activo=1 ";
          /*
          columna[0]= C_MODULO
          columna[1]=D_MODULO
          columna[2]=C_AULA
          columna[3]=C_DIRECCION_RED
          columna[4]=B_ESTADO
          columna[5]=T_FIN_TEMPORI
          columna[5]=T_APAGADO_AC
          */
          //$consulta = "SELECT * FROM tbl_ac_listado";
          $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos AQUI ");
          
         /* echo "
              <div class='table table-bordered' style='background-color:#0687F0;''> 
                <table id='tabla1' class='table table-bordered' border = 2 cellpadding = 0.5>";
                  echo "<tr>";
                    echo "<th>Codigo</th>";
                    echo "<th>Descripcion</th>";
                    echo "<th>Aula</th>";
                    echo "<th>Direccion</th>";
                    echo "<th>Estado</th>";
                  echo "</tr>";   */      
                  while ($columna = mysqli_fetch_array( $resultado ))
                  {
                    $estado='';
                    //$listadoAC.=$columna[0].",";
                    if($columna[4]==0){
                      $estado=" value='Encender' class='btn btn-danger'";
                      //$tbl=" class='danger' ";
                    }else{
                      $estado=" value='Apagar' class='btn btn-primary btn-success' ";
                    }
                   /* echo " 
        
                    <div class='col-lg-4' style='width: 280px;'>
                            <div class='panel panel-default'>
                                <div class='panel-heading text-center'>
                                    <label>".$columna[1]."</label>
                                </div>
                                <div style='padding-left: 1.8em;'>
                                    <form role='form' name='form' method=POST action='bitacora.php' data-ajax='false'>
                                        <fieldset>
                                            <input name='codigo' type='hidden' value='" . $columna[0]. "'>
                                            <input name='direccion' type='hidden' value='" . $columna[2]  . "'>
                                            
                                            <div class='form-group'>
                                              <label>Tiempo de uso</label>
                                              <input class='form-control text-center' name='tiempo' type='number' max='60' min='5' step='5' style='width: 195px; font-family: Arial; font-size: 14pt;' placeholder='Tiempo de uso' value='40'>
                                              <label>Tiempo restante</label>
                                              <input class='form-control panel-heading text-center' type='text' name='cronometro' value='00:00:00' style='width: 195px; font-family: Arial; font-size: 14pt;' disabled>
                                            </div>
                                            <button type='submit' ".$estado." style='width: 195px;'>Activo </button>
                                        </fieldset>
                                    </form>
                                </div>
                                <br>
                            </div>
                        </div>";*/

                  echo ' <br><div class="card" style="width: 280px; " class="panel-heading text-center">';
                        echo '
                       <center>
                          <div class="card-header">'.strtoupper($columna[1]).'</div>
                      ';
                      echo "";
                      echo "
                      <form role='form' name='form' method=POST action='core.ac.control.php' data-ajax='false'>

                      <div class='form-group'>
                        <label>Tiempo de uso</label>
                        <input class='form-control text-center' name='tiempo' type='number' max='60' min='10' step='10' 
                        style='width: 195px; font-family: Arial; font-size: 14pt;' id='tini' placeholder='Tiempo de uso' value='";
                        if($columna[6]>0)
                          echo $columna[6]."' ";
                        else
                          echo "40' ";


                        if($columna[4]==1)
                          echo " readonly >";
                        else
                          echo " >";
                        $var=0;
                        if($columna[5]>$now)
                          $var=$columna[5]-$now-2;

          /*
          columna[0]= C_MODULO
          columna[1]=D_MODULO
          columna[2]=C_AULA
          columna[3]=C_DIRECCION_RED
          columna[4]=B_ESTADO
          columna[5]=T_FIN_TEMPORI
          columna[5]=T_APAGADO_AC
          datos[0]=c_usuario
          */
                        echo "
                        <label id = 'lbl1'>Tiempo restante</label>
                        <input class='form-control panel-heading text-center' type='text' name='rest' value='".conversorSegundosHoras($var)."' style='width: 195px; font-family: Arial; font-size: 14pt;' id='txttiempo".$columna[0]."' readonly >
                        
                      <input value='".$columna[3].",".$columna[4].",".$columna[0].",".$datos[0]."'  type='hidden' name='datos'/>
                      <input value='".$var."'  type='hidden' name='datostiem' id='htiempo".($columna[0])."'/>
                      </div>
                      <input ".$estado." type='submit'  name='Procesado' /><br>


                                    </form><br>
                      ";
                  echo "</div>";
                    /*

                    echo "<td>" . $columna[0] . "</td>";
                    echo "<td>" . $columna[1] . "</td>";
                    echo "<td>" . $columna[2] . "</td>";
                    echo "<td>" . $columna[3] . "</td>";
                    //ñ "<td>" . $columna['b_activo'] . "</td>";
                    //echo "<td> <input type='button' value='Inicio'  href='http://google.com'/>  </td>";

                        //<form action=".$columna[3]."/ENCENDIDO=ON method='post' >
                    echo "<td>
                        <form action='core.ac.control.php' method='post' > 
                          <input value='".$columna[3].",".$columna[4].",".$columna[0]."''  type='hidden' name='datos'/>      
                           <input ".$estado." type='submit'  name='Procesado' />
                        </form>
                      </td>";
                    echo "</tr>"; */
                  }
              /*
              echo "</table>
              </div>";
          
          echo "</table>"; */// Fin de la tabla
          // cerrar conexión de base de datos
          mysqli_close( $conexion );

          /*echo '<script type="text/javascript">
        var cont = document.getElementById("htiempo").value;
       
        function contador(){
          var contador = document.getElementById("txttiempo");

        $horas = floor($cont / 3600);
        $minutos = floor(($cont - ($horas * 3600)) / 60);
        $segundos = $cont - ($horas * 3600) - ($minutos * 60);

        $hora_texto = "";
        if ($horas > 0 ) {
          if($horas>9)
            $hora_texto .= $horas . ":";
          else
            $hora_texto .= "0".$horas . ":";
        }else 
            $hora_texto .= "00:";



        if ($minutos > 0 ) {
           if ($minutos > 9 )
            $hora_texto .= $minutos . ":";
          else
            $hora_texto .= "0".$minutos . ":";
        }else
            $hora_texto .= "00:";




        if ($segundos > 0 ) {
          if ($segundos > 9 )
            $hora_texto .= $segundos . "";
          else
            $hora_texto .= "0".$segundos . "";
        }else 
        $hora_texto .= "00";
        //echo "1tiempo $tiempo_en_segundos";
        //$hora_texto= $horas . ":" .$minutos . ":" . $segundos;


          contador.value = $hora_texto;

          if(cont>0)
          cont--;
        }
    }

        </script>';*/
        //echo "$listadoAC";
        //microseguros
        /*echo '<script type="text/javascript">
          var acl= "<?php echo "$listadoAC";?>";
          alert(acl);
          console.warn(acl);
                    //var acl = "2202";
          var listadoac=acl.split(",");
          function contador(){
            for (i=0;i<listadoac.length-1;i++)
            {
              //console.log("LAC: "+listadoac[i]);
              var cont1 = document.getElementById("htiempo"+listadoac[i]).value;
              var contador1 = document.getElementById("txttiempo"+listadoac[i]);
              var horas = Math.floor(cont1 / 3600);
              var minutos = Math.floor((cont1 - (horas * 3600)) / 60);
              var segundos = cont1 - (horas * 3600) - (minutos * 60);

              console.warn(cont1);

              var hora_texto = "";
              if (horas > 0 ) {
                if(horas>9)
                  hora_texto+=horas + ":";
                else
                  hora_texto+="0"+horas + ":";
              }else 
                  hora_texto+="00:";


              if (minutos > 0 ) {
                 if (minutos > 9 )
                  hora_texto+=minutos +":";
                else
                  hora_texto+="0"+minutos + ":";
              }else
                  hora_texto+="00:";


              if (segundos > 0 ) {
                if (segundos > 9 )
                  hora_texto+=segundos +"";
                else
                  hora_texto+="0"+segundos+ "";
              }else 
                  hora_texto+="00";
                
                contador1.value = hora_texto +"";
                if(cont1>0){
                   cont1--;                  
                  console.log("Valor de "+listadoac[i]+" es: "+hora_texto);
                }
                document.getElementById("htiempo"+listadoac[i]).value=cont1;
              
            }
          }
          </script>';*/
        /*echo '
        <script type="text/javascript">

          var acl = "<?php echo $datos;?>"
          var listadoac=acl.split(",");
          console.info("acl: "+acl);
            function contador(){
          for (i=0;i<=listadoac.length;i++)
          {
            var cont1 = document.getElementById("htiempo"+listadoac[i]).value;
           
              var contador1 = document.getElementById("txttiempo"+listadoac[i]);
              var horas = Math.floor(cont1 / 3600);
              var minutos = Math.floor((cont1 - (horas * 3600)) / 60);
              var segundos = cont1 - (horas * 3600) - (minutos * 60);

              var hora_texto = "";
              if (horas > 0 ) {
                if(horas>9)
                  hora_texto+=horas + ":";
                else
                  hora_texto+="0"+horas + ":";
              }else 
                  hora_texto+="00:";


              if (minutos > 0 ) {
                 if (minutos > 9 )
                  hora_texto+=minutos +":";
                else
                  hora_texto+="0"+minutos + ":";
              }else
                  hora_texto+="00:";


              if (segundos > 0 ) {
                if (segundos > 9 )
                  hora_texto+=segundos +"";
                else
                  hora_texto+="0"+segundos+ "";
              }else 
                  hora_texto+="00";
                contador1.value = hora_texto +"";
                if(cont1>0)
                cont1--;

              document.getElementById("htiempo"+listadoac[i]).value=cont1;
              }
            }

        </script>';*/

          include 'formfooter.php';
          echo "<META HTTP-EQUIV='REFRESH' CONTENT='20;URL=GUI.ac.control1.php'>";

        ?>
