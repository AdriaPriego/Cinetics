<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="author" content="Adria-Iker">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
	<meta property="og:site_name" content="" /> <!-- website name -->
	<meta property="og:site" content="" /> <!-- website link -->
	<meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
	<meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
	<meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
	<meta property="og:url" content="" /> <!-- where do you want your post to link to -->
	<meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter -->

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
        include("./Llibreries/querysSQL.php");
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            if(isset($_GET['id']) && isset($_GET['like']))
            {
                $id=$_GET['id'];
                $like=$_GET['like'];
                if($like==1){
                    $update=insertLikes();
                    $update->execute(array(':urlhash'=>$id));
                }
                else if($like==0){
                    $update=insertDislikes();
                    $update->execute(array(':urlhash'=>$id));
                }
            }
        }
    }
}
?>
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
                        <a class="nav-link page-scroll" href="#">HOME</a>
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
                    <?php
                     $select=videoAleatorio();
                     $select->execute();
                     if(($select->rowCount())>0){
                        foreach($select as $fila){
                            $titulo=$fila['title'];
                            $descripcio=$fila['descripcio'];
                            $tags=$fila['tags'];
                            $urlhash=$fila['urlhash'];
                            $likes=$fila['likes'];
                            $dislikes=$fila['dislikes'];
                        }
                        if($likes != 0 || $dislikes != 0){
                            $puntuacio=round($likes/($likes+$dislikes)*100,2);
                        }
                        else $puntuacio=0;
                        echo'
                        <h2 class="h2-heading">'.$titulo.'</h2>
                        <!-- Video Preview -->
                        <div class="image-container">
                            <div class="video-responsive">
                                <video  controls>
                                    <source src='.$urlhash.' type="video/mp4">
                                </video>
                            </div> <!-- end of video-wrapper -->
                        </div> <!-- end of image-container -->
                        <!-- end of video preview -->
                        <div id ="valoracio">
                        <p class="pad">'.$dislikes.'<a id="dislike" href="./home.php?like=0&id='.$urlhash.'" class="fa fa-thumbs-down margindislike"></a>'.$puntuacio.'<a id="like" href="./home.php?like=1&id='.$urlhash.'" class="fa fa-thumbs-up marginlike"></a>'.$likes.'</p>
                    </div> <!-- end of col -->';
                     }
                     else{
                        echo'
                        <h2 class="h2-heading">TITULO DEL VIDEO</h2>
                        <!-- Video Preview -->
                        <div class="image-container">
                            <div class="video-responsive">
                                <video  controls>
                                    <source src="vid/10 segundos.mp4" type="video/mp4">
                                    <source src="movie.ogg" type="video/ogg">
                                </video>
                            </div> <!-- end of video-wrapper -->
                        </div> <!-- end of image-container -->
                        <!-- end of video preview -->
                    ';
                }
                ?>
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of basic-2 -->
    </div>
    <!-- end of video -->
<!-- Video -->
              
<!-- Testimonials -->
<div class="slider-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                echo'<div id = "info">
                        <p>'.$descripcio.'</p>
                        <p>'.$tags.'</p>
                    </div>'
                ?>    
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of slider-1 -->
<!-- end of testimonials -->
    	
    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
</body>
</html>