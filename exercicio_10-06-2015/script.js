// Getting some DOM elements
var likeButton = document.getElementById("like");
var postButton = document.getElementById("postButton");

// Setting the events
likeButton.onclick = increaseLikes;
postButton.onclick = postComment;

// Functions
function increaseLikes() {
	var counter = parseInt(document.getElementById("counter").innerHTML);

	document.getElementById("counter").innerHTML = counter + 1;
}

function postComment() {
	var comment = String(document.getElementById("textarea").value);
	
	document.getElementById("comments").innerHTML += comment + "<br />";

	document.getElementById("textarea").value = "";
}