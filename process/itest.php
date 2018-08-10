<?php
	
	
	//@The Follow are the interpretation of below $sbval
	//@1-Set Question;
	//@2-Preview Question (Same Page);
	//@3-Set Answer
	//@4-Load Recently Set Question
	//@5-Delete Question
	//@6-LOAD QUESTION FORM
	//@7-SAVE QUESTIONS FOR STUDENT TEST
	//@8-ADD MORE QUESTION SPACE
	//@9-ADJUST QUESTION PERIOD
	
	
	
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	$file='../conn/update.txt';
	$cp=new process($file);
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		$sbval=$_POST['itval'];
		
		if($sbval==1){
			
			$question=
			
			(ucwords(stripslashes(
				
					nl2br($_POST['iquestion'])
				)));
		
			

			/**/


			$options=implode('|',$_POST['option']);
			
			
			if(!empty($question) && !empty(ucwords($options))){

				if(isset($_SESSION['quname'])){
					
					if($_SESSION['valid']==1){
						
						$cp->setq($_SESSION['quname'],$question,$options);					
						
						
						}else{
							echo "Error! Invalid Image Added";
						}
					}else{
						$cp->setq('',$question,$options);
						}
				
				}else{
					echo "Empty Fields";
					}
			
			}else if($sbval==2){
				
				$cp->getq();
				
			}else if($sbval==3){
				
				$ans=ucwords($_POST['answer']);
				
					if(!empty($ans)){
						$cp->updateans($ans);
						}
						
			}else if($sbval==4){
			
				$sbj_id=trim($_SESSION['sbj']);
				$cp->getRecentQuestions($sbj_id);
			
			}else if($sbval==5){
			
				$q_id=$_POST['delid'];
				
				$sql_get_image=mysqli_query($link,"SELECT qimage FROM tm_test WHERE id='$q_id'");
				list($qmg)=mysqli_fetch_row($sql_get_image);
				
				@rename("../uploads/qimg/$qmg","../uploads/qimg/del/$qmg");
				
				$sql_del=mysqli_query($link,"DELETE FROM tm_test WHERE id='$q_id'");				
					
					if($sql_del)
						echo 101;
					else
						echo "403 Forbidden";	
						
			}else if($sbval==6){
				
				$sbj_id=trim($_SESSION['sbj']);
				$cp->getQuestionForm($sbj_id);
			
			}else if($sbval==7){
			
				$sbj_id=trim($_SESSION['sbj']);
				$cp->saveq($sbj_id);
						
			}else if($sbval==8){
			
				if(!empty($_POST['qs'])){
				
					
					$dval=(int)trim($_POST['qs']);
					$sbj_id=trim($_SESSION['sbj']);
				
					$sql_ck=mysqli_query($link,"SELECT no_q FROM etest_durations WHERE sbj_id='$sbj_id'");
					list($no_q)=mysqli_fetch_row($sql_ck);
					$no_q+=$dval;
					
					
					$sql=mysqli_query($link,"UPDATE etest_durations SET no_q='$no_q' WHERE sbj_id='$sbj_id'");
						
						if($sql){
							echo 101;
						}else{
							echo "403 Forbidden";
						}
				
				}else{
					echo "Empty Field";
					}
			}else if($sbval==9){
			
				if(!empty($_POST['cqs'])){
				
					
					$qtval=(int)trim($_POST['cqs']);
					$sbj_id=trim($_SESSION['sbj']);
				
					
					$qtsql=mysqli_query($link,"UPDATE etest_durations SET period='$qtval' WHERE sbj_id='$sbj_id'");
						
						if($qtsql){
							echo 101;
						}else{
							echo "403 Forbidden";
						}
				
				}else{
					echo "Empty Field";
					}
			}

		}//End Boby
		
	exit();

?>