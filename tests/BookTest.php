<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Book.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BookTest extends PHPUnit_Framework_TestCase {

        protected function tearDown()
        {
            Book::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $title = "Where the Red Fern Grows";
            $year_published = 1961;
            $id = null;
            $test_book = new Book($title, $year_published, $id);

            //Act
            $test_book->save();

            //Assert
            $result = Book::getAll();
            $this->assertEquals($test_book, $result[0]);

        }

        function testGetAll()
        {
            //Arrange
            $title = "Where the Red Fern Grows";
            $year_published = 1961;
            $id = null;
            $test_book = new Book($title, $year_published, $id);
            $test_book->save();

            $title2 = "Where the Wild Things Are";
            $year_published2 = 1964;
            $test_book2 = new Book($title2, $year_published2, $id);
            $test_book2->save();

            //Act
            $result = Book::getAll();

            //Assert
            $this->assertEquals([$test_book, $test_book2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $title = "Where the Red Fern Grows";
            $year_published = 1961;
            $id = null;
            $test_book = new Book($title, $year_published, $id);
            $test_book->save();

            $title2 = "Where the Wild Things Are";
            $year_published2 = 1964;
            $test_book2 = new Book($title2, $year_published2, $id);
            $test_book2->save();

            //Act
            Book::deleteAll();

            //Assert
            $result = Book::getAll();
            $this->assertEquals([], $result);
        }



    }
?>
