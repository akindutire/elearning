<?php
	include_once('include/settings.php');
	include_once(MYSQLI);
	include_once('class/class.php');
	
	$sbj=urldecode($_GET['sbj']);
	$file='conn/update.txt';
	$var='';
	$cp=new user($file);
	$cp->validateus();
	
	@$tel=$_SESSION['tel'];
	@$ps=$_SESSION['ups'];
		
		@$sql10101010=mysqli_query($link,"SELECT id,pix FROM users WHERE email='".mysqli_real_escape_string($link,$tel)."' and password='".mysqli_real_escape_string($link,$ps)."'");
		@list($uid,$pix)=mysqli_fetch_row($sql10101010);
		

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/ggg.png">
<title>E Learning | Take Exam</title>

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
                    	
                        <li><a href="index.php" class="first">Home</a></li>
                        <li><a href="lgt.php">Logout</a></li>
                        
                        
                    </ul>
            	</nav>
            
            </div>
            
          <div class="clr"></div> 
            
    	</div>
        
    </div>
       
       
       
       
	<div class="clr"></div>
    
    
    
<div class="mwrap">    
    <div class="middlebody">
    
    
    <div id="sidebar">
    	<h3>Menu</h3>
    	<ul>
        	 
             <?php //$cp->loadmenu($_SESSION['tel'],$_SESSION['ups']); ?>
             <a onclick="window.close();"><li>Close</li></a>
             
        </ul>
    
    </div>
    
    
    <div id="mainbar">
    <h3>Exam Hints</h3>
    	
    
        
        <div class="clr"></div>
        

        <div class="clr"></div>
        
        <div id="tab_cont">
        
		
        <?php
        
		
		$cp->examhint($sbj);
		
		?>
        
        <div class="clr"></div>
        
        <p class="letters"><b>Note:</b> Immediately Exam Start You Can't Pause Any Process Until Exam Ends</p>
        	
          	
                	
                    
                    <center>
                    
    	                <a id="startexam"><img src="images/start.jpg" width="75px" height="auto"></a>
       &nbsp;&nbsp;&nbsp;
                    
                    </center>	
                </p>
        </div>
        
                
        <div class="clr"></div>
        
	
 

    </div>
    
	
   
    
    
 	</div>

<div class="clr"></div>
	</div>
<div class="clr"></div>

</div>   

<div id="footer"><p><?php echo F; ?></p></div>


</body>
</html>