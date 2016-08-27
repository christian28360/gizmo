<?php

function navi( $Precedent, $Prec_lib, $Home, $Suivant, $Suiv_lib) {
  $home    = '<a href="?page=accueil_gizmo"
               title="Retour à la page d\'accueil">Accueil
               </a>';
// on crée la table avec les boutons de navigation :
  echo("<table style='width: 90%; background: transparent; '>
               <tbody><tr><td align='left' width='300px'>&nbsp;");

// Flèche gauche
    if ( ! $Precedent == "" and ! $Prec_lib == "") {
      echo ( "<a href='?page=" . $Precedent . "'
                 title='" . $Prec_lib . "' />&lt;&lt;&nbsp;" . $Prec_lib . "</a>" );
    }

// Home
  echo( "</td><td align='center' width='50px'>" . $home . "</td>" );

// Flèche droite
  echo  ("<td align='right' width='300px'>&nbsp;");
  if ( !$Suivant == "" and !$Suiv_lib == "" ) {  // pas vide
     echo ("<a href='?page=" . $Suivant . "'
                  title='" . $Suiv_lib . "' />" . $Suiv_lib .
                  "&nbsp;&gt;&gt;</a>");
  }

// fin de navi
  echo("</td></tr></tbody></table>");
}
?>
