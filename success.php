<?php session_start(); ?>
<?php
//Setzen der Parameter der Erfolgs-/Misserfolgsmeldung

  if (isset($_SESSION['success_add_termin']) and $_SESSION['success_add_termin'] == true) {
      $message = 'Der Termin wurde der Datenbank erfolgreich hinzugefügt!';
      $label = 'success';
      $glyph = 'glyphicon glyphicon-ok';
      $url = 'dashboard.php?s=termine&action=overview';
  } elseif (isset($_SESSION['success_add_termin']) and $_SESSION['success_add_termin'] == false) {
      $message = 'Leider ist etwas schief gelaufen!';
      $label = 'danger';
      $glyph = 'glyphicon glyphicon-flash';
      $url = 'dashboard.php?s=termine&action=overview';
  }
  $_SESSION['success_add_termin']=NULL;

  if (isset($_SESSION['success_delete_person']) and $_SESSION['success_delete_person'] == true) {
      $message = 'Die Person wurde erfolgreich aus der Datenbank entfernt!';
      $label = 'success';
      $glyph = 'glyphicon glyphicon-ok';
      $url = 'dashboard.php?s=personen&action=overview';
  } elseif (isset($_SESSION['success_delete_person']) and $_SESSION['success_delete_person'] == false) {
      $message = 'Leider ist etwas schief gelaufen!';
      $label = 'danger';
      $glyph = 'glyphicon glyphicon-flash';
      $url = 'dashboard.php?s=personen&action=overview';
  }
  $_SESSION['success_delete_termin']=NULL;

  if (isset($_SESSION['success_delete_termin']) and $_SESSION['success_delete_termin'] == true) {
      $message = 'Der Termin wurde erfolgreich aus der Datenbank entfernt!';
      $label = 'success';
      $glyph = 'glyphicon glyphicon-ok';
      $url = 'dashboard.php?s=termine&action=overview';
  } elseif (isset($_SESSION['success_delete_termin']) and $_SESSION['success_delete_termin'] == false) {
      $message = 'Leider ist etwas schief gelaufen!';
      $label = 'danger';
      $glyph = 'glyphicon glyphicon-flash';
      $url = 'dashboard.php?s=termine&action=overview';
  }
  $_SESSION['success_delete_termin']=NULL;

  if (isset($_SESSION['success_add_person']) and $_SESSION['success_add_person'] == true) {
      $message = 'Die Person wurde der Datenbank erfolgreich hinzugefügt!';
      $label = 'success';
      $glyph = 'glyphicon glyphicon-ok';
      $url = 'dashboard.php?s=personen&action=overview';
  } elseif (isset($_SESSION['success_add_person']) and $_SESSION['success_add_person'] == false) {
      $message = 'Leider ist etwas schief gelaufen!';
      $label = 'danger';
      $glyph = 'glyphicon glyphicon-flash';
      $url = 'dashboard.php?s=personen&action=overview';
  }
  $_SESSION['success_add_person']=NULL;

?>

<!-- spezielles CSS-Success laden-->
<link href="css/main.css" rel="stylesheet">
<link href="css/success_add_person.css" rel="stylesheet">
<meta http-equiv="refresh" content='1;url=<?php echo $url; ?>'>
</head>
  <body>
       <!--Anzeige der Erfolgs-/Misserfolgsmeldung -->
     <div class='success_add_person text-center alert alert-<?php echo $label; ?>' role="alert"><strong><?php echo $message; ?></strong><span class="<?php echo $glyph; ?>"></span></div>
     <h2 class="text-center">Sie werden weitergeleitet...</h2>
  </body>
</html>
