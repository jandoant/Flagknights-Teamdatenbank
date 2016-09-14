<?php

function overview_termine()
{
    //ANZEIGE der Terminübersicht
  include 'php/inc/termine_overview.inc.php';
}

function add_termin($post)
{
    //--SQL-Befehl vorbereiten
    $sql = "INSERT INTO termine (termindatum, terminart, terminort, ferien)
            VALUES ('".
                    date_german2mysql($post['termindatum'])." ".$post['uhrzeit']."', '".
                    $post['terminart']."', '".
                    $post['terminort']."', '".
                    $post['ferien']."')";
    //--Datenbankverbindung aufbauen
    require 'php/func/db_connect.php';
    //3.SQL-Befehl ausführen und Meldung für Resultat ausgeben
    if (mysqli_query($connection, $sql)) {
        header('Location:success.php');
        $_SESSION['success_add_termin'] = true;
    } else {
        $_SESSION['success_add_termin'] = false;
    }
    //4.DB-Verbindung schließen
    mysqli_close($connection);
  }

function detail_termin($tid)
{
    include 'includes/termin_detail.inc.php';
}

function copy_termin($tid)
{
  //Ermitteln der Daten des zu kopierenden Termins
  $sql_alt = "SELECT * FROM termine WHERE termin_id = $tid";
  $result_alt = query_db($sql_alt);
  $datensatz = mysqli_fetch_assoc($result_alt);

  //1 Woche zum Datum hinzufügen -- Ausgabe im
  $date=date_create($datensatz['termindatum']);
  date_add($date,date_interval_create_from_date_string("1 week"));
  $datensatz['termindatum'] = date_format($date,"Y-m-d H:i:s");

  //Umwandeln des DATETIME-Formats in dt. Datum und Uhrzeit für add_termin()
  $datum = date('d.m.Y', strtotime($datensatz['termindatum']) );
  $uhrzeit =date('H:i', strtotime($datensatz['termindatum'] ));
  //Datensatz neu füllen
  $datensatz['termindatum'] = $datum;
  $datensatz['uhrzeit'] = $uhrzeit;
  //neuen Termin mit diesem Datensatz erzeugen
  add_termin($datensatz);
}

function delete_termin($tid)
{
  //SQL-Befehl vorbereiten
  $sql = "DELETE FROM termine WHERE termin_id = $tid";
  //DB-Verbindung aufbauen
  require 'php/func/db_connect.php';
  //SQL-Befehl ausführen und Erfolgsvariable setzen
  if (mysqli_query($connection, $sql)) {
      $_SESSION['success_delete_termin'] = true;
  } else {
      $_SESSION['success_delete_termin'] = false;
  }
  //Datenbankverbindung schließen
  mysqli_close($connection);
  //Weiterleitung um Erfolgsmeldung anzuzeigen
  header('Location:success.php');
}
