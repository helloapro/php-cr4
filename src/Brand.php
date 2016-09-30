<?php
    class Brand
    {
        private $name;
        private $description;
        private $id;

        function __construct($name, $description, $id = null)
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
    }
