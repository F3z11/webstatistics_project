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
    <title>Citt&agrave;</title>
</head>

<body>
    <?php include "navbar.html"; ?>
    <div class="container-fluid vertical-center">
        <div class="container-md">
            <p class="display-2">Informazioni sulla citt&agrave;</p>
            <span class="align-middle">
                <div class="card">
                    <div class="card-body">
                        Ad Arona e sulle sponde del lago molti popoli tra i quali celti, romani e longobardi lasciarono le loro tracce nella lingua, nella toponomastica e nei reperti archeologici.
                        Numerosi reperti rinvenuti in località Lagoni testimoniano l'esistenza di una civiltà palafitticola; importanti sono anche i ritrovamenti sulla Rocca che domina la città.<br><br>

                        Un manoscritto monastico dell'XI secolo attesta la fondazione dell'abbazia dedicata ai Martiri Graziano e Felino, ultimata intorno al 979.
                        L'abbazia benedettina governò il luogo fino a che, nel XII secolo, non divenne parte dei domini dei Torriani e nel 1277 dei Visconti.<br><br>

                        Nel 1439 il feudo di Arona passò ai Borromeo che lo mantennero fino al XVIII secolo. Proprio nel castello della Rocca, il 2 ottobre 1538, nacque San Carlo Borromeo.<br><br>

                        Nel 1744 Arona venne dichiarata Città da Carlo Emanuele III di Savoia. Le fonti certe in merito risalgono, però, soltanto all'Editto Postale promulgato nel 1838.<br><br>

                        Dopo gli anni della dominazione napoleonica Arona tornò sotto i Savoia fino alla proclamazione dell'Unità.<br><br>

                        La realizzazione della linea ferroviaria Novara-Arona nel 1855 potenziò i collegamenti, già attivi e promossi dalla navigazione del Lago Maggiore, con il resto d'Italia e con l'Europa. All'espansione del settore commerciale, si è affiancata l'affermazione delle attività industriali e alberghiere, legate ad un fiorente turismo.
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