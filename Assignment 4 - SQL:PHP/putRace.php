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
        $cc = $_REQUEST["codicecircuito"];
        $da = $_REQUEST["data"];
        $oi = $_REQUEST["orainizio"];
        $of = $_REQUEST["orafine"];
        $pos = $_REQUEST["posizionamento"];
        
        //CONTROLLO PARAMETRI
        if(($cf == NULL) or ($cc == NULL) or ($da == NULL) or ($oi == NULL) or ($of == NULL) or ($pos == NULL)) {
          die("Errore: inserire tutti i dati richiesti");
        }
        
        if(!is_numeric($cc) or !is_numeric($pos))
            die("Errore: inserire tutti i dati nel formato corretto");
        
        if($of < $oi)
            die("Errore: l'ora di fine gara è antecedente all'ora di inizio");
        
        //CONNESSIONE AL DB
        $connection = mysqli_connect('localhost','root','','GARE');
        if (mysqli_connect_errno())
            die ('Failed to connect to MySQL: ' . mysqli_connect_error());
        
        //DIABILITA AUTOCOMMIT
        if (mysqli_autocommit($connection,FALSE) == FALSE)
            die ('Failed to autocommit ' . mysqli_error($connection));
        
        //QUERY SQL
        $sql = "INSERT INTO GARA VALUES ('$cf', '$cc', '$da', '$oi', '$of', '$pos')";
        $check = "  SELECT CodFisc
                    FROM GARA
                    WHERE GARA.CodFisc = '$cf' AND GARA.CodCircuito = '$cc' AND GARA.Data = '$da' AND GARA.OraInizio = '$oi'";
        
        //ESECUZIONE QUERY
        $resultcheck = mysqli_query($connection,$check);
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($resultcheck) > 0) {
            die ('<h3 class = failure>inserimento non completato</h3> <h4>il pilota ha già una partecipazione registrata per questa gara</h4>');
            mysqli_rollback($connection);
        }
        if($result) {
            mysqli_commit($connection);
            echo "<h3 class = success>Inserimento completato con successo</h3>";
            echo "<h4>La gara del pilota $cf è stata inserita nel database</h4>";
        }else {
            die ('<h3 class = failure>Query error: Inserimento Fallito </h3>' . mysqli_error($connection));
            mysqli_rollback($connection);
        }
        
        //CHIUSRA DELLA CONNESSIONE
        mysqli_close($connection);
        ?>
    </body>
</html>