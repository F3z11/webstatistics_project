<?php
session_start();

//controllo se la pagina che l'utente sta visitando è la stessa di quella precedente

if (isset($_SESSION['previous']))
    if (basename($_SERVER['PHP_SELF']) != $_SESSION['previous']) {
        UNSET ($_SESSION['user']);
    }

//funzione per controllare se il dispositivo da cui viene visitata la pagina è di tipo mobile

function isMobileDevice()
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

//funzione per inserire un accesso nel database

function insertAccesso()
{
    include "../dbopen.php";

    $ip_address = $_SERVER['REMOTE_ADDR'];

    $url = 'http://ip-api.com/json/' . $ip_address . '?fields=country';

    $json = file_get_contents($url);

    $dataLocation = json_decode($json);

    $country = $dataLocation->country;

    $date = date('Y-m-d');

    $hour = date("H:i:s");

    if(isMobileDevice()){
        $device = "mobile";
    }
    else {
        $device = "desktop";
    }
	
	$pagename = basename($_SERVER['PHP_SELF']);

    $query = "SELECT max(codpagina) as codpagina from paginaweb where nomepagina='$pagename';";

    $res = mysqli_query($dbconn, $query) or die("errore nella query");

    $riga = mysqli_fetch_array($res);

    $codpagina = $riga['codpagina'];

    $query = "INSERT into accesso(data, ora, ip, country, device, codpagina) values ('$date', '$hour', '$ip_address', '$country', '$device', '$codpagina')";

    mysqli_query($dbconn, $query) or die("errore nella query 3");
}

include "../dbopen.php";

//controllo se l'utente che visita la pagina l'ha già visitata in precedenza

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = true;

    insertAccesso();
}

$_SESSION['previous'] = basename($_SERVER['PHP_SELF']);