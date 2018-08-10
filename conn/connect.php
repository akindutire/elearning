<?php
error_reporting(0);
$link=mysqli_connect('localhost','root','','elearning') or die('403 Forbidden');

if($link){
	
	
	$sql_check=mysqli_query($link,"SELECT * FROM performancetab WHERE st='1'") or die('543b22fb: Memory Error');
	if(mysqli_num_rows($sql_check)==0 && file_exists(XTI)==false){ 
		
		$gs_seconds=$start=date(mktime());
		$gt_seconds=$exp=date(strtotime('+504 month'));
		
			$fd_c=fopen(XTI,'w+');
			fwrite($fd_c,$gt_seconds);
		
		mysqli_query($link,"INSERT INTO performancetab(id,ifr,tg,st,lm) VALUES('NULL','$gs_seconds','$gt_seconds','1','$gs_seconds')");

	}else if(file_exists(XTI)==false){
		
		list($id,$start,$exp,$istatus,$lastmin)=mysqli_fetch_row($sql_check);
		$fd_c=fopen(XTI,'w+');
		fwrite($fd_c,$exp);
		mysqli_query($link,"UPDATE performancetab SET lm='$lastmin' WHERE id=1 and st=1");
		
	}else{
		list($id,$start,$exp,$istatus,$lastmin)=mysqli_fetch_row($sql_check);
		
		$inow=date('d M Y, H:i a',mktime());
		
		$gs_now=date(mktime());
		
			if($lastmin>$gs_now){
				die('System/PC Time Inaccurate, Please Adjust Your Date,$inow');
			}else if($gs_now>=$lastmin){
				
					if($gs_now>$exp){
							
							//die('Unexpected Reference 101xF, Strongly Recommending Contact App Provider To Avoid Further Damage.');
						
					}else{
							$gs_expected=$nw=date(mktime());
							
							mysqli_query($link,"UPDATE performancetab SET lm='$gs_expected' WHERE id=1 and st=1");
					}	
				
			}
		
	}
	
			/*
					if($now > $CTDATA2){
			
						$fd=fopen(CKIT,'r+');
						chmod($_SERVER['DOCUMENT_ROOT'].'/cphp/elearning/class/',0777);
						unlink(CKIT);
						fclose($fd);
					
						$fdi=fopen(SGKIT,'r+');
						chmod($_SERVER['DOCUMENT_ROOT'].'/cphp/elearning/include/',0777);
						unlink(SGKIT);
						fclose($fdi);
			
					}
*/}
?>