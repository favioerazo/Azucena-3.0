<?php
  session_start();

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

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
?>
<!-- Card -->

  <li class="breadcrumb-item active">Nuevo Registro</li>
</ol>
<div class="card">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    

<script src="../core/core.funciones.javascript.js"></script> 
<script src="../include_libs/jscolor.js"></script>

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
 <!-- Modal Clientes--> 
  <div class="modal fade" id="registroConfirmacion" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content ">
        <div class="modal-header">          
          <h4 class="modal-title"><CENTER>Orden de ingreso</CENTER></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- Identidad -->
            <div class="md-form" id="divmodalconfirma">                
              
            </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success"  data-dismiss="modal" onclick="registroInsert(<?php $datos=explode(",",$_SESSION['username']); $nombre=explode(" ",$datos[0]); echo "'".$nombre[0]."'";?>);"><i class="fa fa-check"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>

      <div class="progress">
        <div class="progress-bar progress-bar-striped bg-success progress-bar-animated"  role="progressbar" style="width: 16.6%;" aria-valuenow="16.6" id="barraprogreso" aria-valuemin="0" aria-valuemax="100"><i value="progreso"></i></div>
      </div>
      <div class="card mb-3" id="paso1"  >
        <div class="card-header">
          <i class="fa fa-address-card"> ORDEN DE TRABAJO</i>
        </div>
        <div class="card-body">
          <div class="input-group">
          <input class="form-control " type="number" id="clienteregistro"  placeholder="Numero de Orden"> </input> <i class="fa fa-cloud-download btn btn-primary" data-toggle="modal"  onclick="cargaDatosOrden()" data-target="#clientemodal2"> CARGAR</i><br>
          
        </div><br>
        <!--<button  type="button" class="btn btn-success pull-rigth" value="SIGUIENTE"  id="btnsig1" data-toggle="modal"  data-target="#registroConfirmacion" onclick="cargarListadoOrdenes()" > CARGAR <i class="fa fa-toggle-right" ></i>
          </button>-->
          <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#clientemodal" id="btnbuscar"><i class="fa fa-search"></i></button>-->
          <div id="cliente">
          </div>
          <br>
          <button type="button" disabled class="btn btn-warning pull-rigth" value="SIGUIENTE" onclick="mostrarForm('2','1');" id=""><i class="fa fa-toggle-left"> </i></button>
          <button type="button" class="btn btn-info pull-rigth" value="SIGUIENTE" onclick="mostrarForm('2','1');" id="btnmodi" disabled> Modificar <i class="fa fa-toggle-right"></i></button>
          <div id="arreglo">
          </div>
        </div>
      </div><i> </i>
      <div class="card mb-3" id="paso2" hidden>
        <div class="card-header">
          <i class="fa fa-car"> 1. DATOS DEL VEHICULO</i>
        </div>
        <div class="card-body">
          <div class="form-control">
            <label><i class="fa fa-certificate"></i> Marca</label>
            <div class="input-prepend">
            <div class="input-group">
            <select class="form-control" id="form1-marca" >
              <option id="KIA">KIA</option>
              <option id="TOYOTA">TOYOTA</option>
              <option id="HIUNDAY">HIUNDAY</option>
              <option id="MAZDA">MAZDA</option>
              <option id="FORD">FORD</option>
              <option id="OTRO">OTRO</option>
            </select>
            </div>
            </div>
            <label><i class="fa fa-adjust"></i> Modelo</label>
            <input class="form-control" type="text" required id="form1-modelo"></input>
            <label><i class="fa fa-cogs"></i> Motor</label>
            <input class="form-control" type="text" id="form1-motor" required></input>
            <label><i class="fa fa-automobile"></i> Tipo de Vehiculo</label>
            <div class="input-group">
            <select class="form-control" id="form1-tipovehiculo" >
              <option id="TURISMO">TURISMO</option>
              <option id="CAMION">CAMION</option>
              <option id="CAMIONETA">CAMIONETA</option>
              <option id="PICKUP">PICKUP</option>
              <option id="BUS">BUS</option>
              <option id="MOTOCICLETA">MOTOCICLETA</option>
              <option id="CUATRIMOTO">CUATRIMOTO</option>
              <option id="OTRO">OTRO</option>
            </select>
            </div>
            <label><i class="fa fa-barcode"></i> Placa</label>
            <input class="form-control" id="form1-placa" type="text" required></input>
            <label> <i class="fa fa-calendar"></i>A&ntilde;o</label>
            <input class="date-own form-control" id="form1-anio" value="2017" type="number" required readonly=""></input>
            <label><i class="fa fa-pencil"></i> Color</label>
            <input class="form-control jscolor" id="form1-color" type="text" ></input>            
            <label><i class="fa fa-road"></i> Kilometraje</label>
            <input class="form-control" id="form1-kilometraje"  type="number" min="0" max="1000000" step="100" required ></input>
            <label><i class="fa fa-flask"></i> Combustible</label>  

            <select class="form-control" id="form1-combustible" >
              <option id='0%'>0%</option>
              <option id='25%'>25%</option>
              <option id='50%'>50%</option>
              <option id='75%'>75%</option>
              <option id='100%' selected>100%</option>
            </select> 

            <label ><i class="fa fa-shopping-basket"></i> Objetos Adicionales</label><br>
            <input class="btn btn-success" value="Ingresar"  type="button" data-toggle="modal" data-target="#registromodal"></input ><br>
   
            <!--<input class="form-control" type="number" min="0" max="1000000" step="100"  ></input>--><br>
          </div><br>
          <button type="button" class="btn btn-warning pull-rigth" value="SIGUIENTE" onclick="mostrarForm('1','2');" id="btnsig2" > <i class="fa fa-toggle-left" ></i></button>
          <button type="button" class="btn btn-info" value="SIGUIENTE" onclick="verificaForm1()" id="btnsig2"> <i class="fa fa-toggle-right"></i></button>
        </div>
      </div>


      <div class="card mb-3" id="paso3" hidden>
        <div class="card-header">
          <i class="fa fa-medkit"> 2. DATOS DE SEGURO</i>
        </div>
        <div class="card-body">
          <input class="form-control" type="text" ></input><br>
          <button type="button" class="btn btn-warning pull-rigth" value="SIGUIENTE" onclick="mostrarForm('2','3');" id="btnsig3"><i class="fa fa-toggle-left"> </i></button>
          <button type="button" class="btn btn-info pull-rigth" value="SIGUIENTE" onclick="mostrarForm('4','3');" id="btnsig3"> <i class="fa fa-toggle-right"></i></button>
        </div>
      </div>


      <div class="card mb-3" id="paso4" style="background-color:#4F5056;" hidden>
        <div class="card-header"><font color="white" >
          <i class="fa fa-cog"> 3. DA&Ntilde;OS</font></i>
        </div>
        <div class="card-body">
          <textarea name="direccion" type="text" class="form-control" rows="3" placeholder="Detalle la imagen." value="Barrio Ingles" onKeyPress="return coma(event)" required></textarea>
          <input class="form-control btn-primary" type="file" accept="image/jpg,image/png,image/jpeg,image/gif" </input><br><hr/>
          <textarea name="direccion" type="text" class="form-control" rows="3" placeholder="Detalle la imagen." value="Barrio Ingles" onKeyPress="return coma(event)" required></textarea>
          <input class="form-control btn-primary" type="file" accept="image/jpg,image/png,image/jpeg,image/gif"></input><br><hr/>
          <textarea name="direccion" type="text" class="form-control" rows="3" placeholder="Detalle la imagen." value="Barrio Ingles" onKeyPress="return coma(event)" required></textarea>
          <input class="form-control btn-primary" type="file" accept="image/jpg,image/png,image/jpeg,image/gif"></input><br><hr/>
          <textarea name="direccion" type="text" class="form-control" rows="3" placeholder="Detalle la imagen." value="Barrio Ingles" onKeyPress="return coma(event)" required></textarea>
          <input class="form-control btn-primary" type="file" accept="image/jpg,image/png,image/jpeg,image/gif"></input><br><hr/>
          <textarea name="direccion" type="text" class="form-control" rows="3" placeholder="Detalle la imagen." value="Barrio Ingles" onKeyPress="return coma(event)" required></textarea>
          <input class="form-control btn-primary" type="file" accept="image/jpg,image/png,image/jpeg,image/gif"></input><br><hr/>
          <button type="button" class="btn btn-warning pull-rigth" value="SIGUIENTE" onclick="mostrarForm('3','4');" id="btnsig4"> <i class="fa fa-toggle-left"></i></button>
          <button type="button" class="btn btn-info pull-rigth" value="SIGUIENTE" onclick="mostrarForm('5','4');" id="btnsig4"> <i class="fa fa-toggle-right"></i></button>
        </div>
      </div>


      <div class="card mb-3" id="paso5" hidden style="background-color:#10C8BF;">
        <div class="card-header"><font color="white" >
          <i class="fa fa-cogs" > 4. REPARACIONES </i></font>
        </div>
        <div class="card-body">
          <textarea name="direccion" type="text" class="form-control" rows="3" placeholder="Detalle la imagen." value="Barrio Ingles" onKeyPress="return coma(event)" required></textarea>
          <input class="form-control btn-primary" type="file" accept="image/jpg,image/png,image/jpeg,image/gif" </input><br><hr/>
          <textarea name="direccion" type="text" class="form-control" rows="3" placeholder="Detalle la imagen." value="Barrio Ingles" onKeyPress="return coma(event)" required></textarea>
          <input class="form-control btn-primary" type="file" accept="image/jpg,image/png,image/jpeg,image/gif"></input><br><hr/>
          <textarea name="direccion" type="text" class="form-control" rows="3" placeholder="Detalle la imagen." value="Barrio Ingles" onKeyPress="return coma(event)" required></textarea>
          <input class="form-control btn-primary" type="file" accept="image/jpg,image/png,image/jpeg,image/gif"></input><br><hr/>
          <textarea name="direccion" type="text" class="form-control" rows="3" placeholder="Detalle la imagen." value="Barrio Ingles" onKeyPress="return coma(event)" required></textarea>
          <input class="form-control btn-primary" type="file" accept="image/jpg,image/png,image/jpeg,image/gif"></input><br><hr/>
          <textarea name="direccion" type="text" class="form-control" rows="3" placeholder="Detalle la imagen." value="Barrio Ingles" onKeyPress="return coma(event)" required></textarea>
          <input class="form-control btn-primary" type="file" accept="image/jpg,image/png,image/jpeg,image/gif"></input><br><hr/>
          <button type="button" class="btn btn-warning pull-rigth" value="SIGUIENTE" onclick="mostrarForm('4','5');" id="btnsig4"> <i class="fa fa-toggle-left"></i></button>
          <button type="button" class="btn btn-info pull-rigth" value="SIGUIENTE" onclick="mostrarForm('6','5');" id="btnsig4"> <i class="fa fa-toggle-right"></i></button>
        </div>
      </div>


      <div class="card mb-3" id="paso6" hidden>
        <div class="card-header">
          <i class="fa fa-sticky-note"> 5. DATOS INTERNOS</i>
        </div>
        <div class="card-body">
          <input class="form-control " type="text" ></input><br>
          <button type="submit" class="btn btn-warning pull-rigth" value="SIGUIENTE" onclick="mostrarForm('5','6');" id="btnsig5"> <i class="fa fa-toggle-left"></i></button>
          <button type="submit" class="btn btn-success pull-rigth" value="SIGUIENTE"  id="btnsig5"> <i class="fa fa-cloud-upload"></i> Guardar</button>
        </div>
      </div>


       <!-- Modal Objetos Adicionales-->
  <div class="modal fade" id="registromodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">          
          <h4 class="modal-title"><CENTER>OBJETOS ADICIONALES EN EL VEHICULO</CENTER></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <label>Seleccione los objetos que se encuentran en el auto!!</label>
          <!-- Identidad -->
            <div class="md-form">
                <input type="checkbox" name=""> Alfombras</input><br>
                <input type="checkbox" name=""> Antena</input><br>
                <input type="checkbox" name=""> Radio</input><br>
                <input type="checkbox" name=""> Tapa Combustible</input><br>
                <input type="checkbox" name=""> Boleta revision</input><br>
                <input type="checkbox" name=""> Copas</input><br>
                <input type="checkbox" name=""> Encendedor</input><br>
                <input type="checkbox" name=""> Espejo Exterior</input><br>
                <input type="checkbox" name=""> Espejo Interior</input><br>
                <input type="checkbox" name=""> Llave Rueda</input><br>
                <input type="checkbox" name=""> Gata</input><br>
                <input type="checkbox" name=""> Herramientas</input><br>
                <input type="checkbox" name=""> Llanta repuesto</input><br>
                <input type="checkbox" name=""> Cenicero</input><br>
                <input type="checkbox" name=""> Triangulos</input><br>
                <input type="checkbox" name=""> Extintor</input><br>
            </div> 
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>-->
          <button type="button" class="btn btn-success" >Guardar</button>
        </div>
      </div>
      </div>
      </div>

      <div class="modal fade" id="clientemodal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal Clientes-->
      <div class="modal-content ">
        <div class="modal-header">          
          <h4 class="modal-title"><CENTER>Busqueda de Clientes</CENTER></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- Identidad -->
            <div class="md-form">                
              <label><h3>Ingrese un nombre:</h3> </label>

    <input type="text" maxlength="30" name="datosCliente" id="datosCliente" placeholder="Buscar" class="form-control" onKeyUp="buscar();"><br>
                <div class="input-prepend">
                  <div class="input-group">
                    <select value="0" class="form-control" id="listaclientes" multiple>
                      <!--<option value="0101199702810" selected>0101199702810 | FAVIO</option>
                      <option>JAVIER</option>
                      <option>RICARDO</option>
                      <option>GLORIA</option>
                      <option>FRANCISCO</option>
                      <option>MARINA</option>-->
                    </select>
                </div>
              </div>
            </div> 
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>-->
          <button type="button" class="btn btn-success"  data-dismiss="modal" onclick="selectCliente()"><i class="fa fa-check"></i> Guardar</button>
        </div>
      </div>
      </div>
      </div>

    <!--  

  <script>      
      function buscar() {
          var textoBusqueda = $("input#datosCliente").val();
          console.log("TextoBusqueda ("+textoBusqueda+")");
          if(textoBusqueda!="")
          {
            $.post("../core/core.sql.listado.clientes.registro.php",{valorBusqueda: textoBusqueda},function(mensaje) {
                $("#listaclientes").html(mensaje);
               }); 
          } else { 
              $("#listaclientes").html('');
        };
        //if(textoBusqueda=="")console.log("tb esta null");
      };
        function cargaInicial(){
          var textoBusqueda ="a";
          $.post("../core/core.sql.listado.clientes.registro.php",{valorBusqueda: textoBusqueda},function(mensaje) {
                $("#listaclientes").html(mensaje);
               }); 
        }

        function confirmaCliente()
        {
          var mensaje;
          var arr=document.getElementById("clienteregistro").value.split("|");
          //alert(arr[2]);
          var nombre=""+<?php $datos//=//explode(",",$_SESSION['username']); $nombre=explode(" ",$datos[1]); echo '"'.$nombre[0].'"';?>;
          mensaje="<label>¿"+nombre+" Esta seguro que desea Crear una orden de trabajo para <strong>"+ arr[2]+"</strong> con identidad <strong>#"+arr[1]+"</strong>?</label>";
          $("#divmodalconfirma").html(mensaje);
        }
  </script>

  <style>
    #mdialTamanio{
      height: : 80% !important;
    }
  </style>
<script>
 
      function mostrarForm($muestra,$oculta){
      //var chk = document.getElementById('check');

      document.getElementById('paso'+$muestra).hidden=false;
      document.getElementById('paso'+$oculta).hidden=true;
      //document.getElementById("barraprogreso").aria-valuenow=($muestra*20);
      $('#barraprogreso').attr("aria-valuenow",($muestra*16.6)); 
      $('#barraprogreso').attr("style","width:"+($muestra*16.6)+"%;"); 
      }

      function selectCliente()
      {
        var valor=document.getElementById('listaclientes').value;
          //alert("Valor de la lista: "+document.getElementById('listaclientes').value);
          if(valor!=""){
          document.getElementById('clienteregistro').value=valor;
          document.getElementById('btnsig1').disabled=false;
          //else alert("Error Vacio");
          //alert(document.getElementById('listaclientes').value);
        }
      }
    </script>-->
<script type="text/javascript">
    $(document).ready(function() {
      //alert("ENTRO");
      $.post("../core/core.sql.insert.php",{
        funcion: 2
      },function(mensaje) {
        $("#arreglo").html("<br>"+mensaje+"");
        //alert(mensaje); 
        //document.getElementById('btnsig1').disabled=true;
       }); 
    }); 
    
      /*$(document).ready(function() {
        //$("#resultadoBusquedaClientes").html('<p></p>');
        $.ajax({
        url: "../core/core.sql.listado.clientes.inicial.php",
        type: "POST",
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
        //Opcional, mostrar una imagen de carga mientras se obtienen los datos
       beforeSend: function() {
            $("#resultadoBusqueda").html("<img src='cargando.gif' width='30' height='30' />");
        }
        }).done(function(echo){
            $("#resultadoBusquedaClientes").html(echo);
        });
     });*/
</script>
<script type="text/javascript">
      $('.date-own').datepicker({
         minViewMode: 2,
         format: 'yyyy'
       });
  </script>
<?php
echo "
 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.5/bootstrap-notify.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.5/bootstrap-notify.min.js'></script>
";

  include 'formfooter.php';
  exit;
?>
