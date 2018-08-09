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
if (!isset($_POST['usuario'])){
  echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=GUI.usuarios.opciones.usuarios.php'>";
  exit;
}
include 'formheader.php';
?>
        <li class="breadcrumb-item active">Usuarios </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Opciones de Usuarios </div>
        <div class="card-body">
          <div class="table-responsive">
          <?php // Ejemplo de conexión a base de datos MySQL con PHP.
          //
          echo "Opciones del Usuario: ".$_POST['usuario'];

          include_once 'opcionesUsuario.php';
          // Ejemplo realizado por Oscar Abad Folgueira: http://www.oscarabadfolgueira.com y https://www.dinapyme.com
          
          // Datos de la base de datos
          /*$usuario = "root";
          $password = "";
          $servidor = "localhost";
          $basededatos = "controlac";
          
          // creación de la conexión a la base de datos con mysql_connect()
          $conexion = mysqli_connect( $servidor, $usuario, "" ) or die ("No se ha podido conectar al servidor de Base de datos");
          
          // Selección del a base de datos a utilizar
          $db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
          // establecer y realizar consulta. guardamos en variable.

          $consulta = "SELECT a.C_MODULO, a.D_MODULO, a.C_AULA, a.c_direccion_red, b.b_estado FROM tbl_ac_listado a, tbl_ac_estado b where a.c_modulo=b.c_modulo and a.b_activo=1";
          //$consulta = "SELECT * FROM tbl_ac_listado";
          $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
          
          echo "
              <div class='table table-bordered' style='background-color:#0687F0;''> 
                <table id='tabla1' class='table table-bordered' border = 2 cellpadding = 0.5>";
                  echo "<tr>";
                    echo "<th>Codigo</th>";
                    echo "<th>Descripcion</th>";
                    echo "<th>Aula</th>";
                    echo "<th>Direccion</th>";
                    echo "<th>Estado</th>";
                  echo "</tr>";         
                  while ($columna = mysqli_fetch_array( $resultado ))
                  {
                    $estado='';
                    if($columna[4]==0){
                      //$tbl=" class='danger' ";
                      $estado=" value='Apagado' class='btn btn-danger'";
                    }else{
                      $estado=" value='Encendido' class='btn btn-primary btn-success' ";
                    }

                    echo "<td>" . $columna[0] . "</td>";
                    echo "<td>" . $columna[1] . "</td>";
                    echo "<td>" . $columna[2] . "</td>";
                    echo "<td>" . $columna[3] . "</td>";
                    //ñ "<td>" . $columna['b_activo'] . "</td>";
                    //echo "<td> <input type='button' value='Inicio'  href='http://google.com'/>  </td>";

                        //<form action=".$columna[3]."/ENCENDIDO=ON method='post' >
                    echo "<td>
                        <form action='actualizar.php' method='post' > 
                          <input value='".$columna[3].",".$columna[4].",".$columna[0]."''  type='hidden' name='datos'/>      
                           <input ".$estado." type='submit'  name='Procesado' />
                        </form>
                      </td>";
                    echo "</tr>"; 
                  }
              
              echo "</table>
              </div>";
          
          echo "</table>"; // Fin de la tabla
          // cerrar conexión de base de datos
          mysqli_close( $conexion );*/

          include 'formfooter.php';
        ?>
            