<?php

namespace App\Services\Product;

use App\Repository\Product\ProductRepository;

class GetAllProductService {

    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function execute(): array {
       return $this->productRepository->getAll();
    }
}