<?php
  session_start();
?>

<?php
//Einbinden eigener DB-Funktionen
include 'db.func.php';
?>

<?php
  //LOGIN-Script
  if (isset($_POST['loginSubmit']) and
      isset($_POST['loginPasswort']) and isset($_POST['loginEmail'])) {

      /*
      vom Nutzer eingegebene Passwortdaten
      müssen mit Userdaten aus Datenbank verglichen werden
      */
      $email = $_POST['loginEmail'];
      $password = $_POST['loginPasswort'];

      //gespeicherten Hash aus Datenbank holen
      //1. SQL-Befehl vorbereiten
      $sql = "SELECT * FROM personen WHERE email = '$email'";
      //2. SQL-Abfrage durchführen und Ergebnis speichern
      $result = query_db($sql);
      //3. gespeichertes Passwort aus DB holen
      $datensatz = mysqli_fetch_assoc($result);
      $gespeicherterHash = $datensatz['passwort'];
      //4. Check ob eingegebenes Passwort korrekt ist
      if (password_verify($password, $gespeicherterHash)) {
          //Fall 1 - Passwort stimmt!
          //--Sessionvariablen für User setzen --> gleich in einer DB-Abfrage
          $_SESSION['loggedIn'] = 1;
          $_SESSION['email'] = $email;
          $_SESSION['user_id'] = $datensatz['person_id'];
          $_SESSION['nachname'] = $datensatz['nachname'];
          $_SESSION['vorname'] = $datensatz['vorname'];
          //--Extra Sicherheitsfeature:
          if (password_needs_rehash($gespeicherterHash, PASSWORD_DEFAULT)) {
              /*
          Korrektes, vom User eingegebenes Passwort wird mit der aktuellsten Methode neu gehasht,
          da Registrierung schon eine Weile her sein kann und die damalige Methode veraltet ist
          (Klartext-Passwort des Users wird nicht geändert!)
          */
          //neuer Hash überschreibt alten Hash in Datenbank
          $neuerHash = password_hash($password, PASSWORD_DEFAULT);
              $sql = "UPDATE personen
                  SET passwort = '$neuerHash'
                  WHERE email = '$email'";
              echo $neuerHash;
          }//Ende if-rehash
        echo 'Das eingegebene Passwort ist korrekt';
        //weiter zum Dashboard
        header('Location: ../../dashboard.php');
      } else {
          // Fall 2 - Passwort ist nicht korrekt
        echo 'Die eingegebene Email-Adresse oder das Kennwort sind falsch';
      }//ENDE Passwortkontrolle
  }//ENDE LOGIN-Script
?>
