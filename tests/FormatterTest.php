<?php
/**
 * Created by PhpStorm.
 * User: elminsondeoleo
 * Date: 2019-07-12
 * Time: 20:13
 */

namespace TDD\Test;

require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\Formatter;

/**
 * Class FormatterTest
 * @package TDD\Test
 */
class FormatterTest extends TestCase
{
    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->Formatter = new Formatter();
    }


    /**
     *
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->Formatter);
    }

    /**
     * @param $input
     * @param $expected
     * @param $msg
     * @dataProvider provideCurrencyAmt
     */
    public function testCurrencyAmt($input, $expected, $msg)
    {
        $this->assertSame(
            $expected,
            $this->Formatter->currencyAmt($input),
            $msg
        );
    }

    /**
     * @return array
     */
    public function provideCurrencyAmt()
    {
        return [
            [1, 1.00, '1 should be transformed into 1.00'],
            [1.1, 1.10, '1 should be transformed into 1.10'],
            [1.11, 1.11, '1 should be stay into 1.11'],
            [1.111, 1.11, '1 should be transformed into 1.11'],
        ];
    }

}
