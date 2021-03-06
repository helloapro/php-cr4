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

        function updateName($name)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET name ='{$name}' WHERE id ='{$this->getId()}';");
            $this->setName($name);
        }

        function updateDescription($description)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET description ='{$description}' WHERE id ='{$this->getId()}';");
            $this->setDescription($description);
        }

        function addStore($store_id)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store_id}, {$this->getId()});");
        }

        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
                JOIN stores_brands ON(stores_brands.brand_id = brands.id)
                JOIN stores ON(stores.id = stores_brands.store_id)
                WHERE brands.id = {$this->getId()};");
            $stores = array();
            foreach ($returned_stores as $store) {
                $name = $store['name'];
                $description = $store['description'];
                $id = $store['id'];
                $found_store = new Store($name, $description, $id);
                array_push($stores, $found_store);
            }
            return $stores;
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
