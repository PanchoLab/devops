    var isIE = (window.navigator.userAgent.indexOf("MSIE")> 0); 
    if (! isIE){   
      HTMLElement.prototype.__defineGetter__("innerText",function () { return(this.textContent); });   
      HTMLElement.prototype.__defineSetter__("innerText",function (txt) { this.textContent = txt; });


	  
    }

//alert(window.navigator.userAgent);
var ventanaactivay=0;
var ventanaactivax=0;
var divselec;
var cantcua=0;
var cant_cua_fila=0;
var fila=0;
var cl;
var pais;
var pag_coment;
var id_perfil;
var respagina;
var escsonido=0;
//var estado_chat='ewrfewtr';
var largo=0,ancho=0;
var nombre_;
var auxchat=0;
var CantidadVentanas=0;
var cantotmsjsinleer=0;
var IndiceUV=1999;
var imagenes = new Array();
var inicio_anuncios=0;
var fotodelmillon=new Image();

fotodelmillon.src="ico/imagesCA9TQR60.jpg";

var fotoPregunta=new Image();

fotoPregunta.src="imagenes/pregunta.jpg";

var fotorecarga=new Image();

fotorecarga.src="imagen/ajax-loader.gif";


var ie5=(document.getElementById && document.all);

var ns6=(document.getElementById && !document.all);



nPlus = 5 ;  
speed = 50 ; 
 

nOpac = 100;





function XMLHttp(){

var Object;

if (typeof XMLHttpRequest == "undefined" )

{

if(navigator.userAgent.indexOf("MSIE 5") >= 0)

{ Object= new ActiveXObject("Microsoft.XMLHTTP");}

else

{ Object=new ActiveXObject("Msxml2.XMLHTTP");}

}

else

{ Object=new XMLHttpRequest();}

return Object;



}






function _Ajax_valida_usuario(pagina)

{

var ajax=XMLHttp();
/*

var al = document.getElementById('usuario').value;
var ab = document.getElementById('clave').value;

*/

//alert(pagina);
ajax.open("GET",pagina,true);

ajax.onreadystatechange=function(){

if(ajax.readyState==4)

{

 if(ajax.status == 200) {



 var respagina=ajax.responseText;

//alert(ajax.responseText);


if (respagina.indexOf('no')==-1)

    {

		///if (respagina.indexOf('1')==0) {  
//alert('a pag--' + '<? echo $_SESSION[id_perfil];?>');

		location.href='administracion.php';
		
//}
		///else{

//			document.getElementById('seguridad').src='imagenes/sitiohabilitado.gif';

			//document.getElementById('usuvalid').innerText=document.login.usuario.value + ' ';

			//document.getElementById('cerses').style.visibility='visible'; 			

			///}



    }else{




        alert('Usuario o contraseña incorrecta');

    }



}else if(ajax.status == 400) {

 popup('Err',1,'Problemas de acceso a datos, BD no activa');



}

delete ajax;

}

else if(ajax.readyState==1)

{




}

else if(ajax.readyState==2)

{


}





}
//alert("usuario=" + al + "&clave=" + ab);
//ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//ajax.send('usuario=' + al + '&clave=' + ab);
ajax.send(null);


}

function _Ajax_valida_nuevo_usuario(pagina)
{ 
var ajax=XMLHttp();




// alert('valida nuevo usuario' + pagina);


ajax.open("GET",pagina,true);

ajax.onreadystatechange=function(){

if(ajax.readyState==4)

{



 if(ajax.status == 200) {

 

 var respagina=ajax.responseText; 


//alert('aaca=' + respagina);



if (respagina.indexOf('no')==-1)

    {
//('aca=' + respagina);

document.getElementById('divMsgnu').style.visibility = 'hidden'; 

document.getElementById('divMsg').style.visibility = 'hidden';  

document.getElementById('divMsgnu').style.display = 'none'; 			

//document.getElementById('usuvalid').innerText=document.nuusuario.usuario.value;

//document.getElementById('seguridad').src='imagenes/sitiohabilitado.gif';

//document.getElementById('cerses').style.visibility='visible'; 

//document.body.style.overflow='scroll'; ocultar('divMsg'); ocultar('divMsgnu');

    }else{


//document.write(pagina.replace('sql','addnuevousuario'));

        //document.getElementById('validar_usuario_capa').innerHTML='ok';

lapagina=pagina.replace('sql','addnuevousuario');
	   _Ajax_varios(lapagina);

    }



}else if(ajax.status == 400) {

 popup('Err',1,'Problemas de acceso a datos, BD no activa');



}

delete ajax;

}

else if(ajax.readyState==1)

{
if (  document.getElementById('validar_usuario_capa'))
  document.getElementById('validar_usuario_capa').innerHTML='<p align=\"center\"><span class=\"Estilo1\"><img src=\"imagenes/ajax-loader2.gif\" width=\"31\" height=\"31\"></span> </p>';



}

else if(ajax.readyState==2)
{
if (  document.getElementById('validar_usuario_capa'))	{document.getElementById('validar_usuario_capa').innerHTML='';

   document.getElementById('validar_usuario_capa').innerHTML='<p align=\"center\"><span class=\"Estilo1\"><img src=\"imagenes/ajax-loader2.gif\" width=\"31\" height=\"31\"></span> </p>';
}


}





}

ajax.send(null);



}





function VisibleDiv(cual,funcion)

{




var obj_=getElementById(cual);

if (! obj_) return false;



if (obj_.style.visibility == 'visible')

{

  obj_.style.visibility = 'hidden';

  obj_.style.display = 'none';

}else{

  obj_.style.visibility = 'visible';

  obj_.style.display = 'block';

}

if (funcion != "undefined") {

	
	
	eval(funcion);}


}






function KeyPress(cod,funcion) 



{ if (window.event.keyCode == cod) 



 

if (funcion != "undefined") {	eval(funcion);}



} 




function Ajaxquery(pagina,funcion)

{



var ajax=XMLHttp();


ajax.open("GET",pagina,true);


ajax.onreadystatechange=function(){

if(ajax.readyState==1)

{




}else if(ajax.readyState==4)

{



if(ajax.status == 200) {



 var xml=ajax.responseXML.documentElement;

 

 if (xml==null){

      popup('Err',1,'Problemas de acceso a datos, usuario o contraseña incorrecta');



 }



var resp=xml.getElementsByTagName("Respuesta")[0].childNodes[0].nodeValue;


if ( resp.toString().indexOf('OK') ==-1)

{


popup('Err',1,resp);



return false;



}else if ( resp.toString().indexOf('NOOK') !=-1)

{



popup('Err',1,'No se pudo ejecutar el proceso');



return false;



}else if ( resp.toString().indexOf('OK') !=-1)

 { 



	if (funcion != "undefined") {

	
	eval(funcion);}


	   popup('Err',1,'Operacion OK');

	   return 1;

      }

     else

  {

      
   if ( resp.toString().indexOf('NKO') !=-1)

   { 


   popup('Err',1,'Problemas de acceso a datos, BD no activa');

   }

   else

       {   if ( resp.toString().indexOf('KNOPERACION') !=-1)

           { 
       popup('Exc',1,'Se ejecuto el proceso');



           }

       }



   }











}else {  popup('Err',1,'Problemas de acceso a datos');    }



}

}

ajax.send(null);



}





function _Ajax_varios(pagina,path_,funcion)

{

//if (!document.getElementById(path_)) return false;

var ajax=XMLHttp();
//alert('varios ' + pagina);
ajax.open("POST",pagina,true);

ajax.onreadystatechange=function(){


 
if(ajax.readyState==4)
{
//
 if(ajax.status == 200) {

 respagina=ajax.responseText;
// alert('sdsd=' + ajax.responseText);


if (typeof path_ != "undefined")
{
var DIV=document.getElementById(path_);
if (DIV.style.visibility=='hidden')
{
DIV.style.visibility = 'visible';

DIV.style.display = 'block';

}


//alert('aca?');

SetContainerHTML(path_,respagina,true);

if (typeof funcion != "undefined")
{
//alert('aki?');
	eval(funcion);
}


}else{

 if (respagina.length>0) 	eval(respagina);

 

	}

	

if (document.getElementById('buscandoo')) document.getElementById('buscandoo').src="imagenes/ico/punto_gris.png";

delete ajax;



}}

else{
if (document.getElementById('buscandoo')) document.getElementById('buscandoo').src="imagenes/ico/ajax-loader.gif";

}

}

ajax.send(null);



}





function _Ajax_valor(pagina)

{

//alert(pagina);


var ajax=XMLHttp();

ajax.open("GET",pagina,true);




ajax.onreadystatechange=function(){

if(ajax.readyState==4)

{



 if(ajax.status == 200) {

//alert('aca>' + ajax.responseText);

 if(ajax.responseText=='0')

 {
//alert('aca2' + ajax.responseText);

radio=getSelectedButton(document.nuusuario.radio);

//alert(obj.empresa.options[obj.empresa.selectedIndex].value);
//var dia=document.nuusuario.dia.options[document.nuusuario.dia.selectedIndex].value;
var dia=document.getElementById('dia').options[document.getElementById('dia').selectedIndex].value;
var mes=document.getElementById('mes').options[document.getElementById('mes').selectedIndex].value;
var ano=document.getElementById('ano').options[document.getElementById('ano').selectedIndex].value;
var edad=ano+'-'+mes+'-'+dia


 if (document.getElementById('Chico1').checked==true  &&  document.getElementById('Chica2').checked==true || document.getElementById('Chico1').checked==false  &&  document.getElementById('Chica2').checked==false)
	{definicion='0,1';}
else
	{
		if 	(document.getElementById('Chico1').checked==true) definicion='0';
		 else definicion='1';
	}
	/*
	alert(document.nuusuario.correo.value.replace(/^\s*|\s*$/g,"")=='');
alert(edad + ' = ' + edad.indexOf('_'));
alert(document.nuusuario.ciudad.lugar.replace(/^\s*|\s*$/g,""));
alert('radio=' + radio);
//|| document.nuusuario.ciudad.lugar.replace(/^\s*|\s*$/g,"")==''*/




	if (edad.indexOf('_')>0 || document.nuusuario.correo.value.split(' ').length > 1 || document.nuusuario.correo.value.indexOf('@')==-1 || document.nuusuario.correo.value.indexOf('@') != document.nuusuario.correo.value.lastIndexOf('@') || document.nuusuario.usuario.value.replace(/^\s*|\s*$/g,"")=='' || radio=='' || document.nuusuario.ciudad.lugar.replace(/^\s*|\s*$/g,"")=='' ) {
		document.getElementById('errornuevacuenta').style.visibility='visible';
		//alert('aca>' + ajax.responseText);

		return false;
	}
	
//	trim || document.nuusuario.usuario.value.replace(/^\s*|\s*$/g,"")==''
//

//alert('sali>' + ajax.responseText);
alert(document.nuusuario.ciudad.lugar);
 _Ajax_valida_nuevo_usuario('sql.php?usuario=' + document.nuusuario.usuario.value + '&nombre=' + document.nuusuario.usuario.value + '&correo=' + document.nuusuario.correo.value + '&sexo=' + radio + '&con=' + definicion + '&edad=' + edad + '&lugar=' + document.nuusuario.ciudad.lugar);

 }else{

	 alert('Esta cuenta de correo ya existe');
	 
	 }



// respagina=ajax.responseXML.documentElement;;


}}

else{

}

}



ajax.send(null);





}



function colorfoto(obj,cual,colores)

{

if (cual==0) obj.style.borderColor='#3366FF';

else

if (typeof colores!='undefined' ) obj.style.borderColor='#' + colores;

else obj.style.borderColor='#FFFFFF';



}





function cambiafotox(obj,cual){

	var cual_=document.getElementById(cual); 

	cual_.src=obj.src;

	document.getElementById('id_a_comprar').innerHTML=obj.id_archivo;

	

	}





function ocultar(obj)

{



	var div=document.getElementById(obj);

//alert(div.style.visibility);

   if (div.style.visibility=='visible')

{ div.style.visibility = 'hidden';

    div.style.display = 'none';



}

}







function mostrar(obj,x,y)

{


	var div=document.getElementById(obj);



if (div.style.visibility=='hidden')

{

div.style.visibility = 'visible';

div.style.display = 'block';



if (typeof x!='undefined') 

{

	div.style.left=x +'px';

	div.style.top=y +'px';

	}

} else

{



    div.style.visibility = 'hidden';

    div.style.display = 'none';

}



}





function ponervalor(obj){



var a=obj.parentNode.getElementsByTagName('Label')[6].firstChild.nodeValue;

var b=obj.parentNode.getElementsByTagName('Label')[7].firstChild.nodeValue;

var c=obj.parentNode.getElementsByTagName('Label')[8].firstChild.nodeValue;

var d=obj.parentNode.getElementsByTagName('Label')[9].firstChild.nodeValue;

var e=obj.parentNode.getElementsByTagName('Label')[10].firstChild.nodeValue;

var f=obj.parentNode.getElementsByTagName('Label')[11].firstChild.nodeValue;







document.getElementById('modelo').value=a.substring(2,a.length);

document.getElementById('descripcion').value=b.substring(2,b.length);

document.getElementById('empaque').value=c.substring(2,c.length);

document.getElementById('talla').value=d.substring(2,d.length);

document.getElementById('color').value=e.substring(2,e.length);

document.getElementById('precio').value=f.substring(2,f.length);





	

	}



	



function vaciaform(formulario){

for (i=0;i<formulario.length;i++) {

var temp=formulario.elements[i];

if ((temp.type=="text"||temp.type=="textarea")) {

temp.value='';

}

}

	

	}

function limpia_texto(formulario){

vaciaform(formulario);

formulario.precio.value=0;

//cambiafoto(fotoPregunta,'fotoadd');

}






function menusel(obj,sw,color,opa){

	//alert(obj.actual);

	
	  if (!obj) 
  {
  return false;
  }
  obj.className='cursor_mano';
  
 if (typeof color != "undefined") 	obj.style.color='#' + color;

    if (typeof opa == 'undefined') 
	{
		opa=100;
	}
	obj.id='temp';
 fadeinout(obj.id,opa);
	obj.id='';

   
if (!obj.actual)
{
	if (sw==0) 	obj.style.backgroundColor='#FFFF97';
	else 	if (sw==1) 	obj.style.backgroundColor='';
		else  	obj.style.backgroundColor='#' + color;
	
	 
}
//alert(opa);
	}




function pantalla(cual) {


	var myWidth = 0, myHeight = 0;

	if( typeof( window.innerWidth ) == 'number' ) {

		myWidth = window.innerWidth; myHeight = window.innerHeight;

	} else if( document.documentElement && ( document.documentElement.clientWidth ||document.documentElement.clientHeight ) ) {

		myWidth = document.documentElement.clientWidth; myHeight = document.documentElement.clientHeight;

	} else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {

		myWidth = document.body.clientWidth; myHeight = document.body.clientHeight;

	}

	
        if (cual=='x')

             return  myWidth;

         else

             return  myHeight; //screen.height;





}

function centrar(cual)

{

// var obja = document.getElementById('todo');

    
/*switch(navigator.appName)
{
  case 'Microsoft Internet Explorer':
    var myregex = /MSIE 7\.0/i;
    var myArray = navigator.appVersion.match(myregex);
    if(myArray.length > 0) 
	*/
	//scrollY = document.documentElement.scrollTop;
	//scrollY = document.body.scrollTop;
 /*   else 
  break;
  default:
 }*/ 



obje= document.getElementById(cual);

obje.style.left =  (parseInt(pantalla('x')/2)  - (ancho /2 )) +  'px'; 

//alert(screen.height +  ' = ' + screen.height/2 +  ' - ' + largo + ' = ' + parseInt(largo)/2 +  ' = ' + ((screen.height/2)  - (parseInt(largo)/2 )));  
obje.style.top=(parseInt(pantalla('y')/2)   - (largo /2 )) +  'px';
//alert( obje.style.top);

//var divmsg = document.getElementById('divMsg');


/*
if (cual=='cen')
{

obj.style.left =  ( ('x') / 2) - (parseInt(obj.style.width) /2 ) + 50 +'px' ;
}else{
obj.style.left =  (pantalla('x') / 2) - (parseInt(obj.style.width) /2 ) + 'px' ;


}
if (cual.indexOf('divMsgnu')==0  )
{
	//alert('kdkdk');
 obj.style.top=(pantalla('y')/2) + 'px'; //  - (parseInt(obj.style.height) /2 ) + 'px' ;

}
 else
 if (cual.indexOf('centrado')==-1 && cual.indexOf('div_master')==-1)
 {
	 

	// obj.style.top=(pantalla('y')/2) - (parseInt(obj.style.height) /2 ) + 'px' ;
	 
 }
*/

//alert(obj.style.top + ',' + pantalla('y'));



}



mover=0;

function mueve(ancho,cual){

if (!document.getElementById(cual)) return false;

var DIVpromo=document.getElementById(cual); 

mover=mover - parseInt(ancho);




if ((parseInt(DIVpromo.style.left) +   parseInt(DIVpromo.style.width) - parseInt(ancho) -100)<=0)  mover=0;



DIVpromo.style.left= mover + 'px';





}



var cant=0;
/*
function pone(id,alto,ancho,cual,id_perfil,msj,param){

var DIVpromo=document.getElementById(cual); 
DIVpromo.style.left='0px';
//alert(DIVpromo.style.width);
var fotonueva=new Image();
//alert(msj);
fotonueva.src=id;
//fotonueva.src="ver.php?id=" + id;
//alert(fotonueva.src);
//id='roundCorner.php?img=' + fotonueva.src +  '&amp;r=10';
//alert(id + ' -- ' + id_perfil );

if (typeof param == "undefined") 
{DIVpromo.innerHTML=DIVpromo.innerHTML + "<img onclick=\"vaciarObj('main_container');  _Ajax_varios('perfiles/" + id_perfil + "','main_container');\" onMouseOut=\"zoomout(this,50,90);colorfoto(this,1);\" onMouseOver=\"zoomin(this,50,90,'" + msj + "');colorfoto(this,0); \"  style=\"background-color: #FFFFFF; cursor:hand; vertical-align: middle;\" class=\"formulario cursor_mano\"  height=\"" + alto  + "\" width=\"" + ancho + "\" src=\"" + fotonueva.src + "\">";
}else
{
cant=cant+1;
DIVpromo.style.width= (cant*parseInt(ancho) +140 ) + 'px';

//alert(id.replace('mini/','').substring(id.indexOf("/")+1, id.lastIndexOf("/")-5));	
DIVpromo.innerHTML=DIVpromo.innerHTML + "<img id=\"" + param + "\" class=\"cursor_mano\" onclick=\"document.getElementById('id_foco_atencion').innerText=this.id;  \"  style=\"background-color: #FFFFFF;  vertical-align: middle;border-color:#FFFFFF;\" class=\"formulario\" border=\"" + 5  + "\" height=\"" + alto  + "\" width=\"" + ancho + "\" src=\"" + fotonueva.src + "\">";
}


	}
*/


function pone(id,alto,ancho,cual,id_perfil,msj,pais){

var DIVpromo=document.getElementById(cual); 
DIVpromo.style.left='0px';
//alert(DIVpromo.style.width);
//var fotonueva=new Image();
//alert(msj);
//fotonueva.src=id;
//fotonueva.src="ver.php?id=" + id;
//alert(id);
//id='roundCorner.php?img=' + fotonueva.src +  '&amp;r=10';
//alert(id + ' -- ' + id_perfil );
var Digital = new Date(); //Math.ceil(Math.random()*10000) 

var hours=Digital.getHours()
 var minutes=Digital.getMinutes()
 var seconds=Digital.getSeconds()
 
 var aleatorio =hours + ' ' +  minutes + ' ' + seconds;
 
//if (typeof param == "undefined" || param == 'indice') {
 
  //if (param != 'indice')   
	DIVpromo.innerHTML=DIVpromo.innerHTML + "<img onclick=\" vaciarObj('principalx'); document.documentElement.style.overflow = 'hidden';document.getElementById('visitaperfil').style.visibility='visible'; _Ajax_varios('" + pais + "/perfiles/" + id_perfil + "','principalxx');\" onMouseOut=\"zoomout(this,50,90);colorfoto(this,1);\" onMouseOver=\"zoomin(this,50,90,'" + msj + "');colorfoto(this,0); \"   class=\"formulario cursor_mano fotito\"  height=\"" + alto  + "\" width=\"" + ancho + "\" src=\"laima.php?imagen=" + id  +"\">";
/*else
{
	DIVpromo.innerHTML=DIVpromo.innerHTML + "<img  onMouseOut=\"zoomout(this,50,90);colorfoto(this,1);\" onMouseOver=\"zoomin(this,50,90,'" + msj + "');colorfoto(this,0); \"  class=\"formulario cursor_mano fotito\"  height=\"" + alto  + "\" width=\"" + ancho + "\" src=\"" + idc + "\">";

//	DIVpromo.style.backgroundImage='url(/imagenes/ico/papel.png)';
}*/

//}
/*else
{
cant=cant+1;
DIVpromo.style.width= (cant*parseInt(ancho) +140 ) + 'px';

//alert(id.replace('mini/','').substring(id.indexOf("/")+1, id.lastIndexOf("/")-5));	
DIVpromo.innerHTML=DIVpromo.innerHTML + "<img id=\"" + param + "\" class=\"cursor_mano\" onclick=\"document.getElementById('id_foco_atencion').innerText=this.id;  \"  style=\"background-color: #FFFFFF;  vertical-align: middle;border-color:#FFFFFF;\" class=\"formulario\" border=\"" + 5  + "\" height=\"" + alto  + "\" width=\"" + ancho + "\" src=\"" + id + "\">";
}
*/

	}


function ponefoco(id,alto,ancho,cual,id_perfil,id_archivo){

var DIVpromo=document.getElementById(cual); 
DIVpromo.style.left='0px';
//alert(DIVpromo.style.width);
//var fotonueva=new Image();
//alert(id_archivo);
//fotonueva.src=id;
//fotonueva.src="ver.php?id=" + id;
//alert(id);
//id='roundCorner.php?img=' + fotonueva.src +  '&amp;r=10';
//alert(id + ' -- ' + id_perfil );
var Digital = new Date(); //Math.ceil(Math.random()*10000) 

var hours=Digital.getHours()
 var minutes=Digital.getMinutes()
 var seconds=Digital.getSeconds()
 
 var aleatorio =hours + ' ' +  minutes + ' ' + seconds;
 
//if (typeof param == "undefined" || param == 'indice') {
 
  //if (param != 'indice')   
	//DIVpromo.innerHTML=DIVpromo.innerHTML + "<img onclick=\" vaciarObj('principalx'); document.documentElement.style.overflow = 'hidden';document.getElementById('visitaperfil').style.visibility='visible'; _Ajax_varios('" + pais + "/perfiles/" + id_perfil + "','principalxx');\" onMouseOut=\"zoomout(this,50,90);colorfoto(this,1);\" onMouseOver=\"zoomin(this,50,90,'" + msj + "');colorfoto(this,0); \"   class=\"formulario cursor_mano fotito\"  height=\"" + alto  + "\" width=\"" + ancho + "\" src=\"laima.php?imagen=" + id  +"\">";
/*else
{
	
//	DIVpromo.style.backgroundImage='url(/imagenes/ico/papel.png)';
}*/

//}
/*else
{
cant=cant+1;
DIVpromo.style.width= (cant*parseInt(ancho) +140 ) + 'px';

//alert(id.replace('mini/','').substring(id.indexOf("/")+1, id.lastIndexOf("/")-5));	
}
*/
DIVpromo.innerHTML=DIVpromo.innerHTML + "<img id=\"" + id_archivo + "\" class=\"cursor_mano\" onclick=\"document.getElementById('id_foco_atencion').innerText=this.id;  \"  style=\"background-color: #FFFFFF;  vertical-align: middle;border-color:#FFFFFF;\" class=\"formulario\" border=\"" + 5  + "\" height=\"" + alto  + "\" width=\"" + ancho + "\" src=\"" + id + "\">";

	}





function SetContainerHTMLinit(id,html,processScripts){

mydiv = id; 
if (! mydiv)  return false;

mydiv.innerHTML = html;

if(processScripts!=false){

var elementos = mydiv.getElementsByTagName('script');

for(i=0;i<elementos.length;i++) {

var elemento = elementos[ i ];

nuevoScript = document.createElement('script');

nuevoScript.text = elemento.innerHTML; 

nuevoScript.type = 'text/javascript';

if(elemento.src!=null && elemento.src.length>0)

nuevoScript.src = elemento.src;

elemento.parentNode.replaceChild(nuevoScript,elemento);

}

var elementos_style = mydiv.getElementsByTagName('style');



for(i=0;i<elementos_style.length;i++) {

var elemento_style = elementos_style[ i ];

nuevostyle = document.createElement('style');

nuevostyle.text = elemento_style.innerHTML;

nuevostyle.type = 'text/css';

if(elemento_style.src!=null && elemento_style.src.length>0)

nuevostyle.src = elemento_style.src;

elemento_style.parentNode.parentNode.appendChild(nuevostyle);

}

}

}





function SetContainerHTML(id,html,processScripts){

mydiv = document.getElementById(id);

if (! mydiv)  return false;

mydiv.innerHTML = html;

if(processScripts!=false){

var elementos = mydiv.getElementsByTagName('script');

for(i=0;i<elementos.length;i++) {

var elemento = elementos[ i ];

nuevoScript = document.createElement('script');

nuevoScript.text = elemento.innerHTML; 

nuevoScript.type = 'text/javascript';

if(elemento.src!=null && elemento.src.length>0)

nuevoScript.src = elemento.src;

elemento.parentNode.replaceChild(nuevoScript,elemento);

}

var elementos_style = mydiv.getElementsByTagName('style');



for(i=0;i<elementos_style.length;i++) {

var elemento_style = elementos_style[ i ];

nuevostyle = document.createElement('style');

nuevostyle.text = elemento_style.innerHTML;

nuevostyle.type = 'text/css';

if(elemento_style.src!=null && elemento_style.src.length>0)

nuevostyle.src = elemento_style.src;

elemento_style.parentNode.parentNode.appendChild(nuevostyle);

}

}

}



function piepagina(valor){

var objcent=document.getElementById('centrado');

var objpromo=document.getElementById('contPromo');

var objmenudown=document.getElementById('menudown');

var bal=-45;
objcent.style.height=(valor + 70) + 'px';

objpromo.style.top=(parseInt(objcent.style.height) - parseInt(objpromo.style.height) - 80  + bal) + 'px';

objmenudown.style.top=(parseInt(objpromo.style.top) + 100 ) + 'px';
//alert(objmenudown.style.top);

}



function crearUsuario(){

//	alert(document.nuusuario.correo.value);

_Ajax_valor('sql.php?validacorreo=' + document.nuusuario.correo.value);

/*

for(asumar=1640;asumar<200005;asumar++) {


_Ajax_varios('http://localhost/enamorame/addnuevousuario.php?usuario=lamasrica' + asumar + '&clave=prueba&nombre=lamasrica' + asumar + '&correo=muirica' + asumar + '@gmail.com&sexo=1&con=0&edad=1982-01-1&lugar=1');

}*/

	}

	

function solonumeros(obj,valor)

	{
		if (typeof valor == "undefined") minimo=0;

		

		

		if(!/^[0-9]+$/.test(obj.value)) { 

		alert('Solo se aceptan numeros'); 

		obj.value=valor;}

		}

		

		

	

function valida_clave(){

	

//	 alert (document.getElementById('c1').value + ' _ ' + document.getElementById('c2').value);

	 
crearUsuario();

	



}


function cargadatos(tipo,obj){


var cons=tipo +'=si&precio=' + obj.precio.value + '&';

cons=cons + 'descripcion=' + obj.descripcion.value + '&';

cons=cons + 'talla=' + obj.talla.value + '&';

cons=cons + 'modelo=' + obj.modelo.value + '&';

cons=cons + 'empaque=' + obj.empaque.value + '&';

cons=cons + 'color=' + obj.color.value + '&';

cons=cons + 'id_categoria=' + document.forms[1].document.getElementById('cat').value + '&';

cons=cons + 'id_archivo=' + document.getElementById('id_a_comprar').innerHTML;

_Ajax_varios('sql.php?' + cons);



}

function cargadatosClientes(cual){

/*
and c.id_region=17
and c.id_comuna=1
and id_categoria=1*/
var obj=document.getElementById('busquedaclientes');
var cons='';

//alert(obj.empresa.options[obj.empresa.selectedIndex].value);

  if  (obj.empresa.options[obj.empresa.selectedIndex].text!='Todas') cons='&empresa=' + obj.empresa.options[obj.empresa.selectedIndex].value ;
 else {
 if  (obj.region.options[obj.region.selectedIndex].text!='Todas') cons= cons + '&region=' + obj.region.options[obj.region.selectedIndex].value ;
// if  (obj.ciudad.options[obj.ciudad.selectedIndex].text!='Todas') cons= cons + '&ciudad=' + obj.ciudad.options[obj.ciudad.selectedIndex].value;
 if  (obj.comuna.options[obj.comuna.selectedIndex].text!='Todas') cons= cons + '&comuna=' + obj.comuna.options[obj.comuna.selectedIndex].value ;
if  (obj.categoria.options[obj.categoria.selectedIndex].text!='Todas') cons= cons + '&categoria=' + obj.categoria.options[obj.categoria.selectedIndex].value;
 }
// alert(cons);
return cons;
}



varaaddcat=0;

function addcat(texto,valor){

var Opcat=document.getElementById('cat'); 

variable=new Option(texto,valor);

Opcat.options[varaaddcat]=variable;

varaaddcat+=1;





}

function delcat(valor){

var Opcat=document.getElementById('cat'); 

var i;

for(i=Opcat.options.length-1;i>=0;i--)

{

if(Opcat.options[i].selected)

{

Opcat.remove(i);

varaaddcat=Opcat.options.length;

break;

}

}

}





function limpia(){
	
var elementos = document.body.getElementsByTagName('script');

for(i=0;i<elementos.length;i++) {
var elemento = elementos[ i ];
nuevoScript = document.createElement('script');
nuevoScript.text = ''; 
nuevoScript.type = 'text/javascript';
if(elemento.src!=null && elemento.src.length>0)
nuevoScript.src = elemento.src;
elemento.parentNode.replaceChild(nuevoScript,elemento);

}

	}



    var map;
    var geocoder;

    function initialize() {
      map = new GMap2(document.getElementById("map_canvas"));
    //  map.setCenter(new GLatLng(40.452557, -3.510673), 15);
      
      // insertar los controles
      map.addControl(new GSmallMapControl());
      map.addControl(new GMapTypeControl());
      
      geocoder = new GClientGeocoder();
    }

    // addAddressToMap() is called when the geocoder returns an
    // answer.  It adds a marker to the map with an open info window
    // showing the nicely formatted version of the address and the country code.
    function addAddressToMap(response) {
      map.clearOverlays();
      if (!response || response.Status.code != 200) {
        alert("Lo sentimos, no se ha encontrado su direcci&ocute;n");
      } else {
        place = response.Placemark[0];
        point = new GLatLng(place.Point.coordinates[1], place.Point.coordinates[0]);
        
        map.setCenter(point, 15);
        
        marker = new GMarker(point, {draggable: true});
        
        GEvent.addListener(marker, "dragstart", function() {
          map.closeInfoWindow();
        });

        GEvent.addListener(marker, "dragend", function() {
         // document.getElementById("punto").value = marker.getLatLng().toUrlValue();
          marker.openInfoWindowHtml(place.address);
        //  generateKML(place.address, marker.getLatLng().lng(), marker.getLatLng().lat());
        });
        
        map.addOverlay(marker);
        marker.openInfoWindowHtml(place.address);
      //  document.getElementById("punto").value = marker.getLatLng().toUrlValue();
        
      //  generateKML(place.address, place.Point.coordinates[0], place.Point.coordinates[1]);
        
      }
    }
    
    // showLocation() is called when you click on the Search button
    // in the form.  It geocodes the address entered into the form
    // and adds a marker to the map at that location.
    function showLocation() {

      var address =  document.busmap.q.value;
      geocoder.getLocations(address, addAddressToMap);
    }

   // findLocation() is used to enter the sample addresses into the form.
    function findLocation(direccion, empresa ) {
      document.forms[0].q.value = direccion;
      document.getElementById("empresa").value = empresa;
      showLocation();
    }
    


var posicionpromoleft=0;
var posicionpromotop=10;
var sw=0;

function Crea_Div_perfiles(padre,id,nombre, otros,pospag){

var losotros=otros.split(',');
//alert('links ?' + id);
if (sw==10) {
//	alert('aki');
	vaciarObj('mostrarclientes'); sw=1;}

var obj=document.getElementById(padre);
var objs=obj.getElementsByTagName('div');
//alert(objs.length);

  contenedor0 = document.createElement('div'); // 1
  contenedor0.style.position='absolute';
  contenedor0.style.width= '429px';
  contenedor0.style.height= '100px';
  
  contenedor0.style.left= (10 + posicionpromoleft) + 'px';
  contenedor0.style.visibility = 'visible';
  contenedor0.style.display = 'block';
  contenedor0.style.border='1px';
  contenedor0.style.borderColor='#EAEAEA';
  contenedor0.style.borderStyle='solid';
  contenedor0.style.cursor='hand';
  contenedor0.style.color='#000000';
 // contenedor0.className='formulario_smal';

//---------

  contenedor1 = document.createElement('div'); // 1
  contenedor1.id = id + 'mx' ;
  contenedor1.name = id;
  

  //contenedor.estado = 'activo';
  contenedor1.style.position='absolute';
  contenedor1.style.width= '90px';
  contenedor1.style.height= '90px';
  
  contenedor1.style.left= (14 + posicionpromoleft) + 'px';
  //alert(objs.length);
  if (objs.length>3) {
   contenedor1.style.top= posicionpromotop + 'px';
   contenedor0.style.top= (posicionpromotop - 2) + 'px';
  // alert(   contenedor.style.top);
  }else{
  contenedor1.style.top= 10 + 'px';
  contenedor0.style.top= 9 + 'px';
//  alert('as');
  }
//  alert(obj.style.height);
  if ((parseInt(contenedor1.style.top)+110)>505) {obj.style.height='515px'} else {  obj.style.height= (parseInt(contenedor1.style.top)+110) + 'px';}
  
  //alert(obj.style.height);
 //contenedor1.style.left= '0px';
  //contenedor1.style.border='1px';
  //contenedor1.style.borderStyle='solid';
  //contenedor1.style.color='#000000';
  contenedor1.style.visibility = 'visible';
  contenedor1.style.display = 'block';
  contenedor1.style.cursor='hand';
  contenedor1.innerHTML="<img  onMouseOver=\"javascript:this.style.cursor='hand';\" onClick=\"javascript:location.href='catalogo4.php?id_perfil=" + id + "&pospag=" + pospag + "' + cargadatosClientes()\"  src=\"verimcli.php?id=" + id + "\" style=\" width:100%; height:100%;   border: 3px solid #ffffff; \">"
  
  contenedor2 = document.createElement('div'); // 2
  contenedor2.id = id + '_detalle';
  contenedor2.name = id + '_detalle';
  //contenedor.estado = 'activo';
  //alert(detalle);
  contenedor2.style.position='absolute';
  contenedor2.style.width= '300px';
  contenedor2.style.height= '101px';
  //alert(objs.length);
  if (objs.length>3) {
   contenedor2.style.top= posicionpromotop + 'px';
  // alert(   contenedor.style.top);
  }else{
  contenedor2.style.top=  '10px';
//  alert('as');
  }
  contenedor2.style.left= (posicionpromoleft + 123) +'px';
 /* contenedor2.style.border='1px';
  contenedor2.style.borderStyle='solid';
  contenedor2.style.color='#000000';
 */ contenedor2.style.cursor='hand';
  contenedor2.style.visibility = 'visible';
  contenedor2.style.display = 'block';
  contenedor2.innerHTML="<label style=\"position:absolute; left: 10px; top: 7px; width: 256px;\" id=\"calle\">" + losotros[3] + 
  ' ' + losotros[4] + ' of: ' +   losotros[5] +   "</label>" +
  "<a  style=\"position:absolute; left: 10px; top: 25px; width: auto;\"  id=\"categorias\" href=\"\" target=\"_blank\" >...</a> " +
  "<label style=\"position:absolute; left: 10px; top: 43px; width: auto;\" id=\"telefono\">" + losotros[2] + "</label>" +
  "<a  style=\"position:absolute; left: 10px; top: 58px; width: auto;\"  id=\"pagweblink\" href=\"http://" + losotros[1] + "\" target=\"_blank\" >" + losotros[1] + "</a>" + 
  "<a  style=\"position:absolute; left: 10px; top: 74px; width: auto;\"  id=\"mail\" href=\"mailto:" + losotros[0] + "\" target=\"_blank\" >" + losotros[0] + "</a> "; 
  
  //nombre;
//  contenedor.style.overflow="hidden";
  //obj.appendChild(barra);
  obj.appendChild(contenedor0);
  
  obj.appendChild(contenedor1);
  //obj.appendChild(barra);
  obj.appendChild(contenedor2);
 
  if (posicionpromoleft>0)
  {
	  posicionpromoleft=0;
	  posicionpromotop=(parseInt(objs[objs.length-1].style.top) + parseInt(objs[objs.length-1].style.height) );
//alert(posicionpromotop);
	  
  }else{
  posicionpromotop=parseInt(objs[objs.length-1 ].style.top );
//  alert(posicionpromotop);
  posicionpromoleft=430;
  }
  
 }
 
 
 
 
 
 

function vaciarObj(obj_)
{
/*	//alert('aki');
var	obj=document.getElementById(obj_);

if (obj){
	while (obj.hasChildNodes()) {
		obj.removeChild(obj.firstChild);
	}
//	document.removeChild(obj);
	}
	*/
		}
		
function vaciardiv(obj_)
{
	//alert('aki');
var	obj=document.getElementById(obj_);

if (obj){
	while (obj.hasChildNodes()) {
		obj.removeChild(obj.firstChild);
	}
//	document.removeChild(obj);
	}

		}
		

function busca_contactos(){

document.getElementById('bc').style.visibility='visible';
//document.getElementById('bc').style.display='solid';

document.getElementById('traemails').src='openInviter/example.php?email_box=' +  
document.buscar_contactos.usuario.value + 
'&password_box=' + 
document.buscar_contactos.clave.value + '&cual2=Gmail&cual=gmail&hola=ss';
}


function show5(){
if (!document.layers&&!document.all&&!document.getElementById)
return

 var Digital=new Date()
 var hours=Digital.getHours()
 var minutes=Digital.getMinutes()
 var seconds=Digital.getSeconds()

var dn="PM"
if (hours<12)
dn="AM"
if (hours>12)
hours=hours-12
if (hours==0)
hours=12

 if (minutes<=9)
 minutes="0"+minutes
 if (seconds<=9)
 seconds="0"+seconds
//change font size here to your desire
myclock="<font size='2' face='Arial' >"+hours+":"+minutes+":"
 +seconds+" "+dn+"</b></font>"
if (document.layers){
document.layers.liveclock.document.write(myclock)
document.layers.liveclock.document.close()
}
else if (document.all)
liveclock.innerHTML=myclock
else if (document.getElementById)
document.getElementById("liveclock").innerHTML=myclock
setTimeout("show5()",1000)
 }


function cambiaFondo(num)
{

document.body.style.backgroundImage='url(fondos/' + num + '.JPG)';
_Ajax_varios('sqlfondo.php?fondo=' + num);
}

varaaddcat=0;

function addvalor(tipo,texto,valor){

var Opcat=document.getElementById(tipo); 

//alert(Opcat.id);



variable=new Option(texto,valor);

Opcat.options[varaaddcat]=variable;

varaaddcat+=1;





}



function fadeinout(cual,opa) {

//alert('aki');
  obj = document.getElementById(cual);
  if (!obj) 
  {
  return false;
  }
  
  if (document.all)
  {

   obj.style.filter = 'alpha(opacity='+opa+')';
}
  else
{

//alert('akia');
	
	if ('MozOpacity' in obj.style) {
		    obj.style.MozOpacity = opa/100; 

			} else {
							//alert(opaco);
		    obj.style.KhtmlOpacity =(opa/100); 
			}

	
}


}


function seleccionarOption(cual,valor){

var Opcat=document.getElementById(cual); 


var i;

for(i=Opcat.options.length-1;i>=0;i--)

{

//obj.empresa.options[obj.empresa.selectedIndex].text!

if(Opcat.options[i].value==valor)
{

Opcat.selectedIndex=i;

break;

}


}


}


function enviarFormulario(url, formid){
   var ajax=XMLHttp();
   
   var Formulario = document.getElementById(formid);
         var longitudFormulario = Formulario.elements.length;
         var cadenaFormulario = ""
         var sepCampos
         sepCampos = ""
         for (var i=0; i <= Formulario.elements.length-1;i++) {
         cadenaFormulario += sepCampos+Formulario.elements[i].name+'='+encodeURI(Formulario.elements[i].value);
         sepCampos="&";
}
alert(url + ' --- ' + cadenaFormulario);
  ajax.open("POST", url, true);
  ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
  ajax.onreadystatechange = function () {
  if (ajax.readyState == 4) {
    // document.getElementById(Ficha).innerHTML = "Los datos han sido enviados correctamente";
}
}
ajax.send(cadenaFormulario);
}

function graba(cual, ficha,id_archivo,id_caracteristicas){
	
	if (ficha==4) 
  		_Ajax_varios('sql.php?id_archivo=' + id_archivo + '&id_caracteristicas=' + id_caracteristicas + '&tipo=0&ficha=' + ficha + '&valor=valor=' + cual.value );
	else
		_Ajax_varios('sql.php?tipo=0&ficha=' + ficha + '&valor=' + cual.name + '=' + cual.value );
	
	}


function replaceAll( texto ){
	//alert(text.toLowerCase().indexOf(busca));
	//toString
    var text=UTF8.encode(texto)
	text = text.replace(/ñ/gi, 'n');
	text = text.replace(/á/gi, 'a');
	text = text.replace(/é/gi, 'e');
	text = text.replace(/´í/gi, 'i');
	text = text.replace(/ó/gi, 'o');
	text = text.replace(/ú/gi, 'u');
	
/*	text = text.toString().replace('á','a'); 	
	text = text.toString().replace('é','e'); 	
	text = text.toString().replace('í','i'); 	
	text = text.toString().replace('ó','o'); 		
	text = text.toString().replace('ú','u'); 		
	*/
	
	
	return text;
	
	}

UTF8 = {
    encode: function(s){
        for(var c, i = -1, l = (s = s.split("")).length, o = String.fromCharCode; ++i < l;
            s[i] = (c = s[i].charCodeAt(0)) >= 127 ? o(0xc0 | (c >>> 6)) + o(0x80 | (c & 0x3f)) : s[i]
        );
        return s.join("");
    },
    decode: function(s){
        for(var a, b, i = -1, l = (s = s.split("")).length, o = String.fromCharCode, c = "charCodeAt"; ++i < l;
            ((a = s[i][c](0)) & 0x80) &&
            (s[i] = (a & 0xfc) == 0xc0 && ((b = s[i + 1][c](0)) & 0xc0) == 0x80 ?
            o(((a & 0x03) << 6) + (b & 0x3f)) : o(128), s[++i] = "")
        );
        return s.join("");
    }
};
 



////////////////////////////time

var timerID;
var timerRunning = false;
var today = new Date();
var count = new Date();
var secPerDay = 0;
var minPerDay = 0;
var hourPerDay = 0;
var secsLeft = 0;
var secsRound = 0;
var secsRemain = 0;
var minLeft = 0;
var minRound = 0;
var dayRemain = 0;
var minRemain = 0;
var Expire = 0;
var timeRemain = 0;
var timeRemain2 = 0;
var timeUp = "Type Anything You Want"    // enter text to be displayed when countdown is finished
var time = "0 días, 0 horas, 0 minutos, 0 segundos" //do not modify this text
var fechapromo1 = 'aug 30, 2011';
var fecha_ofertas = 'may 25, 2011';
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}

function startclock () {
stopclock();
showtime();
}


function showtime (fechaex,cual) {
today = new Date();
//alert(fechaex);
//unmark either of the two following lines

count = new Date(fechaex);   // enter date to count down to (use the same format)
//count = new Date(document.clock.indate.value);   //let the user enter the date to count down to in the input box


secsPerDay = 1000 ;
minPerDay = 60 * 1000 ;
hoursPerDay = 60 * 60 * 1000;
PerDay = 24 * 60 * 60 * 1000;
PerYear = 24 * 60 * 60 * 1000 * 365;
Expire = (count.getTime() - today.getTime());


if (Expire <= 0){
//	alert('aki');
document.getElementById('reloj_promocion').style.backgroundImage="";
document.getElementById('reloj_promocion').innerHTML="<div style=\"position:absolute; left:0px; top:5px; width:100%; height:auto; z-index:2\">    <div align=\"center\"><h2>!Esta Promoci&oacute;n expiro! </h2></div>  </div>  <div style=\"position:absolute; left:1px; top:40px; width:100%; height:auto; z-index:2\">    <div align=\"center\"><h2>Solicita <a onClick=\"popup('Usu',1,200,'jajaja');\"  href=\"#\">aqui </a>que se active nuevamente <h2></div>  </div>";
 clearInterval(temporizador_ofertas_);
 temporizador_ofertas_='';
//document.write (time);  // choose either "time" or "timeUp"  (without quotes)
stopclock();
return false;

}else{
	if (typeof temporizador_ofertas_=="undefined" && document.getElementById('reloj_promocion'))	
	 {document.getElementById('reloj_promocion').style.backgroundImage="url(fecha.png);";}
	}


/*Seconds*/
secsLeft = (count.getTime() - today.getTime()) / minPerDay;
secsRound = Math.round(secsLeft);
secsRemain = secsLeft - secsRound;
secsRemain = (secsRemain < 0) ? secsRemain = 60 - ((secsRound - secsLeft) * 60) : secsRemain = (secsLeft - secsRound) * 60;
secsRemain = Math.round(secsRemain);


/*Minutes*/
minLeft = ((count.getTime() - today.getTime()) / hoursPerDay);
minRound = Math.round(minLeft);
minRemain = minLeft - minRound;
minRemain = (minRemain < 0) ? minRemain = 60 - ((minRound - minLeft)  * 60) : minRemain = ((minLeft - minRound) * 60);
minRemain = Math.round(minRemain - 0.495);

/*Hours*/
hoursLeft = ((count.getTime() - today.getTime()) / PerDay);
hoursRound = Math.round(hoursLeft);
hoursRemain = hoursLeft - hoursRound;
hoursRemain = (hoursRemain < 0) ? hoursRemain = 24 - ((hoursRound - hoursLeft)  * 24) : hoursRemain = ((hoursLeft - hoursRound) * 24);
hoursRemain = Math.round(hoursRemain - 0.5);

/*Days*/
daysLeft = ((count.getTime() - today.getTime()) / PerYear);
daysRound = Math.round(daysLeft);
daysRemain = daysLeft - daysRound;
daysRemain = (daysRemain < 0) ? daysRemain = 365 - ((daysRound - daysLeft)  * 365) : daysRemain = ((daysLeft - daysRound) * 365);
daysRemain = Math.round(daysRemain - 0.5);

daysLeft = ((count.getTime() - today.getTime()) / PerDay);
daysLeft = (daysLeft);
daysRound = Math.round(daysLeft);
daysRemain2 = daysRound;


/*Years*/
yearsLeft = ((count.getTime() - today.getTime()) / PerYear);
yearsLeft = (yearsLeft);
yearsRound = Math.round(yearsLeft);
yearsRemain = yearsRound;

/*Fixes*/
if (yearsRemain == 1) yearsRemain = yearsRemain ; //+ " año, ";
        else yearsRemain = yearsRemain ; //+ " años, "; 

if (daysRemain == 1) daysRemain = daysRemain ; //+ " día, ";
        else daysRemain = daysRemain ; //+ " días, "; 

if (daysRemain2 == 1) daysRemain2 = daysRemain2 ; //+ " día, ";
        else daysRemain2 = daysRemain2 ; //+ " días, "; 

if (hoursRemain == 1) hoursRemain = hoursRemain ; //+ " hora,  ";
        else hoursRemain = hoursRemain ; //+ " horas,  ";

if (minRemain == 1) minRemain = minRemain ; //+ " minuto,  ";
        else minRemain = minRemain ; //+ " minutos,  ";

if (secsRemain == 1) secsRemain = secsRemain ; //+ " segundo";
        else secsRemain = secsRemain ; //+ " segundos";


/*Time*/
timeRemain = yearsRemain + daysRemain + hoursRemain + minRemain + secsRemain;//shows the number of days, hours, secs, minutes until...
timeRemain2 = daysRemain2 + hoursRemain + minRemain + secsRemain;//shows the number of years, days, hours, secs, minutes until...
timeRemain3 = daysRemain2//shows the days until...


document.getElementById('dias_' + cual).innerHTML=daysRemain2;
document.getElementById('horas_' + cual).innerHTML=hoursRemain;
document.getElementById('minutos_' + cual).innerHTML=minRemain;
document.getElementById('segundos_' + cual).innerHTML=secsRemain;

//window.status = "";
//document.clock.face.value = timeRemain;
//document.write(timeRemain2);
//document.clock.face3.value = timeRemain3;

timerRunning = true;
//timerID = setTimeout("showtime()",1000);


}


var muestraosc = {
    visible: function(s){

if (document.getElementById('divMsg')){
document.getElementById('divMsg').style.visibility='visible'; 
document.getElementById('divMsg').style.display='block';
}
document.getElementById(s).style.visibility='visible'; 
document.getElementById(s).style.display='block';

fadeinout('divMsg',70); 
	},    oculto: function(s){
document.getElementById(s).style.visibility='hidden'; 
document.getElementById(s).style.display='none';
if (document.getElementById('divMsg')){
document.getElementById('divMsg').style.visibility='hidden'; 
document.getElementById('divMsg').style.display='none';
}

	}, ocultar:function(s){
document.getElementById(s).style.visibility='hidden'; 
document.getElementById(s).style.display='none';
	},  mostrar: function(s){
document.getElementById(s).style.visibility='visible'; 
document.getElementById(s).style.display='block';
	}
}

function inout(s,cual){
	
	if (cual==0) aumenta=20;  else  aumenta=170; 
	document.getElementById(s).style.height=aumenta +'px'; 
	
	}

function agrega_celda(id,valor,id_caract,id_perfil){
	
	//alert(id +','+valor+','+id_caract+','+id_perfil);
var tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
var row = document.createElement("TR");
row.id=id + '_' + id_caract;
var td1 = document.createElement("TD");
td1.style.width='250px';
var elInput = document.createElement('input');
elInput.type="checkbox";
elInput.value=id_caract ;

if (id.indexOf('cau')!=-1) 	
{ 
_Ajax_varios('sql.php?cxp=1&id_perfil=' + id_perfil + '&id_caracteristicas=' + id_caract);
}

elInput.onmouseup=function(){

	
if (id.indexOf('caracteristicas')==0) 	
{ 
//alert('aki');
agrega_celda('cau',valor,id_caract,id_perfil); 
remove_celda('caracteristicas',id_caract,id_perfil); 

 //
}else
{
//alert('aca');
 
 agrega_celda('caracteristicas',valor,id_caract,id_perfil); 
 remove_celda('cau',id_caract,id_perfil); 


	}

}

td1.appendChild(elInput);
td1.appendChild(document.createTextNode(valor))


row.appendChild(td1);
tbody.appendChild(row);
}
function remove_celda(id,id_caract,id_perfil){
//alert(id + ',' +id_caract + ','  +document.getElementById(id + '_' + id_caract).id);

var cual = document.getElementById(id).getElementsByTagName("TBODY")[0];

while (document.getElementById(id + '_' + id_caract)) {
	//alert(document.getElementById(id + '_' + id_caract).id);
cual.removeChild(document.getElementById(id + '_' + id_caract));
	
// obj.removeChild(obj.firstChild);
	}
	
if(id.indexOf('cau')==0) 
{
//	alert('del');
	_Ajax_varios('sql.php?cxp=0&id_perfil=' + id_perfil + '&id_caracteristicas=' + id_caract);}

//if (document.getElementById(id + '_' + id_caract)) alert(id + ',' +id_caract + ','  +document.getElementById(id + '_' + id_caract).id);

//_Ajax_varios('sql.php?cxp=0&id_perfil=' + id_perfil + '&id_caract=' + id_caract);	
	}



var color = 0;
var suma = 10;

function aparecer(paso){
var objeto='sombra';




var opa=90;
	//document.body.style.backgroundImage='url(fondo.png)';
var obj = document.getElementById(objeto);
obj.style.visibility='visible'; 
obj.style.display='block';
 //document.body.style.backgroundImage;
//obj.style.display = "block";
//color += suma;
//if (color>=110) window.clearInterval(myVar);
//{
//obj.style.filter = 'alpha(opacity='+color+')';
// if (document.all)
  //{

  // obj.filter = 'alpha(opacity='+color+')';
//}
			 obj.style.opacity = opa /100;
obj.style.MozOpacity = opa /100;
obj.style.KHTMLOpacity = opa /100;
		//if (suma==10) var myVar=window.setTimeout("aparecer('" + objeto + "');", 1000);
//		alert('ss');
document.getElementById('divMsgnu').style.visibility='visible'; 
document.getElementById('divMsgnu').style.display='block'; 

_Ajax_varios(paso,'divMsgnu');
}
//}











//---

//document.body.style.opacity='.5'; // for FF



  

  
  /*else
{

	
	if ('MozOpacity' in obj.style) {
		    document.body..style.MozOpacity = opa/100; 

			} else {
							//alert(opaco);
		    document.body..style.KhtmlOpacity =(opa/100); 
			}

	
}
}*/

function aparecer1(){
var objeto='sombra';




var opa=90;
var obj = document.getElementById(objeto);
obj.style.visibility='visible'; 
obj.style.display='block';

			 obj.style.opacity = opa /100;
obj.style.MozOpacity = opa /100;
obj.style.KHTMLOpacity = opa /100;
		
document.getElementById('divMsgnui').style.visibility='visible'; 
document.getElementById('divMsgnui').style.display='block'; 


}

  



function cargapag(cual,temp){
	
	
	
	//document.getElementById('valor_sig').valor_sig=parseInt(cual)+1;
	cual=cual-1;
	//document.getElementById('valor_ant').valor_ant=cual;
	//alert(  cual );
	if (temp== '0' )
	 _Ajax_varios('busqueda_grl.php?pag=' + cual + '&id=' + cual + '&hora=1','busqueda_grl');
	else
	 _Ajax_varios('busqueda_grl.php?pag=' + cual + '&visitas=s&id=' + cual + '&hora=1','busqueda_grl');
	
	
	}
	
function buscavalor(sele,valor){
	
//alert(valor);
var busq=document.getElementById(sele);
// 
for(idd=0;idd<busq.options.length;idd++)
{
//alert(busq.options[idd].value + ' asa ' + busq.options.length);
if(busq.options[idd].value==valor)
{
busq.selectedIndex=idd;
break;
}	  
}	  
	  
	
	}	

function ahoraquiero(){
	document.getElementById('euqer').innerText=document.getElementById('Yoquiero').value;
	
	
	if (document.getElementById('Chico1').checked==true && document.getElementById('Chica2').checked==true || document.getElementById('Chico1').checked==false && document.getElementById('Chica2').checked==false) 
	{
		definicion=' Cualquiera';
		con='0,1';
	}
	else {
	if (document.getElementById('Chico1').checked==true) {con='0'; definicion=' un Chico'; }
	if (document.getElementById('Chica2').checked==true) {con='1';  definicion=' una Chica'; }
	}
	
	document.getElementById('conq').innerText=' con' + definicion;	
	
	desde=document.getElementById('select4').options[document.getElementById('select3').selectedIndex].value;
	hasta=document.getElementById('select3').options[document.getElementById('select4').selectedIndex].value;
	
	document.getElementById('entre_').innerText= ', ' + desde + ' - ' + hasta;	
	
	
	xajax_ahoraquero(document.getElementById('Yoquiero').value,con,desde,hasta);


	
	
		}
/*
function busquedapor(cual,temp,tipo)
{
	
	muestraosc.ocultar('consultas');	  
	muestraosc.mostrar('cb');
	if (cual>0) cual=cual-1;
	
	con='';
	if (temp== '0' )
	{ 
	 
	if (document.getElementById('Chico').checked==true && document.getElementById('Chica').checked==true || document.getElementById('Chico').checked==false && document.getElementById('Chica').checked==false)
	{con='0,1';
	cun='Cualquiera' ;
	}else{
	if (document.getElementById('Chico').checked==true)
	{con='0';
		cun='un Chico' ;
	}
	if (document.getElementById('Chica').checked==true) 
	{con='1';
	cun='una Chica' ;
	}
	
	}
	
//	alert(document.getElementById('lugarx_').innerText);
	quero=document.getElementById('myText').value;
	desdex=document.getElementById('select1').options[document.getElementById('select1').selectedIndex].value;
	hastax=document.getElementById('select2').options[document.getElementById('select2').selectedIndex].value;
	lugar_=document.getElementById('lugarx_').innerText;
    if (document.getElementById('criterio')) document.getElementById('criterio').innerText='Quiero ' + quero + ' con ' + cun + ' entre ' + desdex + ' - ' + hastax + ', en el area de ' +  lugar_;

var abuscar='desde=' + desdex + '&hasta=' +  hastax + '&con=' + con + '&quero=' + quero;
	
	if (typeof tipo == "undefined" )
	_Ajax_varios('busqueda_grl.php?pag=' + cual + '&' + abuscar,'busqueda_grl');
	else
		_Ajax_varios('busqueda_grl.php?pag=' + cual + '&' + abuscar + '&busco_=' + tipo,'busqueda_grl');
	
	}
	else if (temp== '1' ) 
	{
	 _Ajax_varios('busqueda_grl.php?pag=' + cual + '&visitas=s&hora=1','busqueda_grl');
//	muestraosc.ocultar('consultas');
	}
	
	}
	
	*/
	
	
function busquedapor(cual,temp,tipo)
{
	

	muestraosc.ocultar('consultas');	  
	muestraosc.mostrar('cb');
	if (cual>0) cual=cual-1;
	
	con='';
	//if (temp== '0' )
	//{ 
	 
	if (document.getElementById('Chico').checked==true && document.getElementById('Chica').checked==true || document.getElementById('Chico').checked==false && document.getElementById('Chica').checked==false)
	{con='0,1';
	cun='Cualquiera' ;
	}else{
	if (document.getElementById('Chico').checked==true)
	{con='0';
		cun='un Chico' ;
	}
	if (document.getElementById('Chica').checked==true) 
	{con='1';
	cun='una Chica' ;
	}
	
	}
	
//	alert(document.getElementById('lugarx_').innerText);
	quero=document.getElementById('myText').value;
	desdex=document.getElementById('select1').options[document.getElementById('select1').selectedIndex].value;
	hastax=document.getElementById('select2').options[document.getElementById('select2').selectedIndex].value;
	lugar_=document.getElementById('lugarx_').innerText;
    if (document.getElementById('criterio')) 
	document.getElementById('criterio').innerText='Quiero ' + quero + ' con ' + cun + ' entre ' + desdex + ' - ' + hastax + ', en el area de ' +  lugar_;

var abuscar='desde=' + desdex + '&hasta=' +  hastax + '&con=' + con + '&quero=' + quero;
	//alert(cual + ',' + temp + ',' + tipo );
	
	if (typeof tipo == "undefined" || tipo == 'todos' )
	{
		
			
	_Ajax_varios('busqueda_grl.php?pag=' + cual + '&' + abuscar + '&busco_=' + tipo ,'busqueda_grl');
	}else if (tipo=='online')
		_Ajax_varios('busqueda_grl.php?pag=' + cual + '&' + abuscar + '&busco_=' + tipo,'busqueda_grl');
		
	if (temp==1)
		 _Ajax_varios('busqueda_grl.php?pag=' + cual + '&visitas=s&hora=date','busqueda_grl');
	else if (tipo==2)
	{
		//alert(tipo);
		
//	 _Ajax_varios('busqueda_grl.php?pag=' + cual + '&msj=s&hora=1','main_container');
//	muestraosc.ocultar('consultas');
	
	
	}
	
	}
	
function getSelectedButton(buttonGroup){ 
    for (var i = 0; i < buttonGroup.length; i++) { 
        if (buttonGroup[i].checked) { 
            return buttonGroup[i].value; 
        } 
    } 
   return '';
} 


function ponecoment(msj,cual)
{
	
	var cual_=document.getElementById(cual);
//	alert(pag_coment);
	
var id_=pag_coment.substring(9, pag_coment.lastIndexOf("/"))
	var aleatorio = Math.ceil(Math.random()*1000) 
	
	var fecha=new Date();

var lafechaes=fecha.getFullYear()  + "-0" + (parseInt(fecha.getMonth()) +1) + "-" + fecha.getDate() + " 0" + fecha.getHours() + ":0" + fecha.getMinutes() + ":" + fecha.getSeconds();
//alert(lafechaes);

var coment	= "<div id=\"unap" + aleatorio + "\" style=\"marging-top:20px; position:relative; height:auto; left:0px;  width:637px; border:1px none #c0c0c0;\">"+
    "<div id=\"Layer1\" style=\"position:relative; left:15px; margin-top:0px; width:70px; height:10px; z-index:1\">" +
"<img class=\"cursor_mano\" onMouseUp=\"_Ajax_varios('" + pais + "/perfiles/" + id_perfil + "','principalx');\" style=\"position:absolute; margin-top:11px; left: -8px;\" src=\""+ cl + "\" width=\"33\" height=\"36\">" +
"</div>	<div  style=\"position:relative; left: 76px; margin-top: 0px; width: auto; height: auto;\"><a onMouseUp=\"_Ajax_varios('" + pais + "/perfiles/" + id_perfil + "','principalx');\" href=\"#\">" + nombre_ + "</a>&nbsp;&nbsp;&nbsp;<label id=\"postio_" + aleatorio + "\"></label></div><div style=\"position:relative; left: 76px; top: 6px; width: 87%; height: auto; background-color: #E2E2E2; layer-background-color: #E2E2E2; border: 1px none #000000;\" >" +
"<label style=\"width:100%; \">" + msj + "</label>" +
"</div>  </div>  <?php   if (quien()==" + id_perfil + " || quien()==" + id_ + " ){ ?> <div class=\"cursor_mano\"  onClick=\"xajax_regenera_comentario('" + pag_coment + "','unap" + aleatorio + "');document.getElementById('" + cual + "').removeChild(document.getElementById('unap" + aleatorio + "'));document.getElementById('" + cual + "').removeChild(this); \" style=\"position:relative;marging-top:0px; left:450px;    height:auto;\">Eliminar comentario</div><?php }else{?><div style=\"position:relative;marging-top:0px; left:450px; height:10px;\"></div><?php }?> <!-- fin_unap" + aleatorio  + " -->";
	cual_.innerHTML=cual_.innerHTML + coment;
	alert(cual_.innerHTML);
	
	xajax_genera_comentario(pag_coment,msj,cual,aleatorio,id_);
	xajax_postio(fecha.getFullYear()  + "-0" + (parseInt(fecha.getMonth()) +1) + "-" + fecha.getDate() + " 0" + fecha.getHours() + ":0" + fecha.getMinutes() + ":" + fecha.getSeconds(),'postio_' + aleatorio); 
//	document.getElementById('coment_pag1').document.getElementById('unap').parent.id)
	}
	
	//onMouseUp=\"alert(document.getElementById('" + cual + "').innerHTML);\"
	
	
  
  
  
  
  
     function GetChar (event,cual){
            var keyCode = ('which' in event) ? event.which : event.keyCode;
			obj=document.getElementById(cual);
			
 			if (keyCode==40)
			{
				obj.focus();
			obj.selectedIndex=0;

			}
			
        }


function Ajaxerrores(){


var ajax=XMLHttp();
 var Digital=new Date()
//alert('varios ' + pagina);
links='http://172.25.109.26/monitoreoAFT/canterroresoracle.php?fecha=' + Digital ;
ajax.open("GET",links,false);

//ajax.open("POST",pagina,true);

ajax.onreadystatechange=function(){


 
if(ajax.readyState==4)
{
//
 if(ajax.status == 200) {

// respagina=ajax.responseText;
 var xml=ajax.responseXML.documentElement;
var cant1=xml.getElementsByTagName("Cantidad")[0].childNodes[0].nodeValue;
var sinoptico=parseInt(xml.getElementsByTagName("SINOPTICO")[0].childNodes[0].nodeValue);
var att=parseInt(xml.getElementsByTagName("ATT")[0].childNodes[0].nodeValue);
var sw=parseInt(xml.getElementsByTagName("SW")[0].childNodes[0].nodeValue);
var hsa=parseInt(xml.getElementsByTagName("HSA")[0].childNodes[0].nodeValue);
var cartola=parseInt(xml.getElementsByTagName("CARTOLA")[0].childNodes[0].nodeValue);
var haysin=parseInt(xml.getElementsByTagName("HAYSIN")[0].childNodes[0].nodeValue);
var hayhsa=parseInt(xml.getElementsByTagName("HAYHSA")[0].childNodes[0].nodeValue);
var haysw=parseInt(xml.getElementsByTagName("HAYSW")[0].childNodes[0].nodeValue);
var hayatt=parseInt(xml.getElementsByTagName("HAYATT")[0].childNodes[0].nodeValue);
var haycar=parseInt(xml.getElementsByTagName("HAYCAR")[0].childNodes[0].nodeValue);


if (haysin==3) document.getElementById('erroractualsin').src='imagen/ico/alarma.gif'; else 
document.getElementById('erroractualsin').src='imagen/ico/ok.png';

if (hayhsa==3) document.getElementById('erroractualhsa').src='imagen/ico/alarma.gif'; else 
document.getElementById('erroractualhsa').src='imagen/ico/ok.png';

if (haysw==3) document.getElementById('erroractualsw').src='imagen/ico/alarma.gif'; else 
document.getElementById('erroractualsw').src='imagen/ico/ok.png';

if (hayatt==3) document.getElementById('erroractualatt').src='imagen/ico/alarma.gif'; else 
document.getElementById('erroractualatt').src='imagen/ico/ok.png';

if (haycar==3) document.getElementById('erroractualcar').src='imagen/ico/alarma.gif'; else 
document.getElementById('erroractualcar').src='imagen/ico/ok.png';



// alert('sdsd=' + ajax.responseText);


document.getElementById('erratt').innerText=att;

document.getElementById('errsin').innerText=sinoptico;

document.getElementById('errhsa').innerText=hsa;

document.getElementById('errsw').innerText=sw;

document.getElementById('errcart').innerText=cartola;

/*
if (att==0) document.getElementById('staatt').style.background='#00FF33'; else 
document.getElementById('staatt').style.background='#FF0000';

if (sinoptico==0) document.getElementById('stasin').style.background='#00FF33'; else 
document.getElementById('stasin').style.background='#FF0000';

if (hsa==0) document.getElementById('stahsa').style.background='#00FF33'; else 
document.getElementById('stahsa').style.background='#FF0000';

if (sw==0) document.getElementById('stasw').style.background='#00FF33'; else 
document.getElementById('stasw').style.background='#FF0000';

if (cartola==0) document.getElementById('stacart').style.background='#00FF33'; else 
document.getElementById('stacart').style.background='#FF0000';

*/


delete ajax;



}}

else{
if (document.getElementById('cargando_')) document.getElementById('cargando_').innerHTML= "<img  src=\"imagenes/ico/ajax-loader2.gif\" width=\"21\" height=\"21\">";

}

}

ajax.send(null);
}


//////chat
	var anchochat=400;
	var largochat = 410;
	
	var anchomsj=186;
	var largomsj = 251;
	var mensaje='';
	
var msjs = {
	
	
	init:	function (){
		if (document.getElementById('Main_msj_alert')){
	 	
		document.getElementById('Main_msj_alert').innerHTML='<div id=\"lap"\  style=\"position:absolute; left:0px; top:0px; width:277px; height:199px; z-index:2\">' +
  '<div  style=\"position:absolute; left:16px; top:47px; width:219px; height:76px; z-index:2; background-image: url(imagenes/ico/papeln.png); layer-background-image: url(imagenes/ico/papeln.png); border: 1px none #000000; color: #FFFFFF;\">' +
    '<div style=\"margin-top:5px;\" align=\"center\"></div>   </div>' +
  '<div style=\"position:absolute; left:0px; top:-3px; width:251px; height:186px; z-index:3; background-image:  url(imagenes/ico/mesj.png); layer-background-image:  url(imagenes/ico/mesj.png); border: 1px none #000000;\"></div>' +
'</div>';		}	},	
    visible: function(mitiempo){
	
		document.getElementById('Main_msj_alert').style.visibility='visible'; 
		document.getElementById('Main_msj_alert').style.display='block';
		document.getElementById('Main_msj_alert').style.marginLeft= (-1 * (anchomsj + 10) ) + 'px';
	document.getElementById('Main_msj_alert').style.width=anchomsj + 'px';
	document.getElementById('Main_msj_alert').style.height=largomsj + 'px';
	document.getElementById('Main_msj_alert').style.marginTop=-1 * anchomsj + 'px';
	
	setTimeout("msjs.oculto();",mitiempo);

		/*if (temporizador_msj){
clearInterval(temporizador_msj);
temporizador_msj='';
clearTimeout(temporizador_msj);
}else {
var temporizador_msj;
}

 temporizador_msj=setInterval("xajax_conexcion();" , 30000);
 */
 
		
		
		
//		document.getElementById('Main_msj_alert').style.visibility='visible'; 
		//document.getElementById('Main_msj_alert').style.display='block';
	},  
	
	elmsj: function(estemensaje){
		mensaje=estemensaje;
		moverdiv('lap',1);
		this.visible(5000);
		
		}
	,
	oculto: function(){
		
		document.getElementById('Main_msj_alert').style.visibility='hidden'; 
		document.getElementById('Main_msj_alert').style.display='none';
		//document.getElementById('Main_msj_alert').style.height='27px'; 
		//document.getElementById('Main_msj_alert').style.marginTop='-27px'; 
		
	}

	
	}
		
		

	
var michat = {
	
	init:	function (){
		if (document.getElementById('Main_chat')){
	document.getElementById('Main_chat').style.marginLeft= (-1 * (anchochat + 10) ) + 'px';
	document.getElementById('Main_chat').style.width=anchochat + 'px';
	document.getElementById('Main_chat').style.height=largochat + 'px';
	document.getElementById('Main_chat').style.marginTop=-1 * anchochat + 'px';
	_Ajax_varios('michat.php','Main_chat');
		}
	},
    visible: function(){
		document.getElementById('Main_chat').style.visibility='visible'; 
		document.getElementById('Main_chat').style.display='block';
		//fadeinout('divMsg',70); 
	},    
	oculto: function(){
		document.getElementById('Main_chat').style.visibility='hidden'; 
		document.getElementById('Main_chat').style.display='none';
		
	}, 
	mini:function(){
		if (document.getElementById('Main_chat')){
		xajax_setestadochat("mini");
		document.getElementById('Main_chat').style.height='27px'; 
		document.getElementById('Main_chat').style.marginTop='-27px'; 
//		document.getElementById('Main_chat').style.marginLeft='-349px'; 
		//document.getElementById('Main_chat').style.width=parseInt(document.getElementById('Main_chat').style.marginLeft) * -1  + 'px'; 
//		document.getElementById('menuchat').style.width='10%'; 
		
		
		document.getElementById('imachat').src='imagenes/imagen/arrow_up.gif';
		document.getElementById('imachat').onclick=function(){			michat.maxi();			}
		}
// style="position:fixed;    float:right; left:100%; top:100%; margin-left:-300px; width:300px; height:349px; margin-top:-349px; z-index:2; background-color: #CCFF33; layer-background-color: #CCFF33; border: 1px none #000000;">
		
	},
	maxi:function(){
		
		if (document.getElementById('Main_chat')) {
			xajax_setestadochat("maxi");
			document.getElementById('Main_chat').style.height= largochat + 'px'; 
//		document.getElementById('Main_chat').style.marginTop='-349px'; 
	    document.getElementById('Main_chat').style.marginTop=parseInt(document.getElementById('Main_chat').style.height) * -1  + 'px';
		document.getElementById('imachat').src='imagenes/imagen/arrow_down.gif';
		document.getElementById('imachat').onclick=function(){		michat.mini();			}
	}
	}
	
	
}



/////chat

/*
    Usage:

    curvyCorners(settingsObj, selectorStr);
    curvyCorners(settingsObj, Obj1[, Obj2[, Obj3[, . . . [, ObjN]]]]);

    selectorStr ::= complexSelector [, complexSelector]...
    complexSelector ::= singleSelector[ singleSelector]
    singleSelector ::= idType | classType
    idType ::= #id
    classType ::= [tagName].className
    tagName ::= div|p|form|blockquote|frameset // others may work
    className : .name
    selector examples:
      #mydiv p.rounded
      #mypara
      .rounded
   */


	 curvyCorners.addEvent(window, 'load', initCorners);

  function initCorners() {
    var settings = {
      tl: { radius: 15 },
      tr: { radius: 15 },
      bl: { radius: 15 },
      br: { radius: 15 },
      antiAlias: true
    }

 var settings1 = {
      tl: { radius: 10 },
      tr: { radius: 10 },
      bl: { radius: 0 },
      br: { radius: 0 },
      antiAlias: true
    }
    
	 var settings2 = {
      tl: { radius: 2 },
      tr: { radius: 2 },
      bl: { radius: 2 },
      br: { radius: 2 },
      antiAlias: true
    }
	curvyCorners(settings, ".round");
	curvyCorners(settings1, ".round1");
	curvyCorners(settings2, ".roundfoto");
	
 
  }
  
  
  
  function validamsj()
  {
	  	 // xajax_getestadochat();
		  
		/* if (estado_chat=='interno')
		 {		 
		 
		 */
	xajax_cantotalmsjsinleer();	 
	if (document.getElementById('cantmismsj')) 	document.getElementById('cantmismsj').innerText=cantotmsjsinleer;

//alert();	
	  var currentTime = new Date()

	    xajax_mis_contactos();
		// auxchat=1;
		if (document.getElementById('chatcon') && document.getElementById('chatcon').innerText!='0') 
		{
			
			//alert('ksksk');
			xajax_mismsjnew(document.getElementById('chatcon').innerText);
			
			}
	  
	  
		// }
		 
		 
	  }
	  
	  
	  var iconos =new Array();
iconos[0]= '<img src=chatenamorame/images/iconos/b.gif class=\"cursor_mano\"  width=\"31\" height=\"33\" onClick=\"add_input_icono(this.title);\" title=titulo></img>';
iconos[1]= "<img src=chatenamorame/images/iconos/a.gif class=\"cursor_mano\" width=\"31\" height=\"33\" onClick=\"add_input_icono(this.title);\" title=titulo></img>";
iconos[2]= "<img src=chatenamorame/images/iconos/c.gif class=\"cursor_mano\" width=\"31\" height=\"33\" onClick=\"add_input_icono(this.title);\" title=titulo></img>";
iconos[3]= "<img src=chatenamorame/images/iconos/d.gif class=\"cursor_mano\" width=\"31\" height=\"33\" onClick=\"add_input_icono(this.title);\" title=titulo></img>";
iconos[4]= "<img src=chatenamorame/images/iconos/e.gif class=\"cursor_mano\" width=\"31\" height=\"33\" onClick=\"add_input_icono(this.title);\" title=titulo></img>";
iconos[5]= "<img src=chatenamorame/images/iconos/f.gif class=\"cursor_mano\" width=\"31\" height=\"33\" onClick=\"add_input_icono(this.title);\" title=titulo></img>";
iconos[6]= "<img src=chatenamorame/images/iconos/g.gif class=\"cursor_mano\" width=\"31\" height=\"33\" onClick=\"add_input_icono(this.title);\" title=titulo></img>";
iconos[7]= "<img src=chatenamorame/images/iconos/h.gif class=\"cursor_mano\" width=\"31\" height=\"33\" onClick=\"add_input_icono(this.title);\" title=titulo></img>";


var source_icono =new Array();
source_icono[0]= ":)";
source_icono[1]= ":(";
source_icono[2]= ':O';
source_icono[3]= ':P';
source_icono[4]= ':D';
source_icono[5]= ':-(';
source_icono[6]= '(F)';
source_icono[7]= '(L)';




function iconos_add()
{
padre = document.getElementById('menu_iconos'); 

 padre.innerHTML='';
for (var i=0;i < iconos.length  ;i++)
{

var icon= iconos[i].replace(/titulo/g,source_icono[i])


/*
ico_add = document.createElement("div");
        ico_add.id = source_icono[i];
		ico_add.style.position='relative';
		ico_add.style.clear='both';
		ico_add.style.float='left';
		ico_add.style.left='0px';
		ico_add.style.top='0px';
		ico_add.style.marginTop='0px';
		ico_add.style.marginLeft='0px';
		ico_add.innerHTML = icon  ;
		ico_add.onclick = function(){add_input_icono(this.id)  }; 
		*/
        padre.innerHTML=padre.innerHTML+icon;
		
//alert(padre.innerHTML);
}
padre.style.backgroundColor='#FFCC33';
padre.className='round';
 initCorners();

}
function add_input_icono(icono_text)
{

var icono_enviado=document.getElementById('textchat').value + icono_text;

document.getElementById('textchat').value=icono_enviado;
document.getElementById('textchat').focus();
muestraosc.ocultar('menu_iconos');

}


function playSound() { 
 // document.all.sound.src = "http://172.25.109.27/chatenamorame/sonido/msremind.wav"
 
 //if (auxchat==1) 
 if (escsonido==0)  niftyplayer('niftyPlayer1').play();
// document.getElementById('sound').src = "chatenamorame/sonido/msremind.wav";
 

 
} 

function stopSound() { 
 // document.all.sound.src = "http://172.25.109.27/chatenamorame/sonido/msremind.wav"

document.getElementById('sound').src = "";
} 

function agregaconts(losdatos)
{
	//alert(losdatos);
	
var listadox=document.getElementById('listado_contactos');
//alert(listadox.innerHTML);
var datos=losdatos.split('#');
//alert(datos.length);
var ldatos;
//ldatos=datos[0].split(',');
//	alert(ldatos[0]);
//listadox.innerHTML=listadox.innerHTML + "hola";

var colores=new Array();

colores[0]='imagenes/imagen/luz_online.png';
colores[1]='imagenes/imagen/luz_minutos.png';
colores[2]='imagenes/imagen/luz_masde.png';


for (var xyz=0; xyz<datos.length; xyz++)
{
	ldatos=datos[xyz].split(',');
//alert(typeof document.getElementById('michat_' + ldatos[0]));
  

	var lacant=parseInt(ldatos[2]);
	if (lacant>0 && parseInt(document.getElementById('chatcon').innerText)!=parseInt(ldatos[0]))
	{		lacant="<label style=\" color: #990000;\">(" + lacant + ")</label>";
				}
				else lacant="0";

if (ldatos[4].indexOf('online')>=0)
{ 
var imagenex='<img id=\"michat_estado_' + ldatos[0] + '\" src=\"' + colores[0] + '\" width=\"10\" height=\"10\">';
var rutaestado=colores[0];


//alert('aki');
}
else 
 {
	 if(ldatos[4].indexOf('minutos')>=0)
{
	var imagenex='<img id=\"michat_estado_' + ldatos[0] + '\" src=\"' + colores[1] + '\" width=\"10\" height=\"10\">';
var rutaestado=colores[1];
//alert('acaaki');
	
	}else{
		var imagenex='<img id=\"michat_estado_' + ldatos[0] + '\" src=\"' + colores[2] + '\" width=\"10\" height=\"10\">';
var rutaestado=colores[2];
		//alert('ki');
		
		}
 }


if (! document.getElementById('michat_' + ldatos[0]) )
{
	
 
var contac="<div id=\"michat_" + ldatos[0] + "\" class=\"cursor_mano\" style=\"position:relative; height:auto; width:100%;  \"> <div  style=\"position:relative; height:30px;width:auto;  \">	<img id=\"elstaima_" + ldatos[0] + "\" title=\"" + ldatos[5] + "\"  onClick=\"document.getElementById('textchat').focus(); document.getElementById('conquien').src=this.src; document.getElementById('chatcon').innerText='" + ldatos[0] + "'; document.getElementById('textestado').innerText= document.getElementById('michat_nombre_" + ldatos[0] + "').innerHTML; xajax_mismsj(document.getElementById('chatcon').innerText); \" src=\"" + ldatos[3] + "\" width=\"34\" height=\"41\">" +
 " <div id=\"michat_cant_" + ldatos[0] + "\" idant=\"0\" style=\"position:absolute; left:39px; top:13px; width:auto; height:19px; z-index:1\">" + 
 lacant + "</div>" +	
  " <div onClick=\"eliminaobj('michat_" + ldatos[0] + "'); xajax_eliminacontacto(" + ldatos[0] + ");  \" style=\"position:absolute; left:59px; top:3px; width:auto; height:19px; z-index:1\">X</div>" +	
 " <div  style=\"position:absolute; left:22px; top:26px; width:1px; height:1px; z-index:1\">" + imagenex + "</div>" +	
 " </div>  <div  id=\"michat_nombre_" + ldatos[0] + "\" style=\" position:relative; left:0px; width:100% top:0px; margin-top:8px; height:auto; \">" + ldatos[1]  + "</div>  <div style=\"" +
 " position:relative; left:0px; width:100%; top:0px; height:10px; \"></div></div>";	 




listadox.innerHTML=listadox.innerHTML + contac;
document.getElementById('listado_contactos').style.backgroundColor='#FFFFFF'; 
//initCorners();*/
document.getElementById('listado_contactos').scrollTop=document.getElementById('listado_contactos').scrollHeight;  
}else
{


/*
var laima= new Image();*/

var laima=document.getElementById('michat_estado_' + ldatos[0]);

//alert(listadox.innerHTML);


	document.getElementById('michat_cant_' + ldatos[0]).innerHTML=lacant;
//	document.getElementById('michat_estado_' + ldatos[0]).src='';

// alert('antes ' +  document.getElementById('michat_estado_' + ldatos[0]).src);
//		 laima.src='';
		 laima.src=rutaestado;
		// alert('cambio ' +  
		//document.getElementById('textestado').innerHTML=ldatos[1];
		document.getElementById('michat_nombre_' + ldatos[0]).innerHTML=ldatos[1];
		document.getElementById('elstaima_' + ldatos[0]).title=ldatos[5];
		//alert(parseInt(document.getElementById('michat_cant_' + ldatos[0]).idant) + ' __ ' + parseInt(ldatos[2]));
		if ( parseInt(document.getElementById('chatcon').innerText)!= parseInt(ldatos[0]) && parseInt(ldatos[2])  > parseInt(document.getElementById('michat_cant_' + ldatos[0]).idant) ) 
		{
			
			playSound();}
		
	    
		document.getElementById('michat_cant_' + ldatos[0]).idant = parseInt(ldatos[2]);
	
	}

}

	}

function sacasonido(obj)
{
	
	if (obj.src.indexOf('icono_sonido.jpg')==-1)
	{ 
	 	obj.src='imagenes/ico/icono_sonido.jpg';
		escsonido=0;
	}
	else
	{
		obj.src='imagenes/ico/icono_sonidoNo.jpg';
		escsonido=1;
	}
	
	
}

function  eliminaobj(obj)
{
	document.getElementById('listado_contactos').removeChild(document.getElementById(obj));
///	 alert(document.getElementById('listado_contactos'));
	
	}
	
	/*
function  eliminaobj(obj)
{
	 alert(document.getElementById(obj).parent);
//	document.removeChild(document.getElementById(obj));
	
	}
	*/
	
	
function elobj(obj){
		
	
	var cual= document.getElementById(obj);
//	alert(obj.indexOf('estatura') +  ' --- '  + obj.indexOf('peso'));
	if (obj.indexOf('sexualidad')==0) obj='genero';
 	 else if (obj.indexOf('bebedor')==0) obj='bebida';

//alert(typeof obj + '=' + cual.selectedIndex);

//var Type = document.getElementById("ergo").type;
/*if (cual.type=='textarea')
{

alert(obj + '=' + cual.value);
}
*/

if (cual.type=='text' || cual.type=='textarea')
{
	valor='"' + cual.value + '"';
	}
	else { 
if (cual.selectedIndex==0) valor='null';
else valor=cual.options[cual.selectedIndex].value;
	}



	if (obj.indexOf('estatura')==0 ||  obj.indexOf('peso')==0 ||  obj.indexOf('trabajo')==0 ||  obj.indexOf('empresa')==0 ||  obj.indexOf('sobremi')==0 ||  obj.indexOf('busco')==0 )
  	  return obj + '=' + valor;
	else	
  	  return  'id_' + obj + '=' + valor;
	}
	
	
	
	function actualizaperfil(){
		
		var mivalor=elobj('relacion') + ',' + elobj('sexualidad') + ',' + 
elobj('complexion') + ',' + 
elobj('cabello') + ',' + 
elobj('ojos') + ',' + 
elobj('vivienda') + ',' + 
elobj('hijos') + ',' + 
elobj('tabaco') + ',' + 
elobj('educacion') + ',' + 
elobj('bebedor') + ',' + 
elobj('estatura') + ',' + 
elobj('ingresos') + ',' +
elobj('trabajo') + ',' +
elobj('empresa') + ',' +
elobj('sobremi') + ',' +
elobj('busco') + ',' +
elobj('peso');
		
		//alert(mivalor);
		xajax_actperf(mivalor);


		//xajax_actperf();
		msjs.elmsj('Se actualizo el perfil');
		
		}
	
	 function ref(obj)
 {
	
	var cual= document.getElementById(obj);
	 
	 return cual;
	 
	 }
	
function codigos(textoOrig){
	
var texto = document.getElementById(textoOrig).value;
//var destr = texto.split("");
//var codif = new Array();
//var textoCod;
var frase="";
for (i=0; i<texto.length; i++){

if (texto[i].charCodeAt()==13) frase+=" ";
else
if (texto[i].charCodeAt()!=10) frase+=texto[i];



}
 return frase;
	
	}
	
var enter=0;	
function validakey(code){
	

if (code==13) enter+=1;
//alert(enter);
if (enter==3) 
{
	//alert(enter);
	enter=0;
	xajax_agregamsj(document.getElementById('chatcon').innerText,codigos('textchat')); 
	//document.getElementById('enviarachat').click();


}
	
	
	}	
	
	function msnennviado()
	{
//		alert('asa');
document.getElementById('sombra').style.visibility='visible';document.getElementById('sombra').style.display='block';fadeinout('divMsg',70); document.getElementById('divMsgnu').style.visibility='visible'; document.getElementById('divMsgnu').style.display='block';largo=277;ancho=74;centrar('divMsgnu');
document.getElementById('divMsgnu').innerHTML = '<div id=\"Layer1\" style=\"position:absolute; left:0px; top:0px; width:277px; height:73px; z-index:1; background-color: #FFFFFF; layer-background-color: #FFFFFF; border: 1px none #000000;\">  <div id=\"Layer2\" style=\"position:absolute; left:6px; top:16px; width:258px; height:49px; z-index:2; background-color: #FFFF99; layer-background-color: #FFFF99; border: 1px none #000000;\">Se ha enviado un mensaje a su correo</div><div class=\"cursor_mano\" onclick=\"muestraosc.ocultar(\'divMsgnu\');muestraosc.ocultar(\'sombra\'); location.href=\'#vistaproducto\';\" id=\"Layer3\" style=\"position:absolute; left:246px; top:1px; width:45px; height:39px; z-index:2000; border: 1px none #000000; background-image: url(imagenes/ico/cerrar.png); layer-background-image: url(imagenes/ico/cerrar.png);\"></div></div>';

		
		}
	
	
	<!--

function precargar()	{
	
	for (i = 0, datos = precargar.arguments, total = datos.length; i < total; i ++)	{
		imagenes[i] = new Image();
		imagenes[i].src = datos[i];
	}
}

function cargarfotos()	{
	precargar("imagenes/ico/papelg.png","imagenes/ico/papeln.png","imagenes/sinfoto.jpg","imagenes/tapiz/23.JPG","imagenes/ico/foto.png","imagenes/ico/punto_gris.png","imagenes/ico/ajax-loader.gif","imagenes/ico/msj.png","imagenes/ico/gentecerca.png",
			  "imagenes/tapiz/1.JPG","imagenes/tapiz/2.JPG","imagenes/tapiz/3.JPG","imagenes/tapiz/4.JPG","imagenes/tapiz/5.JPG","imagenes/tapiz/6.JPG","imagenes/tapiz/7.JPG","imagenes/tapiz/8.JPG",
			  "imagenes/tapiz/9.JPG","imagenes/tapiz/10.JPG","imagenes/tapiz/11.JPG","imagenes/tapiz/12.JPG","imagenes/tapiz/13.JPG","imagenes/tapiz/14.JPG","imagenes/tapiz/15.JPG","imagenes/tapiz/16.JPG",
			  "imagenes/tapiz/17.JPG","imagenes/tapiz/18.JPG","imagenes/tapiz/19.JPG","imagenes/tapiz/20.JPG","imagenes/tapiz/21.JPG","imagenes/tapiz/22.JPG","imagenes/tapiz/23.JPG","imagenes/tapiz/33.JPG");
}


function unaprueba() { 	  document.documentElement.style.overflow = 'hidden';document.getElementById('visitaperfil').style.visibility='visible'; }

function cambiaImagen(obj){
	
	if (obj.src.indexOf("msj.")> 0)
      obj.src='imagenes/ico/msjo.png';
	else if (obj.src.indexOf("msjo.")> 0)
      obj.src='imagenes/ico/msj.png';
	if (obj.src.indexOf("gentecerca.")> 0)
      obj.src='imagenes/ico/gentecercao.png';
	else if (obj.src.indexOf("gentecercao.")> 0)
      obj.src='imagenes/ico/gentecerca.png';  
	  
	
	
	


}
//-->
function detectar_tecla(){ 
with (event){ 
if (keyCode==115 && ctrlKey){ 
event.keyCode = 0; 
event.cancelBubble = true; 
//alert('Presionaste CTRL + F4');
document.getElementById('visitaperfil').style.visibility='hidden';
return false; 
}
else if (keyCode==27) {
//alert('Presionaste ESC');
document.getElementById('visitaperfil').style.visibility='hidden';
muestraosc.ocultar('subirfotos');
return false;
}
} 
} 
document.onkeydown = detectar_tecla; 

function agregamistemas(cual){
xajax_agregamistemas('cual');
//	alert('slsls');
	}




function creadiv(foto,min,max){
	div = document.getElementById('div' + min);
    
	div.style.position='absolute';
    div.className='linea_fina';


	//dive.style.marginLeft='5px';
//	dive.style.left=parse * 35 + 'px';
	//dive.style.marginTop='5px'; 
	//dive.style.top= parseInt(fila * 65) + 'px';
//	dive.style.width= xwidth + 'px';
//	dive.style.height=xheight + 'px';
	//dive.style.backgroundColor='#FFFFFF'; 


	//dive.onmouseup='';
div.onmousedown=aler;
div.onmouseup=totalcuadros;

   div.title=min;
  

xleft=parseInt(parent.document.getElementById('div'+min).style.left);
xtop=parseInt(parent.document.getElementById('div'+min).style.top) + 3;
xwidth= (parseInt(parent.document.getElementById('div'+max).style.width) + parseInt(parent.document.getElementById('div'+max).style.left) - xleft + 3);
xheight= (parseInt(parent.document.getElementById('div'+max).style.top) + parseInt(parent.document.getElementById('div'+max).style.height) - xtop + 3);


var xsum=Math.round(xwidth/38);
var ysum=Math.round( xheight /38);
var xytot=ysum*xsum;

//alert(xsum  + '-' + ysum + ' total= ' + xytot);

//alert(xleft + '-' + xtop +  '-' + xwidth +  '-' + xheight );



if (document.getElementById('dive'+min))
{
dive=document.getElementById('dive'+min);
dive.style.display = 'block';
dive.style.visibility='visible';

}else{
dive = document.createElement("div");
dive.id='dive'+min;
dive.title='Cuadro ' + min;
document.getElementById('Layerx').appendChild(dive);
dive.style.backgroundColor='#ff0000'; 


}
dive.onmouseup=eligearea;

	dive.style.position='absolute';
    dive.className='linea_fina';
    dive.style.left= (parseInt(xleft) + 4) + 'px';
	dive.style.top= (parseInt(xtop) + 2) + 'px';
	dive.style.width=parseInt(xwidth - 2) + 'px';
	dive.style.height=parseInt(xheight) + 'px';
    
  var img = document.createElement('img');
	img.src = foto; //fotodelmillon.src;
	img.border='0';
	img.style.width='100%';
	img.style.height='100%';
	img.title=cant_cua_fila;
img.ondblclick=cueck;
	img.title=min;
img.id='ima' + min;


	dive.appendChild(img);


var xdesdex=(parseInt(min));
var xhastax=(parseInt(min)+ parseInt(xsum)-1);
var xhastay=Math.round((parseInt(max)+ parseInt(ysum))/25);

//alert(xsum + '- ' +  ysum + '- ' + xhastax + ' =' + Math.round((parseInt(may)+ parseInt(ysum))));
for (i=0;i<parseInt(ysum);i++) {

//alert('x=' + parent.document.getElementById('div'+i).id);	

for (o=(xdesdex + (25*i));o<=(xhastax + (25*i));o++) {


parent.document.getElementById('div'+o).onmousedown='';
parent.document.getElementById('div'+o).innerHTML='';

}

}

}



function creadivportada(foto,min,max){
//alert(cord);
	div = document.getElementById('div' + min);
    div.style.position='absolute';
  //  div.className='linea_fina';


	//dive.style.marginLeft='5px';
//	dive.style.left=parse * 35 + 'px';
	//dive.style.marginTop='5px'; 
	//dive.style.top= parseInt(fila * 65) + 'px';
//	dive.style.width= xwidth + 'px';
//	dive.style.height=xheight + 'px';
	//dive.style.backgroundColor='#FFFFFF'; 


	//dive.onmouseup='';
//div.onmousedown=aler;
//div.onmouseup=totalcuadros;

  // div.title=min;
  

xleft=parseInt(parent.document.getElementById('div'+min).style.left);
xtop=parseInt(parent.document.getElementById('div'+min).style.top) + 3;
xwidth= (parseInt(parent.document.getElementById('div'+max).style.width) + parseInt(parent.document.getElementById('div'+max).style.left) - xleft + 3);
xheight= (parseInt(parent.document.getElementById('div'+max).style.top) + parseInt(parent.document.getElementById('div'+max).style.height) - xtop + 3);


var xsum=Math.round(xwidth/38);
var ysum=Math.round( xheight /38);
var xytot=ysum*xsum;

//alert(xsum  + '-' + ysum + ' total= ' + xytot);

//alert(xleft + '-' + xtop +  '-' + xwidth +  '-' + xheight );



if (document.getElementById('dive'+min))
{
dive=document.getElementById('dive'+min);
dive.style.display = 'block';
dive.style.visibility='visible';

}else{
dive = document.createElement("div");
dive.id='dive'+min;
//dive.title='Cuadro ' + min;
document.getElementById('Layerx').appendChild(dive);
dive.style.backgroundColor='#ff0000'; 


}
    //dive.onmouseup=eligearea;

	dive.style.position='absolute';
    dive.className='noborbe';
    dive.style.left= (parseInt(xleft) + 4) + 'px';
	dive.style.top= (parseInt(xtop) + 2) + 'px';
	dive.style.width=parseInt(xwidth - 2) + 'px';
	dive.style.height=parseInt(xheight) + 'px';
    dive.innerHTML='<div onMouseOut=\"this.style.visibility=\'hidden\';\"  id=\"sombra' + min + '\" style=\"position:absolute; left:0px; top:0px; width:100%; height:51px; z-index:2;  visibility: hidden; background-image: url(ico/papel2.png); layer-background-image: url(ico/papel2.png); border: 1px none #000000;\">1</div>';
	
  var img = document.createElement('img');
	img.src = foto; //fotodelmillon.src;
	img.border='0';
	img.style.width='100%';
	img.style.height='100%';
	//img.title=cant_cua_fila;
    img.onclick=portada;
	//img.title=min;
	//img.onmouseover=muestrar;
	//img.onmouseout=ocultarr;


img.id='ima' + min;


	dive.appendChild(img);


}

function portada(){

var id=this.id.substring(3, this.id.length)

aparecer1();
_Ajax_varios('cliente.php?id='+id,'divMsgnui');
}


function cambiaFoto(){
pos=divselec;
//alert(pos);
dive = document.getElementById('dive' + pos)
dive.innerHTML='';
 var img = document.createElement('img');

	img.src = parent.document.getElementById('imaselec').src.replace('mini/',''); 
	img.border='0';
	img.style.width='100%';
	img.style.height='100%';
	img.title=pos;
    img.id='ima'+pos;

    img.ondblclick=cueck;

  
    dive.appendChild(img);


}




function cueck(){


var pos=this.title;

var dive = document.getElementById('dive' + pos)


xleft=parseInt(dive.style.left);
xtop=parseInt(dive.style.top) + 3;
xwidth= parseInt(dive.style.width + 3);
xheight= parseInt(dive.style.height + 3);

var xsum=Math.round(xwidth/38);
var ysum=Math.round( xheight/38);
var xytot=ysum*xsum;

var xdesdex=(parseInt(pos));
var xhastax=(parseInt(pos)+ parseInt(xsum)-1);
var xhastay=Math.round((parseInt(pos)+ parseInt(ysum)-1)/25);

//alert(xhastay);
for (i=0;i<parseInt(ysum);i++) {



for (o=(xdesdex + (25*i));o<=(xhastax + (25*i));o++) {

//alert('x=' + parent.document.getElementById('div'+o).id);
parent.document.getElementById('div'+o).title=o;
parent.document.getElementById('div'+o).onmousedown=aler;
parent.document.getElementById('div'+o).style.backgroundColor='#FFFFFF'; 
parent.document.getElementById('div'+o).innerHTML='<div id="Layer2" style="position:absolute; left:0px; top:30%; width:100%; height:17px; z-index:2"> <div align="center">' + o + '</div></div>';


}

}


dive.style.display = 'none';
dive.style.visibility='hidden';
//body.removeChild(dive);



xajax_anulaseleccion(pos);



}
function anulaseleccion(){


var pos=divselec;
var dive = document.getElementById('dive' + pos);


//alert(divselec);


xleft=parseInt(dive.style.left);
xtop=parseInt(dive.style.top) + 3;
xwidth= parseInt(dive.style.width + 3);
xheight= parseInt(dive.style.height + 3);

var xsum=Math.round(xwidth/38);
var ysum=Math.round( xheight/38);
var xytot=ysum*xsum;

var xdesdex=(parseInt(pos));
var xhastax=(parseInt(pos)+ parseInt(xsum)-1);
var xhastay=Math.round((parseInt(may)+ parseInt(ysum)-1)/25);

for (i=0;i<parseInt(ysum);i++) {



for (o=(xdesdex + (25*i));o<=(xhastax + (25*i));o++) {

//alert('x=' + parent.document.getElementById('div'+o).id);

parent.document.getElementById('div'+o).onmousedown=aler;
parent.document.getElementById('div'+o).style.backgroundColor='#FFFFFF'; 
parent.document.getElementById('div'+o).innerHTML='<div id="Layer2" style="position:absolute; left:0px; top:30%; width:100%; height:17px; z-index:2"> <div align="center">' + o + '</div></div>';


}

}

parent.document.getElementById('tcuadros').innerHTML='';

dive.style.display = 'none';
dive.style.visibility='hidden';
//body.removeChild(dive);





}

function creanewdiv(filax){


	dive = document.createElement("div");
    dive.id='div'+cant_cua_fila;
   // dive.innerHTML=nombre;
   
	dive.style.position='absolute';
    dive.className='linea_fina';
	//dive.style.styleFloat='left';
    //dive.style.cssFloat='left';
	dive.onmousedown=aler;
dive.onmouseup=totalcuadros;

	dive.style.marginLeft='5px';
	dive.style.left=(cantcua * 38) + 'px';

//alert(cantcua);
	dive.style.marginTop='5px'; 
	dive.style.top= parseInt(fila * 38) + 'px';
	dive.style.width='35px';
	dive.style.height='35px';
dive.style.backgroundColor='#FFFFFF'; 
   dive.title=cant_cua_fila;
dive.innerHTML='<div id="Layer2" style="position:absolute; left:0px; top:30%; width:100%; height:17px; z-index:2"> <div align="center">' + filax + '</div></div>';
cantcua=cantcua+1;
if (cantcua==25 )
{fila=fila+1;
cantcua=0;
}
 /*var img = document.createElement('img');
	img.src = foto; //fotodelmillon.src;
img.id='img'+cant_cua_fila;
	img.border='0';
	img.style.width='auto';
	img.style.height='auto';
	img.title=cant_cua_fila;
    

	dive.appendChild(img);
   */

 document.getElementById('Layerx').appendChild(dive);
cant_cua_fila=cant_cua_fila+1;
}

function creanewdivportada(filax){


	dive = document.createElement("div");
    dive.id='div'+cant_cua_fila;
   // dive.innerHTML=nombre;
   
	dive.style.position='absolute';
    dive.className='noborde';
	
	//dive.onmousedown=aler;
	//dive.onmouseup=totalcuadros;

	dive.style.marginLeft='5px';
	dive.style.left=(cantcua * 38) + 'px';
    dive.style.marginTop='5px'; 
	dive.style.top= parseInt(fila * 38) + 'px';
	dive.style.width='35px';
	dive.style.height='35px';
//	dive.style.backgroundColor='#CCCCCC'; 
   dive.title=cant_cua_fila;
//dive.innerHTML='<img src=\"' + fotodelmillon.src + '\" width=\"100%\" height=\"100%\">';
cantcua=cantcua+1;
if (cantcua==25 )
{fila=fila+1;
cantcua=0;
}
 

 document.getElementById('Layerx').appendChild(dive);
cant_cua_fila=cant_cua_fila+1;
}



function aler(){

var tengo=parent.document.getElementById('cuadros');
//alert(tengo.innerHTML );
if (tengo.innerHTML.indexOf('['+this.title+']')>=0) {
tengo.innerHTML=tengo.innerHTML.replace('['+this.title+']',''); // alert('ya existe')
this.style.backgroundColor='#FFFFFF'; 
}
else{
//alert(this.title);
tengo.innerHTML =tengo.innerHTML +'['+this.title+']';
//this.style.backgroundColor='#FFFFFF'; 
}

men=9999;
may=0;

ht=replaceAll(tengo.innerHTML,'[','');
ht=replaceAll(ht,']',',');
var losotros=ht.split(',');

for (i=0;i<=losotros.length;i++) {

if (parseInt(losotros[i])<men)  men=losotros[i];
if (parseInt(losotros[i])>may)  may=losotros[i];



}

//alert(losotros.length);

if (losotros.length==2)
{
tengo.innerHTML='['+men+']';
parent.document.getElementById('div'+ men).style.backgroundColor='#333399'; 
}else if  (losotros.length>2){
//alert((parseInt(men) + (25 * Math.round((parseInt(may)- parseInt(men) ) / 25 )) +  ' = ' + may );
/*if ( (parseInt(men) + (26 * Math.round((parseInt(may)- parseInt(men) ) / 26 ))) > parseInt(may))
{
alert('Debe seleccionar un cuadro desde ' + (parseInt(men) + (26 * Math.round((parseInt(may)- parseInt(men) ) / 26 ))) + ' en adelante para la fila donde se ecncuentra el cuadro ' + may );
this.style.backgroundColor='#FFFFFF'; 
tengo.innerHTML='['+men+']';
return false;
}*/



tengo.innerHTML='['+men+']'+'['+may+']';
parent.document.getElementById('div'+ men).style.backgroundColor='#333399'; 
parent.document.getElementById('div'+ may).style.backgroundColor='#333399'; 

//aparecer('cont.paso1.php'); 
}


}



function conbinar(){
if (ocupado()==1)
{
alert('No es posible ocupar esta region de la pagina, existe un espacio ocupado');
limpiarea();
return false;

}

men=9999;
may=0;
var tengo=parent.document.getElementById('cuadros');
ht=replaceAll(tengo.innerHTML,'[','');
ht=replaceAll(ht,']',',');
var losotros=ht.split(',');

for (i=0;i<=losotros.length;i++) {

if (parseInt(losotros[i])<men)  men=losotros[i];
if (parseInt(losotros[i])>may)  may=losotros[i];


}
//alert(men);
divselec=men;
tengo.innerHTML='';
xleft=parseInt(parent.document.getElementById('div'+men).style.left);
xtop=parseInt(parent.document.getElementById('div'+men).style.top) + 3;
xwidth= (parseInt(parent.document.getElementById('div'+may).style.width) + parseInt(parent.document.getElementById('div'+may).style.left) - xleft + 3);
xheight= (parseInt(parent.document.getElementById('div'+may).style.top) + parseInt(parent.document.getElementById('div'+may).style.height) - xtop + 3);

var xsum=Math.round(xwidth/38);
var ysum=Math.round( xheight /38);
var xytot=ysum*xsum;

//alert(xsum  + '-' + ysum + ' total= ' + xytot);

//alert(xleft + '-' + xtop +  '-' + xwidth +  '-' + xheight );



if (document.getElementById('dive'+men))
{
dive=document.getElementById('dive'+men);
dive.style.display = 'block';
dive.style.visibility='visible';

}else{
dive = document.createElement("div");
dive.id='dive'+men;
dive.title='Cuadro ' + men;
document.getElementById('Layerx').appendChild(dive);
dive.style.backgroundColor='#ff0000'; 


}
dive.onmouseup=eligearea;

	dive.style.position='absolute';
    dive.className='linea_fina';
    dive.style.left= (parseInt(xleft) + 4) + 'px';
	dive.style.top= (parseInt(xtop) + 2) + 'px';
	dive.style.width=parseInt(xwidth - 2) + 'px';
	dive.style.height=parseInt(xheight) + 'px';
    



var xdesdex=(parseInt(men));
var xhastax=(parseInt(men)+ parseInt(xsum)-1);
var xhastay=Math.round((parseInt(may)+ parseInt(ysum))/25);

//alert(xsum + '- ' +  ysum + '- ' + xhastax + ' =' + Math.round((parseInt(may)+ parseInt(ysum))));
for (i=0;i<parseInt(ysum);i++) {

//alert('x=' + parent.document.getElementById('div'+i).id);	

for (o=(xdesdex + (25*i));o<=(xhastax + (25*i));o++) {


parent.document.getElementById('div'+o).onmousedown='';
parent.document.getElementById('div'+o).innerHTML='';

}

}
//alert(xdesdex);
parent.document.getElementById('dive'+xdesdex).innerHTML='Reservado='+men;





}


function eligearea(){

divselec=parseInt(this.id.replace('dive',''));

}
function ocupado(){

men=9999;
may=0;
var tengo=parent.document.getElementById('cuadros');
ht=replaceAll(tengo.innerHTML,'[','');
ht=replaceAll(ht,']',',');
var losotros=ht.split(',');

for (i=0;i<=losotros.length;i++) {

if (parseInt(losotros[i])<men)  men=losotros[i];
if (parseInt(losotros[i])>may)  may=losotros[i];


}

xleftx=parseInt(parent.document.getElementById('div'+men).style.left);
xtopx=parseInt(parent.document.getElementById('div'+men).style.top) + 5;
xwidthx= (parseInt(parent.document.getElementById('div'+may).style.width) + parseInt(parent.document.getElementById('div'+may).style.left) - xleftx + 5);
xheightx= (parseInt(parent.document.getElementById('div'+may).style.top) + parseInt(parent.document.getElementById('div'+may).style.height) -xtopx + 5);

var xsum=Math.round(xwidthx/35);
var ysum=Math.round( xheightx/35);
var xytot=ysum*xsum;
//alert(xsum  + '-' + ysum + ' total= ' + xytot);

//alert(xleftx + '-' + xtopx +  '-' + xwidthx +  '-' + xheightx );






var xdesdex=(parseInt(men));
var xhastax=(parseInt(men)+ parseInt(xsum)-1);
var xhastay=Math.round((parseInt(may)+ parseInt(ysum)-1)/25)-1;
hay=0;
//alert(xhastay);
for (i=0;i<parseInt(ysum);i++) {


for (o=(xdesdex + (25*i));o<=(xhastax + (25*i));o++) {

//alert('x=' + parent.document.getElementById('div'+o).id);


var elements = parent.document.getElementById('div'+o).getElementsByTagName('img');
if (elements.length>0 ) 
{ 
//alert(parent.document.getElementById('div'+o).id);

hay=1;
break;
}


}

}
return hay;
}

function limpiarea(){

//men=1024;
//may=0;
var tengo=parent.document.getElementById('cuadros');
ht=replaceAll(tengo.innerHTML,'[','');
ht=replaceAll(ht,']',',');
var losotros=ht.split(',');
tengo.innerHTML='';

for (i=0;i<=losotros.length;i++) {

parent.document.getElementById('div'+parseInt(losotros[i])).onmouseup=aler;
parent.document.getElementById('div'+parseInt(losotros[i])).style.backgroundColor='#FFFFFF'; 

parent.document.getElementById('div'+parseInt(losotros[i])).innerHTML='<div id="Layer2" style="position:absolute; left:0px; top:30%; width:100%; height:17px; z-index:2"> <div align="center">' + parseInt(losotros[i]) + '</div></div>';



}



}

function replaceAll( text, busca, reemplaza ){ 

   while (text.toString().indexOf(busca) != -1) 

       text = text.toString().replace(busca,reemplaza); 

   return text; 

 } 


function grabaimagen(){


var pos=divselec;
var dive = document.getElementById('dive' + pos)
xwidth= parseInt(dive.style.width + 3);
xheight= parseInt(dive.style.height + 3);

var xsum=Math.round(xwidth/38);
var ysum=Math.round( xheight/38);
var xytot=ysum*xsum;
var xdesdex=(parseInt(pos));
var xhastax=(parseInt(pos)+ parseInt(xsum)-1);
var xfinal=0;
for (i=0;i<parseInt(ysum);i++) {


for (o=(xdesdex + (25*i));o<=(xhastax + (25*i));o++) {
xfinal=o;
}


}
//alert(parent.document.getElementById('ima' + pos).src);
lafotoes=parent.document.getElementById('ima' + pos).src;
lafotoes=lafotoes.substring(lafotoes.lastIndexOf("/")+1, lafotoes.length)


if (xytot==1)
return xdesdex+','+xdesdex+','+lafotoes;
else return xdesdex+','+xfinal+','+lafotoes;
}

function totalcuadros(){

men=9999;
may=0;
var tengo=parent.document.getElementById('cuadros');
ht=replaceAll(tengo.innerHTML,'[','');
ht=replaceAll(ht,']',',');
var losotros=ht.split(',');
for (i=0;i<=losotros.length;i++) {

if (parseInt(losotros[i])<men)  men=losotros[i];
if (parseInt(losotros[i])>may)  may=losotros[i];


}

xleftx=parseInt(parent.document.getElementById('div'+men).style.left);
xtopx=parseInt(parent.document.getElementById('div'+men).style.top) + 5;

xwidthx= (parseInt(parent.document.getElementById('div'+may).style.width) + parseInt(parent.document.getElementById('div'+may).style.left) - xleftx + 5);
xheightx= (parseInt(parent.document.getElementById('div'+may).style.top) + parseInt(parent.document.getElementById('div'+may).style.height) -xtopx + 5);
var xsum=Math.round(xwidthx/35);
var ysum=Math.round( xheightx/35);
var xytot=ysum*xsum;
parent.document.getElementById('tcuadros').innerHTML=' Son desde el cuadro ' + men + ' hasta ' + may + '='  + xytot + ' cuadros x ' + 10000 + ' pesos = ' +  (xytot*10000) + ' pesos';


if  (losotros.length>2){

aparecer('cont.paso1.php'); 
}




}

function muestrar(){

var padre=this.parentNode;
//alert(parseInt(padre.id.replace('dive','')));
//alert(document.getElementById('sombra' + padre.id).id);
document.getElementById('sombra' + padre.id.replace('dive','')).style.visibility='visible';

}
function ocultarr(obj){

var padre=this.parentNode;
alert (document.getElementById('sombra' + padre.id.replace('dive','')).onMouseOut)
if (document.getElementById('sombra' + padre.id.replace('dive','')).style.visibility=='visible') return false;
//alert(parseInt(padre.id.replace('dive','')));
//alert(document.getElementById('sombra' + padre.id).id);
document.getElementById('sombra' + padre.id.replace('dive','')).style.visibility='hidden';
}

function alto(cual){
//alert(cual);
var winH = 0;
var winW = 0;
if (document.body && document.body.offsetWidth) {
 winW = document.body.offsetWidth;
 winH = document.body.offsetHeight;
}
if (document.compatMode=='CSS1Compat' &&
    document.documentElement &&
    document.documentElement.offsetWidth ) {
 winW = document.documentElement.offsetWidth;
 winH = document.documentElement.offsetHeight;
}
if (window.innerWidth && window.innerHeight) {
 winW = window.innerWidth;
 winH = window.innerHeight;
}
if (cual=='y') return winH;
else if (cual=='x') return winW;

}

function dimensiona(cualobj){
var altoy=alto('y');
var altox=alto('x');

var dive=document.getElementById(cualobj);
dive.style.top=(altoy/2)-(ventanaactivay/2)+'px';
dive.style.left=(altox/2)-(ventanaactivax/2)+'px';

}

function menuover(obj){

obj.style.backgroundImage='url(ico/papeln.png)';
obj.style.color='#FFFFFF';
}
function menuout(obj){

obj.style.backgroundImage='';
obj.style.color='#000000';
}

function validacorreo(correo){
partedelarroba=correo.substring(correo.lastIndexOf('@'), correo.length);
//alert(partedelarroba + ' == '  + partedelarroba.indexOf('@'));
//alert(partedelarroba.substring(partedelarroba.lastIndexOf('.')+1, partedelarroba.length) + ' == '  + partedelarroba.substring(partedelarroba.lastIndexOf('.')+1, partedelarroba.length).length);


if (correo.split(' ').length > 1 || correo.indexOf('@')==-1 || correo.indexOf('@') != correo.lastIndexOf('@') || correo.replace(/^\s*|\s*$/g,"")=='' || partedelarroba.indexOf('@')==-1 || partedelarroba.substring(partedelarroba.lastIndexOf('.')+1, partedelarroba.length).length==0 || partedelarroba.lastIndexOf('.')==-1 )  {
		//document.getElementById('errornuevacuenta').style.visibility='visible';

return 0;
		
	}else {return 1;}
}
