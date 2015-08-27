<?php

    class Patron
    {
        private $patron_name;
        private $id;

        function __construct($patron_name, $id = null)
        {
            $this->patron_name = $patron_name;
            $this->id = $id;
        }

        function setPatronName($new_patron_name)
        {
            $this->patron_name = $new_patron_name;
        }

        function getPatronName()
        {
            return $this->patron_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO patrons (patron_name)
            VALUES ('{$this->getPatronName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_patrons = $GLOBALS['DB']->query("SELECT * FROM patrons;");
            $patrons = array();
            foreach($returned_patrons as $patron) {
                $patron_name = $patron['patron_name'];
                $id = $patron['id'];
                $new_patron = new Patron($patron_name, $id);
                array_push($patrons, $new_patron);
            }
            return $patrons;
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM patrons WHERE id = {$this->getId()};");
            // to delete patron from potential join table
            // $GLOBALS['DB']->exec("DELETE FROM authors_books
            // WHERE patron_id = {$this->getId()};");
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM patrons;");
        }

        static function find($search_id)
        {
            $found_patron = null;
            $patrons = Patron::getAll();
            foreach($patrons as $patron) {
                $patron_id = $patron->getId();
                if ($patron_id == $search_id) {
                    $found_patron = $patron;
                }
            }
            return $found_patron;
        }

        static function searchPatron($search_patron)
        {
            $found_patrons = array();
            $results = $GLOBALS['DB']->query("SELECT * FROM patrons
            WHERE patron_name = '{$search_patron}';");

            foreach($results as $patron) {
                $patron_name = $patron['patron_name'];
                $id = $patron['id'];
                $found_patron = new Patron($patron_name, $id);
                array_push($found_patrons, $found_patron);
            }
            return $found_patrons;
        }

        // Potential getCopies from join table (checkouts)
        // function getAuthors()
        // {
        //     $authors = array();
        //     $results = $GLOBALS['DB']->query("SELECT authors.* FROM
        //         books JOIN authors_books ON (books.id = authors_books.book_id)
        //               JOIN authors ON (authors_books.author_id = authors.id)
        //               WHERE books.id = {$this->getId()};");
        //
        //     foreach($results as $author) {
        //         $author_name = $author['author_name'];
        //         $id = $author['id'];
        //         $new_author = new Author($author_name, $id);
        //         array_push($authors, $new_author);
        //     }
        //     return $authors;
        // }

        function update($new_patron_name)
        {
            $GLOBALS['DB']->exec("UPDATE patrons SET patron_name = '{$new_patron_name}'
                WHERE id = {$this->getId()};");
            $this->setPatronName($new_patron_name);
        }

    }

?>
