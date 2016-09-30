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

        function test_getAll()
        {
            $name = "KEEN";
            $description = "HybridLife is the KEEN mantra";
            $test_brand = new Brand($name, $description);
            $name2 = "Danner";
            $description2 = "stylish bootwear";
            $test_brand2 = new Brand($name2, $description2);
            $test_brand->save();
            $test_brand2->save();

            $result = Brand::getAll();

            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function test_find()
        {
            $name = "KEEN";
            $description = "HybridLife is the KEEN mantra";
            $test_brand = new Brand($name, $description);
            $name2 = "Danner";
            $description2 = "stylish bootwear";
            $test_brand2 = new Brand($name2, $description2);
            $test_brand->save();
            $test_brand2->save();

            $search_id = $test_brand->getId();
            $result = Brand::find($search_id);

            $this->assertEquals($test_brand, $result);
        }

        function test_delete()
        {
            $name = "KEEN";
            $description = "HybridLife is the KEEN mantra";
            $test_brand = new Brand($name, $description);
            $name2 = "Danner";
            $description2 = "stylish bootwear";
            $test_brand2 = new Brand($name2, $description2);
            $test_brand->save();
            $test_brand2->save();

            $test_brand->delete();
            $result = Brand::getAll();

            $this->assertEquals([$test_brand2], $result);
        }
    }
?>
