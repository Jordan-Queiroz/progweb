var message = document.getElementById("message");
message.onmouseover = changeColorToRed;
message.onmouseout = changeColorToBlack;

function changeColorToRed(e) {
	e.target.style.color="red";
}

function changeColorToBlack(e) {
	e.target.style.color="black";
} 

