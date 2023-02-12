<?php
include "dbconfig.php";
$dbconn = mysqli_connect($dbhost,$dbuser,$dbpass) or die ("errore di connessione al server");
mysqli_select_db($dbconn,$dbnome) or die ("errore nella scelta del database");
?>