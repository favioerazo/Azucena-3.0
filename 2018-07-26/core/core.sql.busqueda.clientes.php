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
		$sql="SELECT * FROM dat_cli_clientes	WHERE d_nombre LIKE '%$consultaBusqueda%' OR d_identidad LIKE '%$consultaBusqueda%' order by d_nombre limit 20 ";
		if(!$db->conectar()){
		    //exit;//
		    echo "No Se conecto";
		}else 
		{
			$consulta = $db->conexion->query($sql);
			//echo($sql);
			//Obtiene la cantidad de filas que hay en la consulta
			$filas = mysqli_num_rows($consulta);

			//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
			if ($filas === 0) {
				$mensaje = "<p> No Se Encontraron Registros </p>";
			} else {
				//Si existe alguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
				//echo 'Resultados para <strong>'.strtoupper($consultaBusqueda).'</strong>';strtolower(

				//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle

				while($resultados = mysqli_fetch_array($consulta)) {
					$nombre = $resultados['d_nombre'];
					$identidad = $resultados['d_identidad'];
					$correo =strtolower($resultados['d_correo']);

					//Output
					/*$mensaje .= '
					<p>
					<strong>NOMBRE:</strong> ' . $nombre . '<br>
					<strong>IODENTIDAD:</strong> ' . $apellido . '<br>
					<strong>CORREO:</strong> ' . $edad . '<br>
					</p>';*/
					$value=$resultados['d_identidad'].",".strtoupper($resultados['d_nombre']).",".strtolower($resultados['d_correo']).",".$resultados['d_genero'].",".strtolower($resultados['d_direccion'])."";
					$mensaje.='
					<tr class="table-info">
						<td>' . $nombre . '</td>
						<td>' . $identidad . '</td>
						<td>' . strtolower($correo) . '</td>
						<td>
							<button type="button" value="'.$value.'" onClick="carga(this);" class="btn btn-info btn-SM" data-toggle="modal" data-target="#myModal">VER
							</button>
						<td>
					</tr>
					';

				};//Fin while $resultados

			}; //Fin else $filas

   			$db->desconectar();
		}

	};

	//Devolvemos el mensaje que tomará jQuery
	echo $mensaje;
?>