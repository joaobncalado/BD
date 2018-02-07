<html>
<body>
	<?php
	session_start();
	$email = $_REQUEST['email'];
	$_SESSION['email'] = $_REQUEST['email'];
	?>
	<form action="associaPraEnc3.php" method="post">
		<h3>Escolha o numero de encomenda</h3>
		<p>Numero da Encomenda:
			<select name="nEnc">
				<?php
				try
				{
					$host = "db.ist.utl.pt";
					$user ="ist165909";
					$password = "password";
					$dbname = $user;
					$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
					$sql = "SELECT DISTINCT nEnc FROM (SELECT email, nEnc FROM Encomenda WHERE email='$email') AS t ORDER BY nEnc;";
					$result = $db->query($sql);
					foreach($result as $row){
						$nEnc = $row['nEnc'];
						echo("<option value=\"$nEnc\">$nEnc</option>\n");
					}
					$db = null;
				}
				catch (PDOException $e){
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
				?>
			</select>
		</p>
		<p><input type="submit" value="Escolher Prato"/></p>
		<p><a href="index.php"><button type="button">Cancelar Encomenda</button></a></p>
	</form>
</body>
</html>