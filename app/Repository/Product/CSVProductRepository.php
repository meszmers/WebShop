<?php

namespace App\Repository\Product;

use App\Model\Product;
use App\Services\Product\AddProductRequest;
use App\Services\Product\ShowByIDProductRequest;

class CSVProductRepository implements ProductRepository {

    public function add(AddProductRequest $product): void
    {
        // TODO: Implement add() method.
    }

    public function showByID(ShowByIDProductRequest $id): Product
    {
        return new Product(0, "test", 100.10, 00000);
    }
    public function getAll(): array
    {
       return [];
    }
}