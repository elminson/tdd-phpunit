<?php
namespace TDD;
/**
 * Class Receipt
 * @package TDD
 */
class Receipt {
    /**
     * @param array $items
     * @return float|int
     */
    public function total(array $items = []) {
		return array_sum($items);
	}
}
