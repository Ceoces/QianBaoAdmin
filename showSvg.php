

<?php
  function createSvg($id,$data)
  {
    //在jQuery(document).ready()中使用
    echo "";
    echo "new Morris.Area({";
    echo "   element: '".$id."',";
    echo "    data: [";
    $i=0;
    foreach ($data as $key => $value) {
      $i++;
      if($i!=1)echo ",";
      if($i>5)break;
      echo "{ y: '" . $key ."' , a: ". $value;
    }
    echo "]";
    echo "xkey: 'y',";
    echo "ykeys: ['a'],";
    echo "labels: ['人数'],";
    echo "lineColors: ['#1CAF9A'],";
    echo "lineWidth: '1px',";
    echo "fillOpacity: 0.8,";
    echo "smooth: false,";
    echo "hideHover: true";
    echo "});";
  }
?>