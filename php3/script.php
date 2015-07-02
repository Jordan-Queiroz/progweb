<?php
	session_start();
	if($_POST["user"] == "demo" && $_POST["password"] == "demo") {
		//$_SESSION["start"] = date("H:i");

		$redirect = "feedback.html";
		header("location:$redirect");
		// Redirecionar.
	} else {
		print "Dados de login errados <br />";
		session_destroy();
	}
?>