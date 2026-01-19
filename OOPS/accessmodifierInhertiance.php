<?php

class Employee {
    public $name;
    public $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    protected function EmpData() {
        echo <<<EOD
        -----------------------------------
        The basic details of our employee : <br>
        NAME : $this->name
        AGE : $this->age
        <br>
        
        EOD;
    }

    public function displayRegualarData() {
        echo <<<EOD
        \n
        Emp Name: $this->name <br>
        Emp Age : $this->age <br>
        EOD;
    }
}

class Managers extends Employee {
    public $position;

    public function __construct($name, $age, $position)
    {
        $this->name = $name;
        $this->age = $age;
        $this->position = $position;
    }

    public function displayEmpData() 
    {
        $this->EmpData();
        echo "<br>";
        echo "This person holds the posisition of $this->position";
    }
}


$emp1 = new Employee("Rakesh", 34);

$emp1->displayRegualarData();

$manager1 = new Managers("Harshit", 49, "Production");
$manager1->displayEmpData();