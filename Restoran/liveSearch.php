<?php
$xml = new DOMDocument();
$xml->load("reservations.xml");

$xmlTag=$xml->getElementsByTagName('reservation');

$query=$_GET["query"];
$hint="";
$count = 0;
if (strlen($query)>2) {
  
  for($i=0; $i<($xmlTag->length); $i++) {
    $name=$xmlTag->item($i)->getElementsByTagName('reservationName');
    $lastName=$xmlTag->item($i)->getElementsByTagName('reservationLastName');
    if($count < 10){
      if ($name->item(0)->nodeType==1) {
        //find a link matching the search text
        if ((stristr($name->item(0)->childNodes->item(0)->nodeValue,$query)) || (stristr($lastName->item(0)->childNodes->item(0)->nodeValue,$query))) {
          if ($hint=="") {
            $hint="<a href=#>" . 
            $name->item(0)->childNodes->item(0)->nodeValue . " " .$lastName->item(0)->childNodes->item(0)->nodeValue . "</a>";
            $count++;
          } else {
            $hint=$hint . "<br /><a href=#>" . 
            $name->item(0)->childNodes->item(0)->nodeValue ." " .$lastName->item(0)->childNodes->item(0)->nodeValue . "</a>";
            $count++;
          }
        }
      }
    }
  }
}

if (strlen($query)<3) {
  $response="Write a longer word";
} elseif($hint=="") {
  $response="No match found";
}
else {
  $response=$hint;
}

echo $response;
?>