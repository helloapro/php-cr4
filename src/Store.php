<?php
    class Store
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
            $GLOBALS['DB']->exec("INSERT INTO stores (name, description) VALUES ('{$this->getName()}', '{$this->getDescription()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        }

        function updateName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name ='{$name}' WHERE id ='{$this->getId()}';");
            $this->setName($name);
        }

        function updateDescription($new_description)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET description ='{$description}' WHERE id ='{$this->getId()}';");
            $this->setDescription($description);
        }

        function addBrand($brand_id)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand_id});");
        }

        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores
                JOIN stores_brands ON(stores_brands.store_id = stores.id)
                JOIN brands ON(brands.id = stores_brands.brand_id)
                WHERE stores.id = {$this->getId()};");
            $brands = array();
            foreach ($returned_brands as $brand) {
                $name = $brand['name'];
                $description = $brand['description'];
                $id = $brand['id'];
                $found_brand = new Brand($name, $description, $id);
                array_push($brands, $found_brand);
            }
            return $brands;
        }

//static methods
        static function find($search_id)
        {
            $returned_stores = Store::getAll();
            $found_store = null;
            foreach ($returned_stores as $store) {
                if ($store->getId() == $search_id) {
                    $found_store = $store;
                }
            }
            return $found_store;
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach ($returned_stores as $store) {
                $name = $store['name'];
                $description = $store['description'];
                $id = $store['id'];
                $new_store = new Store($name, $description, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }
    }
?>
