<html>
    <body>
    <h2>Gestão de Edificios, Espaços e Postos de Trabalho</h2>
    <form action="index.html" method="post">
        <p><input type="submit" value="Regressar ao Menu"/></p>
    </form>
    <!--a partir deste ficheiro é feita a gestão de edificios, espaços e postos de trabalho
delete -> remover edificio
delespaco -> remover espaco (comportamento errado)
delposto -> remover posto (comportamento errado)
addespaco -> adicionar espaco (comportamento errado)
addposto -> adicionar posto (comportamento errado)
-->
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
        $sqle = "SELECT morada, codigo FROM espaco;";
        $sqlp = "SELECT morada, codigo, codigo_espaco FROM posto;";        
    
        $result = $db->query($sql);
        $resultn = $db->query($sqle);
        $resultp = $db->query($sqlp);        
    
        
        echo("<b>Edifícios </b>");
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
        echo("<br></br>");
        $db = null;
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    <b>Adicionar um Edifício </b>
    <form action="add.php" method="post">
        <p>Introduza a morada: <input type="text" name="morada"/></p>
        <p><input type="submit" value="Adicionar Novo Edifício"/></p>
    </form>
    <b>Remover um Edifício </b>
    <form action="delete.php" method="post">
        <p>Introduza a morada: <input type="text" name="morada"/></p>
        <p><input type="submit" value="Remover Edifício"/></p>
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
        echo("----------------------------------------------------------------");
        echo("<br></br>");
        echo("<br></br>");
        echo("<b>Espaços</b>");
        echo("<br></br>");
        echo("<table border=\"1\" cellspacing=\"1\">\n");
        echo("<td>\n");
        echo("Morada\n");
        echo("<td>\n");
        echo("Código\n");
        foreach($resultn as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['morada']}</td>\n");
            echo("<td>{$row['codigo']}</td>\n");
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
    <b>Adicionar um Espaço </b>
    <form action="addespaco.php" method="post">
        <p>Introduza a morada do Edificio: <input type="text" name="morada"/></p>
        <p>Introduza o código do novo Espaço: <input type="text" name="codigo"/></p>
        <p><input type="submit" value="Adicionar Novo Espaço"/></p>
    </form>
    <b>Remover um Espaço </b>
    <form action="delespaco.php" method="post">
        <p>Introduza a morada: <input type="text" name="morada"/></p>
        <p>Introduza o código: <input type="text" name="codigo"/></p>
        <p><input type="submit" value="Remover Espaço"/></p>
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
        echo("----------------------------------------------------------------");
        echo("<br></br>");
        echo("<br></br>");
        echo("<b>Postos</b>");
        echo("<br></br>");
        echo("<table border=\"1\" cellspacing=\"1\">\n");
        echo("<td>\n");
        echo("Morada\n");
        echo("<td>\n");
        echo("Código do Posto\n");
        echo("<td>\n");
        echo("Código do Espaço\n");
        foreach($resultp as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['morada']}</td>\n");
            echo("<td>{$row['codigo']}</td>\n");
            echo("<td>{$row['codigo_espaco']}</td>\n");
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
    <b>Adicionar um Posto </b>
    <form action="addposto.php" method="post">
        <p>Introduza a morada do Edificio: <input type="text" name="morada"/></p>
        <p>Introduza o código do novo Posto: <input type="text" name="codigo"/></p>
        <p>Introduza o código do Espaço: <input type="text" name="codigo_espaco"/></p>
        <p><input type="submit" value="Adicionar Novo Posto"/></p>
    </form>
    <b>Remover um Posto </b>
    <form action="delposto.php" method="post">
        <p>Introduza a morada: <input type="text" name="morada"/></p>
        <p>Introduza o código do Posto: <input type="text" name="codigo"/></p>
        <p>Introduza o código do espaço: <input type="text" name="codigo_espaco"/></p>
        <p><input type="submit" value="Remover Posto"/></p>
    </form>
    </body>
</html>