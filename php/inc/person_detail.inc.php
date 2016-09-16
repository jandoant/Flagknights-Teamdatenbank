<?php
include 'php/func/db_personen.func.php';
?><a href="dashboard.php?s=personen&amp;action=overview">Zurück zur Übersicht...</a>
<div class="jumbotron">
  <div class="page-header">
    <h2>

      <?php echo $vorname." ".$nachname;?>
    </h2><br/><small>
      <?php echo $rolle;?></small>
    <hr/>

    <h2>Trainingsbeteiligung</h2>
    <?php echo round(get_trainingsbeteiligung_person($pid)*100,2) . " Prozent";  ?>




  </div>
</div>
