<?php
  try{
    header('Content-Type: text/html; charset=UTF-8');
    session_start();

    $host = "db.ist.utl.pt";
    $user ="ist165909";
    $password = "joaocalado";
    $dbname = $user;

    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $entrar = $_POST['entrar'];

    if (isset($entrar)) {

      $sql1 = "SELECT COUNT(*) FROM utilizador WHERE email = '$email'";
      $select1 = $db->query($sql1);
      $num_rows = $select1->fetchColumn();

      if($num_rows<=0){
        echo "<script language='javascript' type='text/javascript'>
          alert('Email não registado.'); window.location.href='index.html';</script>";
        exit();
      }

      $sql2 = "SELECT userid, email, nome, password FROM utilizador WHERE email = '$email'";
      $select2 = $db->query($sql2);

      foreach($select2 as $row){

        $userid = $row['userid'];
        if($row['password'] != $senha){

          $sql3 = "INSERT INTO login(userid,sucesso) VALUES ('$userid', false)";
          $insert1 = $db->query($sql3);
          echo "<script language='javascript' type='text/javascript'>
            alert('Password incorreta.'); window.location.href='index.html';</script>";
          exit();

        }else{
          
            $sql4 = "INSERT INTO login(userid,sucesso) VALUES ('$userid', true)";
            $insert2 = $db->query($sql4);

            $_SESSION['userid'] = $row['userid'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['nome'] = $row['nome'];
            header("Location:index.php");
        }
      }
    }
    $db = null;
    //die();

  }catch (PDOException $e){
    echo("<p>ERROR: {$e->getMessage()}</p>");
  }
?>
