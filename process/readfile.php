<?php

$file=$_GET['file'];

header("Content-type:appllication/pdf");
header("Content-lenght:".filesize($file));
$path='../uploads/library/';
$filename=$path.$file;
readfile($path);
?>