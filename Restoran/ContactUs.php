<?php
session_start();
$reservationIdUser = 0;
if(!$_SESSION) {
	$reservationIdUser = 99;
} else {
	$reservationIdUser = (int)$_SESSION['idUser'];
}
	if(isset($_POST['contact'])){
		$contactName = $_POST['contactName'];
		$contactEmail = $_POST['contactEmail'];
		$subject = $_POST['subject'];
		$text = $_POST['text'];


		//$reservationDate = $_POST['reservationDate'];
		/*if(file_exists('reservations.xml'))
		{
			$xml = new SimpleXMLElement('reservations.xml', 0, true);
			foreach ($xml->reservation as $reservation)
			{
				$reservationId = (int)$reservation->reservationId;
			}
			$reservationId = $reservationId + 1;
		}
		else {
			$xml = new SimpleXMLElement('<reservations></reservations>');
		}
		
		$reservation = $xml->addChild('reservation');
		$reservation->addChild('reservationName', $reservationName);
		$reservation->addChild('reservationLastName', $reservationLastName);
		$reservation->addChild('reservationEmail', $reservationEmail);
		$reservation->addChild('reservationTime', $reservationTime);
		$reservation->addChild('reservationId', $reservationId);
		$reservation->addChild('idKorisnik', $reservationIdUser);
		//$xml->addChild('reservationDate', $reservationDate);
		if(@simplexml_load_file('reservations.xml'))
		{
			$xml->asXML('reservations.xml');
			
		}
		else {
			$xml->asXML('reservations.xml');
			
		}*/
		$veza = new PDO("mysql:dbname=restoran;host=localhost;charset=utf8", "andrej", "admin");
     	$veza->exec("set names utf8");
     	
     	$rezultat = $veza->query("INSERT INTO kontakt SET idKorisnika=$reservationIdUser, ime='$contactName', email='$contactEmail',subjekat='$subject',tekst='$text'"); 

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
		<div class="tileContact">
			<form class="formContact" method="POST" name="formContact" onsubmit="return validateContact();">
				<div class="contactTitle">
					Send a message
				</div>
				<div class="titleMessage">
					Do you have somenthing to tell us. Please do not hesitate to get in touch to us via our contact form
				</div>
				<div id="errName" >Please fill your contact name</div>
				<input class="contactName" name="contactName" type="text" placeholder="Name">
				<div class="contactEmail" name="contactEmail" id="errEmail" >Please fill your contact email</div>
				<input class="contactEmail" name="contactEmail" type="email" placeholder="Your Email Address"> 
				<div class="contactSubject" id="errSubject" >Please fill your contact subject</div>
				<input class="contactSubject" name="subject" type="text" placeholder="Subject"> 
				<div class="contactSubject" id="errText" >Please fill your contact text</div>
				<textarea class="contactMessage" name="text" placeholder="Your Message"></textarea>
				<div class="buttonHolder">
					<input class="reservationSend" name="contact" type="submit" value="Send" onclick="return validateContact()">
				</div>
			</form>
			<div class="socialContact">
				<div class="contactTitle">
					Other ways of contact
				</div>
				<div class="titleMessage">
					You can reach also on these social networks, number or email. Please contact us if You have any questions
				</div>
				<p>Tel number: 003876136845212 </p>
				<p>Email: ETFRestorante@mail.etf.unsa.ba</p>
				<p>Site: www.ETFRestorante.co.uk</p>
				<p>Work hours: Every day from 9:00 to 23:00</p>
			</div>
		</div>
	</div>
	<div class="footSocial">
		<img class="footImg" src="RestaurantLogoBottom.png" alt="logoBottom">
	</div>
</body>
</html>