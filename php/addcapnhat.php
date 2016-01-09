<?php
session_start();
if(Empty($_GET['matheloai']))$_GET['matheloai']='hehe';
$_SESSION['addcapnhat']=$_GET['matheloai'];
header("location:quanlysach.php");
?>