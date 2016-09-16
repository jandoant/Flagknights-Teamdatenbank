<?php
  $sql_termine = "SELECT * FROM termine";
  $sql_personen = "SELECT * FROM personen WHERE aktiv = 1";
  $sql_status = "SELECT * FROM status";

  $result_termine = query_db($sql_termine);
  $result_personen = query_db($sql_personen);
  $result_status = query_db($sql_status);

  //Array füllen mit allen vorhandenen Termin-IDs
  $i=0;
  $termine_ids = array();
  while($datensatz_termine=mysqli_fetch_assoc($result_termine)){
    $termine_ids[$i] = $datensatz_termine['termin_id'];
    $i++;
  }
  mysqli_data_seek($result_termine,0);

  //Array füllen mit allen vorhandenen Personen-IDs
  $i=0;
  $personen_ids= array();
  mysqli_data_seek($result_personen,0);
  while($datensatz_personen=mysqli_fetch_assoc($result_personen)){
    $personen_ids[$i] = $datensatz_personen['person_id'];
    $i++;
  }
  mysqli_data_seek($result_personen,0);
?>
