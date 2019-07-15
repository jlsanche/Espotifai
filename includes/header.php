<?php

include('includes/config.php');
include('includes/classes/Artist.php');
include('includes/classes/Album.php');
include('includes/classes/Song.php');


//session_destroy();

// if(isset($_SESSION['userLoggedIn'])) {
//     $userLoggedIn = $_SESSION['userLoggedIn'];
// } else {

//     header('location:register.php');
// }
// 
?>

<html>

<head>
    <title>Welcome to Espotify!</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/script.js"> </script>

</head>

<body>


    <div id="mainContainer">

        <div id="topContainer">

            <?php include("includes/navBarContainer.php"); ?>

            <div id="mainViewContainer">

                <div id="mainContent">