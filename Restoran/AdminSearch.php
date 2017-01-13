<?php
session_start();
if($_SESSION['username'] != 'admin') {
	header('Location: Registrations.php');
}
$xmlHtml = new SimpleXMLElement('<reservations></reservations>');
if(isset($_POST['buttonSearch'])) {
		$query = $_POST['searchInput'];
		$hint="";
		$xml = new DOMDocument();
		$xml->load("reservations.xml");
		$xmlTag=$xml->getElementsByTagName('reservation');

		if (strlen($query)>2) {
  
  			for($i=0; $i<($xmlTag->length); $i++) {
    			$name=$xmlTag->item($i)->getElementsByTagName('reservationName');
    			$lastName=$xmlTag->item($i)->getElementsByTagName('reservationLastName');
    			$email=$xmlTag->item($i)->getElementsByTagName('reservationEmail');
    			$time=$xmlTag->item($i)->getElementsByTagName('reservationTime');
    			$id=$xmlTag->item($i)->getElementsByTagName('reservationId');
    			if ($name->item(0)->nodeType==1) {
      				if ((stristr($name->item(0)->childNodes->item(0)->nodeValue,$query)) || (stristr($lastName->item(0)->childNodes->item(0)->nodeValue,$query))) {
        				$reservation = $xmlHtml->addChild('reservation');
						$reservation->addChild('reservationName', $name->item(0)->childNodes->item(0)->nodeValue);
						$reservation->addChild('reservationLastName', $lastName->item(0)->childNodes->item(0)->nodeValue);
						$reservation->addChild('reservationEmail', $email->item(0)->childNodes->item(0)->nodeValue);
						$reservation->addChild('reservationTime', $time->item(0)->childNodes->item(0)->nodeValue);
						$reservation->addChild('reservationId', $id->item(0)->childNodes->item(0)->nodeValue);
      				}
    			}
  			}
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
	<script>
function showResult(str) {
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    
    xmlhttp=new XMLHttpRequest();
  } else {  
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?query="+str,true);
  xmlhttp.send();
}
</script>
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
				<a href="ContactUs.php">Contact Us </a>
			</li>
			<li>
				<a href="Registrations.php">Registration </a>
			</li>
		</ul>
	</nav>	
	
	<div class="bodyImage"> 
		<div style="width: 100%; padding-top: 1%; padding-left: 1%" >
			<div style="width: 70%;" id="livesearch"></div>
		</div>
		<div class="tileRegistration">
			
			
				<div class="contactTitle">
					Search results
				</div>
				<div class="titleMessage">
					These are all search results
				</div>
				<table>
				<tr>
					<th>
						Name
					</th>
					<th>
						Last Name
					</th>
					<th>
						Email
					</th>
					<th>
						Time
					</th>
				</tr>
				<?php
					foreach ($xmlHtml->reservation as $reservation) {
						echo '<tr>
								<td>'  .$reservation->reservationName. '</td>
								<td>' .$reservation->reservationLastName.' </td>
								<td>' .$reservation->reservationEmail.' </td>
								<td>' .$reservation->reservationTime.' </td>
								</form>
							 </tr>';
					}
				?>
				</table>
		</div>
	</div>
	<div class="footSocial">
		<img class="footImg" src="RestaurantLogoBottom.png" alt="logoBottom">
	</div>
</body>
</html>