<?php
require_once('logincheck.php');
header("Content-Type: text/html; charset=utf-8");
include_once('mysql.class.php');
if (isset($_GET['id'])) {
    $sql = "select * from t_teacher where id=" . $_GET['id'];
}
$t_teacher_row = $db->findAll($sql);
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
      <h2><i class="fa fa-home"></i> 教师信息 </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">位置：</span>
        <ol class="breadcrumb">
          <li><a href="index.php">主页</a></li>
          <li><a href="teachertable.php">教师管理</a></li>
          <li class="active">教师信息</li>
        </ol>
      </div>
    </div>

    <div class="contentpanel">
      
      <div class="row">

        <div class="col-sm-3">
          <img src="images/photos/profile-1.png" class="thumbnail img-responsive" alt="">

        </div>
        
        <div class="col-sm-9">
          
          <div class="profile-header">
            <h2 class="profiile-name"><?php echo $t_teacher_row[0]['name']; ?></h2>
            <div class="profile-location"><i class="fa fa-user"></i>
              <?php 
                if ($t_teacher_row[0]['id'] != "") {
                    echo $t_teacher_row[0]['id'];
                } else {
                    echo "暂无";
                } ?>
            </div>
            <div class="profile-position"><i class="fa  fa-phone"></i> 
              <?php 
                if ($t_teacher_row[0]['phone'] != "") {
                    echo $t_teacher_row[0]['phone'];
                } else {
                    echo "暂无";
                } ?>
            </div>
            <div class="profile-location"><i class="fa  fa-envelope"></i>
              <?php 
                if ($t_teacher_row[0]['email'] != "") {
                    echo $t_teacher_row[0]['email'];
                } else {
                    echo "暂无";
                } ?>
            </div>
            
            <div class="mb20"></div>
          <p class="mb30"><?php echo $t_teacher_row[0]['info']; ?> </p>

          </div><!-- profile-header -->
          
          <!-- Nav tabs -->
        <!-- <ul class="nav nav-tabs nav-justified nav-profile">
          <li class="active"><a href="#activities" data-toggle="tab">成员</a></li>
        </ul>
        -->
        <!--  Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="activities">
            <div class="activity-list">
            <?php
            $sql = "select id,name,stunum from t_laboratory where teacherid=" . $_GET['id'];
            $v_tea_lab_row = $db->findAll($sql);

            if (count($v_tea_lab_row) == 0) {
                echo "暂无管理的实验室";
            }
            for ($i = 0; $i < count($v_tea_lab_row); $i++) {
                echo "<div class='media'>";
                echo "<a class='pull-left' href='#'>";
                echo "<img class='media-object' src='holder.js/100x125.html' alt='' /></a>";
                echo "<div class='media-body'>";
                echo "<h3 class='follower-name'>" . $v_tea_lab_row[$i]['id'] . "</h3>";
                echo "<div class='profile-location'><i class='fa fa-map-marker'></i> " . $v_tea_lab_row[$i]['name'] . "</div>";
                echo "<div class='profile-position'><i class='fa fa-user'></i> " . $v_tea_lab_row[$i]['stunum'] . "</div>";
                //echo "<div class='profile-location'><i class='fa  fa-clock-o'></i> " . $v_tea_lab_row[$i]['time'] . "</div>";
                echo "<div class='mb20'></div>";
                echo "<button class='btn btn-sm btn-success mr5'><i class='fa fa-user'></i>详细资料</button>";
                echo "<button class='btn btn-sm btn-white'><i class='fa fa-sign-out'></i>移出</button>";
                echo "</div></div>";
            }
            ?>
            
            </div>
          </div>
          
          </div>
        </div>
        <!-- col-sm-9 -->
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
