<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>La vie tr�pidente de Gizmo le chat persan</title>

  <meta http-equiv="Expires" content="-1" />
  <meta name="Expires" content="never" />
  <meta name="Reply-To" content="Cricri-28@christian-alcon.comule.com" />
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  <!-- encodage fran�ais  -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />  <!-- encodage fran�ais  -->
  <meta http-equiv="content-language" content="fr" />             <!--  langue du site  -->
  <meta name="keywords" content="chat, chats, persan, persans, gizmo" />
  <meta name="description" content="La vie du chat persan Gizmo" /> <!--  Nombre maximum de caract�res : 200  -->
  <meta name="category" content="jardin, culture, nature" />
  <meta name="author" lang="fr" content="Christian Alcon" />
  <meta name="identifier-url" content="http://gizmo.alcon-christian.comule.com" />
  <meta name="robots" content="index, follow, all" />
<!--  <meta name="GENERATOR" content="NotePad++ and RJ TextEd" /> -->
  <meta name="GENERATOR" content="NetBeans IDE 6.9.1" />

  <link rel="icon" type="image/x-icon" href="gest/chat-icone.png" />
  <link rel="shortcut icon" type="image/x-icon" href="gest/chat-icone.png" />

  <link type="text/css" rel="stylesheet" href="inc/gizmo.css" />

  <?PHP // Ajout de JQuery components ?>
  <link type="text/css" href="inc/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
  <script src="inc/jquery.js" type="text/javascript" ></script>
  <script src="inc/jquery-ui.js" type="text/javascript" ></script>

  <?PHP /*
  ~ jquery.mb.components
  ~ Copyright (c) 2001-2010. Matteo Bicocchi (Pupunzi); Open lab srl, Firenze - Italy
  ~ email: mbicocchi@open-lab.com
  ~ site: http://pupunzi.com
  */ ?>
  <link   type="text/css" media="all" href="inc/mbExtruder.css" rel="stylesheet" />
  <script type="text/javascript" src="inc/jquery.hoverIntent.min.js"></script>
  <script type="text/javascript" src="inc/jquery.metadata.js"></script>
  <script type="text/javascript" src="inc/jquery.mb.flipText.js"></script>
  <script type="text/javascript" src="inc/mbExtruder.js"></script>
  <!-- Mes fonctions JQuery -->
  <script type="text/javascript" language="Javascript" src="inc/gizmo.js"></script>

  <script type="text/javascript">
    $(function()  // quand page charg�e
    {
      // ajout d'un �v�nement sur toutes les images � agrandir (onclick ...)
      AjoutOnClick();
      menu();           // charge fonction mb.extruder pour affichage menu
      InitMenu();       // active les boutons pour afficher/masquer les sous-menus
    });
  </script>
</head>

<body>
<!-- Table globale de tout le html ferm�e dans footer -->

<div id="extruderLeft"
     class="{title:'Cliquez pour un acc�der directement aux pages', url:('_gizmo_menu.html')}">
</div>
<table>
 <tbody>
  <tr>
   <td>
 <!-- table globale de l'en-t�te -->
<table class="header">
<tbody>
 <tr>
  <td class="entete">
  <div class="titre">
  <div class="imageG transparent">
     <img title="img" src="images/2011/_small_portrait_2011-12_1.jpg" />
  </div>
  <h2 style="margin: 0px;">Suivez la vie de Gizmo le chat persan</h2>
  </div>
  <!--  pseudo image pour activation si agrandissement, la source est mise � jour dans le script -->
  <img id="Agrandir" style="display: none;" title="full size" src="" />

<?PHP
if  ($BD_accessible) {
// base de donn�es accessible : 
($cpt_visitors) > 1 ? $s = '�me' : $s = 'er';
echo "Vous �tes le " . number_format($cpt_visitors, 0, '', ' ') . "<sup>" . $s . "</sup> visiteur / ";
$cpt_online = ( $cpt_online == 1 ) ? "seul" : $cpt_online;
 echo "Vous �tes actuellement ". $cpt_online . " en ligne";
}
else {
// base de donn�es inaccessible, on utilise un site ami : 
echo '<script type="text/javascript" src="http://www.abcompteur.com/cpt/?code=5/46/10306/8/1&ID=572931">
    </script>
    visiteurs depuis l\'ouverture du site<br>
    <noscript>
    <a href="http://www.abcompteur.com/">Compteur indisponible, votre navigateur n\'accepte pas les scripts)';
echo '</noscript>';
}
?>
<?PHP
// On affiche un petit message de bienvenue et d'indication de derni�re visite
       if ( $_SESSION['cookie'] == 'oui' )
       {
           if ( $_SESSION[$site . '_visites_cptr'] ) {
              $nombre           = $_SESSION[$site . '_visites_cptr'];
              $visites_last     = $_SESSION[$site . '_visites_last'];
              $visites_first    = $_SESSION[$site . '_visites_first'];
              $Txt = "<b class='petitblocC'>Bonjour, ";
              if ( $nombre == 1 ) {
                 $Txt = $Txt . "nous sommes heureux de vous accueillir pour votre 1<sup>re</sup> visite, et vous souhaitons un bon surf !";
              }
              else {
                   $Txt = $Txt . 'merci d\'�tre revenu nous voir. C\'est votre ' . number_format($nombre, 0, '', ' ') . '<sup>�me</sup> ';
                   $Txt = $Txt . 'visite depuis le ' . $visites_first;
                   $Txt = $Txt . ' (derni�re fois le ' . $visites_last . ').';
              }
              echo $Txt . "</b>";
           }
       }
?>
   <br />Voir aussi </span>
   <a class="externe" href="http://anaisanaisduclosdichy.blogspot.fr/" target="_blank">
      Le blog de l'�levage dont je suis issu
   </a>
 </td>
 </tr>
</tbody>
</table>
