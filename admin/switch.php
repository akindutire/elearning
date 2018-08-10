<?php
	
	include_once('../include/settings.php');
	include_once('../class/class.php');
	include_once('../'.MYSQLI);
	
	$uid=$_GET['stud'];
	$file='../conn/update.txt';
	$cp=new process($file);
		
		@$sql10101010=mysqli_query($link,"SELECT pix,level_id FROM users WHERE id='$uid'");
		@list($pix,$slv_id)=mysqli_fetch_row($sql10101010);
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		
		$sql_pro=mysqli_query($link,"SELECT * FROM stud_sbj_profile WHERE stud_id='$uid' AND etest='saved' AND level='$slv_id' UNION SELECT * FROM stud_sbj_profile WHERE stud_id='$uid' AND etest='unsaved' AND level='$slv_id'");
		
		$sql_ipro=mysqli_query($link,"SELECT * FROM stud_exam_status WHERE stud_id='$uid' AND status='1' AND level='$slv_id'") or die(mysqli_error());
		
		if(mysqli_num_rows($sql_pro)==mysqli_num_rows($sql_ipro) && mysqli_num_rows($sql_pro)!=0 && mysqli_num_rows($sql_ipro)!=0){
			$cat=trim($_POST['cat']);
			$sql=mysqli_query($link,"UPDATE users SET cat='$cat' WHERE id='$uid'") or die('System Busy, Try Again');
			header('location:vstud.php');
			}else{
				echo "Student Currently On Exam, Switching Failed";
				}
		
		}
	
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
                    	
                         <li><a href="../index.php" class="first">Home</a></li>
                        <li><a href="vstud.php">Back</a></li>
                        
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

	<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			
             <div class="all"><label>Category</label>
             <select name="cat">
             	
                <option value="General">General</option>
                <option value="Science">Science</option>
                <option value="Art">Art</option>
                <option value="Commercial">Commercial</option>
                
             	
             </select>
             </div>
             
           
             
             
            <!-- <div class="all"><label>Text</label>
             	<textarea></textarea>
             </div>
             -->
             <div class="all"><label></label><button type="submit">Switch</button></div>
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