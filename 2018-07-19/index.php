<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=gui/index.php'>";
//echo "Esta Logeado";

} else {
   /*echo "Esta pagina es solo para usuarios registrados.<br>";
   echo "<br><a href='login.html'>Login</a>";
   echo "<br><br><a href='index.html'>Registrarme</a>";*/
   //echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=http://localhost/sam_app/index.php'>";
   echo '
   <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Azucena 3.0
      </title>
      <!-- Bootstrap core CSS-->
      <link href="include_libs/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom fonts for this template-->
      <link href="include_libs/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!-- Custom styles for this template-->
      <link href="include_libs/css/sb-admin.css" rel="stylesheet">
      <script>
        function loadImage() {
            setTimeout(function() {
                       $("#sms").fadeOut(2000);           
                  },2000);
      }
                  
      </script>
    </head>

    <body class="bg-dark" onload="loadImage()" >';


            if(isset($_GET['msg'])){
              //echo "<CENTER><P style='color:#FF0000';><br>ATENCION: ".$_GET['msg']."</CENTER>";
              echo ' <div class="container">
                      <div class="alert alert-danger alert-dismissible" id="sms" onload="loadImage()" >
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
      echo '<div class="container">
        <div class="card card-login mx-auto mt-5">
          <center><div class="card-header">LOGIN </div></center>
        <img id="profile-img" class="profile-img-card" src="include_libs/logo.png" />
                <p id="profile-name" class="profile-name-card"></p>
          <div class="card-body">
        <form action="core/core.login.php" method="post" >
              <div class="form-group">
                <label for="exampleInputEmail1">Usuario </label>
                <input name="usuario" class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Ingrese Su Usuario" style="text-transform:uppercase" value="ADM" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Ingrese su Contraseña" name="pass" value="123" required>
                <input type="checkbox" onclick="myFunction()"> Mostrar
              </div>
              <div class="form-group">
                <!--<div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"> Remember Password</label>
                </div>-->
              </div>
              <!--<a class="btn btn-primary btn-block" href="index.html">Entrar</a> -->     
        <input class="btn btn-primary btn-block"  type="submit" name="entrar" value="Entrar">
            </form>
            <div class="text-center">
              <!--<a class="d-block small mt-3" href="register.html">Register an Account</a>-->
              <br>
              <a class="d-block small" href="forgot-password.html">Olvidaste tu Contraseña?</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Bootstrap core JavaScript-->
      <script src="include_libs/vendor/jquery/jquery.min.js"></script>
      <script src="include_libs/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="include_libs/vendor/jquery-easing/jquery.easing.min.js"></script>
      <script>
        function myFunction() {
          var x = document.getElementById("exampleInputPassword1");
          if (x.type === "password") {
              x.type = "text";
          } else {
              x.type = "password";
          }
        }
        
      </script>
    </body>

    </html>';

exit;
}

$now = time();

if($now > $_SESSION['expire']) {
session_destroy();

   echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=index.php'>";
//echo "Su sesion a terminado, <a href='http://localhost/sam_app/index.html'>Necesita Hacer Login</a>";
exit;
}
?>
<!--
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Favio Sistemas - Control AC</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <center><div class="card-header">LOGIN </div></center>
    <img id="profile-img" class="profile-img-card" src="http://localhost/sam_app/dd.png" />
            <p id="profile-name" class="profile-name-card"></p>
      <div class="card-body">
		<form action="checklogin.php" method="post" >
          <div class="form-group">
            <label for="exampleInputEmail1">Usuario </label>
            <input name="usuario" class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Ingrese Su Usuario"  required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Contraseña</label>
            <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Ingrese su Contraseña" name="pass" required>
          </div>
          <div class="form-group">
          </div>  
		<input class="btn btn-primary btn-block"  type="submit" name="entrar" value="Entrar">
        </form>
        <div class="text-center">
          <a class="d-block small" href="forgot-password.html">Olvidaste tu Contraseña?</a>
        </div>
      </div>
    </div>
  </div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>-->
