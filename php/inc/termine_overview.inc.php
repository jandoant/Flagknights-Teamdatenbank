
<!--output: ../php/inc/termine_overview.inc.php-->
<div id="myTerminModal" role="dialog" class="modal fade">
  <div class="modal-dialog">
    <form action="dashboard.php?s=termine&action=add" method="post">
      <!-- Modal content-->
      <div class="modal-content">
        <!-- Modal HEADER-->
        <div class="modal-header">
          <button type="button" data-dismiss="modal" class="close">×</button>
          <h4 class="modal-title">Termin erstellen</h4>
        </div>
        <!-- Modal BODY-->
        <div class="modal-body">
          <div class="container-fluid">
            <!-- Terminart-->
            <div class="row">
              <div class="form-group col-lg-6">
                <label for="terminart">Art des Termins</label><?php render_dropdown_terminart();?>                  
              </div>
            </div>
            <!-- Datum & Uhrzeit-->
            <div class="row">
              <!-- Datum-->
              <div id="datepicker" class="form-group col-lg-6">
                <label for="termindatum">Datum</label>
                <input id="termindatum" type="text" name="termindatum" placeholder="TT.MM.YYYY" class="form-control"/>
              </div>
              <script type="text/javascript">
                $(function () {
                $('#datepicker input').datetimepicker({
                format: 'DD.MM.YYYY',
                locale: 'de'
                });
                });
              </script>
              <!-- Uhrzeit-->
              <div id="timepicker" class="form-group col-lg-6">
                <label for="uhrzeit">Uhrzeit</label>
                <input id="uhrzeit" type="text" name="uhrzeit" placeholder="HH:mm" class="form-control"/>
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
            <!-- Ort-->
            <div class="row">
              <div class="form-group col-lg-6">
                <label for="terminort">Ort</label><?php render_dropdown_ort();?>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal FOOTER-->
        <div class="modal-footer">
          <button type="sumbit" name="submit_addtermin" class="btn btn-default">Speichern...</button>
          <button type="cancel" data-dismiss="modal" class="btn btn-default">Abbrechen</button>
        </div>
      </div>
    </form>
  </div>
</div>
<h1>Terminübersicht</h1>
<div class="container-fluid"> 
  <div class="row">
    <!-- BUTTON um Modal einzublenden-->
    <button type="button" data-toggle="modal" data-target="#myTerminModal" class="btn btn-med btn-success">+ Neuen Termin hinzufügen</button>
  </div>
  <div class="row">
    <h3>Training</h3><?php render_reihe('training');?>
  </div>
  <div class="row">
    <h3>Turniere</h3><?php render_reihe('turnier');?>  
  </div>
  <div class="row">
    <h3>Events</h3><?php render_reihe('event');?>  
  </div>
</div>