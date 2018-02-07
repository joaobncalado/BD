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

        if(isset($email)){
          echo"Seja bem-vindo $nome ao seu Bloco de Notas virtual!<br>";
          echo"Essas informações <font color='red'>PODEM</font> ser acessadas por você <br>";

          $sql = "SELECT pagecounter, nome FROM pagina WHERE userid=$userid AND ativa=true";
          $select = $db->query($sql);

          echo '<div class="wrap">';
          echo '<table cellpadding="0" cellspacing="0" class="db-table">';
          echo '<thead><tr><th colspan="2">Páginas</th></tr></thead>';
          foreach($select as $row){
            echo '<tbody><tr>';
            //echo '<td>', $row['nome'], '</td>';
            echo("<td><a href=\"listarRegPag.php?pagecounter={$row['pagecounter']}&nomePagina={$row['nome']}\">{$row['nome']}</a></td>");
            echo("<td><a href=\"retirarPagina.php?pagecounter={$row['pagecounter']}\">Remover página</a></td>");
            echo '</tr></tbody>';
          }
          echo '</table><br>';
          //echo '<button><a href="novaPag.html">Adicionar nova página</a></button>';
          echo '<p class="centro"><a href="novaPagina.php"><input type="button" value="Adicionar nova página"></a></p>';
          echo '</div>';

          $sql = "SELECT typecnt, nome FROM tipo_registo WHERE userid=$userid AND ativo=true";
          $select = $db->query($sql);

          echo '<div class="wrap">';
          echo '<table cellpadding="0" cellspacing="0" class="db-table">';
          echo '<thead><tr><th colspan="2">Tipos de Registo</th></tr></thead>';
          foreach($select as $row){
            echo '<tbody><tr>';
            echo '<td>', $row['nome'], '</td>';
            echo ("<td><a href=\"retirarTipoRegisto.php?typecnt={$row['typecnt']}\">Remover tipo de registo</a></td>");
            echo '</tr></tbody>';
          }
          echo '</table><br>';
          //echo '<button><a href="novoTReg.html">Adicionar novo tipo de registo</a></button>';
          echo '<p class="centro"><a href="novoTipoRegisto.php"><input type="button" value="Adicionar novo tipo de registo"></a></p>';
          echo'</div>';
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
