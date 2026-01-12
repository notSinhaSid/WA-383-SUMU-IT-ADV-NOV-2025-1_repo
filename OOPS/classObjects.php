<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class Cars {
    public $name;
    public $price;
    public $company;

    /* function setCarName($name) {
        $this->name = $name;

    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setCompanyName($company) {
        $this->company = $company;
    } */

    function setDetails($name/*  = '800' */, $price = 100000, $company = 'Maruti')
    {
        $this->name = $name;
        $this->price = $price;
        $this->company = $company;
    }


    function displayDetails() {
        echo <<<EOD
            The car name is $this->name
            The on-road price is $this->price
            The parent company is $this->company
            \n
        EOD;
    }
}

$obj1 = new Cars();
/* $obj1->setCarName('Class S');
$obj1->setPrice(250000);
$obj1->setCompanyName('Mercedes'); */
$obj1->setDetails('Class S', 250000, 'Mercedes');

$obj2 = new Cars();
/* $obj2->setCarName('Fortuner');
$obj2->setPrice(450000);
$obj2->setCompanyName('Toyta'); */
$obj2->setDetails('Fortuner', 450000, 'Toyta');

$obj3 = new Cars();
/* $obj3->setCarName('Climber');
$obj3->setPrice(420000);
$obj3->setCompanyName('Reault'); */
$obj3->setDetails('alto');

echo $obj1->displayDetails();
echo "<br>";
echo $obj2->displayDetails();
echo "<br>";
echo $obj3->displayDetails();
echo "<br>";