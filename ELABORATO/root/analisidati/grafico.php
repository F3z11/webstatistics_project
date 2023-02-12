<?php
include "../dbopen.php";

$periodo = mysqli_real_escape_string($dbconn, $_GET['periodo']);
$pagina = mysqli_real_escape_string($dbconn, $_GET['pagina']);
$filtro = mysqli_real_escape_string($dbconn, $_GET['filtro']);

//switch sul filtro per generare le query in base al periodo e alla pagina scelta

switch ($filtro) {
    case 'home':
        switch ($periodo) {
            case 'day':
                if ($pagina == "all")
                    $query = "select count(*) as numero, hour(ora) as ora from accesso where day(data)=day(curdate()) and month(data)=month(curdate()) group by hour(ora);";
                else
                    $query = "select count(*) as numero, hour(ora) as ora from accesso, paginaweb where accesso.codpagina=paginaweb.codpagina and nomepagina='$pagina.php' and day(data)=day(curdate()) and month(data)=month(curdate()) group by hour(ora) ;";
                $flag = "day";
                break;

            case 'week':
                if ($pagina == "all")
                    $query = "select count(*) as numero, day(data) as ora, month(data) as mese from accesso where datediff(curdate(),data)<7 group by day(data), month(data) order by month(data), day(data);";
                else
                    $query = "select count(*) as numero, day(data) as ora, month(data) as mese from accesso, paginaweb where accesso.codpagina=paginaweb.codpagina and nomepagina='$pagina.php' and datediff(curdate(),data)<7 group by day(data), month(data) order by month(data), day(data);";
                $flag = "week";
                break;

            case 'month':
                if ($pagina == "all")
                    $query = "select count(*) as numero, day(data) as ora, month(data) as mese, year(data) as anno from accesso where month(data)=month(curdate()) group by day(data), month(data), year(data) order by year(data), month(data), day(data);";
                else
                    $query = "select count(*) as numero, day(data) as ora, month(data) as mese, year(data) as anno from accesso, paginaweb where accesso.codpagina=paginaweb.codpagina and nomepagina='$pagina.php' and month(data)=month(curdate()) group by day(data), month(data), year(data) order by year(data), month(data), day(data);";
                $flag = "month";
                break;

            case 'all':
                if ($pagina == "all")
                    $query = "select count(*) as numero, day(data) as ora, month(data) as mese, year(data) as anno from accesso group by day(data), month(data), year(data) order by year(data), month(data), day(data);";
                else
                    $query = "select count(*) as numero, day(data) as ora, month(data) as mese, year(data) as anno from accesso, paginaweb where accesso.codpagina=paginaweb.codpagina and nomepagina='$pagina.php' group by day(data), month(data), year(data) order by year(data), month(data), day(data);";
                $flag = "all";
                break;
        }

        $res = mysqli_query($dbconn, $query) or die("errore nella query");

        //switch sul flag per applicare differenti impostazioni in base al periodo scelto per quanto riguarda la home

        switch ($flag) {
            case 'day':
                $i = 0;
                while ($riga = mysqli_fetch_array($res)) {

                    $numero = $riga['numero'];
                    $ora = $riga['ora'];

                    while ($i < $ora) {
                        $posts[] = array('ora' => $i, 'numero' => 0);
                        $i++;
                    }

                    $posts[] = array('ora' => $ora, 'numero' => $numero);
                }

                $i++;

                while ($i < 24) {
                    $posts[] = array('ora' => $i, 'numero' => 0);
                    $i++;
                }
                break;
            case 'week':
                $i = 0;
                while ($riga = mysqli_fetch_array($res)) {

                    $numero = $riga['numero'];
                    $ora = $riga['ora'];
                    $mese = $riga['mese'];
                    $year = date("Y");

                    $posts[] = array('ora' => "$year-$mese-$ora", 'numero' => $numero);
                    $i++;
                }
                break;

            default:
                while ($riga = mysqli_fetch_array($res)) {

                    $numero = $riga['numero'];
                    $ora = $riga['ora'];
                    if ($ora < 10)
                        $ora = "0" . $ora;
                    $mese = $riga['mese'];
                    $year = $riga['anno'];

                    $posts[] = array('ora' => "$year-$mese-$ora", 'numero' => $numero);
                }
                break;
        }

        $fp = fopen('dataCharts/results.json', 'w');
        fwrite($fp, json_encode($posts));
        fclose($fp);
        break;

    case 'dispositivi':
        switch ($periodo) {
            case 'day':
                if ($pagina == "all")
                    $query = "select count(*) as numero, device from accesso where day(data)=day(curdate()) group by device;";
                else
                    $query = "select count(*) as numero, device from accesso, paginaweb where accesso.codpagina=paginaweb.codpagina and nomepagina='$pagina.php' and day(data)=day(curdate()) group by device;";
                break;

            case 'week':
                if ($pagina == "all")
                    $query = "select count(*) as numero, device from accesso where datediff(curdate(),data)<7 group by device;";
                else
                    $query = "select count(*) as numero, device from accesso, paginaweb where accesso.codpagina=paginaweb.codpagina and nomepagina='$pagina.php' and datediff(curdate(),data)<=7 group by device;";
                break;

            case 'month':
                if ($pagina == "all")
                    $query = "select count(*) as numero, device from accesso where month(data)=month(curdate()) group by device;";
                else
                    $query = "select count(*) as numero, device from accesso, paginaweb where accesso.codpagina=paginaweb.codpagina and nomepagina='$pagina.php' and month(data)=month(curdate()) group by device;";
                break;

            case 'all':
                if ($pagina == "all")
                    $query = "select count(*) as numero, device from accesso group by device;";
                else
                    $query = "select count(*) as numero, device from accesso, paginaweb where accesso.codpagina=paginaweb.codpagina and nomepagina='$pagina.php' group by device;";
                break;
        }
        $res = mysqli_query($dbconn, $query) or die("errore nella query");

        while ($riga = mysqli_fetch_array($res)) {

            $numero = $riga['numero'];
            $device = $riga['device'];

            $posts[] = array('device' => $device, 'numero' => $numero);
        }

        $fp = fopen('dataCharts/resultDevice.json', 'w');
        fwrite($fp, json_encode($posts));
        fclose($fp);
        break;

    case 'location':
        switch ($periodo) {
            case 'day':
                if ($pagina == "all")
                    $query = "select count(*) as numero, country from accesso where day(data)=day(curdate()) group by country;";
                else
                    $query = "select count(*) as numero, country from accesso, paginaweb where accesso.codpagina=paginaweb.codpagina and nomepagina='$pagina.php' and day(data)=day(curdate()) group by country;";
                break;

            case 'week':
                if ($pagina == "all")
                    $query = "select count(*) as numero, country from accesso where datediff(curdate(),data)<7 group by country;";
                else
                    $query = "select count(*) as numero, country from accesso, paginaweb where accesso.codpagina=paginaweb.codpagina and nomepagina='$pagina.php' and datediff(curdate(),data)<=7 group by country;";
                break;

            case 'month':
                if ($pagina == "all")
                    $query = "select count(*) as numero, country from accesso where month(data)=month(curdate()) group by country;";
                else
                    $query = "select count(*) as numero, country from accesso, paginaweb where accesso.codpagina=paginaweb.codpagina and nomepagina='$pagina.php' and month(data)=month(curdate()) group by country;";
                break;

            case 'all':
                if ($pagina == "all")
                    $query = "select count(*) as numero, country from accesso group by country;";
                else
                    $query = "select count(*) as numero, country from accesso, paginaweb where accesso.codpagina=paginaweb.codpagina and nomepagina='$pagina.php' group by country;";
        }

        echo $query;

        $res = mysqli_query($dbconn, $query) or die("errore nella query");

        while ($riga = mysqli_fetch_array($res)) {

            $numero = $riga['numero'];
            $country = $riga['country'];

            $posts[] = array('country' => $country, 'numero' => $numero);
        }

        $fp = fopen('dataCharts/resultLocation.json', 'w');
        fwrite($fp, json_encode($posts));
        fclose($fp);
        break;
}

include "../dbclose.php";