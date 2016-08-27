<?php 
require('compteurs_config.php');
// on se connecte � example.com et au port 3307
$link = @mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD);         // se connecter a la base de donnees, si possible

if (!$link)   //    die('Connexion impossible : ' . mysql_error());
{
  $BD_accessible = false;
}
else
{
  $BD_accessible = true;
// il y a deux tables :
// ousratic_online : liste les visiteurs qui sont en ligne
// ousratic_visitors : liste les visiteurs depuis la mise en marche du site   

mysql_select_db($DB_NAME); // la base de donn�e doit exister 

//-------------------------------------INSTALLATION DES TABLE------------------------------------
$qry = mysql_query("SELECT count(*) FROM ".$TABLE_VISITORS); 

if (!$qry)
{// creer la table TABLE_VISITORS
  print "\$qry = not vrai. \n";

  mysql_query("CREATE TABLE `".$TABLE_VISITORS."` (
  `session_id` varchar(32) NOT NULL default '',
  `ip_adress` varchar(15) NOT NULL default '',
  `entry_time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`session_id`)) ");
}
$qry = mysql_query("SELECT count(*) FROM ".$TABLE_ONLINE);  
if (!$qry)
{// creer la table TABLE_ONLINE
mysql_query("CREATE TABLE `".$TABLE_ONLINE."` (
  `session_id` varchar(32) NOT NULL default '',
  `ip_adress` varchar(15) NOT NULL default '',
  `expiry` int(11) NOT NULL default '0',
   PRIMARY KEY  (`session_id`))");
}
//----------------------------------FIN INSTALLATION DES TABLE------------------------------------

$now = time();

// supprimer toutes les sessions p�rim�es de la base 
mysql_query("DELETE FROM ".$TABLE_ONLINE." WHERE expiry < ".$now);

$exist = false;
$qry= mysql_query("SELECT count(*) FROM ".$TABLE_ONLINE." WHERE session_id='".session_id()."'");

//echo mysql_result($qry,0,'count(*)');
//if (mysql_result($qry,0,'count(*)')) {$exist = true;}

$now +=3600;
if ($exist) {
mysql_query("UPDATE ".$TABLE_ONLINE." SET expiry=".$now." WHERE session_id='".session_id()."'");
}
else {
  $ip = get_ip();
  if ( !IsVisitorBot($ip) ) { // c'est un vrai visiteur, pas un moteur de recherche
       mysql_query("INSERT INTO ".$TABLE_ONLINE." (session_id, ip_adress, expiry) VALUES ('".session_id()."', '".$ip."', ".$now.")");
       mysql_query("INSERT INTO ".$TABLE_VISITORS." (session_id, ip_adress, entry_time) VALUES ('".session_id()."', '".$ip."', ".time().")");
  }
}
//-----faire les comptes------------------------------------
$qry = mysql_query("SELECT count(*) FROM ".$TABLE_ONLINE);
var_dump($qry);

$cpt_online = mysql_result($qry,0,'count(*)');        // compteur des visiteurs en ligne
$qry = mysql_query("SELECT count(*) FROM ".$TABLE_VISITORS);
$cpt_visitors = mysql_result($qry,0,'count(*)');      // compteur des visiteurs depuis la mise en marche du site
}
?>