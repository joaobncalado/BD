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

	$sql = "start transaction;";
	$connection->query($sql);


	// Use tab and newline as tokenizing characters as well  
	$tok = strtok($lid, " ");

	while ($tok !== false) {
		$sql = "INSERT INTO concorrente (pessoa,leilao) VALUES ($nif,$tok)";
		$result = $connection->query($sql);
	    $tok = strtok(" ");
	}

	$string2 = $lid;
	$tok = strtok($string2, " ");
	$datai = "SELECT dia FROM leilaor WHERE lid = $tok;";
	$data = $connection->query($datai);

	foreach($data as $row){
		$dateInicial = $row["dia"];
	}

	$registado=1;

	$string3 = $lid;
	$tok = strtok($string3, " ");
	while ($tok !== false) {
		$datai = "SELECT dia FROM leilaor WHERE lid = $tok;";
		$data = $connection->query($datai);
		foreach($data as $row){
			if($row["dia"] != $dateInicial){
				$registado = 0;
				break;
			}
		}
		$tok = strtok(" ");
	}

	if($registado == 1){
		$sql = "commit;";
		$connection->query($sql);
		echo("<p> Pessoa ($username), nif ($nif) Registada no leilao ($lid)</p>\n");
	}else{
		$sql = "rollback;";
		$connection->query($sql);
		echo("<p> Pessoa ($username), nif ($nif) Nao Registada no leilao ($lid)</p>\n");
	}

	// passa variaveis para a sessao;
	$_SESSION['username'] = $username;
	$_SESSION['nif'] = $nif;
	$_SESSION['pin'] = $pin;

?>
<form action="registo.php" >
	<p><input type="submit" value = "novo registo"/></p>
</form>
<form action="login.htm" >
	<p><input type="submit" value="Voltar ao login"/></p>
</form>
</body>
</html>