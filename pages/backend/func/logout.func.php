<?php
//1. Alle Session-Variablen löschen
session_unset();
//2. Die Session löschen
session_destroy();
//3. Nach Logout wieder zur Login-Seite leiten
header('Location:../../login.php');
?>
