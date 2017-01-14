<?php
require('fpdf181/fpdf.php');
session_start();
if($_SESSION['username'] != 'admin') {
	header('Location: Registrations.php');
} 


if(isset($_POST['buttonEdit'])) {
		echo "Obdje sam";
		echo $_POST['reservationName'];
	}
if(isset($_POST['exportCSV'])) {
    
    $veza = new PDO("mysql:dbname=restoran;host=localhost;charset=utf8", "andrej", "admin");
    $veza->exec("set names utf8");
    $rezultat = $veza->query("select idRezervacije, idKorisnika, ime, prezime, email, vrijeme from rezervacija");
    if (!$rezultat) {
        $greska = $veza->errorInfo();
        print "SQL greška: " . $greska[2];
        exit();
    } 
    $f = fopen('podaci.csv', 'w');
    createCsv($rezultat, $f);
    fclose($f);
}
if(isset($_POST['exportPDF'])) {
   	$veza = new PDO("mysql:dbname=restoran;host=localhost;charset=utf8", "andrej", "admin");
     $veza->exec("set names utf8");
     $rezultat = $veza->query("select idRezervacije, idKorisnika, ime, prezime, email, vrijeme from rezervacija");
     if (!$rezultat) {
          $greska = $veza->errorInfo();
          print "SQL greška: " . $greska[2];
          exit();
     } 
    $pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,12,'Name',1);	
	$pdf->Cell(25,12,'Last name',1);	
	$pdf->Cell(60,12,'Email',1);	
	$pdf->Cell(30,12,'Time',1);	
	$pdf->Cell(20,12,'Id',1);	
	$pdf->Ln();
	$pdf->SetFont('Arial','',12);	
    foreach ($rezultat as $rezervacija) {
     				/*if($rezervacija['idRezervacije'] == $item->reservationId)
     				{
     					$reservationExists = true;
     				}*/
     	$reservationName = $rezervacija['ime'];
        $reservationLastName = $rezervacija['prezime'];
        $reservationEmail = $rezervacija['email'];
        $reservationTime = $rezervacija['vrijeme'];
        $reservationId = $rezervacija['idRezervacije'];

        $pdf->Cell(20,12,$reservationName,1);
        $pdf->Cell(25,12,$reservationLastName,1);
        $pdf->Cell(60,12,$reservationEmail,1);
        $pdf->Cell(30,12,$reservationTime,1);
        $pdf->Cell(20,12,$reservationId,1);
			
		$pdf->Ln();
    }
			$pdf->Output();

}

if(isset($_POST['exportUserSQL'])) {
    if (file_exists('users.xml')) 
           {
       		$xml = simplexml_load_file('users.xml');
			foreach ($xml as $item){
				$userExists = false;
				$veza = new PDO("mysql:dbname=restoran;host=localhost;charset=utf8", "andrej", "admin");
     			$veza->exec("set names utf8");
     			$rezultat = $veza->query("select id, username, password, admin from user");
     			if (!$rezultat) {
          			$greska = $veza->errorInfo();
          			print "SQL greška: " . $greska[2];
          			exit();
     			} 

     			foreach ($rezultat as $user) {
     				if($user['id'] == $item->id)
     				{
     					$userExists = true;
     				}
     			}
           		$id = $item->id;
           		$username = $item->username;
           		$password = $item->password;
           		$isAdmin = $item->isAdmin;

           		if(!$userExists)
           		{
           			$rezultat = $veza->query("INSERT INTO user SET id=$id, username='$username', password='$password', admin=$isAdmin");
           			
           		}
			}
   }

}

if(isset($_POST['exportReservationSQL'])) {
    if (file_exists('reservations.xml')) 
           {
       		$xml = simplexml_load_file('reservations.xml');
			foreach ($xml as $item){
				
				$reservationExists = false;
				$veza = new PDO("mysql:dbname=restoran;host=localhost;charset=utf8", "andrej", "admin");
     			$veza->exec("set names utf8");
     			$rezultat = $veza->query("select idRezervacije, idKorisnika, ime, prezime, email, vrijeme from rezervacija");
     			if (!$rezultat) {
          			$greska = $veza->errorInfo();
          			print "SQL greška: " . $greska[2];
          			//exit();
     			} 

     			foreach ($rezultat as $rezervacija) {
     				if($rezervacija['idRezervacije'] == $item->reservationId)
     				{
     					$reservationExists = true;
     				}
     			}
           		$reservationId = $item->reservationId;
           		$idKorisnika = $item->idKorisnik;
           		$ime = $item->reservationName;
           		$prezime = $item->reservationLastName;
           		$email = $item->reservationEmail;
           		$vrijeme = $item->reservationTime;

           		if(!$reservationExists)
           		{
           			$rezultat = $veza->query("INSERT INTO rezervacija SET idRezervacije=$reservationId, idKorisnika=$idKorisnika, ime='$ime', prezime='$prezime',email='$email',vrijeme='$vrijeme'");
           			
           		}
			}
   }

}

function createCsv($rezultat,$f)
    {
    	$put_arr = array('reservationName','reservationLastName','reservationEmail','reservationTime','reservationId'); 
    	fputcsv($f, $put_arr ,',','"');
        foreach ($rezultat as $rezervacija) 
        {
            $reservationName = $rezervacija['ime'];
        	$reservationLastName = $rezervacija['prezime'];
        	$reservationEmail = $rezervacija['email'];
        	$reservationTime = $rezervacija['vrijeme'];
        	$reservationId = $rezervacija['idRezervacije'];

            $put_arr = array($reservationName,$reservationLastName,$reservationEmail,$reservationTime,$reservationId); 
            fputcsv($f, $put_arr ,',','"');

     

}}

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
		<div style="width: 100%; padding-top: 1%; padding-left: 1%">
			<form method="POST" action="AdminSearch.php" style="display: inline" >
				<div style="margin-bottom: 1%;" class="titleMessage">
					Search
				</div>
				<input name="searchInput" style="width: 95%" type="text" size="30" onkeyup="showResult(this.value)">
 				<button style="display: none" name="buttonSearch" class="buttonSearch" type="submit"></button> 
			</form>
			<div style="width: 95%;" id="livesearch"></div>
		</div>
		<div class="tileRegistration">
			
			
				<div class="contactTitle">
					Reservations 
				</div>
				<div class="titleMessage">
					All reservations made
				</div>
				<table style="padding-left: 2%">
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
				$veza = new PDO("mysql:dbname=restoran;host=localhost;charset=utf8", "andrej", "admin");
     			$veza->exec("set names utf8");
     			$rezultat = $veza->query("select idRezervacije, idKorisnika, ime, prezime, email, vrijeme from rezervacija");
     			if (!$rezultat) {
          			$greska = $veza->errorInfo();
          			print "SQL greška: " . $greska[2];
          			exit();
     			} 
					foreach ($rezultat as $rezervacija) {
						echo '<tr>
								<td>'  .$rezervacija['ime'].'</td>
								<td>' .$rezervacija['prezime'].' </td>
								<td>' .$rezervacija['email'].' </td>
								<td>' .$rezervacija['vrijeme'].' </td>
								<td style="width:0%;"><form action="AdminEdit.php" method="post">
									<input style="width:0%; display: none;" type="text" name="reservationName" value="'.$rezervacija['ime'].'">
									<input style="width:0%; display: none;" type="text" name="reservationLastName" value="'.$rezervacija['prezime'].'">
									<input style="width:0%; display: none;" type="text" name="reservationEmail" value="'.$rezervacija['email'].'">
									<input style="width:0%; display: none;" type="text" name="reservationTime" value="'.$rezervacija['vrijeme'].'">
									<input style="width:0%; display: none;" type="text" name="reservationId" value="'.$rezervacija['idRezervacije'].'">
									<button class="adminEdit" type="submit" name="buttonEdit">Edit</button></td>
								</form>
							 </tr>';
					}
				?>
				</table>
				<form method="POST" style="padding-left: 1%">
					<input class="adminSend" type="submit" value="Export CSV" name="exportCSV">
				</form>
				<form method="POST" style="padding-left: 1%">
					<input class="adminSend" type="submit" value="Export PDF" name="exportPDF">
				</form>
				<form method="POST" style="padding-left: 1%">
					<input class="adminSend" type="submit" value="Export XML User file to SQL" name="exportUserSQL">
				</form>
				<form method="POST" style="padding-left: 1%">
					<input class="adminSend" type="submit" value="Export XML Reservations file to SQL" name="exportReservationSQL">
				</form>
		</div>
	</div>
	<div class="footSocial">
		<img class="footImg" src="RestaurantLogoBottom.png" alt="logoBottom">
	</div>
</body>
</html>