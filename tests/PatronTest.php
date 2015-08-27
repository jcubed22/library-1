<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Patron.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class PatronTest extends PHPUnit_Framework_TestCase
    {
        // default delete function
        protected function tearDown()
        {
            Patron::deleteAll();
        }
        function testSetPatronName()
        {
            //Arrange
            $patron_name = "Jim Joe";
            $test_patron = new Patron($patron_name);
            //Act
            $test_patron->setPatronName("Billy Bob");
            $result = $test_patron->getPatronName();
            //Assert
            $this->assertEquals("Billy Bob", $result);
        }
        function testGetPatronName()
        {
            //Arrange
            $patron_name = "Eduardo";
            $test_patron = new Patron($patron_name);
            //Act
            $result = $test_patron->getPatronName();
            //Assert
            $this->assertEquals($patron_name, $result);
        }
        function testGetId()
        {
            //Arrange
            $id = 1;
            $patron_name = "Chichi";
            $test_patron = new Patron($patron_name, $id);
            //Act
            $result = $test_patron->getId();
            //Assert
            $this->assertEquals(1, $result);
        }
        function testSave()
        {
            //Arrange
            $patron_name = "Gustav";
            $id = null;
            $test_patron = new Patron($patron_name, $id);
            //Act
            $test_patron->save();
            //Assert
            $result = Patron::getAll();
            $this->assertEquals($test_patron, $result[0]);
        }
        function testGetAll()
        {
            //Arrange
            $patron_name = "Butterball";
            $id = null;
            $test_patron = new Patron($patron_name, $id);
            $test_patron->save();
            $patron_name2 = "Lance Armstrang";
            $id2 = null;
            $test_patron2 = new Patron($patron_name2, $id2);
            $test_patron2->save();
            //Act
            $result = Patron::getAll();
            //Assert
            $this->assertEquals([$test_patron, $test_patron2], $result);
        }

        function testSearchPatron()
        {
            //Arrange
            $patron_name = "Mr. Pickles";
            $id = null;
            $test_patron = new Patron($patron_name, $id);
            $test_patron->save();

            $patron_name2 = "John Doe";
            $test_patron2 = new Patron($patron_name2, $id);
            $test_patron2->save();

            $search_string = "Mr. Pickles";

            //Act
            $result = Patron::searchPatron($search_string);

            //Assert
            $this->assertEquals([$test_patron], $result);

        }
    }

?>
