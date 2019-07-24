     <?php include('../includes/display_functions.php'); 
     include('../includes/functions.php'); 
     ?>

<!DOCTYPE html>

<html>
<head>
	<title>Accounts</title>

<link href="../css/app.css" rel="stylesheet" />
<link href='../css/cameras.css' rel='stylesheet'/>
<meta charset="utf-8">

<script>
  $(document).ready(function(){
       
       
       $("#add_device").click(function()
       {
           window.location.href="add_camera.php";
           
       });
      
   }); 
        
</script>
</head>
<body>
         
    <div data-role="page" id="main_page">
        <div data-role="header" data-theme="c">
          
            <h1>Hello, </h1>
    
        </div>
        </div><!-- /header -->
        <div role="main" class="ui-content" id="main">
       <?php
                $user=$_SESSION['userID'];
                $sql="SELECT*from users where user_id='$user'";
                $result=login($sql);
                $data=$result->fetch_array(MYSQLI_ASSOC);
                
                $email=$data['user_email'];
                $firstname=$data['user_first'];
                $lastname=$data['user_last'];
              
                $sql_device="SELECT*from user_devices where device_owner='$user'";
                $result_device=device_check($sql_device);
                $device_count=mysql_num_rows($result_device);
                
            ?>
           <label for="firstname" class="userpage_label">
                       First Name:
                    </label>
                      <input type="text" id="firstname" name="firstname" class="userpage_input" value="<?php echo($firstname)?>"readonly>
                      <br>
                    
                      <label for="lastname" class="userpage_label">
                        Last Name:
                    </label>
                      <input type="text" id="lastname" name="lastname" class="userpage_input" value="<?php echo($lastname) ?>"readonly>
                      <br>
                     <label for="email" class="userpage_label">
                        Email:
                    </label>
                    <input type="email" id="email" name="email" class="userpage_input" value="<?php echo($email)?>" readonly>
                    <br>
                     <label for="devices" class="userpage_label">
                        Device Count:
                    </label>
                    <input type="text" id="device_count" name="device_count" class="userpage_input" value="<?php echo($device_count)?>" readonly>
                    <br>
                    
<button class="ui-btn ui-shadow" id="add_device">ADD DEVICE</button>
                     
        </div><!-- /content -->
    </div><!-- /page -->
</body>
</html>