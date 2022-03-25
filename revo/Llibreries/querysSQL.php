<?php
    use PHPMailer\PHPMailer\PHPMailer;
	//require_once("connecta_db.php");

    function selectUserName(){
        include("connecta_db.php");
        $sql = "SELECT * FROM users WHERE username=:username OR mail=:username";
        $select=$db->prepare($sql);
        return $select;
    }
    //$selectAll = "SELECT * FROM users WHERE username=:username OR mail=:username";
    //$mostraUser=$db->prepare($selectAll);

    function selectUserMail(){
        include("connecta_db.php");
        $sql = "SELECT username,mail FROM users WHERE username=:username OR mail=:username";
        $select=$db->prepare($sql);
        return $select;
    }
    //$selectUserMail = "SELECT username,mail FROM users WHERE username=:username OR mail=:username";
    //$mostraUserMail=$db->prepare($selectUserMail);

    function selectExpDate(){
        include("connecta_db.php");
        $sql = "SELECT resetPassExpiry FROM users WHERE mail=:username";
        $select=$db->prepare($sql);
        return $select;
    }
    //$selectExpdate = "SELECT resetPassExpiry FROM users WHERE mail=:username";
    //$mostrarExpdate = $db->prepare($selectExpdate);

    function updDateUser(){
        include("connecta_db.php");
        $db->beginTransaction();
        $sql = "UPDATE users SET lastSignIn = :fecha WHERE username=:username OR mail=:username";
        $update=$db->prepare($sql);
        return $update;
    }
    //$updUser = "UPDATE users SET lastSignIn = :fecha WHERE username=:username OR mail=:username";
    //$update = $db->prepare($updUser);

    function updActivateUser(){
        include("connecta_db.php");
        $sql = "UPDATE users SET  activationCode=null, activationDate=:fecha, active=1 WHERE mail=:mail";
        $update=$db->prepare($sql);
        return $update;
    }
    //$updUser = "UPDATE users SET  activationCode=null, activationDate=:fecha, active=1 WHERE mail=:mail";
    //$ActivarUser = $db->prepare($updUser);

    function updUserResCode(){
        include("connecta_db.php");
        $db->beginTransaction();
        $sql = "UPDATE users SET resetPassCode = :codeReset, resetPassExpiry=:fecha WHERE mail=:mail";
        $update=$db->prepare($sql);
        return $update;
    }
    //$updUser = "UPDATE users SET resetPassCode = :codeReset, resetPassExpiry=:fecha WHERE mail=:mail";
    //$SetResCode = $db->prepare($updUser);

    function updPasswd(){
        include("connecta_db.php");
        $db->beginTransaction();
        $sql = "UPDATE users SET passHash = :passHash, resetPassCode = NULL, resetPassExpiry=NULL WHERE mail=:mail";
        $update=$db->prepare($sql);
        return $update;
    }
    //$updPass = "UPDATE users SET passHash = :passHash, resetPassCode = NULL, resetPassExpiry=NULL WHERE mail=:mail";
    //$ActualizarPassword = $db->prepare($updPass);

    function updClearPasswd(){
        include("connecta_db.php");
        $db->beginTransaction();
        $sql = "UPDATE users SET resetPassCode = NULL, resetPassExpiry = NULL WHERE mail=:mail";
        $update=$db->prepare($sql);
        return $update;
    }
    //$updClearPass = "UPDATE users SET resetPassCode = NULL, resetPassExpiry = NULL WHERE mail=:mail";
    //$NetejarPassword = $db->prepare($updClearPass);
    
    function registrarBD(){
        include("connecta_db.php");
        $db->beginTransaction();
        $sql = "INSERT INTO users(mail,username,passHash,userFirstName,userLastName,creationDate,active,activationCode) 
        VALUES(:mail,:username,:passHash,:userFirstName,:userLastName,:creationDate,:active,:codeActiu)";
        $insert=$db->prepare($sql);
        return $insert;
    }
    function registrarVideoBD(){
        include("connecta_db.php");
        $sql = "INSERT INTO videos(username,title,descripcio,tags,urlhash,fechaCreacio) VALUES(:username,:title,:descripcio,:tags,:urlhash,:fechaCreacio)";
        $insert=$db->prepare($sql);
        return $insert;
    }

    function videoAleatorio(){
        include("connecta_db.php");
        $sql = "SELECT * FROM videos ORDER BY RAND() LIMIT 1";
        $select=$db->prepare($sql);
        return $select;
    }

    function selectVideosUsername(){
        include("connecta_db.php");
        $sql = "SELECT urlhash FROM videos WHERE username=:username";
        $select=$db->prepare($sql);
        return $select;
    }

    function insertLikes(){
        include("connecta_db.php");
        $sql="UPDATE videos SET likes = likes+1 WHERE urlhash = :urlhash";
        $update=$db->prepare($sql);
        return $update;
    }
    function insertDislikes(){
        include("connecta_db.php");
        $sql="UPDATE videos SET dislikes = dislikes+1 WHERE urlhash = :urlhash";
        $update=$db->prepare($sql);
        return $update;
    }
?>