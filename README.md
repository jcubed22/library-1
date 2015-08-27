Library
==========

By Samantha Maturen, Jordan Johansen, Nathan Young, Kyle Pratuch 26-Aug-2015

App that uses a database to catalog a library's books and lets patrons check them out. Librarian can create, read, update, and delete books, can search for a book, , see a list of overdue books, and can enter multiple authors for a book. Patrons can check out books, find how many copies of a book are available, see a history of checked out books, and see when a book has been checked out.

Setup
----------
* Clone repository:
```console
$ git clone https://github.com/samchalle/library-1.git
```
* Install Silex/Twig/PHPUnit via Composer in the project folder:
```console
$ composer install
```
* Start your local host in the web folder:
```console
$ php -S localhost:8000
```
* Unzip **library.sql.zip** and import it to your local server.
* Navigate your browser to **localhost:8000**
* To run tests using PHPUnit, create a copy of the database called **library_test**

Technologies Used
----------
PHP, Twig, Silex, PHPUnit, MySQL, HTML, Bootstrap, CSS

License
----------
MIT License, Copyright (c) 2015 Samantha Maturen, Jordan Johansen, Nathan Young, Kyle Pratuch
