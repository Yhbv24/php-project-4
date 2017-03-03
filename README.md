# Shoe Store Brand Record Keeper
#### By Ash Laidlaw

## Description/Goals

The goal of this project is to build a web app which makes use of a SQL database via MAMP, which can be manipulated via PHP. The project is a database which has a collection of local shoe stores and shoe brands. You can add a brand to a store, and you can add a store to a brand.

The user will be able to view all of the brands a store carries, and all of the stores by which brands are sold. The project will make use of three tables; a store table, a brand table, and a join table that connects the brands to the stores.

## Technologies Used
* PHP
* MAMP
* mySQL
* Silex
* Twig
* HTML
* CSS

## Setup/Installation Requirements

To run this web app, please follow the instructions below.

1. Clone the repository to your computer at (https://github.com/Yhbv24/php-project-3).
2. Use Composer to install the Twig, Silex, and PHPUnit dependencies. You can read more here: (https://getcomposer.org/).
   * For Silex instructions: (http://silex.sensiolabs.org/).
   * For Twig instructions: (http://twig.sensiolabs.org/).
   * For PHPUnit instructions: (https://phpunit.de/).

   * CD into the project directory
   * Type "composer install" once you have added the required dependencies.
3. Once all dependencies are installed, you must start the PHP server by navigating into the "web" folder in the project folder, and typing "php -S localhost:8000" in the Terminal.
4. To have access to the database, you will have to install MAMP. You can read more here: (https://www.mamp.info/en/).
5. Once MAMP is installed and the database is started, you will have to type "localhost:8888/phpmyadmin", which will take you to the database configurations.
6. At the top of the page, click "Import", and select the database from the project folder.
7. Once the database is ready to go, type "localhost:8000" in your browser of choice, which will allow you to use the web app.

## Specifications

1. Create files and folders necessary for the web app.
2. Install required dependencies.
3. Create databases for stores, brands, and the join table to connect them.
4. Begin writing tests and methods for classes.

|     Spec     |     Input     |     Output     |
| ------------ | ------------- | -------------- |
| 1. Add constructor for Store class. | Name, phone number, street, city, state, zip, ID. | Output should ultimately save new instantiation of a new Store. |
| 2. Add getters and setters for Store. | Get and set name, phone number, street, city, state, zip of store. | Return information about store. |
| 3. Add CRUD methods to Store. | Create, read, update, and delete stores | Display updated/new information about the stores. |
| 4. Pass all non-integrated tests | Run tests. | Pass tests. |
| 5. Add constructor for Brand class. | Name, ID. | Output should ultimately save new instantiation of a new Brand. |
| 6. Add getters and setters for Brand. | N/A | N/A |
| 7. Add CRUD methods to Brand. | Create, read, update, and delete brands | Display updated/new information about the brands. |
| 8. Pass all tests for Store and Brand | Run all tests. | Pass all tests. |
| 9. Add basic site UI, with options to add stores and brands. | Store information/brand information. | Be able to save the store/brand and return it when necessary. |
| 10. Add routing so that a user can update or delete a store/brand. | Store/brand information. | Be able to update/delete the store/brand and have it update the database. |

## SQL Commands

* To set up database:
   * CREATE DATABASE shoes;
   * USE shoes;
   * CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR(255), phone_number VARCHAR(15), street VARCHAR(50), city VARCHAR(30), state CHARACTER(2), zip SMALLINT);
   * CREATE TABLE brands(id serial PRIMARY KEY, name VARCHAR(255));
   * CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id INT, shoe_id INT);

## Known Bugs
* No known bugs

## License
* MIT

## Copyright
* © Ash Laidlaw 2017
