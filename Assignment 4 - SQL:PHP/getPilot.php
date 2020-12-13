<html>

  <head>
    <title>Risultati pilota</title>

  </head>

  <body>
  
  <?php
      //ASSEGNAZIONE VARIABILI
      $cf = $_REQUEST["codicefiscale"];
      $cr = $_REQUEST["circuito"];
      
      //CONTROLLO PARAMETRI
      if ($cr == NULL) 
          die("Errore: circuito nullo");
      if (!is_numeric($cr))
          die("Errore: circuito non corretto");
      //CONNESSIONE AL DB
      $connection = mysqli_connect('localhost','root','','GARE');
      if (mysqli_connect_errno()){
          die ('Failed to connect to MySQL: ' . mysqli_connect_error());
      }
      
      //QUERY SQL
      $sql = "SELECT Data, OraInizio, OraFine, Posizionamento
                FROM GARA
                WHERE GARA.CodFisc = '$cf' AND GARA.CodCircuito = '$cr'
                ORDER BY Data, OraInizio ASC";
      
      //ESECUZIONE QUERY
      $result = mysqli_query($connection, $sql);
      if (!$result)
          die ('Query error: ' . mysqli_error($connection));
      
      //HTML CON RISULTATI
      echo "<h2>Gare svolte</h2>";
      echo "<h5> Le gare tenutesi nel circuito $cr a cui il pilota con condice fiscale $cf ha partecipato sono le seguenti</h5>";
      
      //TABELLA CON RISULTATI
      if (mysqli_num_rows($result) > 0) {
          echo "<table border = 1 cellpadding = 7";
          echo "<tr>";
          for ($i = 0; $i < mysqli_num_fields($result); $i++) {
              $title = mysqli_fetch_field($result);
              $name = $title->name;
              echo "<th> $name </th>";
          }
          echo "</tr>";
          
          while ($row = mysqli_fetch_row($result)) {
              echo "<tr>";
              foreach ($row as $cell) {
                  echo "<td>$cell</td>";
              }
              echo"</tr>";
          }
          echo "</table>";
      } else {
          echo "<h4> Nessun risultato</h4>";
      }
      
      //CHIUSURA DELLA CONNESSIONE
      mysqli_close($connection);
  ?>

  </body>
</html>