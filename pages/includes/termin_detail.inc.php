<?php
//Alle Informationen über den Termin aus DB auslesen
$termin_id = $_GET['tid'];

//--SQL-Befehle vorbereiten
$sql_termin ="SELECT * FROM termine
              WHERE termine.termin_id = ".$termin_id;
//--SQL-Abfrage ausführen
$result = query_db($sql_termin);
//--Datensatz auslesen
$datensatz = mysqli_fetch_assoc($result);
$termindatum=$datensatz['termindatum'];
?>



 <a href="dashboard.php?s=manage_person">Zurück zur Übersicht...</a>

 <div class="jumbotron">
   <div class="page-header">
     <h2><?php echo $termindatum;?>
      <br>
      <small>Hallo Welt</small>
    </h2>
    <hr>
   </div>
 </div>
