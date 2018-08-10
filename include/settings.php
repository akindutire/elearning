<?php
session_name('el345');
session_save_path($_SERVER['DOCUMENT_ROOT'].'/cphp/elearning/include/sessions/data');
session_start();

ini_set('upload_max_filesize','5M');
ini_set('max_input_time','120');
ini_set('expose_php','off');
ini_set('upload_tmp_dir',$_SERVER['DOCUMENT_ROOT'].'cphp/elearning/include/tmp');

mb_http_input("utf-8");
mb_http_output("utf-8");

//error_reporting(0);

$Y=date('Y',mktime());
///////////////////////////CONSTANTS////////////////////////////////////////////////////

define('MYSQLI','conn/connect.php');///
define('E','E-Learning');
define('L','images/largegg.png');
define('LA','../images/largegg.png');
define('H','75px');
define('W','90px');
define("F","E-Learning $Y, realcliqs.com");
//date.timezone();
date_default_timezone_set('US/Eastern');

define('XTI',$_SERVER['DOCUMENT_ROOT'].'/cphp/elearning/images/exp.bmp');
define('SKIT',$_SERVER['DOCUMENT_ROOT'].'/cphp/elearning/include/sessions/data/silent.bmp');
define('CKIT',$_SERVER['DOCUMENT_ROOT'].'/cphp/elearning/class/class.php');
define('SGKIT',$_SERVER['DOCUMENT_ROOT'].'/cphp/elearning/include/settings.php');


//////////////////////////////USER-ID/////////////////////////////////////////////////////////////
		
				

//////////////////////////////ABOUT ME////////////////////////////////////////////////////////////
/*ABOUT THE DEVELOPER 	
 I AM AKINDUTIRE AYOMIDE SAMUEL, I AM PASSIONATE ABOUT CODING, I BUILT 
 THIS SYSTEM ON THE BASIS OF PROFESSIONALISM AND SALES, BEING THE ORIGINAL
PROGRAMMER OF THIS APP. ALL ERRORS MUST BE REPORTED TO cliqsapp@gmail.com or
VISIT MY WEBSITE realcliqs.com THIS APP CAN RUN ON ANY WINDOWS OF WINDOW XP,7,8,8.1,NT WITH 
AT LEAST 512MB RAM, 1.5GHz PROCESSOR, 80GB HDD, AN INTERNET CONNECTION 
FOR MORE USABILITY. 
JAVASCRIPT SUPPORTED DEVICE	*/?>