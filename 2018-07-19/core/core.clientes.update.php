<?php	
	require_once ('../core/conexion.php');
	$n=0;
	$d_identidad;
	$telefonos= array();
	$todo="<br><br>";
	$sql="UPDATE 
		dat_cli_clientes SET ";
	    //echo "$sql";
	while ($post = each($_POST))
	{
	 // if($post[0]!='dataTable_length'){
	 	//Busca el valor de la identidad del cliente y lo asigna a una variable
	    	if(strnatcasecmp($post[0],'id')===0)
	    		$d_identidad=$post[1];

	    //echo "<br>$n POST['".$post[0]."']= -->> ".$post[1];
	    switch ($n) {
	    	case 0:
	    		# code...
	    		$d_identidad=$post[1];
	    	break;
	    	case 1:
	    		$sql.= "d_nombre='".$post[1]."'";
	    	break;
	    	case 2:
	    		$sql.= ", d_correo='".$post[1]."'";
	    	break;	    	
	    	default:
	    		if(strpos($post[0], 'tel')===0)
	    		{	    			
	    			$var=$post[1];
	    			if($var=!null && $var!="" )
	    			{
	    				array_push($telefonos, $post[1]);
	    			}
	    		}elseif(strpos($post[0], 'direccion')===0)
	    		{
	    			$sql.= ", d_direccion='".$post[1]."'";
	    		}
	    	break;
	    }
	    $n++;
		/*$todo.="<br>POST['".$post[0]."']= -->> ".$post[1];
	    $encontro=strpos($post[0], 'tel');
	    //echo "<br>  Valor de encontro: ( $encontro )> posicion ".$n." ";
	    if( $encontro ===0)
	    {
	    	//echo " (entro )".$post[1];
	    	$var=$post[1];
	    	if($var=!null && $var!="" )
	    	{
	    		array_push($telefonos, $post[1]);
	    		//$telefonos.=$post[1].",";//echo "POST['".$post[0]."']=  -->> ".$post[1];
	    	}//else echo "POST['".$post[0]."']=Vacio";

	    }else{
	    	//Busca el valor de la identidad del cliente y lo asigna a una variable
	    	if(strnatcasecmp($post[0],'id')===0)
	    		$d_identidad=$post[1];

	    	$encontro=strpos($post[0],'genero');
		    //echo "<br>  Valor de encontro: ( $encontro )> posicion ".$n." ";
		    if( $encontro ===0)
		    {
		    	//echo "comparacion".strnatcasecmp($post[1],'masculino');
		    	if(strnatcasecmp($post[1],'masculino')===0)
		    	{
		    		 $sql.=",'M'";
		    	}else 
		    		$sql.=",'F'";
		    }else if ($n>0)
	    	$sql.=", '".strtoupper($post[1])."'";
	    	else
	    	$sql.="'".strtoupper($post[1])."'";
	    }
	  $n++;*/
	}
	$sql.= ", f_modificacion=NOW() WHERE d_identidad like '%".$d_identidad."%'";
	//echo "$sql";
	/*
	for ($i=0; $i <sizeof($telefonos); $i++) { 
		echo "<br> Telefono: ".$telefonos[$i];
	}*/

//exit;
	$sql_telefono='INSERT INTO dat_cli_telefono(d_identidad,d_telefono) Values';
	for ($i=0; $i <sizeof($telefonos); $i++) { 
		if($i==0)
		$sql_telefono.="('$d_identidad','$telefonos[$i]')";
		else
		$sql_telefono.=",('$d_identidad','$telefonos[$i]')";
	}
	if(!$db->conectar())
	{
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../gui/GUI.clientes.listado.php?msg=No se Pudo Ingresar el Cliente, Intente nuevamente!&alert=danger'>";
		//exit;//echo "Se conecto";
	}else 
	{
		$db->conexion->query(utf8_decode ( $sql));
		$db->conexion->query("DELETE FROM dat_cli_telefono WHERE d_identidad like '%".$d_identidad."%'");
		$db->conexion->query($sql_telefono);
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../gui/GUI.clientes.listado.php?msg=El Cliente se ha creado Exitosamente!&alert=success'>";
	}

	exit;
	$sql.=",NOW())";
	//echo "<br>$sql";

	$sql_telefono='INSERT INTO dat_cli_telefono( d_identidad,d_telefono )Values';
	for ($i=0; $i <sizeof($telefonos); $i++) { 
		if($i==0)
		$sql_telefono.="('$d_identidad','$telefonos[$i]')";
		else
		$sql_telefono.=",('$d_identidad','$telefonos[$i]')";
	}
	if(!$db->conectar())
	{
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../gui/GUI.clientes.ingreso.php?msg=No se Pudo Ingresar el Cliente, Intente nuevamente!&alert=danger'>";
		//exit;//echo "Se conecto";
	}else 
	{
		$result=$db->conexion->query($sql);
		if(!$result){
			$e=mysqli_error($db->conexion);
			//echo "error: ".mysqli_error($db->conexion);
			echo '<script>alert("No se pudo Ingresar el Cliente ERROR: '.$e.'");</script>';
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../gui/GUI.clientes.ingreso.php?msg=Ocurrio un eror: $e!&alert=danger'>";
		}else
		//echo " todo bien $result";
		$db->conexion->query($sql_telefono);		
		$db->desconectar();
      	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../gui/GUI.clientes.ingreso.php?msg=El Cliente se ha creado Exitosamente!&alert=success'>";
	}
	exit;
	// Datos de la base de datos
	$datos=$_POST['datos'];
	//echo "$datos";
	$d=explode(",",$datos);
	$usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "controlac";

	$b_estado=$d[1];
	if($d[1]==0)
		$d[1]=1;
	else
		$d[1]=0;


	//$b_estado=$d[1];
	$c_modulo=$d[2];
	//$t_fin_temporizador=$now+($_POST['tiempo']*60);
	$t_fin_temporizador=$now+($_POST['tiempo']*1);
	$t_restante_temporizador=$t_fin_temporizador-$now;
	$c_usuario_modifico=strtoupper($d[3]);
	// cerrar conexión de base de datos
	echo "
	<script>
		function error(dato)
		{
			alert('ERROR: No se pudo Ingresar el Cliente: '+dato);
		}
	</script>";
?>