<?php

namespace Libs\NasdaqListings;

use App\Libs\RapidApi\Price;
use Tests\TestCase;
use Carbon\Carbon;
use Mockery;
use ReflectionClass;

class CompanyTest extends TestCase
{
    /**
     * @var Price
     */
    protected $price;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->price = new Price();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->price);
    }

    public function testGetDate(): void
    {
        $expected = Mockery::mock(Carbon::class);
        $property = (new ReflectionClass(Price::class))
            ->getProperty('date');
        $property->setValue($this->price, $expected);
        $this->assertSame($expected, $this->price->getDate());
    }

    public function testSetDate(): void
    {
        $expected = Mockery::mock(Carbon::class);
        $property = (new ReflectionClass(Price::class))
            ->getProperty('date');
        $this->price->setDate($expected);
        $this->assertSame($expected, $property->getValue($this->price));
    }

    public function testGetOpen(): void
    {
        $expected = 42.42;
        $property = (new ReflectionClass(Price::class))
            ->getProperty('open');
        $property->setValue($this->price, $expected);
        $this->assertSame($expected, $this->price->getOpen());
    }

    public function testSetOpen(): void
    {
        $expected = 42.42;
        $property = (new ReflectionClass(Price::class))
            ->getProperty('open');
        $this->price->setOpen($expected);
        $this->assertSame($expected, $property->getValue($this->price));
    }

    public function testGetHigh(): void
    {
        $expected = 42.42;
        $property = (new ReflectionClass(Price::class))
            ->getProperty('high');
        $property->setAccessible(true);
        $property->setValue($this->price, $expected);
        $this->assertSame($expected, $this->price->getHigh());
    }

    public function testSetHigh(): void
    {
        $expected = 42.42;
        $property = (new ReflectionClass(Price::class))
            ->getProperty('high');
        $property->setAccessible(true);
        $this->price->setHigh($expected);
        $this->assertSame($expected, $property->getValue($this->price));
    }

    public function testGetLow(): void
    {
        $expected = 42.42;
        $property = (new ReflectionClass(Price::class))
            ->getProperty('low');
        $property->setAccessible(true);
        $property->setValue($this->price, $expected);
        $this->assertSame($expected, $this->price->getLow());
    }

    public function testSetLow(): void
    {
        $expected = 42.42;
        $property = (new ReflectionClass(Price::class))
            ->getProperty('low');
        $property->setAccessible(true);
        $this->price->setLow($expected);
        $this->assertSame($expected, $property->getValue($this->price));
    }

    public function testGetClose(): void
    {
        $expected = 42.42;
        $property = (new ReflectionClass(Price::class))
            ->getProperty('close');
        $property->setValue($this->price, $expected);
        $this->assertSame($expected, $this->price->getClose());
    }

    public function testSetClose(): void
    {
        $expected = 42.42;
        $property = (new ReflectionClass(Price::class))
            ->getProperty('close');
        $this->price->setClose($expected);
        $this->assertSame($expected, $property->getValue($this->price));
    }

    public function testGetVolume(): void
    {
        $expected = 42.42;
        $property = (new ReflectionClass(Price::class))
            ->getProperty('volume');
        $property->setAccessible(true);
        $property->setValue($this->price, $expected);
        $this->assertSame($expected, $this->price->getVolume());
    }

    public function testSetVolume(): void
    {
        $expected = 42.42;
        $property = (new ReflectionClass(Price::class))
            ->getProperty('volume');
        $property->setAccessible(true);
        $this->price->setVolume($expected);
        $this->assertSame($expected, $property->getValue($this->price));
    }

    public function testGetAdjclose(): void
    {
        $expected = 42.42;
        $property = (new ReflectionClass(Price::class))
            ->getProperty('adjclose');
        $property->setAccessible(true);
        $property->setValue($this->price, $expected);
        $this->assertSame($expected, $this->price->getAdjclose());
    }

    public function testSetAdjclose(): void
    {
        $expected = 42.42;
        $property = (new ReflectionClass(Price::class))
            ->getProperty('adjclose');
        $property->setAccessible(true);
        $this->price->setAdjclose($expected);
        $this->assertSame($expected, $property->getValue($this->price));
    }

}
