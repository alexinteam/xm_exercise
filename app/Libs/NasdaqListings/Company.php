<?php

namespace App\Libs\NasdaqListings;

class Company implements \JsonSerializable
{
    private string $symbol;

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     */
    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }

    public function jsonSerialize()
    {
        return [
            'symbol' => $this->getSymbol()
        ];
    }
}
