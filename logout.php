<?php

//Include constants.php
include('includes/config.php');
// Destroy the session and redirect to login page

session_destroy(); //Unsets $_SESSION['user']
header("location:login.php");



?>