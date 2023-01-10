<?php

// rempli un tableau avec le calendrier des semis
// utilisation du parser XML
function AfficheCalendrierPlantes($fichier)
{
//d�finition des couleurs :
// types attendus
$s  = 'green';    // semis
$r  = 'orange';   // r�colte
$rs = 'red';      // r�colte ann�e suivante
$b  = 'white';    // rien : vide, espace ou blanc

 if ( !isset($fichier) || $fichier == '' ) $fichier = 'culture/calendrier_semis_recoltes.xml';

 if ( file_exists($fichier) )
    {
    $plantes = simplexml_load_file($fichier);   // on charge le fichier
    // affiche l'en-t�te du tableau
    echo "<table style='width: 550px; align: center;'>";
    LigneTete("L�gume");
    // lignes d�tail contenue dans le fichier xml :
    foreach($plantes->plante as $plante) {
      $j = -1;
      echo '<tr>';
      echo '<th class="haut" rowspan="2" style="text-align: right;"><b>' . utf8_decode($plante->nom) . '</b></th>';
      foreach($plante->children() as $nom=>$elem) {
        // 12 mois de semis et 12 mois de r�coltes
        $i = 0; $j++;
        foreach($elem->children() as $e) {
          $i++;
          $t = strtolower(utf8_decode($e));
          // on met la couleur du fond en fonction du contenu (voir plus haut)
          $balise = '<td class="calend ';  // d�but balise td
          // on met un trait sur le haut du <tr>
          $balise = ( $j == 1 ) ? $balise . 'haut ' : $balise . '';
          switch ($t) {
            case "s":
              $balise = $balise . $s;
              break;
            case 'r':   // plantation/repiquage
              $balise = $balise . $r;
              break;
            case 'rs':     // r�colte
              $balise = $balise . $rs;
              break;
            case 'f':     // floraison
              $balise = $balise . $f;
              break;
            case 'b':
              $balise = $balise . $b;
              break;
            default :
              $balise = $balise . $b;
              break;
            }
          $balise = $balise . '">&nbsp;</td>';
          echo $balise;
          echo ( $i > 11 ) ? '</tr><tr>' : '';
        }
      }
      echo '</tr>';
    }
    LigneTete("L�gume");
    // on ferme le tableau
    echo "</tr>";
    echo "</table>";
    }
 else
 {
   exit('Echec lors de l\'ouverture du fichier : ' .$fichier . '.');
 }
// end function CalendrierSemis()
}

//
function LigneTete($Plante) {
echo("<tr>");
echo("<th width=30% class=FondNoir>". $Plante . "</th>");
echo("<th class='FondNoir'>J</th>");
echo("<th class='FondNoir'>F</th>");
echo("<th class='FondNoir'>M</th>");
echo("<th class='FondNoir'>A</th>");
echo("<th class='FondNoir'>M</th>");
echo("<th class='FondNoir'>J</th>");
echo("<th class='FondNoir'>J</th>");
echo("<th class='FondNoir'>A</th>");
echo("<th class='FondNoir'>S</th>");
echo("<th class='FondNoir'>O</th>");
echo("<th class='FondNoir'>N</th>");
echo("<th class='FondNoir'>D</th>");
echo("</tr>");
}

// renseigne la pop up avec les infos des nouvelles actualit�s
// utilisation du parser XML
function InfosPopup($fichier)
{
 if (file_exists($fichier)) {
    $rubriques = simplexml_load_file($fichier);   // on charge le fichier
    foreach($rubriques->rubrique as $rubrique) {
        echo '<b>' . $rubrique->titre. '</b>';
        echo '<p>' . utf8_decode($rubrique->contenu).'</p>';
        echo '<hr />';
    }
    return;
 }
 else
 {
    exit('Echec lors de l\'ouverture du fichier' .$fichier . '.');
 }
// end function infos_popup()
}

// renvoie les infos sur le navigateur
function getBrowser()
{
    $u_agent  = $_SERVER['HTTP_USER_AGENT'];
    $bname    = 'Non reconnu';
    $platform = 'Inconnu';
    $version  = "Inconnue";
    $moteur   = "Inconnue";
    $ub       = "inconnu";
// First get the platform ?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'Linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'Mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'Windows';
    }
// Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
// finally get the correct version number
//echo "variable u_agent : " . $u_agent;
//    $known = array('Version', $ub, 'other');
//echo "<BR>array(version) : " . $known;
//    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
//    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
//    }
// see how many we have
//   if ( $ub != "inconnu" )  // navigateur dans la liste, recherche version
//   {
//      $i = count($matches['browser']);
//      if ($i != 1) {
//        //we will have two since we are not using 'other' argument yet
//        //see if version is before or after the name
//        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
//            $version = $matches['version'][0];
//        }
//        else {
//            $version = $matches['version'][1];
//            }
//        }
//        else {
//             $version = $matches['version'][0];
//             }
//    }
// check if we have a number
    if ($version==null || $version=="") {$version="non d�tect�e";}
// recherche moteur de navigation
   $liste_moteurs = array("Electa", "KHTML", "webkit", "Gecko", "Presto", "Trident");
   foreach ( $liste_moteurs as $m )
   {
    if ( preg_match('/' . $m . '/i', $u_agent) ) $moteur = $m;
   }
// c'est fini, on retourne les r�sultats   
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
//        'pattern'   => $pattern,
        'moteur'    => $moteur,
        'ip'        => get_ip()
    );
}

// fonction qui renvoie l'adresse IP du visiteur
function get_ip() {
  if($_SERVER) {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//    $port = $_SERVER['REMOTE_PORT'];  on ne recup�re pas le port car il change � chaque fois que l'on fait F5
    elseif (isset($_SERVER['HTTP_CLIENT_IP']))
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    else 
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  else {
    if(getenv('HTTP_X_FORWARDED_FOR'))
      $ip = getenv('HTTP_X_FORWARDED_FOR');
    elseif(getenv('HTTP_CLIENT_IP'))
     $ip = getenv('HTTP_CLIENT_IP');
    else
     $ip = getenv('REMOTE_ADDR');
  }
  return $ip;
}
// renvoie les donn�es de navigation
function maj_navi(&$page_courante, &$page_precedante) {
  (isset($_SERVER['HTTP_REFERER'])) ? $URL = $_SERVER['HTTP_REFERER'] : $URL = '';
  if(empty($URL))
  {   $page = 'accueil';  }
  else
  {
  $page = parse_url($URL);
  if (isset($page['query'])) parse_str($page['query']);
  $page_precedante = $page;
  var_dump($_SERVER['QUERY_STRING']);
  parse_str($_SERVER['QUERY_STRING'],$qrystring);
  var_dump($qrystring);
  $page_courante = $page;
  }
//  echo 'page precedente '.$page_precedante.' / page courante '.$page_courante.'<br>';
  return ;
}
function maj_compteur($site){
// connexion � la base de donn�es
  include ("compteurs_config.php");   // on charge les param�tres de connexion
  $db = mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD);
  mysql_select_db($DB_NAME,$db);
  // Comptage du nombre d'entr�es dont le champ "ip" est l'adresse ip du visiteur 
  $ip = get_ip();

  // si le visiteur est un moteur de recherche, on ne le comptabilise pas :
  if ( IsVisitorBot($ip) ) return;

  // sinon, on continue les traitements
  $tmp = "SELECT COUNT(*) AS qte_ip FROM " . $TABLE_ONLINE . " WHERE ip_adress='" . $ip . "'";
  $retour = mysql_query($tmp) or die(mysql_error());
  $donnees = mysql_fetch_array($retour);

  if ($donnees['qte_ip'] == 0)         // Si l'ip est introuvable on la rajoute
  {
      mysql_query("INSERT INTO " . $TABLE_ONLINE . " VALUES('" . $ip . "', '" . time() . "')");
  }
  else // Si l'ip existe on fait simplement une mise � jour
  {
  mysql_query("UPDATE " . $TABLE_ONLINE . " SET duree='" . time() . "' WHERE ip='" . $ip . "'");
  }

  //Suppression du visiteur si le timestamp date de 3 minutes 
    // On enregistre le temps �coul� par le visiteur
  $timestamp_3min = time() - (60 * 3);      // 60 * 3 = Nbr secondes dans 3 minutes (la fonction time() est en secondes)
  mysql_query("DELETE FROM " . $TABLE_ONLINE . " WHERE duree < '" . $timestamp_3min);
  
  // Nombre de visiteurs connect�es   
  // Comptage du nombre d'ip
  $retour = mysql_query("SELECT COUNT(*) AS qte_ip FROM " . $TABLE_ONLINE);
  $donnees = mysql_fetch_array($retour);
  
  // Affichage du  Nombre de visiteurs connect�es
  if ( $donnees['qte_ip'] > 1 ) { $s = "s"; } else { $s = ""; }
}

/*
J'ai d�velopp� cette source afin d'�viter de compter les visites des robots dans mes compteurs de visites/visiteurs/t�l�chargements.
Cette fonction renvoie true si le visiteur est un robot d'un moteur de recherche. L'analyse se fait sur l'adresse IP du visiteur, donc si l'adresse IP d'un des robot vient � changer le script sera inefficace, c'est pourquoi il faut penser � maintenir � jour la liste des adresses IP (tous les 6 mois je pense)
La liste que j'ai r�cup�r�e vient d'ici :
http://www.actulab.com/identification-des-robots.php
(un peu vieille, je sais pas si certaines adresses ont chang�es, si vous savez pr�cisez le, merci ;) 
*/
// Renvoie TRUE si le visiteur de la page est un robot d'un moteur de recherche
function IsVisitorBot($ip) {
  // Tableau des adresses ip des principaux robots
  $IPtab[] = '62.119.21.157';   // picsearch
  $IPtab[] = '62.212.117.198';  // Deepindex
  $IPtab[] = '64.241.242.177';  // Wisenut
  $IPtab[] = '64.241.243.65';   // Wisenut
  $IPtab[] = '65.54.188.';      // MSN Bot
  $IPtab[] = '65.214.36.';       // Teoma
  $IPtab[] = '65.214.38.10';    // Teoma
  $IPtab[] = '66.77.73.';       // Fast
  $IPtab[] = '66.196.';         // Yahoo
  $IPtab[] = '66.237.60.22';    // Openfind
  $IPtab[] = '66.249.';         // Googlebot
  $IPtab[] = '68.142.';         // Yahoo
  $IPtab[] = '193.218.115.6';   // Szukacz
  $IPtab[] = '195.101.94.';     // Voila
  $IPtab[] = '207.68.146.';     // MSN Bot
  $IPtab[] = '209.249.67.1';    // Wisenut
  $IPtab[] = '210.59.144.149';  // Openfind
  $IPtab[] = '212.127.141.180'; // Whalhello
  $IPtab[] = '213.73.184.';     // Whalhello
  $IPtab[] = '216.243.113.1';   // Gigablast
  $IPtab[] = '217.205.60.225';  // Mirago
  $IPtab[] = '218.145.25.';     // Naver
  // V�rifie chaque adresse
  if(isset($ip)) {
    $nb = count($IPtab);
    for($t = 0; $t < $nb; $t++) {
      if (strpos($ip, $IPtab[$t]) === 0)
      {  return true; }
    }
  }
  return false;
}

//  pr�pare la popup d'actualit�s
// g�n�re le code script pour pr�parer l'info bulle
function actu() {
$file_actu = htmlentities(file_get_contents('actu.html'));
//echo "\n<script language=\"javascript\">\n";
}
function VoirBaliseH1()  {
 foreach (getallheaders() as $name => $value) {
    echo "$name:$value\n"."<br>";
  echo "<br>";
  }
}

?>
