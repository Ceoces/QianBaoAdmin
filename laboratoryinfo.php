<?php
  header("Content-Type: text/html; charset=utf-8");
  error_reporting(0);
  ini_set('display_errors','off');
  require_once('360webscan.php');
  require_once('logincheck.php'); 
  include_once('mysql.class.php');
  if (isset($_GET['id'])) {
    $sql="select * from v_laboratory where id=".$_GET['id'];
  }  
  $v_laboratory_row=$db->findAll($sql);
  $sql2="select * from v_signtable where laboratoryid=".$_GET['id'];
  $row=$db->findAll($sql2);
  $len=count($row);
  $testarr=array();

  //数据统计

  //每周数据统计
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
    $sql_week="select count(*) as num,date_format(intime,'%a') as day from V_signtable where intime >= date_sub(now(),interval 1 week) and static=1 and laboratoryid=".$_GET['id']." and date_format(intime,'%w')=".($i+1)." group by stuname,date_format(intime,'%w') order by intime asc";
    $row_week=$db->findAll($sql_week);
    $date_week[$day_list[$i]]=0;
    if(isset($row_week[0]['num'])){
      $date_week[$day_list[$i]]= $row_week[0]['num'];
    } else {
      $date_week[$day_list[$i]]=0;
    }
  }
  for($i=6;$i>$p;$i--){
    $sql_week="select count(*) as num,date_format(intime,'%a') as day from V_signtable where intime >= date_sub(now(),interval 1 week) and static=1 and laboratoryid=".$_GET['id']." and date_format(intime,'%w')=".($i+1)." group by stuname,date_format(intime,'%w') order by intime asc";
    $row_week=$db->findAll($sql_week);
    $date_week[$day_list[$i]]=0;
    if(isset($row_week[0]['num'])){
      $date_week[$day_list[$i]]= $row_week[0]['num'];
    } else {
      $date_week[$day_list[$i]]=0;
    }
  }

  $sql_month="select date_format(intime,'%d') as time,stuname,stuid,static from V_signtable where intime >= date_sub(now(),interval 1 month) and static=1 and laboratoryid=".$_GET['id']." group by stuname,date_format(intime,'%w') order by intime asc";

  $row_month=$db->findAll($sql_month);
  $num_month=array();
  for($i=0;$i<count($row_month);$i++)
  {
    //统计进入人数
    if(isset($row_month[$i]['time'])&&$row_month[$i]['static']==1){
      if(array_key_exists($row_month[$i]['time'],$num_month))
        {
          $num_month[$row_month[$i]['time']]++;
        } else {
          $num_month[$row_month[$i]['time']] = 1;
        }
      }
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>实验室签报系统</title>

  <link href="css/style.default.css" rel="stylesheet">
  <link href="css/prettyPhoto.css" rel="stylesheet">
  <link href="css/morris.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
  <?php require_once('leftpanel.php'); ?>
  
  <div class="mainpanel">
    <?php require_once('headerright.php'); ?>

    <div class="pageheader">
      <h2><i class="fa fa-home"></i> 实验室信息 </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">位置：</span>
        <ol class="breadcrumb">
          <li><a href="index.php">主页</a></li>
          <li><a href="laboratorytable.php">实验室管理</a></li>
          <li class="active">实验室信息</li>
        </ol>
      </div>
    </div>

    <div class="contentpanel">
      
      <div class="row">

        <div class="col-sm-3"> 
          <h2 class="profile-name"><?php echo $v_laboratory_row[0]['laboratoryname']; ?></h2>
            <div class="profile-location"><i class="fa fa-user"></i>
              <?php 
                  if($v_laboratory_row[0]['teachername']!=""){
                    echo $v_laboratory_row[0]['teachername']; 
                  }else {
                    echo "暂无";
                  }?>
            </div>
            <div class="profile-position"><i class="fa  fa-phone"></i> 
              <?php 
                  if($v_laboratory_row[0]['phone']!=""){
                    echo $v_laboratory_row[0]['phone']; 
                  }else {
                    echo "暂无";
                  }?>
            </div>
            <div class="profile-location"><i class="fa  fa-envelope"></i>
              <?php 
                  if($v_laboratory_row[0]['email']!=""){
                    echo $v_laboratory_row[0]['email']; 
                  }else {
                    echo "暂无";
                  }?>
            </div>


            
            <div class="mb20"></div>
          <div class="mb-30"></div>
          <h4 ><strong>实验室介绍</strong></h4>
          <div class="mb-30"></div>
          <p class="mb30">
            <?php 
                  if($v_laboratory_row[0]['info']!=""){
                    echo $v_laboratory_row[0]['info']; 
                  }else {
                    echo "暂无";
                  }?>
          </p>

            <a href=<?php echo "'search.php?laboratoryid=".$_GET['id']."'"; ?>><button class="btn btn-primary">添加成员</button></a>

          </div>
        
        <div class="col-sm-9">
          
          <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified nav-profile">
          <li class="active"><a href="#now" data-toggle="tab">当前人员</a></li>
          <li><a href="#sign" data-toggle="tab">签到情况</a></li>
          <li><a href="#data" data-toggle="tab">签报统计</a></li>
          <li><a href="#members" data-toggle="tab">成员</a></li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="now">
            
            <div class="followers-list">
              
              <?php
                //人员信息
                $sql="select * from v_signtable where laboratoryid=".$_GET['id']." and to_days(intime) = to_days(now())  order by intime desc";
                //echo $sql;
                $v_sign_row=$db->findAll($sql);
                $sql="select * from v_stu_laboratory where laboratoryid=".$v_laboratory_row[0]['id'];
                $v_stu_laboratory_row=$db->findAll($sql);

                if (count($v_sign_row)==0) {
                  echo "暂无成员";
                }
                $stu_array = array();
                for($i=0;$i<count($v_sign_row);$i++)
                {
                  if(!isset($stu_array[$v_stu_laboratory_row[$i]['stuname']])){
                    $stu_array[$v_sign_row[$i]['stuname']]=1;
                    if($v_sign_row[$i]['static']==1){
                      echo "<div class='media'>";
                      echo "<a class='pull-left' href='#'>";
                      echo "<img class='media-object' src='holder.js/100x125.html' alt='' /></a>";
                      echo "<div class='media-body'>";
                      echo "<h3 class='follower-name'>".$v_sign_row[$i]['stuname']."</h3>";
                      echo "<div class='profile-location'><i class='fa fa-map-marker'></i> ".$v_sign_row[$i]['class']."</div>";
                      echo "<div class='profile-position'><i class='fa fa-briefcase'></i> ".$v_sign_row[$i]['proname']."</div>";
                      echo "<div class='profile-location'><i class='fa  fa-clock-o'></i> ".$v_sign_row[$i]['intime']."进入</div>";
                      echo "<div class='mb20'></div>";
                      echo "<a href='stuinfo.php?id=".$v_sign_row[$i]['stuid']."'><button class='btn btn-sm btn-success mr5'><i class='fa fa-user'></i>详细资料</button></a>";
                      echo "<button class='btn btn-sm btn-white'><i class='fa fa-sign-out'></i>移出</button>";
                      echo "</div></div>";
                    }
                  }
                }
              ?>
            </div><!--follower-list -->

          </div>
          <div class="tab-pane" id="sign">
            <div class="activity-list">
              <?php 
              //签到情况
              $page=isset($_GET['page'])?(int)$_GET['page']:0;
              $begin=$page*10;
              $sql="select * from v_signtable where laboratoryid=".$_GET['id']." order by intime    desc limit ".$begin.",".($begin+10);
              
              $v_sign_row=$db->findAll($sql);

              if (count($v_sign_row)==0) {
                echo "暂无";
              }
              for($i=0;$i<count($v_sign_row);$i++)
                {
                  echo "<div class='media act-media'>";
                  echo "<a class='pull-left' href='#'>";
                  echo "<img class='media-object act-thumb' src='images/photos/user1.png' alt='' /></a>";
                  echo "<div class='media-body act-media-body'>";
                  echo "<strong>".$v_sign_row[$i]['stuname']."</strong>&nbsp;&nbsp;";
                  echo "</br>";
                  echo "<small class='text-muted'>";
                  if($v_sign_row[$i]['static']=='1'){
                    echo "进入&nbsp;&nbsp".$v_sign_row[$i]['intime'];
                  } else {
                    echo "进入&nbsp;&nbsp".$v_sign_row[$i]['intime'];
                    echo "&nbsp;&nbsp离开&nbsp;&nbsp".$v_sign_row[$i]['outtime'];
                  }

                  echo "</small>";
                  echo "</div></div>";
                }
               ?>
            <center>
            <ul class="pagination">
              <?php
                if($len!=0){
                  echo "<li><a href='laboratoryinfo.php?id=".$_GET['id']."'>首页</a></li>";
                  if($page!=0){
                  echo "<li><a href='laboratoryinfo.php?id=".($_GET['id'])."&page=".($page-1)."'><i class='fa fa-angle-left'></i></a></li>";
                  } else {
                    echo "<li class='disabled'><a><i class='fa fa-angle-left'></i></a></li>";
                  }
                  $begin=$page<=(ceil($len/10)-5)?$page:(ceil($len/10)-5);
                  if($begin<0)$begin=0;
                  $end=($begin+5)>$len?$len:($begin+5);
                  if(ceil($len/10)<5){
                    $end=ceil($len/10);
                  }
                  for($i=$begin;$i<$end;$i++)
                  {
                    echo "<li class='";
                    if($i>$len/10) echo"disable"; if($page==$i) echo " active";
                    echo "'>";
                    echo "<a href='laboratoryinfo.php?id=".$_GET['id']."&page=".$i."'>";
                    echo $i+1;
                    echo "</a></li>";
                  }
                  if($page<(ceil($len/10)-1)){  
                   echo "<li><a href='laboratoryinfo.php?id=".($_GET['id'])."&page=".($page+1)."'><i class='fa fa-angle-right'></i></a></li>";
                  } else {
                    echo "<li class='disabled'><a><i class='fa fa-angle-right'></i></a></li>";
                  }
                  echo "<li><a href='laboratoryinfo.php?id=".$_GET['id']."&page=".(ceil($len/10)-1)."'>尾页</a></li>";
                }
               ?>
              </ul>
            </center>
            
            </div><!-- activity-list -->
          </div>
          <div class="tab-pane" id="members">
            
            <div class="follower-list">
              
              <?php
                //人员信息
                
                if (count($v_stu_laboratory_row)==0) {
                  echo "暂无成员";
                }

                for($i=0;$i<count($v_stu_laboratory_row);$i++)
                {
                  echo "<div class='media'>";
                  echo "<a class='pull-left' href='#'>";
                  echo "<img class='media-object' src='holder.js/100x125.html' alt='' /></a>";
                  echo "<div class='media-body'>";
                  echo "<h3 class='follower-name'>".$v_stu_laboratory_row[$i]['stuname']."</h3>";
                  echo "<div class='profile-location'><i class='fa fa-map-marker'></i> ".$v_stu_laboratory_row[$i]['class']."</div>";
                  echo "<div class='mb20'></div>";
                  echo "<a href='stuinfo.php?id=".$v_stu_laboratory_row[$i]['studentid']."'><button class='btn btn-sm btn-success mr5'><i class='fa fa-user'></i>详细资料</button></a>";
                  echo "<a href='delete.php?obj=stu_laboratory&stuid=".$v_stu_laboratory_row[$i]['studentid']."&labid=".$_GET['id']."'><button class='btn btn-sm btn-white'><i class='fa fa-sign-out'></i>移出</button></a>";
                  echo "</div></div>";
                }
              ?>
            </div><!--follower-list -->

          </div>
          <div class="tab-pane" id="data">
            <div class="row">
                <div id="all" style="height: 300px"></div>
              <div class="col-md-8">
                    <div id="week" style="height:300px;width:500px;position: relative;">
                    </div>
                    <div class="col-md-8 col-sm-offset-4">
                      <h5>本周人流量折线图</h5> 
                    </div>
                    <div id="month" style="height:300px;width:500px;position: relative;">
                    </div>
                    <div class="col-md-8 col-sm-offset-4" style="margin-top: 50px;">
                      <h5>本月人流量折线图</h5>
                    </div>
              </div>

              <div class="col-md-4" style="margin-top:55px;">
                <h5 class="subtitle md5">个人总排行</h5>
                <div class="table-responsive">
                  <table class="table mb30">
                    <!-- <theead></theead> -->
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>xxx</td>
                        <td>24h</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>yyy</td>
                        <td>20h</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>zzz</td>
                        <td>19h</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <h5 class="subtitle md5">本周学习时间排行</h5>
                <div class="table-responsive">
                  <table class="table mb30">
                    <!-- <theead></theead> -->
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>xxx</td>
                        <td>24h</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>yyy</td>
                        <td>20h</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>zzz</td>
                        <td>19h</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <h5 class="subtitle md5">本月学习时间排行</h5>
                <div class="table-responsive">
                  <table class="table mb30">
                    <!-- <theead></theead> -->
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>xxx</td>
                        <td>24h</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>yyy</td>
                        <td>20h</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>zzz</td>
                        <td>19h</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          
        </div><!-- col-sm-9 -->
      </div><!-- row -->
      
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->
  
  
  
</section>


<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/toggles.min.js"></script>
<script src="js/retina.min.js"></script>
<script src="js/jquery.cookies.js"></script>
<script src="js/jquery.datatables.min.js"></script>
<script src="js/chosen.jquery.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/holder.js"></script>


<script src="js/flot/flot.min.js"></script>
<script src="js/flot/flot.resize.min.js"></script>
<script src="js/flot/flot.symbol.min.js"></script>
<script src="js/flot/flot.crosshair.min.js"></script>
<script src="js/flot/flot.categories.min.js"></script>
<script src="js/flot/flot.pie.min.js"></script>
<script src="js/morris.min.js"></script>
<script src="js/raphael-2.1.0.min.js"></script>

<script src="js/custom.js"></script>


       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-gl/echarts-gl.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-stat/ecStat.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/world.js"></script>
       <script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/simplex.js"></script>

<script>
  jQuery(document).ready(function(){
    
    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
    
    //Replaces data-rel attribute to rel.
    //We use data-rel because of w3c validation issue
    jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
    });
    
</script>
<script>
var dom = document.getElementById("week");
var myChart = echarts.init(dom);
var app = {};
option = null;
app.title = '本周人流量';

option = {
    color: ['#3398DB'],
    tooltip : {
        trigger: 'axis',
        axisPointer : {
            type : 'shadow'
        }
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    xAxis : [
        {
            type : 'category',
            data : [<?php
              $i=0;
              foreach(array_reverse($date_week) as $key => $value)
              {
                if($i==0){
                  echo "'".$key."'";
                } else {
                  echo ", '".$key."'";
                }
                $i++;
              }
              echo "],";
             ?>

            axisTick: {
                alignWithLabel: true
            }
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'当日人数',
            type:'bar',
            barWidth: '60%',
            data:[<?php
              $i=0;
              foreach(array_reverse ($date_week) as $key => $value)
              {
                if($i==0){
                  echo $value;
                } else {
                  echo ", ".$value;
                }
                $i++;
              }
             ?>]
        }
    ]
};
;
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}
</script>
<script>
  jQuery(document).ready(function(){
    
    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
    
    //Replaces data-rel attribute to rel.
    //We use data-rel because of w3c validation issue
    jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
    });
    
</script>
<script>
 var dom = document.getElementById("month");
var myChart = echarts.init(dom);
var app = {};
option = null;
app.title = '本周人流量';

option = {
    color: ['#3398DB'],
    tooltip : {
        trigger: 'axis',
        axisPointer : {
            type : 'shadow'
        }
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    xAxis : [
        {
            type : 'category',
            data : [<?php
              $i=0;
              foreach($num_month as $key => $value)
              {
                if($i==0){
                  echo "'".$key."'";
                } else {
                  echo ", '".$key."'";
                }
                $i++;
              }
              echo "],";
             ?>

            axisTick: {
                alignWithLabel: true
            }
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'当日人数',
            type:'bar',
            barWidth: '60%',
            data:[<?php
              $i=0;
              foreach($num_month as $key => $value)
              {
                if($i==0){
                  echo $value;
                } else {
                  echo ",".$value;
                }
                $i++;
              }
             ?>]
        }
    ]
};
;
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}
</script>
<script>
  jQuery(document).ready(function() {
    
    jQuery('#table1').dataTable();
    
    jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });
    
    // Chosen Select
    jQuery("select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
    
    // Delete row in a table
    jQuery('.delete-row').click(function(){
      var c = confirm("Continue delete?");
      if(c)
        jQuery(this).closest('tr').fadeOut(function(){
          jQuery(this).remove();
        });
        
        return false;
    });
    
    // Show aciton upon row hover
    jQuery('.table-hidaction tbody tr').hover(function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 1});
    },function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 0});
    });
  
  
  });
</script>
  <script type="text/javascript">
    var dom = document.getElementById("all");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;

    data = [["2000-06-05",5],["2000-06-06",129],["2000-06-07",135],["2000-06-08",86],["2000-06-09",73],["2000-06-10",85],["2000-06-11",73],["2000-06-12",68],["2000-06-13",92],["2000-06-14",130],["2000-06-15",245],["2000-06-16",139],["2000-06-17",115],["2000-06-18",111],["2000-06-19",309],["2000-06-20",206],["2000-06-21",137],["2000-06-22",128],["2000-06-23",85],["2000-06-24",94],["2000-06-25",71],["2000-06-26",106],["2000-06-27",84],["2000-06-28",93],["2000-06-29",85],["2000-06-30",73],["2000-07-01",83],["2000-07-02",125],["2000-07-03",107],["2000-07-04",82],["2000-07-05",44],["2000-07-06",72],["2000-07-07",106],["2000-07-08",107],["2000-07-09",66],["2000-07-10",91],["2000-07-11",92],["2000-07-12",113],["2000-07-13",107],["2000-07-14",131],["2000-07-15",111],["2000-07-16",64],["2000-07-17",69],["2000-07-18",88],["2000-07-19",77],["2000-07-20",83],["2000-07-21",111],["2000-07-22",57],["2000-07-23",55],["2000-07-24",60]];

    var dateList = data.map(function (item) {
        return item[0];
    });
    var valueList = data.map(function (item) {
        return item[1];
    });

    option = {

        // Make gradient line here
        visualMap: [{
            show: false,
            type: 'continuous',
            seriesIndex: 0,
            min: 0,
            max: 100
        }],


        title: [{
            left: 'center',
            text: '最近签到记录'
        }],
        tooltip: {
            trigger: 'axis'
        },
        xAxis: [{
            data: dateList
        }],
        yAxis: [{
            splitLine: {show: false}
        }],
        grid: [{
            bottom: '60%'
        }],
        series: [{
            type: 'line',
            showSymbol: false,
            data: valueList
        }]
    };
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
      </script>

</body>
</html>