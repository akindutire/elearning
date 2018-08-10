<?php

	
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new process($file);
	
	if($_SERVER['REQUEST_METHOD']=='POST'){


				$title=(string)htmlentities(ucwords(stripslashes(strip_tags(trim($_POST['title'])))));
				$author=(string)stripslashes(ucwords(strip_tags(trim($_POST['author']))));
				$alevel=(string)trim($_POST['alevel']);
				$cart=(string)trim($_POST['cart']);
				$isbn=(string)stripslashes(strip_tags($_POST['isbn']));
				
				if(!empty($_SESSION['funame']) && !empty($title) && !empty($author) && !empty($alevel) && !empty($cart) && !empty($isbn)){	
						if($_SESSION['valid']==1){
							
							$hfile=$_SESSION['funame'];
							
							$cp->adlib($title,$alevel,$author,$isbn,$hfile,$cart);					
							
							}else{
								echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Error in Uploaded File</b>";
								}
	
				}else{
					echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Please Select a file</b>";	
					}
	}
                    ?>