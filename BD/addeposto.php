<html>
    <body>
<?php
    //$codigo = $_REQUEST['codigo'];
    //$morada = $_REQUEST['morada'];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist165909";
        $password = "password";
        $dbname = $user;
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("start transaction;");

        //  $sql1 = "INSERT INTO Alugavel values ('$morada','$codigo');";
        //  $sql2 = "INSERT INTO Espaco values ('$morada','$codigo');";

        //  $db->query($sql1);
        //  $db->query($sql2);

        $db->query("commit;");

        $db = null;

        echo("<p>Posto '$morada, $codigo, $codigo_espaco' apagado.</p>");

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
