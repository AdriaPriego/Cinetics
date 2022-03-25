<?php
    use PHPMailer\PHPMailer\PHPMailer;
    function enviarMail($correoCli,$username,$code = null,$passwdConfirm = null){
        require './vendor/autoload.php';    
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'adria.priegog@educem.net';
        $mail->Password = 'Sftrd123a';
        //Dades del correu electrònic
        $mail->SetFrom('no-reply@cinetics.com','no-reply');
        if(isset($code)){
            $mail->Subject = 'Confirm your mail account';
            $mail->MsgHTML(messageMail($username,$correoCli,$code));        
        }
        else if(isset($passwdConfirm)){
            $mail->Subject = 'Your password has been changed';
            $mail->MsgHTML(messagePassCnfr($username,$correoCli));
        }
        else{
            $mail->Subject = 'Reset your password';
            $mail->MsgHTML(messagePass($username,$correoCli));
        }
        
        //Destinatari
        $mail->AddAddress($correoCli, $username);

        //Enviament
        $result = $mail->Send();
    }
    function messageMail($username,$mail,$code){
        $message  = "<html><body>";
        $message .= "<table width='100%' bgcolor='#E0E0E0' cellpadding='0' cellspacing='0' border='0'>";
        $message .= "<tr><td>";
        $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
        $message .= "<thead>
            <tr height='80'>
            <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #BDBDBD; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Verify Email</th>
            </tr>
            </thead>";
        $message .= "<tbody>
            <tr>
            <td colspan='4' style='padding:15px;'>
            <p style='font-size:20px;'><a href='https://postimages.org/' target='_blank'><img src='https://i.postimg.cc/fRXFqYT1/favicon.png' border='0' alt='favicon'/></a> Hi ".$username." </p>
            
            <hr />
            <p style='font-size:25px;'>Now you can verify your Email</p>
            <a href='http://localhost/revo/mailCheckAccount.php?code=".$code."&mail=".$mail."' style='font-size:15px;' align='center' 'font-family:Verdana, Geneva, sans-serif;'>Active your account Now!</a>
            </td>
            </tr>
            </tbody>";
        $message .= "</table>";
        $message .= "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";
        return $message;
    }
    function messagePass($username,$mail){
        $message  = "<html><body>";
        $message .= "<table width='100%' bgcolor='#E0E0E0' cellpadding='0' cellspacing='0' border='0'>";
        $message .= "<tr><td>";
        $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
        $message .= "<thead>
            <tr height='80'>
            <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #BDBDBD; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Verify Email</th>
            </tr>
            </thead>";
        $message .= "<tbody>
            <tr>
            <td colspan='4' style='padding:15px;'>
            <p style='font-size:20px;'>Hi ".$username."</p>
            <hr />
            <p style='font-size:25px;'>Click the link to reset your password</p>
            <p style='font-size:20px;'><a href='https://postimages.org/' target='_blank'><img src='https://i.postimg.cc/fRXFqYT1/favicon.png' border='0' alt='favicon'/></a></p>
            <a href='http://localhost/revo/resetPassword.php?mail=".$mail."' style='font-size:15px;' align='center' 'font-family:Verdana, Geneva, sans-serif;'>I want to Reset My Password</a>
            </td>
            </tr>
            </tbody>";
        $message .= "</table>";
        $message .= "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";
        return $message;
    }
    function messagePassCnfr($username,$mail){
        $message  = "<html><body>";
        $message .= "<table width='100%' bgcolor='#E0E0E0' cellpadding='0' cellspacing='0' border='0'>";
        $message .= "<tr><td>";
        $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
        $message .= "<thead>
            <tr height='80'>
            <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #BDBDBD; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Verify Email</th>
            </tr>
            </thead>";
        $message .= "<tbody>
            <tr>
            <td colspan='4' style='padding:15px;'>
            <p style='font-size:20px;'>Hi ".$username."</p>
            <hr />
            <p style='font-size:25px;'>Your password has been changed</p>
            <p style='font-size:20px;'><a href='https://postimages.org/' target='_blank'><img src='https://i.postimg.cc/fRXFqYT1/favicon.png' border='0' alt='favicon'/></a></p>
            </td>
            </tr>
            </tbody>";
        $message .= "</table>";
        $message .= "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";
        return $message;
    }