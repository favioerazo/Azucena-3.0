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
include 'formheader.php';
/*echo "
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>";

*/function conversorSegundosHoras($tiempo_en_segundos) {
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

  <li class="breadcrumb-item active">Control AC</li>
</ol>
      <!-- -->
      <div class="card mb-3" >
        <div class="card-header">
          <i class="fa fa-table"></i> Listado de Modulos AC</div>
        <div class="card-body">
 
          <?php // Ejemplo de conexión a base de datos MySQL con PHP.
          $listadoAC="";
          
          if(isset($_GET['msg'])){
            echo "<CENTER><P style='color:#FF0000';><br>ATENCION: ".$_GET['msg']."</CENTER>";
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
                    $listadoAC.=$columna[0].",";
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
                        <input class='form-control text-center' name='tiempo' type='number' max='60' min='5' step='5' 
                        style='width: 195px; font-family: Arial; font-size: 14pt;' id='tini' placeholder='Tiempo de uso' value='";
                        if($columna[6]>0)
                          echo $columna[6]."' ";
                        else
                          echo "10' ";


                        if($columna[4]==1)
                          echo " readonly >";
                        else
                          echo " >";
                        $var=0;
                        if($columna[5]>$now)
                          $var=$columna[5]-$now;

                        echo "
                        <label id = 'lbl1'>Tiempo restante</label>
                        <input class='form-control panel-heading text-center' type='text' name='rest' value='".conversorSegundosHoras($var)."' style='width: 195px; font-family: Arial; font-size: 14pt;' id='txttiempo".$columna[0]."' readonly >
                        
                      <input value='".$columna[3].",".$columna[4].",".$columna[0].",".$datos[0]."'  type='hidden' name='datos'/>
                      <input value='".$var."'  type='hidden' name='datostiem' id='htiempo".$columna[0]."'/>
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
        echo "$listadoAC";

        echo '
        <script type="text/javascript">

          var acl = "<?php echo $listadoAC;?>";
          var listadoac=acl.split(",");
          for (i=0;i<=listadoac.length;i++)
          {
            var cont1 = document.getElementById("htiempo").value;
           
            function contador(){
              var contador1 = document.getElementById("txttiempo");
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

              document.getElementById("htiempo").value=cont1;
              }

        </script>';

          include 'formfooter.php';
          echo "<META HTTP-EQUIV='REFRESH' CONTENT='20;URL=GUI.ac.control1.php'>";

        ?>
