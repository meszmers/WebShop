<?php

namespace App\Repository\Product;


use App\Model\Product;
use App\Services\Product\AddProductRequest;
use App\Services\Product\ShowByIDProductRequest;

interface ProductRepository {
    public function add(AddProductRequest $product): void;
    public function showByID(ShowByIDProductRequest $id): Product;
    public function getAll(): array;
}