<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = "mysql:host=localhost:8889;dbname=shoes_test";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_getName()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);

            // Act
            $result = $new_store->getName();

            // Assert
            $this->assertEquals($name, $result);
        }

        function test_getPhoneNumber()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);

            // Act
            $result = $new_store->getPhoneNumber();

            // Assert
            $this->assertEquals($phone_number, $result);
        }

        function test_getStreet()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);

            // Act
            $result = $new_store->getStreet();

            // Assert
            $this->assertEquals($street, $result);
        }

        function test_getCity()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);

            // Act
            $result = $new_store->getCity();

            // Assert
            $this->assertEquals($city, $result);
        }

        function test_getState()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);

            // Act
            $result = $new_store->getState();

            // Assert
            $this->assertEquals($state, $result);
        }

        function test_getZip()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);

            // Act
            $result = $new_store->getZip();

            // Assert
            $this->assertEquals($zip, $result);
        }

        function test_save()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);

            // Act
            $new_store->save();
            $result = Store::getAll();

            // Assert
            $this->assertEquals($new_store, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);
            $new_store->save();

            $name2 = "Foot Locker";
            $phone_number2 = "503-493-7148";
            $street2 = "1022 Lloyd Center Space H-204";
            $city2 = "Portland";
            $state2 = "OR";
            $zip2 = 97232;
            $new_store2 = new Store($name2, $phone_number2, $street2, $city2, $state2, $zip2);
            $new_store2->save();

            // Act
            $result = Store::getAll();

            // Assert
            $this->assertEquals([$new_store, $new_store2], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);
            $new_store->save();

            $name2 = "Foot Locker";
            $phone_number2 = "503-493-7148";
            $street2 = "1022 Lloyd Center Space H-204";
            $city2 = "Portland";
            $state2 = "OR";
            $zip2 = 97232;
            $new_store2 = new Store($name2, $phone_number2, $street2, $city2, $state2, $zip2);
            $new_store2->save();

            // Act
            Store::deleteAll();
            $result = Store::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);
            $new_store->save();

            $name2 = "The Shoe Store";
            $phone_number2 = "971-271-8926";
            $street2 = "1603 NE Alberta St";
            $city2 = "Portland";
            $state2 = "OR";
            $zip2 = 97211;
            $new_store2 = new Store($name2, $phone_number2, $street2, $city2, $state2, $zip2);
            $new_store2->save();

            // Act
            $store_id = $new_store2->getId();
            $result = Store::find($store_id);

            // Assert
            $this->assertEquals($new_store2, $result);
        }

        function test_update()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);
            $new_store->save();

            // Act
            $new_phone_number = "503-684-2053";
            $new_street = "9459 SW Washington Sq Rd";
            $new_city = "Tigard";
            $new_zip = 97223;
            $new_store->update($name, $new_phone_number, $new_street, $new_city, $state, $new_zip);
            $result = $new_store->getStreet();

            // Assert
            $this->assertEquals($new_street, $result);
        }

        function test_delete()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);
            $new_store->save();

            // Act
            $new_store->delete();
            $result = Store::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function test_addBrand()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);
            $new_store->save();

            $brand_name = "Nike";
            $new_brand = new Brand($brand);
            $new_brand->save();
            $brand_id = $new_brand->getId();

            // Act
            $new_store->addBrand($brand_id);
            $result = $new_store->getBrands();

            // Assert
            $this->assertEquals([$new_brand], $result);
        }

        function test_getBrands()
        {
            // Arrange
            $name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $new_store = new Store($name, $phone_number, $street, $city, $state, $zip);
            $new_store->save();

            $brand_name = "Nike";
            $new_brand = new Brand($brand_name);
            $new_brand->save();
            $brand_id = $new_brand->getId();

            $brand_name2 = "Reebok";
            $new_brand2 = new Brand($brand_name2);
            $new_brand2->save();
            $brand_id2 = $new_brand2->getId();

            // Act
            $new_store->addBrand($brand_id);
            $new_store->addBrand($brand_id2);
            $result = $new_store->getBrands();

            // Assert
            $this->assertEquals([$new_brand, $new_brand2], $result);
        }
    }
?>
