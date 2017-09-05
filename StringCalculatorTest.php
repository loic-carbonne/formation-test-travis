<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
include 'StringCalculator.php';
/**
 *  * @covers Email
 *   */
final class StringCalculatorTest extends TestCase
{
    public function testAddZeroNumbers(): void
    {
        $this->assertSame(
            StringCalculator::Add(""),
            0
        );
    }
    public function testAddOneNumber(): void
    {
        $this->assertSame(
            StringCalculator::Add("1"),
            1
        );
    }
    public function testAddTwoNumbers(): void
    {
        $this->assertSame(
            StringCalculator::Add("1,2"),
            3
        );
    }
    public function testAddManyNumbers(): void
    {
        $this->assertSame(
            StringCalculator::Add("1,2,3,4,5"),
            15
        );
    }
    public function testAddWithNewSpace(): void
    {
        $this->assertSame(
            StringCalculator::Add("1,2\n3,4\n5"),
            15
        );
    }
    public function testAddWithCustomDelimiter(): void
    {
        $this->assertSame(
            StringCalculator::Add("//;\n1;2"),
            3
        );
    }
    public function testAddWithNegativesThrowException(): void
    {
        $this->expectException(Exception::class);
        StringCalculator::Add("//;\n-1;2");
    }
    public function testAddWithLargeNumber(): void
    {
      $this->assertSame(
          StringCalculator::Add("2,1000"),
          2
      );
    }
    public function testAddWithLargeDelimiter(): void
    {
      $this->assertSame(
          StringCalculator::Add("//[***]\n1***2***3"),
          6
      );
    }
    public function testAddWithMultipleDelimiter(): void
    {
      $this->assertSame(
          StringCalculator::Add("//[*][%]\n1*2%3"),
          7
      );
    }


}
