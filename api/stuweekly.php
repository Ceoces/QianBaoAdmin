<?php
/*
*   获取本周实验室学生进出的数据
*   参数：GET 实验室id
*   
*/
    include_once('../mysql.class.php');
    $db = new Mysql();
    $db->connect($dbhost,$dbuser,$dbpassword,$dbname);
    
    //maxlen设置查询的天数
    $maxlen = 50;
    $arr1 = array();
    $arr2 = array();
    
    for($i=0; $i<$maxlen; $i++){
        $opt = "-".($maxlen-$i)." day";
        $day = date("Y-m-d",strtotime($opt));
        $sql = "select distinct stuid,count(*) as num from t_signtable where date_format(intime,'%Y-%m-%d')='".$day."' and laboratoryid=".$_GET['id']."";
        $row = $db->findAll($sql);
        $arr1[$i]=$day;
        if(isset($row[0]['num'])){
            $arr2[$i]=$row[0]['num'];
        } else{
            $arr2[$i]=0;
        }
    }
    
    $res = array(
        "time" => $arr1,
        "data" => $arr2
    );

    echo json_encode($res);
?>