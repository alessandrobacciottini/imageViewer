<?php
include("config.php"); // Include il file di connessione al database
error_reporting(E_ERROR | E_NOTICE);

$query= ("SELECT * FROM users WHERE user='".$_POST["user"]."' AND password ='".$_POST["psw"]."'");
$query_login = mysqli_query($connessione_al_server,$query) or die ("Login non riuscito".mysqli_error($connessione_al_server));
if(mysqli_num_rows($query_login)>0){
	while ($row = mysqli_fetch_array($query_login)) {
		//creazione variabile $_SESSION
		$_SESSION['username']= $row['user'];
	}
	if(isset($_SESSION['username'])){
		header("location:main_page2.php"); 
}
}else{
	$_SESSION['error_log']="Error Log";
	header("location:index.php");
    echo "non ti sei registrato con successo"; 
	
}


?>
