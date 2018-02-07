<html>
<body>
	<?php
	session_start();
	$email = $_SESSION['email'];
	$nEnc = $_REQUEST['nEnc'];
	$_SESSION['nEnc'] = $_REQUEST['nEnc'];
	?>
	<form action="associaPraEnc4.php" method="post">
		<h3>Escolha o Prato de encomenda</h3>
		<p>Prato a encomendar:
			<select name="nomeA">
				<?php
				try
				{
					$host = "db.ist.utl.pt";
					$user ="ist165909";
					$password = "password";
					$dbname = $user;
					$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
					$sql = "SELECT DISTINCT nomeA FROM (SELECT DISTINCT nomeA, email, nEnc FROM (SELECT DISTINCT d.nomeA, d.dia, d.mes, d.ano, d.nomeR, e.nEnc, e.email FROM Disponivel d, Encomenda e WHERE d.dia=e.dia AND d.mes=e.mes AND d.ano=e.ano AND d.nomeR=e.nomeR group by nomeA) AS t WHERE email='$email' AND nEnc='$nEnc') AS t;";

					$result = $db->query($sql);
					foreach($result as $row){
						$nomeA = $row['nomeA'];
						echo("<option value=\"$nomeA\">$nomeA</option>\n");
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