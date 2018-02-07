<html>
<body>
	<form action="criaEnc2.php" method="post">
		<h3>Crie uma Encomenda</h3>
		<p>Cliente:
			<select name="email">
				<?php
				try
				{
					$host = "db.ist.utl.pt";
					$user ="ist165909";
					$password = "password";
					$dbname = $user;
					$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
					$sql = "SELECT email FROM Cliente ORDER BY email;";
					$result = $db->query($sql);
					foreach($result as $row){
						$email = $row['email'];
						echo("<option value=\"$email\">$email</option>\n");
					}
					$db = null;
				}
				catch (PDOException $e){
					echo("<p>ERROR: {$e->getMessage()}</p>");
				}
				?>
			</select>
		</p>
		<p>Numero da Encomenda: <input type="text" name="nEnc"/></p>
		<p>Nome do Restaurante:
			<select name="nomeR">
				<?php
				try
				{
					$host = "db.ist.utl.pt";
					$user ="ist165909";
					$password = "jpbc5908";
					$dbname = $user;
					$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
					$sql = "SELECT DISTINCT nomeR FROM Restaurante ORDER BY nomeR;";
					$result = $db->query($sql);
					foreach($result as $row){
						$nomeR = $row['nomeR'];
						echo("<option value=\"$nomeR\">$nomeR</option>\n");
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
		<p><input type="submit" value="Criar Encomenda"/></p>
		<p><a href="index.php"><button type="button">Voltar ao incio</button></a></p>
	</form>
</body>
</html>