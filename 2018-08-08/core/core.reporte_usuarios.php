<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ error_reporting(0);
include_once('../include_libs/librerias_reportes/class/tcpdf/tcpdf.php');
include_once("../include_libs/librerias_reportes/class/PHPJasperXML.inc.php");
include_once ('conf_reportes.php');






$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("fecha"=>"2018-07-19");
$PHPJasperXML->load_xml_file("reportes/reporte_log_usuarios_ingreso.jrxml");

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>