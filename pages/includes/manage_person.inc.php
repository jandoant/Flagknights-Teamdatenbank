<?php
  //DATENBANKABFRAGE Spielerrollen
  //1. SQL-Befehl vorbereiten
  $sql_rollen="SELECT * FROM rollen";
  //2. SQL-Abfrage durchführen und gewünschte Ergebnisse speichern
  $result_rollen=query_db($sql_rollen);
?>

<?php
//DATENBANKABFRAGEN Spielertabelle
//1. SQL-Befehle vorbereiten
$sql_alle="SELECT * FROM personen JOIN rollen ON personen.rolle = rollen.rolle_id";
$sql_trainer = "SELECT * FROM personen
                      JOIN rollen ON personen.rolle = rollen.rolle_id
                      WHERE rollen.rollenname = 'Coach' ";
$sql_spieler = "SELECT *
                FROM personen
                JOIN rollen ON personen.rolle = rollen.rolle_id
                WHERE rollen.rollenname = 'Spieler'";
//2. SQL-Abfrage durchführen und gewünschte Ergebnisse speichern
//--Datenbankabfragen durchführen
$result = query_db($sql_alle);
$result_trainer = query_db($sql_trainer);
$result_spieler = query_db($sql_spieler);
//--Anzahl der einzelnen Personengrupen ermittln
$anz_alle = mysqli_num_rows($result);
$anz_trainer = mysqli_num_rows($result_trainer);
$anz_spieler = mysqli_num_rows($result_spieler);
?>

<!-- MODAL -->
<div id="myPersonModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form action="dashboard.php?s=manage_person" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <!-- Modal HEADER-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Person hinzufügen</h4>
      </div>
      <!-- Modal BODY-->
      <div class="modal-body">
        <div class="container-fluid">
          <!--Rolle-->
          <div class="row">
            <div class="form-group col-lg-6">
              <label for="rolle">Rolle</label>
              <select class="form-control" name="rolle">
                <?php
                  while ($datensatz = mysqli_fetch_assoc($result_rollen)) {
                  echo "<option value='".$datensatz['rolle_id']."'>".$datensatz['rollenname']."</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <!--Namen-->
          <div class="row">
            <div class="form-group col-lg-6">
              <label for="vorname">Vorname</label>
              <input type="text" class="form-control" name="vorname" id="vorname" placeholder="Vorname">
            </div>
            <div class="form-group col-lg-6 ">
              <label for="nachname">Nachname</label>
              <input type="text" class="form-control" name="nachname" id="nachname" placeholder="Nachname">
            </div>
          </div>
          <!--Geburtsdatum-->
          <div class="row">
            <div class="form-group col-lg-6 ">
              <label for="geburtsdatum">Geburtsdatum</label>
              <input type="text" class="form-control" name="geburtsdatum" id="geburtsdatum" placeholder="TT.MM.YYYY">
            </div>
          </div>
          <!--Straße und PLZ-->
          <div class="row">
            <div class="form-group col-lg-6 ">
              <label for="strasse">Adresse</label>
              <input type="text" class="form-control" name="strasse" id="strasse" placeholder="Straße">
            </div>
            <div class="form-group col-lg-6 ">
              <label for="strasse">Ort</label>
              <input type="text" class="form-control" name="plz" id="plz" placeholder="PLZ">
            </div>
          </div>
          <!--aktives Mitglied-->
          <div class="row ">
            <div class="form-group col-lg-6 ">
              <input type="checkbox" name="aktiv" value="1">
              <label for="aktiv">aktives Mitglied?</label>
            </div>
          </div>
          <!--angemeldet-->
          <div class="row">
            <div class="form-group col-lg-6 ">
              <input type="checkbox" name="angemeldet" value="1">
              <label for="angemeldet">im Verein angemeldet?</label>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal FOOTER-->
      <div class="modal-footer">
        <button type="sumbit" name="submit_addperson" class="btn btn-default" >Speichern...</button>
        <button type="cancel" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
      </div>
    </div>
  </form>
  </div>
</div>



<h1>Personenübersicht</h1>

<!-- BUTTON um Modal einzublenden -->
  <div class="row">
    <button type="button" class="btn btn-med btn-success" data-toggle="modal" data-target="#myPersonModal">+ Neue Person hinzufügen</button>
  </div>
<!--Ausgabe der Datenbankabfragen-->
<div class="row">
  <!--Dynamisch erstellte Personentabelle-->
  <table id ="tabelle_personen" class="table table-bordered table-responsive table-hover table-personen">
    <thead>
      <tr>
        <th data-sort="string" title="nach Nachnamen sortieren">Nachname</th>
        <th data-sort="string" title="nach Vornamen sortieren">Vorname</th>
        <th data-sort="int" title="nach Alter sortieren">Alter</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php
    //Ergebnis ausgeben - jede Reihe wird dynamisch erzeugt
    while ($datensatz = mysqli_fetch_assoc($result)) {
      $person_id =$datensatz['person_id'];
      echo"<tr class='row_trainer clickable-row' data-href='dashboard.php?s=person_detail&pid=$person_id'>";
        echo "<td>".$datensatz['nachname']."</td>";
        echo "<td>".$datensatz['vorname']."</td>";
        echo "<td>".calc_age($datensatz['geburtsdatum'])." Jahre</td>";
        //Link um Spielerdetail zu öffnen
        echo "<td><a href ='dashboard.php?s=person_detail&pid=$person_id'><span class='glyphicon glyphicon-fullscreen'><span></td>";
      echo"</tr>";
      echo"</n>";
    }
    ?>
    </tbody>
  </table>

  <script type="text/javascript">
    //Sortierfunktion
    var table = $("#tabelle_personen").stupidtable();
    table.on("aftertablesort", function (event, data) {
  	      var th = $(this).find("th");
  	      th.find(".arrow").remove();
  	      var dir = $.fn.stupidtable.dir;

  	      var arrow = data.direction === dir.ASC ? "&#8679;" : "&#8681;";
  	      th.eq(data.column).append('<span class="arrow">' + arrow +'</span>');
  	    });
    //Clickable-Row
    jQuery(document).ready(function($) {
      $(".clickable-row").click(function() {
          window.document.location = $(this).data("href");
      });
  });


  </script>
</div>
