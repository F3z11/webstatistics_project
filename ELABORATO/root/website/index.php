<?php
include "getinfo.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/favicon.ico" />
    <title>Citt&agrave; di Arona</title>
</head>

<body>
    <?php include "navbar.html"; ?>
        <div class="container-fluid vertical-center image">
            <div class="container-md">
            <span class="align-middle">
                <h1 class="display-1">Benvenuto nella citt&agrave; di Arona</h1><br>
                <h1 class="display-6">Qui troverai tutte le informazioni sulla citt&agrave; di Arona</h1>
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