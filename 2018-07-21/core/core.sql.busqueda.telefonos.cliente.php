<?php
//Archivo de conexión a la base de datos
require('../core/conexion.php');
//Variable de búsqueda
$consultaBusqueda = $_POST['valorBusqueda'];
//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("&lt;", "&gt;", "&quot;", "&#x27;", "&#x2F;", "&#060;", "&#062;", "&#039;", "&#047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";


//Comprueba si $consultaBusqueda está seteado
	if (isset($consultaBusqueda)) {

		//Selecciona todo de la tabla mmv001 
		//donde el nombre sea igual a $consultaBusqueda, 
		//o el apellido sea igual a $consultaBusqueda, 
		//o $consultaBusqueda sea igual a nombre + (espacio) + apellido
		$sql="SELECT * from dat_cli_telefono where d_identidad like '%$consultaBusqueda%'";
		//$mensaje="<li>".$sql."<li>";
		if(!$db->conectar()){
		    //exit;//
		    echo "No Se conecto";
		}else 
		{
			//echo "se conecto";
			$consulta = $db->conexion->query($sql);
			//echo($sql);
			//Obtiene la cantidad de filas que hay en la consulta
			$filas = mysqli_num_rows($consulta);
			//echo "$filas";

			//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
			if ($filas === 0) {
				$mensaje .= "";
			} else {
				$n=0;
				//Si existe alguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
				//echo 'Resultados para <strong>'.strtoupper($consultaBusqueda).'</strong>';strtolower(

				//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle

				while($resultados = mysqli_fetch_array($consulta)) {
					//echo "ingreso 2";
					$telefono = $resultados['d_telefono'];

					//Output
					/*$mensaje .= '
					<p>
					<strong>NOMBRE:</strong> ' . $nombre . '<br>
					<strong>IODENTIDAD:</strong> ' . $apellido . '<br>
					<strong>CORREO:</strong> ' . $edad . '<br>
					</p>';*/
					 $mensaje .='				 
		                  <li id="tel'.$n.'"">'.$telefono.' 
		                    <span onclick="eliminar(this)">
		                      <i class="fa fa-trash prefix grey-text" style="font-size:24px;color:red">                        
		                      </i> <input type="hidden" name="tel'.$n.'" value="'.$telefono.'"/>          </span> 
		                  </li>';

					 /*$telefono. "<span onclick='eliminar(this)'><i class='fa fa-trash prefix grey-text' style='font-size:24px;color:red'></i> </span> <input type='hidden' name='tel"+$n+"' value='$telefono' />";*/
					 $n++;

				};//Fin while $resultados

			}; //Fin else $filas

   			$db->desconectar();
		}

	};

	//Devolvemos el mensaje que tomará jQuery
	echo $mensaje;
?>