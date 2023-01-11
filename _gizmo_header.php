<!DOCTYPE html>
<html>

<head>
  <title>La vie trépidente de Gizmo le chat persan</title>

  <meta http-equiv="Expires" content="-1" />
  <meta name="Expires" content="never" />
  <meta name="Reply-To" content="Cricri-28@christian-alcon.comule.com" />
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> <!-- encodage français  -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <!-- encodage français  -->
  <meta http-equiv="content-language" content="fr" /> <!--  langue du site  -->
  <meta name="keywords" content="chat, chats, persan, persans, gizmo" />
  <meta name="description" content="La vie du chat persan Gizmo" /> <!--  Nombre maximum de caractères : 200  -->
  <meta name="category" content="chats, animaux, jardin, culture, nature" />
  <meta name="author" lang="fr" content="Christian Alcon" />
  <meta name="identifier-url" content="http://gizmo.alcon-christian.comule.com" />
  <meta name="robots" content="index, follow, all" />
  <!--  <meta name="GENERATOR" content="NotePad++ and RJ TextEd" /> -->
  <meta name="GENERATOR" content="NetBeans IDE 15" />

  <link rel="icon" type="image/x-icon" href="gest/chat-icone.png" />
  <link rel="shortcut icon" type="image/x-icon" href="gest/chat-icone.png" />

  <link type="text/css" rel="stylesheet" href="inc/gizmo.css" />

  <!-- Ajout de JQuery jquery.mb.components
  ~ Copyright (c) 2001-2010. Matteo Bicocchi (Pupunzi); Open lab srl, Firenze - Italy
  ~ email: mbicocchi@open-lab.com
  ~ site: http://pupunzi.com
  -->
  <link type="text/css" href="inc/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
  <script src="inc/jquery.js" type="text/javascript"></script>
  <script src="inc/jquery-ui.js" type="text/javascript"></script>

  <link type="text/css" media="all" href="inc/mbExtruder.css" rel="stylesheet" />
  <script type="text/javascript" src="inc/jquery.hoverIntent.min.js"></script>
  <script type="text/javascript" src="inc/jquery.metadata.js"></script>
  <script type="text/javascript" src="inc/jquery.mb.flipText.js"></script>
  <script type="text/javascript" src="inc/mbExtruder.js"></script>
  <!-- Mes fonctions JQuery -->
  <script type="text/javascript" language="Javascript" src="inc/gizmo.js"></script>

  <script type="text/javascript">
    $(function() // quand page chargée
      {
        // ajout d'un évènement sur toutes les images à agrandir (onclick ...)
        AjoutOnClick();
        menu(); // charge fonction mb.extruder pour affichage menu
        InitMenu(); // active les boutons pour afficher/masquer les sous-menus
      });
  </script>
</head>

<body>
  <!-- Table globale de tout le html fermée dans footer -->

  <div id="extruderLeft" class="{title:'Cliquez pour un accéder directement aux pages', url:('_gizmo_menu.html')}">
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

                  <script type="text/javascript" src="http://www.abcompteur.com/cpt/?code=5/46/10306/8/1&ID=572931"></script>
                  visiteurs depuis l'ouverture du site<br>
                  <?PHP
                  // On affiche un petit message de bienvenue et d'indication de dernière visite
                  if ($_SESSION['cookie'] == 'oui') {
                    if ($_SESSION[$site . '_visites_cptr']) {
                      $nombre           = $_SESSION[$site . '_visites_cptr'];
                      $visites_last     = $_SESSION[$site . '_visites_last'];
                      $visites_first    = $_SESSION[$site . '_visites_first'];
                      $Txt = "<b class='petitblocC'>Bonjour, ";
                      if ($nombre == 1) {
                        $Txt = $Txt . "nous sommes heureux de vous accueillir pour votre 1<sup>re</sup> visite, et vous souhaitons un bon surf !";
                      } else {
                        $Txt = $Txt . 'merci d\'être revenu nous voir. C\'est votre ' . number_format($nombre, 0, '', ' ') . '<sup>ème</sup> ';
                        $Txt = $Txt . 'visite depuis le ' . $visites_first;
                        $Txt = $Txt . ' (dernière fois le ' . $visites_last . ').';
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