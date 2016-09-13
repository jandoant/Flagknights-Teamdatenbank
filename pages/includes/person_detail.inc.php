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

$vorname=$datensatz['vorname'];
$nachname=$datensatz['nachname'];
$rolle = $datensatz['rollenname'];
?>

 <a href="dashboard.php?s=personen&action=overview">Zurück zur Übersicht...</a>

 <div class="jumbotron">
   <div class="page-header">
     <h2><?php echo $vorname." ".$nachname;?>
      <br>
      <small><?php echo $rolle;?></small>
    </h2>
    <hr>
   </div>
 </div>
