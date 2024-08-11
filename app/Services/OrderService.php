<?php

namespace App\Services;

use Exception;

class OrderService
{
    public function format(array $orderData): array
    {
        if ($orderData['currency'] === 'USD') {
            $orderData['price'] = $orderData['price'] * 31;
            $orderData['currency'] = 'TWD';
        }

        return $orderData;
    }

    public function checkOrderData(array $orderData): void
    {
        if (preg_match('/[^a-zA-Z\s]/', $orderData['name']) === 1) {
            throw new Exception('Name contains non-English characters', 400);
        }

        if (ucfirst($orderData['name']) !== $orderData['name']) {
            throw new Exception('Name is not capitalized', 400);
        }

        if ($orderData['price'] > 2000) {
            throw new Exception('Price is over 2000', 400);
        }

        $currencyArray = ['TWD', 'USD'];
        if (!in_array($orderData['currency'], $currencyArray)) {
            throw new Exception('Currency format is wrong', 400);
        }
    }
}
