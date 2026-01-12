<?php

$orders = [
    [
        'order_id' => 101,
        'items' => [
            ['name' => 'Pen', 'price' => 10, 'qty' => 5],
            ['name' => 'Book', 'price' => 50, 'qty' => 2],
        ]
    ],
    [
        'order_id' => 102,
        'items' => [
            ['name' => 'Pencil', 'price' => 5, 'qty' => 10],
            ['name' => 'Eraser', 'price' => 3, 'qty' => 4],
        ]
    ]
];

/* 
    Tasks
    
    Calculate total amount per order
    
    Display grand total of all orders
    
    Expected Output:
    
    Order 101 Total: 150
    Order 102 Total: 62
    
    Grand Total: 212
*/
$grandTotal = 0.0;
foreach($orders as $itemOrdered) {

    // print_r($itemOrdered);
    // print_r($itemOrdered['order_id']);
    $totalAmount = 0;

    foreach($itemOrdered['items'] as $itemsDesc) {
        
        // print_r($itemsDesc);

        $totalAmount += $itemsDesc['price'] * $itemsDesc['qty'];
    }

    echo "Order : ". $itemOrdered['order_id']. "    Total :  ".$totalAmount."<br>";

    $grandTotal += $totalAmount;
}

echo "Grand Total : $grandTotal";