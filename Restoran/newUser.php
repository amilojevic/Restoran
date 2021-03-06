<?php
session_start();
if(isset($_POST['registerNewUser'])){
	$registerUsername = $_POST['registerUsername'];
	$registerPassword = $_POST['registerPassword'];
	$registerPasswordAgain = $_POST['registerPasswordAgain'];
	$admin = 0;
	$veza = new PDO("mysql:dbname=restoran;host=localhost;charset=utf8", "andrej", "admin");
    $veza->exec("set names utf8");
     	
    $rezultat = $veza->query("INSERT INTO user SET  username='$registerUsername', password='$registerPassword',admin=$admin"); 

	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<title>ETF Restorante</title>
	<link rel="stylesheet" type="text/css" href="styleRestorante.css">
	<script type="text/javascript" src="scriptRestorante.js"></script>
	<meta name="viewport" content="width=device-width">
</head>
<body id="body">
	<div class="mainHeader">
		<img class="imageLogo" src="RestoranteLogo.jpg" alt="logo" />
		<div class="mainTitle">ETF Restorante</div>
	</div>
		<nav class="navbar" id="navigation">
		<ul class="navbarItems">
			<li>
				<a href="ETFRestorante.html"> Home</a>
			</li>
			<li>
				<a href="#">About Us</a>
			</li>
			<li>
				<a href="OurOffers.html"> Our offers</a>
			</li>
			<li>
				<a href="Reservations.php">Reservations </a>
			</li>
			<li>
				<a href="ContactUs.php">Contact Us </a>
			</li>
			<li>
				<a href="Registrations.php">Registration </a>
			</li>
		</ul>
	</nav>	
	
	<div class="bodyImage"> 
		<div class="tileRegistration">
			<div class="contactTitle">
				New user 
			</div>
			<div class="titleMessage">
				Fill out the form bellow
			</div>
			<form class="formRegister" method="POST" name="formRegister" onsubmit="return validateRegistration();"">
				<p class="titleMessage">Enter Your username:</p>
				<div class="registerUsername" id="errRegisterUsername" >Please fill your register username</div>
  				<input class="registerUsername" name="registerUsername" type="text" placeholder="Your username">
  				<p class="titleMessage">Enter Your password:</p>
  				<div class="registerPassword" id="errRegisterPassword" >Please fill your register password</div>
				<input class="registerPassword" name="registerPassword" type="password" placeholder=" Password">
				<p class="titleMessage">Enter Your password again:</p>
				<div class="registerPassword" id="errRegisterPasswordAgain" >Please fill your register password</div>
				<input class="registerPassword" name="registerPasswordAgain" type="password" placeholder="Repeat Your password">
				<div class="buttonHolder">
					<input class="reservationSend" name="registerNewUser" type="submit" value="Send" onclick="return validateRegistration()">
				</div>
			</form>
		</div>
	</div>
	<div class="footSocial">
		<img class="footImg" src="RestaurantLogoBottom.png" alt="logoBottom">
	</div>
</body>
</html>