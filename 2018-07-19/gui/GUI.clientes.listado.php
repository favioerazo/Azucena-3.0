<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
  //echo "Usuario ".$_SESSION['username'] ;
  $datos=explode(",",$_SESSION['username']);
  $nombre=explode(" ",$datos[1]);
} else {
   echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../index.php'>";
  exit;
}

$now = time();
if($now > $_SESSION['expire']) {
  session_destroy();
  echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../index.php'>";
exit;
}
//Debemos incluir el formheader.php siempre
include 'formheader.php';

$telefono=0;
?>
</ol>
<!-- Example DataTables Card-->
<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Listado de Clientes</div>
  <div class="card-body">
    <span class="glyphicon glyphicon-search"></span>
    <label class="label"><strong>Ingrese un Nombre:</strong></label>
    <input placeholder="Buscar" type="text" maxlength="30" name="datosCliente" id="datosCliente" class="form-control" onKeyUp="buscar();">
    <div><br></br>
      <div class="table-responsive">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>NOMBRE</th>
            <th>IDENTIDAD</th>
            <th>CORREO</th>
            <th>MODIFICAR</th>
          </tr>
        </thead>
        <tbody id="resultadoBusquedaClientes">      
        </tbody>
      </table>
      
    </div>
    </div>

    <!-- Modal -->
  <div class="modal fade"  role="dialog" id="myModal">
    <div class="modal-dialog" id="myModal1">
    
      <!-- Modal content-->
      <div class="modal-content " >
        <div class="modal-header" >          
          <h4 class="modal-title"><CENTER>DATOS DEL CLIENTE</CENTER></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">         
        <form method='POST' action='../core/core.clientes.update.php'>
          <!-- Identidad -->
            <div class="md-form">
                <i class="fa fa-vcard prefix grey-text"></i>
                <label for="materialFormCardNameEx1" class="font-weight-light">Identidad</label>
                <input name="id" type="text" id="id" value="" class="form-control"  style="text-transform:uppercase" placeholder="1234567890123"  required readonly>
            </div>
            <!-- nombre -->
            <div class="md-form">
                <i class="fa fa-user prefix grey-text"></i>
                <label for="materialFormCardNameEx" class="font-weight-light">Nombre Completo</label>
                <input name="nombre" type="text" id="materialFormCardNameEx" value="" class="form-control"  style="text-transform:uppercase" placeholder="CAMILO SESTO"  required>
            </div>
            <!--Genero -->
            <div class="md-form">
              <i class="fa fa-users grey-text"></i>
              <label class="font-weight-light" for="Usuario Transunion">Genero</label>
              <div class="md-form">
                <select  name="genero" class="form-control" id="exampleFormControlSelect1" title="Seleccione..."  required disabled>
                  <option id="M">Masculino</option>
                  <option id="F">Femenino</option>
                </select>          
              </div>
            </div>

            <!-- correo -->
            <div class="md-form">
                <i class="fa fa-envelope prefix grey-text"></i>
                <label for="materialFormCardEmailEx" class="font-weight-light">Correo</label>
                <input name="correo" type="email" id="correo" class="form-control" value="" required >
            </div>

            <!-- Telefono -->
            <div class="md-form">
                <i class="fa fa-tty prefix grey-text "></i>
                <label for="materialFormCardNameEx1" class="font-weight-light">Telefono</label>
                <!--<form>-->
                  <div class="input-group">
                <input name="tel" type="text" id="tel" class="form-control"  style="text-transform:uppercase" value="" placeholder="____-____"  ><span class="input-group-addon">   </span><i id="add" type="submit" style='font-size:24px;color:green' class="fa fa-plus font-weight-light btn btn-info" onclick="return add_li()" value="Añadir" ></i>
                <input type="hidden" id="vartel" value="" name="">
              </div>
                 <!-- <input type="submit" onclick="return add_li()" value="Añadir"> 
                 </form>-->
                <ul id="listaTelefonos"  >
                  <div id="contenedorTelefonos">
                    
                  </div>
                </ul>
            </div>
             <!-- Direccion  -->
            <div class="md-form">
                <i class="fa fa-taxi prefix grey-text"></i>
                <label for="materialFormCardNameEx" class="font-weight-light">Direccion</label>
                <textarea name="direccion" type="text" class="form-control" rows="3" value="Barrio Ingles" id="direccion" readonly required ></textarea>
            </div>

            <div>
              <input type="checkbox" id="check" onChange="validarchk();" > Editar
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-info" id="eliminaContenido" target="_blank" >Imprimir</button>
          <button class="btn btn-success pull-left" type="submit" target="_blank" >Actualizar</button>
        </div>        
        </form>
      </div>
      
    </div>
  </div>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript">
      $('#eliminaContenido').on('click', function () {
      if ($('.modal').is(':visible')) {
          var modalId ="myModal";// $(event.target).closest('.modal').attr('id');
          $('body').css('visibility', 'hidden');
          $("#" + modalId).css('visibility', 'visible');
          //$('#' + modalId).removeClass('modal');
          window.print();

            location.reload();
          /*$("#" + modalId).css('visibility', 'hidden');
          $('body').css('visibility', 'visible');
          $('#' + modalId).addClass('modal');*/
      } else {
          window.print();
      }
      });

      
    </script>
    <script>
 
      function validarchk(){
      var chk = document.getElementById('check');
      //var txt = document.getElementById('id');
      if(chk.checked){
          //txt.disabled='';
         // document.getElementById("id").disabled='';
        document.getElementById("materialFormCardNameEx").readOnly=false;
        //document.getElementById("exampleFormControlSelect1").disabled='';
        document.getElementById("tel").readOnly=false;
        document.getElementById("direccion").readOnly=false;
        document.getElementById("correo").readOnly=false;
        document.getElementById("listaTelefonos").readOnly=false;
        document.getElementById("add").readOnly=false;
        //alert("Habilito");
      }else{
        //alert("deshabilito");

        document.getElementById("direccion").readOnly=true;
          //txt.disabled='disabled';          
         // document.getElementById("id").disabled='disabled';
        document.getElementById("materialFormCardNameEx").readOnly='readOnly';
        document.getElementById("exampleFormControlSelect1").readOnly='true';
        document.getElementById("tel").readOnly='readOnly';
        document.getElementById("direccion").readOnly=true;
        document.getElementById("correo").readOnly='readonly';
        document.getElementById("listaTelefonos").readOnly='readOnly';
        document.getElementById("add").readOnly='readOnly';
      }
      }
    </script> 

    <script>
 
      function carga(va){
        //alert("Presiono"+va.value);
        //document.getElementById("correo").value=va.value;
        var arreglo=va.value.split(",");
        reset(arreglo[0]);
/*
        reset(arreglo[0]);
        alert("valor 0 "+arreglo[0]);
        alert("valor 1 "+arreglo[1]);
        alert("valor 2 "+arreglo[2]);*/

        document.getElementById("id").value=arreglo[0];

        document.getElementById("materialFormCardNameEx").value=arreglo[1];
        //document.getElementById("exampleFormControlSelect1").value=arreglo[2];
        document.getElementById("direccion").value=arreglo[4];
        document.getElementById("correo").value=arreglo[2];
        document.getElementById('check').checked="";

        document.getElementById("materialFormCardNameEx").readOnly=true;
       // document.getElementById("exampleFormControlSelect1").disabled='disabled';
        document.getElementById("tel").readOnly=true;
        document.getElementById("direccion").readOnly=true;
        document.getElementById("correo").readOnly=true;
        document.getElementById("listaTelefonos").readOnly=true;
        document.getElementById("add").readOnly=true;

        if(arreglo[3]=="F")          
        document.getElementById("F").selected="selected";
      else
        document.getElementById("M").selected="selected";
      }
    </script>
    <script>      
      function reset($id)
      {
        $('contenedorTelefonos').remove();
        //alert($id);
        buscarTelefonos($id);
      }
      function buscarTelefonos($id) {
          var textoBusqueda = $id;
          if(textoBusqueda!="")
          {
            $.post("../core/core.sql.busqueda.telefonos.cliente.php",{valorBusqueda: textoBusqueda},function(mensaje) {
                $("#contenedorTelefonos").html(mensaje);
                //alert(mensaje);
               }); 
          } else { 
              $("#contenedorTelefonos").html('');
        };
      };
  </script>
    <script>
      $(document).ready(function() {
        //$("#resultadoBusquedaClientes").html('<p></p>');
        $.ajax({
        url: "../core/core.sql.listado.clientes.inicial.php",
        type: "POST",
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
        //Opcional, mostrar una imagen de carga mientras se obtienen los datos
       /* beforeSend: function() {
            $("#resultadoBusqueda").html("<img src='cargando.gif' width='30' height='30' />");
        }*/
        }).done(function(echo){
            $("#resultadoBusquedaClientes").html(echo);
        });
     });

      function buscar() {
          var textoBusqueda = $("input#datosCliente").val();
          if(textoBusqueda!= "")
          {
            $.post("../core/core.sql.busqueda.clientes.php",{valorBusqueda: textoBusqueda},function(mensaje) {
                $("#resultadoBusquedaClientes").html(mensaje);
               }); 
          } else { 
              $("#resultadoBusquedaClientes").html('<p></p>');
        };
      };
    </script>
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

<script>
        //var tmp=<?php echo ($telefono); ?>;
        var tmp=0;
        function add_li()
        {
          var chk = document.getElementById('check');
          if(chk.checked){
            var nuevoLi=document.getElementById("tel").value;
            if(nuevoLi.length>0)
            {
                if(find_li(nuevoLi))
                {
                    var li=document.createElement('li');
                    li.id="tel"+tmp;
                    li.innerHTML=nuevoLi+"  <span onclick='eliminar(this)'><i class='fa fa-trash prefix grey-text' style='font-size:24px;color:red'></i> </span> <input type='hidden' name='tel"+tmp+"' value='"+nuevoLi+"' />";
                    document.getElementById("contenedorTelefonos").appendChild(li);


                document.getElementById("tel").value="";
                tmp++;  
                //var valor=document.getElementById("listaTelefonos").value;
                /*alert("El valor es: "+(tmp));
                //valor=valor+1;
                //document.getElementById("listaTelefonos").value=valor;
                tmp++;              
                document.getElementById("vartel").value+=nuevoLi+",";
                document.getElementById("guardar").classList.add('btn btn-success');
*/
             }
            }
          }
            
            return false;
        }
 
        /**
         * Funcion que busca si existe ya el <li> dentrol del <ul>
         * Devuelve true si no existe.
         */
        function find_li(contenido)
        {
            var el = document.getElementById("contenedorTelefonos").getElementsByTagName("li");
            for (var i=0; i<el.length; i++)
            {
                if(el[i].innerHTML==contenido)
                    return false;
            }
            return true;
        }
 
        /**
         * Funcion para eliminar los include_libs
         * Tiene que recibir el elemento pulsado
         */
        function eliminar(elemento)
        {
          var chk = document.getElementById('check');
          if(chk.checked){
            var id=elemento.parentNode.getAttribute("id");
            node=document.getElementById(id);
            node.parentNode.removeChild(node);
          }
        }
    </script>

    <script src="../include_libs/jquery.maskedinput.min.js" type="text/javascript"></script>

    <?php

      //Debemos incluir el formfooter.php siempre
      include 'formfooter.php';
    ?>
            
    