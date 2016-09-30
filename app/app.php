<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Brand.php';
    require_once __DIR__.'/../src/Store.php';
//enable debugger
    use Symfony\Component\Debug\Debug;
    Debug::enable();
//enable patch and delete functionality
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app) {
        $stores = Store::getAll();
        $brands = Brand::getAll();
        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands, 'store' => null, 'brand' => null));
    });

    $app->post("/stores", function() use ($app) {
        $new_store = new Store($_POST['name'], $_POST['description']);
        $new_store->save();
        $stores = Store::getAll();
        $brands = Brand::getAll();
        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands, 'store' => $new_store, 'storeBrands' => null));
    });

    $app->post("/stores/{id}", function($id) use ($app) {
        $found_store = Store::find();
        $stores = Store::getAll();
        $brands = Brand::getAll();
        $store_brands = $found_store->getBrands();
        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands, 'store' => $new_store, 'storeBrands' => $store_brands));
    });





    $app->post("/brands", function() use ($app) {
        $new_brand = new Brand($_POST['name'], $_POST['description']);
        $new_brand->save();
        $stores = Store::getAll();
        $brands = Brand::getAll();
        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands, 'brand' => $new_brand));
    });

    return $app;
?>
