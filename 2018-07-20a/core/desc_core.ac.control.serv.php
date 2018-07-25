<?php	// Ejemplo de conexión a base de datos MySQL con PHP.
	//
	// Ejemplo realizado por Oscar Abad Folgueira: http://www.oscarabadfolgueira.com y https://www.dinapyme.com
	$now = time();
	// Datos de la base de datos
	$datos=$_POST['datos'];
	/*$datoss=explode(",",$_SESSION['username']);
	$nombre=explode(" ",$datoss[1]); */
	//echo "$datos";
	$d=explode(",",$datos);
	/*echo "<br>$d[0]"; //Direccion ServModulo
	echo "<br>$d[1]"; //B_estado
	echo "<br>$d[2]";//c_modulo
	echo "<br>$d[3]";//c_modulo
	echo "<br>restante ".$_POST['rest'];//c_modulo
	echo "<br>tiempo apagado".$_POST['tiempo'];//c_modulo*/
	//echo "<br>$_POST['tiempo']";//c_modulo
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
	//$t_fin_temporizador=$now+($_POST['tiempo']*5);
	//$t_restante_temporizador=$t_fin_temporizador-$now;
	$c_usuario_modifico=strtoupper($d[3]);

	
	// creación de la conexión a la base de datos con mysql_connect()
	$conexion = mysqli_connect( $servidor, $usuario, "" ) or die ("No se ha podido conectar al servidor de Base de datos");
	
	// Selección del a base de datos a utilizar
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
	// establecer y realizar consulta. guardamos en variable.
	//$update1 = "UPDATE tbl_ac_estado SET b_estado=$d[1] WHERE c_modulo=$c_modulo";

	//if (strpos($output, "TTL=255")) {echo "$output";
	if($b_estado==0){

		$update1 = "UPDATE tbl_ac_estado SET b_estado=1 WHERE c_modulo=$c_modulo";
		$update2 = "UPDATE tbl_temporizador set t_apagado_ac=".$_POST['tiempo'].", t_fin_temporizador=$t_fin_temporizador, t_restante_temporizador=$t_restante_temporizador, 
		c_usuario_modifico='$c_usuario_modifico'  where c_modulo=$c_modulo
		";
	}else {
		$update1 = "UPDATE tbl_ac_estado SET b_estado=0 WHERE c_modulo=$c_modulo";
			$update2 = "UPDATE tbl_temporizador set t_apagado_ac=0, t_fin_temporizador=0, t_restante_temporizador=0, 
		c_usuario_modifico='$c_usuario_modifico' where c_modulo=$c_modulo
		";
	}
	//echo "<br>$update1";
	//	echo "<br>$update2";
	//$consulta = "SELECT * FROM tbl_ac_listado";
	//$resultado = 
	$ip = $d[0];
	//$output = shell_exec("ping $ip");
	 
	//if (strpos($output, "TTL=255") or strpos($output, "TTL=64")) {echo "$output";
	    mysqli_query( $conexion, $update1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	    mysqli_query( $conexion, $update2 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	    mysqli_close( $conexion );	
	    //header('Location: http://localhost/controlac/GUI.ac.control1.php');	
	    //header('Location: http://'.$d[0].'/USER=ON ');	 
	     //echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=http://".$d[0]."/USER=ON '>";

	    /*USER=ON cuando es el usuario
	    SERV=ON cuando es el servidor*/   
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=http://172.20.10.253/time/index.php'>";
	/*} else {
	    //echo 'Conectado';
	    echo "$output";
	    echo 'No Conectado';
	    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=GUI.ac.control1.php?msg=El Modulo No se Encuentra en la Red, Verifique la Conexion!!'>";
	    
	}*/
	// cerrar conexión de base de datos
?>