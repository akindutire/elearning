<?php
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	$file='../conn/update.txt';
	$cp=new process($file);
	$cp->validatead($_SESSION['em'],$_SESSION['ps'],$_SESSION['role']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../images/ggg.png">
<title>E Learning | Subject</title>

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
        	 
             <?php //$cp->loadmenu($_SESSION['em'],$_SESSION['ps']); ?>
            <a href="cpanel.php"><li>Home</li></a>
			 <a onclick="window.close()"><li>Close</li></a>
             
             
        </ul>
    
    </div>
    
    
    <div id="mainbar">
    <h3>Create Subject</h3>
    	
    
        
        <div class="clr"></div>
        
         <div id="feedback" style="background:transparent; color:black; font-family:'Browallia New'; font-size:18px; padding:1px; margin:8px 0px 2px 140px; height:auto; width:350px; text-align:center; border-radius:3px;"></div>

		<div id="feedback1" style="background:transparent; color:black; font-family:'Browallia New'; font-size:18px; padding:1px; margin:8px 0px 2px 140px; height:auto; width:350px; text-align:center; border-radius:3px;">A Valid PDF is expected as file</div>

 		        
	<form method="post" action="../process/ipdf.php" enctype="multipart/form-data" id="atut">
			
             <div class="hidden"><label>Subject Handout</label>
             <input type="file" name="hfile" id="hfile" required="required" autofocus="autofocus">
             </div>

             
             <div class="all"><label>Subject</label>
             <input type="text" name="sbj" id="sbj"  required="required">
             </div>
       
             
             <div class="all"><label>Assigned Level</label>
             <select name="alevel" id="alevel">
             	 <?php $cp->loadlevels(); ?>
             </select>
             </div>
             
             
             <div class="all"><label>Assigned Term</label>
             <select name="aterm" id="aterm">
             	<?php $cp->loadterms(); ?>
             </select>
             </div>       
             
              <div class="all"><label>Priority</label>
             <select name="pri" id="pri">
             	<option value="1">Compulsory</option>
                <option value="0">Elective</option>
             </select>	
             </div>
             
             <div class="all"><label>Overview</label>
             <textarea name="ovw" id="ovw" cols="" rows=""></textarea>
             	
             </div>
             
            <!-- <div class="all"><label>Text</label>
             	<textarea></textarea>
             </div>
             -->
             <div class="all"><label></label><button type="submit" id="csbj">Create</button></div>
    </form>

        
        
		<?php  ?>
        
                
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