<?php session_start();

require 'navi.php';

$site = "gizmo";

// fonctions de compteurs
include("_" . $site . "_fonctions.php");
include("compteurs.php");       // connexion � la base de donn�es

// Gestion des cookie et du d�marrage
include("_" . $site . "_cookies.php");

if ( $BD_accessible ) maj_compteur($site);

maj_navi($page_courante, $page_precedante);

include("templates/bandeau.html.twig");

if (isset($_GET['page'])) {
// si on vient d'une URL, on r�cup�re le nom pour l'afficher dans le corps de la page web
  $corps = $_GET['page'];
} else {
// si page n'est pas d�finie, alors on charge la page d'accueil
  $corps = "accueil_gizmo";
}

// on regarde si le fichier existe
// il peut porter une des extensions : php, php3, htm, html (dans cet ordre)
$ext = array(".php", ".php3", ".htm", ".html");

for ($i = 0; $i < 4; $i++) {
  if (file_exists($corps . $ext[$i])) {
    $corps = $corps . $ext[$i];
    $i = -1;
    break;
  }
}

// la page n'existe pas, on charge la page message 404 pour info et/ou action
if ($i != -1) {
  $page_courante = $corps;
  $corps = "_" . $site . "_404.php";
}

// enfin, on charge les diff�rents composants de la page
include "_" . $site . "_header.php";

echo "\n<table style='background: transparent;  width: 950px;' align='center' border='1'>\n";
echo "<tbody>\n<tr>\n";

//include "_" . $site . "_menu.php";            // menu dans la colonne de gauche

// corps de la page
echo "\n\n<!-- DEBUT DU CORPS : POUR REPERAGE LORS DE L'AFFICHAGE DU CODE SOURCE DANS LE NAVIGATEUR CLIENT  -->\n";
echo "\n<td id='corps'>\n<a name='Top'></a>\n";

include $corps;

echo "\n</td>\n</tr>\n</tbody>\n</table>";    // on ferme la balise de table

include "_" . $site . "_footer.php";         // pied (copyright, adresse ...)

?>
