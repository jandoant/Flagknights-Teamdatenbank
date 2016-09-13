<?php
/*
SEITENNAVIGATION
-je nach Wert der GET-Variable 's' wird eine andere Seite eingebunden
*/
if (isset($_GET['s'])) {
    switch ($_GET['s']) {

    case 'personen':
      if (isset($_GET['action'])) {
          switch ($_GET['action']) {
          case 'overview':
            overview_personen();
          break;
          case 'add':
            add_person($_POST);
          break;
          case 'detail':
            detail_person($_GET['pid']);
          break;
          case 'delete':
            delete_person($_GET['pid']);
            break;
        }
      }
    break;

    case 'profil':
      include('includes/profil.inc.php');
    break;

    case 'termine':
      if (isset($_GET['action'])) {
          //je nach Action-Variable wird Funktion ausgeführt
        switch ($_GET['action']) {
          case 'overview':
            overview_termine();
            break;
          case 'add':
          //SCRIPT fügt Person der DB hinzu
          if (isset($_POST['submit_addtermin'])) {
              add_termin($_POST);
          }
          break;
          case 'detail':
            detail_termin($_GET['tid']);
            break;
          case 'copy':
            copy_termin($_GET['tid']);
            break;
          case 'delete':
            delete_termin($_GET['tid']);
            break;
          default:
            header('Location:error.html');
            break;
        }//ENDE switch ACTION
      }//ENDE if ACTION
      break; //ENDE CASE TERMINE
    }
} else {
    //--Standardseite
    include 'php/inc/overview.inc.php';
}//ENDE ELSE
