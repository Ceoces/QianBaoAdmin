<?php
  require_once('logincheck.php'); 
  header("Content-Type: text/html; charset=utf-8");
  include_once('mysql.class.php');
  if (isset($_GET['id'])) {
    $sql="select * from v_laboratory where id=".$_GET['id'];
  
}  $v_laboratory_row=$db->findAll($sql);
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
    <div class="headerbar">
      
      <a class="menutoggle"><i class="fa fa-bars"></i></a>
      
      <?php require_once('headerright.php'); ?>
      
    </div>

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
          <img src="images/photos/profile-1.png" class="thumbnail img-responsive" alt="">
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
        </div>
        
        <div class="col-sm-9">
          
          <div class="profile-header">
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
          <p class="mb30"><?php echo $v_laboratory_row[0]['info']; ?> </p>

          </div><!-- profile-header -->
          
          <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified nav-profile">
          <li><a href="#followers" data-toggle="tab">当前人员</a></li>
          <li class="active"><a href="#activities" data-toggle="tab">签到情况</a></li>
          <li><a href="#followers" data-toggle="tab">签报统计</a></li>
          <li><a href="#followers" data-toggle="tab">成员</a></li>


        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="activities">
            <div class="activity-list">
              <?php 
              //签到情况
              $page=isset($_GET['page'])?(int)$_GET['page']:30;
              $sql="select * from v_signtable where laboratoryid=".$_GET['id']." order by time    desc limit 0,".$page;
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
                  echo "<strong>";
                  if($v_sign_row[$i]['static']=='1'){
                    echo "进入";
                  } else {
                    echo "离开";
                  }
                  echo "</strong>. <br />";
                  echo "<small class='text-muted'>".$v_sign_row[$i]['time']."</small>";
                  echo "</div></div>";
                }
            
               ?>
            
            </div><!-- activity-list -->
            <?php  
            $sql="select * from v_signtable where laboratoryid=".$_GET['id'];
            $v_allsign_row=$db->findAll($sql);
            if (count($v_allsign_row)>$page) {
              $page+=10;
              echo "<a href='laboratoryinfo.php?id=".$_GET['id']."page=".$page."'><button class='btn btn-white btn-block'>Show More</button></a>";
            }
            ?>
          </div>
          <div class="tab-pane" id="followers">
            
            <div class="follower-list">
              
              <?php
                $sql="select * from v_stu_laboratory where laboratoryid=".$v_laboratory_row[0]['id'];
                $v_stu_laboratory_row=$db->findAll($sql);

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
                  echo "<div class='profile-position'><i class='fa fa-briefcase'></i> ".$v_stu_laboratory_row[$i]['proname']."</div>";
                  echo "<div class='profile-location'><i class='fa  fa-clock-o'></i> ".$v_stu_laboratory_row[$i]['time']."</div>";
                  echo "<div class='mb20'></div>";
                  echo "<button class='btn btn-sm btn-success mr5'><i class='fa fa-user'></i>详细资料</button>";
                  echo "<button class='btn btn-sm btn-white'><i class='fa fa-sign-out'></i>移出</button>";
                  echo "</div></div>";
                }
              ?>
              

            </div><!--follower-list -->

            <div class="tab-pane" id="now">
            
            <div class="follower-list">
              
              <?php
                $sql="select * from v_stu_laboratory where laboratoryid=".$v_laboratory_row[0]['id'];
                $v_stu_laboratory_row=$db->findAll($sql);

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
                  echo "<div class='profile-position'><i class='fa fa-briefcase'></i> ".$v_stu_laboratory_row[$i]['proname']."</div>";
                  echo "<div class='profile-location'><i class='fa  fa-clock-o'></i> ".$v_stu_laboratory_row[$i]['time']."</div>";
                  echo "<div class='mb20'></div>";
                  echo "<button class='btn btn-sm btn-success mr5'><i class='fa fa-user'></i>详细资料</button>";
                  echo "<button class='btn btn-sm btn-white'><i class='fa fa-sign-out'></i>移出</button>";
                  echo "</div></div>";
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
