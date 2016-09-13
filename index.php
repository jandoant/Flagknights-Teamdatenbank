<!DOCTYPE html>
<html>
  <head>
    <title>Flag Knights - Teamdatenbank</title>
    <!-- META-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--STYLESHEETS-->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
    <!-- Login-HEADER-->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display-->
        <div class="navbar-header"><a href="#" class="navbar-brand">Teamdatenbank</a>
          <p class="navbar-text navbar-right">Flag Knights</p>
        </div>
      </div>
    </nav>
    <!-- Login-FORMULAR-->
    <div class="container">
      <form action="php/func/login.func.php" method="POST" class="form-signin">
        <!--Überschrift-->
        <h2 class="form-signin-heading">Anmeldung</h2>
        <!--EMAIL-Feld-->
        <label for="loginEmail" class="sr-only">Email</label>
        <input id="loginEmail" type="email" name="loginEmail" placeholder="Email" required="" autofocus="" class="form-control">
        <!--PASSWORT-Feld-->
        <label for="loginPassword" class="sr-only">Passwort</label>
        <input id="loginPassword" type="password" name="loginPasswort" placeholder="Password" required="" class="form-control">
        <!--REMEMBER-Checkbox-->
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me">Angaben merken
          </label>
        </div>
        <!--SUBMIT-Button-->
        <button type="submit" name="loginSubmit" class="btn btn-lg btn-success btn-block">Anmelden</button>
      </form>
    </div>
  </body>
  <!--JAVASCRIPT-->
  <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
  <!-- moment.js-->
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <!--Bootstrap-->
  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap-datetimepicker.js"></script>
  <!-- TableSort-->
  <script src="js/stupidtable.js"></script>
  <script src="js/jd_sort_table.js"></script>
</html>