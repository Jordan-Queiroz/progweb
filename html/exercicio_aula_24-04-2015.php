<!DOCTYPE HTML>
<html>

	<head>
		<title>Exercício da Aula 24-04-2015</title>
		<meta charset="UTF-8" />
	</head>

	<body>

		<h1>Este é um grande cabeçalho</h1>

		<h2>E este aqui é um pequeno cabeçalho</h2>

		<p>Aqui eu coloquei um parágrafo com algum texto aleatório, e a seguir vou inserir um formulário dentro de uma tabela. Além disso, aqui vai um link: <a href="http://icomp.ufam.edu.br/index.php/institucional/sobre-icomp/corpo-docente/78-kaitie-leslie" target="_blank">IComp</a></p>

		<form method="POST" action="processa.php">
			<table>
				
				<tr>
					<td>Seu nome: </td>
					<td> <input type="text" name="nome" id="id" size="20" maxlength="20" /> </td>
				</tr>

				<tr>
					<td>Seu sexo</td>
					<td> 
						<select name="sexo" id="sexo">
							<option value="1" selected>Masculino</option>
							<option value="2">Feminino</option>
						</select> 
					</td>
				</tr>

				<tr>
					<td>Seus comentários</td>
					<td> <textarea name="textarea" id="textarea" cols="50" rows="10" ></textarea> </td>
				</tr>

				<tr>
					<td></td>
					<td> <input type="submit" name="submit" id="submit" value="enviar"> </td>
				</tr>

			</table>
		</form>
		
	</body>

</html>