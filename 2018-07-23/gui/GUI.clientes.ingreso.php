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

$telefono=0;
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
        <form method='POST' action='../core/core.clientes.insert.php'>
            <p class="h4 text-center py-4">Nuevo Cliente</p>

            <!-- Identidad -->
            <div class="md-form">
                <i class="fa fa-vcard prefix grey-text"></i>
                <label for="materialFormCardNameEx1" class="font-weight-light">Identidad</label>
                <input name="id" type="text" id="id" value="" class="form-control"  style="text-transform:uppercase" placeholder="0101-1997-02810" required>
            </div>
            <!-- Material input text -->
            <div class="md-form">
                <i class="fa fa-user prefix grey-text"></i>
                <label for="materialFormCardNameEx" class="font-weight-light">Nombre Completo</label>
                <input name="nombre" type="text" id="materialFormCardNameEx" value="" class="form-control"  style="text-transform:uppercase" placeholder="FAVIO JAVIER ERAZO PINEDA" required>
            </div>
            <!--Genero -->
            <div class="md-form">
              <i class="fa fa-users grey-text"></i>
              <label class="font-weight-light" for="Usuario Transunion">Genero</label>
              <div class="md-form">
                <select name="genero" class="form-control" id="exampleFormControlSelect1" title="Seleccione..." required >
                  <option>Masculino</option>
                  <option>Femenino</option>
                </select>          
              </div>
            </div>

            <!-- Material input email -->
            <div class="md-form">
                <i class="fa fa-envelope prefix grey-text"></i>
                <label for="materialFormCardEmailEx" class="font-weight-light">Correo</label>
                <input name="correo" type="email" id="materialFormCardEmailEx" class="form-control" value="" required>
            </div>

            <!-- Identidad -->
            <div class="md-form">
                <i class="fa fa-tty prefix grey-text "></i>
                <label for="materialFormCardNameEx1" class="font-weight-light">Telefono</label>
                <!--<form>-->

                  <div class="input-group">
                <input name="tel" type="text" id="tel" class="form-control"  style="text-transform:uppercase" value="" placeholder="9445-3053" ><i type="submit" style='font-size:24px;color:green' class="fa fa-plus font-weight-light  btn btn-info" onclick="return add_li()" value="Añadir"></i>
                <input type="hidden" id="vartel" value="" name=""></div>
                 <!-- <input type="submit" onclick="return add_li()" value="Añadir"> 
                 </form>-->
                <ul id="listaTelefonos">
                  <!--<li id="tel0">9532-6210 
                    <span onclick="eliminar(this)">
                      <i class="fa fa-trash prefix grey-text" style="font-size:24px;color:red">                        
                      </i> 
                    </span> 
                    <input type="hidden" name="tel0" value="9532-6210">
                  </li>-->
                </ul>
            </div>

            <!-- Material input password 
            <div class="md-form">
                <i class="fa fa-lock prefix grey-text"></i>
                <label for="materialFormCardPasswordEx" class="font-weight-light">Contraseña</label>
                <input name="pass" type="password" id="materialFormCardPasswordEx" class="form-control" required>    
                <input type="checkbox" onclick="myFunction()">Mostrar
            </div>
          </p>-->

             <!-- Direccion  -->
            <div class="md-form">
                <i class="fa fa-taxi prefix grey-text"></i>
                <label for="materialFormCardNameEx" class="font-weight-light">Direccion</label>
                <textarea name="direccion" type="text" class="form-control" rows="3" value="Barrio Ingles" onKeyPress="return coma(event)" required></textarea>
            </div>

            <div class="text-center py-4 mt-3">
                <button class="btn btn-primary btn-lg" id="guardar" type="submit">Guardar</button>
            </div>
        </form>
        <!-- Material form register -->

    </div>
    <!-- Card body -->

</div>


<script> 
function coma(e) { 
    tecla=(document.all) ? e.keyCode : e.which; 
    if (tecla==44 || tecla==34 || tecla==39 || tecla==43
      || tecla==46 || tecla==39) { 
        //alert('Sin comas, tío'); 
        return false; 
    } 
} 
</script>

<script>
        // http://www.lawebdelprogramador.com
 
        /**
         * Funcion que añade un <li> dentro del <ul>
         */

         var tmp=<?php echo ($telefono); ?>;
        function add_li()
        {

            var nuevoLi=document.getElementById("tel").value;
            if(nuevoLi.length>0)
            {
                if(find_li(nuevoLi))
                {
                    var li=document.createElement('li');
                    li.id="tel"+tmp;
                    li.innerHTML=nuevoLi+"  <span onclick='eliminar(this)'><i class='fa fa-trash prefix grey-text' style='font-size:24px;color:red'></i> </span> <input type='hidden' name='tel"+tmp+"' value='"+nuevoLi+"'/>";
                    document.getElementById("listaTelefonos").appendChild(li);


		            document.getElementById("tel").value="";
		            //var valor=document.getElementById("listaTelefonos").value;
		            //alert("El valor es: "+(tmp));
		            //valor=valor+1;
		            //document.getElementById("listaTelefonos").value=valor;
		            tmp++;		         	
            		document.getElementById("vartel").value+=nuevoLi+",";

		         }
            }else{
              alert("DEBE INGRESAR UN VALOR EN EL CAMPO DE TELEFONO");
            }
            
            return false;
        }
 
        /**
         * Funcion que busca si existe ya el <li> dentrol del <ul>
         * Devuelve true si no existe.
         */
        function find_li(contenido)
        {
            var el = document.getElementById("listaTelefonos").getElementsByTagName("li");
            for (var i=0; i<el.length; i++)
            {
                if(el[i].innerHTML==contenido)
                    return false;
            }
            return true;
        }
 
        /**
         * Funcion para eliminar los elementos
         * Tiene que recibir el elemento pulsado
         */
        function eliminar(elemento)
        {
            var id=elemento.parentNode.getAttribute("id");
            node=document.getElementById(id);
            node.parentNode.removeChild(node);
        }
    </script>
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

     <script src="http://code.jquery.com/jquery-1.9.1.js" type="text/javascript"></script>
 <script type="text/javascript">
        jQuery(function($){
            $("#id").mask("9999999999999");
        });
    </script>

 <script type="text/javascript">
        jQuery(function($){
            $("#tel").mask("9999-9999");
        });
    </script>

    <script src="../elementos/jquery.maskedinput.min.js" type="text/javascript"></script>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.min.css" />
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