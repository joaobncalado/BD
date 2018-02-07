<html>
    <body>
    <h2>Gestão de Reservas</h2>
    <form action="index.html" method="post">
        <p><input type="submit" value="Regressar ao Menu"/></p>
    </form>
<?php
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist165909";
        $password = "password";
        $dbname = $user;
    
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "SELECT * FROM oferta o WHERE NOT EXISTS (SELECT * FROM aluga a WHERE a.morada=o.morada AND a.codigo=o.codigo AND a.data_inicio=o.data_inicio);"; 
        $result = $db->query($sql);  

        echo("<b>Ofertas disponíveis</b>");
        echo("<br></br>");
        echo("<table border=\"1\" cellspacing=\"1\">\n");
        echo("<td>\n");
        echo("Morada\n");
        echo("<td>\n");
        echo("Código\n");
        echo("<td>\n");
        echo("Data de Incio\n");
        echo("<td>\n");
        echo("Data de Fim\n");
        echo("<td>\n");
        echo("Tarifa\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['morada']}</td>\n");
            echo("<td>{$row['codigo']}</td>\n");
            echo("<td>{$row['data_inicio']}</td>\n");
            echo("<td>{$row['data_fim']}</td>\n");
            echo("<td>{$row['tarifa']}</td>\n");
            echo("</tr>\n");
        }
        echo("</table>\n");
        echo("<br></br>");
        $db = null;

        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    <b>Criar uma Reserva </b>
    <form action="addreserva.php" method="post">
        <p>Introduza a morada: <input type="text" name="morada"/></p>
        <p>Introduza o código: <input type="text" name="codigo"/></p>
        <p>Introduza a data de início: <input type="date" name="data_inicio"/></p>
        <p>Introduza o seu NIF: <input type="text" name="nif"/></p>
        <p><input type="submit" value="Fazer Reserva"/></p>
    </form>
    <form action="index.html" method="post">
        <p><input type="submit" value="Regressar ao menu"/></p>
    </form>
    </body>
</html>