<?php

namespace App\Repository\Product;

use App\Database;
use App\Model\Product;
use App\Services\Product\AddProductRequest;
use App\Services\Product\ShowByIDProductRequest;
use Doctrine\DBAL\Exception;



class PDOProductRepository implements ProductRepository
{
    public function add(AddProductRequest $product): void
    {
        try {
            Database::connection()->insert('products', [
                "name" => $product->getName(),
                "price" => $product->getPrice(),
                "amount" => $product->getAmount()
            ]);
        } catch (Exception $e) {
            echo "<pre>" . $e;
            exit;
        }

    }

    public function showByID(ShowByIDProductRequest $id): Product
    {
       $product =  Database::connection()->fetchAssociative('SELECT * FROM WebShop.products WHERE id = ?', [$id->getId()]);

       return new Product($product["id"], $product["name"], $product["price"], $product["amount"]);
    }

    public function getAll(): array
    {
        $data = Database::connection()->fetchAllAssociative('SELECT * FROM WebShop.products');
        $objArray = [];
        foreach ($data as $product) {
            $objArray[] = new Product($product["id"], $product["name"], $product["price"], $product["amount"]);
        }
        return $objArray;
    }
}
