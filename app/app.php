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

     $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array("twig.path" => __DIR__."/../views"));

    // ***** Routing *****

    // ***** Get routes *****

    $app->get("/", function() use ($app) { // Route to the home page
        $brands = Brand::getAll();
        $stores = Store::getAll();

        return $app["twig"]->render("index.html.twig", array("brands" => $brands, "stores" => $stores));
    });

    $app->get("/view_store/{id}", function($id) use ($app) { // Route to the individual store information
        $store = Store::find($id);
        $brands = Brand::getAll();
        $store_brands = $store->getBrands();

        return $app["twig"]->render("view_store.html.twig", array("store" => $store, "brands" => $brands, "store_brands" => $store_brands));
    });

    // ***** Post routes *****

    $app->post("/add_store", function() use ($app) { // Add a store
        $name = filter_var($_POST["store_name"], FILTER_SANITIZE_MAGIC_QUOTES);
        $phone_number = filter_var($_POST["phone_number"], FILTER_SANITIZE_MAGIC_QUOTES);
        $street = filter_var($_POST["street"], FILTER_SANITIZE_MAGIC_QUOTES);
        $city = filter_var($_POST["city"], FILTER_SANITIZE_MAGIC_QUOTES);
        $state = filter_var($_POST["state"], FILTER_SANITIZE_MAGIC_QUOTES);
        $zip = filter_var($_POST["zip"], FILTER_SANITIZE_MAGIC_QUOTES);
        $store = new Store($name, $phone_number, $street, $city, $state, $zip);
        $store->save();

        return $app->redirect("/");
    });

    $app->post("/add_brand", function() use ($app) { // Add a brand to table
        $name = filter_var($_POST["brand_name"], FILTER_SANITIZE_MAGIC_QUOTES);
        $brand = new Brand($name);
        $brand->save();

        return $app->redirect("/");
    });

    $app->post("/view_store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $brand_id = $_POST["brand_id"];
        $store->addBrand($brand_id);

        return $app->redirect("/view_store/" . $id);
    });

    // ***** Delete routes *****

    $app->delete("/delete_all", function() use ($app) { // Delete all information from database
        Brand::deleteAll();
        Store::deleteAll();
        $GLOBALS["DB"]->exec("DELETE FROM stores_brands;");

        return $app->redirect("/");
    });

    $app->delete("/delete_store/{id}", function($id) use ($app) { // Delete individual store
        $store = Store::find($id);
        $store->delete();

        return $app->redirect("/");
    });

    $app->delete("/delete_brand/{id}", function($id) use ($app) { // Delete individual brand
        $brand = Brand::find($id);
        $brand->delete();

        return $app->redirect("/");
    });

    // ***** Patch routes *****

    return $app;
?>
