<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" />
    <title>Web Statistics</title>
</head>

<body>
    <?php include "navbar/navbar.php";
    if (isset($_SESSION['utente'])) {
    ?>

        <div class="container">
            <div class="intestazione">
                <span class="home">Dashboard</span>
                <div class="btn btn-primary tooltip"><img src="https://img.icons8.com/ios/30/000000/help.png" />
                    <div class="right">
                        <p>In questa pagina puoi trovare un riepilogo delle visite effettuate al tuo sito web.</p>
                        <i></i>
                    </div>
                </div>
            </div>

            <div class="visite">
                <div class="visit">
                    <span class="time">Totale</span><br>
                    <span class="number"><?php visitePeriodo("all") ?></span>
                    <span class="visita">visite</span>
                </div>
                <div class="visit">
                    <span class="time">Oggi</span><br>
                    <span class="number"><?php visitePeriodo("day") ?></span>
                    <span class="visita">visite</span><br>
                    <?php percentuale("day") ?>
                </div>
                <div class="visit">
                    <span class="time">Settimana</span><br>
                    <span class="number"><?php visitePeriodo("week") ?></span>
                    <span class="visita">visite</span><br>
                    <?php percentuale("week") ?>
                </div>
                <div class="visit">
                    <span class="time">Mese</span><br>
                    <span class="number"><?php visitePeriodo("month") ?></span>
                    <span class="visita">visite</span><br>
                    <?php percentuale("month") ?>
                </div>
            </div>
            <br>
            <div class="filter">
                <div class="form">
                    <select name="periodo" id="periodo" class="filtra">
                        <option value="all">Tutto</option>
                        <option value="day">Ultimo giorno</option>
                        <option value="week">Ultima settimana</option>
                        <option value="month">Ultimo mese</option>
                    </select>
                    <select name="pagina" id="pagina" class="filtra">
                        <option value="all">Tutte le pagine</option>
                        <option value="index">Homepage</option>
                        <option value="citta">Citt&agrave;</option>
                        <option value="servizi">Servizi</option>
                    </select>
                    <input type="submit" value="Filtra" onclick="reloadGraph('home')" class="filtra">
                </div>
            </div>
            <br>
            <div class="charts">
                <div class="XYchart grafico">
                </div>
            </div>

        </div>

    <?php
    } else {
        header("Location:accesso/login.php");
    }

    function visitePeriodo($periodo) //funzione per calcolare le visite giorno/settimana/mese homepage
    {
        include "../dbopen.php";

        switch ($periodo) {
            case 'day':
                $query = "select count(*) as numerovisite from accesso where day(data)=day(curdate()) and month(data)=month(curdate());";
                break;

            case 'week':
                $query = "select count(*) as numerovisite from accesso where datediff(curdate(),data)<7;";
                break;

            case 'month':
                $query = "select count(*) as numerovisite from accesso where month(data)=month(curdate()) and year(data)=year(curdate());";
                break;

            case 'all':
                $query = "select count(*) as numerovisite from accesso";
                break;

            default:
                echo "parametro non corretto";
                break;
        }

        $res = mysqli_query($dbconn, $query) or die("errore nella query");

        $riga = mysqli_fetch_array($res);

        echo $riga['numerovisite'];
    }

    function percentuale($periodo) //funzione per calcolare la percentuale di variazione visite giorno/settimana/mese homepage
    {

        include "../dbopen.php";

        switch ($periodo) {
            case 'day':
                $query2 = "create table if not exists temp as select count(*) as numerovisiteoggi from accesso where day(data)=day(curdate()) and month(data)=month(curdate());";

                mysqli_query($dbconn, $query2) or die("errore nella query 1");

                $query2 = "SELECT count(*) as numerovisiteieri FROM accesso WHERE ADDDATE( CURDATE( ) , INTERVAL -1 DAY ) = data;";

                $res = mysqli_query($dbconn, $query2) or die("errore nella query 2");

                $riga = mysqli_fetch_array($res);

                $visiteieri = $riga['numerovisiteieri'];

                $query2 = "ALTER TABLE temp ADD numerovisiteieri int default $visiteieri;";

                mysqli_query($dbconn, $query2) or die("errore nella query 3");

                $query2 = "SELECT numerovisiteoggi, numerovisiteieri from temp;";

                $res = mysqli_query($dbconn, $query2) or die("errore nella query 4");

                $riga = mysqli_fetch_array($res);

                $visiteoggi = $riga['numerovisiteoggi'];

                if ($visiteieri == 0) {
                    $percentuale = $visiteoggi * 100;
                } else {
                    if (($visiteoggi - $visiteieri) >= 0) {
                        $percentuale = intval(($visiteoggi * 100) / $visiteieri);
                        $percentuale =  $percentuale - 100;
                    } else {
                        $percentuale = intval(- ($visiteoggi * 100) / $visiteieri);
                        $percentuale =  -100 - $percentuale;
                    }
                }
                $query2 = "DROP table temp;";

                mysqli_query($dbconn, $query2) or die("errore nella query");

                if ($percentuale >= 0)
                    echo "<span class='verde'>&#x25B2; +$percentuale%</span>";
                else
                    echo "<span class='rosso'>&#x25BC; $percentuale%</span>";

                break;

            case 'week':
                $query2 = "create table if not exists temp2 as select count(*) as numerovisiteoggi from accesso where datediff(curdate(),data)<7;";

                mysqli_query($dbconn, $query2) or die("errore nella query 1");

                $query2 = "SELECT count(*) as numerovisiteieri FROM accesso where datediff(ADDDATE( CURDATE( ) , INTERVAL -7 day ),data)<7 and datediff(ADDDATE( CURDATE( ) , INTERVAL -7 day ),data)>=0;";

                $res = mysqli_query($dbconn, $query2) or die("errore nella query 2");

                $riga = mysqli_fetch_array($res);

                $visiteieri = $riga['numerovisiteieri'];

                $query2 = "ALTER TABLE temp2 ADD numerovisiteieri int default $visiteieri;";

                mysqli_query($dbconn, $query2) or die("errore nella query 3");

                $query2 = "SELECT numerovisiteoggi, numerovisiteieri from temp2;";

                $res = mysqli_query($dbconn, $query2) or die("errore nella query 4");

                $riga = mysqli_fetch_array($res);

                $visiteoggi = $riga['numerovisiteoggi'];

                if ($visiteieri == 0) {
                    $percentuale = $visiteoggi * 100;
                } else {
                    if (($visiteoggi - $visiteieri) >= 0) {
                        $percentuale = intval(($visiteoggi * 100) / $visiteieri);
                        $percentuale =  $percentuale - 100;
                    } else {
                        $percentuale = intval(- ($visiteoggi * 100) / $visiteieri);
                        $percentuale =  -100 - $percentuale;
                    }
                }

                $query2 = "DROP table temp2;";

                mysqli_query($dbconn, $query2) or die("errore nella query");

                if ($percentuale >= 0)
                    echo "<span class='verde'>&#x25B2; +$percentuale%</span>";
                else
                    echo "<span class='rosso'>&#x25BC; $percentuale%</span>";
                break;

            case 'month':
                $query2 = "create table if not exists temp3 as select count(*) as numerovisiteoggi from accesso where month(data)=month(curdate());";

                mysqli_query($dbconn, $query2) or die("errore nella query 1");

                $query2 = "SELECT count(*) as numerovisiteieri FROM accesso WHERE month(ADDDATE( CURDATE( ) , INTERVAL -1 month))=month(data);";

                $res = mysqli_query($dbconn, $query2) or die("errore nella query 2");

                $riga = mysqli_fetch_array($res);

                $visiteieri = $riga['numerovisiteieri'];

                $query2 = "ALTER TABLE temp3 ADD numerovisiteieri int default $visiteieri;";

                mysqli_query($dbconn, $query2) or die("errore nella query 3");

                $query2 = "SELECT numerovisiteoggi, numerovisiteieri from temp3;";

                $res = mysqli_query($dbconn, $query2) or die("errore nella query 4");

                $riga = mysqli_fetch_array($res);

                $visiteoggi = $riga['numerovisiteoggi'];

                if ($visiteieri == 0) {
                    $percentuale = $visiteoggi * 100;
                } else {
                    if (($visiteoggi - $visiteieri) >= 0) {
                        $percentuale = intval(($visiteoggi * 100) / $visiteieri);
                        $percentuale =  $percentuale - 100;
                    } else {
                        $percentuale = intval(- ($visiteoggi * 100) / $visiteieri);
                        $percentuale =  -100 - $percentuale;
                    }
                }

                $query2 = "DROP table temp3;";

                mysqli_query($dbconn, $query2) or die("errore nella query");

                if ($percentuale >= 0)
                    echo "<span class='verde'>&#x25B2; +$percentuale%</span>";
                else
                    echo "<span class='rosso'>&#x25BC; $percentuale%</span>";
                break;

            case 'all':
                $query = "select count(*) as numerovisite from accesso";
                break;

            default:
                echo "parametro non corretto";
                break;
        }
    }

    include "footer.html";

    ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        reloadGraph("home");
    });
</script>
<script src="//cdn.amcharts.com/lib/4/core.js"></script>
<script src="//cdn.amcharts.com/lib/4/charts.js"></script>
<script src="//www.amcharts.com/lib/4/themes/animated.js"></script>
<script src="//www.amcharts.com/lib/4/lang/it_IT.js"></script>
<script src="charts.js"></script>

</html>

<?php include "../dbclose.php"; ?>