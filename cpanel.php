<?php
	include_once('include/settings.php');
	include_once(MYSQLI);
	include_once('class/class.php');
	
	$file='conn/update.txt';
	$cp=new user($file);
	$cp->validateus();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/ggg.png">
<title>E Learning | cPanel</title>

<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/check.js"></script>
<style>


@import "css/interim.css";
@import "css/forms.css";


</style>


</head>

<body>

<div id="container">
	
    <div id="header">
    	<div class="inheader">
        	<div id="left">
            
            	<img src=<?php echo L; ?> width=<?php echo W; ?> height=<?php echo H; ?> vspace="-2px" hspace="-2px">&nbsp;<span><?php  echo E; ?></span>
            
            </div>
            <div id="right">
            	<nav>
            		<ul>
                    	
                        <li><a href="../" class="first">Home</a></li>
                        <li><a href="lgt.php">Logout</a></li>
                        
                    </ul>
            	</nav>
            
            </div>
            
          <div class="clr"></div> 
            
            <!--<div id="slider_cont">
            	
            </div>-->
            
            
    	</div>
        
    </div>
       
       
       
       
	<div class="clr"></div>
    
    
    
<div class="mwrap">    
    <div class="middlebody">
    
    
    <div id="sidebar">
    	<h3>Menu</h3>
    	<ul>
        	 
             <?php $cp->loadmenu($_SESSION['tel'],$_SESSION['ups']); ?>
             
             
        </ul>
    
    </div>
    
    
    <div id="mainbar">
    <h3>Student Profile</h3>
    	
    
        
        <div class="clr"></div>
        
		<?php $cp->uprof($_SESSION['tel'],$_SESSION['ups']); ?>
        
                
        <div class="clr"></div>
        
	<div id="backfade" style="display:none;">
    	<div class="infade" style="position:relative;">
        
        <span id="close" style="position:absolute; top:1px; left:97.5%;">
        	<img src="images/exit.png" width="auto" height="15px">
       	</span>
       
        <div id="feedback1" style="background:transparent; color:black; font-family:'Browallia New'; font-size:18px; padding:1px; margin:8px 0px 2px 140px; height:auto; width:350px; text-align:center; border-radius:3px;"></div>
        
        <div class="clr"></div>
        
       
        <form method='post' enctype="multipart/form-data" id="upf" action="uprocess/euaskl.php">
        	<div class="all"><label></label><input type="file" name="file" id="uphfile"></div>
            <div class="all"><label></label><button type="submit" id="">Change</button>
        </form>
        </div>
    
    </div>


    </div>
    
	
   
    
    
 	</div>

<div class="clr"></div>
	</div>
<div class="clr"></div>

</div>   

<div id="footer"><p><?php echo F; ?></p></div>


</body>
</html>