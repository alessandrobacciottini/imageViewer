<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
//unset di tutti i cookie
unset($_SESSION);

	header("location: index.php"); // Redirecting To Home Page

?>
