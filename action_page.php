<?php

$Name = $_POST['name'];
$Email = $_POST['email'];
$Subject = $_POST['subject'];
$Message=$_POST['message'];

//This is the part validate g-recapcha. If not a robot->return true
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
    echo "<script>alert('Captcha failed. Please try again')</script>";
    reload($Name, $Email, $Subject, $Message);
}

function reload($Name, $Email, $Subject, $Message){
    echo "
    <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>Contact Us</title>
        <!-- font reference -->
        <link href=\"https://fonts.googleapis.com/css?family=Roboto\" rel=\"stylesheet\">
        <link href=\"https://fonts.googleapis.com/css?family=Montserrat\" rel=\"stylesheet\">
        <!-- /.font reference -->
        <!-- bootstrap reference -->
        <link rel='stylesheet prefetch' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
        <link rel='stylesheet ' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
        <!-- /.bootstrap -->
        <!-- css reference -->
        <link rel=\"stylesheet\" href=\"css/navbar.css\">
        <link rel=\"stylesheet\" href=\"css/contact.css\">
        <link rel=\"stylesheet\" href=\"css/foot.css\">
        <!-- /.css -->
        <!-- Logo in website tab/bookmark -->
        <link rel='stylesheet prefetch' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
        <link rel=\"bookmark\" type=\"image/x-icon\" href=\"images/favicon.ico\"/>
        <link rel=\"shortcut icon\" href=\"images/favicon.ico\">
        <link rel=\"icon\" href=\"images/favicon.ico\">
        <!-- /.Logo -->
        <!-- \"I am not a robot\" recaptcha -->
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script type='text/javascript'>
   function wait() {
       $('#submit').remove();
       $('#submit-parent').append(\"<div class='hint'><p>Email is Sending... Please wait for a moment...</p></div>\");
       return true;
   }
        </script>
        <!-- /.recaptcha -->
    </head>
    
    
    <body>
    <!-- Navigation -->
    <nav class=\"navbar navbar-default topnav\" role=\"navigation\">
        <div class=\"container topnav\">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#target-menu\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                <a href=\"home.html\">
                    <div class=\"topnav navbar-brand\">
                    </div>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class=\"collapse navbar-collapse\" id=\"target-menu\">
                <ul class=\"nav navbar-nav navbar-right\">
                    <li>
                        <a href=\"home.html\">Home</a>
                    </li>
                    <li>
                        <a href=\"company.html\">Company</a>
                    </li>
                    <li class=\"active\">
                        <a href=\"contact.html\">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.Navigation -->
    
    
    <!-- picture front contact message form-->
    <div>
        <img class=\"picture-area\" src=\"images/contact.png\">
    </div>
    <!-- /.picture -->
    
    <!--text area-->
    <div class=\"header\">
        <h1>GET IN TOUCH</h1>
    </div>
    <div class=\"information\">
        <p>We’re happy to hear from you. Contact us today to learn more about our business and how you can benefit from
            working with us. </p>
    </div>
    <!-- /.text area-->
    <!-- message form area-->
    <div class=\"container-email\">
        <form action=\"action_page.php\" method=\"post\" onsubmit='return wait()'>
            <!-- Name filling area. Must be filled and should meet the request of containing nothing but letters -->
            <div class=\"row\">
                <div class=\"col\">
                    <input type=\"text\" placeholder=\"Name*:\" name=\"name\" pattern=\"^([a-zA-Z]+[,.]?[ ]?|[a-zA-Z]+['-]?)+$\"
                           title=\"Firstname and lastname should only contain letters. e.g. John Smith\" value='".$Name."' required>
                </div>
            </div>
            <!-- /.Name filling area -->
            <!-- Email address filling area. Must be filled and should meet the request pattern=\"^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+$\"-->
            <div class=\"row\">
                <div class=\"col\">
                    <input type=\"text\" placeholder=\"Email address*: \" name=\"email\"
                           pattern=\"^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,8})$\"
                           title=\"Email should follow certain format. e.g. someone@example.com\" value='".$Email."' required>
                </div>
            </div>
            <!-- /.Email filling area -->
            <!-- Email subject filling area. Must be filled -->
            <div class=\"row\">
                <div class=\"col\">
                    <input type=\"text\" id=\"subject\" name=\"subject\" placeholder=\"Subject*:\" value='".$Subject."' required>
                </div>
            </div>
            <!-- /.Email subject filling area -->
            <!-- Email message filling area. -->
            <div class=\"row\">
                <div class=\"col\">
                    <textarea id=\"message\" name=\"message\" placeholder=\"Write message:\" style=\"height:200px\"
                              required>".$Message ."</textarea>
                </div>
            </div>
            <!-- /.Email message filling area -->
            <!-- google recaptcha part. This part cannot be built due to the lack of a server.   -->
            <div class=\"row\">
                <div class=\"col\">
                    <div class=\"validation-area\">
                        <div class=\"g-recaptcha\" data-sitekey=\"6Lciyz8UAAAAALUwQ6ihfWitUNJ_KhHH1Um0OH4Q\"></div>
                    </div>
                </div>
            </div>
            <!-- Submit button -->
            <div class=\"row\">
                <div class=\"col\" id='submit-parent'>
                    <input name=\"Submit\" type=\"submit\" id=\"submit\" value=\"Submit\">
                </div>
            </div>
            <!-- /.Submit button -->
        </form>
    </div>
    
    <!-- footer(about/Twitter page/Facebook page) -->
    <footer>
        <div class=\"items\">
            <div class=\"container\">
                <div class=\"row\">
                    <!-- Display three elements equally. Later if there are more elements in footer, \"col-md-x\" can be adjusted.-->
                    <div class=\"col-md-4 col-sm-4 col-xs-4\">
                        <a href=\"about.html\"><span class=\"ion-android-pin\"> </span> About</a>
                    </div>
                    <div class=\"col-md-4 col-sm-4 col-xs-4\">
                        <a><span class=\"ion-social-twitter\"> </span> Twitter</a>
                        <!-- <a href=\"Your Twitter page link\">Twitter</a> -->
                    </div>
                    <div class=\"col-md-4 col-sm-4 col-xs-4\">
                        <a><span class=\"ion-social-facebook\"> </span> Facebook</a>
                        <!-- <a href=\"Your Facebook page link\">Facebook</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class=\"\">
            <p class=\"copyright\">Copyright © 2018 Acute Software Engineering Company. All rights reserved.</p>
        </div>
    </footer>
    <!-- /.footer -->

    </body>
    </html>
    ";
}





?>