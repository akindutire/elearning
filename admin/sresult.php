<?php
	
	include_once('../include/settings.php');
	include_once('../class/class.php');
	include_once('../'.MYSQLI);
	$file='../conn/update.txt';
	$cp=new user($file);
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/ggg.png">
<title>E Learning</title>

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
                    	
                        <li><a href="../" class="first">Home</a></li>
                        
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
    <h3>Explore</h3>
    	
        
        <div class="clr"></div>
        
	
    
    <div id="feedback" style="background:transparent; color:black; font-family:'Trebuchet MS'; font-size:12px; padding:1px; margin:8px 0px 2px 140px; height:auto; width:350px; text-align:center; border:0px solid navy; border-radius:3px;"></div>

	<form method="post" action="checkstudresult.php">
			<input type="hidden" name="stud" value="<?php echo $_GET['stud']; ?>">
             <div class="all"><label>Level</label>
             <select name="level">
             	
                <option value="J.S.S. 1">J.S.S. 1</option>
                <option value="J.S.S. 2">J.S.S. 2</option>
                <option value="J.S.S. 3">J.S.S. 3</option>
                <option value="S.S.S. 1">S.S.S. 1</option>
                <option value="J.S.S. 1">S.S.S. 2</option>
                <option value="J.S.S. 1">S.S.S. 3</option>
             	
             </select>
             </div>
             
             <div class="all"><label>Term</label>
              <select name="term">
             	
                <option value="First term">First Term</option>
                <option value="Second term">Second Term</option>
                <option value="Third term">Third Term</option>
               
             	
             </select>
             </div>
             
             
            <!-- <div class="all"><label>Text</label>
             	<textarea></textarea>
             </div>
             -->
             <div class="all"><label></label><button type="submit">Enter</button></div>
    </form>




    </div>
    
	
   
    
    
 	</div>

<div class="clr"></div>
	</div>
<div class="clr"></div>

</div>   

<div id="footer"><p><?php echo F; ?></p></div>


</body>
</html>