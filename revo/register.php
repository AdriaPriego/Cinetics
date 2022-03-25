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
	session_start();

	if(isset($_SESSION['user_id'])){
		header('Location: home.php');
		exit;
	}
	include("./Llibreries/querysSQL.php");
	include("./Llibreries/functions.php");
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['user']) && isset($_POST['mail']) && isset($_POST['pass']) && isset($_POST['passVerify'])){
			if($_POST['pass']==$_POST['passVerify'])
			{
				require_once("./Llibreries/connecta_db.php");	
				$userPost=filter_input(INPUT_POST,'user');
				$mailPost=filter_input(INPUT_POST,'mail');
				$fnamePost=filter_input(INPUT_POST,'fname');
				$lnamePost=filter_input(INPUT_POST,'lname');
				$passPost=filter_input(INPUT_POST,'pass');	
				$passVPost=filter_input(INPUT_POST,'passVerify');
				$codeActivacio=hash('sha256',random_int(0,10000));
				$date = setDate();
				$passHash=password_hash($passPost,PASSWORD_DEFAULT);
				$insert=registrarBD();
				$insert->execute(array(':mail'=>$mailPost,':username'=>$userPost,':passHash'=>$passHash,':userFirstName'=>$fnamePost,':userLastName'=>$lnamePost,':creationDate'=>$date ,':active'=>0,':codeActiu'=>$codeActivacio));        
				if(($insert->rowCount())==0){
					$db->rollback();
					error();
				}
				else{
					require_once("./Llibreries/mail.php");	
					$db->commit();
					enviarMail($mailPost,$userPost,$codeActivacio);
					header('Location: index.php');
					exit;
				}
			}
			else{
				error();
			} 
			
		}
		else {
			error();
		}
	} 
	?>
<body data-spy="scroll" data-target=".fixed-top" class="bg-dark-blue">
    <div id="registration" class="form-1">
        <div class="container">
            <div class="row register pad">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>Register</h2>
                        <p>You are just a few clicks away from using the best video reproducer like tinder.</p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-square"></i><div class="media-body"><strong>Easy using</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, et doloremque. Molestias quisquam reprehenderit totam accusantium eos recusandae soluta quo ut, eius ratione nam velit fuga suscipit! Provident, architecto fugiat! </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i><div class="media-body"><strong>Design layouts: </strong> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rerum asperiores culpa totam! Laudantium, nihil asperiores eum facere alias ad unde animi debitis tempora eaque, cumque maxime, non repudiandae fugiat porro!</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i><div class="media-body"><strong>Export to code: </strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique natus veritatis eum amet quam ipsa voluptates, possimus velit! Id nisi sit aut.</div>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6 pad">

                    <!-- Registration Form -->
                    <form id="registrationForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
						<input type="text" class="form-control-input" id="user" name="user" autocomplete="off" required>
                        <label class="label-control">Name</label>
                        </div>
                        <div class="form-group">
                            <input type="mail" class="form-control-input" id="mail" name="mail" autocomplete="off"  required>
                            <label class="label-control">Email</label>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" id="fname" name="fname" autocomplete="off">
                            <label class="label-control">First Name</label>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control-input" id="lname" name="lname" autocomplete="off">
                            <label class="label-control">Last Name</label>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control-input" id="pass" name="pass" autocomplete="off" required>
                            <label class="label-control">Password</label>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control-input" id="passVerify" name="passVerify" autocomplete="off" required>
                            <label class="label-control">Verify Password</label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="form-control-submit-button">SIGN UP</button>
                        </div>
                        
                    </form>
    	
    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
</body>
</html>