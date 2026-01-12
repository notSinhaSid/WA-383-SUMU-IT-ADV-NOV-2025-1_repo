<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

class User

{

    private $name;

    public function __construct($name)

    {

        $this->name = $name;

        echo "User {$this->name} logged in<br>";
    }

    public function show()

    {

        echo "User {$this->name} is active<br>";
    }

    public function __destruct()

    {

        echo "User {$this->name} logged out<br>";
    }
}

$user1 = new User("Subhendu");

$user1->show();

echo "Before unset()<br>";

// Destroy object manually

unset($user1);

echo "After unset()<br>";

$user1->show();

echo "End<br>";
