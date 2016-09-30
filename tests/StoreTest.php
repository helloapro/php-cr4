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


    }
?>
