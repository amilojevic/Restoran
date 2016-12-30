var modal;
var img;
var modalImg;
var captionText;
var span;
var escKeyDown;

/*window.onload = function () {
    var elementExists = document.getElementById("mySlides");
    if(elementExists){
        slideIndex = 0;
        carousel();
    }
    var imageElementExists = document.getElementById("myImg");
    if(imageElementExists) {
        modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        img = document.getElementById('myImg');
        modalImg = document.getElementById("img01");
        captionText = document.getElementById("caption");
        span = document.getElementsByClassName("close")[0];
        escKeyDown = document.getElementById("img01").onkeydown = function() {escKeyDownPress()};
        escKeyDown.focus();
    }
}*/
function onLoadHome()
{
    slideIndex = 0;
    carousel();
}
function loadImage()
{
    modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        img = document.getElementById('myImg');
        modalImg = document.getElementById("img01");
        captionText = document.getElementById("caption");
        span = document.getElementsByClassName("close")[0];
}
document.onkeydown = function(key){
    if (key.which == 27)
        modal.style.display = "none";
}
function zoomImage(src, alt){
    modal.style.display = "block";
    modalImg.src = src;
    captionText.innerHTML = alt;
    modal.addEventListener("keydown", escKeyDown); 
}
function escKeyDownPress()
{
    modal.style.display = "none";
}
function closeImage()
{
    modal.style.display = "none";
}
function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
      	x[i].style.display = "none"; 
    }
    slideIndex++;
    if (slideIndex > x.length) {slideIndex = 1} 
    x[slideIndex-1].style.display = "block"; 
    setTimeout(carousel, 4000); 
}

function validateContact() {
    var x = document.forms["formContact"];
    if(x["contactName"].value == "")
    {
        document.getElementById("errName").style.display="block";
        return false;
    } else {
        document.getElementById("errName").style.display="none";
    }
    if(x["email"].value == "")
    {
        document.getElementById("errEmail").style.display="block";
        return false;
    } else {
        document.getElementById("errEmail").style.display="none";
    }
    if(x["subject"].value == "")
    {
        document.getElementById("errSubject").style.display="block";
        return false;
    } else {
        document.getElementById("errSubject").style.display="none";
    }
    if(x["text"].value == "")
    {
        document.getElementById("errText").style.display="block";
        return false;
    } else {
        document.getElementById("errText").style.display="none";
    }
    return true;
}

function validateLogin() {
    var x = document.forms["formLogin"];
    if(x["loginUser"].value == "")
    {
        document.getElementById("errLoginUser").style.display="block";
        return false;
    } else {
        document.getElementById("errLoginUser").style.display="none";
    }
    if(x["loginPass"].value == "")
    {
        document.getElementById("errLoginPass").style.display="block";
        return false;
    } else {
        document.getElementById("errLoginPass").style.display="none";
    }
    
    return true;
}

function validateRegistration(){
    var x = document.forms["formRegister"];
    var pattern = "<[^>]*script";
    if(x["registerName"].value == "")
    {
        document.getElementById("errRegisterName").style.display="block";
        return false;
    }
    else {
        document.getElementById("errRegisterName").style.display="none";
    }
    if(x["registerLastname"].value == "")
    {
        document.getElementById("errRegisterLastName").style.display="block";
        return false;
    } else {
        document.getElementById("errRegisterLastName").style.display="none";
    }
    if(x["registerUsername"].value == "")
    {
        document.getElementById("errRegisterUsername").style.display="block";
        return false;
    } else {
        document.getElementById("errRegisterUsername").style.display="none";
    }
    if(x["registerPassword"].value == "")
    {
        document.getElementById("errRegisterPassword").style.display="block";
        return false;
    } else {
        document.getElementById("errRegisterPassword").style.display="none";
    }
    if(x["registerPasswordAgain"].value == "")
    {
        document.getElementById("errRegisterPasswordAgain").style.display="block";
        return false;
    } else {
        document.getElementById("errRegisterPasswordAgain").style.display="none";
    }
    return true;
}

function validateReservation() {
    var x = document.forms["formReservations"];
    if(x["reservationName"].value == "")
    {
        document.getElementById("errReservationName").style.display="block";
        return false;
    } else {
        document.getElementById("errReservationName").style.display="none";
    }
    if(x["reservationLastName"].value == "")
    {
        document.getElementById("errReservationLastName").style.display="block";
        return false;
    } else {
        document.getElementById("errReservationLastName").style.display="none";
    }
    if(x["reservationEmail"].value == "")
    {
        document.getElementById("errReservationEmail").style.display="block";
        return false;
    } else {
        document.getElementById("errReservationEmail").style.display="none";
    }
    if(x["reservationTime"].value == "")
    {
        document.getElementById("errReservationTime").style.display="block";
        return false;
    } else {
        document.getElementById("errReservationTime").style.display="none";
    }
    return true;
}

function loadDoc(site) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("body").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", site, true);
  xhttp.send();
}

