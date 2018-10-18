<?php

require_once('./function/View.php');
$view = new View();


// the second arguent is for choose the type of range 
// 1 = rsort
// 2 = asort


// the third argument is for the color
// 1 for Blue
// 2 for RED
// 3 for Pink
// 4 for green

$view->renderView($_SERVER["REQUEST_URI"],2,4);

?>