<?php 
function register($user_first,$user_last,$user_email,$signup_user_password)
{
    $server='localhost';
    $user='irasaico_eli';
    $user_password='Eli1!';
    $database='irasaico_electriceye';
    
    $conn=new mysqli($server,$user,$user_password,$database);
  
    if($conn->connect_errno)
        {
            printf("connection Failed: ",$conn->connect_errno);
            $_SESSION['conn']='failed';
        }
        $emailcheck="SELECT*FROM users WHERE user_email='$user_email'";
    if($result=$conn->query($emailcheck))
        {
            
           $row_cnt=$result->num_rows;
           if($row_cnt>0)
                {
                    $_SESSION['email_error']=$user_email;
                    
                   
                    
                }
            else
                 {
                    unset($_SESSION['email_error']);
                    
                 }
        }
    else
        {
            echo("Query Failed");
        }
        /*
        $usernamecheck="SELECT*FROM users WHERE username='$username'";
        
    if($result=$conn->query($usernamecheck))
        {
            $row_cnt2=$result->num_rows;
            if($row_cnt>0)
                {
                    $_SESSION['username_error']=$username;
                  
                }
            else
                {
                    unset($_SESSION['username_error']);
                             
                }
        }
         */
        
         $register="INSERT INTO users (user_first,user_last,user_email,user_password) VALUES('$user_first','$user_last','$user_email','$signup_user_password')";
                    $_SESSION['username']=$user_first;
                    $conn->query($register);  
    }
    

function login($sql)
{
    $sql_server = 'localhost';
    $sql_user = 'irasaico_eli';
    $sql_pass = 'Eli1!';
    $sql_database = 'irasaico_electriceye'; 
    
    $conn=new mysqli($sql_server,$sql_user,$sql_pass,$sql_database);
    if($conn->connect_errno)                                                                            
        {
            printf("Connection Failed: ",$conn->connect_error);
            exit();
        }
   if($result=$conn->query($sql))
        {
           
           return $result;
           
           
        }
    else
        {
            echo("Query error not executed");
            
        }
}

function encrypt($string){
$key = "DysRRRTDB4-DERTSS4-h27d-966B-54Dddddhud679B";
$encrypted = addslashes(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key)))));
return $encrypted;
}
    function device_check($sql)
{
    $sql_server = 'localhost';
    $sql_user = 'irasaico_eli';
    $sql_pass = 'Eli1!';
    $sql_database = 'irasaico_electriceye'; 
    
    $conn=new mysqli($sql_server,$sql_user,$sql_pass,$sql_database);
    if($conn->connect_errno)                                                                            
        {
            printf("Connection Failed: ",$conn->connect_error);
            exit();
        }
   if($result=$conn->query($sql))
        {
           $_SESSION['deviceisset']="yes";
           return $result;
           
           
        }
    else
        {
            echo("Query error not executed");
            $conn->close();
        }
}


?>