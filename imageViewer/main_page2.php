
<?php
include("config.php"); // includere la connessione al database
header( "Access-Control-Allow-Headers: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT ");
if (isset ($_SESSION['username'])){
  $user = $_SESSION['username'];	
}

?>



<html>  
<head>
<meta charset="utf-8">
<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/controller.js" type="text/javascript"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	        <link href="css/bootstrap.css" rel="stylesheet">
			<link href="css/style.css" rel="stylesheet">



</head>


<body>
    <h2>Utente registrato</h2>
	<p>User: <?=$user;?> </p>
		<button><a href="logout.php">Logout</a></button>
	<form name="form_logout" method="post" action="logout.php">	</form>



	<h2>Carica immagine</h2>

	<form method="post" action="upload.php" enctype="multipart/form-data">
		Scegli il file: <input id="img" type="file" name="img" accept="image/jpeg"> <input type="submit" value="Go" name="go">
	</form>
	
	<h2>Galleria dell'utente</h2>
	<h4>Premere su un'immagine per entrare nel viewer</h4>
	
	<div id="user_gallery">
		<!-- la gallery sarà riempita dal controller,nell'evento di caricamento della pagina  -->
	</div>
		

<body>


</html>