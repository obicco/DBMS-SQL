<html>
<head>
<title>Ricerca pilota</title>    
</head>

<body bgcolor = "#FFFFFF">
    <h4>Ricerca pilota</h4>
        <form method="get" action="getPilot.php">
            <table>
                <tr><td>Codice fiscale</td>
                    <td>
                        <select name="codicefiscale">
                            <?php
                            
                            //CONNESSIONE AL DB
                            $connection = mysqli_connect('localhost', 'root', '', 'GARE');
                            if (mysqli_connect_errno() ) 
                                die ('Failed to connect to MySQL: ' . mysqli_connect_error() ); 
                            
                            //QUERY SQL
                            $sql = "SELECT CodFisc
                                    FROM PILOTA";
                            
                            //ESECUZIONE QUERY
                            $result = mysqli_query($connection, $sql);
                            
                            if( !$result)
                                die ('Errore query: ' . mysqli_error($connection));
                            
                            while ($row = mysqli_fetch_row($result)) {
                                $codf = $row[0];
                                echo "<option value=\"$codf\"> $codf </option>";
                            }
                            
                            //CHIUSURA DELLA CONNESSIONE
                            mysqli_close($connection);
                            
                            ?>
                        </select>
                    </td>
                </tr>
                <tr><td>Circuito</td>
                    <td><input type="text" size="4" name="circuito"</td></tr>
            </table>
            
            <br>
            <input type="reset" value"Reset">
            <input type="submit" value="Submit">
        </form>
    
    
        <h4>Inserimento nuovo pilota</h4>
        <form method="post" action="putPilot.php">
            <table>
                <tr><td>Codice Fiscale</td>
                    <td><input type="text" size="20" name="codicefiscale"</td></tr>
                 <tr><td>Nome</td>
                    <td><input type="text" size="20" name="nome"</td></tr>
                 <tr><td>Cognome</td>
                    <td><input type="text" size="20" name="cognome"</td></tr>
                 <tr><td>Anno di nascita</td>
                    <td><input type="number" size="20" name="annodinascita"</td></tr>
                 <tr><td>Nazionalità</td>
                    <td><input type="text" size="20" name="nazionalita"</td></tr>
                 <tr><td>Scuderia</td>
                    <td><input type="text" size="20" name="scuderia"</td></tr>
            </table>
            <br>
            <input type="reset" value"Reset">
            <input type="submit" value="Submit">
        </form>
    
    
        <h4>Inserimento nuova gara</h4>
        <form method="post" action="putRace.php">
            <table>
                <tr><td>Codice Fiscale</td>
                <td>
                        <select name="codicefiscale">
                            <?php
                            
                            //CONNESSIONE AL DB
                            $connection = mysqli_connect('localhost', 'root', '', 'GARE');
                            if (mysqli_connect_errno() ) 
                                die ('Failed to connect to MySQL: ' . mysqli_connect_error() ); 
                            
                            //QUERY SQL
                            $sql = "SELECT CodFisc
                                    FROM PILOTA";
                            
                            //ESECUZIONE QUERY
                            $result = mysqli_query($connection, $sql);
                            
                            if( !$result)
                                die ('Errore query: ' . mysqli_error($connection));
                            
                            while ($row = mysqli_fetch_row($result)) {
                                $codf = $row[0];
                                echo "<option value=\"$codf\"> $codf </option>";
                            }
                            
                            //CHIUSURA DELLA CONNESSIONE
                            mysqli_close($connection);
                            
                            ?>
                        </select>
                    </td>    
                </tr>
                <tr><td>Codice circuito</td>
                  <td>
                        <select name="codicecircuito">
                            <?php
                            
                            //CONNESSIONE AL DB
                            $connection = mysqli_connect('localhost', 'root', '', 'GARE');
                            if (mysqli_connect_errno() ) 
                                die ('Failed to connect to MySQL: ' . mysqli_connect_error() ); 
                            
                            //QUERY SQL
                            $sql = "SELECT CodCircuito
                                    FROM CIRCUITO";
                            
                            //ESECUZIONE QUERY
                            $result = mysqli_query($connection, $sql);
                            
                            if( !$result)
                                die ('Errore query: ' . mysqli_error($connection));
                            
                            while ($row = mysqli_fetch_row($result)) {
                                $codf = $row[0];
                                echo "<option value=\"$codf\"> $codf </option>";
                            }
                            
                            //CHIUSURA DELLA CONNESSIONE
                            mysqli_close($connection);
                            
                            ?>
                        </select>
                    </td>  
                </tr>
                 <tr><td>Data</td>
                    <td><input type="date" size="20" name="data"</td></tr>
                 <tr><td>Ora inizio</td>
                    <td><input type="time" size="20" name="orainizio"</td></tr>
                 <tr><td>Ora fine</td>
                    <td><input type="time" size="20" name="orafine"</td></tr>
                 <tr><td>Posizionamento</td>
                    <td><input type="number" size="20" name="posizionamento"</td></tr>
            </table>
            <br>
            <input type="reset" value"Reset">
            <input type="submit" value="Submit">
        </form>
    </body>
</html>