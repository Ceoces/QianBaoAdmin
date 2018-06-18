<?php require_once('logincheck.php'); ?>
<?php   
  header("Content-Type: text/html; charset=utf-8");
  
  include_once('mysql.class.php');
  $db=new Mysql();
  
  $sql="select * from view_sign order by time desc limit 0,30";
  if($db->connect($dbhost,$dbuser,$dbpassword,$dbname))
  {
    echo "数据库连接错误";
    die;
  }
  $row=$db->findAll($sql);
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
                    <th>座位</th>
                    <th>指导教师</th>
                 </tr>
              </thead>
              <tbody>
                 <?php  
                      for ($i=0; $i < count($row); $i++) 
                      { 
                        echo "<tr class='odd gradeX'>";
                        echo "<td>".$row[$i]['time']."</td>";
                        echo "<td><a href='proinfo.php?id=" .$row[$i]['id']."'>".$row[$i]['name']."</a></td>";
                        if($row[$i]['static']=="1"){
                          echo "<td><p class='text-success'>进入</p></td>";
                        }
                        else{
                          echo "<td><p class='text-danger'>离开</p></td>";
                        }
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

      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="#" class="panel-close">&times;</a>
            <a href="#" class="minimize">&minus;</a>
          </div><!-- panel-btns -->
          <h4 class="panel-title">Morris Charts </h4>
          <p><a href="http://www.oesmith.co.uk/morris.js/index.html" target="_blank">Morris</a> chart - good-looking charts shouldn't be difficult.</p>
        </div><!-- panel-heading -->
        <div class="panel-body">
          <div class="row">
            <div class="col-md-6 mb30">
              <h5 class="subtitle">Area Chart</h5>
              <p>Area charts are used to represent cumulated totals using numbers or percentages (stacked area charts in this case) over time.</p>
              <div id="area-chart" style="height: 300px;"></div>
            </div>
            <div class="col-md-6 mb30">
              <h5 class="subtitle">Area Chart</h5>
              <p>Area charts are used to represent cumulated totals using numbers or percentages (stacked area charts in this case) over time.</p>
              <div id="area-chart" style="height: 300px;"></div>
            </div>
            
          </div><!-- row -->
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

<svg height="300" version="1.1" width="513" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;">
  <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc>
  <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
  <text x="30.5" y="263" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan>
  </text>
  <path fill="none" stroke="#aaaaaa" d="M43,263H488" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
  <text x="30.5" y="203.5" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">50</tspan>
  </text>
  <path fill="none" stroke="#aaaaaa" d="M43,203.5H488" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
  <text x="30.5" y="144" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">100</tspan>
  </text>
  <path fill="none" stroke="#aaaaaa" d="M43,144H488" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
  <text x="30.5" y="84.5" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">150</tspan>
  </text>
  <path fill="none" stroke="#aaaaaa" d="M43,84.5H488" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
  <text x="30.5" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">200</tspan>
  </text>
  <path fill="none" stroke="#aaaaaa" d="M43,25H488" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
  <text x="488" y="275.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6)">
    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012</tspan>
  </text>
  <text x="413.86718393427657" y="275.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6)">
    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011</tspan>
  </text>
  <text x="339.7343678685532" y="275.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6)">
    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010</tspan>
  </text>
  <text x="265.60155180282976" y="275.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6)">
    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2009</tspan>
  </text>
  <text x="191.26563213144684" y="275.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6)">
    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2008</tspan>
  </text>
  <text x="117.13281606572342" y="275.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6)">
    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2007</tspan>
  </text>
  <text x="43" y="275.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6)">
    <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2006</tspan>
  </text>
  <path fill="#eacca3" stroke="#000000" d="M43,203.5L117.13281606572342,96.4L191.26563213144684,155.9L265.60155180282976,96.4L339.7343678685532,155.9L413.86718393427657,96.4L488,36.900000000000006L488,263L43,263Z" fill-opacity="0.8" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0.8;"></path>
  <path fill="none" stroke="#f0ad4e" d="M43,203.5L117.13281606572342,96.4L191.26563213144684,155.9L265.60155180282976,96.4L339.7343678685532,155.9L413.86718393427657,96.4L488,36.900000000000006" stroke-width="1px" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
  <circle cx="43" cy="203.5" r="4" fill="#f0ad4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
  <circle cx="117.13281606572342" cy="96.4" r="4" fill="#f0ad4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
  <circle cx="191.26563213144684" cy="155.9" r="4" fill="#f0ad4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
  <circle cx="265.60155180282976" cy="96.4" r="4" fill="#f0ad4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
  <circle cx="339.7343678685532" cy="155.9" r="4" fill="#f0ad4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
  <circle cx="413.86718393427657" cy="96.4" r="4" fill="#f0ad4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
  <circle cx="488" cy="36.900000000000006" r="7" fill="#f0ad4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
  <path fill="#39c3b0" stroke="#000000" d="M43,227.3L117.13281606572342,173.75L191.26563213144684,203.5L265.60155180282976,173.75L339.7343678685532,203.5L413.86718393427657,173.75L488,144L488,263L43,263Z" fill-opacity="0.8" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 0.8;"></path>
  <path fill="none" stroke="#1caf9a" d="M43,227.3L117.13281606572342,173.75L191.26563213144684,203.5L265.60155180282976,173.75L339.7343678685532,203.5L413.86718393427657,173.75L488,144" stroke-width="1px" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
  <circle cx="43" cy="227.3" r="4" fill="#1caf9a" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
  <circle cx="117.13281606572342" cy="173.75" r="4" fill="#1caf9a" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
  <circle cx="191.26563213144684" cy="203.5" r="4" fill="#1caf9a" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
  <circle cx="265.60155180282976" cy="173.75" r="4" fill="#1caf9a" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
  <circle cx="339.7343678685532" cy="203.5" r="4" fill="#1caf9a" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
  <circle cx="413.86718393427657" cy="173.75" r="4" fill="#1caf9a" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
  <circle cx="488" cy="144" r="7" fill="#1caf9a" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
</svg>