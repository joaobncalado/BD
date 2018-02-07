<html>
<body>
	<?php
	session_start();
	$email = $_SESSION['email'];
	$nEnc = $_SESSION['nEnc'];
	$nomeA = $_REQUEST['nomeA'];
	try
	{
		$host = "db.ist.utl.pt";
		$user ="ist165909";
		$password = "password";
		$dbname = $user;
		$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
		$sql = "start transaction;";
		$db->query($sql);
		echo("<p>$sql</p>");
		$sql = "INSERT INTO RegistoEnc VALUES ('$email','$nEnc','$nomeA');";
		$db->query($sql);
		echo("<p>$sql</p>");
		$sql = "UPDATE Encomenda SET precoTotal=precoTotal+(select preco from Prato where nomeA='$nomeA') where email='$email' AND nEnc='$nEnc';";
		$db->query($sql);
		echo("<p>$sql</p>");
		$sql = "commit;";
		$db->query($sql);
		echo("<p>$sql</p>");

		$db = null;
	}
	catch (PDOException $e)
	{
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
	?>
	<p><a href="associaPraEnc1.php"><button type="button">Adicionar um novo prato</button></a></p>
	<p><a href="index.php"><button type="button">Voltar ao Inicio</button></a></p>
	
</body>
</html>