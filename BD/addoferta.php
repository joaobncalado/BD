<html>
    <body>
<?php
    $morada = $_REQUEST['morada'];
    $codigo = $_REQUEST['codigo'];
    $data_inicio = $_REQUEST['data_inicio'];
    $data_fim = $_REQUEST['data_fim'];
    $tarifa = $_REQUEST['tarifa'];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist165909";
        $password = "password";
        $dbname = $user;
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("start transaction;");
        $sql = "INSERT INTO oferta values ('$morada', '$codigo', '$data_inicio', '$data_fim', '$tarifa');";

        $db->query($sql);

        $db->query("commit;");

        $db = null;
        echo("<p>Oferta '$morada, $codigo, $data_inicio, $data_fim, $tarifa' adicionada.</p>");
        //header('Location:locais.php');
    }
    
    catch (PDOException $e)
    {
        $db->query("rollback;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
        echo("<p>Oferta '$morada, $codigo, $data_inicio, $data_fim, $tarifa' não adicionada.</p>");
    }
?>
    <form action="ofertas.php" method="post">
        <p><input type="submit" value="Regressar às ofertas"/></p>
    </form>
    </body>
</html>
