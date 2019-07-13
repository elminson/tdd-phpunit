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
use TDD\Receipt;

/**
 * Class ReceiptTest
 * @package TDD\Test
 */
class ReceiptTest extends TestCase
{
    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->Formatter = $this->getMockBuilder('TDD\Formatter')
            ->setMethods(['currencyAmt'])
            ->getMock();
        $this->Formatter->expects($this->any())
            ->method('currencyAmt')
            ->with($this->anything())
            ->will($this->returnArgument(0));
        $this->Receipt = new Receipt($this->Formatter);
    }


    /**
     *
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->Formatter);
        unset($this->Receipt);
    }

    public function provideSubtotal()
    {
        return [
            'ints totalin 16' => [[1, 2, 5, 8], 16],
            [[-1, 2, 5, 8], 14],
            [[1, 2, 8], 11],
            [[1, 2, 8], 11],
        ];
    }

    /**
     * Testing Total
     * @dataProvider provideSubtotal
     */
    public function testSubtotal($items, $expected)
    {

        $coupon = null;
        $output = $this->Receipt->subtotal($items, $coupon);
        $this->assertEquals(
            $expected,
            $output,
            "When Summing the total should equal {$expected}"
        );
    }

    /**
     * Testing Total
     */
    public function testSubtotalAndCoupon()
    {
        $input = [0, 2, 5, 8];
        $coupon = 0.20;
        $output = $this->Receipt->subtotal($input, $coupon);
        $this->assertEquals(
            12,
            $output,
            'When Summing the total should equal 12');
    }

    /**
     * Testing Total
     */
    public function testSubtotalException()
    {
        $input = [0, 2, 5, 8];
        $coupon = 1.20;
        $this->expectException('BadMethodCallException');
        $this->Receipt->subtotal($input, $coupon);

    }

    /**
     *
     */
    public function testTax()
    {
        $inputAmount = 10.00;
        $this->Receipt->tax = 0.10;
        $output = $this->Receipt->tax($inputAmount);
        $this->assertEquals(
            1.00,
            $output,
            'Tax should be 1.00');
    }

    /**
     *
     */
    public function testPostTaxTotal()
    {
        $items = [1, 2, 5, 8];
        $coupon = null;
        $this->Receipt->tax = 0.20;
        $Receipt = $this->getMockBuilder('TDD\Receipt')
            ->setMethods(['tax', 'subtotal'])
            ->setConstructorArgs([$this->Formatter])
            ->getMock();

        $Receipt->expects($this->once())
            ->method('subtotal')
            ->with($items, $coupon)
            ->will($this->returnValue(10.00));
        $Receipt->expects($this->once())
            ->method('tax')
            ->with(10.00)
            ->will($this->returnValue(1.00));
        $result = $Receipt->postTaxTotal([1, 2, 5, 8], null);
        $this->assertEquals(11.00, $result);
        //$result = $this->Receipt->postTaxTotal([1, 2, 5, 8], null);
        $this->assertEquals(11.00, $result);
    }


}
