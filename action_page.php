<?php

$Name = $_POST['name'];
$Email = $_POST['email'];
$Subject = $_POST['subject'];
$Message=$_POST['message'];

session_start();
$_SESSION['Name']=$Name;
$_SESSION['Email']=$Email;
$_SESSION['Subject']=$Subject;
$_SESSION['Message']=$Message;

//This is the part validate g-recapcha. If not a robot->return true
if(isset($_POST['Submit'])){
    function CheckCaptcha($usrResponse){
        $fields_string = '';
        $fields = array(
            'secret' => "6Lciyz8UAAAAAA1J17LeTFSDJ4-QYiutHURnwQ2i",
            'response' => $usrResponse
        );
        foreach($fields as $key => $value)
            $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string,'&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch,CURLOPT_POST,count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,True);

        $res = curl_exec($ch);
        curl_close($ch);
        return json_decode($res,true);
    }
}

$result = CheckCaptcha($_POST['g-recaptcha-response']);

if($result['success']){
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    require 'PHPMailer.php';
    require 'SMTP.php';
    //Load composer's autoloader
    //require 'vendor/autoload.php';
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        //Username should be the email address that managing the sending email function
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.qq.com';                          // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '1003353398@qq.com';                // SMTP username
        $mail->Password = 'seaezjqjgbjkbgaf';                 // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        //Recipients
        //setFrom should be same as Username
        //addAddress should be Company address
        $mail->setFrom('1003353398@qq.com', $Name);
        $mail->addAddress('yujia.zhang@stud.fh-luebeck.de', 'Yujia Zhang');     // Add a recipient
        $mail->addReplyTo($Email, $Name);
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $Subject;
        $mail->Body    = $Message;

        $mail->send();
        readfile("contact.html");
        echo "<script>alert('Send Successfully!')</script>";
//           echo 'Message has been sent';
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Please try again')</script>";
        readfile("contact.html");
    }
}else{
    echo "<script>history.go(-1);</script>";
    echo "<script>alert('Captcha failed. Please try again')</script>";

}

?>