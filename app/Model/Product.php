<?php

namespace App\Model;

class Product {
    private int $id;
    private string $name;
    private float $price;
    private int $amount;

    public function __construct(int $id, string $name, float $price, int $amount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}