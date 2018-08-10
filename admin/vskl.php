<?php
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	$file='../conn/update.txt';
	$var='';
	$cp=new process($file);
	$cp->validatead($_SESSION['em'],$_SESSION['ps'],$_SESSION['role']);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../images/ggg.png">
<title>E Learning | cPanel</title>

<script src="../js/jquery-1.8.3.min.js"></script>
<script src="../js/check.js"></script>

<style>


@import "../css/interim.css";
@import "../css/forms.css";
</style>


</head>

<body>

<div id="container">
	
    <div id="header">
    	<div class="inheader">
        	<div id="left">
            
            	<img src=<?php echo LA; ?> width=<?php echo W; ?> height=<?php echo H; ?> vspace="-2px" hspace="-2px">&nbsp;<span><?php  echo E; ?></span>
            
            </div>
            <div id="right">
            	<nav>
            		<ul>
                    	
                        <li><a href="../index.php" class="first">Home</a></li>
                        <li><a href="cpanel.php">Back</a></li>
                        <li><a href="lgt2.php">Logout</a></li>
                        
                        
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
        	 
             <?php $cp->loadmenu($_SESSION['em'],$_SESSION['ps']); ?>
             
             
        </ul>
    
    </div>
    
    
    <div id="mainbar">
    <h3>Add School</h3>
    	
    
        
        <div class="clr"></div>
        
        
	<form method="post" action="../process/sskl.php" style="width:80%;">
			             
             <div class="all" style="width:100%;">
             <input type="text" name="srname" id="srname"  required="required" placeholder="School" style="width:100%;">
             </div>
             
    </form>

        <div class="clr"></div>
        
        <div id="tab_cont">
        	<table cellspacing="0" cellpadding="8px" style="padding:2px; background:transparent; border:0px; width:100%;">
              
            <?php	@$cp->vskl($val);	?>
                
        	</table>
				
                
        </div>
        
          
          <p style="color:green; font-size:10px; cursor:alias;">
                	<center>
                    
    	                <a id="lock"><img src="../images/locked.jpg" height="18px" width="auto"></a>
       &nbsp;&nbsp;&nbsp;
        	            <a id="unlock"><img src="../images/unlocked.jpg" height="18px" width="auto"></a>
                    
                    </center>	
                </p>
          
          
                
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