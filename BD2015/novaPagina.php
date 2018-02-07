<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="Content-type" content="text/html; charset=UTF-8"> -->
    <link type="text/css" rel="stylesheet" href="css/stylesheet1.css"/>
    <title>Projeto Base de Dados</title>
  </head>

  <body>
    <h1> Projeto de Base de Dados</h1>
    <h1> 2015/2016 - 1º Semestre </h1>

    <div class="formulario">
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <p><input type="text" id="nomePagina" name="nomePagina" placeholder="Nome da nova página" required></p>
        <p class="centro"><input type="submit" value="Adicionar" id="adicionar" name="adicionar"></p>
        <p class="centro"><a href="index.php"><input type="button" value="Página inicial"></a></p>
      </form>
    </div>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      try{
        header('Content-Type: text/html; charset=UTF-8');
        session_start();

        $host = "db.ist.utl.pt";
        $user ="ist165909";
    $password = "password";
        $dbname = $user;

        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $userid = $_SESSION['userid'];
        //$email = $_SESSION['email'];
        //$nome = $_SESSION['nome'];

        $nomePagina = $_POST['nomePagina'];

        $db->query("START TRANSACTION;");

        $sql1 = "INSERT INTO sequencia(userid) VALUES ('$userid')";
        $insert1 = $db->query($sql1);

        $sql2 = "SELECT contador_sequencia FROM sequencia
                WHERE userid = '$userid' ORDER BY contador_sequencia
                DESC LIMIT 1";
        $select1 = $db->query($sql2);

        foreach ($select1 as $row) {
          $idseq = $row['contador_sequencia'];
        }

        $sql3 ="SELECT pagecounter FROM pagina WHERE userid = '$userid'
                ORDER BY pagecounter DESC LIMIT 1";
        $select2 = $db->query($sql3);

        foreach ($select2 as $row) {
          $pagecounter = $row['pagecounter'];
          $pagecounter++;
        }

        $sql4 = "INSERT INTO pagina(userid, pagecounter, nome, idseq, ativa)
                VALUES('$userid', '$pagecounter', '$nomePagina', '$idseq', true)";
        $insert2 = $db->query($sql4);

        $db->query("COMMIT;");

        echo '<p class="centro">Página ' . $nomePagina . ' inserida com sucesso!</p>';
        $db = null;

      } catch (PDOException $e) {
        $db->query("ROLLBACK;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
      }
    }
    ?>
  </body>
</html>
