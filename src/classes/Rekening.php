<?php

namespace Acme\classes;

use Acme\model\ProductModel;
use Acme\model\ProductTafelModel;
use Acme\model\TafelModel;
use DateTime;

class Rekening
{

    public function setPaid($idTafel): void
    {
        //TODO: de rekening voor een bepaalde tafel op betaald zetten

    }

    /**
     * @param $idTafel
     *
     * @return array
     */
    public function getBill($idTafel): array
    {
        $bill = [];
        $bm = new ProductTafelModel();
        $bestelling = $bm->getBestelling($idTafel);

        $tm = new TafelModel();

        $bill['tafel'] = $tm->getTafel($idTafel);
        $bill['datumtijd'] = [
            'timestamp' => $bestelling['datumtijd'],
            'formatted' => date('d-m-Y H:i:s', $bestelling['datumtijd'])
        ];

        if (isset($bestelling['products'])) {
            foreach ($bestelling['products'] as $idProduct) {
                if (!isset($bill['products'][$idProduct]['data'])) {
                    $bill['products'][$idProduct]['data'] = (new ProductModel())->getProduct(
                        $idProduct
                    );
                }
                if (!isset($bill['products'][$idProduct]['aantal'])) $bill['products'][$idProduct]['aantal'] = 0;
                $bill['products'][$idProduct]['aantal']++;
            }
        }

        //TODO: 'totaal' toevoegen aan de rekening
        $totaal = 0;
        foreach ($bill['products'] as $product) {
            $totaal += $product['data']['prijs'] * $product['aantal'];
        }
        $bill['totaal'] = $totaal;

        return $bill;
    }
}
