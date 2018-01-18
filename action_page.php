<?php
$Name = $_POST['name'];
$Email = $_POST['email'];
$Subject = $_POST['subject'];
$Message=$_POST['message'];

//This is the part get the validation result from g-recapcha. If not a robot->return true
function validation(){
    return true;
}

if(validation() == true){
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    require 'PHPMailer.php';
    require 'SMTP.php';
    //Load composer's autoloader
    //require 'vendor/autoload.php';
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.qq.com';                          // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '1003353398@qq.com';                // SMTP username
        $mail->Password = 'seaezjqjgbjkbgaf';                 // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        //Recipients
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
    }
}
?>

