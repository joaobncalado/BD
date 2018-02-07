<html>
<body>
	<?php
	$email = $_REQUEST['email'];
	$nEnc = $_REQUEST['nEnc'];
	$nomeR = $_REQUEST['nomeR'];
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
		$sql = "INSERT INTO Encomenda VALUES ('$email','$nEnc',0,0,'$nomeR','$dia','$mes','$ano');";
		$db->query($sql);
		echo("<p>$sql</p>");
		$db = null;
	}
	catch (PDOException $e)
	{
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
	?>
	<h3>Encomenda criada com sucesso</h3>
	<p><a href="index.php"><button type="button">Voltar ao inicio</button></a></p>
	
</body>
</html>