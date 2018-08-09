<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Favio Erazo">
  <title>Azucena 3.0</title>

<script type="text/javascript">
  function mostrarMenu($id)
  {
    for (var i = 1; i <110; i++) {
      var elemento;
      if(i<10)
        elemento="#collapse0";
      else
        elemento="#collapse";

      //console.log("ID: "+elemento+""+i);
      //console.log("Existe?: "+$(elemento+""+i).length);
      if ( $(elemento+""+i).length > 0 ) {
        if($id!=i)
        {
          $(elemento+i).removeClass();
          $(elemento+i).addClass("sidenav-second-level collapse");
        //console.log("Valor de i "+i);
        }

      }else break;
    }
      if ( $("#collapse"+$id).length > 0 ) {
      if($("#collapse"+$id).attr('class')=="sidenav-second-level collapse show"){
      // hacer algo aquí si el elemento existe
      $("#collapse"+$id).removeClass();
      $("#collapse"+$id).addClass("sidenav-second-level collapse");
      //$("#collapse01").class="sidenav-second-level collapse show";
      //console.log("Entro "+$id);
      }else{
        
        // hacer algo aquí si el elemento existe
        $("#collapse"+$id).removeClass();
        $("#collapse"+$id).addClass("sidenav-second-level collapse show");
        //$("#collapse01").class="sidenav-second-level collapse show";
        //console.log("Entro "+$id);
      }
    }//else 
      //console.log("NoEntro "+$id);


      //console.log( $("#collapse"+$id).attr('class'));
  }

</script>
      <!--Import Google Icon Font
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="http://localhost/materialize/css/materialize.min.css"  />-->
  <!-- Bootstrap core CSS-->
  <link href="../include_libs/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  
  <link href="../include_libs/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 
  <!-- Page level plugin CSS-->
  <link href="../include_libs/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../include_libs/css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer " id="page-top" >
  <!-- 
<body class="fixed-nav sticky-footer bg-dark" id="page-top" onLoad="setInterval('contador()',1000);">-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top " id="mainNav">
    <a class="navbar-brand" href="../gui/index.php">
    <?php $datos=explode(",",$_SESSION['username']);
$nombre=explode(" ",$datos[1]); echo "Bienvenido ".$nombre[0];?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="../gui/index.php">
            <i class="fa fa-fw fa-dashboard" style="color:#FFFFFF";></i>
            <span class="nav-link-text" style="color:#FFFFFF";>Dashboard</span>
          </a>
        </li>
        <?php
        require_once ('../core/conexion.php');
  /*$host_db = "localhost";
  $user_db = "root";
  $pass_db = "";
  $db_name = "controlac";*/
  $tbl_name = "web_modulo_opciones";

 /* $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

  if ($conexion->connect_error) {
   die("La conexion falló: " . $conexion->connect_error);
  }*/

    $sql = "select a.c_opcion, a.d_opcion, a.d_direccion from web_modulo_opciones a, web_opciones_x_usuario_modulo b where b.c_usuario='".$datos[0]."' AND a.c_opcion=b.c_opcion 
AND a.b_activo=b.b_activo order by c_opcion";
    //echo "$sql";
    //$n;
    //$result = $conexion->query($sql);
    $n=0;
    if(!$db->conectar()){
    exit;//echo "Se conecto";
  }else 
  {
    $result = $db->conexion->query($sql);
        while($n < ($result->num_rows))
        {
          $row = $result->fetch_array(MYSQLI_ASSOC); 
          if(strlen($row['c_opcion'])>2){
            echo '<li>
              <a href='.$row['d_direccion'].' style="color:#FFFFFF";><i class="fa fa-fw fa fa-sign-in"style="color:#FFFFFF";></i>'.$row['d_opcion'].'</a>
            </li>';

          }else{
           if($n>0)
              echo "  </ul>  </li>";
            echo '
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="'.$row['d_opcion'].'">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapse'.$row['c_opcion'].'1" data-parent="#exampleAccordion" onClick=\'mostrarMenu("'.$row['c_opcion'].'");\'>
            <i class="fa fa-fw fa fa-plus-circle" style="color:#FFFFFF";></i>
            <span class="nav-link-text" style="color:#FFFFFF";>'.$row['d_opcion'].'</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapse'.$row['c_opcion'].'">
            
            
          ';
          
          }
          ++$n;  
        }
          echo "  </ul>  </li>"; 
  }  
  $db->desconectar();
        //include 'formfooter.php';
   //mysqli_close($conexion);
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
        <!--<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for...">
              <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>-->
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal" style="color:#FFFFFF";>
            <i class="fa fa-fw fa-sign-out" style="color:#FFFFFF";></i>Salir</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../gui/index.php">Dashboard</a>
        </li>
<?php
    //include 'formfooter.php';
   //exit;
 ?>

