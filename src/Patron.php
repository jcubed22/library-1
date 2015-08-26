<?php

    //UNFINISHED!
    Class Patron
    {
        private $name;
        private $phone_number;
        private $id;

        function __construct($name, $phone_number, $id = null);
        {
            $this->name = $name;
            $this->phone_number = $phone_number;
            $id->id = $id;
        }

        function setName($new_name)
        {
            $this->name = $$new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setPhoneNumber($new_phone_number)
        {
            $this->phone_number = $new_phone_number;
        }

        function getPhoneNumber()
        {
            return $this->phone_number;
        }

        function getId()
        {
            return $this->id;
        }
    }



?>
