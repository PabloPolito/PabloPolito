<?php header('Content-type: application/json; charset=utf-8');
if($_POST){
 $to_email = "pablopietropolito@gmail.com";
 
 //verifica se é uma requisição ajax, caso contrario o email não será enviado.
 if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND 
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') 
 {
   $data = json_encode('error');
   die($output); 
 } 
   
 //Sanitize input data using PHP filter_var().
 $user_name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
 $user_email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
 $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    
 //Corpo do email, aqui você formata como a mensagem vai chegar no seu email.
 $message_body.= "Nome: ".$user_name."\r\n\r\n";
 $message_body.= "Email: ".$user_email."\r\n\r\n";
 $message_body.= "Mensagem: ".$message;
 $subject = "Nova mensagem - CURRICULUM";
    
 //Cabeçalho e tipo de envio do email
 $headers = "From: ".$user_email;
    
 $send_mail = mail($to_email, $subject, $message_body, $headers);
 if(!$send_mail)
 {
   $data = json_encode('error');
   die($data);
 }else{
   $data = json_encode('success');
   die($data);
 }
}



?>