<?php

$error = false;
$loggedIn = false;
session_start();
if(isset($_POST['login'])) {
	$username = $_POST['loginUser'];
	$password = $_POST['loginPass'];
	if(file_exists('users.xml'))
	{
		

		$xml = new SimpleXMLElement('users.xml', 0, true);
		if($password == $xml->password)
		{
			
			$_SESSION['username'] = $username;
			header('Location: Registrations.php');
			$loggedIn = false;
		}
	}
	$error = true;
}
if(isset($_POST['logout'])) {
	session_destroy();
	header('Location: Registrations.php');
}
if(isset($_POST['adminPage'])) {
	header('Location: AdminPage.php');
}
if($_SESSION){
	if($_SESSION['username'])
	{
		$loggedIn = true;
	}
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
		<img class="imageLogo" src="RestoranteLogo.jpg" alt="logoRestoran" />
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
				<a href="ContactUs.html">Contact Us </a>
			</li>
			<li>
				<a href="Registrations.php">Registration </a>
			</li>
		</ul>
	</nav>	
	
	<div class="bodyImage"> 
		<div class="tileRegistration">
			
			<div class="registrationNewUser">
				<div class="contactTitle">
					New user 
				</div>
				<div class="titleMessage">
					If You are a new user please click on a button bellow to register
				</div>
				<div class="buttonHolder">
					<form style="display: inline" onsubmit="return loadDoc('newUser.html');">
 						<button class="buttonRegister" type="submit">Register</button> 
					</form>
				</div>
			</div>
			<?php 
			if(!$loggedIn) {
			 echo '<form action="" method="post" class="formLogin" name="formLogin" onsubmit="return validateLogin();">
			 				<div class="contactTitle">
			 					Already a user
			 				</div>
			 				<div class="titleMessage">
			 					If You are already a user please enter Your credetianls bellow
			 				</div>
			 				<div class="loginUsername" id="errLoginUser" >Please fill your login username</div>
			 				<input class="loginUsername" name="loginUser" type="text" placeholder="Username">
			 				<div class="loginPassword" id="errLoginPass" >Please fill your login password</div>
			 				<input class="loginPassword" name="loginPass" type="password" placeholder=" Password">';
			 				if($error)
			 				{
			 					echo '<p> Invalid username or password </p>';
			 				}
			 				echo '<div class="buttonHolder">
			 					<input class="reservationSend" type="submit" value="Send" name="login" onclick="return validateLogin()">
			 				</div>
			 			</form>';
			}
			elseif ($loggedIn) {
				echo '<div class="contactTitle">
									Welcome '; 
				echo $_SESSION['username']; 
				echo '</div>';
				echo '<form action="" method="post" class="formLogin" name="formLogout"> <div class="buttonHolder">
			 					<input class="reservationSend" type="submit" value="Logout" name="logout" onclick="return validateLogin()">
			 					<input class="adminSend" type="submit" value="Admin page" name="adminPage" onclick="return validateLogin()">
			 				</div>
			 			</form>';
			}
			?>
		</div>
	</div>
	<div class="footSocial">
		<img class="footImg" src="RestaurantLogoBottom.png" alt="logoBottom">
	</div>
</body>
</html>