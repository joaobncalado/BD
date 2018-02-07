<html>
<body>
	<form action="delete.php" method="post">
		<h3>Delete an existing account</h3>
		<table border="0">
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
				foreach($result as $row)
					{
						$account_number = $row['account_number'];
						$branch_name = $row['branch_name'];
						$balance = $row['balance'];
						echo("<tr>\n");
						echo("<td><input type=\"radio\" name=\"account_number\" value=\"$account_number\"/></td>\n");
						echo("<td>$account_number</td>\n");
						echo("<td>$branch_name</td>\n");
						echo("<td>$balance</td>\n");
						echo("</tr>\n");
					}
					$db = null;
				}
				catch (PDOException $e)
				{
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
				?>
			</table>
			<p><input type="submit" value="Delete"/></p>
		</form>
	</body>
	</html>