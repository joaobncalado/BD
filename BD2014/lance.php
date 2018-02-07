<html>
<body>
<?php
	// inicia sessão para passar variaveis entre ficheiros php
	session_start();

	$username = $_SESSION['username'];
	$lid = $_SESSION['lid'];
	$pin = $_SESSION['pin'];
	$valor = $_SESSION['valor'];

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
			$valor = test_input($_POST['valor']);
	}
	// Conexão à BD
	$host="db.ist.utl.pt";		// o MySQL esta disponivel nesta maquina
	$user="ist165909";		// -> substituir pelo nome de utilizador
	$password="password";		// -> substituir pela password dada pelo mysql_reset
	$dbname = $user;		// a BD tem nome identico ao utilizador
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password,
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	echo("<p>Connected to MySQL database $dbname on $host as user $user</p>\n");
	
	//faz o lance
	$sql = "INSERT INTO lance (pessoa,leilao,valor) VALUES ($username,$lid,$valor)";
	$result = $connection->query($sql);

	if (!$result) {
		echo("<p> Lance nao registado: Erro na Query:($sql) <p>");
		exit();
	}

	echo("<p> Lance ($valor) Registado no leilao($lid) </p>\n");

	// to be continued….
	//termina a sessão
	//session_destroy();
	// passa variaveis para a sessao;
	$_SESSION['username'] = $username;
	$_SESSION['nif'] = $nif;
	$_SESSION['pin'] = $pin;

?>
<form action="lances.php">
	<p><input type="submit" value="Novo Lance"/></p>
</form>
<form action="registo.php">
	<p><input type="submit" value="Novo Registo"/></p>
</form>
<form action="login.htm" >
	<p><input type="submit" value="Voltar ao login"/></p>
</form>

</body>
</html>