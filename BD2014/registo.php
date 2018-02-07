<html>
<body>
<?php
	// inicia sess√£o para passar variaveis entre ficheiros php
	session_start();
	// Fun√ß√£o para limpar os dados de entrada
	function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
	}

	$username = $_SESSION['username'];
	$nif = $_SESSION['nif'];
	$pin = $_SESSION['pin'];

	// Carregamento das vari√°veis username e pin do form HTML atrav√©s do metodo POST;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$username = test_input($_POST["username"]);
			$pin = test_input($_POST["pin"]);
			}

	echo("<p>Valida Pin da Pessoa $username</p>\n");

	// Vari√°veis de conex√£o √† BD
		$host="db.ist.utl.pt"; 		// o MySQL esta disponivel nesta maquina
		$user="ist165909";		// -> substituir pelo nome de utilizador
	$password="password";		// -> substituir pela password dada pelo mysql_reset
		$dbname = $user; 		// a BD tem nome identico ao utilizador

		echo("<p><h1>Projeto Base de Dados Parte II</h1></p>\n");

		$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password,
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

		echo("<p>Connected to MySQL database $dbname on $host as user $user</p>\n");

		//echo("<p>Username: $username");
		//echo("<p>Nif: $nif");
		//echo("<p>Pin: $pin");

	// obtem o pin da tabela pessoa
	$sql = "SELECT * FROM pessoa WHERE nif=" . $username;

	$result = $connection->query($sql);

	if (!$result) {
		echo("<p> Erro na Query:($sql)<p>");
	exit();
	}

	foreach($result as $row){
		$safepin = $row["pin"];
		$nif = $row["nif"];
	}

	if ($safepin != $pin ) {
		echo "<p>Pin Invalido! Exit!</p>\n";
		$connection = null;
	exit;
	}

	echo "<p>Pin Valido! </p>\n";

	echo "<h2>Leilıes V·lidos para Registo</h2>";

	// Apresenta os leil√µes
	$sql = "SELECT * FROM leilao NATURAL JOIN leilaor AS lei WHERE lei.lid <> ALL(SELECT leilao FROM concorrente WHERE (concorrente.pessoa=$username)) GROUP BY lid";
	$result = $connection->query($sql);

	echo("<table border=\"1\">\n");

	echo("<tr><td>LID</td><td>nif</td><td>dia</td><td>NrDoDia</td><td>nome</td><td>tipo</td><td>valorbase</td></tr>\n");

	$idleilao = 0;
	foreach($result as $row){
		$date = $row["dia"];
		$date = strtotime("+" .$row["nrdias"]." days", strtotime($date));
		$date = date('Y-m-d' , $date);
		if( $date >= date("Y-m-d")) {
		$idleilao = $idleilao +1;
		echo("<tr><td>");
		//echo($idleilao); echo("</td><td>");
		echo($row["lid"]); echo("</td><td>");
		echo($row["nif"]); echo("</td><td>");
		echo($row["dia"]); echo("</td><td>");
		echo($row["nrleilaonodia"]); echo("</td><td>");
		echo($row["nome"]); echo("</td><td>");
		echo($row["tipo"]); echo("</td><td>");
		echo($row["valorbase"]); echo("</td>");
		$leilao[$idleilao]= array($row["nif"],$row["dia"],$row["nrleilaonodia"]);}
	}

	echo("</table>\n");

	// passa variaveis para a sessao;
	$_SESSION['username'] = $username;
	$_SESSION['nif'] = $nif;
	$_SESSION['pin'] = $pin;
	?>

<form action="leilao.php" method="post">
<h2>Escolha o LID do leil„o que pretende concorrer</h2>
	<p>LID : <input type="text" name="lid" /></p>
	<p><input type="submit" /></p>
</form>

<form action="lances.php" method="post">
<h2>Leilıes onde est· inscrito</h2>
	<p><input type="submit" value="Novo Lance"/></p>
</form>
<form action="status.php" method="post">
	<p><input type="submit" value="Ver estado dos leilıes" /></p>
</form>

</body>
</html>