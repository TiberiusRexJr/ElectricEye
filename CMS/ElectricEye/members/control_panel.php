<?php session_start() ?>

<!DOCTYPE html>

<html>
<head>
	<title>Control Panel</title>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
<link href="../css/app.css" rel="stylesheet" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>

<meta charset="utf-8">
    <script>
                    

$(document).ready(function()
{

    
   $("#cameras").click(function()
   {
       var v='<?php echo $_SESSION['userID']?>';
                       
       
       $.ajax
       ({
           type:"POST",
           url:"../includes/display_functions.php",
            data:{"cameras":v},
          dataType:"json",
           success:function(data)
           {
              $("#main").empty();
                 $.each(data,function(i,object)
                    {
                        var tmp_container=[];
                        
                       $.each(object,function(properties,value)
                                {
                                    tmp_container.push(value);
                                }
                             );
                        
                        var device_id=tmp_container[0];
                        var device_name=tmp_container[1];
                        var device_status=tmp_container[2];
                        var device_routine=tmp_container[3];
                        
                    $("#main").append
                      (
                        '<div class="camera_list_item" id='+device_id+'>'+
                        '<div class="ui-grid-a">'+
                        '<div class="ui-block-b"><div class="button-wrap"><button class="ui-shadow ui-btn ui-corner-all"><p>'+device_name+'</p>'+
                        '<p>'+device_id+'</p></button></div></div>'+
                        '</div>'+
                        ' <div class="ui-grid-b">'+
                        '<div class="ui-block-b"><div class="button-wrap"><button class="ui-btn"  id='+device_id +' name=pictures onClick="testfunction(this.id, this.name)">Pictures</button></div></div>'+
                        '<div class="ui-block-b"><div class="button-wrap"><button class="ui-btn" id='+device_id +' name=videos onClick="testfunction(this.id, this.name)" >Videos</button></div></div>'+
                        '<div class="ui-block-b"><div class="button-wrap"><button class="ui-btn" id='+device_id +' name=settings onClick="testfunction(this.id, this.name)" >Settings</button></div></div>'+
                        '</div>'+
                        '</div>'
                        
                        );

                    
                    });

           }
           
       });
      
   }); 
   


});


  
</script>
<script>
    
     function setDeviceSession(id)
{
    var v=id;
    alert(v);
      $.ajax
       ({
           type:"POST",
           url:"../includes/device_manager.php",
            data:{"device":v},
          dataType:"json",
           success:function(data)
           {
              
    

           }
           
       });
    
}
    
        function testfunction(id,name)
{
    $("#main").empty();
    setDeviceSession(id);
    switch(name)
    {
          
        case'pictures':
            alert("picturs");
            alert(id);
            $("#main").load("pictures.php");
            var $div=$("#main");
           $div.enhanceWithin();
            break;
        case'videos':alert("videos");
            $("#main").load("videos.php");
            break;
        case'settings':alert("sittings");
            $("#main").load("settings.php");
            alert(id);
           var $div=$("#main");
           $div.enhanceWithin();
            break;
        
    }
    
}

</script>

</head>
<body>

    <div data-role="page" id="main_page">
        <div data-role="header" data-theme="c">
          
            <h1>Electric Eye <?php echo $_SESSION['userID']?><?php echo  $_SESSION['row']?></h1>
                <div data-role="navbar">
    <ul>
            <li><a href="#" id="accounts" class="ui-btn-active">Account</a></li>
        <li><a href="#" id="cameras">Cameras</a></li>
    </ul>
    </div>
        </div><!-- /header -->
        <div role="main" class="ui-content" id="main">
            <h3>Sign In</h3>
            <a href="#popupBasic" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" data-transition="pop">Basic Popup</a>
<div data-role="popup" id="popupBasic">
<p>This is a completely basic popup, no options set.</p>
</div>
            
            
        </div><!-- /content -->
    </div><!-- /page -->
</body>
</html>