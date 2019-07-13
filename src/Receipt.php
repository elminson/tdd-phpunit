<?php

namespace TDD;
/**
 * Class Receipt
 * @package TDD
 */
class Receipt
{
    /**
     * @param array $items
     * @return float|int
     */
    public function total(array $items = [], $coupon)
    {
        $sum = array_sum($items);
        if (!is_null($coupon)) {
            return $sum - ($sum * $coupon);
        }

        return $sum;
    }

    /**
     * @param $amount
     * @param $tax
     * @return float|int
     */
    public function tax($amount, $tax)
    {
        return ($amount * $tax);
    }

    /**
     * @param $items
     * @param $tax
     * @param $coupon
     * @return float|int
     */
    public function postTaxTotal($items, $tax, $coupon)
    {
        $subtotal = $this->total($items, $coupon);
        return $subtotal + $this->tax($subtotal, $tax);
    }
}
