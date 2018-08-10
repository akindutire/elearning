<?php	
    include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	
	
	$file='../conn/update.txt';
	$sbj=trim($_GET['sbj']);
	
	$cp=new process($file);
	$cp->validatead($_SESSION['em'],$_SESSION['ps'],$_SESSION['role']);

	$sql_ct=mysqli_query($link,"DELETE FROM etest WHERE sbj_id='$sbj'") or die('403 Forbidden');
	$sql_ct=mysqli_query($link,"DELETE FROM exam_pro WHERE sbj_id='$sbj'");
	$sql_stud=mysqli_query($link,"DELETE FROM stud_exam_status WHERE sbj_id='$sbj'");
	$sql=mysqli_query($link,"UPDATE subject SET etest='unsaved' WHERE id='$sbj'") or die('403 Forbidden');


	if($sql==true && $sql_ct==true)
		echo "<body onLoad='ireset()'></body>";
	else
		echo "System Error! Contact App Provider, <a href='../admin/sbj.php'>Go Back</a>";
		
?>
<script>
function ireset(){
	alert('Successfully Removed Test From Students Box');
	window.location='../admin/sbj.php';
	}

</script>
