<html>
    <head>
        <title>Risultati inserimento pilota</title>
        
        <style type = "text/css">
            .success{
                text-align: center;
                color: floralwhite;
                background-color: forestgreen;
            }
            .failure{
                text-align: center;
                color: floralwhite;
                background-color: crimson;
            }
        </style>
    </head>
    
    <body>
        <?php
        //ASSEGNAZIONE PARAMETRI
        $cf = $_REQUEST["codicefiscale"];
        $nm = $_REQUEST["nome"];
        $cg = $_REQUEST["cognome"];
        $an = $_REQUEST["annodinascita"];
        $na = $_REQUEST["nazionalita"];
        $sc = $_REQUEST["scuderia"];
        
        //CONTROLLO PARAMETRI
        if(($cf == NULL) or ($nm == NULL) or ($cg == NULL) or ($an == NULL) or ($na == NULL) or ($sc == NULL))
          die("Errore: inserire tutti i dati richiesti");
        
        if(!is_numeric($an))
            die("Errore: inserire tutti i dati nel formato corretto");
        
        //CONNESSIONE AL DB
        $connection = mysqli_connect('localhost','root','','GARE');
        if (mysqli_connect_errno())
            die ('Failed to connect to MySQL: ' . mysqli_connect_error());
        
        //DIABILITA AUTOCOMMIT
        if (mysqli_autocommit($connection,FALSE) == FALSE)
            die ('Failed to autocommit ' . mysqli_error($connection));
        
        //QUERY SQL
        $sql = "INSERT INTO PILOTA VALUES ('$cf', '$nm', '$cg', '$na', '$an', '$sc')";
        $check = "  SELECT CodFisc
                    FROM PILOTA
                    WHERE PILOTA.CodFisc = '$cf'";
        
        //ESECUZIONE QUERY
        $resultcheck = mysqli_query($connection,$check);
        $result = mysqli_query($connection,$sql);
         if(mysqli_num_rows($resultcheck) > 0) {
            die ('<h3 class = failure>Inserimento non completato</h3> <h4>il pilota è già presente nel database</h4>');
            mysqli_rollback($connection);
        }
        if($result) {
            mysqli_commit($connection);
            echo "<h3 class = success>Inserimento completato con successo</h3>";
            echo "<h4>Il pilota $cf è stato inserito nel database</h4>";
        } else {
            die ('<h3 class = failure>Query error: inserimento Fallito<h4>Il pilota non è stato inserito nel database</h4> </h3>' . mysqli_error($connection));
            mysqli_rollback($connection);
        }
        
        //CHIUSRA DELLA CONNESSIONE
        mysqli_close($connection);
        ?>
    </body>
</html>