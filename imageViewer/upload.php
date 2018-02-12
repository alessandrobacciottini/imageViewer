<?php
include("config.php");
if($_FILES['img'] != "") {
	$uploaddir = "uploads/";//cartella dove vengono caricati i file

	//Recupero il percorso temporaneo del file
	$userfile_tmp = $_FILES['img']['tmp_name'];

	//recupero il nome originale del file caricato
	$userfile_name = $_FILES['img']['name'];
	
	$new_img = $uploaddir . $userfile_name;

	//copio il file dalla sua posizione temporanea alla mia cartella upload
	if (move_uploaded_file($userfile_tmp, $new_img)) {
	  //Se l'operazione è andata a buon fine
	  echo 'File inviato con successo.';
	}else{
	  //Se l'operazione è fallta
	  echo 'Upload NON valido!'; 
	}

	$query_ins="INSERT INTO image_viewer.images (user,image)VALUES ('".$_SESSION['username']."','".$userfile_name."')";
    $query_insert = mysqli_query($connessione_al_server,$query_ins) or die ("Operation failed".mysqli_error()); // se la query fallisce mostrami questo errore
	echo('<script type="text/javascript">
		alert("File caricato correttamente!");
		window.location="main_page2.php";
		</script>');
}

?>