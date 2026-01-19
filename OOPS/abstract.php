<?php

abstract class SchoolDasahboard {
    const GREETING_ON_WELCOME = "Hello There! 😊";
    abstract protected function greetingOnWelcome($name) : string;
}

class DashboardGreeterClass extends SchoolDasahboard {
    public $name;
    public $role;
    public function __construct(/* $name, $role = "student" */)
    {
        /* $this->name = $name;
        $this->role = $role; */
        echo SchoolDasahboard::GREETING_ON_WELCOME . "<br>";
        
    }
    public function greetingOnWelcome($name, $role = "vistor") : string
    {
        
        if($role === "student") {
            return "Greeting $role, $name. Welcome to Evergreen Public School<br>";
        }
        elseif($role === "teacher") {
            return "Greeting $role, $name. Welcome to your dashboard<br>";
        }
        else{
            return "Greeting $role, $name. Welcome to Evergreen Public School<br>";
        }

        
    }
}

$studentObj = new DashboardGreeterClass();
echo $studentObj->greetingOnWelcome("Manish", "student");

$teacherObj = new DashboardGreeterClass();
echo $teacherObj->greetingOnWelcome("Ritu", "teacher");

$vistor = new DashboardGreeterClass();
echo $vistor->greetingOnWelcome("Jatin");