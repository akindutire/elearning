<?php
	
	include_once('include/settings.php');
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/ggg.png">
<title>E Learning</title>

<script src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
<script src="js/slide.js"></script>
<script src="js/check.js"></script>
<style>


@import "css/interim.css";
@import "css/forms.css";


</style>


</head>

<body>

<div id="container">
	
    <div id="header">
    	<div class="inheader">
        	<div id="left">
            
            	<img src=<?php echo L; ?> width=<?php echo W; ?> height=<?php echo H; ?> vspace="-2px" hspace="-2px">&nbsp;<span><?php  echo E; ?></span>
            
            </div>
            <div id="right">
            	<nav>
            		<ul>
                    	
                        <li><a href="../" class="first">Home</a></li>
                        
                    </ul>
            	</nav>
            
            </div>
            
          <div class="clr"></div> 
            
            <div id="slider_cont">
            	<div id="slider">
                	<p><img src="images/home_sweet_home_2-wallpaper-1280x1024.jpg" width="750px" height="250px"></p>
                  	<p><img src="images/indoor_swimming_pool-wallpaper-1280x1024.jpg" width="750px" height="250px"></p>
                    <p><img src="images/house_living_room-wallpaper-1280x1024.jpg" width="750px" height="250px"></p>
                    
                </div>
            </div>
            
            
    	</div>
        
    </div>
       
       
       
       
	<div class="clr"></div>
    
    
    
<div class="mwrap">    
    <div class="middlebody">
    
    
    <div id="sidebar">
    	<h3>Menu</h3>
    	<ul>
        	 <a href="../"><li>Home</li></a>
             
             
        </ul>
    
    </div>
    
    
    <div id="mainbar">
    <h3>Login</h3>
    	
     <!--   <p class="letters">On the Insert tab, the galleries include items that are designed to coordinate with the overall look of your document. You can use these galleries to insert tables, headers, footers, lists, cover pages, and other document building blocks. When you create pictures, charts, or diagrams, they also coordinate with your current document look.
You can easily change the formatting of selected text in the document text by choosing a look for the selected text from the Quick Styles gallery on the Home tab. You can also format text directly by using the other controls on the Home tab. Most controls offer a choice of using the look from the current theme or using a format that you specify directly.
To change the overall look of your document, choose new Theme elements on the Page Layout tab. To change the looks available in the Quick Style gallery, use the Change Current Quick Style Set command. Both the Themes gallery and the Quick Styles gallery provide reset commands so that you can always restore the look of your document to the original contained in your current template.

</p>-->
        
        <div class="clr"></div>
        
        <!--<div id="details">
        <p class="webdata">
        	<span id="left" style="float:left;">Name</span>
        	<span id="right" style="float:right;">Akindutire Emmanuel</span>
        </p>
       
        <p class="webdata">
        	<span id="left" style="float:left;">Name</span>
        	<span id="right" style="float:right;">Akindutire Emmanuel</span>
        </p>
       
        
        
        </div>
        
		<div id="pix"><img src="images/IMG_20140221_104210 - Copy.jpg" width="200px" height="auto"></div>
        -->
        <div class="clr"></div>
        
	
    
    <div id="feedback" style="background:transparent; color:black; font-family:'Trebuchet MS'; font-size:12px; padding:1px; margin:8px 0px 2px 140px; height:auto; width:350px; text-align:center; border:0px solid navy; border-radius:3px;"></div>

	<form method="post">
			
             <div class="all"><label>Telephone</label>
             <input type="tel" name="tel" id="tel" autofocus="autofocus" required="required">
             </div>
             
             <div class="all"><label>Pin</label>
             <input type="password" name="pin" id="pin" required="required">
             </div>
             
             
            <!-- <div class="all"><label>Text</label>
             	<textarea></textarea>
             </div>
             -->
             <div class="all"><label></label><button type="submit" id="ulogin">Login</button></div>
    </form>




    </div>
    
	
   
    
    
 	</div>

<div class="clr"></div>
	</div>
<div class="clr"></div>

</div>   

<div id="footer"><p><?php echo F; ?></p></div>


</body>
</html>