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
            $GLOBALS['DB']->exec("INSERT INTO books (title, year_published) VALUES
                ('{$this->getTitle()}', {$this->getYearPublished()});");
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

        function update($new_title)
        {
            $GLOBALS['DB']->exec("UPDATE books SET title = '{$new_title}' WHERE
                id = {$this->getId()};");
            $this->setTitle($new_title);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM books WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM authors_books WHERE book_id = {$this->getId()};");
        }

        static function find($search_id)
        {
            $found_book = null;
            $books = Book::getAll();
            foreach($books as $book) {
                $book_id = $book->getId();
                if ($book_id == $search_id) {
                    $found_book = $book;
                }
            }
            return $found_book;
        }

        function getAuthors()
        {
            $authors = array();
            $results = $GLOBALS['DB']->query("SELECT authors.* FROM
                books JOIN authors_books ON (books.id = authors_books.book_id)
                      JOIN authors ON (authors_books.author_id = authors.id)
                      WHERE books.id = {$this->getId()};");

            foreach($results as $author) {
                $name = $author['name'];
                $id = $author['id'];
                $new_author = new Author($name, $id);
                array_push($authors, $new_author);
            }
            return $authors;
        }

        function addAuthor($new_author)
        {
            $GLOBALS['DB']->exec("INSERT INTO authors_books (author_id, book_id) VALUES
                ({$new_author->getId()}, {$this->getId()});");
        }

    }
?>
