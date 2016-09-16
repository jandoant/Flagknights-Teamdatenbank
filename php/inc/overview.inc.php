<?php
//Daten aus DB holen -- wichtig für Identifizierung der einzelnen Select-Felder
include('php/func/beteiligung.func.php');

$anz_anwesend= 0;
$anz_aktiv=0;


?>
<h1>Overview</h1>
<form class="" action="dashboard.php?s=overview&action=update" method="post">
  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Spieler</th>
      <?php
        //Tabellenkopf mit allen verfügbaren Terminen wird erstellt
        while($datensatz_termine = mysqli_fetch_assoc($result_termine)){
          echo "<th>".date_mysql2german($datensatz_termine['termindatum'])."</th>";
        }
        mysqli_data_seek($result_termine,0);
       ?>
    </tr>
  </thead>

      <?php
        echo "<tbody>";
        //1. Zeilen mit allen verfügbaren Spielern erstellen
        while ($datensatz_personen = mysqli_fetch_assoc($result_personen)) {
          echo "<tr>";

          echo "<td><a href ='dashboard.php?s=personen&action=detail&pid=".$datensatz_personen['person_id']."'>".$datensatz_personen['vorname']."</a></td>";





          //2. für jeden Termine eine Zelle in Zeile erstellen
          while ($datensatz_termine = mysqli_fetch_assoc($result_termine)) {
            //4.1 Aktuellen Status der Person an diesem Termin auslesen
            $sql_select = "SELECT status FROM termine_personen
                        WHERE termin_id = ".$datensatz_termine['termin_id']." AND person_id = ".$datensatz_personen['person_id'];
            $result_select = query_db($sql_select);
            $status_id = mysqli_fetch_assoc($result_select);
            echo "<td class=janein".$status_id['status'].">";
              //3. SELECT-Felder werden eindeutig benannt (Kombination aus TerminID und PersonID)
              echo "<select class='' name='janein_".$datensatz_termine['termin_id']."_".$datensatz_personen['person_id']."'>";
                //4. SELECT-Boxen werden mit Daten aus DB gefüllt
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
        echo "</tbody>";
        echo "<tfoot>";
        //letzte Zeilen
        $anz_zeilen= 2;
        for ($i=1; $i <=$anz_zeilen ; $i++) {
          echo "<tr>";

          switch ($i) {
            case 1:
              //vorletzte Zeile
              echo "<td>";
                echo "Anwesend:";
              echo "</td>";
              break;
            case 2:
              //letzte Zeile
              echo "<td>";
                echo "Aktiv:";
              echo "</td>";
              break;
          }


            //für jeden Termin eine neue Zelle
            while ($datensatz_termine = mysqli_fetch_assoc($result_termine)) {

              $sql_anwesend = "SELECT * FROM termine_personen
                                JOIN personen ON personen.person_id = termine_personen.person_id
                                WHERE personen.aktiv = 1 AND termine_personen.termin_id = ".$datensatz_termine['termin_id']." AND termine_personen.status = 2";
              $result_anwesend = query_db($sql_anwesend);
              $anz_anwesend = mysqli_num_rows($result_anwesend);
              $anz_aktiv = mysqli_num_rows($result_personen);

              echo "<td>";
                switch ($i) {
                  case 1:
                    //vorletzte Zeile
                    echo $anz_anwesend. " Personen";
                    break;
                  case 2:
                    //letzte Zeile
                    echo round($anz_anwesend/$anz_aktiv*100,2) . " Prozent";
                    break;
                }
              echo "</td>";
            }
            mysqli_data_seek($result_termine,0);
          echo "</tr>";
        }
        echo "</tfoot>";
       ?>
  </table>
  <button class="btn" type="submit" name="submit_beteiligung">Eintragen</button>
</form>
