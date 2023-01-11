<table class="calendrier">
<tr>
<td id="menu">
  <div style="margin: 0%; align: center; text-align: center;">
    <br><br><br>
    <font face='Verdana' size='3'>
      <b>ATTENTION :</b> <br />
      Le lien vers la page    "<i><?php echo $page_courante ?></i>"<br />
      est introuvable sur le serveur !<br />
      Veuillez nous en excusez.<br /><br />
      Ceci est une erreur ou elle est peut-être en cours de mise à jour<br />
      Essayez plus tard et si cela perdure, vous pouvez contacter
  <!--  LIEN VERS LA BOÏTE MAIL DU SITE  -->
<?PHP
    $dest = "Cricri-28@christian-alcon.comule.com";
    $mess = "Dans la page ".$page_precedante." le lien vers '".$page_courante."' est invalide. Merci de le corriger";
    echo "<a href='mailto:$dest?subject=Lien invalide dans $page_courante&body=$mess'>Le webmaster</a>";
?>
   </a> pour le signaler<br>
  Nous ferons notre possible pour rétablir la situation au plus tôt.<br><br>
<?php
  echo 'Vous pouvez revenir à la page où vous êtiez en cliquant ci dessous<br>
  <a title="Revenir à la page appelante" href="index.php?page='.$page_precedante.'">Retour à '.$page_precedante.'</a>';
?>
    </font>
    <br><br><br><br>
 </div>
 </td>
 </tr>
 </table>