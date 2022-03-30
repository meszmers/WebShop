<?php

namespace App\Services\Product;

class AddProductRequest {
    private string $name;
    private float $price;
    private int $amount;

    public function __construct( string $name, float $price, int $amount)
    {

        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }


    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }
}
