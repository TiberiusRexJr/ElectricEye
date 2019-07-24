<?php
//require_once __DIR__ . 'db_connect.php';
include 'db_connect.php';
 header("Content-Type:application/json");
$input=file_get_contents("php://input");

$response;
if($input)
{
    $json= json_decode($input,true);
         
         if(isset($json['serial']))
        {
            $serial=$json['serial'];
            $response->serial=$serial;
       
            
        }
            $stmt="SELECT device_owner,device_data_folder, device_name,device_mode_email,device_mode_pic FROM user_devices WHERE device_serial='$serial'";
            
            if($conn->connect_errno)
            {
                printf("connection Failed: ",$conn->connect_errno);
                $_SESSION['conn']='failed';
                
            }
            if($result=$conn->query($stmt))
            {
                
                $row_cnt=$result->num_rows;
                $response->rowcount=$row_cnt;
                if($row_cnt>0)
                {
                    $row=$result->fetch_array(MYSQLI_ASSOC);
                    $response->device_mode_pic=$row['device_mode_pic'];
                    $response->device_mode_email=$row['device_mode_email'];
                    $response->device_name=$row['device_name'];
                    $response->device_data_folder=$row['device_data_folder'];
                    $response->registered="true";
                    $owner=$row['device_owner'];
                    
                    $stms2="SELECT user_gmail_address,user_gmail_password,user_pic_folder FROM users WHERE user_id='$owner'";
                    if($result2=$conn->query($stms2))
                    {
                        $row2=$result2->fetch_array(MYSQLI_ASSOC);
                        
                         $response->user_pic_folder=$row2['user_pic_folder'];
                        $response->user_gmail_password=$row2['user_gmail_password'];
                        $response->user_gmail_address=$row2['user_gmail_address'];
                    }     
                }
                else
                {
                    $response->registered="false";
                }
                
                
                    
            }
     
       $response= json_encode($response);
            
            
       echo $response;     
             
}        
   