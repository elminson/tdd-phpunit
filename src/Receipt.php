<?php

namespace TDD;

use \BadMethodCallException;
/**
 * Class Receipt
 * @package TDD
 */
class Receipt
{
    public function __construct($formatter)
    {
        $this->Formatter = $formatter;
    }

    /**
     * @param array $items
     * @return float|int
     */
    public function subtotal(array $items = [], $coupon)
    {
        if($coupon > 1.00){
            throw new BadMethodCallException('Coupon must be les than or equal to 1.00');
        }
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
    public function tax($amount)
    {
        return $this->Formatter->currencyAmt($amount * $this->tax);
    }

    /**
     * @param $items
     * @param $tax
     * @param $coupon
     * @return float|int
     */
    public function postTaxTotal($items, $coupon)
    {
        $subtotal = $this->subtotal($items, $coupon);
        return $subtotal + $this->tax($subtotal);
    }

}
