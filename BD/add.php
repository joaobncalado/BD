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
        $sql = null;
        $db->query("start transaction;");
        if(!empty($morada)){
            $sql = "INSERT INTO edificio values ('$morada');";
            $db->query($sql);
            echo("<p>Edifício '$morada' adicionado.</p>");
        }else{
            echo("<p>Não introduziu a morada do edifício.</p>");
        }

        $db->query("commit;");

        $db = null;
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
