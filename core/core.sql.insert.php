<?php
	//Archivo de conexión a la base de datos
	//require('conexion.php');
	$sql="";
	$mensaje="";
	$funcion=$_POST['funcion'];
	//echo "<Funcion= ($funcion)>";
	/*$consultaBusqueda = $_POST['valorBusqueda'];
	$parametro2 = $_POST['p2'];*/
	/*if(isset($_POST['c_cliente']))
		echo "esta";
	else
		echo "no esta";*/
	//echo "<br>".$_POST['c_cliente'];
	//echo "<br>".$_POST['d_identidad'];
	//echo "<br>".$_POST['c_usuario'];
	/*exit;

	$sql=$consultaBusqueda;
	if(!$db->conectar()){
		echo "No Se conecto";
	}else
	{
		$consulta = $db->conexion->query($sql);
		$db->desconectar();
	}
	$mensaje="gf";

	if($consultaBusqueda==1)
	{
		$mensaje="Funcion1";
	}*/

	switch ($funcion) {
		case 1:
			# code...
		//$mensaje.="1Funcion #".$funcion;
		ingresoNuevoRegistro();
			break;
		case 2:
			# code...
		//$mensaje.="2Funcion #".$funcion;
		listadoSolicitudesModificables();
			break;
		case 3:
			# code...
		//$mensaje.="3Funcion #".$funcion;
		listadoClientesRegistro();
			break;
		case 4:
			# code...
		verificaExisteOrden();
			break;
		case 5:
			# code...
		updateDatosVehiculo();
			break;
		case 6:
			# code...
		cargaObjetosVehiculo();
			break;
		case 7:
			# code...
		updateObjetosVehiculo();
			break;
		case 8:
			# code...
		subirImagenDaños();
			break;
		case 9:
			# code...
		subirImagenReparaciones();
			break;
		case 10:
			# code...
		updateDatosAseguradora();
			break;
		case 11:
			# code...
		cargaDatosEncargados();
			break;
		case 12:
			# code...
			cargaDatosAseguradora();
			break;
		case 13:
			# code...
			asignaOrden();
			break;
		case 14:
			# code...
			break;
		case 15:
			# code...
			break;
		case 16:
			# code...
			break;

		default:
			# code...
		$mensaje.="6>Funcion #".$funcion;
			break;
	}
	function cargaObjetosVehiculo()
	{
		include("conexion.php");
		$sql="SELECT * from dat_reg_vehiculo_objetos_adic where b_registro_activo=1";
		//echo "$sql";
		if(!$db->conectar()){
		    //exit;//
		    echo "No Se conecto al Servidor de base de datos";
		}else
		{
			//echo "SELECT c_objeto from dat_reg_objetos_x_vehiculo WHERE c_registro='".$_POST['orden']."'";
			$objetosvehiculo=array();
			$consulta = $db->conexion->query("SELECT c_objeto from dat_reg_objetos_x_vehiculo WHERE c_registro='".$_POST['orden']."'");
			while($resultados = mysqli_fetch_array($consulta))
			{
				array_push($objetosvehiculo,$resultados['c_objeto']);
				//echo "<br>resul ".$resultados['c_objeto'];
			}
			//echo "aqui: ".$objetosvehiculo[0];
			$consulta = $db->conexion->query($sql);
			while($resultados = mysqli_fetch_array($consulta))
			{
				/*echo '<div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value="'.$resultados['c_objeto'].'">
                <label class="custom-control-label" for="'.$resultados['c_objeto'].'"><FONT SIZE=5>'.$resultados['d_objeto'].'</font></label>
            </div>';*/
            $tmp="";
            for($x=0; $x<sizeof($objetosvehiculo);$x++)
            {
            	if($resultados['c_objeto']==$objetosvehiculo[$x]){
            		$tmp= " checked";
            		break;
            	}
            }
				echo '
				<input type="checkbox" '.$tmp.' value="'.$resultados['c_objeto'].'" id="ov-'.$resultados['c_objeto'].'">
				<label class="control-label" for="ov-'.$resultados['c_objeto'].'"><FONT SIZE=4.5> '.$resultados['d_objeto'].'</font></label></br>
				';
			}
		}
   			$db->desconectar();
	}

	function ingresoNuevoRegistro(){
	include('conexion.php');
		//echo "<br>Entro en la funcion #1";
		$sql = 'INSERT INTO
		dat_reg_registro_ordenes
		(c_registro,
		c_cliente,
		d_identidad,
		c_estatus_solicitud,
		c_usuario_ingreso,
		f_fecha_ingreso,
		f_fecha_actualizo)
		VALUES ((select c_correlativo+1 from sist_correlativos where c_registro="02"),
		"'.$_POST['c_cliente'].'",
		"'.$_POST['d_identidad'].'",
		"I",
		"'.$_POST['c_usuario'].'",
		NOW(),
		NOW())';

		//$sql_n_orden="SELECT max(c_registro) as n_orden FROM dat_reg_registro_ordenes where d_identidad=".$_POST['d_identidad'];
		$sql_n_orden="SELECT c_registro, c_correlativo+1 as c_correlativo FROM sist_correlativos ";

		//echo "<br>--$sql";
		/*$correlativo="2395000002";

		echo "<br>--$sql";
		echo "<br>--$sql_n_orden";
		echo "<br>--$sql_update_correlativos";*/
		if(!$db->conectar()){
		    //exit;//
		    echo "No Se conecto al Servidor de base de datos";
		}else
		{
			$db->conexion->query($sql);
			$consulta = $db->conexion->query($sql_n_orden);
			/*$consulta = $db->conexion->query($sql_n_orden);
			if($resultados = mysqli_fetch_array($consulta))
			$correlativo ="".$resultados['n_orden'];
			$sql_update_correlativos="UPDATE sist_correlativos set c_correlativo=".$correlativo." WHERE c_registro='01'";
			$db->conexion->query($sql_update_correlativos);*/
			$correlativoOrden="";
			$correlativoAuto="";

			while($resultados = mysqli_fetch_array($consulta))
			{
				if($resultados['c_registro']=='02')
				$correlativoOrden ="".$resultados['c_correlativo'];
				elseif($resultados['c_registro']=='03')
				$correlativoAuto ="".$resultados['c_correlativo'];
			};


			$sql_insert_aseguradora="INSERT INTO
				dat_reg_aseguradora
				(c_registro,f_ingreso)
				Values
				('".$correlativoOrden."',NOW())";

			$db->conexion->query($sql_insert_aseguradora);


			$sql_automovil='
			INSERT INTO
			dat_reg_vehiculo
			(c_vehiculo,
			c_registro,
			f_fecha_ingreso)
			VALUES ((select c_correlativo+1 from sist_correlativos where c_registro="03"),
			"'.$correlativoOrden.'",
			NOW()
			)';
			$db->conexion->query($sql_automovil);


			$sql_update_correlativos="UPDATE sist_correlativos set c_correlativo=".$correlativoOrden." WHERE c_registro='02'";
			$db->conexion->query($sql_update_correlativos);

			$sql_update_correlativos2="UPDATE sist_correlativos set c_correlativo=".$correlativoAuto." WHERE c_registro='03'";
			$db->conexion->query($sql_update_correlativos2);

			/*echo "<br>$sql_update_correlativos2";
			echo "<br>$sql_update_correlativos";
			echo "<br>$sql_automovil";
			echo "<br>";
			echo "<br>";*/
			echo "<br><p class='btn-info' align='center' ><br>";
			echo "La Operacion se Realizo correctamente, El numero de orden es: <strong>".$correlativoOrden."</strong></p>";
			echo '<center><a href="../gui/GUI.registro.modificar.php?registro='.$correlativoOrden.'" align="center" class="btn btn-success">Continuar</a></center>';
			/*echo "<br>--$sql";
		echo "<br>--$sql_n_orden";
		echo "<br>--$sql_update_correlativos";*/
		}
   			$db->desconectar();
	}

	function listadoSolicitudesModificables()
	{
	include('conexion.php');
		$sql='SELECT c_registro,a.d_identidad, UPPER(d_nombre) as d_nombre,
			CASE
			    WHEN c_estatus_solicitud ="I" THEN "INGRESADA"
			    WHEN c_estatus_solicitud ="A" THEN "ASIGNADA"
			    WHEN c_estatus_solicitud ="P" THEN "PROCESADA"
			    WHEN c_estatus_solicitud ="E" THEN "EJECUTADA"
			    WHEN c_estatus_solicitud ="C" THEN "COMPLETA"
			    WHEN c_estatus_solicitud ="D" THEN "DENEGADA"
			    ELSE "NULL"
			END
			c_estatus_solicitud,
			date_format(f_fecha_ingreso,"%Y-%m-%d") as f_fecha_ingreso
			from dat_reg_registro_ordenes a,
			dat_cli_clientes b
			where b.d_identidad=""+a.d_identidad and
			c_estatus_solicitud="I"
			LIMIT 20';

			$datos='<p></p><table class="table table-responsive">
				  <thead>
				    <tr>
				      <th scope="col"># Registro</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Identidad</th>
				      <th scope="col">Estatus</th>
				      <th scope="col">Ingreso</th>
				    </tr>
				  </thead>
				  <tbody>';
		if(!$db->conectar()){
		    echo "No Se conecto al Servidor de base de datos";
		}else
		{
			$consulta = $db->conexion->query($sql);
			//echo "$sql";
			while($resultados = mysqli_fetch_array($consulta))
			{
				$datos.='<tr>
			      <th scope="row">'.$resultados['c_registro'].'</th>
			      <td>'.$resultados['d_nombre'].'</td>
			      <td>'.$resultados['d_identidad'].'</td>
			      <td>'.$resultados['c_estatus_solicitud'].'</td>
			      <td>'.$resultados['f_fecha_ingreso'].'</td>
			    </tr>';
				//$datos .="<br><p class='btn-success' align='center'>".$resultados['d_nombre']."</p>";
			}
			$datos.='</tbody>
					</table>';
		echo "$datos";
   			$db->desconectar();
		}
	}

	function listadoClientesRegistro()
	{
		include('conexion.php');
		$sql="SELECT * FROM dat_cli_clientes order by d_nombre limit 200";

		if(!$db->conectar()){
		    echo "No Se conecto al Servidor de base de datos";
		}else
		{
			$consulta = $db->conexion->query($sql);
			$filas = mysqli_num_rows($consulta);
			if ($filas === 0) {
				$mensaje = "<p> No Se Encontraron Registros </p>";
			} else {
				$n=0;
				while($resultados = mysqli_fetch_array($consulta))
				{
					$nombre = $resultados['d_nombre'];
					if($n==0)
					$mensaje.='
						<option value="'.$resultados['c_cliente'].'|'.$resultados['d_identidad'].'|'.strtoupper($nombre).'" selected>' . strtoupper($nombre ). ' | '.$resultados['d_identidad'].' </option>
					';
					else
					$mensaje.='
						<option value="'.$resultados['c_cliente'].'|'.$resultados['d_identidad'].'|'.strtoupper($nombre).'">' . strtoupper($nombre ).' | '.$resultados['d_identidad']. ' </option>
					';
					$n++;
				};//Fin while $resultados
			}; //Fin else $filas
   			$db->desconectar();
		}
		echo $mensaje;
	}

	function verificaExisteOrden()
	{
		$sql='SELECT
			count(a.c_registro) as existe,
			a.c_registro,
			b.d_nombre
			from dat_reg_registro_ordenes a,
			dat_cli_clientes b
			where a.c_registro="'.$_POST['n_orden'].'" and
			a.d_identidad=""+b.d_identidad and
			a.c_estatus_solicitud="I" ';
		$sql='SELECT
			count(a.c_registro) as existe,
			a.c_registro,
			b.d_nombre,
			c.d_marca,
			c.d_modelo,
			c.d_motor,
			c.d_tipo_vehiculo,
			c.d_numero_placa,
			c.d_anio,
			c.c_color,
			c.d_kilometraje,
			c.d_combustible
			from dat_reg_registro_ordenes a,
			dat_cli_clientes b,
			dat_reg_vehiculo c
			where a.c_registro="'.$_POST['n_orden'].'" and
			a.d_identidad=""+b.d_identidad and
			a.c_estatus_solicitud="I" and
			a.c_registro=c.c_registro';
			//echo "$sql";
		include('conexion.php');
		if(!$db->conectar()){
		    echo "No Se conecto al Servidor de base de datos";
		}else
		{
			$consulta = $db->conexion->query($sql);
			//$filas = mysqli_num_rows($consulta);
			while($resultados = mysqli_fetch_array($consulta))
			{
				if($resultados['existe']=='1'){
					echo "<br><p class='btn-success' align='center' >
					Los datos de la orden <strong># ".$_POST['n_orden']."</strong> perteneciente a <strong>".$resultados['d_nombre']."</strong> se han cargado!! <br>Presione el Boton <strong>Modificar</strong> para continuar!
					</p>";
					echo "||si";
					echo "||".$resultados['d_marca'];
					echo "||".$resultados['d_modelo'];
					echo "||".$resultados['d_motor'];
					echo "||".$resultados['d_tipo_vehiculo'];
					echo "||".$resultados['d_numero_placa'];
					echo "||".$resultados['d_anio'];
					echo "||".$resultados['c_color'];
					echo "||".$resultados['d_kilometraje'];
					echo "||".$resultados['d_combustible'];
				}else{
					echo "<br><p class='btn-danger' align='center' >
					No existe la orden <strong># '".$_POST['n_orden']."'</strong>, o se Encuentra en estado NO modificable, Intentelo nuevamente.
					</p>";
					echo "||no";
				}
			}
		}
   			$db->desconectar();
	}
	function updateDatosVehiculo()
	{
        //$arreglo=["marca","modelo","motor","tipovehiculo","placa","anio","color","kilometraje","combustible"];
		$datos=$_POST['datos_auto'];
		$sql="UPDATE dat_reg_vehiculo
		SET d_marca='".$datos[0]."',
		d_modelo='".$datos[1]."',
		d_motor='".$datos[2]."',
		d_tipo_vehiculo='".$datos[3]."',
		d_numero_placa='".$datos[4]."',
		d_anio='".$datos[5]."',
		c_color='".$datos[6]."',
		d_kilometraje='".$datos[7]."',
		d_combustible='".$datos[8]."'
		WHERE c_registro='".$_POST['orden']."'";
		include('conexion.php');
		if(!$db->conectar()){
		    echo "No Se conecto al Servidor de base de datos";
		}else
		{
			$db->conexion->query($sql);
		}
   			$db->desconectar();
		//echo "$sql";
		//echo "Datos: ".$datos[0];
	}
	function updateObjetosVehiculo()
	{
		$sql="DELETE from dat_reg_objetos_x_vehiculo WHERE c_registro= '".$_POST['orden']."' ";
		$sql_insert="INSERT INTO dat_reg_objetos_x_vehiculo (c_registro, c_objeto) VALUES ";
		$arr;
		if (isset($_POST['v_datos'])) {
			$arr=$_POST['v_datos'];
			//echo "\nSe envio\n";
			# code...
		}else $arr="";
		/*echo "aqui >>>>(".sizeof($_POST['v_datos']).")\n";*/

		if($arr!=""){
			for ($i=0; $i < sizeof($arr) ; $i++) {
				# code...
				if ($i==0) {
					$sql_insert.="('".$_POST['orden']."','".$arr[$i]."')";
				}else
				$sql_insert.=",('".$_POST['orden']."','".$arr[$i]."')";
			}
		}
		echo "$sql_insert";
		include('conexion.php');
		if(!$db->conectar()){
		    echo "No Se conecto al Servidor de base de datos";
		}else
		{
			$db->conexion->query($sql);

			//echo "\n($arr)\n";
			if($arr!=""){
				echo "\ncargo\n";
				$db->conexion->query($sql_insert);
			}
			else{
				echo "\nno cargo\n";
			}
			//
		}
   			$db->desconectar();

	}
	function subirImagenDaños()
	{
        include('conexion.php');
		if(!$db->conectar()){
		    echo "No Se conecto al Servidor de base de datos";
		}else
		{
			$form=["text-img-d-1", "text-img-d-2", "text-img-d-3", "text-img-d-4", "text-img-d-5", "img-d-1", "img-d-2", "img-d-3", "img-d-4", "img-d-5"];
	        for ($x=5; $x <sizeof($form) ; $x++) {
	        	$ruta_nombre = "../imagenes/".$_POST['n_orden']."_".$form[$x].".jpg";
	        	//echo "<br> ".$ruta_nombre;
	        	if(move_uploaded_file($_FILES[$form[$x]]['tmp_name'], $ruta_nombre))
				{
					//echo "El archivo ". $ruta_nombre . " ha sido subido";
					$sql="DELETE FROM dat_reg_imagenes WHERE c_registro='".$_POST['n_orden']."' and c_imagen='".$form[$x]."'";
					echo "$sql";

					$db->conexion->query($sql);
					$db->conexion->query('INSERT INTO dat_reg_imagenes
					(c_imagen,c_registro, d_imagen,d_ruta,f_ingreso)
					VALUES ("'.$form[$x].'","'.$_POST['n_orden'].'","'.$_POST[$form[$x-5]].'","'.$ruta_nombre.'",NOW())');
				} else{
					echo "Ha ocurrido un error, trate de nuevo!";
				}
	        	# code...
	        }
		}
		$db->desconectar();
	}

	function subirImagenReparaciones()
	{
        include('conexion.php');
		if(!$db->conectar()){
		    echo "No Se conecto al Servidor de base de datos";
		}else
		{
			$form=["text-img-r-1", "text-img-r-2", "text-img-r-3", "text-img-r-4", "text-img-r-5", "img-r-1", "img-r-2", "img-r-3", "img-r-4", "img-r-5"];
        	for ($x=5; $x <sizeof($form) ; $x++) {
	        	$ruta_nombre = "../imagenes/".$_POST['n_orden']."_".$form[$x].".jpg";
	        	//echo "<br> ".$ruta_nombre;
	        	if(move_uploaded_file($_FILES[$form[$x]]['tmp_name'], $ruta_nombre))
				{
					//echo "El archivo ". $ruta_nombre . " ha sido subido";
					$sql="DELETE FROM dat_reg_imagenes WHERE c_registro='".$_POST['n_orden']."' and c_imagen='".$form[$x]."'";
					echo "$sql";

					$db->conexion->query($sql);
					$db->conexion->query('INSERT INTO dat_reg_imagenes
					(c_imagen,c_registro, d_imagen,d_ruta,f_ingreso)
					VALUES ("'.$form[$x].'","'.$_POST['n_orden'].'","'.$_POST[$form[$x-5]].'","'.$ruta_nombre.'",NOW())');
				} else{
					echo "Ha ocurrido un error, trate de nuevo!";
				}
	        	# code...
	        }
		}
		$db->desconectar();
	}
	function updateDatosAseguradora()
	{
		include('conexion.php');
		if(!$db->conectar()){
		    echo "No Se conecto al Servidor de base de datos";
		}else
		{
			$sql="UPDATE dat_reg_aseguradora SET d_empresa='".$_POST['d_empresa']."', c_reclamo='".$_POST['c_reclamo']."'
			, c_poliza='".$_POST['c_poliza']."' WHERE c_registro='".$_POST['n_orden']."'";
			echo "$sql";
			$db->conexion->query($sql);
		}
		$db->desconectar();
	}
	function cargaDatosEncargados()
  {
		include('conexion.php');
		$sql="select a.c_usuario, b.d_usuario
				from web_opciones_x_usuario_modulo a,
				sist_usuarios b
				Where a.c_usuario=b.c_usuario and a.c_opcion='0303'";
				echo "$sql";

		if(!$db->conectar()){
		    echo "No Se conecto al Servidor de base de datos";
		}else
		{
				$consulta = $db->conexion->query($sql);
				$filas = mysqli_num_rows($consulta);
				$mensaje='';
				if ($filas === 0) {
					$mensaje = "<p> No Se Encontraron Registros </p>";
				} else {
					$n=0;
					while($resultados = mysqli_fetch_array($consulta))
					{
						$nombre = $resultados['d_usuario'];
						if($n==0)
						$mensaje.='
							<option value="'.$resultados['c_usuario'].'" selected>' . strtoupper($resultados['c_usuario'] ).
							' | '.strtoupper($resultados['d_usuario']).' </option>';
						else
						$mensaje.='
							<option value="'.$resultados['c_usuario'].'">' . strtoupper($resultados['c_usuario'] ).
							' | '.strtoupper($resultados['d_usuario']).' </option>';
						$n++;
					};//Fin while $resultados
				}; //Fin else $filas
					$db->desconectar();
					echo $mensaje;
		}
	}

	function cargaDatosAseguradora()
	{
		$sql='SELECT * from dat_reg_aseguradora where c_registro="'.$_POST["n_orden"].'"';
			//echo "$sql";
		include('conexion.php');
		if(!$db->conectar()){
		    echo "No Se conecto al Servidor de base de datos";
		}else
		{
			$consulta = $db->conexion->query($sql);
			//$filas = mysqli_num_rows($consulta);
			while($resultados = mysqli_fetch_array($consulta))
			{
					echo "".$resultados['d_empresa'];
					echo "|".$resultados['c_reclamo'];
					echo "|".$resultados['c_poliza'];
			}
		}
   	$db->desconectar();
	}
	function asignaOrden()
	{
		$sql='INSERT INTO
			dat_reg_informacion_interna
			(c_registro,
				v_costo_estimado,
				d_forma_pago,
				v_adelanto_pago_trabajo,
				f_posible_entrega,
				d_observaciones,
				c_usuario_encargado,
				f_asignacion,
				c_usuario_asigno)
			VALUES ("'.$_POST['n_orden'].'","'.$_POST["v_costo_estimado"].'",
				"'.$_POST["d_forma_pago"].'",
				"'.$_POST["v_adelanto_pago_trabajo"].'",
				"'.$_POST["f_posible_entrega"].'",
				"'.$_POST["d_observaciones"].'",
				"'.$_POST["c_usuario_encargado"].'",
				NOW(),
				"'.$_POST["c_usuario_asigno"].'")';

		$sql_update='UPDATE dat_reg_registro_ordenes set c_estatus_solicitud="A",
			c_usuario_actualizo="'.$_POST["c_usuario_asigno"].'",
			c_usuario_asigno="'.$_POST["c_usuario_asigno"].'",
			f_fecha_actualizo=NOW(), f_fecha_asigno=NOW()
			where c_registro="'.$_POST['n_orden'].'"';
			//echo $_POST["n_orden"];
	/*	echo "\n".$sql;
	echo $sql_update;*/
		include('conexion.php');
		if(!$db->conectar()){
		    echo "No Se conecto al Servidor de base de datos";
		}else
		{
			$db->conexion->query($sql);
			$db->conexion->query($sql_update);
		}
   	$db->desconectar();
	}
?>
