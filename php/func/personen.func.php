<?php
/*
Zeigt Übersicht aller eingetragenen Personen an
*/
function overview_personen()
{
  //ANZEIGE der Personenübersicht
  include 'php/inc/personen_overview.inc.php';
}

/*
Fügt eine Person der DB hinzu
*/
function add_person($post)
{
    if (isset($post['submit_addperson'])) {
        $aktiv = 0;
        if (isset($post['aktiv'])) {
            $aktiv = 1;
        }
        $angemeldet = 0;
        if (isset($post['angemeldet'])) {
            $angemeldet = 1;
        }
    //SQL-Befehl vorbereiten
    $sql = "INSERT INTO personen (rolle, nachname, vorname, strasse, plz, aktiv, angemeldet, geburtsdatum)
            VALUES ('".
                    $post['rolle']."', '".
                    $post['nachname']."', '".
                    $post['vorname']."', '".
                    $post['strasse']."', '".
                    $post['plz']."', '".
                    $aktiv."', '".
                    $angemeldet."', '".
                    date_german2mysql(trim($post['geburtsdatum']))."')";

    //Datenbankverbindung öffnen
    require 'php/func/db_connect.php';
    //SQL-Befehl ausführen und Erfolgsvariable setzen
    if (mysqli_query($connection, $sql)) {
        $_SESSION['success_add_person'] = true;
    } else {
        $_SESSION['success_add_person'] = false;
    }
    //Datenbankverbindung schließen
    mysqli_close($connection);
    //Weiterleitung um Erfolgsmeldung anzuzeigen
    header('Location:success.php');
    }
}

/*
Zeigt die Detailseite einer Person an
*/
function detail_person($pid)
{
    include 'php/inc/person_detail.inc.php';
}

/*
Löscht eine Person aus der DB
*/
function delete_person($pid)
{
  //SQL-Befehl vorbereiten
  $sql = "DELETE FROM personen WHERE person_id = $pid";
  //DB-Verbindung aufbauen
  require 'php/func/db_connect.php';
  //SQL-Befehl ausführen und Erfolgsvariable setzen
  if (mysqli_query($connection, $sql)) {
      $_SESSION['success_delete_person'] = true;
  } else {
      $_SESSION['success_delete_person'] = false;
  }
  //Datenbankverbindung schließen
  mysqli_close($connection);
  //Weiterleitung um Erfolgsmeldung anzuzeigen
  header('Location:success.php');
}


function update_overview($post){

  include('php/func/beteiligung.func.php');

  //was passiert, wenn Trainingsbeteiligung eingetragen werden soll
  if(isset($post['submit_beteiligung'])){

    //alle Termine durchgehen
    for ($t=0; $t < count($termine_ids) ; $t++) {
      //alle Personen im jeweiligen Termin durchgehen
      for ($p=0; $p <count($personen_ids) ; $p++) {

        //POST-Variable des abgeschickten Formulars auswerten
        //--> für jede Person wird zum jeweiligen Termin
        //    der angewählte Wert des Select-Felds der Zelle ausgewertet
        // Name des Select-Feldes: janein_terminID_personID --> eindeutige Identifizierung
        // Wert des Select Feldes: statusID_terminID_person_ID
        $select='janein_'.$termine_ids[$t]."_".$personen_ids[$p];
        //Explodieren des Wertes anhand der "_"
        $d = explode("_",$post[$select]);
        $termin_id = $d[1];
        $person_id = $d[2];
        $status_id= $d[0];
        //Für jede Zelle der Tabelle wird der Wert in der DB in Tabelle termine_personen eingefügt oder upgedatet
        $sql = "INSERT INTO termine_personen (termin_id, person_id, status)
                VALUES ($termin_id, $person_id, $status_id)
                ON DUPLICATE KEY UPDATE status= $status_id";
        query_db($sql);
        //echo "TerminID: $d[1] --> SpielerID: $d[2] -- > Status: $d[0]";
        //echo "<br>";
      }
    }
    header('Location:dashboard.php?s=overview&action=view');
  }

}
