<?php

// session_start();
 
//Configuracion de la conexion a base de datos
/*$bd_host = "localhost"; 
$bd_usuario = "root"; 
$bd_password = "password"; 
$bd_base = "sitiocomercial"; 
$conexion = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $conexion); 
*/
$bd_host = "localhost"; 
$bd_usuario = "root"; 
$bd_password = "teamovale"; 
$bd_base = "enamorame"; 
$conexion = mysql_connect($bd_host, $bd_usuario, $bd_password); 
/*
$bd_hostrep = "localhost"; 
$bd_usuariorep = "root"; 
$bd_passwordrep = "password"; 
$bd_baserep = "enamoramedesc"; 
$conexionrep = mysql_connect($bd_hostrep, $bd_usuariorep, $bd_passwordrep); 
/*
$bd_hostrepa = "localhost"; 
$bd_usuariorepa = "root"; 
$bd_passwordrepa = "password"; 
$bd_baserepa = "enamoramerep1"; 
$conexionrepa = mysql_connect($bd_hostrepa, $bd_usuariorepa, $bd_passwordrepa); 

$grupo1=array($conexion,$conexionrep);
$grupo2=array($conexionrepa);

$grupobd1=array($bd_base,$bd_baserep);
$grupobd2=array($bd_baserepa);

*/

$conexiones = array($conexion);
$conexionesbd = array($bd_base);


//$conexionesgrupo = array($grupo1,$grupo2);
//$conexionesbdgrupo = array($grupobd1,$grupobd2);
//$conexiones = array($conexion);
//$conexionesbd = array($bd_base);


$_SESSION['miconexion']=$conexiones;
$_SESSION['miconexionbd']=$conexionesbd;
//$_SESSION['miconexionbdgrupo']=$conexionesbdgrupo;
//$_SESSION['miconexiongrupo']=$conexionesgrupo;


$elpri=$_SESSION['miconexion'];
mysql_select_db($bd_base, $elpri[0]); 



?>