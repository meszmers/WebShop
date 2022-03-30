<?php

namespace App\Services\Product;

use App\Model\Product;
use App\Repository\Product\ProductRepository;

class ShowByIDProductService {
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(ShowByIDProductRequest $id): Product {
        return $this->productRepository->showByID($id);
    }
}
