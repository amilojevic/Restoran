<?php
session_start();
if($_SESSION['username'] != 'admin') {
	header('Location: Registrations.php');
}
$reservationId;
$reservationIdFlag = false;
if(isset($_POST['buttonEdit'])){
	$reservationId = $_POST['reservationId'];
	$reservationIdFlag = true;
}
if(isset($_POST['reservation'])) {
		$reservationId = $_POST['reservationId'];
		$reservationNameNew = $_POST['reservationNameNew'];
		$reservationLastNameNew = $_POST['reservationLastNameNew'];
		$reservationEmailNew = $_POST['reservationEmailNew'];
		$reservationTimeNew = $_POST['reservationTimeNew'];
		//$reservationDate = $_POST['reservationDate'];
		if(file_exists('reservations.xml'))
		{
			$xml = new SimpleXMLElement('reservations.xml', 0, true);
			foreach ($xml->reservation as $reservation)
			{
				$reservationIdLoop = (int)$reservation->reservationId;
					if($reservationIdLoop == $reservationId)
					{
						$reservation->reservationName = $reservationNameNew;
						$reservation->reservationLastName = $reservationLastNameNew;
						$reservation->reservationEmail = $reservationEmailNew;
						$reservation->reservationTime = $reservationTimeNew;
					}
			}
			
		}
		
		
		$xml->asXML('reservations.xml');
			header('Location: AdminPage.php');
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
					Edit a reservation
			</div>
			<div class="titleMessage">
				You are an admin. Here You can edit the reservations
			</div>
			<div class="reservationDecoration">
				<img class="imageReservation" src="reservationsImage.png" alt="reservation">
			</div>
			<form class="formReservations" method="POST" name="formReservations" onsubmit="return validateReservation();">
				<div class="reservationName" id="errReservationName" >Please fill your reservation name</div>
				<?php
				if(isset($_POST['buttonEdit'])){
				$reservationName = $_POST['reservationName'];
				$reservationLastName = $_POST['reservationLastName'];
				$reservationEmail = $_POST['reservationEmail'];
				$reservationTime = $_POST['reservationTime'];
				$reservationId = $_POST['reservationId'];

				echo '<input class="reservationName" name="reservationNameNew" value="'.$reservationName.'" type="text" placeholder="Name">';
				
				echo '<div class="reservationName" id="errReservationLastName" >Please fill your reservation last name</div>
				<input class="reservationLastName" name="reservationLastNameNew" value="'.$reservationLastName.'" type="text" placeholder=" Last Name">
				<div class="reservationName" id="errReservationEmail" >Please fill your reservation email</div>
				<input class="reservationEmail" name="reservationEmailNew" type="email" value="'.$reservationEmail.'" placeholder="Email"> 
				<div class="reservationName" id="errReservationTime" >Please fill your reservation time</div>
				<input class="reservationTime" name="reservationTimeNew" type="text" value="'.$reservationTime.'" placeholder="Time">
				<input style="display: none" class="reservationTime" value="'.$reservationId.'" name="reservationId" type="text" placeholder="ID"> 
				<!--<input type="date" class="reservationDate" name="reservationDate" min="2016-11-07">-->';
			}	else
			{
				echo '<input class="reservationName" name="reservationNameNew" type="text" placeholder="Name">';
				
				echo '<div class="reservationName" id="errReservationLastName" >Please fill your reservation last name</div>
				<input class="reservationLastName" name="reservationLastNameNew" type="text" placeholder=" Last Name">
				<div class="reservationName" id="errReservationEmail" >Please fill your reservation email</div>
				<input class="reservationEmail" name="reservationEmailNew" type="email" placeholder="Email"> 
				<div class="reservationName" id="errReservationTime" >Please fill your reservation time</div>
				<input class="reservationTime" name="reservationTimeNew" type="text" placeholder="Time"> 
				<div class="reservationName" id="errReservationTime" >Please fill your reservation time</div>
				<input class="reservationTime" name="reservationId" type="text" placeholder="ID">';
			}
				?>
				<div class="buttonHolder">
					<input class="reservationSend" name="reservation" type="submit" value="Edit" onclick="return validateReservation()">
				</div>
			</form>
		</div>
	</div>
	<div class="footSocial">
		<img class="footImg" src="RestaurantLogoBottom.png" alt="logoBottom">
	</div>
</body>
</html>