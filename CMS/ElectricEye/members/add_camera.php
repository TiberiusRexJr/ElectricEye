<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Electric Eye Welcome</title>

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
<link href="../css/app.css" rel="stylesheet" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
<script>
     $(document).ready(function()
     {alert('<?php echo $_SESSION['userID']?>');
         $("#device_submit").click(function()
         {
             alert('<?php echo $_SESSION['userID']?>');
            var device_name=$("#device_name").val();
            var device_serial=$("#device_serial").val();
            var device_owner=  '<?php echo $_SESSION['userID']?>'; 
            alert(device_name);
            alert(device_serial);
            $.ajax
            ({
               type:"POST",
               url:"../includes/display_functions.php",
               data:{"device":device_name,"device_serial":device_serial,"device_owner":device_owner},
               dataType:"json",
               success:function(data)
               {
                   
                   if(data.valueOf()===true)
                   {
                       window.location.href="control_panel.php";
                       
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
        <h1>ADD DEVICE</h1>
       
    </div><!-- /header -->
    <div role="main" class="ui-content">
        <h3>Registration</h3>
       
        <form  method="post" action="">
        <label for="txt-first-name">"Name"</label>
        <input type="text" name="Device Name" id="device_name" value="">
        <label for="txt-last-name">Serial Number</label>
        <input type="text" name="signup_user_last" id="device_serial" value="">
        <a href="#dlg-sign-up-sent" data-rel="popup" data-transition="pop" data-position-to="window" id="device_submit" class="ui-btn ui-btn-b ui-corner-all mc-top-margin-1-5">Submit</a>
        </form>
        <div data-role="popup" id="dlg-sign-up-sent" data-dismissible="true" style="max-width:400px;">
            <div data-role="header">
                <h1>Confirmation</h1>
            </div>
            <div role="main" class="ui-content">
                <h3>Done!</h3>
                <div class="mc-text-center"><a href="control-panel.php" class="ui-btn ui-corner-all ui-shadow ui-btn-b mc-top-margin-1-5">OK</a></div>
            </div>
        </div>
    </div><!-- /content -->
</div><!-- /page -->
</body>
</html>