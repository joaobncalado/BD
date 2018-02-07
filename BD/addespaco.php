<html>
    <body>
<?php
    $morada = $_REQUEST['morada'];
    $codigo = $_REQUEST['codigo'];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist165909";
        $password = "password";
        $dbname = $user;
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("start transaction;");

        $sql1 = "INSERT INTO alugavel values ('$morada', '$codigo', 'foto');";
        $sql2 = "INSERT INTO espaco values ('$morada', '$codigo');";

        $db->query($sql1);
        $db->query($sql2);

        $db->query("commit;");

        $db = null;
        echo("<p>Espaço '$morada, $codigo' adicionado.</p>");
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
    </body>
</html>
