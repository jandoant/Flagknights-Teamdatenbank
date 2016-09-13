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
