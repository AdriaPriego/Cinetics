<!DOCTYPE html>
<html>
<head>
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
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
		include("./Llibreries/querysSQL.php");
		include("./Llibreries/functions.php");
		if(isset($_POST['tvideo']) && isset($_FILES['video'])){
			$username = $_SESSION['username'];
			$title = $_POST['tvideo'];
			$description = $_POST['dvideo'];
			$etq = $_POST['etqvideo'];
			$title=filter_input(INPUT_POST,'tvideo');
			$description=filter_input(INPUT_POST,'dvideo');
			$etq=filter_input(INPUT_POST,'etqvideo');
			$videoName=uploadVideo();
			$date=setDate();
			$insert=registrarVideoBD();
			$insert->execute(array(':username'=>$username,':title'=>$title,':descripcio'=>$description,':tags'=>$etq,':urlhash'=>$videoName,':fechaCreacio'=>$date));        
			if(($insert->rowCount())==0){
				//Anulem transacció
				error();
			}
			else{
				//Ha anat bés
				header('Location: home.php');
				exit;
			}
		}    
		else {
			error();
		}	
	}
?>
<body data-spy="scroll" data-target=".fixed-top" class="bg-dark-blue">
<nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container">
            
            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="./index.php">HOME</a>
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
<div class="container col-lg-4 baja">
	<div class="register">
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" class="pad" style="margin: 0px;">
			<h3>UPLOAD</h3>
			<br>
			<div class="form-group">
				<input type="text" class="form-control-input" id="tvideo" name="tvideo" autocomplete="off" required>
				<label class="label-control">Title</label>
			</div>

			<div class="form-group">
				<input type="text" class="form-control-input" id="dvideo" name="dvideo" autocomplete="off" required>
				<label class="label-control">Description</label>
			</div>
			
			<div class="form-group">
				<input type="text" class="form-control-input" id="etqvideo" name="etqvideo" autocomplete="off" required>
				<label class="label-control">Tags with #</label>
			</div>
	
			<input type="file" id="video" name="video" required class="btn">
			<div class="form-group">
				<input type="submit" value="Upload" class="btn float-right login_btn">
			</div>
		</form>
	</div>
</div>
	<script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
	<script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
	<script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
	<script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
	<script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
	<script src="js/scripts.js"></script> <!-- Custom scripts -->
</body>
</html>