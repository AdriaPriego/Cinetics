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
    <?php
        if(!isset($_GET['mail'])){
            header('Location: index.php');
            exit;
        }
    	include("./Llibreries/querysSQL.php");
        include("./Llibreries/functions.php");

        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $userMail=$_GET['mail'];
            $select=selectExpDate();
            $select->execute(array('username'=>$userMail));
            foreach ($select as $fila) {
				$final=$fila['resetPassExpiry'];
			}
            if(isset($final) && $final>setDate()){
                setcookie("ID",$userMail,time()+1800);
            }
            else{
                $update=updClearPasswd();
                $update->execute(array(':mail'=>$userMail));
                errorPass();
            }
        }
        else if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['pass']) && isset($_POST['passVerify']) && isset($_COOKIE["ID"])){
                if($_POST['pass']==$_POST['passVerify']){
                    $userMail=$_COOKIE["ID"];
                    $passPost=filter_input(INPUT_POST,'pass');
				    $passVPost=filter_input(INPUT_POST,'passVerify');
                    $passHash=password_hash($passPost,PASSWORD_DEFAULT);
                    $update=updPasswd();
                    $update->execute(array(':mail'=>$userMail,':passHash'=>$passHash));
                    $select=selectUserName();
                    $select->execute(array(':username'=>$userMail)); 
                    foreach ($select as $fila) {
                        $userName=$fila['username'];
                    }
                    enviarMail($userMail,$userName,null,true);
                    header('Location: ./Llibreries/sessioLogout.php');
                }
            }
        }
    ?>
    <body data-spy="scroll" data-target=".fixed-top" class="bg-dark-blue">
    <div class="container col-lg-4 baja">
		<div class="register">
            
                    <div class="col-lg-12">
                    <h2 class="h2-heading">Reset Password</h2>
                    <div class="card-body">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="form-group">
                                <input type="text" class="form-control-input" id="pass" name="pass" autocomplete="off" required>
                                <label class="label-control">New Password</label>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control-input" id="passVerify" name="passVerify" autocomplete="off" required>
                                <label class="label-control">Confirm Password</label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="form-control-submit-button">CONFIRM</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>