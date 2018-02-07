<html>
<body>
<?php
	// inicia sessão para passar variaveis entre ficheiros php
	session_start();

	$username = $_SESSION['username'];
	$nif = $_SESSION['nif'];
	$pin = $_SESSION['pin'];

	// Função para limpar os dados de entrada
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	// Carregamento das variáveis username e pin do form HTML através do metodo POST;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$lid = test_input($_POST["lid"]);
	}
	// Conexão à BD
	$host="db.ist.utl.pt";		// o MySQL esta disponivel nesta maquina
	$user="ist165909";		// -> substituir pelo nome de utilizador
	$password="password";		// -> substituir pela password dada pelo mysql_reset
	$dbname = $user;		// a BD tem nome identico ao utilizador
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password,
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	echo("<p>Connected to MySQL database $dbname on $host as user $user</p>\n");

		// Apresenta os leil�es

	echo("Username: $username");

	$sql2 = "SELECT leilao FROM concorrente WHERE concorrente.pessoa =" . $username;
	$sql1 = "SELECT * FROM (leilao NATURAL JOIN leilaor) WHERE lid = ANY( $sql2 )";

	$result = $connection->query($sql1);

	if (!$result) {
		echo("<p> Erro na Query:($sql)<p>");
	exit();
	}

	echo("<table border=\"1\">\n");
	echo("<tr><td>lid</td><td>nif</td><td>dia</td><td>NrDoDia</td><td>nome</td><td>tipo</td><td>nrdias</td><td>valorbase</td></tr>\n");


	$idleilao = 0;
	foreach($result as $row){
		$date = $row["dia"];
		$date = strtotime("+" .$row["nrdias"]." days", strtotime($date));
		$date = date('Y-m-d' , $date);
		if( $date >= date("Y-m-d")) {
		$idleilao = $idleilao +1;
		echo("<tr><td>");
		echo($row["lid"]); echo("</td><td>");
		echo($row["nif"]); echo("</td><td>");
		echo($row["dia"]); echo("</td><td>");
		echo($row["nrleilaonodia"]); echo("</td><td>");
		echo($row["nome"]); echo("</td><td>");
		echo($row["tipo"]); echo("</td><td>");
		echo($row["nrdias"]); echo("</td><td>");
		echo($row["valorbase"]); echo("</td>");
		$leilao[$idleilao]= array($row["nif"],$row["dia"],$row["nrleilaonodia"]);}

	}

	echo("</table>\n");

	echo "<h2>Lances registados</h2>";

	$sql = "SELECT * FROM (leilao NATURAL JOIN leilaor NATURAL JOIN
	(SELECT leilao as lid, valor FROM lance  ORDER BY valor DESC)  as res)
		WHERE lid = ANY(SELECT leilao FROM concorrente WHERE concorrente.pessoa = $username) 
			GROUP BY lid";
	
	$result = $connection->query($sql);

	if (!$result) {
		echo("<p> Erro na Query:($sql)<p>");
	exit();
	}

	echo("<table border=\"1\">\n");
	echo("<tr><td>Lid</td><td>Nome</td><td>ValorBase</td><td>MaiorLance</td><td>TempoRestante</td></tr>\n");

	$idleilao = 0;
	$today = date("Y-m-d");
	foreach($result as $row){
		$date = $row["dia"];
		$date = strtotime("+" .$row["nrdias"]." days", strtotime($date));
		$date = date('Y-m-d' , $date);
		if( $date >= $today) {
		$idleilao = $idleilao +1;
		echo("<tr><td>");
		echo($row["lid"]); echo("</td><td>");
		echo($row["nome"]); echo("</td><td>");
		echo($row["valorbase"]); echo("</td><td>");
		echo($row["valor"]); echo("</td><td>");
		echo($date ); echo("</td>");
		$leilao[$idleilao]= array($row["nif"],$row["dia"],$row["nrleilaonodia"]);}

	}

	echo("</table>\n");

	?>

<form action="lance.php" method="post">
	<h2>Escolha o LID e valor para o lance a efectuar</h2>
	<p>LID : <input type="text" name="lid" /></p>
	<p>Valor : <input type="text" name="valor" /></p>
	<p><input type="submit" value = "Fazer lance" /></p>
</form>

<form action="registo.php" >
	<p><input type="submit" value = "novo registo"/></p>
</form>

<form action="login.htm" >
	<p><input type="submit" value="Voltar ao login"/></p>
</form>

</body>
</html>