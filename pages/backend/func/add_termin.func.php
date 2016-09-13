<?php
//SCRIPT fügt Person der DB hinzu
if(isset($_POST['submit_addtermin'])){
  //1.Datenbankverbindung aufbauen
  require('backend/db/db_connect.php');
  //2. SQL-Befehl vorbereiten
  $sql = "INSERT INTO termine (termindatum, terminart, terminort, ferien)
          VALUES ('".
                  date_german2mysql(trim($_POST['termindatum']))." ".trim($_POST['uhrzeit'])."', '".
                  trim($_POST['terminart'])."', '".
                  trim($_POST['terminort'])."', '".
                  trim($_POST['ferien'])."')";
  //3.SQL-Befehl ausführen und Meldung für Resultat ausgeben
  if (mysqli_query($connection, $sql)) {
    header('Location:success.php');
    $_SESSION['success_add_termin']=TRUE;
  } else {
    $_SESSION['success_add_termin']=FALSE;
  }
  //4.DB-Verbindung schließen
  mysqli_close($connection);
}
?>
