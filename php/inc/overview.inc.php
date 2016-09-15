<?php
//Daten aus DB holen -- wichtig für Identifizierung der einzelnen Select-Felder
include('php/func/beteiligung.func.php');
?>
<h1>Overview</h1>
<form class="" action="dashboard.php?s=overview&action=update" method="post">
  <table class="table">
    <tr>
      <th>Spieler</th>
      <?php
        //Tabellenkopf mit allen verfügbaren Terminen wird erstellt
        while($datensatz_termine = mysqli_fetch_assoc($result_termine)){
          echo "<th>".$datensatz_termine['termin_id']."</th>";
        }
        mysqli_data_seek($result_termine,0);
       ?>
    </tr>

      <?php
        //1. Zeilen mit allen verfügbaren Spielern erstellen
        while ($datensatz_personen = mysqli_fetch_assoc($result_personen)) {
          echo "<tr>";
          echo "<td>".$datensatz_personen['vorname']."</td>";
          //2. für jeden Termine eine Zelle in Zeile erstellen
          while ($datensatz_termine = mysqli_fetch_assoc($result_termine)) {
            echo "<td>";
              //3. SELECT-Felder werden eindeutig benannt (Kombination aus TerminID und PersonID)
              echo "<select class='' name='janein_".$datensatz_termine['termin_id']."_".$datensatz_personen['person_id']."'>";
                //4. SELECT-Boxen werden mit Daten aus DB gefüllt
                //4.1 Aktuellen Status der Person an diesem Termin auslesen
                $sql_select = "SELECT status FROM termine_personen
                            WHERE termin_id = ".$datensatz_termine['termin_id']." AND person_id = ".$datensatz_personen['person_id'];
                $result_select = query_db($sql_select);
                $status_id = mysqli_fetch_assoc($result_select);

                //4.2 Füllen der Select Felder mit allen in DB vorhandenen Status
                //und Vorbelegen der Select Felder mit dem aktuellen Status aus der DB
                $i=1;
                while($datensatz_status = mysqli_fetch_assoc($result_status)){

                  if ($i == $status_id['status']){
                    echo "<option selected='selected' value='".$datensatz_status['status_id']."_".$datensatz_termine['termin_id']."_".$datensatz_personen['person_id']."'>".$datensatz_status['status']."</option>\n";
                  }
                  else {
                    echo "<option value='".$datensatz_status['status_id']."_".$datensatz_termine['termin_id']."_".$datensatz_personen['person_id']."'>".$datensatz_status['status']."</option>\n";
                  }
                  $i++;
            }
            mysqli_data_seek($result_status,0);
            echo "</select>";
          echo "</td>";
          }
          mysqli_data_seek($result_termine,0);
          echo "</tr>";
        }
       ?>
  </table>
  <button class="btn" type="submit" name="submit_beteiligung">Eintragen</button>
</form>
