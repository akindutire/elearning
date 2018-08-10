<?php
	include_once('include/settings.php');
	include_once(MYSQLI);
	include_once('class/class.php');
	
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
<title>E Learning | Add More Subject</title>

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
                         <li><a href="imsbj.php">Back</a></li>
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
        	 
            <?php $cp->loadmenu($_SESSION['tel'],$_SESSION['ups']); ?>
             
        </ul>
    
    </div>
    
    
    <div id="mainbar">
    <h3>All Subjects</h3>
    	
    
        
        <div class="clr"></div>
        

        <div class="clr"></div>
        
        <div id="tab_cont">
        	<form action="uprocess/addsbjtomysbj.php" method="post" id="addsbjtomysbj">
            
        	<table border="0" draggable="true" cellspacing="0" cellpadding="8px" style="padding:2px; background:transparent; border:0px; width:100%;">
              
            <?php	$cp->asbjs();	?>
                
        	</table>
            
            </form>
			 <div id="feedback" style="background:transparent; color:black; font-family:'Browallia New'; font-size:18px; padding:1px; margin:8px 0px 2px 140px; height:auto; width:350px; text-align:center; border-radius:3px;"></div>	
                <p style="color:green; font-size:10px; cursor:alias;">
                	
                    
                    <center>
                    
    	                <a id="addtosbj"><img src="images/addsbj.png" width="75px" height="auto"></a>
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