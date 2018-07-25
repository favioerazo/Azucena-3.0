<?php
//Archivo de conexión a la base de datos
require('../core/conexion.php');
//Variable de búsqueda
/*if(isset($_GET["all"]))
	$consultaBusqueda ="s";
else*/
$consultaBusqueda = $_POST['valorBusqueda'];


//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("&lt;", "&gt;", "&quot;", "&#x27;", "&#x2F;", "&#060;", "&#062;", "&#039;", "&#047;");
//$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";


//Comprueba si $consultaBusqueda está seteado
	//if (isset($consultaBusqueda)) {

		//Selecciona todo de la tabla mmv001 
		//donde el nombre sea igual a $consultaBusqueda, 
		//o el apellido sea igual a $consultaBusqueda, 
		//o $consultaBusqueda sea igual a nombre + (espacio) + apellido
		//if( !strcasecmp("all",$consultaBusqueda))
		$sql="SELECT * FROM dat_cli_clientes where d_nombre like '%".$consultaBusqueda."%' order by d_nombre limit 200";
		/*else {
		$sql="SELECT * FROM dat_cli_clientes order by d_nombre limit 200";
		$mensaje="<option>Hola</option>"}*/
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
				//echo 'Resultados para <strong>'.strtoupper($consultaBusqueda).'</strong>';

				//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
				$n=0;
				while($resultados = mysqli_fetch_array($consulta)) {
					$nombre = $resultados['d_nombre'];
					// Output
					/*$mensaje .= '
					<p>
					<strong>NOMBRE:</strong> ' . $nombre . '<br>
					<strong>IODENTIDAD:</strong> ' . $apellido . '<br>
					<strong>CORREO:</strong> ' . $edad . '<br>
					</p>';*/
					
					/*$value=$resultados['d_identidad'].",".strtoupper($resultados['d_nombre']).",".strtolower($resultados['d_correo']).",".$resultados['d_genero'].",".utf8_decode ( strtolower($resultados['d_direccion']))."";*/
					if($n==0)
					$mensaje.='
						<option value="'.$resultados['c_cliente'].'|'.$resultados['d_identidad'].'|'.strtoupper($nombre).'" selected>' . strtoupper($nombre ). ' | '.$resultados['d_identidad'].'</option>
					';
					else
					$mensaje.='
						<option value="'.$resultados['c_cliente'].'|'.$resultados['d_identidad'].'|'.strtoupper($nombre).'">' . strtoupper($nombre ).' | '.$resultados['d_identidad']. '</option>
					';

					$n++;

				};//Fin while $resultados

			}; //Fin else $filas

   			$db->desconectar();
		}

	//};

	//Devolvemos el mensaje que tomará jQuery

	echo $mensaje;
	
?>