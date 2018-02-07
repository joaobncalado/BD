<html>
<body>
	<form action="insert.php" method="post">
		<h3>Insert a new account</h3>
		<p>Account no.: <input type="text" name="account_number"/></p>
		<p>Branch:
			<select name="branch_name">
				<?php
				try
				{
					$host = "db.ist.utl.pt";
					$user ="ist165909";
					$password = "password";
					$dbname = $user;
					$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
					$sql = "SELECT branch_name FROM branch ORDER BY branch_name;";
					$result = $db->query($sql);
					foreach($result as $row)
						{
							$branch_name = $row['branch_name'];
							echo("<option value=\"$branch_name\">$branch_name</option>\n");
						}
						$db = null;
					}
					catch (PDOException $e)
					{
						echo("<p>ERROR: {$e->getMessage()}</p>");
					}
					?>
				</select>
			</p>
			<p>Balance: <input type="text" name="balance"/></p>
			<p><input type="submit" value="Submit"/></p>
		</form>
	</body>
	</html>