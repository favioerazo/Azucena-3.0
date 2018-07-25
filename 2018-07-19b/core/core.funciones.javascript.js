
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
         // var textoBusqueda ="a";
          /*$.post("../core/core.sql.listado.clientes.registro.php",{valorBusqueda: textoBusqueda},function(mensaje) {
                $("#listaclientes").html(mensaje);
               }); */
               $.post("../core/core.sql.insert.php",{
                funcion: 3},function(mensaje) {
                $("#listaclientes").html(mensaje);
               });
        }
        function cargaDatosOrden()
        {          
            var orden=document.getElementById("clienteregistro").value;
            console.log("Orden: "+orden);
            if(orden!=''){
            $.post("../core/core.sql.insert.php",{
                funcion: 4,
                n_orden : orden
              },function(mensaje) {
                var datos=mensaje.split("||");
                console.log(datos);
                if(datos[1]=="si"){                  
                  document.getElementById('btnmodi').disabled=false;
                  document.getElementById('clienteregistro').readOnly=true;
                  var arreglo=["marca","modelo","motor","tipovehiculo","placa","anio","color","kilometraje","combustible"];
                  for (var i = 0; i <arreglo.length; i++) {
                    if(datos[i+2]!="")
                    {
                      if(i==0 ||i==3 ||i==8  )
                        document.getElementById(datos[i+2]).selected=true;
                      else
                      document.getElementById("form1-"+arreglo[i]).value=datos[i+2];
                    }
                  }
                }

                $("#cliente").html(datos[0]);
               });
          }else{
          alert("Debe ingresar un numero valido");}
        }
        function verificaForm1()
        {
          var correcto=true;

            var datos=[];
            //console.log(datos);
          var arreglo=["marca","modelo","motor","tipovehiculo","placa","anio","color","kilometraje","combustible"];
          for (var i = 0; i <arreglo.length; i++) {
            var tmp=document.getElementById("form1-"+arreglo[i]).value;
            //console.log("Valor de form1-"+arreglo[i]+" = "+tmp);
            if(tmp==""){
              correcto=false;
              break;
            }
            datos.push(tmp);
          }
          console.log(datos);
          if(correcto){
            mostrarForm('3','2');
            //var datos=[adios:"",hola:""];
            //console.log(datos);
          }else
            alert("Debe Completar todos los campos!");
        }
        function registroInsert($usuario){
          var textoBusqueda =6;
          var datos=document.getElementById("clienteregistro").value.split("|");
          console.log(datos);
          //alert("Entro");
          $.post("../core/core.sql.insert.php",{
            funcion: 1,
            c_cliente: datos[0],
            d_identidad: datos[1],
            c_usuario : $usuario
          },function(mensaje) {
                $("#arreglo").html("<br><p class='btn-info' align='center' >"+mensaje+"</p>"+
                  "<br><p class='btn-success' align='center' onClick=mostrarForm('2','1')>Continuar</p>");
                //alert(mensaje); 
                document.getElementById('btnsig1').disabled=true;
                document.getElementById('buscacliente').disabled=true;
               }); 
        }

        function cargarListadoOrdenes(){
          //var textoBusqueda =6;
          //var datos=document.getElementById("clienteregistro").value.split("|");
          //console.log(datos);
          $(document).ready(function() {
              $.post("../core/core.sql.insert.php",{
                funcion: 2
              },function(mensaje) {
                $("#arreglo").html("<br><p class='btn-info' align='center' >"+mensaje+"</p>"+
                  "<br><p class='btn-success' align='center' onClick=mostrarForm('2','1')>Continuar</p>");
                //alert(mensaje); 
                //document.getElementById('btnsig1').disabled=true;
               }); 
          }); 
        }
        function confirmaCliente()
        {
          /*$.notifyDefaults({
            type: 'success',
            allow_dismiss: false
          });*/
          //notify('You can not close me!');
          var mensaje;
          var arr=document.getElementById("clienteregistro").value.split("|");
          //alert(arr[2]);
          //var nombre=""+<?php $datos=explode(",",$_SESSION['username']); $nombre=explode(" ",$datos[1]); echo '"'.$nombre[0].'"';?>;
          mensaje="<label>¿Esta seguro que desea Crear una orden de trabajo para <strong>"+ arr[2]+"</strong> con identidad <strong>#"+arr[1]+"</strong>?</label>";
          $("#divmodalconfirma").html(mensaje);
        }


        function mostrarForm($muestra,$oculta){
      //var chk = document.getElementById('check');
      console.log("Mostro: "+$muestra);
      console.log("Oculto: "+$oculta);
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