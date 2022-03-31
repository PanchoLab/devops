<?php



include("conexion.php");



require ('xajax/xajax_core/xajax.inc.php');



$xajax = new xajax(); 



session_start();



if(isset($_SESSION['carro'])) 



$carro=$_SESSION['carro'];



else $carro=false; 







function cierra_sesion()



{



if (isset($_SESSION['usuario']))



{



session_unset();



session_destroy();







$mipos = new xajaxResponse(); 



   //escribimos en la capa con id="respuesta" el texto que aparece en $salida 



   $mipos->script("location.href='index.php';");







   



   //assign("mipos","innerText",$pos); 







    //tenemos que devolver la instanciación del objeto xajaxResponse 



return $mipos; 







}



}


function misvisitas($id_productoc){

if(!isset($_SESSION["id_perfil"])) $_SESSION["id_perfil"]="0";

$id_perfil=$_SESSION["id_perfil"];

if( isset($_SERVER['HTTP_X_FORWARDED_FOR']) &&
   $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
{
$IP=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
$IP=$_SERVER['REMOTE_ADDR'];

$details = json_decode(file_get_contents('http://freegeoip.net/json/'.$IP));

 $sql = "insert into misvisitas (id_producto,id_perfil,ip,pais,cuidad,comuna,latitud,longitud,fechahora) values (".$id_productoc.",".$id_perfil.",'".$IP."','".$details->country_name."','".$details->city."','".$details->region_name."','".$details->latitude."','".$details->longitude."',DATE_FORMAT(now(),'%Y-%m-%d %T'));";

mysql_query($sql) or die ($sql);


}



function laip(){

if( isset($_SERVER['HTTP_X_FORWARDED_FOR']) &&
   $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
{
$IP=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
$IP=$_SERVER['REMOTE_ADDR'];

$details = json_decode(file_get_contents('http://freegeoip.net/json/'.$IP));

 $sql = "insert into ips (ip,pais,cuidad,comuna,latitud,longitud,fechahora) values ('".$IP."','".$details->country_name."','".$details->city."','".$details->region_name."','".$details->latitude."','".$details->longitude."',DATE_FORMAT(now(),'%Y-%m-%d %T'));";



mysql_query($sql) or die ($sql);


}



function randomText($length,$type=0) {



switch ($type) {



case 0: $pattern = "1234567890abcdefghijklmnopqrstuvwxyz"; 



break;



case 1: $pattern = "abcdefghijklmnopqrstuvwxyz"; 



break;



case 2: $pattern = "1234567890"; 



break;



}



$max = strlen($pattern)-1;



for($i=0;$i < $length;$i++) $key .= $pattern{mt_rand(0,$max)};



return $key;



}







function cargaleria(){







$mipos = new xajaxResponse(); 



   //escribimos en la capa con id="respuesta" el texto que aparece en $salida 



   $mipos->script("_Ajax_varios('galeria.php?id_perfil_=".$_SESSION['id_perfil']."&pos=0','main_container');");







   



   //assign("mipos","innerText",$pos); 







    //tenemos que devolver la instanciación del objeto xajaxResponse 



return $mipos; 







}











function cambiaFotoPerfil($id_archivo)



{







 $sql = "update usuarios set id_archivo=".$id_archivo." where id_perfil=".$_SESSION["id_perfil"];



mysql_query($sql) or die ($sql);



generaPerfil();



}







function cualFotoPerfil()



{



//



 



 $id_perfil_=$_SESSION["id_perfil"];



 $sql = "SELECT concat('perfiles/',id_perfil,'/mini/',archivo_nombre) ruta FROM archivos



 where id_perfil=".$id_perfil_." and id_archivo in (SELECT id_archivo FROM usuarios where id_perfil=".$id_perfil_.")";







$consulta=mysql_query($sql) or die ($sql);







    While ($registro=mysql_fetch_assoc($consulta)){







	$ruta= $registro[ruta];



} 



 



 



  	$mipos = new xajaxResponse(); 



   



   $mipos->script("cl='$ruta'; ");







   



   return $mipos; 



 



 //echo '$ruta';



}











function eliminaFoto($id_archivo)



{



//return "hola";











/*echo $id_archivo;



mysql_query("CALL eliminaFoto(,);");



*/



 



 $sql = "  SELECT count(id_archivo) cant FROM



         usuarios where id_perfil=".$_SESSION['id_perfil']." and id_archivo= ".$id_archivo;



		 



    $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");







    While ($registro=mysql_fetch_assoc($consulta)){







	$cant=$registro[cant];



		



}



 



 if ($cant==1)



 {



$sql = "  update usuarios set id_archivo=0 where id_perfil=".$_SESSION['id_perfil'];



	    mysql_query($sql) or die ($sql);



  



 }







$sql = "  delete from archivos where id_perfil=".$_SESSION['id_perfil']." and id_archivo= ".$id_archivo;



	    mysql_query($sql) or die ($sql);















  generaPerfil();



  



//   echo "<script>_Ajax_varios('galeria.php?id_perfil_=".$_SESSION['id_perfil']."&pos=0','main_container'); < /script>";



  



   $mipos = new xajaxResponse(); 



   //escribimos en la capa con id="respuesta" el texto que aparece en $salida 



   $mipos->script("_Ajax_varios('galeria.php?id_perfil_=".$_SESSION['id_perfil']."&pos=0','main_container');");







   



   //assign("mipos","innerText",$pos); 







    //tenemos que devolver la instanciación del objeto xajaxResponse 



   return $mipos; 



}















/*if (!isset($_SESSION['usuario']))



{ $_SESSION['usuario']='anonimo';}



 */



function usuariologin()



{



return $_SESSION['usuario'];











}







function correo()



{



if (!isset($_SESSION['correo']))



{ $_SESSION['correo']='';}







echo $_SESSION['correo'];



}







function nombreUsu()



{



if (!isset($_SESSION['nombre']))



{ $_SESSION['nombre']="";}







echo $_SESSION['nombre'];



}











function expirar(){











if($_SESSION['usuario']!='anonimo') 



 {



 if (!isset($_SESSION["ultimoAcceso"]))  $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s"); 











$fechaGuardada = $_SESSION["ultimoAcceso"]; 



    $ahora = date("Y-n-j H:i:s"); 



    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 







    //comparamos el tiempo transcurrido 



     if($tiempo_transcurrido >= 60000) { 



     //si pasaron 10 minutos o más 



	 session_unset();



      session_destroy(); // destruyo la sesión 



//	  session_start (); 



	//   $_SESSION["ultimoAcceso"] = $ahora; 



      echo "<script>location.href='index.php';</script>"; //envío al usuario a la pag. de autenticación 



      //sino, actualizo la fecha de la sesión 



    }else { 



    $_SESSION["ultimoAcceso"] = $ahora; 



   } 



 }







}







function postio($fechaGuardada){







    $ahora = date("Y-n-j H:i:s"); 



    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 



     if($tiempo_transcurrido <= 60)



	  { 



	   



     echo "Hace poco.. menos de un minuto"; //." ".strtotime($fechaGuardada)." = ".$fechaGuardada." ".strtotime($ahora)." = ".$ahora." Comento hace poco rato";



    }else if($tiempo_transcurrido > 60 and $tiempo_transcurrido < 3600)



	  {



	 	 echo " Hace ".round($tiempo_transcurrido/60)." minutos";



	}else if($tiempo_transcurrido > 3600 and $tiempo_transcurrido < 86400)



	  {



	   echo " Hace ".round($tiempo_transcurrido/3600)." Horas";



	}else{



	



 list($fecha,$hora) = explode(" ",$fechaGuardada);



		



	  	list($anio,$meis,$diaz) = explode("-",$fecha);







$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");



$mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");







	echo   "El ".$diaz." ".$mes[round($meis)-1]." del ".$anio;



		



   } 



 }















function destacado(){











//$sql = " SELECT concat('fotos/',archivo_nombre) foto,id_archivo FROM archivos ORDER BY RAND() LIMIT 1";



		



		$sql="SELECT SQL_NO_CACHE  a.id_archivo,(SELECT  nombre FROM categorias where id_categoria=a.id_categoria) nom_cat,



ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=20 and id_archivo=a.id_archivo),'') a20 ,



ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=23 and id_archivo=a.id_archivo),'') a23 ,



ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=80 and id_archivo=a.id_archivo),'') a80 ,



ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=81 and id_archivo=a.id_archivo),'') a81 ,



b.valor valor,concat('fotos/mini/',archivo_nombre) foto    FROM archivos a ,



 catalogoxfoto b, caracteristicas c where  a.id_archivo=b.id_archivo and b.id_caracteristicas=c.id_caracteristicas  and  b.id_caracteristicas in (20,23,80) and a.id_categoria<>2



group by a.id_archivo ORDER BY RAND() LIMIT 3";



 



    $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");







    While ($registro=mysql_fetch_assoc($consulta)){







	$foto= $registro[foto];



	$id_archivo= $registro[id_archivo];



	$nom_cat= $registro[nom_cat];



	//$frase=substr($registro[a23].", ".$registro[a20].", ".$registro[a80].", ".$registro[a81],0,300)."...";

if (strlen($registro[a23])>0) $avt=$registro[a23].", ";
if (strlen($registro[a20])>0) $avv=$registro[a20].", ";
if (strlen($registro[a80])>0) $avo=$registro[a80].", ";


	$frase=substr($avt.$avv.$avo.$registro[a81],0,300)."...";


echo "<div  style=\"position:relative; margin-top:30px; top:0px; margin-left:0px; width:100%; height:auto; \">



    <div id=\"Layer1\" style=\"position:relative; left:0px; margin-top:0px; width:100%; height:auto; z-index:3; background-color: #FFFFFF; layer-background-color: #FFFFFF; \">



	<img onClick=\"_Ajax_varios('producto.php?id_archivo=".$id_archivo."&foto=".$foto."&produ=".$nom_cat."','catalogo'); location.href='#vistaproducto';\" class=\"cursor_mano\" src=\"".$foto."\" width=\"176\" height=\"148\" /></div>



	<div align=\"justify\">".$frase."<div class=\"read_more_link\"><a onClick=\"_Ajax_varios('producto.php?id_archivo=".$id_archivo."&foto=".$foto."','catalogo'); location.href='#vistaproducto';\" href=\"#\">Leer más</a></div> 



      <div style=\"position:relative; height:auto; margin-top:20px;\">&nbsp;</div></div></div>";



	



}







		



 }







function destacado_ploter(){









//$sql = " SELECT concat('fotos/',archivo_nombre) foto,id_archivo FROM archivos ORDER BY RAND() LIMIT 1";



		



		$sql="SELECT SQL_NO_CACHE  a.id_archivo,(SELECT  nombre FROM categorias where id_categoria=a.id_categoria) nom_cat,



ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=20 and id_archivo=a.id_archivo),'') a20 ,



ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=23 and id_archivo=a.id_archivo),'') a23 ,



ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=80 and id_archivo=a.id_archivo),'') a80 ,



ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=81 and id_archivo=a.id_archivo),'') a81 ,



b.valor valor,concat('fotos/mini/',archivo_nombre) foto    FROM archivos a ,



 catalogoxfoto b, caracteristicas c where  a.id_archivo=b.id_archivo and b.id_caracteristicas=c.id_caracteristicas  and  b.id_caracteristicas in (20,23,80) and a.id_categoria=2



group by a.id_archivo ORDER BY RAND() LIMIT 3";



 



    $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");







    While ($registro=mysql_fetch_assoc($consulta)){







	$foto= $registro[foto];



	$id_archivo= $registro[id_archivo];



	$nom_cat= $registro[nom_cat];



	//$frase=substr($registro[a23].", ".$registro[a20].", ".$registro[a80].", ".$registro[a81],0,300)."...";

if (strlen($registro[a23])>0) $avt=$registro[a23].", ";
if (strlen($registro[a20])>0) $avv=$registro[a20].", ";
if (strlen($registro[a80])>0) $avo=$registro[a80].", ";


	$frase=substr($avt.$avv.$avo.$registro[a81],0,300)."...";


echo "<div  style=\"position:relative; margin-top:30px; top:0px; margin-left:0px; width:100%; height:auto; \">



    <div id=\"Layer1\" style=\"position:relative; left:0px; margin-top:0px; width:100%; height:auto; z-index:3; background-color: #ffffff; layer-background-color: #ffffff;  border: 1px none #000000;\">



	<img onClick=\"_Ajax_varios('producto.php?id_archivo=".$id_archivo."&foto=".$foto."&produ=".$nom_cat."','catalogo'); location.href='#vistaproducto';\" class=\"cursor_mano\" src=\"".$foto."\" width=\"176\" height=\"148\" /></div>



	<div align=\"justify\">".$frase."<div class=\"read_more_link\"><a onClick=\"_Ajax_varios('producto.php?id_archivo=".$id_archivo."&foto=".$foto."','catalogo'); location.href='#vistaproducto';\" href=\"#\">Leer más</a></div> 



      <div style=\"position:relative; height:auto; margin-top:20px;\">&nbsp;</div></div></div>";



	



}







		



 }



 



 function mapa(){



 



 echo " <div  style=\"position:relative; margin-top:20px; margin-left:0px; width:100%; height:auto; \">



    <div id=\"Layer1\" style=\"position:relative; left:0px; margin-top:0px; width:100%; height:auto; z-index:3; background-color: #c0c0c0; layer-background-color: #c0c0c0;\" >



	<div><strong>Direccion: </strong>Poniente 9161 la florida, Santiago de chile </div>



	<img border=\"3\"  src=\"imagenes/ico/mapa.jpg\" width=\"100%\" height=\"264\" /></div>



  </div>";



 }







function ponefotosdestacados($tipo){





    //$sql = "SELECT concat('fotos/mini/',archivo_nombre) foto,id_archivo FROM archivos ORDER BY RAND() LIMIT 6";

	$sql="SELECT SQL_NO_CACHE  a.id_archivo,(SELECT  nombre FROM categorias where id_categoria=a.id_categoria) nom_cat,

b.id_caracteristicas, b.valor,
ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=1 and id_archivo=a.id_archivo),'') a1,
ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=65 and id_archivo=a.id_archivo),'') a65 ,
ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=23 and id_archivo=a.id_archivo),'') a23 ,
ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=80 and id_archivo=a.id_archivo),'') a80 ,
ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=81 and id_archivo=a.id_archivo),'') a81 ,
ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=66 and id_archivo=a.id_archivo),'') a66 ,
ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=301 and id_archivo=a.id_archivo),'') a301 ,
b.valor valor,concat('fotos/mini/',archivo_nombre) foto    FROM archivos a ,



 catalogoxfoto b, caracteristicas c where  a.id_archivo=b.id_archivo and b.id_caracteristicas=c.id_caracteristicas  and  b.id_caracteristicas in (20,23,80)

and
(SELECT valor FROM catalogoxfoto where (id_caracteristicas=301 and valor =1 )   and id_archivo=a.id_archivo)

group by a.id_archivo ORDER BY RAND() LIMIT 15";







    $consulta = mysql_query($sql) or die ("Problemas");



    $col=0;



	$fila=0;



	$bajo=0;





	 $consulta = mysql_query($sql) or die ("Problemas en :".$sql );







    While ($registro=mysql_fetch_assoc($consulta)){


	//$frase=substr($registro[a23].", ".$registro[a20].", ".$registro[a80].", ".$registro[a81],0,100)."...";
/*
if (strlen($registro[a23])>0) $avt=$registro[a23].", ";
if (strlen($registro[a20])>0) $avv=$registro[a20].", ";
if (strlen($registro[a80])>0) $avo=$registro[a80].", ";

	$frase=substr($avt.$avv.$avo.$registro[a81],0,100)."...";
*/
$nom="";
$anos="";
$ciudad="";
	
if (strlen($registro[a80])>0) $nom=$registro[a80].", ";
if (strlen($registro[a65])>0) $anos=$registro[a65];
if (strlen($registro[a66])>0) $ciudad=$registro[a66];




	$frase0="<strong>".$nom.$anos." años (".$ciudad.") </strong>";
	$frase=substr($registro[a81],0,150)."...";







		$limpia="";



//		$contador++;



		$miclase="";

if (strlen($tipo)>0)
 if ( strpos($registro[a1],$tipo)>-1){

		$col+=180;
		if($col>940)
		{
		$bajo++;
		$limpia=" clear:both; ";
		echo "<div style=\"position:relative; clear:both; left:0px;  margin-left:0px; margin-top:20px; top:0px; width:100%; height:10px; z-index:1; border: 1px none #000000;\"></div>";
		$col=180;
		$fila+=300;
		}

     	if($col<570) $miclase="borde_separador";
        $foto= $registro[foto];
		$id_archivo=$registro[id_archivo];

       $nom_cat= $registro[nom_cat];

//<div>".$frase0."</div> <p style=\"position:relative;  margin-top:0px; height:auto; width:100%;\" >".$frase."</p>

echo " <div class=\"cursor_mano ".$miclase."\" style=\" position:relative; float:left; margin-top:2px; ".$limpia." margin-left:2px; left:-12px; top:0px; width:100px; height:auto; color:#838383;\">
		 <img  onClick=\"_Ajax_varios('producto.php?id_archivo=".$id_archivo."&foto=".$foto."&produ=".$nom_cat."','catalogo'); location.href='#vistaproducto'; \" class=\"cursor_mano\" style=\"margin-left:10px; border: 3px solid #6D1859;\" src=\"".$foto."\" width=\"97\" height=\"102\" />
		   <div style=\"position:relative; clear:both; margin-top:0px; margin-left:40px;  top:0px; left:0px;  height:auto;\" ><a onClick=\"_Ajax_varios('producto.php?id_archivo=".$id_archivo."&foto=".$foto."','catalogo');\" href=\"#vistaproducto\">Leer mas</a></div></div>";

}








		





    }



echo "<div>&nbsp;</div><div>&nbsp;</div>";








}























function ponefotosegun($id_categoria,$id_subcategoria,$idarchivo,$lafoto,$nuevo){


$largo=9; 



 $inicio=0;

 
$fondomujer="  background-color:#CC3399; ";
$fondohombre="  background-color:#000; ";
$fondogay="  background-color:#BD26B1; ";
$fondolesbiana="  background-color:#CC3399; ";
$fondotravesti="  background-color:#CC3399; ";
$fondovip="  background-color:#FAE76D; ";

$elcolor="color:#fff;";

if ($id_categoria==1) $fondodiv=$fondomujer;
else
if ($id_categoria==2) $fondodiv=$fondohombre;
else
if ($id_categoria==3) $fondodiv=$fondogay;
else
if ($id_categoria==4) $fondodiv=$fondolesbiana;
else
if ($id_categoria==5) $fondodiv=$fondotravesti;
else




if ($id_categoria==28 and $id_subcategoria==21)
{
$fondovarios=$fondovip;$fondodiv=$fondomujer;
echo "<div class=\"som round\" style=\"position:relative; left:0px; top:0px; width:100%; height:auto; ".$fondovarios." layer-background-color: #F0FEC2; color:#000000;\">
  <div  style=\"position:relative; left:0px; top:15px; width:100%; height:22px; \">
    <div align=\"center\"><h4>Mujeres VIP: Que ofrecen servicios de compañía entre $70.000 y $110.000 (US$140 & US$220)</h4></div>
  </div><div><p>&nbsp;</p></div>";

}else
if ($id_categoria==28 and $id_subcategoria==22)
{
$fondovarios=$fondovip;$fondodiv=$fondohombre;
echo "<div class=\"som round\" style=\"position:relative; left:0px; top:0px; width:100%; height:auto;  ".$fondovarios." layer-background-color: #F0FEC2;\">
  <div  style=\"position:relative; left:0px; top:15px; width:100%; height:22px; \">
    <div align=\"center\"><h4>Hombres VIP: Que ofrecen servicios de compañía entre $70.000 y $110.000 (US$140 & US$220)</h4></div>
  </div><div><p>&nbsp;</p></div>";

}






if ($id_categoria==28 and $id_subcategoria==21) $loquebusco=" id_categoria=1 and  id_subcategoria in (1,3) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='vip')";
else
if ($id_categoria==29 and $id_subcategoria==21) $loquebusco=" id_categoria=1 and  id_subcategoria in (1,3) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='premium')";
else
if ($id_categoria==30 and $id_subcategoria==21) $loquebusco=" id_categoria=1 and  id_subcategoria in (1,3) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='gold')";
else
if ($id_categoria==31 and $id_subcategoria==21) $loquebusco=" id_categoria=1 and  id_subcategoria in (1,3) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='silver')";
else
if ($id_categoria==28 and $id_subcategoria==22) $loquebusco=" id_categoria=2 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='vip')";
else
if ($id_categoria==29 and $id_subcategoria==22) $loquebusco=" id_categoria=2 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='premium')";
else
if ($id_categoria==30 and $id_subcategoria==22) $loquebusco=" id_categoria=2 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='gold')";
else
if ($id_categoria==31 and $id_subcategoria==22) $loquebusco=" id_categoria=2 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='silver')";
else
if ($id_categoria==28 and $id_subcategoria==23) $loquebusco=" id_categoria=3 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='vip')";
else
if ($id_categoria==29 and $id_subcategoria==23) $loquebusco=" id_categoria=3 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='premium')";
else
if ($id_categoria==30 and $id_subcategoria==23) $loquebusco=" id_categoria=3 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='gold')";
else
if ($id_categoria==31 and $id_subcategoria==23) $loquebusco=" id_categoria=3 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='silver')";
else
if ($id_categoria==28 and $id_subcategoria==24) $loquebusco=" id_categoria=4 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='vip')";
else
if ($id_categoria==29 and $id_subcategoria==24) $loquebusco=" id_categoria=4 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='premium')";
else
if ($id_categoria==30 and $id_subcategoria==24) $loquebusco=" id_categoria=4 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='gold')";
else
if ($id_categoria==31 and $id_subcategoria==24) $loquebusco=" id_categoria=4 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='silver')";
else
if ($id_categoria==28 and $id_subcategoria==25) $loquebusco=" id_categoria=5 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='vip')";
else
if ($id_categoria==29 and $id_subcategoria==25) $loquebusco=" id_categoria=5 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='premium')";
else
if ($id_categoria==30 and $id_subcategoria==25) $loquebusco=" id_categoria=5 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='gold')";
else
if ($id_categoria==31 and $id_subcategoria==25) $loquebusco=" id_categoria=5 and  id_subcategoria in (1,2) and a.id_archivo in (select id_archivo FROM catalogoxfoto where id_caracteristicas=1 and valor='silver')";
else
if (strlen($id_subcategoria)>0) {$loquebusco=" id_categoria=".$id_categoria." and  id_subcategoria=".$id_subcategoria;$subcate=" and  id_subcategoria=".$id_subcategoria;}
else
if (strlen($id_subcategoria)==0) $loquebusco=" id_categoria=".$id_categoria;

	if (strlen(trim($nuevo))>0) 



		$sql =	"SELECT SQL_NO_CACHE (count(a.id_archivo)/".$largo.") cantidad, count(a.id_archivo) cantreg FROM archivos a,  catalogoxfoto b where a.id_archivo=b.id_archivo and id_caracteristicas=1 and valor='".$_GET["nuevo"]."'";



	else 

	

	if ($id_categoria>=28 and $id_categoria<=31)
{

if ($id_categoria==28 and $id_subcategoria==21) { $id_categoria="1"; $tipo="vip";} 
else
if ($id_categoria==28 and  $id_subcategoria==22) { $id_categoria="2"; $tipo="vip";} 

if ($id_categoria==29 and $id_subcategoria==21) { $id_categoria="1"; $tipo="premium";} 
else
if ($id_categoria==29 and  $id_subcategoria==22) { $id_categoria="2"; $tipo="premium";} 


	   $sql = "SELECT SQL_NO_CACHE (count(id_archivo)/".$largo.") cantidad, count(id_archivo) cantreg FROM archivos where id_archivo in (SELECT   a.id_archivo

    FROM archivos a , catalogoxfoto b, caracteristicas c where  a.id_archivo=b.id_archivo and b.id_caracteristicas=c.id_caracteristicas  and 
 ( id_categoria=".$id_categoria.$subcate."  and b.valor like '%".$tipo."%') group by a.id_archivo)";


}
else
{
	   $sql = "SELECT SQL_NO_CACHE (count(id_archivo)/".$largo.") cantidad, count(id_archivo) cantreg FROM archivos where id_archivo in (SELECT   a.id_archivo

    FROM archivos a , catalogoxfoto b, caracteristicas c where  a.id_archivo=b.id_archivo and b.id_caracteristicas=c.id_caracteristicas  and  b.id_caracteristicas in (66,23,80,81) and id_categoria=".$id_categoria.$subcate." group by a.id_archivo)";
}
    $consulta = mysql_query($sql) or die ($sql."--".$id_categoria."--".$subcate);
   While ($registro=mysql_fetch_assoc($consulta)){


    $cantidad=$registro[cantidad];



	$cantreg=$registro[cantreg];



	}


if ($cantreg!=0){


if (substr_count($cantidad,'0000')!=0) 
{

$cantidad= (int)substr($cantidad ,0,substr_count($cantidad,'.')); 

$ultimo=$cantidad*$largo;

}



else {



$cantidad=$cantidad +1;


$cantidad= (int)substr($cantidad ,0,substr_count($cantidad,'.'));


$ultimo=($cantidad - 1)*$largo;



}


if ($cantidad==0)
{ 

$cantidad=1;

}
if (isset($_GET["pag"]))



{



$inicio=$_GET["pag"] * $largo;



$pag=$_GET["pag"];







$_SESSION["paginas"]=$pag+1;



//echo "<--->".$_SESSION["paginas"];



}//else $inicio=0;



}







//    $sql = "SELECT concat('fotos/',archivo_nombre) foto,id_archivo FROM archivos   where id_categoria=".$id_categoria.$subcate." LIMIT ".$inicio.",".$largo;



	  //  where id_categoria in (1,15) LIMIT ".$inicio.",".$largo;



	











		if (strlen($nuevo)>0) 



		$sql =	"SELECT concat('fotos/mini/',archivo_nombre) foto,a.id_archivo,



ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=20 and id_archivo=a.id_archivo),'') a20 ,



ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=23 and id_archivo=a.id_archivo),'') a23 ,



ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=80 and id_archivo=a.id_archivo),'') a80 ,



ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=81 and id_archivo=a.id_archivo),'') a81



FROM archivos a,  catalogoxfoto b



where a.id_archivo=b.id_archivo and id_caracteristicas=1 and valor='".$_GET["nuevo"]."'"." LIMIT ".$inicio.",".$largo;



    else




	 	$sql = "SELECT SQL_NO_CACHE  a.id_archivo,

ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=65 and id_archivo=a.id_archivo),'') a65 ,
ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=23 and id_archivo=a.id_archivo),'') a23 ,
ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=80 and id_archivo=a.id_archivo),'') a80 ,
ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=81 and id_archivo=a.id_archivo),'') a81 ,
ifnull((SELECT valor FROM catalogoxfoto where id_caracteristicas=66 and id_archivo=a.id_archivo),'') a66 ,
concat('fotos/mini/',archivo_nombre) foto    FROM archivos a ,
 catalogoxfoto b, caracteristicas c where  a.id_archivo=b.id_archivo and b.id_caracteristicas=c.id_caracteristicas  and  b.id_caracteristicas in (65,23,80,81,66) and ".$loquebusco." group by a.id_archivo  LIMIT ".$inicio.",".$largo;


    $consulta = mysql_query($sql) or die ("Problemas en :".$sql );



    $col=0;



	$fila=0;



	$bajo=0;





    While ($registro=mysql_fetch_assoc($consulta)){

$nom="";
$anos="";
$ciudad="";
	

if (strlen($registro[a80])>0) 
 {

if ($registro[a80]=="Prefierenos") $nom=$registro[a80]." ";
else
$nom=$registro[a80].", ";

}else 
$nom="Publicidad disponible ";

if (strlen($registro[a65])>0) $anos=$registro[a65]." a&ntilde;os ";
if (strlen($registro[a66])>0) $ciudad=$registro[a66];
else $ciudad="(En todo el pais)";





	$frase0="<strong>".$nom.$anos.$ciudad." </strong>";
	$frase=substr($registro[a81],0,150)."...";

	




		$limpia="";




		$miclase="";



		$col+=180;



		if($col>540)



		{



		$bajo++;



		$limpia=" clear:both; ";



		echo "<div style=\"position:relative; clear:both; left:-1px;  margin-left:0px; margin-left:-10px; margin-top:20px; top:0px; width:100%; height:20px; z-index:1; border: 1px none #000000;\"></div>";



		

		$col=180;



		$fila+=300;



		



		}



		



		//if($col<370) $miclase="borde_separador";



		





$foto= $registro[foto];



$id_archivo=$registro[id_archivo];








//<p style=\"position:relative; clear:both; margin-top:0px; height:auto;\" align=\"justify\">".utf8_encode($frase).		  "</p>
//<div style=\"position:relative;clear:both; margin-top:0px; top:0px; height:auto;\" class=\"read_more_link\"><a onClick=\"_Ajax_varios('producto.php?id_archivo=".$id_archivo."&foto=".$foto."','catalogo');\" href=\"#vistaproducto\">Leer más</a></div>

echo " <div class=\"cursor_mano ".$miclase."\" style=\" position:relative; float:left; margin-top:0px;  ".$fondodiv.$limpia." margin-left:15px; left:0px; top:0px; width:150px; height:auto; ".$elcolor."\">


<div><div align=\"center\">".utf8_encode($frase0)."</div></div>
		 <img  onClick=\"_Ajax_varios('producto.php?id_archivo=".$id_archivo."&foto=".$foto."','catalogo'); location.href='#vistaproducto'; \" class=\"cursor_mano\" style=\"margin-left:0px;\" src=\"".$foto."\" width=\"100%\" height=\"200\" />";



		if (strlen(trim($idarchivo))<1)	{


	$lafoto="nada";



	$idarchivo="nada";



	}



	echo "</div>";



    }



	echo "<div style=\"position:relative; left:0px; clear:both; margin-left:0px; margin-top:20px; top:0px; width:100%; height:50px; z-index:1; border: 1px none #000000;\"></div>";



	$temp_="0";



	$splitpag="";



$splitpag.= "<div align=\"center\">";



if ($pag>0 and  $cantidad-5>0 ) 



  $splitpag.= "<a style=\"position:relative; float:left; width:40px; margin-left:5px; height:30px;padding-top:5px; margin-top:5px;\" onclick=\"busquedapor(\'".$idarchivo."\',\'".$lafoto."\',".($pag).",\'".$nuevo."\');\" href=\'#busqprod\'><-Ant</a>";





$puntosig=$pag + 5;



$puntoant=$pag - 1;	







$iniciar=1;



if ($pag -1>-1 and $cantidad-5>0) {







if ($pag>$cantidad-5)



$splitpag.= "<a style=\"position:relative; float:left; width:30px; margin-left:5px; height:30px;padding-top:5px; margin-top:5px; \" onclick=\"busquedapor(\'".$idarchivo."\',\'".$lafoto."\',".($cantidad-6).",\'".$nuevo."\');\" href=\'#busqprod\'>... </a>";



else



$splitpag.= "<a style=\"position:relative; float:left; width:30px; margin-left:5px; height:30px;padding-top:5px; margin-top:5px; \" onclick=\"busquedapor(\'".$idarchivo."\',\'".$lafoto."\',".$pag.",\'".$nuevo."\');\" href=\'#busqprod\'> ... </a>";











$iniciar=$pag+1;



}



if ($pag>$cantidad-5) $iniciar=$cantidad-5;







if($iniciar<0) $iniciar=1;







	for ($i = $iniciar; $i<=$cantidad;$i++) {



	



if ($i -1== $pag) {






$splitpag.= "<a style=\"position:relative; float:left; width:30px; margin-left:5px; height:30px; background-image: url(imagenes/ico/split.png); padding-top:5px; margin-top:5px;\" onclick=\"busquedapor(\'".$idarchivo."\',\'".$lafoto."\',this.innerText,\'".$nuevo."\');\" href=\'#busqprod\'>".$i."</a>";






}else { 











if ($puntosig==$i -2) {



$splitpag.= "<a style=\"position:relative; float:left; width:30px; margin-left:5px; height:30px;padding-top:5px; margin-top:5px; \" onclick=\"busquedapor(\'".$idarchivo."\',\'".$lafoto."\',".$i.",\'".$nuevo."\');\" href=\'#busqprod\'> ... </a>";



break;



}else



{



$splitpag.= "<a style=\"position:relative; float:left; width:30px; margin-left:5px; height:30px;padding-top:5px; margin-top:5px; \" onclick=\"busquedapor(\'".$idarchivo."\',\'".$lafoto."\',this.innerText,\'".$nuevo."\');\" href=\'#busqprod\'>".$i."</a>";



}








}











}



if ($pag<$cantidad-6 and $cantidad-5>0 )



 $splitpag.= "<a style=\"position:relative; float:left; width:40px; margin-left:5px; height:30px;padding-top:5px; margin-top:5px;\" onclick=\"busquedapor(\'".$idarchivo."\',\'".$lafoto."\',".($pag+2).",\'".$nuevo."\');\" href=\'#vistaproducto\'>Sig-></a>";





$splitpag.= " <label style=\"position:relative;float:right;  width:auto;  margin-right:20px; color:#838383;  padding-top:15px;\">$cantreg Producto";



if ((integer)$cantreg>0)

{ 

if ((integer)$cantreg>1) $splitpag.="s";



$splitpag.= ", en ".(integer)$cantidad." pagina";



if ((integer)$cantidad>1) $splitpag.="s";



}else $splitpag.="s encontrados en este criterio de busqueda";



$splitpag.="</label><div>";












echo "<script>  document.getElementById('splitpag_').innerHTML='".$splitpag."'; document.getElementById('splitpag_').className='papel'; </script>";



}











































function noCache() {



 header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");



 header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");



 header("Cache-Control: no-store, no-cache, must-revalidate");



 header("Cache-Control: post-check=0, pre-check=0", false);



 header("Pragma: no-cache");



}







function comprobar_email($email){ 



    $mail_correcto = 0; 



    //compruebo unas cosas primeras 



    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 



       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 



          //miro si tiene caracter . 



          if (substr_count($email,".")>= 1){ 



             //obtengo la terminacion del dominio 



             $term_dom = substr(strrchr ($email, '.'),1); 



             //compruebo que la terminación del dominio sea correcta 



             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 



                //compruebo que lo de antes del dominio sea correcto 



                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 



                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 



                if ($caracter_ult != "@" && $caracter_ult != "."){ 



                   $mail_correcto = 1; 



                } 



             } 



          } 



       } 



    } 



    if ($mail_correcto) 



       return 1; 



    else 



       return 0; 



} 











//Obtener IP:







//Función de obtención de IP (basado en la web de webhosting.info)



 function promo($alto,$cual){



 echo "<div id=\"contPromo\"   style=\"position:absolute; left:-1px; top:".$alto."px; width:100%; height:100px;  z-index:1; overflow:hidden;\" class=\"formulario_smal\">";



echo "<div  style=\" overflow:hidden;position:absolute; border: 1px none #AA0000;  line-height: 100px; width: auto; height: 100px; left:0px; top: 6px;\" id=\"promo\"> </div></div>";



echo "<div id=\"menudown\" style=\"position:absolute; left:0px; top:".( $alto + 101 )."px; width:100%; height:125px; z-index:1; background-color: #E1E1C8; layer-background-color: #E1E1C8; border: 1px none #000000; background-image: url(fnd-footer.jpg); layer-background-image: url(fnd-footer.jpg);\">".



"     	<div class=\"\" style=\"height:200px; position:absolute; \">



		 <div  style=\"position:absolute; left:33px; top:22px; width:262px; height:109px; z-index:2\" class=\"borde_separador\">



        <h1 class=\"Estilo19\">Acerca de www.printerandprint.cl </h1>



        <ul >



          <dd style=\"margin:0px; font-size: 12px; \" >T&eacute;rminos y Condiciones </dd>



          <dd  style=\"margin:0px; margin-top:6px; font-size: 12px;\">Bases del concurso </dd>



          <dd  style=\"margin:0px; margin-top:6px; font-size: 12px;\">Contacto Comercial</dd>



        </ul>



  </div>



            <div  style=\"position:absolute; left:321px; top:22px; width:262px; height:109px; z-index:2\" class=\"borde_separador\">



              <h1 class=\"Estilo19\">Ayuda </h1>



              <ul>



                <dd style=\"margin:0px; margin-top:4px; font-size: 12px;\">&iquest;C&oacute;mo funciona? </dd>



                <dd style=\"margin:0px; margin-top:6px; font-size: 12px;\">Preguntas Frecuentes</dd>



              </ul>



  </div>



            <div  style=\"position:absolute; left:601px; top:22px; width:262px; height:109px; z-index:2\">



              <h1 class=\"Estilo19\">S&iacute;guenos </h1>



              <ul>



                <dd onclick=\"location.target = '_blank'; location.href='http://www.facebook.com/pages/sitiocomercialcl/105791202838716';\" style=\"margin:0px; margin-top:4px; font-size: 12px;\">Facebook </dd>



                <dd style=\"margin:0px; margin-top:6px; font-size: 12px;\">witter </dd>



                <dd style=\"margin:0px; margin-top:6px; font-size: 12px;\">Flickr</dd>



              </ul>



          </div>



        </div>



"."</div>";















 if ($_SESSION['usuario']!='anonimo')



{



//echo "<script>document.getElementById('seguridad').src='imagenes/sitiohabilitado.gif'; </ script>";



}







 $sql = "SELECT SQL_NO_CACHE  id_archivo  FROM archivos  Limit 0,13";



    $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");







    While ($registro=mysql_fetch_assoc($consulta)){







   echo "<script> pone('$registro[id_archivo]',80,80,'".$cual."','asasa');</script>";



		



    }



	



	echo "<script> alert('aki'); centrar('centrado');



	mover=0;var temporizador2_; temporizador2_=setInterval('mueve(80,\'promo\')' , 5000);</script>";



	



	



	



 }



 



function addfocoatencion($id_archivo,$mensaje)



{







 $sql = "insert into fotos (id_archivo,mensaje) values (".$id_archivo.",'".$mensaje."');";



mysql_query($sql) or die ($sql);







}











 function focoatencion($cual)



 {



 



 /*



 $sql = "SELECT SQL_NO_CACHE  id_archivo  FROM archivos  Limit 0,12";



    $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");







    While ($registro=mysql_fetch_assoc($consulta)){







   echo "<script> pone('$registro[id_archivo]',80,80,'".$cual."');</script>";



		



    }



	



//	echo "<script> alert('aki'); centrar('centrado');



	//mover=0;var temporizador2_; temporizador2_=setInterval('mueve(80,\'promo\')' , 5000);</ script>";



	



	*/



	



	$id_perfil_=$_SESSION['id_perfil'];



	



	



	 $sql="SELECT id_perfil,concat('perfiles/',id_perfil,'/mini/',archivo_nombre) ruta,id_archivo FROM archivos



 where id_perfil=".$id_perfil_." and id_archivo in (SELECT id_archivo FROM usuarios where id_perfil=".$id_perfil_.")



 union



  SELECT id_perfil,concat('perfiles/',id_perfil,'/mini/',archivo_nombre) ruta,id_archivo FROM archivos



 where id_perfil=".$id_perfil_." and id_archivo not in (SELECT id_archivo FROM usuarios where id_perfil=".$id_perfil_.")";







//echo $sql;



    $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");







   $mipos = new xajaxResponse(); 



   $mipos->script("cant=0; document.getElementById('".$cual."').innerHTML=''");



    While ($registro=mysql_fetch_assoc($consulta)){







   //instanciamos el objeto para generar la respuesta con ajax 







   //escribimos en la capa con id="respuesta" el texto que aparece en $salida 



//    $mipos->assign("mipos","innerText",$pos); 







   $mipos->script("pone('$registro[ruta]',90,90,'".$cual."','$registro[id_perfil]','','$registro[id_archivo]');");







    //tenemos que devolver la instanciación del objeto xajaxResponse 











    } 		



   return $mipos; 



 



 }



function agregacont($id_perfil,$contacto){















 $sql = "SELECT SQL_NO_CACHE  count(id_perfil) valor FROM contactos where contacto='".$contacto."' and id_perfil=".$id_perfil;



$consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");







    While ($registro=mysql_fetch_assoc($consulta)){



    $valor=$registro[valor];



   



   }



if ($valor==0){



 $sql = "insert into contactos (id_perfil,contacto) values(".$id_perfil.",'".$contacto."')";



$consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");



}







}







function conectado($id_perfil)



{







//$salida=mysql_query("CALL calcula_fechas(25,@dias);", $conexion);







$salida=mysql_query("CALL calcula_fecha(".$id_perfil.",@dias);");



$salida = mysql_query( "SELECT @dias" );















while ($row = mysql_fetch_row($salida)) {



     $actividad=  $row[0];



   }















mysql_free_result($salida);







     return $actividad; 



}







function estado($conectado){







if (eregi('online',$conectado)) 



            return "online";



 else if (eregi('minutos',$conectado)) 



            return "minutos";



 else return "masde";











}







function eliminar_recursivo_contenido_de_directorio($carpeta) 



{ 



$directorio = opendir($carpeta); 



while ($archivo = readdir($directorio)) 



{ 



if( $archivo !='.' && $archivo !='..' ) 



{ //comprobamos si es un directorio o un archivo 



if ( is_dir( $carpeta.'/'.$archivo ) ) 



{ 



//si es un directorio, volvemos a llamar a la función para que elimine el contenido del mismo 



eliminar_recursivo_contenido_de_directorio( $carpeta.'/'.$archivo ); 



rmdir($carpeta.'/'.$archivo); //borrar el directorio cuando esté vacío 







} 



else 



{ //si no es un directorio, lo borramos 



unlink($carpeta.'/'.$archivo); 



} 



} 



} 



closedir($directorio); 



} 







function desplazar(){











//$sql = "SELECT SQL_NO_CACHE nombre,  a.id_perfil id_perfil, fondo, pos, a.id_archivo, archivo_nombre, concat('perfiles/',a.id_perfil,'/mini/',archivo_nombre) ruta FROM usuarios a,archivos b where a.id_perfil=b.id_perfil and a.id_archivo=b.id_archivo LIMIT 0,12";



// b.id_archivo,


//SUBSTR((SELECT TRIM(nombre)  FROM categorias  where id_categoria=a.id_categoria),1,60) mensaje ,

$sql="SELECT SQL_NO_CACHE  a.id_archivo,
(SELECT valor FROM catalogoxfoto where id_caracteristicas=80 and id_archivo=a.id_archivo) mensaje ,
concat('fotos/mini/',archivo_nombre) ruta    FROM archivos a ,
 catalogoxfoto b, caracteristicas c where  a.id_archivo=b.id_archivo and b.id_caracteristicas=c.id_caracteristicas  and  b.id_caracteristicas in (20,23,80)  group by a.id_archivo ORDER BY RAND() LIMIT 15";

    $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");







   $mipos = new xajaxResponse(); 



   



   







   $cant = mysql_num_rows($consulta); 

//document.getElementById('promo').innerHTML='&nbsp;';

   $mipos->script("document.getElementById('promo').style.marginLeft='-12px'; document.getElementById('promo').style.width='".(($cant*70) + 100)."px';");



    While ($registro=mysql_fetch_assoc($consulta)){







   //instanciamos el objeto para generar la respuesta con ajax 







   //escribimos en la capa con id="respuesta" el texto que aparece en $salida 



//    $mipos->assign("mipos","innerText",$pos); 







	$mensaje=$registro[mensaje]; //.",".CalculaEdad($registro['edad']).",".$registro['ciudad'];








   $mipos->script(";pone('$registro[ruta]',70,70,'promo','$registro[id_archivo]','$mensaje' );");







    //tenemos que devolver la instanciación del objeto xajaxResponse 











    } 		



   return $mipos; 











/*



echo "<script>



if (temporizador_){



clearInterval(temporizador_);



temporizador_='';



clearTimeout(temporizador_);



}else {



var temporizador_;



}



cant=0;



var temporizador_; temporizador_=setInterval(\"mueve(80,'promo')\" , 8000);



</script>";



*/







}















function posicion($id_perfil,$sexo)



{



//$salida=mysql_query("CALL calcula_fechas(25,@dias);", $conexion);







//$salida=



//echo $id_perfil;



 mysql_query("CALL posicion(".$id_perfil.",".$sexo.",@salidas);");







$salida = mysql_query( "SELECT @salidas" );







while ($row = mysql_fetch_row($salida)) {



     $actividad=  $row[0];



	 echo $row[0];



   }











mysql_free_result($salida);







//     return $actividad;



}











function cantfotos($id_perfil)



{



//$salida=mysql_query("CALL calcula_fechas(25,@dias);", $conexion);







//$salida=



//echo $id_perfil;



$actividad=0;



 mysql_query("CALL cantfotos(".$id_perfil.",@salidas);");







$salida = mysql_query( "SELECT @salidas" );







while ($row = mysql_fetch_row($salida)) {



     $actividad=  $row[0];



//	 echo $row[0];



   }











mysql_free_result($salida);







if ($actividad==1)  return $actividad." foto";



else return $actividad." fotos";



}







//mysql_query("CALL primerox(59)");







function conexcion()



{



mysql_query("CALL conexion(".$_SESSION['id_perfil'].");");



}







function primerox()



{







//mysql_query("CALL primero(59);");







$sql = "select SQL_NO_CACHE pos posi,(select  max(pos) from usuarios where sexo=".$_SESSION['sexo'].") elmax from usuarios where id_perfil=".$_SESSION['id_perfil'];







    $consulta = mysql_query($sql) or die ($sql);



    While ($registro=mysql_fetch_assoc($consulta)){



    $posi=$registro[posi];



	$elmax=$registro[elmax];







    }















$sql = "update usuarios set pos=(pos - 1) where sexo=".$_SESSION["sexo"]." and pos > ".$posi; 



  mysql_query($sql) or die ("1 No se pudo ejecutar la consulta");







$sql = "update usuarios set pos= ".$elmax." where id_perfil=".$_SESSION["id_perfil"];



  mysql_query($sql) or die ("2 No se pudo ejecutar la consulta");







/*if ($donde!=) 



{*/







 mysql_query("CALL posicion(".$_SESSION['id_perfil'].",".$_SESSION['sexo'].",@salidas);");







$salida = mysql_query( "SELECT @salidas" );







while ($row = mysql_fetch_row($salida)) {



     $pos=  $row[0];







   }







   //instanciamos el objeto para generar la respuesta con ajax 



   $mipos = new xajaxResponse(); 



   //escribimos en la capa con id="respuesta" el texto que aparece en $salida 



   $mipos->assign("mipos","innerText",$pos); 







    //tenemos que devolver la instanciación del objeto xajaxResponse 



   return $mipos; 







//echo " document.getElementById('mipos').innerHTML='hola'; ";







//}







}







function visitas($id_perfil_a_visitar)



{



if ($id_perfil_a_visitar !=$_SESSION['id_perfil'])



{











$sql = "select SQL_NO_CACHE count(id_perfil) cant from visitas where id_perfil_visita=".$_SESSION['id_perfil']." and id_perfil=".$id_perfil_a_visitar;







$consulta = mysql_query($sql) or die ($sql);



    While ($registro=mysql_fetch_assoc($consulta)){



    $cant= $registro[cant];



	}



	



if ($cant==0){



$sql = "insert into visitas values (".$id_perfil_a_visitar.",".$_SESSION['id_perfil'].", DATE_FORMAT(now(),'%Y-%m-%d %T'))";



  mysql_query($sql) or die ("2 No se pudo ejecutar la consulta");



  }



  else



  {



$sql = "update visitas set fechahora=DATE_FORMAT(now(),'%Y-%m-%d %T') where id_perfil=".$id_perfil_a_visitar." and id_perfil_visita=".$_SESSION['id_perfil'];



  mysql_query($sql) or die ("2 No se pudo ejecutar la consulta");







  }



}



}







function cantvisitas($id_perfil,$hoy)



{







if ($hoy=='hoy')



$sql = "select SQL_NO_CACHE count(id_perfil) cant from visitas where year(fechahora) = year(now()) and month(fechahora) = month(now()) and day(fechahora) = day(now()) and id_perfil=".$id_perfil;



else {



$sql = "select SQL_NO_CACHE count(id_perfil) cant from visitas where id_perfil=".$id_perfil;



}



//echo $sql;



$consulta = mysql_query($sql) or die ("No sesdfgsdfg pudo ejecutar la consulta");



    While ($registro=mysql_fetch_assoc($consulta)){



    echo $registro[cant];



	}



	



}







function mini()



{



 $sql = "SELECT SQL_NO_CACHE case 1 when id_archivo=0 then 'imagenes/sinfoto.jpg'  when id_archivo>0 then  ( SELECT SQL_NO_CACHE concat('perfiles/',a.id_perfil,'/mini/',b.archivo_nombre) FROM usuarios a,  archivos b where a.id_perfil=b.id_perfil and a.id_archivo=b.id_archivo and a.id_perfil =  c.id_perfil)  END fotoPerfil FROM usuarios c where c.id_perfil=".$_SESSION['id_perfil'];



  $consulta = mysql_query($sql) or die ("No sesdfgsdfg pudo ejecutar la consulta");



    While ($registro=mysql_fetch_assoc($consulta)){



    return $registro[fotoPerfil];



	}



	



}



function mini_Coment($id_perfil_)



{



 $sql = "SELECT SQL_NO_CACHE case 1 when id_archivo=0 then 'imagenes/sinfoto.jpg'  when id_archivo>0 then  ( SELECT SQL_NO_CACHE concat('perfiles/',a.id_perfil,'/mini/',b.archivo_nombre) FROM usuarios a,  archivos b where a.id_perfil=b.id_perfil and a.id_archivo=b.id_archivo and a.id_perfil =  c.id_perfil)  END fotoPerfil FROM usuarios c where c.id_perfil=".$id_perfil_;



  $consulta = mysql_query($sql) or die ("No sesdfgsdfg pudo ejecutar la consulta");



    While ($registro=mysql_fetch_assoc($consulta)){



    return  $registro[fotoPerfil];



	}



	



}







function fondop($id_perfil)



{



 $sql = "SELECT SQL_NO_CACHE fondo FROM usuarios where id_perfil=".$id_perfil;



  $consulta = mysql_query($sql) or die ($sql);



    While ($registro=mysql_fetch_assoc($consulta)){



    echo $registro[fondo];



	}



	



}







function lugar($cual){







 $sql = "SELECT nombre FROM lugar where lugar='".$cual."'";



  $consulta = mysql_query($sql) or die ($sql);



    While ($registro=mysql_fetch_assoc($consulta)){



    return  $registro[nombre];



	}







}







function ideas(){







 $sql = "SELECT quiero FROM ideas order by quiero asc";



  $consulta = mysql_query($sql) or die ($sql);



    While ($registro=mysql_fetch_assoc($consulta)){



     $ideas.=$registro[quiero].";";



	}



return $ideas."algo distinto";



}















function mifondo($elfondo)



{







$sql = "update usuarios set fondo='".$elfondo."' where id_perfil=".$_SESSION['id_perfil'];



  mysql_query($sql) or die ("No se pudo actualizar el fondo");



//echo "alert('listo');";











$RESPUESTA=new xajaxResponse();



//$RESPUESTA->setCharEncoding('ISO-8859-1');



// Ahora podemos modificar el DOM del cliente



//$RESPUESTA->addAssign("una_div","innerHTML",$mensaje);



// O hacerle ejecutar un javascript



$RESPUESTA->script("document.body.className='".$elfondo."';");



return $RESPUESTA;



















}







function masvisitados(){



//select id_perfil,count(id_perfil) cant from visitas where



//year(fechahora) = year(now()) and month(fechahora) = month(now()) and day(fechahora) = day(now()) group by id_perfil



}







function CalculaEdad( $fecha ) {



/*    list($Y,$m,$d) = explode("-",$fecha);



    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );*/



	



	$dia=date(j);



$mes=date(n);



$ano=date(Y);



 



//fecha de nacimiento



list($anonaz,$mesnaz,$dianaz) = explode("-",$fecha);



 /*



$dianaz=2;



$mesnaz=6;



$anonaz=1983;



 */



 



 



//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual



 /*



if (round($mesnaz) < $mes) {



$ano=($ano-1);







}



 */



//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual



// if (($mesnaz == $mes) && ($dianaz > $dia)) {



// echo date ( "j - n - Y" );



//echo "  si ".round($mesnaz) ."<". $mes ." o ". round($mesnaz) ." <=". $mes ." y ". round($dianaz) ." <". $dia;







$meses=round($mes) - round($mesnaz);



// if  ($meses<0) $meses=$meses * -1;



// echo " = ".$mes."-".round($mesnaz)." -> mes ".$meses;



$dias=round($dia) - round($dianaz);



// if  ($dias<0) $dias=$dias * -1;



// echo " =". round($dia) ."-".round($dianaz)."  ->  dias ".$dias;















if ($meses<=0 && $dias<0 ) {



$ano=($ano-1);







 }



 //or ($mesnaz > $mes && ( round($dianaz) =<  $dia))



 



//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad



 



$edad=($ano-$anonaz);



 



return $edad;







}







function ahoraquero($quero,$con,$desde,$hasta){







if ($_SESSION["quero"]!=$_GET["quero"]){







$sql = "update datos_personales set quiero='".$quero."' where id_perfil=".$_SESSION['id_perfil'];



    mysql_query($sql) or die ("No se pudo ejecutar la consulta");



	



$_SESSION["quero"]=$quero;



}







if ($_SESSION["con_"]!=$_GET["con"]){



//echo $con;



$sql = "update datos_personales set con='".$con."' where id_perfil=".$_SESSION['id_perfil'];



    mysql_query($sql) or die ("No se pudo ejecutar la consulta");



	



$_SESSION["con_"]=$con;



}







if ($_SESSION["entre_"]!=$desde.",".$hasta){



//echo $con;



$sql = "update datos_personales set entre='".$desde.",".$hasta."' where id_perfil=".$_SESSION['id_perfil'];



    mysql_query($sql) or die ("No se pudo ejecutar la consulta");



	



$_SESSION["entre_"]=$desde.",".$hasta;



}



	



}











function quien(){



$id_perfil__=$_SESSION[id_perfil];



return $id_perfil__;



}







function generaPerfil(){







$id_perfil=$_SESSION['id_perfil'];















 $sql = "SELECT SQL_NO_CACHE  ifnull(trabajo,'') trabajo



, ifnull( (SELECT nombre FROM bebida where id_bebida=d.id_bebida),'') bebida



, ifnull( (SELECT nombre FROM genero where id_genero=d.id_genero),'') genero



, ifnull( (SELECT nombre FROM educacion where id_educacion=d.id_educacion),'') educacion



,  estatura



, ifnull((SELECT nombre FROM hijos where id_hijos=d.id_hijos),'') hijos



, ifnull((SELECT nombre FROM idiomas where id_idiomas=d.id_idiomas),'') idiomas



, ifnull((SELECT nombre FROM ojos where id_ojos=d.id_ojos),'') ojos



, peso



, ifnull((SELECT nombre FROM relacion where id_relacion=d.id_relacion),'') relacion



, ifnull((SELECT nombre FROM tabaco where id_tabaco=d.id_tabaco),'') tabaco



, ifnull((SELECT nombre FROM vivienda where id_vivienda=d.id_vivienda),'') vivienda



, ifnull( musica,'') musica



, ifnull(cine,'') cine



, ifnull(deporte,'') deporte



, ifnull(profesionales,'') profesionales



, ifnull(megusta,'') megusta,edad,usuario,lugar,con,quiero,entre,id_relacion, sexo, id_complexion,id_cabello, id_ojos, id_vivienda, id_hijos, id_tabaco, id_educacion, id_idiomas,



d.fechahora actualizo, sobremi, busco, id_archivo,nombre,sobremi,busco,  fondo,c.fechahora hora, pos, case 1 when id_archivo=0 then 'imagenes/sinfoto.jpg'



 when id_archivo>0 then ( SELECT SQL_NO_CACHE concat('perfiles/',a.id_perfil,'/',b.archivo_nombre) FROM usuarios a,archivos b where a.id_perfil=b.id_perfil and a.id_perfil=c.id_perfil and a.id_archivo=b.id_archivo and a.id_perfil = c.id_perfil)  END fotoPerfil FROM usuarios c,datos_personales d where c.id_perfil=d.id_perfil and c.id_perfil=".$id_perfil;



	



    $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");







    While ($registro=mysql_fetch_assoc($consulta)){



   $Genero=$registro[genero];



   $vivienda=$registro[vivienda];



   $bebida=$registro[bebida];



   $Trabajo=$registro[trabajo];



   $Educacion=$registro[educacion];



   $Estatura=$registro[estatura];



   $Hijos=$registro[hijos];



   $Idiomas=$registro[idiomas];



   $Ojos=$registro[ojos];



   $Peso=$registro[peso];



   $re_lacion=$registro[relacion];



   $Tabaco=$registro[tabaco];



   $musica=$registro[musica];



   $cine=$registro[cine];



   $deporte=$registro[deporte];



   $profesionales=$registro[profesionales];



   $megusta=$registro[megusta];



   $edad=$registro[edad];



   $fotoPerfil= $registro[fotoPerfil];



   $sobremi= $registro[sobremi];



   $busco= $registro[busco];



   $sexo= $registro[sexo];



   $usuario= $registro[usuario];



   $quero= $registro[quiero];



   $_SESSION["quero"]=$quero;



   $entre= $registro[entre];



   $lugar= $registro[lugar];



   $con = split( ",", $registro[con]);



   $_SESSION["lugar_"]=$registro[lugar];



   $_SESSION["con_"]=$registro[con];



   $entre = split( ",", $registro[entre]);



   $_SESSION["entre_"]=$registro[entre];



   if ($registro[con]=="")  $definicion=" Cualquiera";



   $entre1=$entre[0];



   $entre2=$entre[1];



   $_SESSION["desde"]=$entre1;



   $_SESSION["hasta"]=$entre2;



   $_SESSION["sexo"]=$registro[sexo];



    }







if( count($con)==0 or count($con)==2) 	$definicion=" Cualquiera";



else {



 for($i=0;$i<count($con);$i++) 



 {



	if( $con[$i]=='0')



	{



	$definicion=" un Chico";



	}else if( $con[$i]=='1')  {



	$definicion=" una Chica";



	}



 }



}







  







$conq=" con".$definicion;	  



$quiero="Quiero ".$quero.$conq." entre ".$entre1." - ".$entre2;







/*







$sql="select SQL_NO_CACHE



 ifnull(trabajo,'') trabajo



, ifnull( (SELECT nombre FROM educacion where id_educacion=a.id_educacion),'') educacion



, ifnull((SELECT nombre FROM estatura where id_estatura=a.id_estatura),'') estatura



, ifnull((SELECT nombre FROM hijos where id_hijos=a.id_hijos),'') hijos



, ifnull((SELECT nombre FROM idiomas where id_idiomas=a.id_idiomas),'') idiomas



, ifnull((SELECT nombre FROM ojos where id_ojos=a.id_ojos),'') ojos



, ifnull((SELECT nombre FROM peso where id_peso=a.id_peso),'') peso



, ifnull((SELECT nombre FROM relacion where id_relacion=a.id_relacion),'') relacion



, ifnull((SELECT nombre FROM tabaco where id_tabaco=a.id_tabaco),'') tabaco



, ifnull((SELECT nombre FROM vivienda where id_vivienda=a.id_vivienda),'') vivienda



, ifnull( musica,'') musica



, ifnull(cine,'') cine



, ifnull(deporte,'') deporte



, ifnull(  profesionales,'') profesionales



, ifnull(megusta,'') megusta



 from datos_personales a where id_perfil=".$id_perfil;



	



    $consulta = mysql_query($sql) or die ("No se pudo ejecutar la consulta");







    While ($registro=mysql_fetch_assoc($consulta)){



   $Educacion=$registro[educacion];



   $Estatura=$registro[estatura];



   $Hijos=$registro[hijos];



   $Idiomas=$registro[idiomas];



   $Ojos=$registro[ojos];



   $Peso=$registro[peso];



   $re_lacion=$registro[relacion];



   $Tabaco=$registro[tabaco];



   $musica=$registro[musica];



   $cine=$registro[cine];



   $deporte=$registro[deporte];



   $profesionales=$registro[profesionales];



   $megusta=$registro[megusta];



   



//}*/







$per=$Educacion.$Estatura.$Hijos.$Idiomas.$Ojos.$Peso.$re_lacion.$Tabaco;



$interes=$musica.$cine.$deporte.$megusta.$profesionales;







//$cant = mysql_num_rows($consulta); 











$pag="<?php session_start();







header('Content-Type: text/html; charset=ISO-8859-1');







include(\"../../functions.php\");



//include(\"../functions.php\");











//noCache();







expirar();







//include(\"../conexion.php\");



include(\"../../conexion.php\");







visitas(".$id_perfil.");   







   







__conectado=conectado(".$id_perfil.");



__conectadox=estado(__conectado);



 



 



?>



<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">



<html xmlns=\"http://www.w3.org/1999/xhtml\">







<html lang=\"en\">



<head>



<title>Sitio Comercial Tienda On-line, venta de ropa ecologica para bebes y ni&ntilde;os, algod&oacute;n organico y Bamb&uacute;, telas certificadas libres de sustacias nocivas. Suavidad, salud y dise&ntilde;o</title>



<meta name=\"google-site-verification\" content=\"12WxAGr20MhgxFSk5OGezh-DBOBikFxFg8pc0s98eps\" />



<meta name=\"description\"



content=\"vender comprar ofertas online\" />



<meta name=\"keywords\" 



content=\"ofertas, descuentos, bonos, ticket, agrupar, unidos, hacemos la, fuerza, deporte, cultura, entretencion, santiago, chile, promociones, ocio, restaurantes, spas, belleza, tecnologia, escapadas, actividades , mucho, más, ropa, bebe, eco ,peques ,tienda ,on line, venta de ropa, ecologica ,para bebes, niños, algodon ,organico , bambu, telas ,certificadas, libres de ,sustacias, nocivas, suavidad, salud , diseño, certificaciones, comprar, venta, distribuidor, reciclar, biodegradable, hipoalergenico, sustentable, libre, pesticidas, sustancias, nocivas, vestuario\" />



<script type=\"text/javascript\" src=\"../../tabber.js\"></script>



<link href=\"../../CSS/tipoLetras.css\" rel=\"stylesheet\" type=\"text/css\" />



<script type=\"text/javascript\" src=\"../../js/jsCalalogo.js\"></script>



<script type=\"text/javascript\" src=\"../../js/javascript.js\"></script>



<script type=\"text/javascript\" src=\"../../js/varios.js\"></script>



<script type=\"text/javascript\" src=\"../../js/popup.js\"></script>



<meta http-equiv=\"X-UA-Compatible\" content=\"IE=EmulateIE7\" />



<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />



<link rel=\"shortcut icon\" href=\"/ico/lg.ico\"   />



<link rel=\"stylesheet\" type=\"text/css\" href=\"../../style.css\" media=\"screen\" />







</head>







<body >



<script>



document.body.className='<?php echo fondop(".$id_perfil.");?>';



</script>



<div id=\"principal\" style=\"position:relative;  left:0px; margin-top:5px; width:950px; height:98px; z-index:2;\">



  <?php princi(); ?>







    </div>



</div>



 <?php menum(); ?>



<div id=\"Layer2\" style=\"position:relative; left:0px; margin-top:23px; width:950px; height:auto; z-index:2;\">



  



   <div  style=\"position:absolute; left:19px; top:92px; width:221px; height:230px; z-index:3; background-color: #FFFFFF; layer-background-color: #FFFFFF; border: 1px none #000000;\">



   <div id=\"Layer1\" style=\"position:absolute; left:-8px; top:-57px; width:261px; height:45px; z-index:1; background-color: #FFFF99; layer-background-color: #FFFF99; border: 1px none #000000;\"> ".$quiero." </div>



   <?php 



  if (quien()!=".$id_perfil.")



  {



  ?>



  <div  style=\"position:absolute;  left:-5px; top:450px; width:225px; height:auto; z-index:3;\">   



   <div >Consigue su atenci&oacute;n</div>



<div id=\"Layer1\" style=\" left:0px; top:0px; width:243px; height:62px; z-index:1\"><img src=\"imagenes/imagen/flores.PNG\" width=\"121\" height=\"116\">



  <div id=\"Layer2\" style=\"position:absolute; left:129px; top:18px; width:105px; height:83px; z-index:2\">



    <p>Enviale un regalo tienes : </p>



    <div id=\"Layer3\" style=\"position:absolute; left:0px; top:51px; width:100%; height:28px; z-index:2\">10000 creditos </div>



  </div>



</div>







	<div style=\"margin-top:50px; \">&nbsp;</div>



	<div>Está en <?php posicion(".$id_perfil.",".$sexo.");?> posición en las búsquedas, 



	<?php echo cantvisitas(".$id_perfil.",'hoy');?> visitas en su perfil hoy, <?php echo cantvisitas(".$id_perfil.",'');?> este mes. </div>



	



  </div>



  <?php 



  }



  ?>   



   <img class=\"cursor_mano\" onclick=\"_Ajax_varios('galeria.php?id_perfil_=".$id_perfil."&pos=0&nombre=' + document.getElementById('fot_nom').innerText + '&edad=' + document.getElementById('fot_edad').innerText,'main_container');\"  style=\"border-color:#FFFFFF;\" border=\"10\" src=\"".$fotoPerfil."\" width=\"100%\" height=\"100%\" /></div>



   ";



 



 $fotitos="";  



// $sql="SELECT concat('perfiles/',id_perfil,'/',archivo_nombre) fotos FROM archivos where id_perfil=".$id_perfil." and id_archivo not in (SELECT id_archivo FROM usuarios where id_perfil=".$id_perfil.") order by fechahora asc limit 0,3";



  



  $sql="SELECT concat('perfiles/',id_perfil,'/',archivo_nombre) fotos FROM archivos



 where id_perfil=".$id_perfil." and id_archivo in (SELECT id_archivo FROM usuarios where id_perfil=".$id_perfil.")



 union



  SELECT concat('perfiles/',id_perfil,'/',archivo_nombre) fotos FROM archivos



 where id_perfil=".$id_perfil." and id_archivo not in (SELECT id_archivo FROM usuarios where id_perfil=".$id_perfil.")



limit 1,3";



     $consulta = mysql_query($sql) or die ($sql);







    While ($registro=mysql_fetch_assoc($consulta)){



   $fotitos.=$registro[fotos].",";



  



 }



 



 if (strlen($fotitos)>0)  $fotitos=substr ( $fotitos ,0 ,strlen($fotitos) -1);







 



  $fotitos_ = split( ",", $fotitos);



 //echo "alert('dd');";



 if (count($fotitos_)>0 && strlen($fotitos)>0) $fotito1=$fotitos_[0];



 else $fotito1="imagenes/sinfoto.jpg";



 



  if (count($fotitos_)>1) $fotito2=$fotitos_[1];



 else $fotito2="imagenes/sinfoto.jpg";



 



  if (count($fotitos_)==3) $fotito3=$fotitos_[2];



 else $fotito3="imagenes/sinfoto.jpg";



 



 



 



  $pag.=" <div style=\"position:absolute; left:16px; top:349px; width:99px; height:98px; z-index:3; background-color: #FFFFFF; layer-background-color: #FFFFFF; border: 1px none #000000;\"><img class=\"cursor_mano\" onclick=\"_Ajax_varios('galeria.php?id_perfil_=".$id_perfil."&pos=1&nombre=' + document.getElementById('fot_nom').innerText + '&edad=' + document.getElementById('fot_edad').innerText,'main_container');\"  style=\"border-color:#FFFFFF;\" border=\"10\" src=\"".$fotito1."\" width=\"100%\" height=\"100%\" /></div>



  <div  style=\"position:absolute; left:140px; top:357px; width:98px; height:94px; z-index:3; background-color: #FFFFFF; layer-background-color: #FFFFFF; border: 1px none #000000;\"><img class=\"cursor_mano\" onclick=\"_Ajax_varios('galeria.php?id_perfil_=".$id_perfil."&pos=2&nombre=' + document.getElementById('fot_nom').innerText + '&edad=' + document.getElementById('fot_edad').innerText,'main_container');\" style=\"border-color:#FFFFFF;\" border=\"10\" src=\"".$fotito2."\" width=\"100%\" height=\"100%\" /></div>



  <div  style=\"position:absolute; left:40px; top:417px; width:98px; height:94px; z-index:3; background-color: #FFFFFF; layer-background-color: #FFFFFF; border: 1px none #000000;\"><img class=\"cursor_mano\" onclick=\"_Ajax_varios('galeria.php?id_perfil_=".$id_perfil."&pos=3&nombre=' + document.getElementById('fot_nom').innerText + '&edad=' + document.getElementById('fot_edad').innerText,'main_container');\"  style=\"border-color:#FFFFFF;\" border=\"10\" src=\"".$fotito3."\" width=\"100%\" height=\"100%\" /></div>



<div  style=\"position:absolute; left:122px; top:437px; width:98px; height:94px; z-index:3; background-color: #FFFFFF; layer-background-color: #FFFFFF; border: 1px none #000000;\"><img class=\"cursor_mano\" onclick=\"_Ajax_varios('galeria.php?id_perfil_=".$id_perfil."&nombre=' + document.getElementById('fot_nom').innerText + '&edad=' + document.getElementById('fot_edad').innerText,'main_container');\" style=\"border-color:#FFFFFF;\" border=\"10\" src=\"imagenes/sinfoto.jpg\" width=\"100%\" height=\"100%\" /></div>



"; 



 



  



  $pag.="<div style=\"position:relative; height:auto; width:100%;  \">



   



  



  <div id=\"Layer7\" style=\"position:relative; left:304px; top:0px; width:577px; height:auto; z-index:7\">



    <div  style=\"position:relative; left:0px; top:10px; width:auto; height:auto; z-index:3\">



   <label id=\"fot_nom\"  class=\"letra24\">".$usuario."</label>,<label id=\"fot_edad\">".CalculaEdad($edad)."</label>&nbsp; <label id=\"<?php echo __conectadox; ?>\"><?php echo __conectado; ?></label></div>



";







if (strlen(trim($sobremi))>0)



{



$pag.="   



   <div style=\"margin-top:20px; \">



	      <h2>Sobre m&iacute; </h2>



    </div>



		 <div >



	      ".$sobremi."



</div>



";



}







if (strlen(trim($busco))>0)



{



$pag.="  



		<div> &nbsp;</div>



 <div>



	      <h2>Busco</h2>



    </div>



		 <div>



	      ".$busco."



	    </div>		



		<div> &nbsp;</div>



		 <div>



";



}		 







if (strlen(trim($per))>0) 



{



$pag.="  



	      <h2>Información personal</h2>



	    </div>



		



		



    <table width=\"574\" cellspacing=\"0\" cellpadding=\"0\">



	";



	



if (trim($re_lacion)!="")



{



$pag.="  



      <tr>



		<td width=\"124\">Relaci&oacute;n: <br /></td>



	    <td >".$re_lacion."</td>



      </tr>



    ";



	



	}



if (trim($Genero)!="")



{



$pag.="  



      <tr>



       <td class=\"xl24\">Sexualidad: </td>



        <td class=\"xl25\" width=\"390\">".$Genero."</td>



      </tr>



    ";



	



	}







if (trim($vivienda)!="")



{



$pag.="  



      <tr>



        <td class=\"xl24\">Viviendo: </td>



        <td class=\"xl25\" width=\"390\">".$vivienda."</td>



      </tr>



    ";



	



	}



if (trim($Hijos)!="")



{



$pag.="  



      <tr>



        <td class=\"xl24\">Hijos: </td>



        <td class=\"xl25\" width=\"390\">".$Hijos."</td>



      </tr>



    ";



	



	}



if (trim($Tabaco)!="")



{



$pag.="  



      <tr>



        <td class=\"xl24\">Fumador: </td>



        <td class=\"xl25\" width=\"390\">".$Tabaco."</td>



      </tr>



    ";



	



	}



if (trim($bebida)!="")



{



$pag.="  



      <tr>



        <td class=\"xl24\">Bebida: </td>



        <td class=\"xl25\" width=\"390\">".$bebida."</td>



      </tr>



    ";



	



	}



if (trim($Educacion)!="")



{



$pag.="  



      <tr>



        <td class=\"xl24\">Educaci&oacute;n: </td>



        <td class=\"xl25\" width=\"390\">".$Educacion."</td>



      </tr>



    ";



	



	}



if (trim($Idiomas)!="")



{



$pag.="  



      <tr>



        <td class=\"xl24\">Idiomas: </td>



        <td class=\"xl25\" width=\"390\">".$Idiomas."</td>



      </tr>



    ";



	



	}



if (trim($Trabajo)!="")



{



$pag.="  



      <tr>



        <td class=\"xl24\">Trabajo: </td>



        <td class=\"xl25\" width=\"390\">".$Trabajo."</td>



      </tr>



    ";



	



	}



	 















	  /* 



	  



        <td class=\"xl25\">168cm (5'&nbsp;6''&nbsp;), 68kg (150libras), soy de complexion normal, mi pelo es casta&ntilde;o y ojos verdes. </td>







        <td class=\"xl25\">Ingl&eacute;s (Intermedio), Espa&ntilde;ol (Nativo) y Portugu&eacute;s (Principiante) </td>



    */



$pag.="  	



    </table>



";



}	



if (strlen(trim($interes))>0) 



{



$pag.="  	



    <div></div>



	    <div>



	      <h2>Intereses</h2>



	    </div>



		<table width=\"574\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">



";







if (trim($musica)!="")



{



$pag.="  



  <tr>



    <td width=\"173\">En m&uacute;sica: <br /></td>



    <td width=\"401\">".$musica."</td>



  </tr>



    ";



	



	}



	 



if (trim($cine)!="")



{



$pag.="  



  <tr>



    <td>En cine, libros y TV: </td>



    <td>".$cine."</td>



  </tr>



    ";



	



	}







if (trim($deporte)!="")



{



$pag.="  



  <tr>



    <td>En deporte:</td>



    <td>".$deporte."</td>



  </tr>



      ";



	



	}







if (trim($profesionales)!="")



{



$pag.="  



<tr>



    <td>Mis pasiones personales y profesionales:</td>



    <td>".$profesionales."</td>



  </tr>



      ";



	



	}	







$pag.="  



</table>



<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">



 ";



 



 if (trim($megusta)!="")



{


$pag.="  



  <tr>



    <td>Tambi&eacute;n me gusta: </td>



  </tr>



  <tr>



    <td>".$megusta."</td>



  </tr>



";



 }



 



$pag.="  



</table>



";



}



  $pag.="   <div>



      <p>&nbsp;</p>



    </div>



	    <div>



	      <h2>Albumes</h2>



	    </div>		



		



		<div>En la yapla 











 (2".trim($re_lacion)." fotos, 4 comentarios)</div>



		<div id=\"Layer4\" style=\"position:relative; left:50px; top:0px; width:490px; height:222px; z-index:3; background-color: #ECE9D8; layer-background-color: #ECE9D8; border: 1px none #000000;\">



		<img src=\"2_5ffd9_n.jpg\" width=\"50%\" height=\"223\" />



		<img src=\"3sdffffdf16489_n.jpg\" width=\"49%\" height=\"223\" />



		</div>



		<div>&nbsp;</div>



		<div>Otros..











 (2 fotos, 4 comentarios)</div>



	  <div id=\"Layer4\" style=\"position:relative; left:50px; top:0px; width:490px; height:222px; z-index:3; background-color: #ECE9D8; layer-background-color: #ECE9D8; border: 1px none #000000;\">



	  		<img src=\"2_5ffd9_n.jpg\" width=\"50%\" height=\"223\" />



	  <img src=\"3sdffffdf16489_n.jpg\" width=\"49%\" height=\"223\" />	  </div>



  </div>



  <div style=\"position:relative; height:100px; \">Colocar aquí el contenido de la nueva etiqueta Div</div>



  </div>



</div>



<script>  xajax_desplazar();



</script>



</body>



</html>



";



 $pag = str_replace("__","$",$pag);



// $pag = str_replace("_a_","$_",$pag);











 $gestorhtm = fopen("perfiles/".$id_perfil."/index.php", 'w')or die("Problemas en la creacion del archivo noticia1.htm"); 







	if (fwrite($gestorhtm,$pag) == FALSE) { 



	echo "No se puede escribir al archivo"; 



	exit; 



	} 







fclose($gestorhtm); 











}







function leearchivo($path)



{



   //Iniciamos la variable



   $texto = "";



   //Abrimos el archivo en modo lectura



   $fp = fopen($path,"r");



   //Leemos linea por linea el contenido del archivo



   while ($linea= fgets($fp,1024))



   {



      //Anadimos la linea modificada al texto



      $texto .= $linea;



   }



   fclose($fp); 



   return $texto;



}







function genera_comentario($ruta,$msj,$cual,$aleatorio,$id_)



{







$texto = "";



   //Abrimos el archivo en modo lectura



   $fp = fopen($ruta,"r"); 







//operar con el fichero 



   //Leemos linea por linea el contenido del archivo



   while ($linea= fgets($fp,1024))



   {



      //Anadimos la linea modificada al texto



      $texto .= $linea;



   }



	$ini=strpos($texto,'fin_'.$cual);



	//$fin=strpos($texto,'fin_coment_pag1' );



	//strlen($texto) -



/*$frase	= "<div style=\"marging-top:50px; position:relative; height:auto; left:0px;  width:637px; border:1px none #c0c0c0;\">".



    "<div  id=\"Layer1\" style=\"position:relative; left:15px; margin-top:0px; width:70px; height:10px; z-index:1\">".



"<img class=\"cursor_mano\" onMouseUp=\"_Ajax_varios('perfiles/".$_SESSION['id_perfil']."','main_container');\" style=\"position:absolute; top:11px; left: -8px;\" src=\"<?php echo mini_Coment(".$_SESSION['id_perfil']."); ?>\" width=\"33\" height=\"36\">".



"</div><div style=\"position:relative; left: 76px; top: 6px; width: 87%; height: auto; background-color: #E2E2E2; layer-background-color: #E2E2E2; border: 1px none #000000;\" >".



"<label style=\"width:100%; \">".$msj."</label>".



"</div>  </div>  <div onClick=\"document.body.removeChild(this);\" style=\"marging-top:20px; float:right; position:relative; height:20px;\">Eliminar comentario</div>";	



	*/



	$id_perfil_=$_SESSION['id_perfil'];



$frase="<div id=\"unap".$aleatorio."\" style=\"marging-top:20px; position:relative; height:auto; left:0px;  width:637px; border:1px none #c0c0c0;\">".



 "<div id=\"Layer1\" style=\"position:relative; left:15px; margin-top:0px; width:70px; height:10px; z-index:1\">".



"<img class=\"cursor_mano\" onMouseUp=\"_Ajax_varios('perfiles/".$id_perfil_."','main_container');\" style=\"position:absolute; margin-top:11px; left: -8px;\" src=\"<?php echo mini_Coment(".$_SESSION['id_perfil']."); ?>\" width=\"33\" height=\"36\">".



"</div>	<div  style=\"position:relative; left: 76px; margin-top: 0px; width: auto; height: auto;\"><a onMouseUp=\"_Ajax_varios('perfiles/".$id_perfil_."','main_container');\" href=\"#\">".$_SESSION['nombre_']."</a>&nbsp;&nbsp;&nbsp;<?php postio('".date("Y-n-j H:i:s")."'); ?></div><div style=\"position:relative; left: 76px; top: 6px; width: 87%; height: auto; background-color: #E2E2E2; layer-background-color: #E2E2E2; border: 1px none #000000;\" >".



"<label style=\"width:100%; \">".$msj."</label>".



"</div> </div> <?php if (quien()==".$id_perfil_." || quien()==".$id_." ){ ?> <div  onClick=\"xajax_regenera_comentario('".$ruta."','unap".$aleatorio."');document.getElementById('".$cual."').removeChild(document.getElementById('unap".



$aleatorio."'));document.getElementById('".$cual."').removeChild(this); \" style=\"position:relative;marging-top:0px; left:450px;"." width:130px; height:auto;\">Eliminar comentario</div>".



"<?php }else{?><div style=\"position:relative;marging-top:0px; width:10px; left:450px; height:10px;\"></div><?php }?> <!-- fin_unap".



$aleatorio." -->";



		



	







	



	//$frase=str_replace("<?php echo mini_Coment(" + id_perfil_ + "); ? > ",$ruta,$frase);	



	



	



//    $frase = str_replace("__","()",$frase);	



	



  $addp=substr($texto,0,$ini - 12 ).$frase.substr($texto,$ini - 12,strlen($texto) );



   



//    $pag = str_replace("__","$",$pag);



   



//   fwrite ($fp,$addp); 



//   fwrite ($reffichero,$frase); 



  



   fclose($fp); 







$fp1 = fopen($ruta,"w+"); 



   fwrite ($fp1,$addp); 



  



   fclose($fp1); 







//$comentarios=leearchivo($ruta);







  //instanciamos el objeto para generar la respuesta con ajax 



  /* $mipos = new xajaxResponse(); 



   //escribimos en la capa con id="respuesta" el texto que aparece en $salida 



   $mipos->script("alert('".$ruta."');"); 







    //tenemos que devolver la instanciación del objeto xajaxResponse 



   return $mipos; 



*/







}







function regenera_comentario($ruta,$cual)



{







$texto = "";



   $fp = fopen($ruta,"r"); 







   while ($linea= fgets($fp,1024))



   {



      $texto .= $linea;



   }



	$ini=strpos($texto,'id="'.$cual);



	$fin=strpos($texto,"fin_".$cual);



	



     $addp=substr($texto,0,$ini - 5 ).substr($texto,$fin  + 3 + strlen($cual) + 5,strlen($texto) );



// $addp=substr($texto,$fin  +10 + strlen($cual) + 5,strlen($texto) );



//  $addp=substr($texto,0,$ini - 5 );



   fclose($fp); 







$fp1 = fopen($ruta,"w+"); 



   fwrite ($fp1,$addp); 



  



   fclose($fp1); 







/*   $mipos = new xajaxResponse(); 



   //escribimos en la capa con id="respuesta" el texto que aparece en $salida 



   $mipos->script("alert('"."fin_".$cual."');"); 







    //tenemos que devolver la instanciación del objeto xajaxResponse 



   return $mipos;*/



}







function fate()



{



 echo "    <div style=\" overflow-x:scroll; overflow-y:hidden; position:relative; margin-left:50px; left:0px; margin-top:51px; width:567px; height:123px; z-index:2001; background-color: #c0c0c0;  line-height: 123px; layer-background-color: #c0c0c0;\">



  <div id=\"focoantencion\" style=\"  position:relative; margin-left:0px; left:0px; margin-top:0px; width:567px; height:123px; z-index:2001; background-color: #FFFFFF;  line-height: 123px; layer-background-color: #FFFFFF;\"></div>



  </div>



  <div  style=\"position:absolute; left:606px; top:-10px; width:26px; height:29px; z-index:1\"><img onmouseup=\"muestraosc.ocultar('subirfotos');\" src=\"imagenes/ico/cerrar.gif\" /></div>



  <div style=\"position:relative; margin-top:20px; height:auto; \" > 



      <textarea style=\"position:relative; left: 66px; margin-top: 16px;\" name=\"mensaje\" id=\"mensaje\" cols=\"60\" rows=\"8\"></textarea>



    <div style=\"position:absolute; left: 467px; top: 5px; width: 155px; height: 145px;\">



      <p>Colocar aquí el <label id=\"id_foco_atencion\" >contenido</label> de la nueva etiqueta Div</p>



      <p><span class=\"cursor_mano\">



        <input style=\"position:absolute; left: 38px; top: 97px;\" name=\"Submit2\" type=\"button\" class=\"cursor_mano msj_info_b\" onmouseup=\"xajax_addfocoatencion(document.getElementById('id_foco_atencion').innerText,document.getElementById('mensaje').value); muestraosc.ocultar('subirfotos');\" value=\"Subir foto \" />



      </span></p>



    </div>



  </div>



";







}







function princi()



{



echo " <div  id=\"cerses\"  style=\" position:absolute; top:5px; left:846px; width: 92px; background-color: #FF9900;  z-index:30; layer-background-color: #FF9900; cursor:'hand';\">



  <div onclick=\"_Ajax_varios('closesesion.php');\" align=\"center\">Cerrar sesion </div>



</div>



    <div id=\"Layer1\" style=\"position:absolute; margin-left: 0px; left:6px; top:-1px; width:auto; height:auto; z-index:1;\"><img src=\"imagenes/enamorame14.png\" width=\"225\" height=\"73\" /></div>



    <div id=\"Layer2\" style=\"position:absolute; margin-left: 0px;left:224px; top:-5px; width:710px; height:97px; z-index:2;\">



      <div id=\"ponmeaki\" title=\"ponme aki\" style=\"position:absolute; left:10px; top:-3px; width:87px; height:59px; z-index:4\"><img class=\"cursor_mano\" onmouseup=\"muestraosc.mostrar('subirfotos'); xajax_focoatencion('focoantencion');\" src=\"imagenes/pone_promo.png\" alt=\"ponme aki\" width=\"85\" height=\"70\"></div>



      <div  style=\"position:absolute; left:81px; top:8px; width:623px; height:105px; z-index:3; background-image: url(/imagenes/ico/papel.png); layer-background-image: url(/imagenes/ico/papel.png);\">



	  <div id=\"contPromo\"   style=\"position:relative; margin-left:0px; margin-top:0px; width:100%; height:100%; z-index:1; overflow:hidden;  border: 1px none #000000; background-image: url(plated.png); layer-background-image: url(plated.png);\" class=\"formulario_smal\">



     <div style=\"overflow:hidden; position:absolute; border: 1px none #AA0000; line-height: 100px; width: auto; height: 100px; left:0px; top: 0px; \" id=\"promo\">&nbsp; </div>



</div> </div>	  ";











}







function  menum(){







 echo "<div id=\"Layer8\" style=\"position:relative; left:226px; margin-top:6px; width:700px; height:36px; z-index:3\">



  <table width=\"704\" height=\"17\" border=\"none\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#FFFFFF\">



    <tr  bordercolor=\"#FFFFFF\">



      <td width=\"154\"><div align=\"center\" class=\"borde_fino_naranjo\">5 <a onclick=\"vaciarObj('main_container');  _Ajax_varios('perfil.php','main_container');\" href=\"#\">mensajes</a> </div></td>



      <td width=\"26\"><div align=\"center\" class=\"borde_fino_naranjo\"><a onclick=\"_Ajax_varios('fotitos.php','main_container');\"  href=\"#\">3</a> </div></td>



      <td width=\"93\"><div align=\"center\" class=\"Estilo2 Estilo5\"><a onclick=\"_Ajax_varios('imagen/perfil.php','main_container');\" href=\"#\">sube</a> </div></td>



        <td width=\"165\" ><div align=\"center\" class=\"Estilo2 Estilo5\"><a onclick=\"_Ajax_varios('portada.php','main_container','busquedapor(0,0);');  \" href=\"#\">busqueda</a></div></td>



        <td width=\"121\" ><div align=\"center\" class=\"Estilo2 Estilo5\"><a onclick=\" _Ajax_varios('portada.php','main_container','busquedapor(0,1);'); \" href=\"#\">visitas</a> </div></td>



        <td width=\"34\" ><div align=\"center\" class=\"Estilo2 Estilo5 Estilo6\"> </div></td>



		<td width=\"93\" ><div align=\"center\" class=\"Estilo2 Estilo5\">



		  <div  id=\"Layer4\" style=\"position:relative; left:6px; top:2px; width:23px; height:21px; z-index:4;\"><img src=\"imagenes/nuevo.gif\" alt=\"Nuevo Modelo\" width=\"20\" height=\"20\" style=\"cursor:'hand'; \" onclick=\"muestraosc.visible('subir_archivos');\" /></div>



		  3 </div></td>



    </tr>



  </table>



</div>";



}







function existeComentario($archivo)



{



















/*



$frase="<?php session_start();



include(\"../../functions.php\");



?>



<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"



\"http://www.w3.org/TR/html4/loose.dtd\">



<html>



<head>



<title>Documento sin t&iacute;tulo</title>



<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">



<script type=\"text/javascript\" src=\"../../js/javascript.js\"></script>



</head>



<body>



<div id=\"Layer2\" style=\"position:relative; margin-left:0px; margin-top:10px; width:553px; height:auto; z-index:2\">



  <div id=\"addcomentario\" style=\"position:relative; overflow:hidden; margin-left:0px; top:1px; width:100%; height:20px; z-index:1;\">



  <a onclick=\"document.getElementById('addcomentario').style.height='250px';\" href=\"#addcomentario\">Agrega comentario</a>



  <textarea style=\"position:absolute; left: 20px; top: 21px;\" id=\"texcoment\" cols=\"60\" rows=\"6\"></textarea> <input  style=\"position:absolute; left: 29px; top: 146px;\" name=\"Submit\" type=\"button\" class=\"cursor_mano msj_info_b\"



   onmouseup=\"ponecoment(document.getElementById('texcoment').value,'coment_pag1');document.getElementById('addcomentario').style.height='20px'; document.getElementById('texcoment').value=''\" value=\"Comentar\" />



  </div>



    <div id=\"coment_pag1\" style=\"position:relative; marging-top:20px; height:auto;\" ></div> <!-- fin_coment_pag1 -->



 <div style=\"position:relative; margin-top:50px; height:50px;\"></div>



</div>



<script>



pag_coment='<?php echo $_SERVER[SCRIPT_FILENAME]; ?>';



id_perfil='<?php echo $_SESSION[id_perfil]; ?>';



nombre_='<?php echo $_SESSION[nombre_]; ?>';



pag_coment=pag_coment.substring(pag_coment.indexOf(\"perfiles\"), pag_coment.lenght);	



xajax_cualFotoPerfil();



</script>



</body>



</html>";







if (!file_exists($archivo)){ 



copy("plantilla_comentarios.php",$archivo);



 $reffichero = fopen($archivo, "w+"); 







//operar con el fichero 



fwrite ($reffichero,$frase); 



//cerrar el fichero 



fclose ($reffichero); 







} 



*/



 //echo "_Ajax_varios('galeria.php?id_perfil_=".$id_perfil."&pos=0','main_container');"; // ";















}







function ImageCreateFromBMP($filename)



{



 //Ouverture du fichier en mode binaire



   if (! $f1 = fopen($filename,"rb")) return FALSE;







 //1 : Chargement des ent?tes FICHIER



   $FILE = unpack("vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread($f1,14));



   if ($FILE['file_type'] != 19778) return FALSE;







 //2 : Chargement des ent?tes BMP



   $BMP = unpack('Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel'.



                 '/Vcompression/Vsize_bitmap/Vhoriz_resolution'.



                 '/Vvert_resolution/Vcolors_used/Vcolors_important', fread($f1,40));



   $BMP['colors'] = pow(2,$BMP['bits_per_pixel']);



   if ($BMP['size_bitmap'] == 0) $BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];



   $BMP['bytes_per_pixel'] = $BMP['bits_per_pixel']/8;



   $BMP['bytes_per_pixel2'] = ceil($BMP['bytes_per_pixel']);



   $BMP['decal'] = ($BMP['width']*$BMP['bytes_per_pixel']/4);



   $BMP['decal'] -= floor($BMP['width']*$BMP['bytes_per_pixel']/4);



   $BMP['decal'] = 4-(4*$BMP['decal']);



   if ($BMP['decal'] == 4) $BMP['decal'] = 0;







 //3 : Chargement des couleurs de la palette



   $PALETTE = array();



   if ($BMP['colors'] < 16777216)



   {



    $PALETTE = unpack('V'.$BMP['colors'], fread($f1,$BMP['colors']*4));



   }







 //4 : Cr?ation de l'image



   $IMG = fread($f1,$BMP['size_bitmap']);



   $VIDE = chr(0);







   $res = imagecreatetruecolor($BMP['width'],$BMP['height']);



   $P = 0;



   $Y = $BMP['height']-1;



   while ($Y >= 0)



   {



    $X=0;



    while ($X < $BMP['width'])



    {



     if ($BMP['bits_per_pixel'] == 24)



        $COLOR = unpack("V",substr($IMG,$P,3).$VIDE);



     elseif ($BMP['bits_per_pixel'] == 16)



     {  



        $COLOR = unpack("n",substr($IMG,$P,2));



        $COLOR[1] = $PALETTE[$COLOR[1]+1];



     }



     elseif ($BMP['bits_per_pixel'] == 8)



     {  



        $COLOR = unpack("n",$VIDE.substr($IMG,$P,1));



        $COLOR[1] = $PALETTE[$COLOR[1]+1];



     }



     elseif ($BMP['bits_per_pixel'] == 4)



     {



        $COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));



        if (($P*2)%2 == 0) $COLOR[1] = ($COLOR[1] >> 4) ; else $COLOR[1] = ($COLOR[1] & 0x0F);



        $COLOR[1] = $PALETTE[$COLOR[1]+1];



     }



     elseif ($BMP['bits_per_pixel'] == 1)



     {



        $COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));



        if     (($P*8)%8 == 0) $COLOR[1] =  $COLOR[1]        >>7;



        elseif (($P*8)%8 == 1) $COLOR[1] = ($COLOR[1] & 0x40)>>6;



        elseif (($P*8)%8 == 2) $COLOR[1] = ($COLOR[1] & 0x20)>>5;



        elseif (($P*8)%8 == 3) $COLOR[1] = ($COLOR[1] & 0x10)>>4;



        elseif (($P*8)%8 == 4) $COLOR[1] = ($COLOR[1] & 0x8)>>3;



        elseif (($P*8)%8 == 5) $COLOR[1] = ($COLOR[1] & 0x4)>>2;



        elseif (($P*8)%8 == 6) $COLOR[1] = ($COLOR[1] & 0x2)>>1;



        elseif (($P*8)%8 == 7) $COLOR[1] = ($COLOR[1] & 0x1);



        $COLOR[1] = $PALETTE[$COLOR[1]+1];



     }



     else



        return FALSE;



     imagesetpixel($res,$X,$Y,$COLOR[1]);



     $X++;



     $P += $BMP['bytes_per_pixel'];



    }



    $Y--;



    $P+=$BMP['decal'];



   }







 //Fermeture du fichier



   fclose($f1);







 return $res;



}











function carritoadd($id_archivo,$precio,$modelo){







if(!isset($cantidad)){$cantidad=1;} 















//$qry=mysql_query("SELECT id_archivo,a.id_categoria, precio, modelo, id, nombre categoria FROM catalogo a, categorias b where a.id_categoria=b.id_categoria and  



//id='".$id."'"); 



//$row=mysql_fetch_array($qry); 







if(isset($_SESSION['carro'])) 



$carro=$_SESSION['carro']; 







$carro[md5($id_archivo)]=array('identificador'=>md5($id_archivo),'cantidad'=>$cantidad,'modelo'=>$modelo, 'precio'=>$precio,'id_archivo'=>$id_archivo); 







$_SESSION['carro']=$carro; 







 $suma=0; 







 if($carro){ 



	   foreach($carro as $k => $v){ 



		$subto=$v['cantidad']; 



		$suma=$suma+$subto; 



		$pesos=$pesos+ ($v['cantidad']*$v['precio']); 



	    }



		}



$pesos= number_format($pesos,0, ",", ".");



$suma=number_format($suma,0, ",", ".");







 $mipos = new xajaxResponse(); 



   //escribimos en la capa con id="respuesta" el texto que aparece en $salida 



   $mipos->script("document.getElementById('agrecar').innerText='".number_format($suma,0, ",", ".")."';document.getElementById('pesos').innerText='".



   $pesos."'; document.getElementById('salida_addcarro').innerHTML=document.getElementById('elcarro_').innerHTML;document.getElementById('div_salida_addcarro').style.visibility='visible'; "); 







    //tenemos que devolver la instanciación del objeto xajaxResponse 



   return $mipos;







}







function carritoact($id_archivo,$precio,$modelo,$cantidad){







if(!isset($cantidad)){$cantidad=1;} 















//$qry=mysql_query("SELECT id_archivo,a.id_categoria, precio, modelo, id, nombre categoria FROM catalogo a, categorias b where a.id_categoria=b.id_categoria and  



//id='".$id."'"); 



//$row=mysql_fetch_array($qry); 







if(isset($_SESSION['carro'])) 



$carro=$_SESSION['carro']; 







$carro[md5($id_archivo)]=array('identificador'=>md5($id_archivo),'cantidad'=>$cantidad,'modelo'=>$modelo, 'precio'=>$precio,'id_archivo'=>$id_archivo); 











$_SESSION['carro']=$carro; 







 $suma=0; 







 if($carro){ 



	   foreach($carro as $k => $v){ 



		$subto=$v['cantidad']; 



		$suma=$suma+$subto; 



		$pesos=$pesos+ ($v['cantidad']*$v['precio']); 



	    }



		}







$pesos= number_format($pesos,0, ",", ".");



$suma=number_format($suma,0, ",", ".");







 $mipos = new xajaxResponse(); 



   //escribimos en la capa con id="respuesta" el texto que aparece en $salida  document.getElementById('agrecar').innerText='".$suma."';document.getElementById('pesos').innerText='".$pesos."';



 //  $mipos->script("alert('".$id_archivo.",".$precio.",".$modelo.",".$cantidad."');"); 



	 $mipos->script("document.getElementById('agrecar').innerText='".$suma."'; document.getElementById('pesos').innerText='".$pesos."'; document.getElementById('hayencarro').innerText='".$suma."'; document.getElementById('sumaencarro').innerText='".$pesos."';"); 







    //tenemos que devolver la instanciación del objeto xajaxResponse 



   return $mipos;







} 











function carritodel($id_archivo){







$carro=$_SESSION['carro']; 



//Asignamos a la variable 



//$carro los valores 



//guardados en la sessión 



unset($carro[md5($id_archivo)]); 



//la función unset borra 



//el elemento de un array  



//que le pasemos por 



//parámetro. En este caso 



//la usamos para borrar el 



//elemento cuyo id le pasemos 



//a la página por la url  



$_SESSION['carro']=$carro; 



//Finalmente, actualizamos 



//la sessión, como hicimos 



//cuando agregamos un producto 



//y volvemos al catálogo 



//header("Location:catalogo.php?".SID); 







//echo "seleccionados('agregarcar','".SID."','".$id."','productonoagregado.gif');";



 $suma=0; 



$pesos="0";



 if($carro){ 



	   foreach($carro as $k => $v){ 



		$subto=$v['cantidad']; 



		$suma=$suma+$subto; 



		$pesos=$pesos+ ($v['cantidad']*$v['precio']); 



	    }



		}



		



$pesos= number_format($pesos,0, ",", ".");



$suma=number_format($suma,0, ",", ".");







 $mipos = new xajaxResponse(); 



   //escribimos en la capa con id="respuesta" el texto que aparece en $salida 



   $mipos->script("document.getElementById('agrecar').innerText='".$suma."'; document.getElementById('pesos').innerText='".$pesos."'; document.getElementById('hayencarro').innerText='".$suma."'; document.getElementById('sumaencarro').innerText='".$pesos."';"); 







    //tenemos que devolver la instanciación del objeto xajaxResponse 



   return $mipos;







}











function ruta_archivo($id_archivo)



{







//mysql_query("CALL primero(59);");







$sql = "SELECT concat('fotos/',archivo_nombre) foto FROM archivos where id_archivo=".$id_archivo;







    $consulta = mysql_query($sql) or die ($sql);



    While ($registro=mysql_fetch_assoc($consulta)){



    echo $registro[foto];







    }







}











function envia_correo(){











/*



if(isset($_SESSION['carro']))



{



//session_unset();



//session_destroy(); 



$carro=$_SESSION['carro'];



}



else $carro=false; 



*/



//include("functions.php");











//noCache();











if(isset($_SESSION["correo"]))



{















$nombre = "pancho";//$_GET['nombre'];















$mail = "ventas@printerandprint.cl"; //$_GET['mail'];















$telefono = "342343"; //$_GET['telefono'];































$header = 'From: ' . $mail . " \r\n";




$header .= 'Bcc: ventas@printerandprint.cl' . " \r\n";









$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";















$header .= "Mime-Version: 1.0 \r\n";















$header .= "Content-type: text/html; charset=utf-8\r\n";































//$mensaje = "Este mensaje fue enviado por " . $nombre . ", Telefono de contacto: " . $telefono . "\r\n";















//$mensaje .= "Su e-mail es: " . $mail . " \r\n";















//$mensaje .= "Mensaje: " . $_GET['mensaje'] . " \r\n";







//$mensaje .=







//$mensaje .= "Enviado el " . date('d/m/Y', time());















$mensaje ='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"

"http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>

<body>



<div  style="position:absolute; left:0px; top:16px; width:100%; height:92px; z-index:2;background-color: #CECECE; layer-background-color: #CECECE; background-image: url(http://www.printerandprint.cl/imagenes/ico/top_bk.jpg); layer-background-image: url(http://www.printerandprint.cl/imagenes/ico/top_bk.jpg); border: 1px none #000000; ">

  <div  style="position:absolute; left:0px; top:3px; width:219px; height:65px; z-index:1"><img src="http://www.printerandprint.cl/imagenes/ico/131378500.png" width="253" height="89"></div>

</div>



<p>&nbsp;</p>

<p>Estimado cliente:</p>
<p>&nbsp;</p>
<p>Hemos recibido una solicitud de cotización por lo siguiente:</p>






							<p>&nbsp;</p>













<table width="776" border="0" cellspacing="0" cellpadding="0" align="center" > 







<tr bgcolor="#333333" style="color: #FFFFFF; "> 







<td width="124"><div align="center" >Modelo</div></td> 















<td width="150"><div align="center" >Cantidad de Unidades</div></td></tr>'; 



















$contador=0; 







$suma=0; 



$cantidades=0;



if(isset($_SESSION['carro'])) 



$carro=$_SESSION['carro'];



//else $carro=false; 







//if($carro)



//{



foreach($carro as $k => $v){ 







$subto=$v['cantidad']*$v['precio']; 







$suma=$suma+$subto; 



$cantidades=$cantidades+$v['cantidad'];





$contador++; 







$mensaje .='<tr bgcolor='.$color[$contador%2].'> 





<td>'.$v['modelo'].'</td> 















<td width="150" align="center">'.$v['cantidad'].'</td></tr>';







}



$lasuma=number_format( $suma,0, ",", ".");

//}



$mensaje .='</table><p>&nbsp;</p>';







$mensaje .='<div align="center"><span class="prod">Artículos: '.number_format( count($carro),0, ",", ".").',  Total de Artículos: '.number_format( $cantidades,0, ",", ".").'</span></div>







<p>&nbsp;</p><div align="center"><span ></span>



<p>&nbsp;</p>



<div style="position:absolute; left:5%;  width:90%; height:auto; z-index:1; background-color: #EEEEEE; layer-background-color: #EEEEEE; border: 1px none #000000;">

  

  <p>En un plazo inferior a 24 horas enviaremos la cotización al correo electrónico con el que suscribió a nuestra página.</p>

  <p>

</div>



<p>&nbsp;</p>



<p>Atentamente,</p>
<p>Equipo Printer&Print</p>

</div></body></html> ';







//echo $mensaje;							







$para = $_SESSION["correo"];// 'franciscoj.dominguez@hotmail.com';















$asunto = 'Printer&Print';















mail($para, $asunto, $mensaje, $header) or die ("Error al enviar el Formulario !"); 


mail('ventas@printerandprint.cl', $asunto, $mensaje, $header) or die ("Error al enviar el Formulario !"); 













//$_SESSION['cantcomp']=$_SESSION['cantcomp']+1;















$mipos = new xajaxResponse(); 



   //escribimos en la capa con id="respuesta" el texto que aparece en $salida 

   $mipos->script(" parent.document.getElementById('div_salida_enviocarro').style.display='block'; parent.document.getElementById('div_salida_enviocarro').style.visibility='visible';"); 





// document.getElementById('div_salida_enviocarro').style.visibility='visible'; document.getElementById('div_salida_enviocarro').style.display='block';



    //tenemos que devolver la instanciación del objeto xajaxResponse 



   return $mipos;













/*

echo "<script> document.getElementById('div_salida_enviocarro') document.getElementById('div_salida_enviocarro').style.visibility='visible'; 

document.getElementById('div_salida_enviocarro').style.display='block'; </script>";

*/





}











}





function act_preferencias($usuario,$nombre,$telefonos){





$sql = "  update usuarios set usuario='".$usuario."',nombre='".$nombre."',telefonos='".$telefonos."' where id_perfil=".$_SESSION['id_perfil'];



	    mysql_query($sql) or die ($sql);

		

	

   $mipos = new xajaxResponse(); 



   $mipos->script("muestraosc.ocultar('divMsgnu');muestraosc.ocultar('sombra');");





   return $mipos;



		



}





function act_passwdpreferencias($clave){





	if (strlen(trim($clave))>0) {



$sql = " update usuarios set clave='".md5($clave)."' where id_perfil=".$_SESSION['id_perfil'];



	    mysql_query($sql) or die ($sql);

		



   

$mail = $_SESSION['correo'];

$from = 'ventas@printerandprint.cl';

$header = 'From: ' . $from . " \r\n";

$header .= 'Bcc: ventas@printerandprint.cl' . " \r\n";

$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";

$header .= "Mime-Version: 1.0 \r\n";

$header .= "Content-type: text/html; charset=utf-8\r\n";



//franciscoj.dominguez@hotmail.com

  

$mensaje = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"

"http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>

<body>

<div  style="position:absolute; left:0px; top:16px; width:100%; height:92px; z-index:2; background-image: url(http://www.printerandprint.cl/imagenes/ico/top_bk.jpg); layer-background-image: url(http://www.printerandprint.cl/imagenes/ico/top_bk.jpg); border: 1px none #000000; background-color: #CECECE; layer-background-color: #CECECE;">

  <div  style="position:absolute; left:0px; top:3px; width:219px; height:65px; z-index:1"><img src="http://www.printerandprint.cl/imagenes/ico/131378500.png" width="253" height="89"></div>

</div>





<div  style="position:absolute; left:6px; top:76px; width:100%; height:350px; z-index:1">

<div>

<p>&nbsp;</p>

<p>&nbsp;</p>

Estimado usuario, su clave de acceso a sido modificada para que visite nuestro Sitio <a href="www.printerandprint.cl">www.printerandprint.cl</a>,

este email forma parte del proceso de entrega de mensajes, las respuestas a este mensaje no están monitorizadas. 

</div>



<div style="top:40px;  ">

<p>&nbsp;</p>

 <strong>Sus nuevos datos de registro </strong><br>

Contrase&ntilde;a: '.$clave.' <br>

</div>

<div style="top:0; margin-top:20px; ">

<p>&nbsp;</p>

Tambien puede ir derecto a nuestro Sitio Web en este enlace <a href="http://www.printerandprint.cl/index.php?htpencriptpasste='.md5($clave).'&correo='.$mail.'">Ir a www.printerandprint.cl</a></div>

<p>&nbsp;</p>

Saludos, El Equipo de <a href="www.printerandprint.cl">www.printerandprint.cl</a>

</div>

</body>

</html>

';

//franciscoj.dominguez@hotmail.com



$para = $mail;











$asunto = 'Contacto desde www.printerandprint.cl ';











/*$actual = explode("/", $_SERVER['HTTP_REFERER']);





$pagactual=substr($actual[count($actual)-1],0,strpos($actual[count($actual)-1],"."));



*/



//echo "<script> alert('$pagactual'); </ script>";

/*



if ($pagactual=="index")



{



*/







//mail($para, $asunto, $mensaje, $header) or die ("Error al enviar el Formulario !"); 

   

   

  

//echo " if (document.getElementById('usuario_login')){ document.getElementById('usuario_login').innerText='".$_GET['usuario']."';} ocultar('sombra'); ocultar('divMsgnu'); location.href='index.php'; ";

		

		

		

		

		

		

			}







}


function fotitos($id){

if ($id>1) return "Mira mis ".$id." fotos";
else
return "Amplia mi foto";
}



//$xajaxa = new xajax(); 



$xajax->registerFunction("conexcion"); 



$xajax->registerFunction("primerox"); 



$xajax->registerFunction("mifondo"); 



$xajax->registerFunction("ahoraquero"); 



$xajax->registerFunction("generaPerfil"); 



$xajax->registerFunction("postio"); 



$xajax->registerFunction("cambiaFotoPerfil"); 



$xajax->registerFunction("eliminaFoto"); 



$xajax->registerFunction("desplazar"); 



$xajax->registerFunction("focoatencion"); 



$xajax->registerFunction("addfocoatencion"); 



$xajax->registerFunction("cualFotoPerfil"); 



$xajax->registerFunction("genera_comentario"); 



$xajax->registerFunction("regenera_comentario"); 



$xajax->registerFunction("carritoadd"); 



$xajax->registerFunction("carritodel"); 



$xajax->registerFunction("carritoact"); 



$xajax->registerFunction("envia_correo"); 



$xajax->registerFunction("cierra_sesion"); 



$xajax->registerFunction("act_preferencias"); 



$xajax->registerFunction("act_passwdpreferencias"); 











$xajax->processRequest();







?>