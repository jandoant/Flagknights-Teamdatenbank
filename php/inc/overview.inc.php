<?php

  $sql_termine = "SELECT * FROM termine";
  $sql_personen = "SELECT * FROM personen";
  $sql_status = "SELECT * FROM status";

  $result_termine = query_db($sql_termine);
  $result_personen = query_db($sql_personen);
  $result_status = query_db($sql_status);

  $i=0;
  $termine_ids = array();
  while($datensatz_termine=mysqli_fetch_assoc($result_termine)){
    $termine_ids[$i] = $datensatz_termine['termin_id'];
    $i++;
  }
  //Zurücksetzen
  mysqli_data_seek($result_termine,0);

  $i=0;
  $personen_ids= array();
  mysqli_data_seek($result_personen,0);
  while($datensatz_personen=mysqli_fetch_assoc($result_personen)){
    $personen_ids[$i] = $datensatz_personen['person_id'];
    $i++;
  }
  //Zurücksetzen
  mysqli_data_seek($result_personen,0);
?>
<h1>Overview</h1>

<form class="" action="dashboard.php?s=overview" method="post">
  <table class="table">
    <tr>
      <th>Spieler</th>
      <?php
        while($datensatz_termine = mysqli_fetch_assoc($result_termine)){
          echo "<th>".$datensatz_termine['termin_id']."</th>";
        }
        //Zurücksetzen
        mysqli_data_seek($result_termine,0);
       ?>
    </tr>

      <?php
        while ($datensatz_personen = mysqli_fetch_assoc($result_personen)) {
          echo "<tr>";
          echo "<td>".$datensatz_personen['vorname']."</td>";

          while ($datensatz_termine = mysqli_fetch_assoc($result_termine)) {
          echo "<td>";
          echo "<select class='' name='janein_".$datensatz_termine['termin_id']."_".$datensatz_personen['person_id']."'>";
            while($datensatz_status = mysqli_fetch_assoc($result_status)){
              echo "<option value='".$datensatz_status['status_id']."_".$datensatz_termine['termin_id']."_".$datensatz_personen['person_id']."'>".$datensatz_status['status']."</option>";
            }
            mysqli_data_seek($result_status,0);
          echo "</select>";
          echo "</td>";
          }
          //Zurücksetzen
          mysqli_data_seek($result_termine,0);
          echo "</tr>";

        }
       ?>
  </table>


  <button class="btn" type="submit" name="submit_beteiligung">Eintragen</button>

</form>

<?php
if(isset($_POST['submit_beteiligung'])){

  for ($t=0; $t < count($termine_ids) ; $t++) {
    for ($p=0; $p <count($personen_ids) ; $p++) {
      $select='janein_'.$termine_ids[$t]."_".$personen_ids[$p];
      $d = explode("_",$_POST[$select]);

      $termin_id = $d[1];
      $person_id = $d[2];
      $status_id= $d[0];

      $sql = "INSERT INTO termine_personen (termin_id, person_id, status)
              VALUES ($termin_id, $person_id, $status_id)
              ON DUPLICATE KEY UPDATE status= $status_id";
      query_db($sql);
      echo "TerminID: $d[1] --> SpielerID: $d[2] -- > Status: $d[0]";
      echo "<br>";
    }
  }

  }

 ?>
