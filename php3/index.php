<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<meta charset="UTF-8" />
	</head>

	<body>
		<?php
			//session_destroy();
			session_start();

			if(!isset($_SESSION["start"])) {
				$_SESSION["start"] = date("H:i");
			} else {
				$redirect = "feedback.html";
				header("location:$redirect");
			}

		?>

		<h1>Login</h1>
		<form id="login" name="login" method="POST" action="script.php">
			<table>
				<tr>
					<td><span>Usuário: </span></td>
					<td><input type="text" id="user" name="user" /></td>
				</tr>
				<tr>
					<td><span>Senha: </span></td>
					<td><input type="text" id="password" name="password" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" id="submit" id="submit"></td>
				</tr>
			<table>
		<script src="script.js"></script>
	</body>
</html>