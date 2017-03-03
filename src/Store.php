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

        // Getters

        function getName()
        {
            return $this->name;
        }

        function getPhoneNumber()
        {
            return $this->phone_number;
        }

        function getStreet()
        {
            return $this->street;
        }

        function getCity()
        {
            return $this->city;
        }

        function getState()
        {
            return $this->state;
        }

        function getZip()
        {
            return $this->zip;
        }

        function getId()
        {
            return $this->id;
        }

        // Setters

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setPhoneNumber($new_phone_number)
        {
            $this->phone_number = (string) $new_phone_number;
        }

        function setStreet($new_street)
        {
            $this->street = (string) $new_street;
        }

        function setCity($new_city)
        {
            $this->city = (string) $new_city;
        }

        function setState($new_state)
        {
            $this->state = (string) $new_state;
        }

        function setZip($new_zip)
        {
            $this->zip = (integer) $new_zip;
        }

        // Save, getAll, deleteAll

        function save()
        {
            $GLOBALS["DB"]->exec("INSERT INTO stores (name, phone_number, street, city, state, zip) VALUES ('{$this->getName()}', '{$this->getPhoneNumber()}', '{$this->getStreet()}', '{$this->getCity()}', '{$this->getState()}', {$this->getZip()});");
            $this->id = $GLOBALS["DB"]->lastInsertId();
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS["DB"]->query("SELECT * FROM stores;");
            $stores = array();

            foreach ($returned_stores as $store) {
                $name = $store["name"];
                $phone_number = $store["phone_number"];
                $street = $store["street"];
                $city = $store["city"];
                $state = $store["state"];
                $zip = $store["zip"];
                $id = $store["id"];
                $new_store = new Store($name, $phone_number, $street, $city, $state, $zip, $id);
                array_push($stores, $new_store);
            }

            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS["DB"]->exec("DELETE FROM stores;");
        }

        static function find($search_id)
        {
            $found_store = null;
            $stores = Store::getAll();

            foreach ($stores as $store) {
                $store_id = $store->getId();

                if ($store_id == $search_id) {
                    $found_store = $store;
                }
            }

            return $found_store;
        }
    }
?>
