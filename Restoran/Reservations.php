<?php
	if(isset($_POST['reservation'])){
		$reservationName = $_POST['reservationName'];
		$reservationLastName = $_POST['reservationLastName'];
		$reservationEmail = $_POST['reservationEmail'];
		$reservationTime = $_POST['reservationTime'];
		$reservationId = 0;
		//$reservationDate = $_POST['reservationDate'];
		if(file_exists('reservations.xml'))
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
		//$xml->addChild('reservationDate', $reservationDate);
		if(@simplexml_load_file('reservations.xml'))
		{
			$xml->asXML('reservations.xml');
			
		}
		else {
			$xml->asXML('reservations.xml');
			
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
		<div class="tileReservations">
			<div class="contactTitle">
					Make a reservation
			</div>
			<div class="titleMessage">
				Book a table and we will send a email to confirm Your reservation
			</div>
			<div class="reservationDecoration">
				<img class="imageReservation" src="reservationsImage.png" alt="reservation">
			</div>
			<form class="formReservations" method="POST" name="formReservations" onsubmit="return validateReservation();">
				<div class="reservationName" id="errReservationName" >Please fill your reservation name</div>
				<input class="reservationName" name="reservationName" type="text" placeholder="Name">
				<div class="reservationName" id="errReservationLastName" >Please fill your reservation last name</div>
				<input class="reservationLastName" name="reservationLastName" type="text" placeholder=" Last Name">
				<div class="reservationName" id="errReservationEmail" >Please fill your reservation email</div>
				<input class="reservationEmail" name="reservationEmail" type="email" placeholder="Email"> 
				<div class="reservationName" id="errReservationTime" >Please fill your reservation time</div>
				<input class="reservationTime" name="reservationTime" type="text" placeholder="Time"> 
				<!--<input type="date" class="reservationDate" name="reservationDate" min="2016-11-07">-->
				<div class="buttonHolder">
					<input class="reservationSend" name="reservation" type="submit" value="Send" onclick="return validateReservation()">
				</div>
			</form>
		</div>
	</div>
	<div class="footSocial">
		<img class="footImg" src="RestaurantLogoBottom.png" alt="logoBottom">
	</div>
</body>
</html>