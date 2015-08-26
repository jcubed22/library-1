<?php

    class Book
    {
        private $title;
        private $year_published;
        private $id;


        function __construct($title, $year_published, $id=null)
        {
            $this->title = $title;
            $this->year_published = $year_published;
            $this->id = $id;
        }

        function setTitle($new_title)
        {
            $this->title = (string) $new_title;
        }

        function getTitle()
        {
            return $this->title;
        }

        function getYearPublished()
        {
            return $this->year_published;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->exec("INSERT INTO books (title, year_published) VALUES
                ('{$this->getTitle()}',
                {$this->getYearPublished()})
            ;");

            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_books = $GLOBALS['DB']->query("SELECT * FROM books;");
            $books = array();
            foreach ($returned_books as $book) {
                $title = $book['title'];
                $year_published = $book['year_published'];
                $id = $book['id'];
                $new_book = new Book($title, $year_published, $id);
                array_push($books, $new_book);
            }
            return $books;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM books;");
        }















    }
?>
