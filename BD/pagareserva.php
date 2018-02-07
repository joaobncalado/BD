<html>
    <body>
<?php
    $numero = $_REQUEST['numero'];
    $metodo = $_REQUEST['metodo'];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist165909";
        $password = "password";
        $dbname = $user;
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("start transaction;");

        $sql = "INSERT INTO paga VALUES('$numero', now(), '$metodo');";
        $sql2 = "INSERT INTO estado VALUES('$numero', now(), 'Paga');";
        

        $db->query($sql);
        $db->query($sql2);

        $sql3 = "SELECT * FROM estado ORDER BY time_stamp";

        $result = $db->query($sql3);
        
        echo("<b>Estado das Reservas Feitas</b>");
        echo("<br></br>");
        echo("<table border=\"1\" cellspacing=\"1\">\n");
        echo("<td>\n");
        echo("Código de Reserva\n");
        echo("<td>\n");
        echo("Estado\n");
        echo("<td>\n");
        echo("Timestamp\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['numero']}</td>\n");
            echo("<td>{$row['estado']}</td>\n");
            echo("<td>{$row['time_stamp']}</td>\n");
            echo("</tr>\n");
        }
        echo("</table>\n");
        echo("<br></br>");




        $db->query("commit;");

        $db = null;

        echo("<p>Reserva número '$numero' foi paga.</p>");
        //header('Location:locais.php');

    }
    
    catch (PDOException $e)
    {
        $db->query("rollback;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
        echo("<p>Reserva '$numero' não paga.</p>");
    }
?>
    <form action="pagamentoreserva.php" method="post">
        <p><input type="submit" value="Regressar à lista"/></p>
    </form>
    </body>
</html>
