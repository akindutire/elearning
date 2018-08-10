<?php
	
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	$q=(int)mysqli_real_escape_string($link,$_GET['qs']);
	
	$file='../conn/update.txt';
	$cp=new process($file);
	$cp->validatead($_SESSION['em'],$_SESSION['ps'],$_SESSION['role']);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../images/ggg.png">
<title>E Learning | View-Test</title>

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
                        <li><a href="etest.php">Back</a></li>
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
          
         <a onclick="window.close()"><li>Close</li></a>
             
        </ul>
    
    </div>
    
    
    <div id="mainbar">
    <h3>View Question</h3>
    	
    
        
        <div class="clr"></div>
        
		<?php
		
		$sql=mysqli_query($link,"SELECT * FROM tm_test WHERE id='$q'");
		if(mysqli_num_rows($sql)){
		list($id,$x1,$x2,$q,$op,$ans,$x3,$qimg)=mysqli_fetch_row($sql);

			$qimg=empty($qimg)?"":"<img src='../uploads/qimg/$qimg' width='auto' height='120px'>";
			ucwords($ans);
			
			$array_search = array('<br />');
			$array_replace = array('<p>','</p>','&nbsp;');

			$q = str_replace($array_search, $array_replace, $q);
					

			echo "
					$qimg
				 <p class='letters'>$q</p>
            
            <form method='post' id='getanswers' style='margin-top:15px;'>
            	
                
			";
			
			$opt=explode('|',$op);
			
			foreach($opt as $opkey => $option){
				
			$array_search = array('<p>','</p>','<br />');
			$array_replace = array('&nbsp;');

				$option = str_replace($array_search, $array_replace, $option);
					
				if($opkey == $ans){

					echo "<div class='all'><input type='radio' id='answer' name='answer' value='$option' checked disabled><span>$option</span></div>";	
				}else{
					echo "<div class='all'><input type='radio' id='answer' name='answer' value='$option' disabled><span>$option</span></div>";	
				}
			}
				
           	echo "</form><br>
			
			
			";
			}else{
				echo "<p class='letters' style='text-align:center;'>NO QUESTION</p>";
				}
			?>
        
			        
        	
                
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