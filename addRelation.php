<?php
	/*
	*	参数：
	*	GET
	*	stu 学生id
	*	pro 项目id
	*	lab 实验室id
	*
	* 	作用：
	* 	将学生添加进实验室或项目
	* 	
	 */
	include_once('mysql.class.php');
	include_once('logincheck.php');
	if(isset($_GET['stu'])&&$_GET['stu']!=NULL)
	{
		if(isset($_GET['lab'])&&$_GET['lab']!=NULL){
			$sql="select id from t_stu_laboratory where stuid=".$_GET['stu']." and laboratoryid=".$_GET['lab'];
			$row = $db.findAll($sql);
			if(count($row)!=0)
				header("location:laboratoryinfo.php?id=".$_GET['lab']);
			$data=array(
				'studentid'=>$_GET['stu'],
				'laboratoryid'=>$_GET['lab']
			);
			if($db->save("t_stu_laboratory",$data)){
				header("location:laboratoryinfo.php?id=".$_GET['lab']);
			}
		}
		else if(isset($_GET['pro'])&&$_GET['pro']!=NULL){
			$sql="select id from t_stu_pro where stuid='".$_GET['stu']."' and proid=".$_GET['pro'];
			$row = $db.findAll($sql);
			if(count($row)!=0)
				header("location:proinfo.php?id=".$_GET['pro']);
			$data=array(
				'studentid'=>$_GET['stu'],
				'proid'=>$_GET['pro']
			);
			if($db->save("t_stu_pro",$data)){
				header("location:proinfo.php?id=".$_GET['pro']);
			}
		}
	}
	echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
?>