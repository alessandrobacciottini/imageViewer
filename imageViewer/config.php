<?php
session_start();
$username = "root";
$password = "";
$host="localhost";
$dbname = "image_viewer";

$connessione_al_server= mysqli_connect($host, $username, $password) or die("Errore di Connessione!!");
if(!$connessione_al_server){
die ('Non riesco a connettermi: errore '.mysqli_error()); // questo apparirà solo se ci sarà un errore
}
 
$db_selected=mysqli_select_db($connessione_al_server,$dbname); 
if(!$db_selected){
die ('Errore nella selezione del database: errore '.mysqli_error()); // se la connessione non andrà a buon fine apparirà questo messaggio
}

?>
