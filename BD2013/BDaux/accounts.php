<html>
<body>
	<h3>Accounts</h3>
	<?php
	try
	{
		$host = "db.ist.utl.pt";
		$user ="ist165909";
		$password = "password";
		$dbname = $user;
		$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
		$sql = "SELECT * FROM account;";
		$result = $db->query($sql);
		echo("<table border=\"0\" cellspacing=\"5\">\n");
		foreach($result as $row)
		{
			echo("<tr>\n");
			echo("<td>{$row['account_number']}</td>\n");
			echo("<td>{$row['branch_name']}</td>\n");
			echo("<td>{$row['balance']}</td>\n");
			echo("<td><a href=\"balance.php?account_number={$row['account_number']}\">Change balance</a></td>\n");
			echo("</tr>\n");
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