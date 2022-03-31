<?php

namespace App\Libs\RapidApi;

use Carbon\Carbon;

class Price implements \JsonSerializable
{
    public Carbon $date;

    public float $open;

    private float $high;

    private float $low;

    public float $close;

    private float $volume;

    private float $adjclose;

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @param Carbon $date
     */
    public function setDate(Carbon $date): void
    {
        $this->date = $date;
    }

    /**
     * @return float
     */
    public function getOpen(): float
    {
        return $this->open;
    }

    /**
     * @param float $open
     */
    public function setOpen(float $open): void
    {
        $this->open = $open;
    }

    /**
     * @return float
     */
    public function getHigh(): float
    {
        return $this->high;
    }

    /**
     * @param float $high
     */
    public function setHigh(float $high): void
    {
        $this->high = $high;
    }

    /**
     * @return float
     */
    public function getLow(): float
    {
        return $this->low;
    }

    /**
     * @param float $low
     */
    public function setLow(float $low): void
    {
        $this->low = $low;
    }

    /**
     * @return float
     */
    public function getClose(): float
    {
        return $this->close;
    }

    /**
     * @param float $close
     */
    public function setClose(float $close): void
    {
        $this->close = $close;
    }

    /**
     * @return float
     */
    public function getVolume(): float
    {
        return $this->volume;
    }

    /**
     * @param float $volume
     */
    public function setVolume(float $volume): void
    {
        $this->volume = $volume;
    }

    /**
     * @return float
     */
    public function getAdjclose(): float
    {
        return $this->adjclose;
    }

    /**
     * @param float $adjclose
     */
    public function setAdjclose(float $adjclose): void
    {
        $this->adjclose = $adjclose;
    }

    public function jsonSerialize()
    {
        return [
            'date'          => $this->getDate(),
            'open'          => $this->getOpen(),
            'high'          => $this->getHigh(),
            'low'           => $this->getLow(),
            'close'         => $this->getClose(),
            'volume'        => $this->getVolume(),
            'adjclose'      => $this->getAdjclose(),
        ];
    }
}
