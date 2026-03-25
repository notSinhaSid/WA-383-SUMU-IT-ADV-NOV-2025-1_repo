<?php

// static 
class FoodIngridents {
    public $foodName;
    public $ingrident1;
    public $ingrident2;
    protected static function welcomeMessage() {
        echo "Welcome to Shake Customizer <br>";
        echo "Please Enter your choice of drink and 2 main ingridents that you like to add to it ❓<br>";
    }

    public function __construct(string $foodName, string $ingrident1, string $ingrident2)
    {
        self::welcomeMessage();
        $this->foodName = $foodName;
        $this->ingrident1 = $ingrident1;
        $this->ingrident2 = $ingrident2;
    }

    public function commonIngridents() {
        return "<strong>The $this->foodName, with $this->ingrident1 and $this->ingrident2 as per your choice is now serving 😋.</strong><br>";

    }
    
}



class Snacks extends FoodIngridents {
    public $snackName;
    public function __construct(string $foodName = "Milk Shake", string $ingrident1 = "Curd", string $ingrident2 = "Sugar") {
        parent::__construct($foodName, $ingrident1, $ingrident2);
        echo "<em>Complimentry snacks of Frech Fries 🍟 is been served with your requested drink that is <em>". parent::commonIngridents();
    }

}

$food1 = new FoodIngridents("Milk Shake", "Curd", "Sugar");
echo $food1->commonIngridents();

$menu = new Snacks("Cold Coffee", "Ice Cream", "Chocolate Syrup");
