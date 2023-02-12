<?php
include "getinfo.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/favicon.ico" />
    <title>Servizi</title>
</head>

<body>
    <?php include "navbar.html"; ?>
    <div class="container-fluid vertical-center">
        <div class="container-md">
            <p class="display-2">Servizi offerti</p>
            <span class="align-middle">
                <div class="card">
                    <div class="card-body">
                        <ul>
                            <li>
                                <h4>Sportello Unico Digitale</h4>
                                Un solo punto di accesso per qualsiasi procedimento amministrativo, dalle istanze legate alle attività produttive all’edilizia e non solo. Informazioni e modulistica
                            </li><br>
                            <li>
                                <h4>Area download</h4>
                                Modulistica e documenti utili
                            </li><br>
                            <li>
                                <h4>Bandi di Gara e Concorsi Pubblici attivi</h4>
                                Elenco dei Bandi di Gara e Concorsi Pubblici non ancora scaduti
                            </li><br>
                            <li>
                                <h4>Ricerca delibere</h4>
                                Archivio delle delibere di Giunta e di Consiglio Comunale
                            </li><br>
                            <li>
                                <h4>Ricerca determine</h4>
                                Strumento di ricerca delle determine dirigenziali
                            </li><br>
                            <li>
                                <h4>Contratti pubblici di lavori, servizi e forniture</h4>
                                Ricerca dei contratti pubblici di lavori, servizi e forniture pubblicati ai sensi dell'art. 37 c. 1,2 del Decreto Legislativo n. 33/2013
                            </li>
                        </ul>
                    </div>
                </div>
            </span>
        </div>
    </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</html>

<?php
include "../dbclose.php";
?>