<html>
    <body>
    <h2>Pagar uma reserva</h2>
    <form action="index.html" method="post">
        <p><input type="submit" value="Regressar ao menu"/></p>
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
    
        $sql = "SELECT * FROM aluga a NATURAL JOIN estado e WHERE e.estado='Aceite' AND NOT EXISTS (SELECT numero, estado FROM estado e1 WHERE e1.estado='Paga' AND e.numero=e1.numero);";   
    
        $result = $db->query($sql);    
    
        
        echo("<b>Reservas aceites que aguardam pagamento</b>");
        //echo("<a href=\"add.php?morada=coise\"> Adicionar Edificio</a>\n");
        echo("<table border=\"1\" cellspacing=\"1\">\n");
        echo("<br></br>");
        echo("<td>\n");
        echo("Código da reserva\n");
        echo("<td>\n");
        echo("Morada\n");
        echo("<td>\n");
        echo("Código\n");
        echo("<td>\n");
        echo("Data deInício\n");
        echo("<td>\n");
        echo("NIF do Arrendatário\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['numero']}</td>\n");
            echo("<td>{$row['morada']}</td>\n");
            echo("<td>{$row['codigo']}</td>\n");
            echo("<td>{$row['data_inicio']}</td>\n");
            echo("<td>{$row['nif']}</td>\n");
            echo("</tr>\n");
        }
        echo("</table>\n");
        echo("<br></br>");
    
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
    <b>Pagar uma Reserva</b>
    <form action="pagareserva.php" method="post">
        <p>Introduza o código da reserva: <input type="text" name="numero"/></p>
        <p>Introduza o método de pagamento: <input type="text" name="metodo"/></p>
        <p><input type="submit" value="Fazer Reserva"/></p>
    </form>
    </body>
</html>