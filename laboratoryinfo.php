<?php
  require_once('logincheck.php'); 
  header("Content-Type: text/html; charset=utf-8");
  include_once('mysql.class.php');
  if (isset($_GET['id'])) {
    $sql="select * from v_laboratory where id=".$_GET['id'];
  }
  $v_laboratory_row=$db->findAll($sql);
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
          <li><a href="index.html">主页</a></li>
          <li><a href="general-forms.html">实验室管理</a></li>
          <li class="active">实验室信息</li>
        </ol>
      </div>
    </div>

    <div class="contentpanel">
      
      <div class="row">
        
        <div class="col-sm-12">
          
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
          <li class="active"><a href="#activities" data-toggle="tab">签到情况</a></li>
          <li><a href="#followers" data-toggle="tab">成员</a></li>
          <li><a href="#following" data-toggle="tab"><strong>详细信息</strong></a></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="activities">
            <div class="activity-list">
              
              <div class="media act-media">
                <a class="pull-left" href="#">
                  <img class="media-object act-thumb" src="images/photos/user1.png" alt="" />
                </a>
                <div class="media-body act-media-body">
                  <strong>Ray Sin</strong> is now following to <strong>Chris Anthemum</strong>. <br />
                  <small class="text-muted">Yesterday at 1:30pm</small>
                </div>
              </div><!-- media -->
              
            </div><!-- activity-list -->

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
            
          </div>
          <div class="tab-pane" id="following">
            
            <div class="activity-list">
              
              
              
              <div class="media act-media">
                <a class="pull-left" href="#">
                  <img class="media-object act-thumb" src="images/photos/user1.png" alt="" />
                </a>
                <div class="media-body act-media-body">
                  <strong>Ray Sin</strong> is now following to <strong>Chris Anthemum</strong>. <br />
                  <small class="text-muted">Yesterday at 1:30pm</small>
                </div>
              </div><!-- media -->
              
              
              
            </div><!-- activity-list -->
            
            <button class="btn btn-white btn-block">Show More</button>
            
          </div>
          <div class="tab-pane" id="events">
            <div class="events">
              <h5 class="subtitle">Upcoming Events</h5>
              <div class="row">
                <div class="col-sm-6">
                  <div class="media">
                    <a class="pull-left" href="#">
                      <img class="media-object" src="holder.js/100x120.html" alt="" />
                    </a>
                    <div class="media-body event-body">
                      <h4 class="event-title"><a href="#">Free Living Trust Seminar</a></h4>
                      <small class="text-muted"><i class="fa fa-map-marker"></i> Silicon Valley, San Francisco, CA</small>
                      <small class="text-muted"><i class="fa fa-calendar"></i> Sunday, January 15, 2014 at 11:00am</small>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...</p>
                    </div>
                  </div><!-- media -->
                </div><!-- col-sm-6 -->
                
                <div class="col-sm-6">
                  <div class="media">
                    <a class="pull-left" href="#">
                      <img class="media-object" src="holder.js/100x120.html" alt="" />
                    </a>
                    <div class="media-body event-body">
                      <h4 class="event-title"><a href="#">Serious Games Seminar</a></h4>
                      <small class="text-muted"><i class="fa fa-map-marker"></i> New York City</small>
                      <small class="text-muted"><i class="fa fa-calendar"></i> Monday, January 14, 2014 at 8:00am</small>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...</p>
                    </div>
                  </div><!-- media -->
                </div><!-- col-sm-6 -->
                
                <div class="col-sm-6">
                  <div class="media">
                    <a class="pull-left" href="#">
                      <img class="media-object" src="holder.js/100x120.html" alt="" />
                    </a>
                    <div class="media-body event-body">
                      <h4 class="event-title"><a href="#">Travel &amp; Adventure Show</a></h4>
                      <small class="text-muted"><i class="fa fa-map-marker"></i> Los Angeles, CA</small>
                      <small class="text-muted"><i class="fa fa-calendar"></i> Friday, January 12, 2014 at 8:00am</small>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...</p>
                    </div>
                  </div><!-- media -->
                </div><!-- col-sm-6 -->
                
                <div class="col-sm-6">
                  <div class="media">
                    <a class="pull-left" href="#">
                      <img class="media-object" src="holder.js/100x120.html" alt="" />
                    </a>
                    <div class="media-body event-body">
                      <h4 class="event-title"><a href="#">Mobile Games Summit</a></h4>
                      <small class="text-muted"><i class="fa fa-map-marker"></i> Bay Area, San Francisco</small>
                      <small class="text-muted"><i class="fa fa-calendar"></i> Saturday, January 10, 2014 at 8:00am</small>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...</p>
                    </div>
                  </div><!-- media -->
                </div><!-- col-sm-6 -->
              </div>
              
              <br />
              
              <h5 class="subtitle">Past Events</h5>
              <div class="row">
                <div class="col-sm-6">
                  <div class="media">
                    <a class="pull-left" href="#">
                      <img class="media-object" src="holder.js/100x120.html" alt="" />
                    </a>
                    <div class="media-body event-body">
                      <h4 class="event-title"><a href="#">Free Living Trust Seminar</a></h4>
                      <small class="text-muted"><i class="fa fa-map-marker"></i> Silicon Valley, San Francisco, CA</small>
                      <small class="text-muted"><i class="fa fa-calendar"></i> Sunday, January 15, 2014 at 11:00am</small>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...</p>
                    </div>
                  </div><!-- media -->
                </div><!-- col-sm-6 -->
                
                <div class="col-sm-6">
                  <div class="media">
                    <a class="pull-left" href="#">
                      <img class="media-object" src="holder.js/100x120.html" alt="" />
                    </a>
                    <div class="media-body event-body">
                      <h4 class="event-title"><a href="#">Serious Games Seminar</a></h4>
                      <small class="text-muted"><i class="fa fa-map-marker"></i> New York City</small>
                      <small class="text-muted"><i class="fa fa-calendar"></i> Monday, January 14, 2014 at 8:00am</small>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...</p>
                    </div>
                  </div><!-- media -->
                </div><!-- col-sm-6 -->
                
                <div class="col-sm-6">
                  <div class="media">
                    <a class="pull-left" href="#">
                      <img class="media-object" src="holder.js/100x120.html" alt="" />
                    </a>
                    <div class="media-body event-body">
                      <h4 class="event-title"><a href="#">Travel &amp; Adventure Show</a></h4>
                      <small class="text-muted"><i class="fa fa-map-marker"></i> Los Angeles, CA</small>
                      <small class="text-muted"><i class="fa fa-calendar"></i> Friday, January 12, 2014 at 8:00am</small>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...</p>
                    </div>
                  </div><!-- media -->
                </div><!-- col-sm-6 -->
                
                <div class="col-sm-6">
                  <div class="media">
                    <a class="pull-left" href="#">
                      <img class="media-object" src="holder.js/100x120.html" alt="" />
                    </a>
                    <div class="media-body event-body">
                      <h4 class="event-title"><a href="#">Mobile Games Summit</a></h4>
                      <small class="text-muted"><i class="fa fa-map-marker"></i> Bay Area, San Francisco</small>
                      <small class="text-muted"><i class="fa fa-calendar"></i> Saturday, January 10, 2014 at 8:00am</small>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...</p>
                    </div>
                  </div><!-- media -->
                </div><!-- col-sm-6 -->
              </div>
              
            </div><!-- events -->
          </div>
        </div><!-- tab-content -->
          
        </div><!-- col-sm-9 -->
      </div><!-- row -->
      
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->
  
  <div class="rightpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a href="#rp-alluser" data-toggle="tab"><i class="fa fa-users"></i></a></li>
        <li><a href="#rp-favorites" data-toggle="tab"><i class="fa fa-heart"></i></a></li>
        <li><a href="#rp-history" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
        <li><a href="#rp-settings" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
    </ul>
        
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="rp-alluser">
            <h5 class="sidebartitle">Online Users</h5>
            <ul class="chatuserlist">
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/userprofile.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Eileen Sideways</strong>
                            <small>Los Angeles, CA</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user1.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <span class="pull-right badge badge-danger">2</span>
                            <strong>Zaham Sindilmaca</strong>
                            <small>San Francisco, CA</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user2.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Nusja Nawancali</strong>
                            <small>Bangkok, Thailand</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user3.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Renov Leongal</strong>
                            <small>Cebu City, Philippines</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user4.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Weno Carasbong</strong>
                            <small>Tokyo, Japan</small>
                        </div>
                    </div><!-- media -->
                </li>
            </ul>
            
            <div class="mb30"></div>
            
            <h5 class="sidebartitle">Offline Users</h5>
            <ul class="chatuserlist">
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user5.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Eileen Sideways</strong>
                            <small>Los Angeles, CA</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user2.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Zaham Sindilmaca</strong>
                            <small>San Francisco, CA</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user3.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Nusja Nawancali</strong>
                            <small>Bangkok, Thailand</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user4.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Renov Leongal</strong>
                            <small>Cebu City, Philippines</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user5.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Weno Carasbong</strong>
                            <small>Tokyo, Japan</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user4.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Renov Leongal</strong>
                            <small>Cebu City, Philippines</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user5.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Weno Carasbong</strong>
                            <small>Tokyo, Japan</small>
                        </div>
                    </div><!-- media -->
                </li>
            </ul>
        </div>
        <div class="tab-pane" id="rp-favorites">
            <h5 class="sidebartitle">Favorites</h5>
            <ul class="chatuserlist">
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user2.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Eileen Sideways</strong>
                            <small>Los Angeles, CA</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user1.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Zaham Sindilmaca</strong>
                            <small>San Francisco, CA</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user3.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Nusja Nawancali</strong>
                            <small>Bangkok, Thailand</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user4.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Renov Leongal</strong>
                            <small>Cebu City, Philippines</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user5.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Weno Carasbong</strong>
                            <small>Tokyo, Japan</small>
                        </div>
                    </div><!-- media -->
                </li>
            </ul>
        </div>
        <div class="tab-pane" id="rp-history">
            <h5 class="sidebartitle">History</h5>
            <ul class="chatuserlist">
                <li class="online">
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user4.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Eileen Sideways</strong>
                            <small>Hi hello, ctc?... would you mind if I go to your...</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user2.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Zaham Sindilmaca</strong>
                            <small>This is to inform you that your product that we...</small>
                        </div>
                    </div><!-- media -->
                </li>
                <li>
                    <div class="media">
                        <a href="#" class="pull-left media-thumb">
                            <img alt="" src="images/photos/user3.png" class="media-object">
                        </a>
                        <div class="media-body">
                            <strong>Nusja Nawancali</strong>
                            <small>Are you willing to have a long term relat...</small>
                        </div>
                    </div><!-- media -->
                </li>
            </ul>
        </div>
        <div class="tab-pane pane-settings" id="rp-settings">
            
            <h5 class="sidebartitle mb20">Settings</h5>
            <div class="form-group">
                <label class="col-xs-8 control-label">Show Offline Users</label>
                <div class="col-xs-4 control-label">
                    <div class="toggle toggle-success"></div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-xs-8 control-label">Enable History</label>
                <div class="col-xs-4 control-label">
                    <div class="toggle toggle-success"></div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-xs-8 control-label">Show Full Name</label>
                <div class="col-xs-4 control-label">
                    <div class="toggle-chat1 toggle-success"></div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-xs-8 control-label">Show Location</label>
                <div class="col-xs-4 control-label">
                    <div class="toggle toggle-success"></div>
                </div>
            </div>
            
        </div><!-- tab-pane -->
        
    </div><!-- tab-content -->
  </div><!-- rightpanel -->
  
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
