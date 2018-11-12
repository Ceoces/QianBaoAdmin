<?php require_once('logincheck.php'); ?>
<?php 
  include_once('mysql.class.php');
  $db=new Mysql();
  if($db->connect($dbhost,$dbuser,$dbpassword,$dbname))
  {
    echo "数据库连接失败";
    die;
  }
  if(isset($_GET['laboratoryid'])&&$_GET['laboratoryid']!=NULL){
      $kind=1;
  } else if(isset($_GET['proid'])&&$_GET['proid']!=NULL){
      $kind=0;
  } else {
    header("location:notfound.html");
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

  <title>实验室签报系统后台</title>

  <link href="css/style.default.css" rel="stylesheet">

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
      <h2><i class="fa fa-search"></i> 搜索 </h2>
    </div>
    
    <div class="contentpanel">
      
      <div class="row">
        <div class="col-sm-4 col-md-3">
            <form id="form" method="post" action="search.php">
              <h4 class="subtitle mb5">学生：</h4>
              <input type="text" value="<?php if(isset($_POST['stuname'])) echo $_POST['stuname']; ?>" class="form-control" name="sname" onkeydown="submit_form(event)" />
              
              <div class="mb20"></div>

              <h4 class="subtitle mb5">添加到：</h4>
              <select class="form-control chosen-select" data-placeholder=<?php echo "'选择一个".($kind?"实验室":"项目")."'"; ?> name=<?php echo "'".($kind?"lab":"pro")."'"; ?> value="1">
                  <option value=""></option>
                  <?php 
                      $sql="select * from ".($kind?"t_laboratory":"t_project");
                      $row = $db->findAll($sql);
                      for($i=0;$i<count($row);$i++){
                        echo "<option value='".$row[$i]['id'];
                        if($_GET[($kind?'laboratoryid':'proid')]==$row[$i]['id']) 
                          echo " selected='selected'";
                        echo "'>".$row[$i]['name']."</option>";
                      }
                   ?>
              </select>
            </form>
            
            <br />
        <?php 
          if(isset($_POST['sname'])){
            $sql = "select * from t_student where name like '%".mysql_real_escape_string($_POST['sname'])."%'";
          } else {
            $sql = "select * from t_student";
          }
          $row=$db->findAll($sql);
          $len=count($row);
         ?>
        </div><!-- col-sm-4 -->
        <div class="col-sm-8 col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">搜索结果</h4>
                    <p>About <?php echo $len; ?> results.</p>
                </div><!-- panel-heading -->
                <div class="panel-body">
                    
                    <div class="results-list">
                        
                        <?php 
                          for($i=0;$i<count($row);$i++){
                            echo "<div class='media'>";
                            echo "    <a class='pull-right'>";
                            echo "      <button class='btn btn-primary'>加入</button>";
                            echo "    </a>";
                            echo "    <div class='media-body'>";
                            echo "      <a href='stuinfo.php?id=".$row[$i]['id']."' ><h4 class='filename text-primary'>".$row[$i]['name']."</h4></a>";
                            echo "      <small class='text-muted'>班级: ".$row[$i]['class']."</small><br />";
                            echo "      <small class='text-muted'>学号: ".$row[$i]['id']."</small><br />";
                            echo "      <small class='text-muted'>手机: ".($row[$i]['phone']==NULL?"暂无":$row[$i]['phone'])."</small>";
                            echo "    </div>";
                            echo "</div>";
                          }
                         ?>
                    </div><!-- results-list -->
                    
                </div><!-- panel-body -->
            </div><!-- panel -->
        </div><!-- col-sm-8 -->
      </div><!-- row -->
      
    </div>
    
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

<script src="js/jquery-ui-1.10.3.min.js"></script>
<script src="js/chosen.jquery.min.js"></script>

<script src="js/custom.js"></script>

<script type="text/javascript">
  function submit_form(e){
    e = e ? e : window.event;
　　var keyCode = e.which ? e.which : e.keyCode;
　　if(keyCode == 13) {
　　　　document.getElementById('form').submit();
　　}
  }
</script>

<script>
    jQuery(document).ready(function() {
        
        // Basic Slider
        jQuery('#slider').slider({
          range: "min",
          max: 100,
          value: 50
        });
        
        // Chosen Select
        jQuery(".chosen-select").chosen({'width':'100%','white-space':'nowrap'});
        
        // Date Picker
        jQuery('#datepicker').datepicker();
        
    });
</script>

</body>
</html>
