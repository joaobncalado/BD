<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php

      try{
        $host = "db.ist.utl.pt";
       $user ="ist165909";
    $password = "password";
        $dbname = $user;
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $nome = $_POST['nome'];
        $pergunta1 = $_POST['pergunta1'];
        $resposta1 = $_POST['resposta1'];
        $pergunta2 = $_POST['pergunta2'];
        $resposta2 = $_POST['resposta2'];
        $pais = $_POST['pais'];

        $sql = "SELECT email FROM utilizador WHERE email='$email';";
        $select = $db->query($sql);

        foreach($select as $row){
          $select_email = $row['email'];
        }

        if($select_email == $email){
          echo"<script language='javascript' type='text/javascript'>
              alert('Esse email já está registado.');
              window.location.href='registo.html';</script>";
          die();
        }else{
          $query = "INSERT INTO utilizador (email, nome, password, questao1, resposta1, questao2, resposta2, pais)
                  VALUES ('$email','$nome','$senha','$pergunta1','$resposta1','$pergunta2','$resposta2', '$pais')";
          $insert = $db->query($query);
          if($insert){
            echo"<script language='javascript' type='text/javascript'>
                alert('Utilizador registado com sucesso!');
                window.location.href='index.html'</script>";
          }else{
            echo"<script language='javascript' type='text/javascript'>
                alert('Não foi possível registar este utilizador.');
                window.location.href='registo.html'</script>";
          }
        }
        $db = null;
      }catch (PDOException $e){
        echo("<p>ERROR: {$e->getMessage()}</p>");
      }
    ?>
  </body>
</html>
