<?php session_start();
    include('includes/functions.php');
     if(isset($_POST['submit_login']))
        {
         $val=false;
            if($_POST['submit_login']!="")
                {
                    $_POST['submit_login']=filter_var($_POST['submit_login'],FILTER_SANITIZE_EMAIL);
                    $_POST['submit_login']=filter_var($_POST['submit_login'],FILTER_VALIDATE_EMAIL);
                                   
                    if($_POST['submit_login']=="")
                        {
                            echo('email empty after sanitize');
                        }
                    else
                        {
                            $loginEmail=$_POST['submit_login'];
                          $_SESSION['login_email']=$loginEmail;
                        }
                       
                }
            else
                {
                    echo('email is blank');
                }
            if($_POST['login_password']!="")
                {
                    $loginPassword=encrypt($_POST['login_password']);
                    $_SESSION['login_password']=$loginPassword;
                }
        
                
                $sql="SELECT*FROM users WHERE user_email='$loginEmail' AND user_password='$loginPassword'";
               
                $result=login($sql);
                $row_cnt=$result->num_rows;
                if($row_cnt!=0)
                    {
                        
                        $row=$result->fetch_array(MYSQLI_ASSOC);
                        $_SESSION['username']=$row['user_last'];
                        $_SESSION['userID']=$row['user_id'];
                        $val=true;
                        
                    }
                else
                    {
                        $_SESSION['username']="emailnot found";
                        session_write_close();
                        $val=false;
                    }
                 header("Content-Type:application/json");
                  
                  echo json_encode($val);
       
                $result->close();
             
        }
    
?>