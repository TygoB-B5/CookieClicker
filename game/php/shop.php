<?php
session_start();
$buyrequest = $_POST['buyrequest'];

$required_cookies = get_required_cookies($buyrequest);

function get_required_cookies($item_name){
$required_amount = 0;
if($item_name == 'oven') $required_amount = 50;
else if($item_name == 'restraunt') $required_amount = 500;
else if($item_name == 'bakery') $required_amount = 2000;
else if($item_name == 'factory') $required_amount = 10000;
else return;

return $required_amount;
}

if($required_cookies > $_SESSION['data']['cookies']) {
    return;
}

$_SESSION['data']['cookies'] -= $required_cookies;

if($buyrequest === 'oven') $_SESSION['data']['ability1'] += 1;
else if($buyrequest === 'restraunt') $_SESSION['data']['ability2'] += 1;
else if($buyrequest === 'bakery') $_SESSION['data']['ability3'] += 1;
else if($buyrequest === 'factory') $_SESSION['data']['ability4'] += 1;
else return;
?>