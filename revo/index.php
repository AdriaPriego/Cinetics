<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="author" content="Adria-Iker">

    <!-- Webpage Title -->
    <title>Cinetics</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/fontawesome-all.css" rel="stylesheet">
    <link href="./css/swiper.css" rel="stylesheet">
	<link href="./css/magnific-popup.css" rel="stylesheet">
	<link href="./css/styles.css" rel="stylesheet">
    <link rel="icon" type="image/ico" href="./images/favicon.ico"/>

</head>
<?php
	session_start();
	
	if(isset($_SESSION['user_id'])){
		header('Location: home.php');
		exit;
	}
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		include("./Llibreries/functions.php");
		if(isset($_POST['password'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			include("./Llibreries/querysSQL.php");
			$select=selectUserName();
			$select->execute(array(':username'=>$username)); 
			foreach ($select as $fila) {
				$passSelect=$fila['passHash'];
				$idUser=$fila['iduser'];
				$active=$fila['active'];
				$nombreUsuario=$fila['username'];
			}
			if(empty($active))$active=null; 
			if($active==1){
				if (password_verify($password,$passSelect)) {
					$date=setDate();
					$update=updDateUser();
					$update->execute(array(':username'=>$username,':fecha'=>$date));
					if($update){
						session_start();    
						$_SESSION['user_id'] = $idUser;
						$_SESSION['username'] = $nombreUsuario;
						header('Location: ./home.php');
						exit;    
					}else{
						print_r( $db->errorinfo());
					}
				} 
			}    
			else {
				error();
			}	
		}
		else if(isset($_POST['username'])){
			include("./Llibreries/querysSQL.php");
			include("./Llibreries/mail.php");
			$username = $_POST['username'];
			$select=selectUserMail();
			$select->execute(array(':username'=>$username));
			$codeReset=hash('sha256',random_int(0,10000));
			foreach($select as $fila){
				$nombreUsuario=$fila['username'];
				$mailUsuario=$fila['mail'];
			}
			$fecha = new DateTime();
			$fecha -> modify('+30 minute');
			$fecha=$fecha->format('Y-m-d H:i:s');
			$update=updUserResCode();
			$update->execute(array(':mail'=>$mailUsuario,':codeReset'=>$codeReset,':fecha'=>$fecha));
			enviarMail($mailUsuario,$nombreUsuario);
		}
		else {
			error();
		}
	}
?>
<body data-spy="scroll" data-target=".fixed-top" class="bg-dark-blue">
	<div class="container col-lg-4 baja">
		<div class="register">
			<div>
				
				<!-- Registration Form -->
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="pad" style="margin: 0px;">
					<h3 >Login</h3>
					<br>
					<div class="form-group">
						<input type="text" class="form-control-input" id="username" name="username" autocomplete="off" required>
						<label class="label-control">Name</label>
					</div>

					<div class="form-group">
						<input type="password" class="form-control-input" id="password" name="password" autocomplete="off" required>
						<label class="label-control">Password</label>
					</div>
					<div class="form-group">
						<button type="submit" class="form-control-submit-button">SIGN UP</button>
					</div>
					<div class="media-body">Don't have an account? <strong><a href="./register.php">Sign Up</a></strong>
					<div class="media-body"><strong><a href="#" data-toggle="modal" data-target="#ModalForgot">Forgot Password?</a></strong></div>
				</form>
				
				<!-- MODAL -->
				<div class="modal fade" id="ModalForgot" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
						<div class=" modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content register">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Insert your username/email</h5>
								</div>
								<div class="modal-body">
									<input type="text" class="form-control" id="mailf" name="username" autocomplete="off" required>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<input type="submit" value="Send" class="btn float-right login_btn">
								</div>
							</div>
						</div>
					</form>
				</div>
				<!-- END MODAL -->
			</div>
		</div>
	</div>
    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
</body>
</html>