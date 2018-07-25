<?php
  session_start();

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

  //echo "Usuario ".$_SESSION['username'] ;
  $datos=explode(",",$_SESSION['username']);
  $nombre=explode(" ",$datos[1]);
  } else {
   echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../core/core.logout.php'>";
      exit;
  }

  $now = time();

  if($now > $_SESSION['expire']) {
   echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../core/core.logout.php'>";
  exit;
  }
  include 'formheader.php';


   /*echo "<script>
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
    </script>

    ";*//*
    if(isset($_GET['msg'])&&isset($_GET['alert']))
    {
      echo ' <div class="container">
                <div class="alert alert-'.$_GET['alert'].' alert-dismissible" id="sms" >
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>ATENCION:</strong> '.$_GET['msg'].'
                </div>
              </div>';
    }*/
?>
<!-- Card -->

  <li class="breadcrumb-item active">Usuarios</li>
</ol>
<div class="card">

    <!-- Card body -->
    <div class="card-body">
      <?php
      if(isset($_GET['msg'])&&isset($_GET['alert']))
    {
      echo ' <div class="container">
                <div class="alert alert-'.$_GET['alert'].' alert-dismissible" id="sms" >
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>ATENCION:</strong> '.$_GET['msg'].'
                </div>
              </div>';
    }
?>
        <!-- Material form register -->
        <form method='POST' action='../core/core.usuarios.insert.php'>
            <p class="h4 text-center py-4">Nuevo Usuario</p>

            <!-- Material input text -->
            <div class="md-form">
                <i class="fa fa-user prefix grey-text"></i>
                <label for="materialFormCardNameEx1" class="font-weight-light">Usuario</label>
                <input name="usuario" type="text" id="materialFormCardNameEx1" class="form-control"  style="text-transform:uppercase" required>
            </div>
            <!-- Material input text -->
            <div class="md-form">
                <i class="fa fa-user prefix grey-text"></i>
                <label for="materialFormCardNameEx" class="font-weight-light">Nombre Completo</label>
                <input name="nombre" type="text" id="materialFormCardNameEx" class="form-control"  style="text-transform:uppercase" required>
            </div>

            <!-- Material input email -->
            <div class="md-form">
                <i class="fa fa-envelope prefix grey-text"></i>
                <label for="materialFormCardEmailEx" class="font-weight-light">Correo</label>
                <input name="correo" type="email" id="materialFormCardEmailEx" class="form-control" required>
            </div>

            <!-- Material input password -->
            <div class="md-form">
                <i class="fa fa-lock prefix grey-text"></i>
                <label for="materialFormCardPasswordEx" class="font-weight-light">Contraseña</label>
                <input name="pass" type="password" id="materialFormCardPasswordEx" class="form-control" required>    
                <input type="checkbox" onclick="myFunction()">Mostrar
            </div>

            <div class="text-center py-4 mt-3">
                <button class="btn btn-primary btn-lg" type="submit">Guardar</button>
            </div>
        </form>
        <!-- Material form register -->

    </div>
    <!-- Card body -->

</div>
<script>
  function myFunction() {
    var x = document.getElementById("materialFormCardPasswordEx");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
  
</script>
<!-- Card -->

<?php
echo "
 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.5/bootstrap-notify.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.5/bootstrap-notify.min.js'></script>
";
  include 'formfooter.php';
?>