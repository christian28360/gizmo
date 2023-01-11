<?php

$TABLE_ONLINE   = 'visiteurs_en_ligne';     // nom de la table des visiteurs en ligne
$TABLE_VISITORS = 'visiteurs_du_site';    // nom de la table des visiteurs du site
//------------------------------ADMINISTRATION-------------------------------
$ADMIN_USER     = 'sa';           // nom de l'administratieur
$ADMIN_PASSWORD = 'ezs824';     // mot de passe de l'administrateur

if (get_ip() == '127.0.0.1')
{  // on est en local
//**************************************************************************//
//                      Fichier des d�finitions des compteurs: connexion sur serveur local.           //
//*************************************************************************//
$DB_HOST    = '127.0.0.1';          // nom h�te de la base de donn�e
$DB_USER    = 'gizmo';               // nom d'utilisateur de la bdd
$DB_PASSWORD= 'gizmo';                   // mot de passe de la bdd
$DB_NAME    = 'gizmo';              // nom de la base de donn�e
$serveur_local = true;
$decalage   = 0;                      // d�calage horaire nul, on est � la maison
}
else
{  // on est en distant
//**************************************************************************//
//                      Fichier des definitions des compteurs : connexion sur serveur h�berg�,     //
//**************************************************************************//
$DB_HOST      = 'mysql17.000webhost.com'; // nom hote de la base de donnees
$DB_USER      = 'a6932404_user';          // nom d'utilisateur de la bdd
$DB_PASSWORD  = 'ezs824';                 // mot de passe de la bdd
$DB_NAME      = 'a6932404_stats';         // nom de la base de donnees
$serveur_local= false;
$decalage     = 21600;                        // si on est chez l'h�bergeur, r�cup. d�calage horaire 00webhost (6h)}
}

?>
