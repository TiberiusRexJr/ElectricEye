<?php
  session_start();
  $server='localhost';
    $user='irasaico_eli';
    $user_password='Eli1!';
    $database='irasaico_electriceye';
    
    $conn=new mysqli($server,$user,$user_password,$database);
    
if(isset($_POST['device']))
    {
        /* what is 'pagename' and how do i why do i get its value 
            creating and filling a multirow array and doing date search operations
         * set up table like blue_heaven. searchlike blueheaven
         * need a time column
         *          */
        $userID=$_POST['device'];
        
                $_SESSION['device']=$_POST['device'];
    }
    
    if(isset($_POST['ftp']))
    {
        
         
        $value=$_POST['ftp'];
        $ftp="UPDATE user_devices SET device_mode_pic='$value' WHERE device_id='$device_id'";
        $conn->query($ftp);
               
    }
    if(isset($_POST['email']))
    {
        
         
        $value=$_POST['email'];
        $email="UPDATE user_devices SET device_mode_email='$value' WHERE device_id='$device_id'";
        $conn->query($email);
               
    }
    ?>


   


