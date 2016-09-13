<?php
//0.DB-Konfiguration laden
require ('db_config.php');
//1.Verbindung herstellen
$connection = mysqli_connect($db_host, $db_user, $db_password) or die('<br>Zur Zeit ist leider keine Verbindung zur Datenbank möglich. <br><strong>Bitte versuchen Sie es in ein paar Minuten nochmal!</strong>');
//2.Datenbank auswählen
mysqli_select_db($connection, $db_name) or die ('Keine Datenbank ausgewählt.');
mysqli_query($connection, "SET NAMES 'utf8'");
 ?>
 
