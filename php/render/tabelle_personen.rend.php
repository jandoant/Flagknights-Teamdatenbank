
<?php
//DATEN für SPIELERTABELLE
//1. SQL-Befehle vorbereiten
$sql_alle="SELECT * FROM personen JOIN rollen ON personen.rolle = rollen.rolle_id";
//2. DB-Abfrage durchführen
$result = query_db($sql_alle);
?>

<?php
  //Ergebnis ausgeben - jede Reihe wird dynamisch erzeugt
  while ($datensatz = mysqli_fetch_assoc($result)) {
    $person_id =$datensatz['person_id'];
    echo"<tr class='row_trainer clickable-row' data-href='dashboard.php?s=personen&action=detail&pid=$person_id'>";
      echo "<td>".$datensatz['nachname']."</td>";
      echo "<td>".$datensatz['vorname']."</td>";
      echo "<td>".calc_age($datensatz['geburtsdatum'])." Jahre</td>";
      //Link um Spielerdetail zu öffnen
      echo "<td><a href ='dashboard.php?s=personen&action=detail&pid=$person_id'><span class='glyphicon glyphicon-fullscreen'><span></td>";
      //Link um Spieler zu löschen
      echo "<td><a href ='dashboard.php?s=personen&action=delete&pid=$person_id'><span class='glyphicon glyphicon-remove'><span></td>";
    echo"</tr>";
    echo"</n>";
  }
?>
