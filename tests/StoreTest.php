<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    **/

    require_once 'src/Store.php';
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function teardown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_getName()
        {
            $name = "Solestruck";
            $test_store = new Store($name);

            $result = $test_store->getName();

            $this->assertEquals($name, $result);
        }

        function test_getDescription()
        {
          $name = "Solestruck";
          $description = "store with a pun name";
          $test_store = new Store($name, $description);

          $result = $test_store->getDescription();

          $this->assertEquals($description, $result);
        }

        function test_getId()
        {
          $id = 1;
          $name = "Solestruck";
          $description = "store with a pun name";
          $test_store = new Store($name, $description,$id);

          $result = $test_store->getId();

          $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            $name = "Solestruck";
            $description = "store with a pun name";
            $test_store = new Store($name, $description);

            $test_store->save();
            $result = Store::getAll();

            $this->assertEquals($test_store, $result[0]);
        }

        function test_getAll()
        {
            $name = "Solestruck";
            $description = "store with a pun name";
            $test_store = new Store($name, $description);
            $name2 = "Half Pint";
            $description2 = "vintage leather shoe shop";
            $test_store2 = new Store($name2, $description2);
            $test_store->save();
            $test_store2->save();

            $result = Store::getAll();

            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_delete()
        {
            $name = "Solestruck";
            $description = "store with a pun name";
            $test_store = new Store($name, $description);
            $name2 = "Half Pint";
            $description2 = "vintage leather shoe shop";
            $test_store2 = new Store($name2, $description2);
            $test_store->save();
            $test_store2->save();

            $test_store->delete();
            $result = Store::getAll();

            $this->assertEquals([$test_store2], $result);
        }

        function test_find()
        {
            $name = "Solestruck";
            $description = "store with a pun name";
            $test_store = new Store($name, $description);
            $name2 = "Half Pint";
            $description2 = "vintage leather shoe shop";
            $test_store2 = new Store($name2, $description2);
            $test_store->save();
            $test_store2->save();

            $search_id = $test_store2->getId();
            $result = Store::find($search_id);

            $this->assertEquals($test_store2, $result);
        }

        function test_addBrand()
        {
            $name = "KEEN";
            $description = "HybridLife is the KEEN mantra";
            $test_brand = new Brand($name, $description);
            $test_brand->save();
            $store_name = "Solestruck";
            $store_description = "store with a pun name";
            $test_store = new Store($store_name, $store_description);
            $test_store->save();

            $test_store->addBrand($test_brand->getId());

            $this->assertEquals([$test_brand], $test_store->getBrands());
        }

        function test_getStores()
        {
            $name = "KEEN";
            $description = "HybridLife is the KEEN mantra";
            $test_brand = new Brand($name, $description);
            $name2 = "Danner";
            $description2 = "stylish bootwear";
            $test_brand2 = new Brand($name2, $description2);
            $test_brand->save();
            $test_brand2->save();
            $store_name = "Solestruck";
            $store_description = "store with a pun name";
            $test_store = new Store($store_name, $store_description);
            $test_store->save();


            $test_store->addBrand($test_brand->getId());
            $test_store->addBrand($test_brand2->getId());
            $result = $test_store->getBrands();

            $this->assertEquals([$test_brand, $test_brand2], $result);
        }
    }
?>
