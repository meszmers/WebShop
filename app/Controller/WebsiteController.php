<?php

namespace App\Controller;

use App\Redirect;
use App\Services\Product\GetAllProductService;
use App\Services\Product\ShowByIDProductRequest;
use App\Services\Product\ShowByIDProductService;
use App\View;
use Psr\Container\ContainerInterface;

class WebsiteController {

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function home(): View {

       $service = $this->container->get(GetAllProductService::class);
       $products = $service->execute();

       $basketCount = count($_SESSION["basket"]);

        return new View("Home.html", ["products" => $products, "basketCount" => $basketCount]);
    }

    public function checkout(): View {
        $session = array_count_values($_SESSION["basket"]);
        $products = [];
        $totalPrice = 0;
        foreach ($session as $i => $amount) {
            $service = $this->container->get(ShowByIDProductService::class);
            $product = $service->execute(new ShowByIDProductRequest($i));
            $totalPrice += ($product->getPrice() * $amount);
            $products[] = ["product" => $product, "amount" => $amount, "total" => ($product->getPrice() * $amount)];
        }

        return new View("Checkout.html", ["products" => $products, "totalPrice" => $totalPrice]);
    }

    public function basket(): View {

        $products = [];
        foreach ($_SESSION["basket"] as $product) {
            $service = $this->container->get(ShowByIDProductService::class);
            $products[] = $service->execute(new ShowByIDProductRequest($product));
        }

        return new View("Basket.html", ["products" => $products]);
    }

    public function addToBasket($vars): Redirect {
        $_SESSION["basket"][] = $vars["id"];
        return new Redirect("/");
    }
    public function purchase(): Redirect {
        $_SESSION["basket"] = [];
        return new Redirect("/");
    }
}
