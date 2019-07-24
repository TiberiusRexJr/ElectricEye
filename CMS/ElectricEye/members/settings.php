<?php session_start(); 
    include('../includes/display_functions.php'); 
     include('../includes/functions.php'); 
     ?>

<!DOCTYPE html>

<html>
<head>
	<title>Settings</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
<link href="../css/app.css" rel="stylesheet" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
<script>
   
   $(document).ready(function()
   {
       $( "#flip-checkbox-1" ).prop( "checked", true );
       function flipChanged(e) 
       {
        var name = this.name,
            value = this.value;
        alert(name);
        }

    /* add listener - this will be removed once other buttons are clicked */
    $("#flip-checkbox-1").on("change", flipChanged);
      
   });
</script>
<script>
    function setFTP(value)
{
    var v='<?php echo $_SESSION['device']?>';
    alert(v);
      $.ajax
       ({
           type:"POST",
           url:"../includes/device_manager.php",
            data:{"ftp":v,"value":value},
          dataType:"json",
           success:function(data)
           {
              
    

           }
           
       });
    
}
    function setEmail(value)
{
    var v='<?php echo $_SESSION['device']?>';
    alert(v);
      $.ajax
       ({
           type:"POST",
           url:"../includes/device_manager.php",
            data:{"email":v,"value":value},
          dataType:"json",
           success:function(data)
           {
              
    

           }
           
       });
    
}
    </script>
<script>
    function ftp(cb) 
    {
        
        $("#main").empty();
        $("#main").load("pictures.php");
  alert("hi");
}
   function email(cb) 
    {
        $("#main").empty();
        $("#main").load("settings.php");
  alert("hi");
}
    </script>
<meta charset="utf-8">


</head>
<body>

        <div data-role="header" data-theme="c">
          
            <h1>Settings</h1>

        </div><!-- /header -->
        <div role="main" class="ui-content" id="main">
                   <?php
                $device_id=$_SESSION['device'];
                $sql="SELECT*from user_devices where device_id='$device_id'";
                $result=login($sql);
                $data=$result->fetch_array(MYSQLI_ASSOC);
                
                $name=$data['device_name'];
                $serial=$data['device_serial'];
                $email=$data['device_mode_email'];
                $ftp=$data['device_mode_pic'];
              
                /*$sql_device="SELECT*from user_devices where device_owner='$user'";
                $result_device=device_check($sql_device);
                $device_count=mysql_num_rows($result_device);*/
                
            ?>
            <h3>Settings</h3>
            <label>Name:</label>
            <input type="text" iinputd="lastname" name="lastname" class="userpage_input" value="<?php echo($name) ?>"readonly>
                      
            <label>Serial:</label>
            <input type="text" id="lastname" name="lastname" class="userpage_input" value="<?php echo($serial) ?>"readonly>
                      
            
            <h4>Modes</h4>
             <label>FTP:</label><label><input type='checkbox' onclick='ftp(this);' unchecked >Toggle</label>
                            <input type="text" id="lastname" name="lastname" class="userpage_input" value="<?php echo($ftp) ?>"readonly>

              <label>Email:</label></label><label><input type='checkbox' onclick='email(this);' unchecked >Toggle</label>
                          <input type="text" id="lastname" name="lastname" class="userpage_input" value="<?php echo($email) ?>"readonly>

   
        </div><!-- /content -->
   
</body>
</html>