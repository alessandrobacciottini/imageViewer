<?php
include 'config.php';

$link = mysqli_connect($host, $username, $password) or die("failed to connect to server !!");
mysqli_set_charset($link, 'utf8');
mysqli_select_db($link, $dbname);
$action = $_GET['action'];

$us=$_SESSION['username'];

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $action = $_GET['action'];
    
    if ($action =="get_files") {

		$queryImages = " SELECT user,image FROM  image_viewer.images WHERE image_viewer.images.user = '".$_SESSION['username']."' ";
        $result2 = mysqli_query($link, $queryImages) or die(mysqli_error($link));
        $files_list = array();
        if ($result2->num_rows > 0) {
            while ($row2 = mysqli_fetch_array($result2)) {
                $files= array(
					 "file" => array(
						"user" => $row2['user'],
						"image" => $row2['image']
					 )
                );
                array_push($files_list, $files);
            }
        }
        mysqli_close($link);
        echo json_encode($files_list);
    } 

    
    else{
        echo 'invalid action ' . $action;
    }
}
