

<?php
  function createCharm($id,$data)
  {
    echo '<script>';
    echo 'var dom = document.getElementById(".$id.");';
    echo 'var myChart = echarts.init(dom);';
    echo 'var app = {};';
    echo 'option = null;';
    echo 'app.title = '本周人流量';';

    echo 'option = {';
    echo '    color: ['#3398DB'],';
    echo '    tooltip : {';
    echo '        trigger: 'axis',';
    echo '        axisPointer : {            // 坐标轴指示器，坐标轴触发有效';
    echo '            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'';
    echo '        }';
    echo '    },';
    echo '    grid: {';
    echo '        left: '3%',';
    echo '        right: '4%',';
    echo '        bottom: '3%',';
    echo '        containLabel: true';
    echo '    },';
    echo '    xAxis : [';
    echo '        {';
    echo '            type : 'category',';
    echo '            data : ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],';
    echo '            axisTick: {';
    echo '                alignWithLabel: true';
    echo '            }';
    echo '        }';
    echo '    ],';
    echo '    yAxis : [';
    echo '        {';
    echo '            type : 'value'';
    echo '        }';
    echo '    ],';
    echo '    series : [';
    echo '        {';
    echo '            name:'当日人数',';
    echo '            type:'bar',';
    echo '            barWidth: '60%',';
    echo '            data:[10, 52, 200, 334, 390, 330, 220]';
    echo '        }';
    echo '    ]';
    echo '};';
    echo ';';
    echo 'if (option && typeof option === "object") {';
    echo '    myChart.setOption(option, true);';
    echo '}';
    echo '</script>';
  }
?>

