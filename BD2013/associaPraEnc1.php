<html>
<body>
	<form action="associaPraEnc2.php" method="post">
		<h3>Escolha o Cliente e o numero da Encomenda</h3>
		<p>Cliente:
			<select name="email">
				<?php
				session_start();
				try
				{
					$host = "db.ist.utl.pt";
					$user ="ist165909";
					$password = "password";
					$dbname = $user;
					$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
					$sql = "SELECT email FROM Cliente ORDER BY email;";
					$result = $db->query($sql);
					foreach($result as $row){
						$email = $row['email'];
						echo("<option value=\"$email\">$email</option>\n");
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
		<p><a href="index.php"><button type="button">Cancelar Encomenda</button></a></p>
	</form>
</body>
</html>