// Creating Game Table.
var gameTable = document.getElementById("gameTable");

// Getting and setting the refresh button.
var refreshButton = document.getElementById("refreshButton");
refreshButton.onclick = reloadPage;

// Setting the first player.
var player = "1";

// Setting the gameTable's dimension.
var gameTableDimentions = 19;

highlightPlayer();

// Creates a tuple.
for (x = 0; x < gameTableDimentions; x++) {
	var row = gameTable.appendChild(document.createElement("tr"));

	// Creates an element inside the tuple.
	for (y = 0; y < gameTableDimentions; y++) {
		var col = document.createElement("td");
		col.setAttribute("id", "el:" + x + "_" + y);

		// Verifies the coordinates' numbers in order to insert a dot.
		if ((x%2 == 0 && y%2 == 0)) {
			var img = document.createElement("img");
			img.setAttribute("id", x + "_" + y);
			
			img.setAttribute("src", "squares/d.gif");
			img.setAttribute("alt", "point");
			
			col.appendChild(img);
		}

		// Verifies the coordinates' numbers in order to insert a horizontal bar.
		if (x%2 == 0 && y%2 == 1) {
			var img = document.createElement("img");
			img.setAttribute("id", x + "_" + y);
			img.setAttribute("data-status", "hunmarked");

			img.setAttribute("src", "squares/hb.png");
			img.setAttribute("alt", "hbar");

			img.onmouseover = showHBar;
			img.onmouseout = hideHBar;
			
			img.onclick = changeColorHBar;

			col.appendChild(img);	
		}

		// Verifies the coordinates' numbers in order to insert a vertical bar.
		if (x%2 == 1 && y%2 == 0) {
			var img = document.createElement("img");
			img.setAttribute("id", x + "_" + y);
			img.setAttribute("data-status", "vunmarked");

			img.setAttribute("src", "squares/vb.png");
			img.setAttribute("alt", "vbar");

			img.onmouseover = showVBar;
			img.onmouseout = hideVBar;

			img.onclick = changeColorVBar;

			col.appendChild(img);	
		}

		// Verifies the coordinates' numbers in order to insert the null color inside a square.
		if (x%2 == 1 && y%2 == 1) {
			var img = document.createElement("img");
			img.setAttribute("id", x + "_" + y);
			img.setAttribute("data-changed", "no");

			img.setAttribute("src", "squares/p0.gif");
			img.setAttribute("alt", "img");

			col.appendChild(img);	
		}

		row.appendChild(col);
		
	}

}

function changeColorHBar(e) {
	/* "hchecked" means that the program have changed the color
	and verified if the square is closed on this horizontal element. */
	if ((e.target.getAttribute("data-status")) != "hchecked") {
		e.target.setAttribute("src", "squares/h1.gif");
		e.target.setAttribute("data-status", "hmarked");
		var id = e.target.getAttribute("id");
	
		verifyIfSquareIsClosed(id, e);
		alternatePlayers();
		highlightPlayer();

	}
}

function changeColorVBar(e) {
	/* "vchecked" means that the program have changed the color
	and verified if the square is closed on this vertical element. */
	if ((e.target.getAttribute("data-status") != "vchecked")) {
		e.target.setAttribute("src", "squares/v1.gif");
		e.target.setAttribute("data-status", "vmarked");
		var id = e.target.getAttribute("id");

		verifyIfSquareIsClosed(id, e);
		alternatePlayers();
		highlightPlayer();
	}
}

function verifyIfSquareIsClosed(id, e) {
	var coordinates = splitCoordinatesId(id);

	var xCoordinate = parseInt(coordinates[0]);
	var yCoordinate = parseInt(coordinates[1]);

	console.log("Element coordinates: " + xCoordinate + " " + typeof(xCoordinate) + " " + yCoordinate + " " + typeof(yCoordinate)); 
	console.log("status: " + e.target.getAttribute("data-status"));	

	// Check horizontally.
	if ((e.target.getAttribute("data-status")) == "hmarked") {
		e.target.setAttribute("data-status", "hchecked");
		// Verify if it is possible to check the bottom.
		if ((xCoordinate + 1 ) < gameTableDimentions) {
			// Verifying if the element x+2,y is marked. Bottom.
			if (document.getElementById((xCoordinate + 2) + "_" + yCoordinate).getAttribute("src") == "squares/h1.gif") {
				// Verifying if the element x+1,y-1 is marked. Bottom-Left.
				if (document.getElementById((xCoordinate + 1) + "_" + (yCoordinate - 1)).getAttribute("src") == "squares/v1.gif") {
					// Verifying if the element x=2,y+1 is marked. Bottom-Right.
					if (document.getElementById((xCoordinate + 1) + "_" + (yCoordinate + 1)).getAttribute("src") == "squares/v1.gif") {
						var p = whatPlayerIsNow();

						// Sets the player's color in the square and add one point in this player's score.
						if (p == "1") {
							document.getElementById((xCoordinate + 1) + "_" + yCoordinate).setAttribute("src", "squares/p1.gif");
							addPoint("1");
						} else {
							document.getElementById((xCoordinate + 1) + "_" + yCoordinate).setAttribute("src", "squares/p2.gif");
							addPoint("2");
						}
					}
				}
			} 
		}
		// Verifying if it is possible to check the top.
		if ((xCoordinate - 1 ) > 0) {
			// Verifying if the element x-2,y is marked. Top
			if (document.getElementById((xCoordinate - 2) + "_" + yCoordinate).getAttribute("src") == "squares/h1.gif") {
				// Verifying if the element x-1,y-1 is marked. Top-Left.
				if (document.getElementById((xCoordinate - 1) + "_" + (yCoordinate - 1)).getAttribute("src") == "squares/v1.gif") {
					// Verifying if the element x-1,y+1 is marked. Top-Right.
					if (document.getElementById((xCoordinate - 1) + "_" + (yCoordinate + 1)).getAttribute("src") == "squares/v1.gif") {
						var p = whatPlayerIsNow();
						
						// Sets the player's color in the square and add one point in this player's score.
						if (p == "1") {
							document.getElementById((xCoordinate - 1) + "_" + yCoordinate).setAttribute("src", "squares/p1.gif");
							addPoint("1");
						} else {
							document.getElementById((xCoordinate - 1) + "_" + yCoordinate).setAttribute("src", "squares/p2.gif");	
							addPoint("2");
						}
					}
				}
			}
		}
	}

	// Check vertically.
	else if ((e.target.getAttribute("data-status")) == "vmarked") {
		e.target.setAttribute("data-status", "vchecked");
		// Verify if it is possible to check the right.
		if ((yCoordinate + 1 ) < gameTableDimentions) {
			// Verifying if the element x,y+2 is marked. Right.
			if (document.getElementById((xCoordinate) + "_" + (yCoordinate + 2)).getAttribute("src") == "squares/v1.gif") {
				// Verifying if the element x-1,y+1 is marked. Right-Top.
				if (document.getElementById((xCoordinate - 1) + "_" + (yCoordinate + 1)).getAttribute("src") == "squares/h1.gif") {
					// Verifying if the element x-1,y+1 is marked. Right-Bottom.
					if (document.getElementById((xCoordinate + 1) + "_" + (yCoordinate + 1)).getAttribute("src") == "squares/h1.gif") {
						var p = whatPlayerIsNow();
						
						// Sets the player's color in the square and add one point in this player's score.
						if (p == "1") {
							document.getElementById((xCoordinate) + "_" + (yCoordinate + 1)).setAttribute("src", "squares/p1.gif");
							addPoint("1");
						} else {
							document.getElementById((xCoordinate) + "_" + (yCoordinate + 1)).setAttribute("src", "squares/p2.gif");
							addPoint("2");
						}
					}
				}
			} 
		}
		// Verify if it is possible to check the left.
		if ((yCoordinate - 1 ) > 0) {
			// Verifying if the element x,y-2 is marked. Left.
			if (document.getElementById((xCoordinate) + "_" + (yCoordinate - 2)).getAttribute("src") == "squares/v1.gif") {
				// Verifying if the element x-1,y-1 is marked. Left-Top.
				if (document.getElementById((xCoordinate - 1) + "_" + (yCoordinate - 1)).getAttribute("src") == "squares/h1.gif") {
					// Verifying if the element x+1,y-1 is marked. Left-Bottom.
					if (document.getElementById((xCoordinate + 1) + "_" + (yCoordinate - 1)).getAttribute("src") == "squares/h1.gif") {
						var p = whatPlayerIsNow();
						
						// Sets the player's color in the square and add one point in this player's score.
						if (p == "1") {
							document.getElementById((xCoordinate) + "_" + (yCoordinate - 1)).setAttribute("src", "squares/p1.gif");
							addPoint("1");
						} else {
							document.getElementById((xCoordinate) + "_" + (yCoordinate - 1)).setAttribute("src", "squares/p2.gif");	
							addPoint("2");
						}
					}
				}
			}
		}
	} 
}

function whatPlayerIsNow() {
	if (player == "1") {
		return "1";
	} else {
		return "2";
	}
}

function highlightPlayer() {
	var p = whatPlayerIsNow();

	if (player == "1") {

		document.getElementById("pl2").style.fontStyle = "normal";
		document.getElementById("pl2").style.textDecoration = "none";

		document.getElementById("pl1").style.fontStyle = "italic";
		document.getElementById("pl1").style.textDecoration = "underline";
	}
	if (player == "2") {

		document.getElementById("pl1").style.fontStyle = "normal";
		document.getElementById("pl1").style.textDecoration = "none";

		document.getElementById("pl2").style.fontStyle = "italic";
		document.getElementById("pl2").style.textDecoration = "underline";
	}
}

function alternatePlayers() {
	if (player == "1") {
		player = "2";
	} else {
		player = "1";
	}
}

function addPoint(player) {
	if (player == "1") {
		var currentPoints = parseInt(document.getElementById("pointsP1").innerHTML);
		document.getElementById("pointsP1").innerHTML = currentPoints + 1;
	} else {
		var currentPoints = parseInt(document.getElementById("pointsP2").innerHTML);
		document.getElementById("pointsP2").innerHTML = currentPoints + 1;
	}
}

function reloadPage() {
	location.reload();
}

function splitCoordinatesId(id) {
	var partsId = id.split("_");

	return partsId;
}

function showHBar(e) {
	if (e.target.getAttribute("data-status") != "hchecked") {
		e.target.setAttribute("src", "squares/h0.gif");
	}
}

function hideHBar(e) {
	if (e.target.getAttribute("data-status") != "hchecked") {
		e.target.setAttribute("src", "squares/hb.png");
	}
}

function showVBar(e) {
	if (e.target.getAttribute("data-status") != "vchecked") {
		e.target.setAttribute("src", "squares/v0.gif");
	}
}

function hideVBar(e) {
	if (e.target.getAttribute("data-status") != "vchecked") {
		e.target.setAttribute("src", "squares/vb.png");
	}
}