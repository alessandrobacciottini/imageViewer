<?php
if (isset($_GET['action']) && !empty($_GET['action'])) {
    $action = $_GET['action'];    
    if ($action =="calc_exif") {
		$imggg=$_GET['imgSel'];
		$imgg=explode('imageViewer/', $imggg)[1];
		if(is_callable("exif_read_data")){	
			$exif = exif_read_data($imgg);
			if(array_key_exists("GPSLatitude",$exif) && array_key_exists("GPSLatitudeRef",$exif) && array_key_exists("GPSLatitude",$exif) && array_key_exists("GPSLongitude",$exif) && array_key_exists("GPSLongitudeRef",$exif)){
				$latitude = gps($exif["GPSLatitude"], $exif["GPSLatitudeRef"]);
				$longitude = gps($exif["GPSLongitude"], $exif["GPSLongitudeRef"]);
				$exif["GPSLatitude"]=$latitude;
				$exif["GPSLongitude"]=$longitude;
				$exif["MapLink"]='<a href="https://www.google.com/maps/search/?api=1&query='.$latitude.','.$longitude.'" target="_blank" > Link to map</a>';
				
			}

			
		}
		echo json_encode($exif);
    } 
    else{
        echo 'invalid action ' . $action;
    }
}
function gps($coordinate, $hemisphere) {
  if (is_string($coordinate)) {
    $coordinate = array_map("trim", explode(",", $coordinate));
  }
  for ($i = 0; $i < 3; $i++) {
    $part = explode('/', $coordinate[$i]);
    if (count($part) == 1) {
      $coordinate[$i] = $part[0];
    } else if (count($part) == 2) {
      $coordinate[$i] = floatval($part[0])/floatval($part[1]);
    } else {
      $coordinate[$i] = 0;
    }
  }
  list($degrees, $minutes, $seconds) = $coordinate;
  $sign = ($hemisphere == 'W' || $hemisphere == 'S') ? -1 : 1;
  return $sign * ($degrees + $minutes/60 + $seconds/3600);
}
?>
