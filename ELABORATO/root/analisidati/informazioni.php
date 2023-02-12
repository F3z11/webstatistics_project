<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" />
    <title>Informazioni</title>
</head>

<body>
    <?php include "navbar/navbar.php";
    if (isset($_SESSION['utente'])) { ?>
        <div class="container">
            <div class="intestazione">
                <span class="titolo">Informazioni</span>
                <div class="btn btn-primary tooltip"><img src="https://img.icons8.com/ios/30/000000/help.png" />
                    <div class="right">
                        <p>In questa pagina puoi trovare una breve descrizione del sito.</p>
                        <i></i>
                    </div>
                </div>
            </div>

            <div class="info">
                    <span><b>Web Statistics</b> &egrave; un'applicazione web pensata per una gestione semplice del tuo sito web. <br> Fornisce un'elaborazione completa e dettagliata dell'andamento del tuo sito, permettendo di filtrare i contenuti con facilit&agrave;. &Egrave; una piattaforma con una grafica semplice ma allo stesso tempo piacevole, pensata per non distrarre l'attenzione dal contenuto e per garantire la semplicit&agrave; d'uso.</span>
                    <br><br><span>Sito sviluppato da <b>Federico Clerici</b>.</span><br>
                    <span>Tutti i diritti riservati.</span><br><br>
                    <span>Contatti:</span><br>
                    <span>- Telefono: 3881028900</span><br><span>- E-mail: <a class="email" href="mailto:fez.cle@gmail.com">fez.cle@gmail.com</a></span><br>
                </div>
            </div>

        </div>
    <?php
    } else {
        header("Location: accesso/login.php");
    }
    include "footer.html"; ?>
</body>

</html>