<html>
<body>
	<?php
	session_start();
	$nomeA = $_REQUEST['nomeA'];
	$nomeR = $_SESSION['nomeR'];
	$dia = $_REQUEST['dia'];
	$mes = $_REQUEST['mes'];
	$ano = $_REQUEST['ano'];
	try
	{
		$host = "db.ist.utl.pt";
		$user ="ist165909";
		$password = "password";
		$dbname = $user;
		$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
		$sql = "INSERT INTO Disponivel VALUES ('$nomeA','$nomeR','$dia','$mes','$ano');";
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