<html>
<body>
	<?php
		session_start();
		$_SESSION['nomeR'] = $_REQUEST['nomeR'];
	?>
	<form action="associaPra3.php" method="post">
		<h3>Escolha o Prato a associar ao Restaurante <?=$_REQUEST['nomeR']?></h3>
		<p>Prato:

			<select name="nomeA">
				<?php
				$nomeTemp = $_REQUEST['nomeR'];
				try
				{
					$host = "db.ist.utl.pt";
					$user ="ist165909";
					$password = "password";
					$dbname = $user;
					$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
					$sql = "SELECT nomeA FROM Prato WHERE nomeA NOT IN (SELECT nomeA FROM (SELECT nomeA, nomeR FROM Disponivel WHERE nomeR='$nomeTemp') AS t);";
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
		<p>Data de disponibilidade:
			<select name="dia">
				<?php
				$nomeR = $_REQUEST['nomeR'];
				try
				{
					$host = "db.ist.utl.pt";
					$user ="ist165909";
					$password = "jpbc5908";
					$dbname = $user;
					$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
					$sql = "SELECT DISTINCT dia FROM Data ORDER BY dia;";
					$result = $db->query($sql);
					foreach($result as $row){
						$dia = $row['dia'];
						echo("<option value=\"$dia\">$dia</option>\n");
					}
					$db = null;
				}
				catch (PDOException $e){
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
				?>
			</select>
			<select name="mes">
				<?php
				$nomeR = $_REQUEST['nomeR'];
				try
				{
					$host = "db.ist.utl.pt";
					$user ="ist165909";
					$password = "jpbc5908";
					$dbname = $user;
					$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
					$sql = "SELECT DISTINCT mes FROM Data ORDER BY mes;";
					$result = $db->query($sql);
					foreach($result as $row){
						$mes = $row['mes'];
						echo("<option value=\"$mes\">$mes</option>\n");
					}
					$db = null;
				}
				catch (PDOException $e){
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
				?>
			</select>
			<select name="ano">
				<?php
				$nomeR = $_REQUEST['nomeR'];
				try
				{
					$host = "db.ist.utl.pt";
					$user ="ist165909";
					$password = "jpbc5908";
					$dbname = $user;
					$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
					$sql = "SELECT DISTINCT ano FROM Data ORDER BY ano;";
					$result = $db->query($sql);
					foreach($result as $row){
						$ano = $row['ano'];
						echo("<option value=\"$ano\">$ano</option>\n");
					}
					$db = null;
				}
				catch (PDOException $e){
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
				?>
			</select>
		</p>
		<p><input type="submit" value="Submeter"/></p>
		<p><a href="index.php"><button type="button">Voltar ao incio</button></a></p>
	</form>
</body>
</html>