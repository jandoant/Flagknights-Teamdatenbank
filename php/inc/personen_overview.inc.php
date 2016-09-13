
<!-- MODAL-->
<div id="myPersonModal" role="dialog" class="modal fade">
  <div class="modal-dialog">
    <form action="dashboard.php?s=personen&amp;action=add" method="post">
      <!-- Modal CONTENT-->
      <div class="modal-content">
        <!-- Modal HEADER-->
        <div class="modal-header">
          <button type="button" data-dismiss="modal" class="close">×</button>
          <h4 class="modal-title">Person hinzufügen</h4>
        </div>
        <!-- Modal BODY-->
        <div class="modal-body">
          <div class="container-fluid">
            <!-- Rolle-->
            <div class="row">
              <div class="form-group col-lg-6">
                <label for="rolle">Rolle</label>
                <select name="rolle" class="form-control">                 </select>
              </div>
            </div>
            <!-- Namen-->
            <div class="row">
              <div class="form-group col-lg-6">
                <label for="vorname">Vorname</label>
                <input id="vorname" type="text" name="vorname" placeholder="Vorname" class="form-control"/>
              </div>
              <div class="form-group col-lg-6">
                <label for="nachname">Nachname</label>
                <input id="nachname" type="text" name="nachname" placeholder="Nachname" class="form-control"/>
              </div>
            </div>
            <!-- Geburtsdatum-->
            <div class="row">
              <div class="form-group col-lg-6">
                <label for="geburtsdatum">Geburtsdatum</label>
                <input id="geburtsdatum" type="text" name="geburtsdatum" placeholder="TT.MM.YYYY" class="form-control"/>
              </div>
            </div>
            <!-- Straße und PLZ-->
            <div class="row">
              <div class="form-group col-lg-6">
                <label for="strasse">Adresse</label>
                <input id="strasse" type="text" name="strasse" placeholder="Straße" class="form-control"/>
              </div>
              <div class="form-group col-lg-6">
                <label for="plz">Ort</label>
                <input id="plz" type="text" name="plz" placeholder="PLZ" class="form-control"/>
              </div>
            </div>
            <!-- aktives Mitglied-->
            <div class="row">
              <div class="form-group col-lg-6">
                <input type="checkbox" name="aktiv" value="checked"/>
                <label for="aktiv">aktives Mitglied?</label>
              </div>
            </div>
            <!-- angemeldet-->
            <div class="row">
              <div class="form-group col-lg-6">
                <input type="checkbox" name="angemeldet" value="checked"/>
                <label for="angemeldet">im Verein angemeldet?</label>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal FOOTER-->
        <div class="modal-footer">
          <button type="sumbit" name="submit_addperson" class="btn btn-default">Speichern...</button>
          <button type="cancel" data-dismiss="modal" class="btn btn-default">Abbrechen</button>
        </div>
      </div>
    </form>
  </div>
</div>
<h1>Personenübersicht</h1>
<div class="container-fluid"> 
  <div class="row">
    <!-- BUTTON um Modal einzublenden-->
    <button type="button" data-toggle="modal" data-target="#myPersonModal" class="btn btn-med btn-success">+ Neue Person hinzufügen</button>
  </div>
  <div class="row">
    <!--PERSONENTABELLE aus Datenbank-->
    <table id="tabelle_personen" class="table table-bordered table-responsive table-hover table-personen">
      <thead>
        <tr>
          <th data-sort="string" title="nach Nachnamen sortieren">Nachname</th>
          <th data-sort="string" title="nach Vornamen sortieren">Vorname</th>
          <th data-sort="int" title="nach Alter sortieren">Alter</th>
          <th></th>
        </tr>
        <tbody>
          <?php
          include 'php/render/tabelle_personen.rend.php'; 
          ?>
        </tbody>
      </thead>
    </table>
  </div>
</div>