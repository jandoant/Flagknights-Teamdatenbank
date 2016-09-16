<?php
//Alle Informationen über die Person aus DB auslesen
$person_id = $_GET['pid'];

//1.SQL-Befehle vorbereiten
$sql_person ="SELECT * FROM personen
              JOIN rollen ON personen.rolle = rollen.rolle_id
              WHERE personen.person_id = ".$person_id;
//2.SQL-Abfrage ausführen
$result = query_db($sql_person);
//3.Datensatz auslesen
$datensatz = mysqli_fetch_assoc($result);

$pid = $datensatz['person_id'];
$vorname=$datensatz['vorname'];
$nachname=$datensatz['nachname'];
$rolle = $datensatz['rollenname'];
?>
