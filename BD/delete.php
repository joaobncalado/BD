<html>
    <body>
<?php
    $morada = $_REQUEST['morada'];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist165909";
        $password = "password";
        $dbname = $user;
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("start transaction;");

        $sql1 = "DELETE FROM aluga WHERE morada = '$morada';";
        $sql2 = "DELETE FROM oferta WHERE morada = '$morada';";
        $sql3 = "DELETE FROM posto WHERE morada = '$morada';";
        $sql4 = "DELETE FROM espaco WHERE morada = '$morada';";
        $sql5 = "DELETE FROM fiscaliza WHERE morada = '$morada';";
        $sql6 = "DELETE FROM arrenda WHERE morada = '$morada';";
        $sql7 = "DELETE FROM alugavel WHERE morada = '$morada';";
        $sql8 = "DELETE FROM edificio WHERE morada = '$morada';";

        $db->query($sql1);
        $db->query($sql2);
        $db->query($sql3);
        $db->query($sql4);
        $db->query($sql5);
        $db->query($sql6);
        $db->query($sql7);
        $db->query($sql8);

        $db->query("commit;");

        $db = null;

        echo("<p>Edificio '$morada' apagado.</p>");
        header('Location:locais.php');
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
