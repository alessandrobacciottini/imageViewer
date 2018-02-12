<?php


?>



<?php
include("config.php"); // includere la connessione al database
header( "Access-Control-Allow-Headers: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT ");
if (isset ($_SESSION['username'])){
  $user = $_SESSION['username'];	
}

if(isset($_SESSION['out'])){
	$status_logout = $_SESSION['out'];
}else{
	$status_logout = 'NO';
}

if(isset($_SESSION['error_log'])){
	$status_login = $_SESSION['error_log'];
}

/* if (isset ($_SESSION['role'])){
  $role_att = $_SESSION['role'];	
}else{
 $role_att= "";	
} */

// query al database per selezionare le immagini caricate dall'utente loggato 
	$link = mysqli_connect($host, $username, $password) or die("failed to connect to server !!");

	$queryImages = " SELECT image FROM  image_viewer.images WHERE image_viewer.images.user = '".$_SESSION['username']."' ";
	$result = mysqli_query($link, $queryImages) or die(mysqli_error($link));
/* 	if ($result->num_rows > 0){
		echo('ok');
	} */



?>



<html>  
<head>
<meta charset="utf-8">
<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->


<style type="text/css">

li{
    list-style-type:none;
    margin-right:10px;
    margin-bottom:10px;
}
.myImg{
	width:200px;
	height:200px;
}
img:hover {
	opacity: 0.7;
}

.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
	max-width:512px;
	height:auto;
	max-width: 512px;
	width:auto;

	
}

/* rotation of Modal Image */
.rotate {
    position: absolute;
    top: 15px;
    left: 35px;
    font-weight: bold;
}

/* zoom+ of Modal Image */
.zoomin {
    position: absolute;
    top: 15px;
    left: 95px;
    font-weight: bold;
}

/* zoom- of Modal Image */
.zoomout {
    position: absolute;
    top: 15px;
    left: 165px;
    font-weight: bold;
}


/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}

.myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.myImg:hover {opacity: 0.7;}


</style>
</head>


<body>

	<p>User: <?=$user;?> </p>
		<button><a href="logout.php">Logout</a></button>
	<form name="form_logout" method="post" action="logout.php">	</form>



	
	<form method="post" action="upload.php" enctype="multipart/form-data">
		Scegli il file: <input id="img" type="file" name="img" accept="image/*"> <input type="submit" value="Go" name="go">
	</form>
	
	<h2>User's gallery</h2>
	
	<ul>
		<?php
			$dirname = "uploads/";
		    if ($result->num_rows > 0) {
				$count=0;
				while ($row = mysqli_fetch_array($result)) {
					$count=$count+1;
					$imgName=$row['image'];
					list($width, $height) = getimagesize($dirname.$imgName);

					$ignore = Array(".", "..");
					if(!in_array($imgName, $ignore)) {
						echo "<li><img class='myImg' id='myImg".$count."' name='imgModal".$count."' src='".$dirname.$imgName."' alt='' onclick='selectModal(this,".$count.")'/></li> </br> ";
						echo "
								<!-- The Modal -->
								<div id='imgModal".$count."' class='modal'>
								  <span class='close'>&times;</span>
								<!--  <img class='modal-content' width='".$width."' height='".$height."' id='img".$count."' > -->
								<img class='modal-content'  id='img".$count."' >

									  <div  class='modal-footer'>
										<button id='rotation' type='button' class='rotate' data-dismiss='modal'>Rotate</button>
									<!--	<button id='zoomin' type='button' class='zoomin' data-dismiss='modal'>Zoom +</button>
										<button id='zoomout' type='button' class='zoomout' data-dismiss='modal'>Zoom -</button>  -->

									  </div>
								</div>
								";

					}
				}  
			}				
    ?>
	
	</ul>
	

	
	
	
	
	
	<script>
// Get the modal
var modalSelected = false;
var selImg=null;
var countRot=1;
var zoom_in=0;
var zoom_out=0;


function selectModal(element,count){
	var name=element.getAttribute("name");
	var id=element.getAttribute("id");
	var modal = document.getElementById(name);
	document.onkeypress = processKey;



// Get the image and insert it inside the modal - use its "alt" text as a caption
	var img = document.getElementById(id);
	var idModalImg = 'img'+count;
	var modalImg = document.getElementById(idModalImg);
	var captionText = document.getElementById("caption");
    modal.style.display = "block";
    modalImg.src = img.src;
    //captionText.innerHTML = this.alt;
    modalSelected=true;
	selImg=count;
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[count-1];
	var rotate = document.getElementsByClassName("rotate")[count-1];
	//var zoomin = document.getElementsByClassName("zoomin")[count-1];
	//var zoomout = document.getElementsByClassName("zoomout")[count-1];



// When the user clicks on <span> (x), close the modal
	span.onclick = function() { 
		modal.style.display = "none";
		//annullo lo zoom
/* 		zoom_in=0;
		zoom_out=0;
		var img='img'+selImg;
		var currentImg = document.getElementById(img);
		zoom=1;
		var newHeight=currentImg.getAttribute("height")*zoom;
		var newWidth=currentImg.getAttribute("width")*zoom;
		currentImg.style.height=newHeight;
		currentImg.style.width=newWidth; */
		
		modalSelected=false;
		selImg=null;
		countRot=1;


	}
	
	rotate.onclick = function() { 
		var img='img'+selImg;
		var currentImg = document.getElementById(img);
		var deg=90*countRot;
		countRot=countRot+1;
 		currentImg.style.transform="rotate("+deg+"deg)"; 
	}
	
/* 	zoomin.onclick = function() { 
		var img='img'+selImg;
		var currentImg = document.getElementById(img);
		zoom_in=zoom_in+25;
		zoom=1+zoom_in/100-zoom_out/100;
		var newHeight=currentImg.getAttribute("height")*zoom;
		var newWidth=currentImg.getAttribute("width")*zoom;
		currentImg.style.height=newHeight;
		currentImg.style.width=newWidth;
	}
	
	zoomout.onclick = function() { 
		var img='img'+selImg;
		var currentImg = document.getElementById(img);
		zoom_out=zoom_out+25;
		zoom=1-zoom_out/100+zoom_in/100;
		var newHeight=currentImg.getAttribute("height")*zoom;
		var newWidth=currentImg.getAttribute("width")*zoom;
		currentImg.style.height=newHeight;
		currentImg.style.width=newWidth;
	}
	 */

}
function processKey(e)
{
    if (null == e)
        e = window.event ;
    if (e.keyCode == 88 && modalSelected==true)  {
        //document.getElementById("myModal").click();
        
		var img='img'+selImg;
		var currentImg = document.getElementById(img);
		var deg=90*countRot;
		countRot=countRot+1;
 		currentImg.style.transform="rotate("+deg+"deg)"; 
		//alert(currentImg);

		

    }
}



</script>
	
	
	

<body>


</html>