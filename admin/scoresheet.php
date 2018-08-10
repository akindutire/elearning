<?php
	include_once('../include/settings.php');
	include_once('../'.MYSQLI);
	include_once('../class/class.php');
	
	$sbj_id_val=$_GET['sbj'];
	$file='../conn/update.txt';
	$var='';
	$var2='';
	$cp=new process($file);
	$cp->validatead($_SESSION['em'],$_SESSION['ps'],$_SESSION['role']);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../images/ggg.png">
<title>E Learning | Score Sheet</title>

<script src="../js/jquery-1.8.3.min.js"></script>
<script src="../js/check.js"></script>
<script>
	
	var tableToExcel = (function() {
var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()


</script>
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
        	 
             <?php //$cp->loadmenu($_SESSION['em'],$_SESSION['ps']); ?>
             <a><li>Home</li></a>
             <a onclick="window.close()"><li>Close</li></a>
             <a onclick="window.tableToExcel('result','ScoreSheet')"><li>Export To Excel</li></a>

        </ul>
    
    </div>
    
    
    <div id="mainbar">
    <h3> Score Sheet</h3>
    	
    
        
        <div class="clr"></div>
        
     
     
	<form method="post" action="../process/sskl.php" style="width:90%; margin-left:3%">
			 
            
          <div class="all">
            <label>Year</label><table id="dd" style="width:90%;">
            <tr>
            
            <td><select name="fyear" id="fy" style="width:90%;">
         		<?php
				$cy=date('Y',mktime());
                for($i=$cy;$i>=2000;$i--){
					echo "<option value='$i'>$i</option>";
					}
				?>
            </select></td></tr>
            </table>
            </div>       
              
              
             <div class="all" style="width:100%;"><label></label>
             <input type="text" name="score" id="score" placeholder="Search Score Above" style="width:90%;">
             </div>
             
             
             <input type="hidden" name="sbjnw" id="sbjnw" value="<?php echo $sbj_id_val; ?>">
             
    </form>
    
        <div class="clr"></div>
        
        <div id="tab_cont">
        	<table id='result' cellspacing="0" cellpadding="8px" style="padding:2px; background:transparent; border:0px; width:100%;">
              
            <?php	@$cp->vstudtutview($var2,$var,$sbj_id_val);	?>
                
        	</table>
            
			  
        </div>
        
                
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