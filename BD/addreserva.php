<html>
    <body>
<?php
    $morada = $_REQUEST['morada'];
    $codigo = $_REQUEST['codigo'];
    $data_inicio = $_REQUEST['data_inicio'];
    $nif = $_REQUEST['nif'];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist165909";
        $password = "password";
        $dbname = $user;
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("start transaction;");

        $sql = "SELECT MAX(numero)+1 AS max FROM reserva";

        $result = $db->query($sql);

        foreach($result as $row)
        {
            $maxreserva = $row['max'];
        }

        $sql2 = "INSERT INTO reserva VALUES ('$maxreserva');";
        $sql3 = "INSERT INTO aluga VALUES ('$morada', '$codigo', '$data_inicio', '$nif', '$maxreserva');";
        $sql4 = "SELECT DISTINCT * FROM aluga NATURAL JOIN estado ORDER BY numero;";
        $sql5 = "INSERT INTO estado VALUES ('$maxreserva', now(), 'Pendente');";
        $db->query($sql2);
        $db->query($sql3);
        
        $db->query($sql5);
        $result = $db->query($sql4);
        

        echo("<b>Estado das Reservas Feitas</b>");
        echo("<br></br>");
        echo("<table border=\"1\" cellspacing=\"1\">\n");
        echo("<td>\n");
        echo("Morada\n");
        echo("<td>\n");
        echo("Código\n");
        echo("<td>\n");
        echo("Data de Incio\n");
        echo("<td>\n");
        echo("NIF\n");
        echo("<td>\n");
        echo("Código de Reserva\n");
        echo("<td>\n");
        echo("Estado\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['morada']}</td>\n");
            echo("<td>{$row['codigo']}</td>\n");
            echo("<td>{$row['data_inicio']}</td>\n");
            echo("<td>{$row['nif']}</td>\n");
            echo("<td>{$row['numero']}</td>\n");
            echo("<td>{$row['estado']}</td>\n");
            echo("</tr>\n");
        }
        echo("</table>\n");
        echo("<br></br>");




        $db->query("commit;");

        $db = null;

        echo("<p>Reserva número '$maxreserva' feita.</p>");
        //header('Location:locais.php');

    }
    
    catch (PDOException $e)
    {
        $db->query("rollback;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
        echo("<p>Reserva '$morada, $codigo, $data_inicio, $nif, $maxreserva' não adicionada.</p>");
    }
?>
    <form action="reservas.php" method="post">
        <p><input type="submit" value="Regressar à lista"/></p>
    </form>
    </body>
</html>
