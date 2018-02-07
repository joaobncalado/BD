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
        <p><input type="text" id="nomeRegisto" name="nomeRegisto" placeholder="Nome do novo registo" required></p>
        <p><input type="text" id="nomeCampo" name="nomeCampo" placeholder="Nome do campo" required></p>
        <p><input type="text" id="valor" name="valor" placeholder="Valor" required></p>
        <p class="centro"><input type="submit" value="Adicionar" id="adicionar" name="adicionar"></p>
        <p class="centro"><a href="listarRegPag.php"><input type="button" value="Voltar"></a></p>
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
        $pageid = $_SESSION['pageid'];
        $nomeRegisto = $_POST['nomeRegisto'];
        $nomeCampo = $_POST['nomeCampo'];
        $valor = $_POST['valor'];

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
//-----------------------------------------------------------------------------------------
// Obter typeid (typecounter) da página em questão
//-----------------------------------------------------------------------------------------

        $sql3 ="SELECT DISTINCT typeid FROM reg_pag WHERE userid = '$userid' AND pageid = '$pageid'";
        $select2 = $db->query($sql3);

        foreach ($select2 as $row) {
          $typecounter = $row['typeid'];
        }
//-----------------------------------------------------------------------------------------
// Inserção tabela registo
//-----------------------------------------------------------------------------------------

        $sql4 ="SELECT regcounter FROM registo WHERE userid = '$userid'
                ORDER BY regcounter DESC LIMIT 1";
        $select3 = $db->query($sql4);

        foreach ($select3 as $row) {
          $regcounter = $row['regcounter'];
          $regcounter++;
        }

        $sql5 = "INSERT INTO registo(userid, typecounter, regcounter, nome, idseq, ativo)
                VALUES('$userid', '$typecounter', '$regcounter', '$nomeRegisto', '$idseq', true)";
        $insert2 = $db->query($sql5);

//-----------------------------------------------------------------------------------------
// Inserção campo
//-----------------------------------------------------------------------------------------

        $sql6 ="SELECT campocnt FROM campo WHERE userid = '$userid'
                ORDER BY campocnt DESC LIMIT 1";
        $select4 = $db->query($sql6);

        foreach ($select4 as $row) {
          $campocounter = $row['campocnt'];
          $campocounter++;
        }

        $sql7 = "INSERT INTO campo(userid, typecnt, campocnt, nome, idseq, ativo)
                VALUES('$userid', '$typecounter', '$campocounter', '$nomeCampo', '$idseq', true)";
        $insert3 = $db->query($sql7);

//-----------------------------------------------------------------------------------------
// Inserção valor
//-----------------------------------------------------------------------------------------

        $sql8 = "INSERT INTO valor(userid, typeid, regid, campoid, valor, idseq, ativo)
                VALUES ('$userid', '$typecounter', '$regcounter', '$campocounter', '$valor', '$idseq', true)";
        $insert4 = $db->query($sql8);

//-----------------------------------------------------------------------------------------
// Inserção na tabela reg_pag
//-----------------------------------------------------------------------------------------

        $sql9 = "INSERT INTO reg_pag(userid, pageid, typeid, regid, idseq, ativa)
                VALUES ('$userid', '$pageid', '$typecounter', '$regcounter', '$idseq', true)";
        $insert5 = $db->query($sql9);

        $db->query("COMMIT;");

        echo '<p class="centro">Registo ' . $nomeRegisto . ' inserido com sucesso!</p>';
        $db = null;

      } catch (PDOException $e) {
        $db->query("ROLLBACK;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
      }
    }
    ?>
  </body>
</html>
