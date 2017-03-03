<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $app = new Silex\Application();

    $server = "mysql:host=localhost:8889;dbname=shoes";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array("twig.path" => __DIR__."/../views"));

    // ***** Routing *****

    // ***** Get routes *****

    $app->get("/", function() use ($app) { // Route to the home page
        $brands = Brand::getAll();
        $store = Store::getAll();

        return $app["twig"]->render("index.html.twig", array("brands" => $brands, "stores" => $stores));
    });

    // ***** Post routs *****

    // ***** Delete routes *****

    // ***** Patch routes *****


    return $app;
?>
