<?php
	require_once ('conexion.php');
	//$mysqli1 = new conexion1; 
	//echo $host_db;
	$sql = "SELECT * FROM tbl_usuarios ";
	//echo "$sql";
	//$db = new BaseDatos();

	if(!$db->conectar()){
		exit;//echo "Se conecto";
	}else 
	{
		$result = $db->conexion->query($sql);

		if ($result->num_rows > 0) {     
		
			while($n < ($result->num_rows))
			{
				$row = $result->fetch_array(MYSQLI_ASSOC); 
				echo "<p>Registro #".$n." > ".$row['c_usuario'];
				//echo ++$n." ".$row['c_opcion'];
				++$n;  
			}  
			$n=0;
		}
	}
	/*echo "Host: ".$mysqli1->{'host_db'};
	$mysqli1->host("Prueba");
	//$mysqli1->$host_db='prueba';	
	print "<p>Host: ".$mysqli1->{'host_db'};*/

	/*//define(MY_CONSTANT, 'aMemberVar'); 
print $foo->{MY_CONSTANT}; // Prints "aMemberVar Member Variable" 
print $foo->{'aMemberVar'}; // Prints "aMemberVar Member Variable" */

?>