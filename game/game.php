<?php
session_start();
echo '<p id="name">'.$_SESSION['data']['name'].'<p>';
echo '<br>';

include_once 'php/save_session.php';
include_once '../php/connect_to_database.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Game</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stylesheets/game.css">
</head>
<body>

<form method="post">
<input type="submit" id="save" name="save" method="post" value="Save Changes"/>
</form>


<?php
if(isset($_POST['save']))
{
    save_session_to_database();
}
?>

<div class="content">
<button onclick="add_cookie()"><img src="img/cookie.png"></button>
<p id="cookiecount">0<p>
</div>

<ul class="buy">
<li><button onclick="buy('oven')">Buy Oven</button></li>
<li><button onclick="buy('restraunt')">Buy restraunt</button></li>
<li><button onclick="buy('bakery')">Buy bakery</button></li>
<li><button onclick="buy('factory')">Buy factory</button></li>
</ul>

<ul class="abilities">
<li><?php echo $_SESSION['data']['ability1'];?> ovens</li>
<li><?php echo $_SESSION['data']['ability2'];?> restraunts</li>
<li><?php echo $_SESSION['data']['ability3'];?> bakeries</li>
<li><?php echo $_SESSION['data']['ability4'];?> factories</li>
</ul>


<ul class="price">
<li>50 cookies</li>
<li>500 cookies</li>
<li>2000 cookies</li>
<li>10000 cookies</li>
</ul>

</body>
</html>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>

var cookies = <?php echo $_SESSION['data']['cookies']; ?>;
document.getElementById('cookiecount').innerHTML = 'U have ' + cookies.toFixed(1) + ' cookies' + '<br>' + calculate_cookie_speed();

function add_cookie()
{
$.ajax({ url: 'php/add_cookie.php'});

cookies += calculate_cookie_speed();

document.getElementById('cookiecount').innerHTML = 'U have ' + cookies.toFixed(1) + ' cookies' + '<br>' + calculate_cookie_speed();
}

function calculate_cookie_speed() {
    var total = 1;
    var total_ovens = <?php echo $_SESSION['data']['ability1']; ?>;
    var total_restraunts = <?php echo $_SESSION['data']['ability2']; ?>;
    var total_bakeries = <?php echo $_SESSION['data']['ability3']; ?>;
    var total_factories = <?php echo $_SESSION['data']['ability4']; ?>;
    total += total_ovens / 10;
    total += total_restraunts * 2;
    total += total_bakeries * 10;
    total += total_factories * 75;
    return total;
}

function buy(name)
{
$.ajax({
    type: "POST",
    url: 'php/shop.php',
    data: 'buyrequest='+name,
});

location.reload();
}

</script>