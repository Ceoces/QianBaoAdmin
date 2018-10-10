<!DOCTYPE html>
<html>
<head>
	<title>测试页面</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
	require_once('logincheck.php');
	include_once('mysql.class.php');
	
	$month_list=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	$day_list=array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
	$data_week=array();
	$today=substr(date("l"),0,3);

	$p=0;
	for($i=0;$i<count($day_list);$i++){
		if($day_list[$i]==$today)
			$p=$i;
	}

	for($i=$p;$i>=0;$i--){
		$sql_week="select count(*) as num,date_format(time,'%a') as day from V_signtable where time >= date_sub(now(),interval 1 week) and static=1 and laboratoryid=1 and date_format(time,'%w')=".($i+1)." group by stuname,date_format(time,'%w') order by time asc";
		$row_week=$db->findAll($sql_week);
		$date_week[$day_list[$i]]=0;
		if(isset($row_week[0]['num'])){
			$date_week[$day_list[$i]]= $row_week[0]['num'];
		} else {
			$date_week[$day_list[$i]]=0;
		}
	}
	for($i=6;$i>$p;$i--){
		$sql_week="select count(*) as num,date_format(time,'%a') as day from V_signtable where time >= date_sub(now(),interval 1 week) and static=1 and laboratoryid=1 and date_format(time,'%w')=".($i+1)." group by stuname,date_format(time,'%w') order by time asc";
		$row_week=$db->findAll($sql_week);
		$date_week[$day_list[$i]]=0;
		if(isset($row_week[0]['num'])){
			$date_week[$day_list[$i]]= $row_week[0]['num'];
		} else {
			$date_week[$day_list[$i]]=0;
		}
	}

	foreach ($date_week as $key => $value) {
		echo "<p>".$key.$value."</p>";
	}

	 ?>
	
</body>
</html>