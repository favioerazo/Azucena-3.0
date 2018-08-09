<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ error_reporting(0);
include_once('../include_libs/librerias_reportes/class/tcpdf/tcpdf.php');
include_once("../include_libs/librerias_reportes/class/PHPJasperXML.inc.php");
include_once('conf_reportes.php');






$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("n_orden"=>$_GET["orden"]);
$PHPJasperXML->load_xml_file("reportes/reporte_datos_orden_ingreso.jrxml");
//reporte_datos_orden_ingreso_objetos_adicionales

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
