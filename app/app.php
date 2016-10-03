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
        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands, 'store' => $new_store, 'brand' => null, 'storeBrands' => null, 'brandStores' => null));
    });

    $app->get("/stores/{id}", function($id) use ($app) {
        $found_store = Store::find($id);
        $stores = Store::getAll();
        $brands = Brand::getAll();
        $store_brands = $found_store->getBrands();
        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands, 'store' => $found_store, 'brand' => null, 'storeBrands' => $store_brands, 'brandStores' => null));
    });

    $app->patch("/stores/{id}", function($id) use ($app) {
        $found_store = Store::find($id);
        $edit_store_name = array_key_exists('name', $_POST) ? $_POST['name'] : null;
        $edit_store_description = array_key_exists('description', $_POST) ? $_POST['description'] : null;
        if($edit_store_name !== null)
        {
            $found_store->updateName($edit_store_name);
        }
        if($edit_store_description !== null)
        {
            $found_store->updateDescription($edit_store_description);
        }
        $stores = Store::getAll();
        $brands = Brand::getAll();
        $store_brands = $found_store->getBrands();
        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands, 'store' => $found_store, 'brand' => null, 'storeBrands' => $store_brands, 'brandStores' => null));
    });

    $app->delete("/stores/{id}", function($id) use ($app) {
        $found_store = Store::find($id);
        $found_store->delete();
        return $app->redirect('/');
    });

    $app->post("/stores/add/{id}", function($id) use ($app) {
        $found_store = Store::find($id);
        $found_store->addBrand($_POST['brand_id']);
        $stores = Store::getAll();
        $brands = Brand::getAll();
        $store_brands = $found_store->getBrands();
        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands, 'store' => $found_store, 'brand' => null, 'storeBrands' => $store_brands, 'brandStores' => null));
    });


    $app->post("/brands", function() use ($app) {
        $new_brand = new Brand($_POST['name'], $_POST['description']);
        $new_brand->save();
        $stores = Store::getAll();
        $brands = Brand::getAll();
        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands, 'store' => null, 'brand' => $new_brand, 'storeBrands' => null, 'brandStores' => null));
    });

    $app->get("/brands/{id}", function($id) use ($app) {
        $found_brand = Brand::find($id);
        $stores = Store::getAll();
        $brands = Brand::getAll();
        $brand_stores = $found_brand->getStores();
        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands, 'store' => null, 'brand' =>$found_brand, 'storeBrands' => null, 'brandStores' => $brand_stores));
    });

    $app->patch("/brands/{id}", function($id) use ($app) {
        $found_brand = Brand::find($id);
        $edit_brand_name = array_key_exists('name', $_POST) ? $_POST['name'] : null;
        $edit_brand_description = array_key_exists('description', $_POST) ? $_POST['description'] : null;
        if($edit_brand_name !== null)
        {
            $found_brand->updateName($edit_brand_name);
        }
        if($edit_brand_description !== null)
        {
            $found_brand->updateDescription($edit_brand_description);
        }
        $stores = Store::getAll();
        $brands = Brand::getAll();
        $brand_stores = $found_brand->getStores();
        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands, 'store' => null, 'brand' => $found_brand, 'storeBrands' => null, 'brandStores' => $brand_stores));
    });

    $app->delete("/brands/{id}", function($id) use ($app) {
        $found_brand = Brand::find($id);
        $found_brand->delete();
        return $app->redirect('/');
    });

    $app->post("/brands/add/{id}", function($id) use ($app) {
        $found_brand = Brand::find($id);
        $found_brand->addStore($_POST['store_id']);
        $stores = Store::getAll();
        $brands = Brand::getAll();
        $brand_stores = $found_brand->getStores();
        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands, 'store' => null, 'brand' => $found_brand, 'storeBrands' => null, 'brandStores' => $brand_stores));
    });

    return $app;
?>
