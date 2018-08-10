<?php	
    include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	
	$file='../conn/update.txt';
	$sbj=trim($_GET['sbj']);
	
	$cp=new process($file);
	$cp->validatead($_SESSION['em'],$_SESSION['ps'],$_SESSION['role']);

	$sql=mysqli_query($link,"DELETE FROM tm_test WHERE sbj_id='$sbj'") or die('403 Forbidden');
	$sql_ct=mysqli_query($link,"DELETE FROM etest WHERE sbj_id='$sbj'") or die('403 Forbidden');
	$sql_et=mysqli_query($link,"DELETE FROM etest_durations WHERE sbj_id='$sbj'") or die('403 Forbidden');
	$sql_stud=mysqli_query($link,"DELETE FROM stud_sbj_profile WHERE sbj_id='$sbj'") or die('403 Forbidden');

	$sql_n=mysqli_query($link,"UPDATE subject SET etest='' WHERE id='$sbj'") or die('403 Forbidden');
	
	if($sql==true && $sql_stud==true && $sql_ct==true && $sql_et==true)
		header('location:../admin/sbj.php');
	else
		echo "System Error! Contact App Provider, <a href='../admin/sbj.php'>Go Back</a>";
		
?>