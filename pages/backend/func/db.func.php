<?php
  /*
  Handelt eine übergenene Datenbankabfrage ab und speichert
  das Ergebnis in einem assoziativem Array
  */
  function query_db($sql)
  {
    //1.Datenbankverbindung aufbauen
    require ('pages/backend/db/db_connect.php');
    //2.Abfrage durchführen und in Ergebnis speichern
    if($result = mysqli_query($connection, $sql)){
    //3. Datenbank schließen
    mysqli_close($connection);
    //4. Assoziatives Ergebnis-Array der Datenbankabfrage zurückgeben
    return $result;
    }
  }
 ?>
