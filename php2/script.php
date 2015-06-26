<?php
	$conexao = @mysql_connect("localhost", "root");

	if (!$conexao) {
		die("<p>O servidor do banco está indisponível</p>");
	} else {
		$banco = @mysql_select_db("ProgWebDados",$conexao);

		if (!$banco) {
			die("<p>Banco de dados não disponível</p>");
		} else {
			echo "<p>O Banco de dados foi aberto com sucesso</p>";
			
			$nome = $_POST["nome"];
			$sexo = $_POST["sexo"];
			$comentario = $_POST["textarea"];

			$sql = "INSERT INTO feedback VALUES ('$nome','$sexo','$comentario')";
			mysql_query($sql,$conexao);
		}

	}

	mysql_close($conexao);
	
?>