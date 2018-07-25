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

?>
  <li class="breadcrumb-item active">Control AC</li>
</ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Ingreso de Modulos</div>
        <div class="card-body">
          <div class="table-responsive">
          <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
            <?php 
          if(isset($_GET['msg'])){
            echo "<CENTER><P style='color:#366FC2';><br>ATENCION: ".$_GET['msg']."</CENTER>";
            //miFuncion();
          }
          ?>
                <form class="form-horizontal" action='core.ac.insert.php' method="post">
                    <fieldset>
                        <!--<legend class="text-center header">Nuevo Modulo</legend>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i></i></span>
                            <div class="col-md-8">
                            <label class="control-label" for="Usuario de SQL">Codigo Modulo</label>
                                <input id="fname" name="usuario" type="text" placeholder="2204" class="form-control" required>
                            </div>
                        </div>-->

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i ></i></span>
                            <div class="col-md-8">
                            <label class="control-label" for="Nombre Completo">Numero Aula</label>
                                <input id="aula" name="aula" type="number" value=100 placeholder="204" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i ></i></span>
                            <div class="col-md-8">
                            <label class="control-label" for="Nombre Completo"> Descripcion </label>
                                <input id="lname" name="descripcion" type="text" placeholder="Aula 204" class="form-control" style='text-transform:uppercase' required>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i></i></span>
                            <div class="col-md-8">
                              <label for="state_id" class="control-label">Nº Piso</label>
                            <select class="form-control" id="piso" name="piso">
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                            </select>  
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i ></i></span>
                            <div class="col-md-8">
                              <label class="control-label" for="Usuario de SQL">Direccion de Red</label>
                                <input id="red" name="red" type="text" placeholder="192.168.0.125"  size='20' maxlength='15' class="form-control" onKeyUp="ValidaIP('red')" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">INGRESAR</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
/*
 * Función para validar una dirección ip
 * el identificador del formulario
 */
function ValidaIP(idForm)
{
    //Creamos un objeto 
    object=document.getElementById(idForm);
    valueForm=object.value;
 
    // Patron para la ip
    var patronIp=new RegExp("^([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3})$");
    //window.alert(valueForm.search(patronIp));
    // Si la ip consta de 4 pares de números de máximo 3 dígitos
    if(valueForm.search(patronIp)==0)
    {
        // Validamos si los números no son superiores al valor 255
        valores=valueForm.split(".");
        if(valores[0]<=255 && valores[1]<=255 && valores[2]<=255 && valores[3]<=255)
        {
            //Ip correcta
            object.style.color="#000";
            return;
        }
    }
    //Ip incorrecta
    object.style.color="#f00";
}
//-->
</script>
<?php
  include 'formfooter.php';
?>