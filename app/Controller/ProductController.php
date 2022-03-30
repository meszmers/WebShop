<?php

namespace App\Controller;

use App\Redirect;
use App\Services\Product\AddProductRequest;
use App\Services\Product\AddProductService;
use App\Services\Product\ShowByIDProductRequest;
use App\Services\Product\ShowByIDProductService;
use App\View;
use Psr\Container\ContainerInterface;


class ProductController {

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function add(): Redirect {

      $service =  $this->container->get(AddProductService::class);

        $service->execute(new AddProductRequest(
            $_POST["name"],
            $_POST["price"],
            $_POST["amount"]
        ));
        return new Redirect("/");
    }

    public function show($vars) {

        $service =  $this->container->get(ShowByIDProductService::class);
         $product = $service->execute(new ShowByIDProductRequest($vars["id"]));

       return new View('Product\Show.html', ["productInfo" => $product]);
    }


}