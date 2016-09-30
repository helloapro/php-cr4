<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";


    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
        }

        function test_getName()
        {
            $name = "KEEN";
            $test_brand = new Brand($name);

            $result = $test_brand->getName();

            $this->assertEquals($name, $result);
        }

        function test_getDescription()
        {
          $name = "KEEN";
          $description = "HybridLife is the KEEN mantra";
          $test_brand = new Brand($name, $description);

          $result = $test_brand->getDescription();

          $this->assertEquals($description, $result);
        }

        function test_getId()
        {
          $id = 1;
          $name = "KEEN";
          $description = "HybridLife is the KEEN mantra";
          $test_brand = new Brand($name, $description,$id);

          $result = $test_brand->getId();

          $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            $name = "KEEN";
            $description = "HybridLife is the KEEN mantra";
            $test_brand = new Brand($name, $description);

            $test_brand->save();
            $result = Brand::getAll();

            $this->assertEquals($test_brand, $result[0]);
        }
    }
?>
