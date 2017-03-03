<?php
    class Brand
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        // ***** Getters *****

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        // ***** Setters *****

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        // ***** CRUD functions *****

        function save()
        {
            $GLOBALS["DB"]->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS["DB"]->lastInsertId();
        }

        function update($new_name)
        {
            if ($new_name) {
                $GLOBALS["DB"]->exec("UPDATE brands SET name = '{$new_name}' WHERE id = {$this->getId()};");
                $this->setName($new_name);
            }
        }

        function delete()
        {
            $GLOBALS["DB"]->exec("DELETE FROM brands WHERE id = {$this->getId()};");
            $GLOBALS["DB"]->exec("DELETE FROM stores_brands WHERE brand_id = {$this->getId()};");
        }

        // ***** Static functions *****

        static function getAll()
        {
            $returned_brands = $GLOBALS["DB"]->query("SELECT * FROM brands;");
            $brands = array();

            foreach ($returned_brands as $brand) {
                $name = $brand["name"];
                $id = $brand["id"];
                $brand = new Brand($name, $id);
                array_push($brands, $brand);
            }

            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS["DB"]->exec("DELETE FROM brands;");
        }

        static function find($search_id)
        {
            $found_brand = null;
            $brand = Brand::getAll();

            foreach ($brand as $brand) {
                $brand_id = $brand->getId();

                if ($brand_id == $search_id) {
                    $found_brand = $brand;
                }
            }

            return $found_brand;
        }
    }
?>
