<?php
include("config.php"); // includo il file di connessione al database
$us_reg=$_POST["user_reg"];
$psw_reg=$_POST["psw_reg"];





$query_reg="INSERT INTO image_viewer.users (user,password)VALUES ('".$us_reg."','".$psw_reg."')";
$query_registrazione = mysqli_query($connessione_al_server,$query_reg) or die ("Operation failed".mysqli_error()); // se la query fallisce mostrami questo errore


$_SESSION['username']= $us_reg;
echo('<script type="text/javascript">
		alert("Utente registrato!");
		window.location="index.php";
		</script>');

//header("location:index.php");


/* if(isset($query_registrazione)){ //se la reg è andata a buon fine
$_SESSION["logged"]=true; //restituisci vero alla chiave logged in SESSION
}else{
//
header('location:registrazione.php?');

//
} */
//
//}
?>