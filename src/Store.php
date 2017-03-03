<?php
    class Store
    {
        private $name;
        private $phone_number;
        private $street;
        private $city;
        private $state;
        private $zip;
        private $id;

        function __construct($name, $phone_number, $street, $city, $state, $zip, $id = null)
        {
            $this->name = $name;
            $this->phone_number = $phone_number;
            $this->street = $street;
            $this->city = $city;
            $this->state = $state;
            $this->zip = $zip;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }
    }
?>
