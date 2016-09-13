<?php
session_start();
//Überprüfung ob User sich eingeloggt hat
if ($_SESSION['loggedIn'] != 1) {
    header('Location:login.php');
}
include_once 'templates/header.html';
?>
<?php
//Einbinden von eigenen Datums-Funktionen
include 'backend/func/date.func.php';
//Einbinden von eigenen DB-Funktionen
include 'backend/func/db.func.php';
//eigene Terminfunktionen einfügen
include 'backend/func/termine.func.php';
//eigene Personenfunktionen einfügen
include 'backend/func/personen.func.php';
?>


</head>
<body>


<!--TOPNAV-->
<header>
<nav>
     class="navbar navbar-inverse navbar-fixed-top">
     <div class="container-fluid">
       <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="#">Flag Knights</a>
       </div>
       <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right">
           <li><a href="dashboard.php">Übersicht</a></li>
           <li><a href="dashboard.php?s=termine&action=overview">Termine</a></li>
           <li><a href="dashboard.php?s=profil">Profil</a></li>
           <li><a href="backend/func/logout.func.php">LogOut</a></li>
         </ul>
         <form class="navbar-form navbar-right">
           <input type="text" class="form-control" placeholder="Spieler suchen...">
         </form>
       </div>
     </div>
   </nav>
</header>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-3 col-lg-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="dashboard.php?s=termine&action=overview">Termine verwalten</a></li>
            <li><a href="dashboard.php?s=personen&action=overview">Personen verwalten</a></li>
            <li><a href="#">Statistik</a></li>
          </ul>
        </div>
    <main class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3  col-lg-10 col-lg-offset-2 content">
      <?php include('includes/navigation.php') ?>
    </main>
  </div>
</div>











<!--HTML-Footer-->
<?php
include_once 'templates/footer.html';
?>
