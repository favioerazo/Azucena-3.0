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

?>

  <li class="breadcrumb-item active">Usuarios </li>
</ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Listado de Usuarios</div>
        <div class="card-body">
          <div class="table-responsive">
          <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
            <?php 
          if(isset($_GET['msg'])){
            echo ' <div class="container">
                      <div class="alert alert-success alert-dismissible" id="sms" >
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>ATENCION:</strong> '.$_GET['msg'].'
                      </div>
                    </div>';
          }
          ?>
            <form class="form-horizontal" action='GUI.usuarios.opciones.php' method="post">
                <fieldset>
                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center"><i></i></span>
                        <div class="col-md-8">
                          <label for="state_id" class="control-label">Seleccione un Usuario: </label>
                        <select class="form-control" id="usuario" name="usuario">
      <?php
 
        require_once ('../core/conexion.php');
                             /*$usuario = "root";
          $password = "";
          $servidor = "localhost";
         $basededatos = "controlac";
        
          // creación de la conexión a la base de datos con mysql_connect()
          $conexion = mysqli_connect( $servidor, $usuario, "" ) or die ("No se ha podido conectar al servidor de Base de datos");
       
          // Selección del a base de datos a utilizar
          $db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
          // establecer y realizar consulta. guardamos en variable.
*/
          $consulta = "select c_usuario, d_usuario from sist_usuarios where b_activo=1";

          //$consulta = "SELECT * FROM tbl_ac_listado";
          if(!$db->conectar()){
          exit;//echo "Se conecto";
        }else 
        {
                $resultado = $db->conexion->query( $consulta );
                  while ($columna = mysqli_fetch_array( $resultado ))
                  {
                    echo "<option  value=".$columna[0].">".$columna[1]."</option>";   
                  }
          mysqli_close( $conexion );
                                  }
                                      
                              ?>
                            </select>  
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="col-md-12 text-LEFT">
                                <button type="submit" class="btn btn-primary btn-lg">MODIFICAR</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
  include 'formfooter.php';
?>