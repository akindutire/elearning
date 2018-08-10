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
<title>E Learning | E-Test Set Up</title>

<script src="../js/jquery-1.8.3.min.js"></script>
<script src="../js/check.js"></script>
<script src="../js/jquery.caret.1.02.min.js"></script>
<script type="text/javascript" src="../library/ckeditor/ckeditor.js"></script>	

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
        	 
             <?php 
			 global $link;
			 $sbj_id=trim($_SESSION['sbj']); 
			 
			 $sql=mysqli_query($link,"SELECT etest FROM subject WHERE id='$sbj_id'");
			 list($p)=mysqli_fetch_row($sql);
			 	
				if($p=='saved'){
					echo "";
					}else{
						echo "
						<a id='clearform'><li>Clear Question Fields</li></a>
						<a id='reset'><li>Delete/Reset Setup</li></a>
						<a id='addmoreqs'><li>Add More Questions</li></a>
						<a id='cqs'><li>Change Question Time</li></a>
						<a id='fend'><li>Force End Test</li></a>
						<hr>
						";
					}
			 
			 ?>
        
             
         <a href="localstore.php#mainbar" target='_blank' id='lstore'><li>System Local Store</li></a>
						
         <a onclick="window.close()"><li>Close</li></a>
             
        </ul>
    
    </div>
    
    
    <div id="mainbar">
    <h3>Set Question</h3>
    	
    
        
        <div class="clr"></div>
        
       	
        <style>
        div.all{
			width:460px;
			margin-left:1px;
			}
		.all label{	
			width:120px;
			}
		.all input{
			word-spacing:4px;
			width:310px;
			}
		.all textarea{
			word-spacing:4px;
			width:312px;
			}
		#feedback{
			background:transparent;
			color:red; 
			font-family:bel; 
			font-size:15px; 
			padding:1px; 
			margin:8px 0px 2px 140px; 
			height:auto; 
			width:350px; 
			text-align:center; 
			border-radius:3px;
		}
        </style>
        
        <div id='details' style="width:95% !important;">
 
       
        <?php	 $cp->getQuestionForm($sbj_id);	?>
        	 
       
        	</div>

        <div>
        	<a title="View Set Questions" id="expand_qs" data-sbj=<?php echo $sbj_id;?> style="background: darkgreen; color: white; padding: 4px;">+</a>

        	<a id='close_qs' style="display: none; padding: 3px; font-family: bel; font-size: 10px; color: white;" title='Close Question'>X</a>

			<div id='pix' style="overflow-style:marquee-line; position: absolute !important; overflow:auto; max-height:358px;  display: none;">
       
 				
            </div>

         	
        </div>
			        
        	
                
        <div class="clr"></div>
        
		
        <div id="backfade" style="display:none;">
        	<div class="infade">
            
           
        
        </div><!--Infade-->
	</div><!--Backfade-->

    </div>
    
	
   
    
    
 	</div>

<div class="clr"></div>
	</div>
<div class="clr"></div>

</div>   

<div id="footer"><p><?php echo F; ?></p></div>


</body>
</html>