<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    **/

    require_once 'src/Store.php';

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function teardown()
        {
            Store::deleteAll();
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
    }
?>
