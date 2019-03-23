<?php
	include_once('mysql.class.php');
	include_once('logincheck.php');
	$db=new Mysql();
	$where="id='".$_GET['id']."'";
	if($db->connect($dbhost,$dbuser,$dbpassword,$dbname))
	   {
	      die;
	   }
	if($_GET['obj']=="student"){
		$db->delete("t_student",$where);
		header('location:stutable.php');
	}
	else if($_GET['obj']=="project"){
		$db->delete("t_project",$where);
		header('location:protable.php');
	}
	else if($_GET['obj']=="teacher"){
		$db->delete("t_teacher",$where);
		header('location:teachertable.php');
	}
	else if($_GET['obj']=="laboratory"){
		$db->delete("t_laboratory",$where);
		header('location:laboratorytable.php');
	}
	else if ($_GET['obj']=="stu_laboratory"&&isset($_GET['stuid'])&&$_GET['stuid']!=NULL&&isset($_GET['labid'])&&$_GET['labid']!=NULL) {
		$where="studentid=".$_GET['stuid']." and laboratoryid=".$_GET['labid'];
		$db->delete("t_stu_laboratory",$where);
		header('location:laboratoryinfo.php?id='. $_GET['labid'] .'');
	}
	else if ($_GET['obj']=="stu_pro" && isset($_GET['stuid']) && $_GET['stuid']!=NULL && isset($_GET['proid']) && $_GET['proid']!=NULL) {
		$where="studentid=".$_GET['stuid']." and proid=".$_GET['proid'];
		$db->delete("t_stu_pro",$where);
		header('location:laboratorytable.php');
	} else {
		header('location:notfound.html');
	}
?>