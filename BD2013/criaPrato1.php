<html>
<body>
	<form action="criaPrato2.php" method="post">
		<h3>Crie um novo Prato</h3>
		<p>Nome do Prato:
			<select name="nomeA">
				<?php
				try
				{
					$host = "db.ist.utl.pt";
					$user ="ist165909";
					$password = "password";
					$dbname = $user;
					$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
					$sql = "SELECT nomeA FROM Alimento WHERE nomeA NOT IN (SELECT nomeA FROM Prato) ORDER BY nomeA;";
					$result = $db->query($sql);
					foreach($result as $row){
						$nomeA = $row['nomeA'];
						echo("<option value=\"$nomeA\">$nomeA</option>\n");
					}
					$db = null;
				}
				catch (PDOException $e){
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
				?>
			</select>
		</p>
		<p>Preco: <input type="text" name="preco"/></p>
		<p><input type="submit" value="Submeter"/></p>
		<p><a href="index.php"><button type="button">Voltar ao incio</button></a></p>
	</form>
</body>
</html>