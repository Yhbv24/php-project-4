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

        // ***** Getters *****

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

        // ***** Setters *****

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

        // ***** CRUD functions *****

        function save()
        {
            $GLOBALS["DB"]->exec("INSERT INTO stores (name, phone_number, street, city, state, zip) VALUES ('{$this->getName()}', '{$this->getPhoneNumber()}', '{$this->getStreet()}', '{$this->getCity()}', '{$this->getState()}', {$this->getZip()});");
            $this->id = $GLOBALS["DB"]->lastInsertId();
        }

        function update($new_name, $new_phone_number, $new_street, $new_city, $new_state, $new_zip)
        {
            if ($new_name) {
                $GLOBALS["DB"]->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
                $this->setName($new_name);
            }

            if ($new_phone_number) {
                $GLOBALS["DB"]->exec("UPDATE stores SET phone_number = '{$new_phone_number}' WHERE id = {$this->getId()};");
                $this->setPhoneNumber($new_phone_number);
            }

            if ($new_street) {
                $GLOBALS["DB"]->exec("UPDATE stores SET street = '{$new_street}' WHERE id = {$this->getId()};");
                $this->setStreet($new_street);
            }

            if ($new_city) {
                $GLOBALS["DB"]->exec("UPDATE stores SET city = '{$new_city}' WHERE id = {$this->getId()};");
                $this->setCity($new_city);
            }

            if ($new_state) {
                $GLOBALS["DB"]->exec("UPDATE stores SET state = '{$new_state}' WHERE id = {$this->getId()};");
                $this->setState($new_state);
            }

            if ($new_zip) {
                $GLOBALS["DB"]->exec("UPDATE stores SET zip = {$new_zip} WHERE id = {$this->getId()};");
                $this->setZip($new_zip);
            }
        }

        function delete()
        {
            $GLOBALS["DB"]->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS["DB"]->exec("DELETE FROM stores_brands WHERE store_id = {$this->getId()};");
        }

        // ***** Static functions *****

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

        // ***** Integration functions *****

        function addBrand($brand)
        {
            $GLOBALS["DB"]->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
        }

        function getBrands()
        {
            $returned_brands = $GLOBALS["DB"]->query("SELECT brands.* FROM stores
                JOIN stores_brands ON (stores_brands.store_id = stores.id)
                JOIN brands ON (brands.id = stores_brands.brand_id)
                WHERE stores.id = {$this->getId()};");
            $brands = array();

            foreach ($returned_brands as $brand) {
                $name = $brand["name"];
                $id = $brand["id"];
                $brand = new Brand($name, $id);
                array_push($brands, $brand);
            }

            return $brands;
        }
    }
?>
