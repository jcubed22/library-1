<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Author.php";
    require_once "src/Book.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class AuthorTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Author::deleteAll();
            Book::deleteAll();
            $GLOBALS['DB']->exec("DELETE FROM authors_books;");
        }

        function testSave()
        {
            //Arrange
            $author_name = "Nathan Young";
            $id = null;
            $test_author = new Author($author_name, $id);

            //Act
            $test_author->save();

            //Assert
            $result = Author::getAll();
            $this->assertEquals($test_author, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $author_name = "Nathan Young";
            $id = null;
            $test_author = new Author($author_name, $id);
            $test_author->save();

            $author_name2 = "Kyle Pratuch";
            $test_author2 = new Author($author_name2, $id);
            $test_author2->save();

            //Act
            $result = Author::getAll();

            //Assert
            $this->assertEquals([$test_author, $test_author2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $author_name = "Nathan Young";
            $id = null;
            $test_author = new Author($author_name, $id);
            $test_author->save();

            $author_name2 = "Kyle Pratuch";
            $test_author2 = new Author($author_name2, $id);
            $test_author2->save();

            //Act
            Author::deleteAll();

            //Assert
            $result = Author::getAll();
            $this->assertEquals([], $result);
        }

        function testGetId()
        {
            //Arrange
            $author_name = "Nathan Young";
            $id = null;
            $test_author = new Author($author_name, $id);
            $test_author->save();

            //Act
            $result = $test_author->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testUpdate()
        {
            //Arrange
            $author_name = "Nathan Young";
            $id = null;
            $test_author = new Author($author_name, $id);
            $test_author->save();

            $new_name = "Kyle Pratuch";

            //Act
            $test_author->update($new_name);

            //Assert
            $this->assertEquals("Kyle Pratuch", $test_author->getAuthorName());
        }

        function testDelete()
        {
            //Arrange
            $author_name = "Nathan Young";
            $id = null;
            $test_author = new Author($author_name, $id);
            $test_author->save();

            $author_name2 = "Kyle Pratuch";
            $test_author2 = new Author($author_name2, $id);
            $test_author2->save();

            //Act
            $test_author->delete();

            //
            $this->assertEquals([$test_author2], Author::getAll());
        }

        function testFind()
        {
            //Arrange
            $author_name = "Nathan Young";
            $id = null;
            $test_author = new Author($author_name, $id);
            $test_author->save();

            $author_name2 = "Kyle Pratuch";
            $test_author2 = new Author($author_name2, $id);
            $test_author2->save();

            //Act
            $id = $test_author->getId();

            //Assert
            $result = Author::find($id);
            $this->assertEquals($test_author, $result);
        }

        function testAddBook()
        {
            //Arrange
            $title = "Eat a Cupcake";
            $year_published = 1999;
            $id = null;
            $test_book = new Book($title, $year_published, $id);
            $test_book->save();

            $author_name = "Nathan Young";
            $test_author = new Author($author_name, $id);
            $test_author->save();

            //Act
            $test_author->addBook($test_book);

            //Assert
            $this->assertEquals([$test_book], $test_author->getBooks());
        }


        function testGetBooks()
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

            $author_name = "Nathan Young";
            $test_author = new Author($author_name, $id);
            $test_author->save();

            //Act
            $test_author->addBook($test_book);
            $test_author->addBook($test_book2);

            //Assert
            $this->assertEquals([$test_book, $test_book2], $test_author->getBooks());
        }

        function testSearchAuthorName()
        {
            //Arrange
            $author_name = "Nathan Young";
            $id = null;
            $test_author = new Author($author_name, $id);
            $test_author->save();

            $author_name2 = "Kyle Pratuch";
            $test_author2 = new Author($author_name2, $id);
            $test_author2->save();

            $search_string = "Kyle Pratuch";

            //Act
            $result = Author::searchAuthorName($search_string);

            //Assert
            $this->assertEquals([$test_author2], $result);
        }

    }
