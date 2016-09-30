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
//static methods
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
