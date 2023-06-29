<?php

use Acme\classes\Bestelling;

require "../vendor/autoload.php";

if ($idTafel = $_POST['idtafel'] ?? false) {

    // TODO: De bestelling doorvoeren in de database (maak gebruik van de Bestelling class)
    // $bestelling = new Bestelling($idTafel);
    // $bestelling->addProducts($_POST['products'] ?? []);
    // $bestelling->saveBestelling();

    $productArray = array();

    foreach ($_POST['products'] as $product) {
        for ($i = 0; $i <= $_POST['product' . $product]; $i++) {
            $productArray[] = $product;
        }
    }
    $bestelling = new Bestelling($idTafel);
    $bestelling->addProducts($productArray ?? []);
    $bestelling->saveBestelling();
    var_dump($productArray);
} else {
    http_response_code(404);
    include('error_404.php');
    die();
}

header("Location: index.php");
