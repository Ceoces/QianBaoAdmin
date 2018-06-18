<?php
	include_once('mysql.class.php');
	include_once('logincheck.php');
	$db=new Mysql();
	$where="id='".$_GET['id']."'";
	if($db->connect($dbhost,$dbuser,$dbpassword,$dbname))
	   {
	      echo "数据库连接错误";
	      die;
	   }
	$db->delete($_GET['obj'],$where);
	if($_GET['obj']=="student")
	header('location:stutable.php');
	else if($_GET['obj']=="project")
		header('location:protable.php');
	else if($_GET['obj']=="teacher")
		header('location:teachertable.php');
?>