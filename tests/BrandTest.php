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

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function test_getName()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);

            // Act
            $result = $new_brand->getName();

            // Assert
            $this->assertEquals($name, $result);
        }

        function test_save()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            // Act
            $result = Brand::getAll();

            // Assert
            $this->assertEquals($new_brand, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            $name2 = "Reebok";
            $new_brand2 = new Brand($name2);
            $new_brand2->save();

            // Act
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([$new_brand, $new_brand2], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            $name2 = "Reebok";
            $new_brand2 = new Brand($name2);
            $new_brand2->save();

            // Act
            Brand::deleteAll();
            $result = Store::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            $name2 = "Reebok";
            $new_brand2 = new Brand($name2);
            $new_brand2->save();

            // Act
            $new_brand2_id = $new_brand2->getId();
            $result = $new_brand2->find($new_brand2_id);

            // Assert
            $this->assertEquals($new_brand2, $result);
        }

        function test_update()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            // Act
            $new_name = "Reebok";
            $new_brand->update($new_name);
            $result = $new_brand->getName();

            // Assert
            $this->assertEquals($new_name, $result);
        }

        function test_delete()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            $name2 = "Reebok";
            $new_brand2 = new Brand($name);
            $new_brand2->save();

            // Act
            $new_brand2->delete();
            $result = Brand::getAll();

            // Assert
            $this->assertEquals($new_brand, $result[0]);
        }

        function test_addStore()
        {
            // Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_brand->save();

            $store_name = "Foot Locker";
            $phone_number = "503-493-7148";
            $street = "1022 Lloyd Center Space H-204";
            $city = "Portland";
            $state = "OR";
            $zip = 97232;
            $store = new Store($name, $phone_number, $street, $city, $state, $zip);
            $store->save();

            // Act
            $new_brand->addStore($store);
            $result = $new_brand->getStores();

            // Assert
            $this->assertEquals([$store], $result);
        }
    }
?>
