<?php
//DATEN für DROPDOWNs in Modal
//--SQL-Befehl vorbereiten
$sql_terminart = 'SELECT * FROM terminart';
$sql_ort = 'SELECT * FROM orte';
//--SQL-Abfrage durchführen und gewünschte Ergebnisse speichern
$result_terminart = query_db($sql_terminart);
$result_orte = query_db($sql_ort);
?>
<?php
//DATEN für die Anzeige der Termine in Raster
//--SQL-Befehl vorbereiten
$sql_training = "SELECT * FROM termine
              JOIN terminart ON termine.terminart = terminart.terminart_id
              JOIN orte ON termine.terminort = orte.ort_id
              WHERE terminart.terminart = 'Training'";
//--SQL-Abfrage durchführen und gewünschte Ergebnisse speichern
$result_training = query_db($sql_training);
?>

<!-- MODAL -->
<div id="myTerminModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="dashboard.php?s=termine&action=add" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <!-- Modal HEADER-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Termin erstellen</h4>
      </div>
      <!-- Modal BODY-->
      <div class="modal-body">
        <div class="container-fluid">
          <!--Terminart-->
          <div class="row">
            <div class="form-group col-lg-6">
              <label for="terminart">Art des Termins</label>
              <select class="form-control" name="terminart">
                <?php
                  while ($datensatz = mysqli_fetch_assoc($result_terminart)) {
                  echo "<option value='".$datensatz['terminart_id']."'>".$datensatz['terminart']."</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <!--Datum & Uhrzeit-->
          <div class="row">
            <!--Datum-->
            <div class="form-group col-lg-6" id='datepicker'>
              <label for="termindatum">Datum</label>
              <input type="text" class="form-control" name="termindatum" id="termindatum" placeholder="TT.MM.YYYY">
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datepicker input').datetimepicker({
                        format: 'DD.MM.YYYY',
                        locale: 'de'
                    });
                });
            </script>
            <!--Uhrzeit-->
            <div class="form-group col-lg-6" id='timepicker'>
              <label for="uhrzeit">Uhrzeit</label>
              <input type="text" class="form-control" name="uhrzeit" id="uhrzeit" placeholder="HH:mm">
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#timepicker input').datetimepicker({
                        format: 'HH:mm',
                        locale: 'de'
                    });
                });
            </script>
          </div>
          <!--Ort-->
          <div class="row">
            <div class="form-group col-lg-6 ">
              <label for="terminort">Ort</label>
              <select class="form-control" name="terminort" placeholder="123">
                <?php
                  while ($datensatz = mysqli_fetch_assoc($result_orte)) {
                  echo "<option value='".$datensatz['ort_id']."'>".$datensatz['ortname']."</option>";
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        </div>
      <!-- Modal FOOTER-->
      <div class="modal-footer">
        <button type="sumbit" name="submit_addtermin" class="btn btn-default" >Speichern...</button>
        <button type="cancel" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
      </div>
    </div>
    </form>
  </div>
</div>




<div class="container-fluid">
<div class="row">
  <h1>Terminübersicht</h1>
</div>
<!-- BUTTON um Modal einzublenden -->
  <div class="row">
    <button type="button" class="btn btn-med btn-primary" data-toggle="modal" data-target="#myTerminModal">+ Neuen Termin erstellen</button>
  </div>
  <!-- Reihe TRAINING -->
  <h3>Training</h3>
  <div class="row">
    <?php
    while ($datensatz = mysqli_fetch_assoc($result_training)) {
      $datum = date_mysql2german($datensatz['termindatum']);
      $uhrzeit = mysql2clocktime($datensatz['termindatum']);
      $wochentag = date_dayoftheweek_german($datensatz['termindatum']);
      echo "<div class='col-xxs-12 col-xs-6 col-sm-6 col-md-3 col-lg-2'>\n";
        echo "<div class='thumbnail box-training'>\n";
          echo "<div class='caption'>\n";
            echo "<p class='text-center'>\n";
              echo "<strong>".$wochentag."</strong>\n";
              echo "<br>\n";
              echo "<strong>$datum</strong>\n";
              echo "<br>\n";
              echo $uhrzeit." Uhr";
              echo "<br>\n";
              echo $datensatz['ortname'];
            echo "</p>\n";
            echo "<div class='btn-group btn-group-termin'>\n";
              echo "<a href='dashboard.php?s=termine&action=detail&tid=".$datensatz['termin_id']."' class='btn btn-info btn-termin' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>\n";
              echo "<a href='dashboard.php?s=termine&action=copy&tid=".$datensatz['termin_id']."' class='btn btn-warning btn-termin' role='button'><span class='glyphicon glyphicon-file' aria-hidden='true'></span></a>\n";
              echo "<a href='dashboard.php?s=termine&action=delete&tid=".$datensatz['termin_id']."' class='btn btn-danger btn-termin' role='button'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a>\n";
            echo "</div>\n";
          echo "</div>\n";
        echo "</div>\n";
      echo "</div>\n";
    }
    ?>
  </div>

  <!-- Reihe TURNIER -->
  <div class="row">
    <h3>Turnier</h3>
  </div>
  <!-- Reihe EVENTS -->
  <div class="row">
    <h3>Events</h3>
  </div>


</div>
