
<!DOCTYPE html>
<html>
<head>
	<title>Electric Eye Sign In</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
<link href="css/app.css" rel="stylesheet" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>

<script>
       $(document).ready(function(){
           $("#submit_login").click(function(){
              
               
               var email=$("#login_email").val();
       var password=$("#login_password").val();
       alert(email +" "+password);
       $.ajax({
           url:'validate.php',
            data:{"submit_login":email,"login_password":password},
            type:'post',
            dataType:"json",
            success:function(data)
            {
                
                    if(data.toString()==="true")
                    {
                        var v='<?php echo $_SESSION['username']?>';
                        alert( v );
                        window.location.href='members/control_panel.php';
                    }
                  
                    
                }
       
        
            });
           });
       
        });
</script>
</head>
<body>
    <div data-role="page">
        <div data-role="header" data-theme="c">
          
            <h1>Electric Eye</h1>
        </div><!-- /header -->
        <div role="main" class="ui-content">
            <h3>Sign In</h3>
            <form  method="" action=""  data-ajax="false" > 
            <label for="txt-email">Email Address</label>
            <input type="text" name="login_email" id="login_email" value="">
            <label for="txt-password">Password</label>
            <input type="password" name="login_password" id="login_password" value="">
            <fieldset data-role="controlgroup">
                <input type="checkbox" name="chck-rememberme" id="chck-rememberme" checked="">
                <label for="chck-rememberme">Remember me</label>
            </fieldset>
           
            <a href="#dlg-invalid-credentials" data-rel="popup" data-transition="pop" data-position-to="window" id="" name="submit_login" class="ui-btn ui-btn-b ui-corner-all mc-top-margin-1-5">Submit</a>
            </form>
             <input type="button" name="submit_login" value="Login" id="submit_login">
            <p class="mc-top-margin-1-5"><a href="begin-password-reset.php">Can't access your account?</a></p>
            
            <div data-role="popup" id="dlg-invalid-credentials" data-dismissible="false" style="max-width:400px;">
                <div role="main" class="ui-content">
                    <h3 class="mc-text-danger">Login Failed</h3>
                    <p>Did you enter the right credentials?</p>
                    <div class="mc-text-center"><a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b mc-top-margin-1-5">OK</a></div>
                </div>
            </div>
            
        </div><!-- /content -->
    </div><!-- /page -->
</body>
</html>