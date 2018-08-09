<?php	
	require_once ('../core/conexion.php');
	$n=0;
	$d_identidad;
	$telefonos= array();
	$todo="<br><br>";
	$sql="INSERT INTO 
		dat_cli_clientes (c_cliente, d_identidad, d_nombre, d_genero, d_correo, d_direccion,f_ingreso) 
		values ((select c_correlativo+1 as c_correlativo from sist_correlativos where c_registro='01')";
	while ($post = each($_POST))
	{
	 // if($post[0]!='dataTable_length'){
	   // echo "<br>POST['".$post[0]."']= -->> ".$post[1];
		$todo.="<br>POST['".$post[0]."']= -->> ".$post[1];
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
		    }/*else if((strpos($post[0],'direccion'))===0)
		    {

	    	}else if ($n>0)
	    	$sql.=", '".strtoupper($post[1])."'";*/
	    	else
	    	$sql.=", '".strtoupper($post[1])."'";
	    }
	  $n++;
	}
	$sql.=",NOW())";
	//echo "<br>$sql";

	$sql_telefono='INSERT INTO dat_cli_telefono( d_identidad,d_telefono )Values';
	for ($i=0; $i <sizeof($telefonos); $i++) { 
		if($i==0)
		$sql_telefono.="('$d_identidad','$telefonos[$i]')";
		else
		$sql_telefono.=",('$d_identidad','$telefonos[$i]')";
	}
		//echo $sql;
	if(!$db->conectar())
	{
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../gui/GUI.clientes.ingreso.php?msg=No se Pudo Ingresar el Cliente, Intente nuevamente!&alert=danger'>";
		//exit;//echo "Se conecto";
		//echo $sql;
	}else 
	{
		$result=$db->conexion->query($sql);
		if(!$result){
			$e=mysqli_error($db->conexion);
			//echo "error: ".mysqli_error($db->conexion);
			echo '<script>alert("No se pudo Ingresar el Cliente ERROR: '.$e.'");</script>';
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../gui/GUI.clientes.ingreso.php?msg=Ocurrio un eror: $e!&alert=danger'>";
		}else{
		//echo " todo bien $result";

		$result=$db->conexion->query("SELECT c_correlativo+1 as c_correlativo from sist_correlativos where c_registro='01'");
		$correlativo='';

		while($resultados = mysqli_fetch_array($result)) 
		{
			
			$correlativo ="".$resultados['c_correlativo'];			
		};
		$db->conexion->query("UPDATE sist_correlativos SET c_correlativo='".$correlativo."' WHERE c_registro='01'");
		$db->conexion->query($sql_telefono);		
		$db->desconectar();
      	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../gui/GUI.clientes.ingreso.php?msg=El Cliente se ha creado Exitosamente!&alert=success'>";}
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