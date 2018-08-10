	<?php 
   
    include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$b=$_POST['bn'];
		$c=$_POST['bz'];
		if(!empty($b) && !empty($c)){
			
			}
		}
	/*$file='../conn/update.txt';
	$cv=new process($file);
	global $link;
	
	$var=array('NULL','mi','mi','mo');
	$fi=array('id','fg','dc','xc');
	$cv->tinsert($var,$fi,'tst',$link);*/
	
	?>
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    	<input type="text" name="bn">
        <input type="text" name="bz">
        <input type="submit" name="sb" value="sb">
    </form>