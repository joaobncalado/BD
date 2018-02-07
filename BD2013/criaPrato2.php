<html>
<body>
	<?php
	$nomeA = $_REQUEST['nomeA'];
	$preco = $_REQUEST['preco'];
	try
	{
		$host = "db.ist.utl.pt";
		$user ="ist165909";
		$password = "password";
		$dbname = $user;
		$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
		$sql = "INSERT INTO Prato VALUES ('$nomeA','$preco');";
		$db->query($sql);
		echo("<p>$sql</p>");
		$db = null;
	}
	catch (PDOException $e)
	{
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
	?>
	<h3>Prato criado com sucesso</h3>
	<p><a href="index.php"><button type="button">Voltar ao inicio</button></a></p>
	
</body>
</html>