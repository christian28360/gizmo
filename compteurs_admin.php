<?php include("compteurs_config.php"); ?>
<?php 
if ((isset($_POST['password']))&&(isset($_POST['user'])))
{
$_SESSION['admin_user'] = $_POST['user'];
$_SESSION['admin_password'] = $_POST['password'];
}
if ((isset($_SESSION['admin_password'])) &&
  (isset($_SESSION['admin_user'])) &&
  ($_SESSION['admin_password'] == $ADMIN_PASSWORD) &&
  ($_SESSION['admin_user'] == $ADMIN_USER))
{
?>
<table style="width: 98%;">
  <tr style="width: 50%;">
    <td rowspan="2">
    <table  style="width: 95%">
      <tr>
        <td colspan="3" class="Style10">Liste des visiteurs </td>
      </tr>
      <tr>
        <td height="10" colspan="3">
    <?php
    mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD);    // se connecter à la base de données
    mysql_select_db ($DB_NAME);               // la base de donnée doit exister 
    $count = mysql_result($qry,0,'count(*)') or die(mysql_error);   // compteur des visiteurs depuis la mise en marche du site
// on n'affiche que les 500 derniers (LIMIT 0 , 500")
    $qry = mysql_query("SELECT * FROM " . $TABLE_VISITORS. " ORDER BY entry_time DESC LIMIT 0 , 500");
    ?>
    </td>
      </tr>
      <tr bgcolor="#FFCC00">
        <td width="179"><div align="center" class="Style7">IP du visiteur</div></td>
        <td width="295"><div align="center" class="Style7">Date d'entr&eacute;e </div></td>
        <td width="112"><div align="center" class="Style7">En ligne </div></td>
      </tr>
  </table>
  <div style="height: 850px; overflow: auto;">
  <table  style="width: 95%">
  <?php 
  $cpt = 0;
  $on_line = 0;
  while ($row = mysql_fetch_array($qry))
  {
  $ip = $row['ip_adress'];    // récupère la valeur du champ 'ip'
  $date = date("d/m/Y H:i:s",$row['entry_time'] + $decalage );
  $res = mysql_query("SELECT count(*) FROM ".$TABLE_ONLINE." WHERE session_id='".$row['session_id']."'");

  if ( mysql_result($res,0,'count(*)'))
  {$online = '<IMG src="images/gest/on_line.gif" style="margin: 0px;">';
   $on_line++;}
  else
  {$online = '<IMG src="images/gest/off_line.gif" style="margin: 0px;">';} 
  
  ($cpt % 2) ? $bg = '<tr bgcolor="#FFFFCC">' : $bg = '<tr>';
  echo $bg; ?>
    <td height="10px" width="40%" class="Style12"><?php echo $ip; ?></td>
    <td class="Style12" width="38%" ><?php echo $date; ?></td>
    <td align='center' width="12%" ><?php echo $online; ?></td>
   </tr>
 <?php 
 $cpt++;
  }
  ?>
  </table>
   </td>
  
  </tr>
  <tr style="width: 50%;">
    <td valign="top">
  <table border="1" style='width: 50%'>
      <tr>
        <td colspan=7 align=left width="50%" class="Style12">
      <?php
      echo '<span class="Style12">&nbsp;Nombre total de visiteurs : '.$count.'</span></td></tr>';
      echo '<td colspan=7 align=left width="366" class="Style12">';
      echo '<span class="Style12">&nbsp;actuellement connectés   : '.$on_line.' </span></td></tr>';
      ?>
    </td>
        <td colspan=7 align=center width="50%" bgcolor="#006699" class="Style14">
      Graphe des visiteurs de la semaine (j-7 à aujourd'hui)
    </td>
      </tr>
      <tr bgcolor="#006699" class="Style14">
  <?php
    // faire le compte des visiteurs de la semaine
      $aujourdhui = getdate();
      $liste = array();
      for ($i=0;$i<7;$i++)
      {
      $d1 = mktime(0,0,0,$aujourdhui['mon'],$aujourdhui['mday']-$i,$aujourdhui['year']);  // aujourd'hui, puis hier ...
      $d2 = mktime(0,0,0,$aujourdhui['mon'],$aujourdhui['mday']+1-$i,$aujourdhui['year']);  // hier, puis avant-hier ...
      
      $res = mysql_query("SELECT count(*) FROM ".$TABLE_VISITORS." WHERE (entry_time > ".$d1.") AND (entry_time <= ".$d2.")");
      $cpt = mysql_result($res,0,'count(*)');   // avoir le nombre de visiteur du jour $d1
      $liste[$i] = $cpt;
      }
    // savoir le jour de la semaine actuel 
      $first = $aujourdhui['wday'];
      $jours_tab = array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Sam');
  ?>
  <?php
    // on remplit le tableau de la semaine : 
      // départ = demain  à dimanche
      for ($i=$first+1;$i<7;$i++)  { echo '<td width="14%" align="center">'.$jours_tab[$i].'</td>'; }
      // affiche jour 0 à aujourd'hui
      for ($i=0;$i<=$first;$i++)  { echo '<td width="14%" align="center">'.$jours_tab[$i].'</td>'; }
      echo "</tr><tr>";
      for ($i=6;$i>=0;$i--)  { echo "<td align='center'>".$liste[$i]."</td>"; }
 ?>
      </tr>
<?PHP
// affiche un comptage par IP, désactivé, trop gourmand en ressources//      echo '<tr>';
//      echo '<th colspan="3">Adresse IP</th>';
//      echo '<th colspan="4">Nbre connexions</th>';
//      echo '</tr>';
// limite à changer plus tard
//   $rqSQL = 'SELECT ip_adress, count(*) as "Nbre" FROM ' . $TABLE_VISITORS;
//   $rqSQL = $rqSQL . ' GROUP BY ip_adress LIMIT 0 , 50';
//   $qry = mysql_query( $rqSQL );
//  while ($row = mysql_fetch_array($qry))
//  {
//    $ip = $row['ip_adress'];    // récupère la valeur du champ 'ip'
//    $Nb = $row['Nbre'];         // récupère la valeur du champ comptage
    // affichage
//    echo '<td colspan="3">&nbsp;' . $ip . '&nbsp;</td>';
//    echo '<td colspan="4">&nbsp;' . $Nb . '&nbsp;</td>';
//    echo '</tr><tr>';
//  }
?>
      </tr>
    </table>
    </td>
  </tr>
</table>
<?php
     }
     else {
?>
<table border="1" align="center" style='width: 50%'>
  <tr>
    <td width="347" class="Style7">
<?php
  if (isset($_POST['user'])){
?>
  <span class="Style15"> Informations de connexion incorrectes  </span> <?php }?>
  <br>
    Veuillez saisir vos informations de connexion afin de pouvoir accéder &agrave; l'administration</td>
  </tr>
  <tr>
    <td>
    <form name="form1" method="post" action="index.php?page=compteurs_admin">
      <span class="Style12"> Nom d'utilisateur</span>
      <input type="text" name="user">
      <br>
      <span class="Style12">Mot de passe</span>
      <input type="password" name="password">
      <br>
      <input type="submit" name="Submit" value="Envoyer" style="font-size:9px">
      </form>
  </td>
  </tr>
</table>
<?php
  }
?>