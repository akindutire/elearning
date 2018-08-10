<?php

	
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new process($file);
	
	if($_SERVER['REQUEST_METHOD']=='POST'){


				$sbj=(string)htmlentities(ucwords(stripslashes(strip_tags(trim($_POST['sbj'])))));
				$aterm=(string)stripslashes(ucwords(strip_tags(trim($_POST['aterm']))));
				$alevel=(string)trim($_POST['alevel']);
				$pri=(string)trim($_POST['pri']);
				$ovw=(string)nl2br(stripslashes(strip_tags($_POST['ovw'],'<br>')));
				$ovw = empty($ovw)?"Nil":$ovw;
				
				if(!empty($_SESSION['funame']) && !empty($sbj) && !empty($aterm) && !empty($alevel) && !empty($ovw)){	
						if($_SESSION['valid']==1){
							
							$hfile=$_SESSION['funame'];
							$level_id = $alevel."/".$aterm;

							$cp->csbj($sbj,$level_id,$ovw,$hfile,$pri);					
							
							}else{
								echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Error in Uploaded File</b>";
								}
	
				}else{
					echo "<b><img src='../images/cancel.png' width='auto' height='13px'>Please Select a file</b>";	
					}
	}
                    ?>