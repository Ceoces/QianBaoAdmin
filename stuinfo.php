<?php
  require_once('logincheck.php');
  header("Content-Type: text/html; charset=utf-8");
  include_once('mysql.class.php');
  //$stuid = mysql_real_escape_string(htmlspecialchars($_GET['id']));
  $stuid=$_GET['id'];
  if (!empty($stuid)) {
    $sql = "select * from v_stu_laboratory where studentid=" . $stuid;
  } else {
    //header("location: stutable.php");
  }
  $v_stu_laboratory_row = $db->findAll($sql);
  $sql2 = "select * from v_signtable where stuid=" . $stuid;
  $row = $db->findAll($sql2);
  $len = count($row);
  $sql3 = "select * from v_stu_pro where studentid=" . $stuid;
  $v_stu_pro_row = $db->findAll($sql3);
  $sql4 = "select * from v_student where id=" . $stuid;
  $v_student_row = $db->findAll($sql4);
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
      <h2><i class="fa fa-home"></i> 学生信息 </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">位置：</span>
        <ol class="breadcrumb">
          <li><a href="index.php">主页</a></li>
          <li><a href="laboratorytable.php">学生管理</a></li>
          <li class="active">学生个人信息</li>
        </ol>
      </div>
    </div>

    <div class="contentpanel">
      
      <div class="row">

        <div class="col-sm-3"> 
          <img src="images/photos/profile-1.png" class="thumbnail img-responsive" alt="" />
          <h2 class="profile-name"><?php if (isset($v_stu_laboratory_row[0]['stuname'])) echo $v_stu_laboratory_row[0]['stuname'];
                                  else echo "暂无"; ?></h2>
            <div class="profile-location"><i class="fa fa-user"></i>
              <?php 
              if (isset($v_student_row[0]['teachername']) && $v_student_row[0]['teachername'] != "") {
                echo $v_student_row[0]['teachername'];
              } else {
                echo "暂无";
              } ?>
            </div>
            <div class="profile-position"><i class="fa  fa-phone"></i> 
              <?php 
              if (isset($v_student_row[0]['phone']) && $v_student_row[0]['phone'] != "") {
                echo $v_student_row[0]['phone'];
              } else {
                echo "暂无";
              } ?>
            </div>
            <div class="profile-location"><i class="fa  fa-envelope"></i>
              <?php 
              if (isset($v_student_row[0]['email']) && $v_stu_laboratory_row[0]['email'] != "") {
                echo $v_student_row[0]['email'];
              } else {
                echo "暂无";
              } ?>
            </div>


            
            <div class="mb20"></div>
          <div class="mb-30"></div>
          <h4 ><strong>学生介绍</strong></h4>
          <div class="mb-30"></div>
          <p class="mb30">
            <?php 
            if (isset($v_stu_laboratory_row[0]['info']) && $v_stu_laboratory_row[0]['info'] != "") {
              echo $v_stu_laboratory_row[0]['info'];
            } else {
              echo "暂无";
            } ?>
          </p>

            <!-- <button class="btn btn-primary">添加成员</button> -->

          </div>
        
        <div class="col-sm-9">
          
          <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified nav-profile">
          <!--<li><a href="#now" data-toggle="tab">个人信息</a></li>-->
          <li class="active"><a href="#activities" data-toggle="tab">签到记录</a></li>
          <li><a href="#followers" data-toggle="tab">参加项目</a></li>
          <li><a href="#sign" data-toggle="tab">参加实验室</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="activities">
            <div class="activity-list">
              <?php 
              //签到情况
              $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
              $begin = $page * 10;
              $sql = "select * from v_signtable where stuid=" . $stuid . " order by intime    desc limit " . $begin . "," . ($begin + 10);
              $v_sign_row = $db->findAll($sql);
              if (count($v_sign_row) == 0) {
                echo "暂无";
              }
              for ($i = 0; $i < count($v_sign_row); $i++) {
                echo "<div class='media act-media'>";
                echo "<a class='pull-left' href='#'>";
                echo "<img class='media-object act-thumb' src='images/photos/user1.png' alt='' /></a>";
                echo "<div class='media-body act-media-body'>";
                echo "<strong>" . $v_sign_row[$i]['stuname'] . "</strong>&nbsp;&nbsp;</br>";
                echo "<small class='text-muted'>进入：" . $v_sign_row[$i]['intime'] . "&nbsp;&nbsp;离开：".$v_sign_row[$i]['outtime']."</small>";
                echo "</div></div>";
              }
              ?>
            <center>
            <ul class="pagination">
              <?php
              if ($len != 0) {
                echo "<li><a href='laboratoryinfo.php?id=" . $stuid . "'>首页</a></li>";
                if ($page != 0) {
                  echo "<li><a href='laboratoryinfo.php?id=" . $stuid . "&page=" . ($page - 1) . "'><i class='fa fa-angle-left'></i></a></li>";
                } else {
                  echo "<li class='disabled'><a><i class='fa fa-angle-left'></i></a></li>";
                }
                $begin = $page <= (ceil($len / 10) - 5) ? $page : (ceil($len / 10) - 5);
                if ($begin < 0) $begin = 0;
                $end = ($begin + 5) > $len ? $len : ($begin + 5);
                if (ceil($len / 10) < 5) {
                  $end = ceil($len / 10);
                }
                for ($i = $begin; $i < $end; $i++) {
                  echo "<li class='";
                  if ($i > $len / 10) echo "disable";
                  if ($page == $i) echo " active";
                  echo "'>";
                  echo "<a href='laboratoryinfo.php?id=" . $stuid . "&page=" . $i . "'>";
                  echo $i + 1;
                  echo "</a></li>";
                }
                if ($page < (ceil($len / 10) - 1)) {
                  echo "<li><a href='laboratoryinfo.php?id=" . $stuid . "&page=" . ($page + 1) . "'><i class='fa fa-angle-right'></i></a></li>";
                } else {
                  echo "<li class='disabled'><a><i class='fa fa-angle-right'></i></a></li>";
                }
                echo "<li><a href='laboratoryinfo.php?id=" . $stuid . "&page=" . (ceil($len / 10) - 1) . "'>尾页</a></li>";
              }
              ?>
              </ul>
            </center>
            
            </div><!-- activity-list -->
          </div>
          <div class="tab-pane" id="followers">
            
            <div class="follower-list">
              
              <?php
                //人员信息
    //$sql="select * from v_stu_laboratory where studentid=".$stuid;
    //$v_stu_laboratory_row=$db->findAll($sql);
    //$sql1="select * from v_stu_pro where id=".$_GET['id'];
    //$v_stu_pro_row=$db->findAll($sql1);
              if (count($v_stu_pro_row) == 0) {
                echo "暂未参加任何项目";
              }
              for ($i = 0; $i < count($v_stu_pro_row); $i++) {
                echo "<div class='media'>";
                echo "<a class='pull-left' href='#'>";
                echo "<img class='media-object' src='holder.js/100x125.html' alt='' /></a>";
                echo "<div class='media-body'>";
                echo "<h3 class='follower-name'>" . $v_stu_pro_row[$i]['proname'] . "</h3>";
                  //echo "<div class='profile-location'><i class='fa fa-map-marker'></i> ".$v_stu_pro_row[$i]['class']."</div>";
      //echo "<div class='profile-position'><i class='fa fa-briefcase'></i> ".$v_stu_pro_row[$i]['stuname']."</div>";
                echo "<div class='profile-location'><i class='fa  fa-clock-o'></i> " . $v_stu_pro_row[$i]['time'] . "</div>";
                echo "<div class='mb20'></div>";
                echo "<button class='btn btn-sm btn-success mr5'><i class='fa fa-user'></i>详细资料</button>";
                  //echo "<button class='btn btn-sm btn-white'><i class='fa fa-sign-out'></i>移出</button>";
                echo "</div></div>";
              }
              ?>
            </div><!--follower-list -->

          </div>

          <div class="tab-pane" id="sign">
            
            <div class="now-list">
              
              <?php
                //人员信息
                //$sql="select * from v_signtable where laboratoryid=".$stuid." and to_days(time) = to_days(now())  order by time desc";
                //echo $sql;
                //$v_sign_row=$db->findAll($sql);
              if (count($v_stu_laboratory_row) == 0) {
                echo "暂未参加任何项目";
              }
               // $stu_array = array();
              for ($i = 0; $i < count($v_stu_laboratory_row); $i++) {
                  //if(!isset($stu_array[$v_stu_laboratory_row[$i]['stuname']])){
                  //  $stu_array[$v_sign_row[$i]['stuname']]=1;
                  //  if($v_sign_row[$i]['static']==1){
                echo "<div class='media'>";
                echo "<a class='pull-left' href='#'>";
                echo "<img class='media-object' src='holder.js/100x125.html' alt='' /></a>";
                echo "<div class='media-body'>";
                echo "<h3 class='follower-name'>" . $v_stu_laboratory_row[$i]['laboratoryname'] . "</h3>";
                      //echo "<div class='profile-location'><i class='fa fa-map-marker'></i> ".$v_stu_laboratory_row[$i]['class']."</div>";
                      //echo "<div class='profile-position'><i class='fa fa-briefcase'></i> ".$v_stu_laboratory_row[$i]['laboratoryname']."</div>";
                echo "<div class='profile-location'><i class='fa  fa-clock-o'></i> " . $v_stu_laboratory_row[$i]['time'] . "进入</div>";
                echo "<div class='mb20'></div>";
                echo "<button class='btn btn-sm btn-success mr5'><i class='fa fa-user'></i>详细资料</button>";
                      //echo "<button class='btn btn-sm btn-white'><i class='fa fa-sign-out'></i>移出</button>";
                echo "</div></div>";
                   // }
                  //}
              }
              ?>
            </div><!--follower-list -->

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

<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/holder.js"></script>

<script src="js/custom.js"></script>
<script>
  jQuery(document).ready(function(){
    
    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
    
    //Replaces data-rel attribute to rel.
    //We use data-rel because of w3c validation issue
    jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
    });
    
  });
</script>

</body>
</html>