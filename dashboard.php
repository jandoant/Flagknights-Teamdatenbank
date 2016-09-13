<!DOCTYPE html><?php
include 'php/func/date.func.php';
include 'php/func/personen.func.php';
include 'php/func/db.func.php';
?>
<html>
  <head>
    <title>Flag Knights - Teamdatenbank</title>
    <!--META-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--STYLESHEETS-->
    <link rel="stylesheet" href="css/main.css">
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
  </head>
  <body> 
    <!--TOPNAV-->
    <header>
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a href="#" class="navbar-brand">Flag Knights</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="dashboard.php">Übersicht</a></li>
              <li><a href="dashboard.php?s=termine&action=overview">Termine</a></li>
              <li><a href="dashboard.php?s=profil">Profil</a></li>
              <li><a href="backend/func/logout.func.php">LogOut</a></li>
            </ul>
            <form class="navbar-form navbar-right">
              <input type="text" placeholder="Spieler suchen..." class="form-control">
            </form>
          </div>
        </div>
      </nav>
    </header>
    <div class="container-fluid">
      <div class="row">
        <!--SIDENAV-->
        <aside class="col-sm-3 col-md-3 col-lg-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview</a></li>
            <li><a href="dashboard.php?s=termine&action=overview">Termine verwalten</a></li>
            <li><a href="dashboard.php?s=personen&action=overview">Personen verwalten</a></li>
            <li><a href="#">Statistik</a></li>
          </ul>
        </aside>
        <!--CONTENT-->
        <main class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2 content">
          <?php 
          include('php/func/navigation.func.php') 
          ?>
        </main>
      </div>
    </div>
  </body>
</html>