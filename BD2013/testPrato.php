<html>
<body>
	<p><a href="index.php"><button type="button">Voltar ao inicio</button></a></p>
	<?php
	try
	{
		$host = "db.ist.utl.pt";
		$user ="ist165909";
		$password = "password";
		$dbname = $user;
		$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
		$sql = "SELECT * FROM Prato;";
		$result = $db->query($sql);
		echo("<table border=\"1\">\n");
		echo("<tr><td>nomeA</td><td>preco</td></tr>\n");
		foreach($result as $row)
			{
				echo("<tr><td>");
				echo($row['nomeA']);
				echo("</td><td>");
				echo($row['preco']);
				echo("</td></tr>\n");
			}
			echo("</table>\n");
			$db = null;
		}
		catch (PDOException $e)
		{
			echo("<p>ERROR: {$e->getMessage()}</p>");
		}
		?>
	</body>
	</html>