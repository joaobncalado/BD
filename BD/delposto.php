<html>
    <body>
<?php
    $morada = $_REQUEST['morada'];
    $codigo = $_REQUEST['codigo'];
    $codigo_espaco = $_REQUEST['codigo_espaco'];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist165909";
        $password = "password";
        $dbname = $user;
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("start transaction;");

        $sql1 = "DELETE FROM aluga WHERE morada = '$morada' AND codigo = '$codigo';";
        $sql2 = "DELETE FROM oferta WHERE morada = '$morada' AND codigo = '$codigo';";
        $sql3 = "DELETE FROM posto WHERE morada = '$morada' AND codigo = '$codigo';";
        $sql4 = "DELETE FROM fiscaliza WHERE morada = '$morada' AND codigo = '$codigo';";
        $sql5 = "DELETE FROM arrenda WHERE morada = '$morada' AND codigo = '$codigo';";
        $sql6 = "DELETE FROM alugavel WHERE morada = '$morada' AND codigo = '$codigo';";

        $db->query($sql1);
        $db->query($sql2);
        $db->query($sql3);
        $db->query($sql4);
        $db->query($sql5);
        $db->query($sql6);

        $db->query("commit;");

        $db = null;

        echo("<p>Posto '$morada, $codigo, $codigo_espaco' apagado.</p>");
        //header('Location:locais.php');
    }
    
    catch (PDOException $e)
    {
        $db->query("rollback;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    <form action="locais.php" method="post">
        <p><input type="submit" value="Regressar à lista"/></p>
    </form>
    </body>
</html>
