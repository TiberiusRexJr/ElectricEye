<?php  
session_start();
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
            <h2 class="mc-text-center">Welcome!</h2>
            <p class="mc-top-margin-1-5"><b>Existing Users</b></p>
            <a href="sign-in.php" class="ui-btn ui-btn-b ui-corner-all">Sign In</a>
            <p class="mc-top-margin-1-5"><b>Don't have an account?</b></p>
            <a href="sign-up.php" class="ui-btn ui-btn-b ui-corner-all">Sign Up</a>
            <p></p>
        </div><!-- /content -->
    </div><!-- /page -->
</body>
</html>