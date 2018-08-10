<?php
//include_once('../include/settings.php');
session_name('el345');
session_save_path($_SERVER['DOCUMENT_ROOT'].'/cphp/elearning/include/sessions/data');
session_start();


$_SESSION[]=array();
session_unset();
header('location:index.php')
?>