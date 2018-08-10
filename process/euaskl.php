<?php
	
	
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new process($file);
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//Change Pix.
		
				
				if(!empty($_SESSION['funame'])){	
						
							$pfile=$_SESSION['funame'];
							
							$cp->hfp($pfile);					
							
						
				}else{
					echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Please Select a file</b>";	
					}
			
	}//@End All Submit
	exit();
	
?>