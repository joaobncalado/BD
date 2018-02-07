<html>
    <body>
    <h2>Totais realizados por espaço para um dado edifício</h2>
<?php
    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist165909";
        $password = "password";
        $dbname = $user;
    
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "SELECT morada FROM edificio;";     
    
        $result = $db->query($sql);  
    
        
        echo("<b>Edificios </b>");
        echo("<table border=\"1\" cellspacing=\"1\">\n");
        echo("<br></br>");
        echo("<td>\n");
        echo("Morada\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['morada']}</td>\n");
            echo("</tr>\n");
        }
        echo("</table>\n");
    
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    <form action="totespaco.php" method="post">
        <p><input type="hidden"/></p>
        <p>Introduza a morada do Edifício: <input type="text" name="morada"/></p>
        <p><input type="submit" value="Mostrar o total realizado por espaço"/></p>
    </form>
    <form action="index.html" method="post">
        <p><input type="submit" value="Regressar ao menu"/></p>
    </form>
    </body>
</html>
        
