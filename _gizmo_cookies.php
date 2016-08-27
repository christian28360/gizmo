<?PHP
// 1�re arriv�e sur le site : on pose notre 1er cookie de session
   if ( ! isset ($_COOKIE[$site . '_visites_cptr'] ) ) unset($_SESSION['cookie']);
if ( !isset ($_SESSION['cookie']) )
{
    setcookie ('session', 'on');
    setcookie ('smenu', 'aucun');          // tous les smenus repli�s
    $_SESSION['cookie'] = 'oui';           // le navigateur g�re les cookies

// gestions des visites de l'utilisateur en cours
   // Il s'agit de la premi�re visite de notre Internaute sur notre site
   $nombre        = 1;
// $decalage est le d�calage horaire d�clar� et initialis� dans compteurs_config.php
   $visites_last  = date("d/m/Y � H:i", time() + $decalage );
   $visites_first = date("d/m/Y", time() + $decalage );
   $expire        = time() + ( 3600 * 24 * 365 * 10 );  // exipire dans 10 ans !
   if ( ! isset ($_COOKIE[$site . '_visites_cptr'] ) )
   // Il s'agit de la premi�re visite de notre Internaute sur notre site
   {
     setcookie($site . '_visites_cptr', 1, $expire );
     setcookie($site . '_visites_first', $visites_first, $expire );
     setcookie($site . '_visites_last', $visites_last, $expire );
   }
   else
   // Il s'agit d'un comeback de notre Internaute sur notre site
   {
     $nombre        = $_COOKIE[$site . '_visites_cptr'] +1;
     $visites_last  = $_COOKIE[$site . '_visites_last'];
     $visites_first = $_COOKIE[$site . '_visites_first'];
     setcookie($site . '_visites_cptr', $nombre, $expire );
     setcookie($site . '_visites_last', date("d/m/Y � H:i", time() + $decalage ), $expire );
   }
   $_SESSION[$site . '_visites_cptr']  = $nombre;
   $_SESSION[$site . '_visites_last']  = $visites_last;
   $_SESSION[$site . '_visites_first'] = $visites_first;
}
else
{
  if ( !isset ( $_SESSION['cookie'] ) || ( $_SESSION['cookie'] == 'non' ) )    // cookies non support�s car cookie 'session' non accessible
  {
     echo ('<script>alert("Votre navigateur ne supporte pas les cookies.\n\n\
            La navigation sur le site ne sera pas optimis�e\n\
            Vous pouvez les autoriseer uniquement pour ce site sans crainte\n\
            Nous ne collectons aucune donn�e personelle !");</script>');
     $_SESSION['cookie'] = 'non';      // le navigateur ne g�re pas les cookies
 }
}

?>