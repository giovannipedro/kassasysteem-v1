<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <script src='https://code.jquery.com/jquery-3.5.1.js'>
    </script>
    <title>Document</title>
</head>

<body>
    <?php

    use Acme\model\ProductModel;
    use Acme\model\ProductTafelModel;
    use Acme\classes\Rekening;
    use Stripe\Checkout\Session;
    use Stripe\Stripe;

    require "../vendor/autoload.php";

    $idTafel = $_GET['idtafel'] ?? null;
    if ($idTafel) {

        // TODO: bestelling ophalen en tonen op een mooie manier door gebruik te maken van Rekening.php
        $rekening = new Rekening($idTafel);
        $bill = $rekening->getBill($idTafel);

        // Toon de bestelling op een mooie manier
        echo "<div class='container'>";
        echo "<table class='centered-table'>";
        echo "<tr><td>Tafel:</td><td>" . $idTafel . "</td></tr>";
        echo "<tr><td>Datum/Tijd:</td><td>" . $bill['datumtijd']['formatted'] . "</td></tr>";
        echo "<tr><td>Producten:</td><td></td></tr>";
        $totaal = $bill['totaal'];
        $btwtotaal = $totaal * 0.21;
        foreach ($bill['products'] as $productId => $product) {
            echo "<tr><td>Product:</td><td>" . $product['data']['naam'] . "</td><a></tr>";
            echo "<tr><td>Aantal:</td><td>" . $product['aantal'] . "</td></tr>";
        }
        echo "<tr><td>Totaal:</td><td>€" . $bill['totaal'] . "</td></tr>";
        echo "<tr><td> %21 btw:</td><td>€" . $btwtotaal . "</td></tr>";
        echo "</table>";

        // Toon de betaalknop
        echo '<form method="POST" action="" class="btn-div">
        <button type="submit" name="pay-btn">Betalen</button>
    </form>';
        echo "</div>";



        // Handle form submission
        if (isset($_POST['pay-btn'])) {
            if ($bill['totaal'] != "0") {
                // Update payment status using ProductTafelModel
                $productTafelModel = new ProductTafelModel();
                $productTafelModel->updatePaymentStatus($idTafel);

                // Verwijst je naar de succes pagina
                header("Location: succes.php");
                exit(); // Voeg deze regel toe om te voorkomen dat de rest van de code wordt uitgevoerd na het doorsturen
            } else {
                echo "<script>
            if (confirm('Afreken Totaal kan niet 0 zijn, voeg wat producten toe om te kunnen betalen')) {
                window.location.href = 'product.php?idtafel=$idTafel'; // Doorverwijzen naar anderepagina.php als gebruiker op OK klikt
            } else {
                window.location.href = 'product.php?idtafel=$idTafel'; // Doorverwijzen naar de product.php met het meegegeven id
            }
            </script>";
                exit(); // Voeg deze regel toe om te voorkomen dat de rest van de code wordt uitgevoerd na het doorsturen
            }
        }
    } else {
        http_response_code(404);
        include('error_404.php');
        die();
    }
    ?>
    <script src="./index.js"></script>
</body>

</html>