<html>
  <head>
    <meta charset="UTF-8">
    <!--<meta http-equiv="content-type" content="text/html;charset=utf-8" /> -->
    <link type="text/css" rel="stylesheet" href="css/stylesheet2.css"/>
    <title>Projeto Base de Dados</title>
  </head>
  <body>
    <h1> Projeto de Base de Dados</h1>
    <h1> 2015/2016 - 1º Semestre </h1>
    <!--<h2> Seja bem-vindo ao seu Bloco de Notas virtual! </h2> -->
    <?php
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
        $email = $_SESSION['email'];
        $nome = $_SESSION['nome'];
        $nomePagina = $_REQUEST['nomePagina'];
        $pagecounter = $_REQUEST['pagecounter'];
        $_SESSION['pageid'] = $pagecounter;

        if(isset($email)){
          echo"Seja bem-vindo $nome ao seu Bloco de Notas virtual!<br>";
          echo"Essas informações <font color='red'>PODEM</font> ser acessadas por você <br>";

          $sql = "SELECT r.nome as NomeRegisto, c.nome as NomeCampo, valor, regcounter
                  FROM registo r, campo c, valor v, reg_pag rp
                  WHERE rp.userid = $userid AND pageid = $pagecounter
                  AND rp.regid = regcounter AND rp.typeid = typecnt
                  AND campoid = campocnt AND rp.ativa = true
                  ORDER BY r.nome ASC";
          $select = $db->query($sql);

          echo '<div class="wrap">';
          echo '<table cellpadding="0" cellspacing="0" class="db-table">';
          echo '<thead><tr><th colspan="4">', $nomePagina, '</th></tr></thead>';
          foreach($select as $row){
            echo '<tbody><tr>';
            echo '<td>', $row['NomeRegisto'], '</td>';
            echo '<td>', $row['NomeCampo'], '</td>';
            echo '<td>', $row['valor'], '</td>';
            echo("<td><a href=\"retirarRegisto.php?regcounter={$row['regcounter']}\">Remover registo</a></td>");
            echo '</tr></tbody>';
          }
          echo '</table><br>';
        /*echo ("<p class="centro"><a href=\"novoRegisto.php?pageid=$pagecounter\">
                <input type="button" value="Adicionar novo registo"></a></p>");*/
          echo '<p class="centro"><a href="novoRegisto.php"><input type="button" value="Adicionar novo registo"></a></p>';
          echo '</div>';
        }/*else{
            echo"Bem-Vindo, convidado <br>";
            echo"Essas informações <font color='red'>NÃO PODEM</font> ser acessadas por você";
            echo"<br><a href='login.html'>Faça Login</a> Para ler o conteúdo";
        }*/
      }catch (PDOException $e){
        echo("<p>ERROR: {$e->getMessage()}</p>");
      }
    ?>

  </body>
</html>
