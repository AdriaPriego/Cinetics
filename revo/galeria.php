<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="author" content="Adria-Iker">

    <!-- Webpage Title -->
    <title>Cinetics</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="css/swiper.css" rel="stylesheet">
	<link href="css/magnific-popup.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!-- Favicon  -->
    <link rel="icon" href="images/favicon.ico">
</head>
<body data-spy="scroll" data-target=".fixed-top">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container">
            
            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Revo</a> -->

            <!-- Image Logo -->
            <!-- <a class="navbar-brand logo-image" href="index.html"><img src="images/logo.svg" alt="alternative"></a>  -->

            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="./home.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="./galeria.php">GALERY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="./formVideo.php">UPLOAD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="./Llibreries/sessioLogout.php">LOGOUT</a>
                    </li>
                </ul>
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
<div class="basic-2 bg-dark-blue">
        <div class="container">
            <div class="row">   
                <div class="col-lg-12">
                <h2 class="h2-heading">VIDEO GALLERY</h2>
<?php
    if(!isset($_COOKIE[session_name()])){
        header('Location: index.php');
        exit;
    }
    else{
        session_start();
        if(!isset($_SESSION['user_id'])){
            header('Location: index.php');
            exit;
        }
        else{
            $username=$_SESSION['username'];
        }
    }
    include("./Llibreries/querysSQL.php");
    $select=selectVideosUsername();
    $select->execute(array(':username'=>$username));
    foreach($select as $fila){
        $urlVideo=$fila['urlhash'];
        echo'<div class="image-container">
                <div class="video-responsive">
                    <video  controls>
                        <source src='.$urlVideo.' type="video/mp4">
                    </video>
                </div>
             </div>';
    }
?>
</div>
</div>
</div>
</body>
<script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
<script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
<script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
<script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
<script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
<script src="js/scripts.js"></script> <!-- Custom scripts -->