
function buscar() {
          var textoBusqueda = $("input#datosCliente").val();
          //console.log("TextoBusqueda ("+textoBusqueda+")");
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
        function cargaDatosVehiculo(orden)
        {
          $.post("../core/core.sql.insert.php",{
              funcion: 4,
              n_orden : orden
            },function(mensaje) {
              var datos=mensaje.split("||");
              //console.log(datos);
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
        }
        function cargaDatosOrden()
        {
            var orden=document.getElementById("clienteregistro").value;
            //console.log("Orden: "+orden);
            if(orden!=''){
               cargaDatosVehiculo(orden);
               cargaDatosAseguradora();
               cargaObjetosForm();
          }else{
          alert("Debe ingresar un numero valido");}
        }
        function updateDatosVehiculo()
        {
          var correcto=true;

            var datos=[];

            var n_orden=document.getElementById("clienteregistro").value;
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
          //console.log(datos);
          if(correcto){
            //var datos=[adios:"",hola:""];
            //console.log(datos);
            $.post("../core/core.sql.insert.php",{
              funcion: 5,
              datos_auto : datos,
              orden : n_orden
            },function(mensaje) {
                //$("#arreglo").html("<br><p class='btn-info' align='center' >"+mensaje+"</p>"+
                 // "<br><p class='btn-success' align='center' onClick=mostrarForm('2','1')>Continuar</p>");
                console.log(mensaje);
                updateObjetosAdicionales();
               });
          }else
            alert("Debe Completar todos los campos para actualizar!");
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
                $("#arreglo").html(mensaje);
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
      //console.log("Mostro: "+$muestra);
      //console.log("Oculto: "+$oculta);
      document.getElementById('paso'+$muestra).hidden=false;
      document.getElementById('paso'+$oculta).hidden=true;
      //document.getElementById("barraprogreso").aria-valuenow=($muestra*20);
      $('#barraprogreso').attr("aria-valuenow",($muestra*14.3));
      $('#barraprogreso').attr("style","width:"+($muestra*14.3)+"%;");
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

      function cargaObjetosForm()
      {
        //alert("Cargo");
        var n_orden=document.getElementById("clienteregistro").value;
        $.post("../core/core.sql.insert.php",{
        funcion: 6,
        orden : n_orden
        },function(mensaje) {
          $("#listaObjetos").html(mensaje);
          //console.log(mensaje);
          //$("#listaObjetos").append(mensaje);
          //alert(mensaje);
          //document.getElementById('btnsig1').disabled=true;
         });
      }

      function updateObjetosAdicionales(){
        var datos=[];
        var n_orden=document.getElementById("clienteregistro").value;

        for (var i = 0; i < 100; i++) {
          if ( $("#ov-"+i).length > 0 &&  $("#ov-"+i).prop('checked')  ) {
           datos.push( $("#ov-"+i).val());
          }
        }
        //console.log("Largo: "+datos.length);
        $.post("../core/core.sql.insert.php",{
        funcion: 7,
        orden : n_orden,
        v_datos : datos
        },function(mensaje) {
          //$("#listaObjetos").html(mensaje);
          //$("#listaObjetos").append(mensaje);
          //console.log(mensaje);
          console.log("Actualizo");
          //document.getElementById('btnsig1').disabled=true;
         });
      }
      function cargaImagenesDaños()
      {
        var form=["text-img-d-1", "text-img-d-2", "text-img-d-3", "text-img-d-4", "text-img-d-5", "img-d-1", "img-d-2", "img-d-3", "img-d-4", "img-d-5"];
        var datos=[];
        var completo=true;
        for (var i = 0; i <form.length; i++) {
          if(document.getElementById(form[i]).value==""){
            alert("Debe llenar todos los Datos");
            completo=false;
            break;
          }
        }
        if(completo)
        {

        var n_orden=document.getElementById("clienteregistro").value;
        //var img1=document.getElementById("img-d-1");
        var formData = new FormData(document.getElementById("formImagenesDaños"));
          formData.append("funcion","8");
          formData.append("n_orden",n_orden);
            $.ajax({
                    url: "../core/core.sql.insert.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(datos)
                    {
                        //console.log(datos);
                        mostrarForm('5','4');
                    }
                });
        }
    }
      function cargaImagenesReparaciones()
      {
        var form=["text-img-r-1", "text-img-r-2", "text-img-r-3", "text-img-r-4", "text-img-r-5", "img-r-1", "img-r-2", "img-r-3", "img-r-4", "img-r-5"];
        var datos=[];
        var completo=true;
        for (var i = 0; i <form.length; i++) {
          if(document.getElementById(form[i]).value==""){
            alert("Debe llenar todos los Datos");
            completo=false;
            break;
          }
        }
        if(completo)
        {

        var n_orden=document.getElementById("clienteregistro").value;
        //var img1=document.getElementById("img-d-1");
        var formData = new FormData(document.getElementById("formImagenesReparaciones"));
          formData.append("funcion","9");
          formData.append("n_orden",n_orden);
            $.ajax({
                    url: "../core/core.sql.insert.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(datos)
                    {
                        //console.log(datos);
                        mostrarForm('6','5');
                    }
                });
        }
    }

      function coma(e) {
          tecla=(document.all) ? e.keyCode : e.which;
          if (tecla==44 || tecla==34 || tecla==39 || tecla==43
            || tecla==46 || tecla==39) {
              //alert('Sin comas, tío');
              return false;
          }
      }

      function habilitaAdelanto()
      {
        if(document.getElementById("ch-a").checked==true){
        //  document.getElementById("txt-adelanto").readOnly=false;
            document.getElementById("txt-adelanto").hidden=false;
            /*$("#txt-adelanto").fadeIn();
            $("#txt-adelanto").fadeIn("slow");
            $("#txt-adelanto").fadeIn(3000);*/
        }else{
          //document.getElementById("txt-adelanto").readOnly=true;
            document.getElementById("txt-adelanto").hidden=true;
          document.getElementById("txt-adelanto").value="";
        }
      }
      function formapago()
      {
        //alert(document.getElementById("forma-pago").value);
        if(document.getElementById("forma-pago").value=="OTRO")
          document.getElementById("forma-pago-otro" ).hidden=false;
          else
            document.getElementById("forma-pago-otro" ).hidden=true;
      }
      function getDatos()
      {
        alert(document.getElementById("img-d-1").value);
      }

      function updateDatosAseguradora()
      {
        var n_orden=document.getElementById("clienteregistro").value;
        $.post("../core/core.sql.insert.php",{
        funcion: 10,
        n_orden : n_orden,
        c_poliza : document.getElementById("c_poliza_aseguradora").value,
        c_reclamo : document.getElementById("c_reclamo_aseguradora").value,
        d_empresa : document.getElementById("d_nombre_aseguradora").value,
        },function(mensaje) {
          //$("#listaObjetos").html(mensaje);
          //$("#listaObjetos").append(mensaje);
          //console.log(mensaje);
          //console.log("Actualizo");
          //document.getElementById('btnsig1').disabled=true;
         });
      }
      function cargaListadoEncargados()
      {
        var n_orden=document.getElementById("clienteregistro").value;
        $.post("../core/core.sql.insert.php",{
        funcion: 11,
        },function(mensaje) {
          $("#listaEncargados").html(mensaje);
          //$("#listaObjetos").append(mensaje);
          //console.log(mensaje);
          //console.log("Actualizo");
          //document.getElementById('btnsig1').disabled=true;
        });
      }
      function setEncargado()
      {
        var valor=document.getElementById('listaEncargados').value;
          //alert("Valor de la lista: "+document.getElementById('listaclientes').value);
          if(valor!=""){
          document.getElementById('id-encargado').value=valor;
          //else alert("Error Vacio");
          //alert(document.getElementById('listaclientes').value);
        }
      }
      function cargaDatosAseguradora()
      {
        var orden=document.getElementById("clienteregistro").value;
        $.post("../core/core.sql.insert.php",
        {
          funcion: 12,
          n_orden : orden
        },function(mensaje)
        {
          var datos=mensaje.split("|");
          //console.log(datos);
          document.getElementById("d_nombre_aseguradora").value=datos[0];
          document.getElementById("c_poliza_aseguradora").value=datos[1];
          document.getElementById("c_reclamo_aseguradora").value=datos[2];

        });
      }
      function verificaDatosInternos()
      {
        var tmp=document.getElementById("fecha-entrega").value.split("-");
        /*alert(tmp[0]);
        alert(tmp[1]);
        alert(tmp[2]);*/
        var date=new Date(tmp[0],tmp[1]-1,tmp[2]);
        var f = new Date(new Date().getFullYear(),new Date().getMonth(),new Date().getDate());
        /*if(date<f)
        alert("Debe Seleccionar una Fecha Mayor a: "+f);*/
        //alert(date);
        var paso=true;
        var f_pago=document.getElementById("forma-pago").value;
        if(document.getElementById("costo_estimado").value==""){
          paso=false;
          alert("Debe Detallar un costo Estimado al Trabajo!!");
        }else if(f_pago=="OTRO" && document.getElementById("forma-pago-otro").value=="")
        {
          alert("Debe Detallar la forma de Pago!!");
            paso=false;
        }else if(document.getElementById("txt-adelanto").hidden==false && document.getElementById("txt-adelanto").value=="")
        {
          alert("Debe Detallar El monto de Adelanto Recibido!!");
            paso=false;
        }else if(document.getElementById("fecha-entrega").value=="")
        {
          alert("Debe Seleccionar una Fecha Aproximada de Entrega del Trabajo!!");
          paso=false;
        }else if(date<f)
        {
          alert("Debe Seleccionar una Fecha Mayor o igual a: "+f);
          paso=false;
        }else if(document.getElementById("id-encargado").value=="")
        {
          alert("Debe Seleccionar un encargado para el trabajo");
          paso=false;
        }else {
          asignaOrden();
        }

        return paso;
      }
      function asignaOrden()
      {
        var orden=document.getElementById("clienteregistro").value;
        orden=2395000001;
        var f_pago=document.getElementById("forma-pago").value;
        if(document.getElementById("forma-pago-otro").value!="")
        f_pago+="|"+document.getElementById("forma-pago-otro").value;

        var adelanto;
        if(document.getElementById("txt-adelanto").value!="")
        adelanto=document.getElementById("txt-adelanto").value;
        else {
          adelanto="0.00";
        }
        $.post("../core/core.sql.insert.php",
        {
          funcion: 13,
          n_orden : 2395000001,
          v_costo_estimado : document.getElementById("costo_estimado").value,
          d_forma_pago : (f_pago),
          v_adelanto_pago_trabajo : adelanto,
          f_posible_entrega : document.getElementById("fecha-entrega").value,
          d_observaciones : document.getElementById("txt-observaciones").value,
          c_usuario_encargado : document.getElementById("id-encargado").value,
          c_usuario_asigno : obtieneUsuarioActual()
        },function(mensaje)
        {
          //console.log(mensaje);
          mostrarForm("7","6");
          document.getElementById("btnImprimeOrden").href="../core/core.reporte_orden.php?orden="+orden;
        });
      }
     /* $(function(){
        $("input[name='img-d-1']").on("change", function(){

        alert(document.getElementById("img-d-1").value);
        });
     });*/
    /*function subirImg()
    {
      $(function(){
        $("#formuploadajax").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formImagenes"));
            formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: "recibe.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
       processData: false
            })
                .done(function(res){
                    $("#mensaje").html("Respuesta: " + res);
                });
        });
    });
    }*/
