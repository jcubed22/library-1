<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Author.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class AuthorTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Author::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $name = "Nathan Young";
            $id = null;
            $test_author = new Author($name, $id);

            //Act
            $test_author->save();

            //Assert
            $result = Author::getAll();
            $this->assertEquals($test_author, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $name = "Nathan Young";
            $id = null;
            $test_author = new Author($name, $id);
            $test_author->save();

            $name2 = "Kyle Pratuch";
            $test_author2 = new Author($name2, $id);
            $test_author2->save();

            //Act
            $result = Author::getAll();

            //Assert
            $this->assertEquals([$test_author, $test_author2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Nathan Young";
            $id = null;
            $test_author = new Author($name, $id);
            $test_author->save();

            $name2 = "Kyle Pratuch";
            $test_author2 = new Author($name2, $id);
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
            $name = "Nathan Young";
            $id = null;
            $test_author = new Author($name, $id);
            $test_author->save();

            //Act
            $result = $test_author->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testUpdate()
        {
            //Arrange
            $name = "Nathan Young";
            $id = null;
            $test_author = new Author($name, $id);
            $test_author->save();

            $new_name = "Kyle Pratuch";

            //Act
            $test_author->update($new_name);

            //Assert
            $this->assertEquals("Kyle Pratuch", $test_author->getName());
        }

        function testDelete()
        {
            //Arrange
            $name = "Nathan Young";
            $id = null;
            $test_author = new Author($name, $id);
            $test_author->save();

            $name2 = "Kyle Pratuch";
            $test_author2 = new Author($name2, $id);
            $test_author2->save();

            //Act
            $test_author->delete();

            //
            $this->assertEquals([$test_author2], Author::getAll());
        }

        function testFind()
        {
            //Arrange
            $name = "Nathan Young";
            $id = null;
            $test_author = new Author($name, $id);
            $test_author->save();

            $name2 = "Kyle Pratuch";
            $test_author2 = new Author($name2, $id);
            $test_author2->save();

            //Act
            $id = $test_author->getId();

            //Assert
            $result = Author::find($id);
            $this->assertEquals($test_author, $result);
        }

    }
