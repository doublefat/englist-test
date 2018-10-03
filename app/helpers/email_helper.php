<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of email_helper
 *
 * @author minfang
 */
include_once __PROJECT_ROOT__ . '/lib/phpmailer/PHPMailerAutoload.php';

class email_helper {

    public static function send($toWhos, $subject, $content){
        if(__EMAIL_PHP_MAIL_FUNCTION__){
            MLog::d("use mail funciton");
            return email_helper::phpMailSend($toWhos, $subject, $content);
        }
        else{
              MLog::d("use authSend funciton");
            return email_helper::authSend($toWhos, $subject, $content);
        }
    }
    //put your code here
    public static function authSend($toWhos, $subject = "", $content = "") {
        $mail = new PHPMailer();
        $mail->CharSet='UTF-8';
        $mail->IsSMTP(); // send via SMTP

        $mail->Host = "ssl://" . __EMAIL_SMTP_SERVER__;
        $mail->Port = __EMAIL_SMTP_PORT__;


        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Username = __EMAIL_SMTP_USER__; // SMTP username
        $mail->Password = __EMAIL_SMTP_PASSWORD__; // SMTP password
        $webmaster_email = __EMAIL_ADDRESS__; //Reply to this email ID


        $mail->From = $webmaster_email;
        $mail->FromName = "system admin";

        foreach ($toWhos as $email => $name) {
            $mail->AddAddress($email, $name);
        }
        $mail->AddReplyTo($webmaster_email, "Web admin");
        $mail->WordWrap = 50; // set word wrap

       
//$mail->AddAttachment("f:/php_errors.log"); // attachment
//; // attachment

        $mail->IsHTML(true); // send as HTML
        $mail->Subject = $subject;
        $mail->Body = $content;
        $mail->AltBody = $content; //Text Body
        if (!$mail->Send()) {
            MLog::e("Mailer Error: " . $mail->ErrorInfo);
            return false;
        } else {
            return true;
        }
    }

    public static function phpMailSend($toWhos, $subject = "", $content = "") {


        $webmaster_email = __EMAIL_ADDRESS__; //Reply to this email ID

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";



        $headers .= "'To: ";
        $to = "";
        $c = 0;
        foreach ($toWhos as $email => $name) {
            if ($c > 0) {
                $headers .=", ";
                $to.=", ";
            }
            $headers .="{$name} <{$email}>";
            $to.=$email;
            $c++;
        }
        $headers.="' \r\n";
        $headers .= "From: Webmaster <{$webmaster_email}>\r\n";


        return mail($to, $subject, $content, $headers);
    }

}
