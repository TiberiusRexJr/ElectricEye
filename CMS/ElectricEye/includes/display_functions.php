<?php 
    session_start();
  $server='localhost';
    $user='irasaico_eli';
    $user_password='Eli1!';
    $database='irasaico_electriceye';
    
    $conn=new mysqli($server,$user,$user_password,$database);

if(isset($_POST['cameras']))
    {
        /* what is 'pagename' and how do i why do i get its value 
            creating and filling a multirow array and doing date search operations
         * set up table like blue_heaven. searchlike blueheaven
         * need a time column
         *          */
        $userID=$_POST['cameras'];
        $table=user_devices;
                $_SESSION['value']=$userID;
                $SQL="SELECT*FROM $table WHERE device_owner='$userID'";
                $result=$conn->query($SQL);
                while($row=mysqli_fetch_assoc($result))
                {
                        $_SESSION['row']="ok";
                        $_SESSION['usernamedd']=$userID;
                       $container[]=array(
                                        "device_id"=>$row['device_id'],
                                        "device_name"=>$row['device_name'],
                                        "device_status"=>$row['device_status'],
                                        "device_mode_pic"=>$row['device_mode_pic'],
                                        "device_serial"=>$row['device_serial']
                                    );
              
            
                }
                $sort=array();
            
                    foreach($container as$k=>$v)
                        {                               /* one sorts something another specific something but all need idetifieser */
                            $sort['device_id'][$k]=$v['device_id'];
                        }
                   array_multisort($sort['device_id'],SORT_ASC,SORT_NATURAL,$container);
                   echo(json_encode($container));
    }
    
    if(isset($_POST['device']))
    {
        
        $device_owner=$_POST['device_owner'];
        $device_serial=$_POST['device_serial'];
        $device_name=$_POST['device'];
        
        $table=user_devices;
        
         $register="INSERT INTO $table (device_id,device_serial,device_name,device_owner) VALUES(null,'$device_serial','$device_name','$device_owner')";

   
               $conn->query($register);
                $status=true;
        echo(json_encode($status));
    }
    

            
          
                    
    
