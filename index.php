<?php

require_once 'vendor/autoload.php';

use App\Controller\ProductController;
use App\Controller\WebsiteController;
use App\Redirect;
use App\Repository\Product\PDOProductRepository;
use App\Repository\Product\ProductRepository;
use App\View;
use DI\ContainerBuilder;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use function DI\create;

session_start();

$builder = new ContainerBuilder();
$builder->addDefinitions([
   ProductRepository::class => create(PDOProductRepository::class)
]);
$container = $builder->build();


$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    // Website Controller
    $r->addRoute('GET', '/', [WebsiteController::class, "home"]);
    $r->addRoute('GET', '/basket', [WebsiteController::class, "basket"]);
    $r->addRoute('GET', '/checkout', [WebsiteController::class, "checkout"]);
    $r->addRoute('POST', '/checkout', [WebsiteController::class, "purchase"]);
    $r->addRoute('POST', '/basket/{id:\d+}', [WebsiteController::class, "addToBasket"]);



    // Product Controller
    $r->addRoute('POST', "/add", [ProductController::class, "add"]);
    $r->addRoute('GET', "/show/{id:\d+}", [ProductController::class, "show"]);

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:

        $controller = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];


        $response = (new $controller($container))->$method($vars);
        $twig = new Environment(new FilesystemLoader('app/Views'));


        if ($response instanceof View) {
                echo $twig->render($response->getPath(), $response->getVars());
        }

        if ($response instanceof Redirect) {
            header('Location: ' . $response->getLocation());
        }

        break;
}



if (isset($_SESSION['Errors']) && $httpMethod == "GET") {
    unset($_SESSION['Errors']);
}