<html>
<body>
	<?php
	$account_number = $_REQUEST['account_number'];
	$branch_name = $_REQUEST['branch_name'];
	$balance = $_REQUEST['balance'];
	try
	{
		$host = "db.ist.utl.pt";
		$user ="ist165909";
		$password = "password";
		$dbname = $user;
		$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
		$sql = "INSERT INTO account VALUES ('$account_number', '$branch_name', $balance);";
		echo("<p>$sql</p>");
		$db->query($sql);
		$db = null;
	}
	catch (PDOException $e)
	{
		echo("<p>ERROR: {$e->getMessage()}</p>");
	}
	?>
</body>
</html>