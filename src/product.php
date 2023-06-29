<?php

namespace Acme;

use Acme\model\ProductModel;
use Stripe\Terminal\Location;

require "../vendor/autoload.php";
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src='https://code.jquery.com/jquery-3.5.1.js'></script>

    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>

<body>
    <form action="bestellingdoorvoeren.php" method="post">
        <?php
        //maakt instantie.
        $productModel = new ProductModel();

        //haalt alle tafels op van de class tafelmodel.
        $products = $productModel->getAll();
        // QUESTION: Wat doet ?? in de code-regel hier onder?
        // Antwoord:
        $idTafel = $_GET['idtafel'] ?? false;
        if ($idTafel) {

            echo "<input type='hidden' name='idtafel' value='$idTafel'>";

            // TODO: alle producten ophalen uit de database en als inputs laten zien (maak gebruik van ProductModel class)
            // Zoiets als dit:
            foreach ($products as $product) {
                $naam = $product->getColumnValue('naam');
                $prijs = $product->getColumnValue('prijs');
                $idproduct = $product->getColumnValue('idproduct');
                echo "<div class='product-items'>";
                echo "<label><input type='checkbox' name='products[]' value='{$idproduct}'>{$naam}</label>";
                echo " <label>€${prijs}</label>";
                echo " <label>Aantal:<input type='number' name='product{$idproduct}'></label>";
                echo " </div>";
            }
            echo "<button>Volgende</button>";
        } else {
            // QUESTION: Wat gebeurt hier?
            // Antwoord:
            http_response_code(404);
            include('error_404.php');
            die();
        }
        ?>

    </form>
    <button id="btn-popup" class="secondary-btn">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
            <style>
                svg {
                    fill: #ffffff
                }
            </style>
            <path d="M0 80C0 53.5 21.5 32 48 32h96c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80zM64 96v64h64V96H64zM0 336c0-26.5 21.5-48 48-48h96c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V336zm64 16v64h64V352H64zM304 32h96c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H304c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48zm80 64H320v64h64V96zM256 304c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s7.2 16 16 16h32c8.8 0 16-7.2 16-16s7.2-16 16-16s16 7.2 16 16v96c0 8.8-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s-7.2-16-16-16s-16 7.2-16 16v64c0 8.8-7.2 16-16 16H272c-8.8 0-16-7.2-16-16V304zM368 480a16 16 0 1 1 0-32 16 16 0 1 1 0 32zm64 0a16 16 0 1 1 0-32 16 16 0 1 1 0 32z" />
        </svg>
        Tafel QR code
    </button>
    <div class="popup-overlay ">
        <div id="popup-content">
            <div class="close-btn" id="close-popup"> X</div>
            <div class='text-center'>

                <!-- Get a Placeholder image initially,
    this will change according to the
    data entered later -->
                <img src='https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0' class='qr-code img-thumbnail img-responsive' />
            </div>

            <div class='form-horizontal'>
                <div class='form-group'>
                    <div class='col-sm-10'>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./index.js"></script>
</body>

</html>