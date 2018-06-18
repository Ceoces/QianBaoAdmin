<?php
	session_start();
	if(isset($_SESSION['id'])&&isset($_SESSION['pwd']))
	  {
	    require_once('mysql.class.php');
	    $db=new Mysql();
	    
	    $sql="select password from teacher where id='".$_SESSION['id']."'";

	    if($db->connect($dbhost,$dbuser,$dbpassword,$dbname))
	    {
	      echo "数据库连接错误";
	      die;
	    }
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