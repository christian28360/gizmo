var Niv = '';
var TxtHtml = '';
var Txt = '';
var bulle_visible = false;    // La variable nous dit si la bulle est visible ou non
var i;

////////////////////////////////////////////////////////////////////////////////////
var IB=new Object;
var posX=0;
var posY=0;
var xOffset=10;
var yOffset=10;
var SiCookies = ( navigator.cookieEnabled );

window.onload = montre;

// gestion des cookies pour d�plier/plier les sous-menus
function getCookie(c_name) {
// alert("function getCookie"); utilis�e
var a,x,y,ARRcookies=document.cookie.split(";");
for (a=0; a<ARRcookies.length; a++)
  {
  x=ARRcookies[a].substr(0,ARRcookies[a].indexOf("="));
  y=ARRcookies[a].substr(ARRcookies[a].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x == c_name)
    {
    return unescape(y);
    }
  }
}

function setCookie(c_name,value,exdays) {
alert("function setCookie");
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;
}

function montre(id) {
// alert("function montre"); utilis�e
  if ( SiCookies )
  {
     var cooky = getCookie("smenu");          // lecture du dernier menu ouvert
  }
  var smenu = Left(id,5);
  if ( smenu == "smenu" )
  {                     // si appel fonction avec param�tre (click sur menu)
    var d = document.getElementById(id);
    if ( d.id != cooky ) {                     // on a un autre menu d'ouvert, on le ferme
       cache_smenu();
     }
    d.style.display='block';
    if ( SiCookies ) { setCookie ("smenu", id); }
  }
  else
  {                                      // on vient d'un reload, on rouvre le dernier menu ouvert
    if ( !SiCookies )
    {
       cache_smenu();
    }
    else if ( Left(cooky,5) == "smenu" )
    {
         document.getElementById(cooky).style.display='block';
    }
  }
}

// on masque tous les sous-menus sauf id en cours ou le cookie pos�
function cache_smenu() {
alert("function cache_smenu");
 for (var i = 0; i <= 9; i++) {
  if (document.getElementById('smenu'+i)) {
    document.getElementById('smenu'+i).style.display='none';
  }
 }
}

function Left(str, n){
// alert("function Left"); utilis�e
  if (n <= 0)
      return "";
  else if (n > String(str).length)
      return str;
  else
      return String(str).substring(0,n);
}
function Right(str, n){
alert("function Right");
    if (n <= 0)
       return "";
    else if (n > String(str).length)
       return str;
    else {
       var iLen = String(str).length;
       return String(str).substring(iLen, iLen - n);
    }
}
function AffBulle(texte) {
alert("function AffBulle");
  contenu="<TABLE border=0 cellspacing=0 cellpadding="+IB.NbPixel+"><TR bgcolor='"+IB.ColContour+"'><TD><TABLE border=0 cellpadding=2 cellspacing=0 bgcolor='"+IB.ColFond+"'><TR><TD><FONT size='-1' face='arial' color='"+IB.ColTexte+"'>"+texte+"</FONT></TD></TR></TABLE></TD></TR></TABLE> ";
  var finalPosX=posX-xOffset;
  if (finalPosX<0) finalPosX=0;
  if (document.layers) {
    document.layers["bulle"].document.write(contenu);
    document.layers["bulle"].document.close();
    document.layers["bulle"].top=posY+yOffset;
    document.layers["bulle"].left=finalPosX;
    document.layers["bulle"].visibility="show";
  }
  if (document.all) {
    //var f=window.event;
    //doc=document.body.scrollTop;
    bulle.innerHTML=contenu;
    document.all["bulle"].style.top=posY+yOffset;
    document.all["bulle"].style.left=finalPosX;//f.x-xOffset;
    document.all["bulle"].style.visibility="visible";
  }
  //modif CL 09/2001 - NS6 : celui-ci ne supporte plus document.layers mais document.getElementById
  else if (document.getElementById) {
    document.getElementById("bulle").innerHTML=contenu;
    document.getElementById("bulle").style.top=posY+yOffset;
    document.getElementById("bulle").style.left=finalPosX;
    document.getElementById("bulle").style.visibility="visible";
  }
}
function cache_info() {
// alert("function cache_info");   utilis�e
  document.getElementById("info").style.visibility = "hidden";
}
function montre_info() {
// alert("function montre_info");   utilis�e
  document.getElementById("info").style.visibility = "visible";
}
function actu() {
alert("function actu");
  document.getElementById("actu").style.visibility = "visible";
}
function getMousePos(e) {
// alert("function getMousePos");
  if (document.all) {
    posX=event.x+document.body.scrollLeft; //modifs CL 09/2001 - IE : regrouper l'�v�nement
    posY=event.y+document.body.scrollTop;
  }
  else {
    posX=e.pageX; //modifs CL 09/2001 - NS6 : celui-ci ne supporte pas e.x et e.y
    posY=e.pageY;
  }
}
function HideBulle() {
alert("function HideBulle");
  if (document.layers) {
    document.layers["bulle"].visibility="hide";
  }
  if (document.all) {
    document.all["bulle"].style.visibility="hidden";
  }
  else if (document.getElementById){
    document.getElementById("bulle").style.visibility="hidden";
  }
}

function InitBulle(ColTexte,ColFond,ColContour,NbPixel) {
alert("function InitBulle");
  IB.ColTexte=ColTexte;
  IB.ColFond=ColFond;
  IB.ColContour=ColContour;
  IB.NbPixel=NbPixel;
  if (document.layers) {
    window.captureEvents(Event.MOUSEMOVE);
    window.onMouseMove=getMousePos;
    document.write("<LAYER name='bulle' top=0 left=0 visibility='hide'></LAYER>");
  }
  if (document.all) {
    document.write("<DIV id='bulle' style='position:absolute;top:0;left:0;visibility:hidden'></DIV>");
    document.onmousemove=getMousePos;
  }
  //modif CL 09/2001 - NS6 : celui-ci ne supporte plus document.layers mais document.getElementById
  else if (document.getElementById) {
    document.onmousemove=getMousePos;
    document.write("<DIV id='bulle' style='position:absolute;top:0;left:0;visibility:hidden'></DIV>");
  }
}

/*********** Debut du script qui affiche la date en temps reel dans le statut de la fenetre  *****************/
function Affiche_Heure_Dans_Status() {
alert("function Affiche_Heure_Dans_Status");
  var JourSem = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'vendredi', 'Samedi' );
  var MoisAn = new Array('janvier', 'f�vrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'ao�t', 'septembre', 'octobre', 'novembre', 'd�cembre');
  var MaDate = new Date();
  var NoJourSem = MaDate.getDay() ;
  var Jour = MaDate.getDate();
  var NoMois = MaDate.getMonth();
  var An = MaDate.getFullYear();
  timer = 900000; //le timer c'est a dire le chrono est regle pour 1000 milisecondes c-a-d 1 seconde * 15 mn
  window.status = "Nous sommes le " + JourSem[NoJourSem] + " " + Jour + " " + MoisAn[NoMois] + " " + An ;
  setTimeout("Affiche_Heure_Dans_Status();",timer); // on regarde tous les 1/4 d'heure si on change de jour
}

function actu_voir(){
alert("function actu_voir");
  document.getElementById("test").style.visibility = 'visible';
  return;
  //-- Recup des Objets
  var O_Src  = document.getElementById('test').contentWindow.document.body;
  var O_Dest = document.getElementById('test');
  var szTmp  ='';
  //-- Lecture du contenu
  if( O_Src.textContent)
    szTmp = O_Src.textContent;
  //-- Cas IE
  else if (O_Src.innerText)
    szTmp = O_Src.innerText;
  //-- cas NetScape a part
  else if( O_Src.innerHTML)
    szTmp = O_Src.innerHTML;
  //-- Affectation dans TEXTAREA
  O_Dest.value = szTmp;
//alert (szTmp);
}

function GetId(id)
{
// alert("function GetId");   utilis�e
  return document.getElementById(id);
}

function move(e) {
//  alert("function move"); utilis�e
  if (i) {          // Si la bulle est visible, on calcule en temps reel sa position ideale
    if (navigator.appName != "Microsoft Internet Explorer") {   // Si on est pas sous IE
      GetId("actu").style.left = e.pageX+5+"px";
      GetId("actu").style.top = e.pageY+10+"px";
    }
    else { // Modif propos� par TeDeum, merci � lui
      if (document.documentElement.clientWidth > 0) {
        GetId("actu").style.left = 20+event.x+document.documentElement.scrollLeft+"px";
        GetId("actu").style.top = 10+event.y+document.documentElement.scrollTop+"px";
      }
      else {
        GetId("actu").style.left =20+event.x+document.body.scrollLeft+"px";
        GetId("actu").style.top =10+event.y+document.body.scrollTop+"px";
      }
    }
  }
}
function actualite(Message) {
//  alert("function actualite");   utilis�e
  // ICI ON METTRA LE TEXTE DE L'INFO BULLE A AFFICHER /
  if (Message == "actu")
  {
    var text = "";
    // red�finission du stype liste � puce pour l'info-bulle :
    text  = "<style>ul { margin: 0px;}";
    text += "li { margin: 0px 0px 0px 25px; list-style-type: circle; list-style-position: inside; padding-left: 0px; font-size: 10px; }";
    text += "</style>";
    text += "<b><span style='color: red;'>Bient�t :<br /> un moteur de recherche interne</span></b><hr />";
    text += "<b><u>Avril 2012</u></b>";
    text += "<ul><li>Nouveaut�s sur les cultures</li>";
    text += "<li>La philosophie du jardin naturel (acc�s par accueil)</li>";
    text += "</ul><hr />";
    text += "<b><u>Octobre/novembre 2011</u></b>";
    text += "<ul><li>Maladies et parasites</li></ul>";
    text += "<b><u>Juillet/ao�t/septembre</u></b>";
    text += "<ul><li>Nouvelle rubrique : <strong>Cultures</strong></li></ul>";
    text += "<b><u>Nouveaut�s d'avril</u></b>";
    text += "<ul><li>D�sherbage</li><li>Des recettes... pour vos plantes</li></ul>";
    text += "<hr /><b><u>25/12/2011 :</u></b>";
    text += "<ul><li>Des recettes pour les f�tes</li></ul>";
    text += "<hr><b><u>11/12/2010</u></b><p>Pr�parons la nouvelle ann�e :</p>";
    text += "<ul><li>Le calendrier des travaux du jardin</li></ul>";
    text += "<b><u>Ajout� le 05/12/2010</u></b>";
    text += "<ul><li>Jardinage biologique, la culture sauvage</li></ul>";
    text += "<b><u>Ajout du 13/11/2010</u></b>";
    text += "<ul><li>Tout ce que vous voulez savoir sur les sols</li></ul>";
    text += "<b><u>Ajout� le 11/11/2010</u></b>";
    text += "<ul><li>les traitements biologique</li>";
    text += "<li>liste des plantes sauvages avec renvoi sur l'article wikip�dia</li";
    text += "<li>Liste des \"mauvaises herbes\"</li></ul>";
    text += "<hr><b>A venir :</b><b>Un forum pour vos �changes</b>";
  }
  else if (Message == "bowling")
  {
    text = "<IMG style='float: left' width='50%' src='images/gest/bowler.jpg'><p>Vous allez �tre redirig� vers le site de mon club de bowling</p>";
  }
  else if (Message == "anne")
  {
    text = "<img style='float: left' width='50%' src='images/gest/collier.jpg' /><p>Le site d'une amie,<br />cr�atrice de bijoux fantaisie</p>";
  }
  else if (Message == "info_menu")
  {
  text = "<b><u>Navigation dans le menu</u></b><p>Click sur le bandeau vert (� c�t� d'un lien) d'un menu pour l'ouvrir</p><p>Clic sur le lien pour ouvir l'index d�taill� du th�me dans la page centrale</p>";
  }
  else if (Message == "info_exo")
  {
  text = "<p>Un site o� je vous propose quelques exercices simples et faciles pour garder une bonne forme,</p><p> Vous y trouverez �galement une s�ance d'�tirements � faire apr�s et/ou avant une pratique sportive</p>";
  }
  else if (Message == "info_bowling")
  {
  text = "<b>Que vous soyez d�butant ou joueur plus ou moins confirm�, je vous propose de d�couvrir le bowling et de progresser</p><p>Les conseils propos�s sont issus de sites universitaires am�ricains et sont en cours de traduction et d'adaptation</b>";
  }
  else
  {
    text = "<p>Message non d�fini</p>";
  }
  //<?PHP $file_actu = htmlentities(file_get_contents('actu.html'));
  //echo $file_actu; ?>
  //var text='<?php echo $file_actu;?>';
  if ( bulle_visible == false) {
    GetId(Message).style.visibility = "visible";  // S'il est cach� (la verif n'est qu'une securit�) on le rend visible.
    GetId(Message).innerHTML = text;  // Cette fonction est a am�liorer, il parait qu'elle n'est pas valide (mais elle marche)
    bulle_visible = true;
  }
}
function cache() {
// alert("function cache"); utilis�e
  if ( bulle_visible == true) {
    // Si la bulle etait visible on la cache
    GetId("actu").style.visibility = "hidden";
    GetId("bowling").style.visibility = "hidden";
    GetId("anne").style.visibility = "hidden";
    GetId("info").style.visibility = "hidden";
    GetId("info_menu").style.visibility = "hidden";
    GetId("info_exo").style.visibility = "hidden";
    GetId("info_bowling").style.visibility = "hidden";
    bulle_visible = false;
  }
}  

document.onmousemove = move;  // d�s que la souris bouge, on appelle la fonction move pour mettre a jour la position de la bulle.
document.onmouseout = cache;  // du moment kil e commun !!
