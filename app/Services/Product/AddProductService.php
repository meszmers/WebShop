<?php

namespace App\Services\Product;


use App\Repository\Product\PDOProductRepository;
use App\Repository\Product\ProductRepository;

class AddProductService {

    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(AddProductRequest $product): void {
        $this->productRepository->add($product);
    }
}