<html>
    <body>
<?php
    $morada = $_REQUEST['morada'];
    $codigo = $_REQUEST['codigo'];
    $data_inicio = $_REQUEST['data_inicio'];

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
        $sql2 = "DELETE FROM oferta WHERE morada = '$morada' AND codigo = '$codigo' AND data_inicio = '$data_inicio';";

        $db->query($sql1);
        $db->query($sql2);

        $db->query("commit;");

        $db = null;

        echo("<p>Oferta '$morada, $codigo, $data_inicio' removida.</p>");
        //header('Location:locais.php');
    }
    
    catch (PDOException $e)
    {
        $db->query("rollback;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
        echo("<p>Oferta '$morada, $codigo, $data_inicio' não removida.</p>");
    }
?>
    <form action="ofertas.php" method="post">
        <p><input type="submit" value="Regressar à lista"/></p>
    </form>
    </body>
</html>
