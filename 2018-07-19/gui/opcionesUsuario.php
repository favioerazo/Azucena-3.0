<?php
/*if (!isset($_POST['usuario']))
{
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=GUI.usuarios.opciones.usuarios.php'>";
    exit;
}else{*/
  /*Datos de Conexion*/
  require_once ('../core/conexion.php');
  /*$host_db = "localhost";
  $user_db = "root";
  $pass_db = "";
  $db_name = "controlac";*/
  $tbl_name = "web_modulo_opciones";

  /*$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

  if ($conexion->connect_error) {
   die("La conexion falló: " . $conexion->connect_error);
  }*/
    $sql = "select a.c_opcion from web_modulo_opciones a, web_opciones_x_usuario_modulo b where b.c_usuario='".$_POST['usuario']."' AND a.c_opcion=b.c_opcion";
    //echo "$sql";
    if(!$db->conectar()){
    exit;//echo "Se conecto";
  }else 
  {
    $result = $db->conexion->query($sql);
    //$result = $conexion->query($sql);
     $arreglo; 
    $n=0;
    echo "<br>".$result->num_rows." numero de filas<br>";
    $numfilas=$result->num_rows;
    if($numfilas>0){
    while($n < ($result->num_rows))
      {
        $row = $result->fetch_array(MYSQLI_ASSOC); 
        $arreglo[$n]=$row['c_opcion'];
          //echo ++$n." ".$row['c_opcion'];
          ++$n;  
      }  
      for($i=0; $i<count($arreglo);$i++){
          //echo "arr ".$arreglo[$i]." >>Pos: ".$i;
          
      }
    }
      //echo "opc: ".$arreglo[0];

$sql = "SELECT * FROM $tbl_name where b_activo=1";
    $result =$db->conexion->query($sql);
    //echo "Asignar Opciones <br>Filas :".$result->num_rows."<br>";
    echo '
    
        <form action="../core/core.usuarios.opciones.update.php" method="post">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>N</th>
                  <th>Opcion Modulo</th>
                  <th>Asignada</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>N</th>
                  <th>Opcion Modulo</th>
                  <th>Asignada</th>
                </tr>
              </tfoot>';
              $n=0;
    if ($result->num_rows > 0) {    
      //$longitud = count($arreglo); 
     while($n < ($result->num_rows))
      {
        $row = $result->fetch_array(MYSQLI_ASSOC); 
        echo " <tr>";

          echo "<td>".++$n."</td> "; 
          ECHO "<td> ";
        $var=0;
          /*for($i=0; $i<$longitud ;$i++){
              if(strcmp((string)$arreglo[$i],(string)$row['c_opcion'])){
                $var=1;
                echo "<br>opc> ".$row['c_opcion']."arr> ".$arreglo[$i];
                echo "<br>comparacion ".strcmp($arreglo[$i],$row['c_opcion']);
                echo "<br>n= ".$n." <br>Asignada >> ".$var." >>";

                for($i=0; $i<count($arreglo);$i++){
                   // echo "<br>array completo ".$arreglo[$i]." >>Pos: ".$i;
                    
                }
                break;
              }
          }*/
              if($numfilas>0){
              for($i=0; $i<count($arreglo);$i++){
                if($arreglo[$i]==$row['c_opcion']){
                   //echo "<br>array completo ".$arreglo[$i]." >>Pos: ".$i;
                   $var=1;break;}
                    
               }}else $var=0;
         /* if($var==1)echo "<br>Asignada >> ".$var." >>";
          else echo "<br>no Asignada";*/

        if(strlen($row['c_opcion'])>2){          
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".$row["d_opcion"]."</td>";
          echo '<td><input type="checkbox" name="ch-'.$row['c_opcion'].'" id="checkbox-'.$row['c_opcion'].'" value="'.$row['c_opcion'].'" ';
          if($var==1)
          echo' checked></input></td> </tr>';
          else 
          echo'></input></td> </tr>';
          
        }else  {  
          echo $row["d_opcion"].'</td><td>  <input type="hidden" name="ch-'.$row['c_opcion'].'" id="checkbox-'.$row['c_opcion'].'" value="'.$row['c_opcion'].','.$_POST['usuario'].'" checked readonly></input> </td></tr>';
        }
        //echo '<td><input type="checkbox" name="checkboxes" id="checkbox-'.$n.'" value="1"></input></td> </tr>';
        /*
        echo ' <label for="checkboxes-'.$n.'" id="checkbox-'.$n.'">';
        echo ++$n.". ";
        echo $row["d_opcion"].'<input type="checkbox" name="checkboxes" id="checkbox-'.$n.'" value="1">
        </label><br>';*/

        
      }   
      echo '<input type="hidden" name="my_check" value="'.$_POST['usuario'].'" />';

                echo '</tbody>
              </table>
            </div>
            <button type="submit" class="btn btn-success btn-lg">GUARDAR</button>
            </form>
          </div>
        </div>
      </div>';
      //++$n;

     } 
   }
   $db->desconectar();//mysqli_close($conexion);
 //}
 ?>