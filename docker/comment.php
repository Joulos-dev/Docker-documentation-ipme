<?php

/**
 * @param array $prices
 * @return float
 *
 */
function calculateCartTotal(array $prices)
{
    $total = 0.0;
    $minPrice = null;

    foreach ($prices as $price) {
        /**
         * blabla commentaire supplémentaire
         */
        if ($minPrice === null || $price < $minPrice) {
            $minPrice = $price;
        }
        $total += $price;
    }

    if ($minPrice !== null) {
        $total -= $minPrice;
    }

    return $total;
}


