<html>
<body>
	<form action="associaPra2.php" method="post">
		<h3>Escolha o Restaurante ao qual quer associar um Prato</h3>
		<p>Nome do Restaurante:
			<select name="nomeR">
				<?php
				session_start();
				try
				{
					$host = "db.ist.utl.pt";
					$user ="ist165909";
					$password = "password";
					$dbname = $user;
					$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
					$sql = "SELECT nomeR FROM Restaurante ORDER BY nomeR;";
					$result = $db->query($sql);
					foreach($result as $row){
						$nomeR = $row['nomeR'];
						
						echo("<option value=\"$nomeR\">$nomeR</option>\n");
					}
					$db = null;
				}
				catch (PDOException $e){
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
				?>
			</select>
		</p>
		<p><input type="submit" value="Submeter"/></p>
		<p><a href="index.php"><button type="button">Voltar ao incio</button></a></p>
	</form>
</body>
</html>