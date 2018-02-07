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
    $typecnt = $_REQUEST['typecnt'];

    $db->query("START TRANSACTION;");

    $sql = "UPDATE tipo_registo SET ativo = false WHERE userid = '$userid' AND typecnt = '$typecnt'";

    echo("<p>$sql</p>");

    $db->query($sql);

    $db->query("COMMIT;");

    $db = null;

  } catch (PDOException $e) {
    $db->query("ROLLBACK;");
    echo("<p>ERROR: {$e->getMessage()}</p>");
  }
?>
