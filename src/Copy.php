<?php

    class Copy
    {
        private $book_id;
        private $amount;
        private $id;

        function __construct($book_id, $amount, $id = null)
        {
            $this->book_id = $book_id;
            $id->id = $id;
        }

        function getBookId()
        {
            return $this->book_id;
        }

        function setAmount($new_amount)
        {
            $this->amount = $new_amount;
        }

        function getAmount()
        {
            return $this->amount;
        }

        function getId()
        {
            return $this->id;
        }

        function countCopies()
        {

        }











    }
?>
