<?php
session_start();

$total_cookies = calculate_cookie_speed();

function calculate_cookie_speed() {
    $total = 1;
    $total_ovens = $_SESSION['data']['ability1'];
    $total_restraunts = $_SESSION['data']['ability2'];
    $total_bakeries = $_SESSION['data']['ability3'];
    $total_factories = $_SESSION['data']['ability4'];

    $total += $total_ovens / 10;
    $total += $total_restraunts * 2;
    $total += $total_bakeries * 10;
    $total += $total_factories * 75;
    $total = round($total, 1, PHP_ROUND_HALF_UP);
    return $total;
}

$_SESSION['data']['cookies'] += $total_cookies;
?>