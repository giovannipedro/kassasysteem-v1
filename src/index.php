<?php

// In composer.json wordt acme-namespace aan src-folder gekoppeld
// Elk php-bestand moet een namespace hebben, geredeneerd vanuit de src-map (acne-namespace)
namespace Acme;

use Acme\model\TafelModel;

require "../vendor/autoload.php";
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css.css">
    <title>Kiezen tafel</title>
</head>

<body>
    <div class="table-container">


        <?php

        //maakt instantie.
        $tafelModel = new TafelModel();

        //haalt alle tafels op van de class tafelmodel.
        $tafels = $tafelModel->getAll();

        // TODO: alle tafels ophalen uit de database en als hyperlinks laten zien (maak gebruik van class TafelModel)
        // Zoiets als dit:
        foreach ($tafels as $tafel) {
            $idtafel = $tafel->getColumnValue('idtafel');
            $omschrijving = $tafel->getColumnValue('omschrijving');
            echo "<div onclick='window.location.href=`keuze.php?idtafel={$idtafel}`' class='tafels'><a href='keuze.php?idtafel={$idtafel}'>Tafel {$omschrijving}</a></div>";
        }

        ?>
    </div>
</body>

</html>