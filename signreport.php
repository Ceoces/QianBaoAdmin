<?php require_once('logincheck.php'); ?>
<?php   
  header("Content-Type: text/html; charset=utf-8");
  
  include_once('mysql.class.php');
  $db=new Mysql();
  
  
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
  <link href="css/jquery.datatables.css" rel="stylesheet">
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
    
    <div class="headerbar">
      
      <a class="menutoggle"><i class="fa fa-bars"></i></a>
      
      <?php require_once('headerright.php'); ?>
      
    </div><!-- headerbar -->
      
    <div class="pageheader">
      <h2><i class="fa fa-home"></i> 实验室签报情况 </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">位置：</span>
        <ol class="breadcrumb">
          <li><a href="index.html">主页</a></li>
          <li>实验室签报情况</li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="#" class="panel-close">&times;</a>
            <a href="#" class="minimize">&minus;</a>
          </div>
          <h4 class="panel-title">近期签报情况</h4>
        </div><!-- panel-heading -->
        <div class="panel-body">
          <div class="table-responsive">
          <table class="table" id="table2">
              <thead>
                 <tr>
                    <th>签报时间</th>
                    <th>学生姓名</th>
                    <th>签报状态</th>
                    <th>实验室</th>
                    <th>座位</th>
                    <th>指导教师</th>
                 </tr>
              </thead>
              <tbody>
                 <?php  
                 $sql="select * from v_signtable order by time desc limit 0,30";
                  if($db->connect($dbhost,$dbuser,$dbpassword,$dbname))
                  {
                    echo "数据库连接错误";
                    die;
                  }
                  $row=$db->findAll($sql);
                      for ($i=0; $i < count($row); $i++) 
                      { 
                        echo "<tr class='odd gradeX'>";
                        echo "<td>".$row[$i]['time']."</td>";
                        echo "<td><a href='proinfo.php'>".$row[$i]['stuname']."</a></td>";
                        if($row[$i]['static']=="1"){
                          echo "<td><p class='text-success'>进入</p></td>";
                        }
                        else{
                          echo "<td><p class='text-danger'>离开</p></td>";
                        }
                        echo "<td>".$row[$i]['laboratoryname']."</td>";
                        echo "<td>".$row[$i]['seat']."</td>";
                        echo "<td>".$row[$i]['teachername']."</td>";
                        echo "</tr>";
                      }
                 ?>
              </tbody>
           </table>
          </div><!-- table-responsive -->
          
        </div><!-- panel-body -->
      </div><!-- panel -->    
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

<script src="js/flot/flot.min.js"></script>
<script src="js/flot/flot.resize.min.js"></script>
<script src="js/flot/flot.symbol.min.js"></script>
<script src="js/flot/flot.crosshair.min.js"></script>
<script src="js/flot/flot.categories.min.js"></script>
<script src="js/flot/flot.pie.min.js"></script>
<script src="js/morris.min.js"></script>
<script src="js/raphael-2.1.0.min.js"></script>

<script src="js/custom.js"></script>
<script src="js/charts.js"></script>
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

</body>
</html>