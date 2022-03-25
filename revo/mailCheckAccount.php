<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
    include("./Llibreries/querysSQL.php");
    include("./Llibreries/functions.php");
    $codeActivacio=$_GET["code"];
    $mail=$_GET["mail"];
    $data=setDate();
    $select=selectUserName();
    $select->execute(array(':username'=>$mail));
    
    foreach ($select as $fila) {
        $codeBD=$fila['activationCode'];
    }

    if(strcmp($codeActivacio,$codeBD)==0){
        $update=updActivateUser();
        $update->execute(array(':mail'=>$mail,':fecha'=>$data));
    }
    else error();
    header('Location: index.php');
    exit;
?>