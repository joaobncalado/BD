<html>
    <body>
<?php
    
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist165909";
        $password = "password";
        $dbname = $user;
    
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $morada = $_REQUEST['morada'];
        $sql = "SELECT morada, codigo AS codigo_espaco, total_realizado FROM (SELECT morada, codigo, sum(total_realizado) AS total_realizado FROM (SELECT morada, codigo, tarifa*(data_fim-data_inicio) AS total_realizado FROM oferta NATURAL JOIN aluga NATURAL JOIN espaco WHERE morada='$morada') AS c GROUP BY codigo, morada) AS aux UNION ALL (SELECT morada, codigo_espaco AS codigo, sum(total_realizado) AS total_realizado FROM (SELECT morada, codigo,codigo_espaco, tarifa*(data_fim-data_inicio) AS total_realizado FROM oferta NATURAL JOIN aluga NATURAL JOIN posto WHERE morada='$morada') AS d GROUP BY codigo_espaco, morada);";
        
        $resultn = $db->query($sql);

        echo("<b>Espaços</b>");
        echo("<table border=\"1\" cellspacing=\"1\">\n");
        echo("<td>\n");
        echo("Código\n");
        echo("<td>\n");
        echo("Total Realizado\n");
        foreach($resultn as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['codigo_espaco']}</td>\n");
            echo("<td>{$row['total_realizado']}</td>\n");
            echo("</tr>\n");
        }
        echo("<br></br>");
        
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>

    <form action="totais.php" method="post">
        <p><input type="submit" value="Regressar à lista de Edifícios"/></p>
    </form>
    </body>
</html>
        
