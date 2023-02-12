<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" />
    <title>Dispositivi</title>
</head>

<body>
    <?php include "navbar/navbar.php";
    if (isset($_SESSION['utente'])) { ?>
        <div class="container">
            <div class="intestazione intestazione2">
                <span class="titolo">Dispositivi</span>
                <div class="btn btn-primary tooltip"><img src="https://img.icons8.com/ios/30/000000/help.png" />
                    <div class="right">
                        <p>In questa pagina puoi visualizzare i dispositivi che accedono al tuo sito web.</p>
                        <i></i>
                    </div>
                </div>
            </div>
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
                    <input type="submit" value="Filtra" onclick="reloadGraph('dispositivi')" class="filtra">
                </div>
            </div>
            <div class="grafico dispositivi">
            </div>
        </div>
    <?php
    } else {
        header("Location: accesso/login.php");
    } 
    include "footer.html";?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        reloadGraph('dispositivi');
    });
</script>
<script src="//cdn.amcharts.com/lib/4/core.js"></script>
<script src="//cdn.amcharts.com/lib/4/charts.js"></script>
<script src="//www.amcharts.com/lib/4/themes/animated.js"></script>
<script src="//www.amcharts.com/lib/4/lang/it_IT.js"></script>
<script src="charts.js"></script>

</html>

<?php include "../dbclose.php"; ?>