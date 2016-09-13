<?php

/*
Wandelt ein Datum des Formats DD.MM.YYYY in
Datum des Formats YYYY-MM-DD um
*/
  function date_german2mysql($date) {
    $d    =    explode(".",$date);
    return sprintf("%04d-%02d-%02d", $d[2], $d[1], $d[0]);
  }

/*
Wandelt ein Datum des Formats YYYY-MM-DD in
Datum des Formats DD.MM.YYYY um
*/
  function date_mysql2german($date) {
    $d    =    explode("-",$date);
    return    sprintf("%02d.%02d.%04d", $d[2], $d[1], $d[0]);
  }

/*
berechnet den Zeitunterschied in Jahren zwischen zwei Daten
eins davon ist das aktuelle Datum
*/
  function calc_age($date)
  {
    //1. Übergebenes Datum
    $datetime = new DateTime($date);
    //2. Aktuelles Datum
    $datetime2 = new DateTime();
    //3. Berechnung des Zeitunterschiedes
    $interval = $datetime->diff($datetime2);
    //4. Rückgabe des Zeitunterschiedes in Jahren
    return $interval->format("%y");
  }

  /*
  Wandelt volles mySQL Datetime in Uhrzeit um
  */
  function mysql2clocktime($date){
    $format='H:i';
    return date($format,  strtotime($date));
  }

  function  date_dayoftheweek_german($date){
    $dayoftheweek = date( "w", strtotime($date));
    $wochentage = array ('Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag');
    return $wochentage[$dayoftheweek];
  }
 ?>
