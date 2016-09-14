<?php

function render_dropdown_rollen(){
  //alle vorhandenen Rollen aus DB auslesen
  $sql_rollen="SELECT * FROM rollen";
  $result_rollen=query_db($sql_rollen);
  //Dropdown-Menu mit diesen Daten erstellen
  while ($datensatz = mysqli_fetch_assoc($result_rollen)) {
  echo "<option value='".$datensatz['rolle_id']."'>".$datensatz['rollenname']."</option>";
  }
}

function render_dropdown_terminart(){
  //--SQL-Befehl vorbereiten
  $sql_terminart = 'SELECT * FROM terminart';
  //--SQL-Abfrage durchführen und gewünschte Ergebnisse speichern
  $result_terminart = query_db($sql_terminart);
  //Dropdown-Menu mit diesen Daten erstellen
  echo "<select class='form-control' name='terminart'>";
    while ($datensatz = mysqli_fetch_assoc($result_terminart)) {
    echo "<option value='".$datensatz['terminart_id']."'>".$datensatz['terminart']."</option>";
    }
  echo "</select>";
}

function render_dropdown_ort(){
  //--SQL-Befehl vorbereiten
  $sql_orte = 'SELECT * FROM orte';
  //--SQL-Abfrage durchführen und gewünschte Ergebnisse speichern
  $result_orte = query_db($sql_orte);
  //Dropdown-Menu mit diesen Daten erstellen
  echo "<select class='form-control' name='terminort'>";
      while ($datensatz = mysqli_fetch_assoc($result_orte)) {
      echo "<option value='".$datensatz['ort_id']."'>".$datensatz['ortname']."</option>";
    }
  echo "</select>";
}

function render_tablebody_personen()
{
  //Daten für Spielertabelle auslesen
  $sql_alle="SELECT * FROM personen JOIN rollen ON personen.rolle = rollen.rolle_id";
  $result = query_db($sql_alle);
  //Tabellenbody mit diesen Daten erstellen
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
}

function render_reihe($terminart)
{

  //SQL-Statement vorbereiten
  switch ($terminart) {
    case 'training':
    $sql = "SELECT * FROM termine
                  JOIN terminart ON termine.terminart = terminart.terminart_id
                  JOIN orte ON termine.terminort = orte.ort_id
                  WHERE terminart.terminart = 'Training'
                  ORDER BY termine.termindatum ASC";
      break;
    case 'turnier':
    $sql = "SELECT * FROM termine
                  JOIN terminart ON termine.terminart = terminart.terminart_id
                  JOIN orte ON termine.terminort = orte.ort_id
                  WHERE terminart.terminart = 'Turnier'
                  ORDER BY termine.termindatum ASC";
      break;
    case 'event':
    $sql = "SELECT * FROM termine
                  JOIN terminart ON termine.terminart = terminart.terminart_id
                  JOIN orte ON termine.terminort = orte.ort_id
                  WHERE terminart.terminart = 'Event'
                  ORDER BY termine.termindatum ASC";
      break;
    }
  $result = query_db($sql);

  //Erzeugen des Views
  while ($datensatz = mysqli_fetch_assoc($result)) {
    $datum = date_mysql2german($datensatz['termindatum']);
    $uhrzeit = mysql2clocktime($datensatz['termindatum']);
    $wochentag = date_dayoftheweek_german($datensatz['termindatum']);
    echo "<div class='col-xxs-12 col-xs-6 col-sm-6 col-md-3 col-lg-2'>\n";
      echo "<a href='#'>";
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
        echo "</a>";
      echo "</div>\n";
      echo "</a>";
    echo "</div>\n";
  }
}


















?>
