<?php
    class Brand
    {
        private $name;
        private $description;
        private $id;

        function __construct($name, $description = '', $id = null)
        {
            $this->name = $name;
            $this->description = $description;
            $this->id = $id;
        }
//getters and setters
        function getName()
        {
            return $this->name;
        }
        function setName($new_name)
        {
            $this->name = $new_name;
        }
        function getDescription()
        {
            return $this->description;
        }
        function setDescription($new_description)
        {
            $this->description = $new_description;
        }
        function getId()
        {
            return $this->id;
        }
//methods
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name, description) VALUES ('{$this->getName()}', '{$this->getDescription()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id={$this->getId()};");
        }
//static methods
        static function find($search_id)
        {
            $returned_brands = Brand::getAll();
            $found_brand = null;
            foreach ($returned_brands as $brand) {
                if ($brand->getId() == $search_id) {
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands");
            $brands= array();
            foreach ($returned_brands as $brand) {
               $id = $brand['id'];
               $name = $brand['name'];
               $description = $brand['description'];
               $new_brand = new Brand($name, $description, $id);
               array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

    }
