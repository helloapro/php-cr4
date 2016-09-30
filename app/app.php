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

    $app->post("/add_store", function() use ($app) {
        $new_store = new Store($_POST['name']);
        $new_store->save();
        $stores = Store::getAll();
        $brands = Brand::getAll();
        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands, 'store' => $new_store));
    });

    return $app;
?>
