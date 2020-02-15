<?php
declare(strict_types=1);

use Kugaudo\Chmod\ChmodResolver;
use PHPUnit\Framework\TestCase;


final class ChmodResolverTest extends TestCase
{
    private $chmodResolver;

    protected function setUp(): void
    {
        parent::setUp();
        $this->chmodResolver = new ChmodResolver();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->chmodResolver);
    }

    public function test_whenOpIsOne_thenWhoCanExecuteOnly()
    {
        $this->assertEquals(false, $this->chmodResolver->matches(1, 'o', 'r')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(1, 'o', 'w')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(1, 'o', 'x')->isMatches());

        $this->assertEquals(false, $this->chmodResolver->matches(10, 'g', 'r')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(10, 'g', 'w')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(10, 'g', 'x')->isMatches());

        $this->assertEquals(false, $this->chmodResolver->matches(100, 'u', 'r')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(100, 'u', 'w')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(100, 'u', 'x')->isMatches());
    }

    public function test_whenOpIsTwo_thenWhoCanWriteOnly()
    {
        $this->assertEquals(false, $this->chmodResolver->matches(2, 'o', 'r')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(2, 'o', 'w')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(2, 'o', 'x')->isMatches());

        $this->assertEquals(false, $this->chmodResolver->matches(20, 'g', 'r')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(20, 'g', 'w')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(20, 'g', 'x')->isMatches());

        $this->assertEquals(false, $this->chmodResolver->matches(200, 'u', 'r')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(200, 'u', 'w')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(200, 'u', 'x')->isMatches());
    }

    public function test_whenOpIsThree_thenWhoCanWriteAndExecuteOnly()
    {
        $this->assertEquals(false, $this->chmodResolver->matches(3, 'o', 'r')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(3, 'o', 'w')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(3, 'o', 'x')->isMatches());

        $this->assertEquals(false, $this->chmodResolver->matches(30, 'g', 'r')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(30, 'g', 'w')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(30, 'g', 'x')->isMatches());

        $this->assertEquals(false, $this->chmodResolver->matches(300, 'u', 'r')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(300, 'u', 'w')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(300, 'u', 'x')->isMatches());
    }

    public function test_whenOpIsFour_thenWhoCanReadOnly()
    {
        $this->assertEquals(true,  $this->chmodResolver->matches(4, 'o', 'r')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(4, 'o', 'w')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(4, 'o', 'x')->isMatches());

        $this->assertEquals(true,  $this->chmodResolver->matches(40, 'g', 'r')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(40, 'g', 'w')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(40, 'g', 'x')->isMatches());

        $this->assertEquals(true,  $this->chmodResolver->matches(400, 'u', 'r')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(400, 'u', 'w')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(400, 'u', 'x')->isMatches());
    }

    public function test_whenOpIsFive_thenWhoCanReadAndExecuteOnly()
    {
        $this->assertEquals(true,  $this->chmodResolver->matches(5, 'o', 'r')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(5, 'o', 'w')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(5, 'o', 'x')->isMatches());

        $this->assertEquals(true,  $this->chmodResolver->matches(50, 'g', 'r')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(50, 'g', 'w')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(50, 'g', 'x')->isMatches());

        $this->assertEquals(true,  $this->chmodResolver->matches(500, 'u', 'r')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(500, 'u', 'w')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(500, 'u', 'x')->isMatches());
    }

    public function test_whenOpIsSix_thenWhoCanReadAndWriteOnly()
    {
        $this->assertEquals(true,  $this->chmodResolver->matches(6, 'o', 'r')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(6, 'o', 'w')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(6, 'o', 'x')->isMatches());

        $this->assertEquals(true,  $this->chmodResolver->matches(60, 'g', 'r')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(60, 'g', 'w')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(60, 'g', 'x')->isMatches());

        $this->assertEquals(true,  $this->chmodResolver->matches(600, 'u', 'r')->isMatches());
        $this->assertEquals(true,  $this->chmodResolver->matches(600, 'u', 'w')->isMatches());
        $this->assertEquals(false, $this->chmodResolver->matches(600, 'u', 'x')->isMatches());
    }

    public function test_whenOpIsSeven_thenWhoCanDoEverything()
    {
        $this->assertEquals(true, $this->chmodResolver->matches(7, 'o', 'r')->isMatches());
        $this->assertEquals(true, $this->chmodResolver->matches(7, 'o', 'w')->isMatches());
        $this->assertEquals(true, $this->chmodResolver->matches(7, 'o', 'x')->isMatches());

        $this->assertEquals(true, $this->chmodResolver->matches(70, 'g', 'r')->isMatches());
        $this->assertEquals(true, $this->chmodResolver->matches(70, 'g', 'w')->isMatches());
        $this->assertEquals(true, $this->chmodResolver->matches(70, 'g', 'x')->isMatches());

        $this->assertEquals(true, $this->chmodResolver->matches(700, 'u', 'r')->isMatches());
        $this->assertEquals(true, $this->chmodResolver->matches(700, 'u', 'w')->isMatches());
        $this->assertEquals(true, $this->chmodResolver->matches(700, 'u', 'x')->isMatches());
    }
}
