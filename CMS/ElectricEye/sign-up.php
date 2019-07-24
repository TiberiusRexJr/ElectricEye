<?php
   
    include('includes/functions.php');
  
    if(isset($_POST['submit_register']))
        {
            if($_POST['signup_user_first']!="")
                {
                    $_POST['signup_user_first']=filter_var($_POST['signup_user_first'],FILTER_SANITIZE_STRING);
                    
                    
                    if($_POST['signup_user_first']=="")
                        {
                            echo("String has been sanitized to nothing! Try again");
                        }
                    else
                        {
                            $sign_up_first=$_POST['signup_user_first'];
                           
                        }
                }
                
                if($_POST['signup_user_last']!="")
                {
                    $_POST['signup_user_last']= filter_var($_POST['signup_user_last'],FILTER_SANITIZE_STRING);
                    
                    
                    if($_POST['signup_user_last']=="")
                        {
                            echo("String has been sanitized to nothing! Try again");
                        }
                    else
                        {
                            $sign_up_last=$_POST['signup_user_last'];
                           
                        }
                }
                 if($_POST['signup_user_email']!="")
                {
                    $_POST['signup_user_email']=filter_var($_POST['signup_user_email'],FILTER_VALIDATE_EMAIL);
                    
                    
                    if($_POST['signup_user_email']=="")
                        {
                            echo("String has been sanitized to nothing! Try again");
                        }
                    else
                        {
                            $sign_up_email=$_POST['signup_user_email'];
                           
                        }
                }
           
        
            if($_POST['signup_user_password']!="")
                {
                    $signupPassword=encrypt($_POST['signup_user_password']);
                }
            else
                {
                    echo('password is blank');
                }
                
                
                  $result=register($sign_up_first,$sign_up_last,$sign_up_email,$signupPassword);
                  
                  echo($result);
                  
                  if(isset($_SESSION['username']))
                  {
                      header("Location:http://irasai.com/ElectricEye/sign-in.php");
                      exit;
                  }
                  
                  
   
        }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Electric Eye Welcome</title>

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
<link href="css/app.css" rel="stylesheet" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
</head>
<body>
<div data-role="page">
    <div data-role="header" data-theme="c">
        <h1>Electric Eye</h1>
       
    </div><!-- /header -->
    <div role="main" class="ui-content">
        <h3>Sign Up</h3>
       
        <form  method="post" action="">
        <label for="txt-first-name">First Name</label>
        <input type="text" name="signup_user_first" id="signup_user_first" value="">
        <label for="txt-last-name">Last Name</label>
        <input type="text" name="signup_user_last" id="signup_user_last" value="">
        <label for="txt-email">Email Address</label>
        <input type="text" name="signup_user_email" id="signup_user_email" value="">
        <label for="txt-password">Password</label>
        <input type="password" name="txt-password" id="txt-password" value="">
        <label for="txt-password-confirm">Confirm Password</label>
        <input type="password" name="signup_user_password" id="signup_user_password" value="">
        <input type="submit" id="submit_register" name="submit_register" value="Register" href="sign_in.php">
        <a href="#dlg-sign-up-sent" data-rel="popup" data-transition="pop" data-position-to="window" class="ui-btn ui-btn-b ui-corner-all mc-top-margin-1-5">Submit</a>
        </form>
        <div data-role="popup" id="dlg-sign-up-sent" data-dismissible="false" style="max-width:400px;">
            <div data-role="header">
                <h1>Almost done...</h1>
            </div>
            <div role="main" class="ui-content">
                <h3>Confirm Your Email Address</h3>
                <p>We sent you an email with instructions on how to confirm your email address. Please check your inbox and follow the instructions in the email.</p>
                <div class="mc-text-center"><a href="sign-in.html" class="ui-btn ui-corner-all ui-shadow ui-btn-b mc-top-margin-1-5">OK</a></div>
            </div>
        </div>
    </div><!-- /content -->
</div><!-- /page -->
</body>
</html>