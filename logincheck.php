<?php
	if(is_file('360webscan.php')){
		require_once('360webscan.php');
	}
	session_start();
	 require_once('mysql.class.php');
	 $db=new Mysql();
	if($db->connect($dbhost,$dbuser,$dbpassword,$dbname))
	{
	   echo "数据库连接错误";
	   die;
	}
	if(isset($_SESSION['id'])&&isset($_SESSION['pwd'])&&!empty($_SESSION['id']))
	  {
	  	$sql="select password from t_teacher where id='".$_SESSION['id']."'";
	    $row=$db->findAll($sql);

	    if($row[0]['password']!=$_SESSION['pwd'])
	    {
	      header('location:login.php');
	    }
	  }
	  else
	  {
	  	header('location:login.php');
	  }
?>