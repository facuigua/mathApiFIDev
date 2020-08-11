<?php

use Core\Point\Domain\Point;

class PointTest extends TestCase
{
    private $validX;
    private $validY;

    /**
     * @test
     */
    public function createValidPoint()
    {
        $this->assertTrue(true);
        $punto = new Point($this->validX, $this->validY);
    }
}
