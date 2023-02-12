<?php

include "../dbopen.php";

for ($i = 0; $i < 123; $i++) {
    $start = strtotime("20 April 2021");

    //End point of our date range.
    $end = strtotime("31 May 2021");

    //Custom range.
    $timestamp = mt_rand($start, $end);

    //Print it out.
    $data =  date("Y-m-d", $timestamp);

    $ora = date("h:i:s");

    $randIP = mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255);

    $countries = array("Italy", "Germany", "United Kingdom", "Ireland", "France", "Switzerland");

    $country = $countries[mt_rand(0, sizeof($countries) - 1)];

    $devices = array("mobile", "desktop");

    $device = $devices[mt_rand(0, 1)];

    $pagine = array(1, 2, 3);

    $pagina = $pagine[mt_rand(0, sizeof($pagine) - 1)];

    $query = "INSERT into accesso(data, ora, ip, country, device, codpagina) values ('$data', '$ora', '$randIP', '$country', '$device', '$pagina')";

    mysqli_query($dbconn, $query) or die("errore nella query");
}

include "../dbclose.php";