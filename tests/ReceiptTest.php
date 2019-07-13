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
        $this->Receipt = new Receipt();
    }

    /**
     *
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->Receipt);
    }


    /**
     * Testing Total
     */
    public function testTotal()
    {
        $input = [0, 2, 5, 8];
        $output = $this->Receipt->total($input);
        $this->assertEquals(
            15,
            $output,
            'When Summing the total should equal 15');
    }
}
