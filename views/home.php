<style>
div#chartContainer {
    margin-top: 50px;
}
</style>
<section id="main-content">
  <section class="wrapper">
    <!--state overview start-->
    <div class="row state-overview panels-top-colored">
      <div class="col-lg-3 col-md-3 col-sm-6">
        <section class="panel panel-total-user Custom_height">
          <div class="symbol terques">
            <i class="fa fa-user"></i>
            <p>Users</p>
          </div>
          <div class="value">
            <h1 class="countt">
              <?php echo $total; ?>
            </h1>
          </div>
        </section>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6">
        <section class="panel panel-hours-worked Custom_height">
          <div class="symbol red">
           <!--  <i class="fa fa-clock-o" aria-hidden="true"></i> -->
          <i class="fa fa-users"></i>
            <p>Active Users</p>
          </div>
          <div class="value">
            <h1 class=" countt2">
              <?php echo $login; ?>
            </h1>
          </div>
        </section>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6">
        <section class="panel panel-task-created Custom_height">
          <div class="symbol yellow">
            <i class="fa fa-tasks" aria-hidden="true"></i>
            <p>Tasks</p>
          </div>
          <div class="value">
            <h1 class=" countt3">
              <?php echo $task; ?>
            </h1>                             
          </div>
        </section>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6">
        <section class="panel panel-challenge-created Custom_height">
          <div class="symbol blue">
            <i class="fa fa-bar-chart-o"></i>
            <p>Challenges</p>
          </div>
          <div class="value">
            <h1 class=" countt4">
              <?php echo $challenge; ?>
            </h1>                             
          </div>
        </section>
      </div>
      <!-- <div class="col-lg-4 col-sm-6">
        <section class="panel panel-reports-generated">
          <div class="symbol terques-chart">
            <i class="fa fa-file-text" aria-hidden="true"></i>
            <p>Reports Generated</p>
          </div>
          <div class="value">
            <h1 class=" count5">
              0
            </h1>
          </div>
        </section>
      </div> -->
      <!-- <div class="col-lg-4 col-sm-6">
        <section class="panel panel-applied-jobs">
          <div class="symbol green-chart">
            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
            <p>Applied Jobs</p>
          </div>
          <div class="value">
            <h1 class=" count6">
              0
            </h1>                             
          </div>
        </section>
      </div>        -->          
    </div>
    <!--state overview end-->
    <div class="row">
      <div id="chartContainer" style="height: 370px; width: 100%;"></div>
      <!-- <div class="col-lg-9">
        <section class="panel">
            <header class="panel-heading">
              xCharts 
            </header>
            <div class="panel-body">
              <figure class="demo-xchart" id="chart"></figure>
            </div>
        </section>                     
      </div> -->
<!--       <div class="col-lg-12">              
        <section class="panel doughnut-chart">
          <header class="panel-heading">
               All Record Data
          </header>
            <div id="piexhart" style="width: 100%; height: 300px; float: left">
         </section>
      </div>
    </div> -->

<!-- <div class="col-lg-12 col-md-12 col-sm-12 add_bg">
                      <div class="border-head">
                          <h3>Graph</h3>
                      </div>
                      <div class="custom-bar-chart">
                          <ul class="y-axis">
                              <li><span>100</span></li>
                              <li><span>80</span></li>
                              <li><span>60</span></li>
                              <li><span>40</span></li>
                              <li><span>20</span></li>
                              <li><span>0</span></li>
                          </ul>
                          <div class="bar">
                              <div class="title">JAN</div>
                              <div data-placement="top" data-toggle="tooltip" data-original-title="80%" class="value tooltips">80%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">FEB</div>
                              <div data-placement="top" data-toggle="tooltip" data-original-title="50%" class="value tooltips">50%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">MAR</div>
                              <div data-placement="top" data-toggle="tooltip" data-original-title="40%" class="value tooltips">40%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">APR</div>
                              <div data-placement="top" data-toggle="tooltip" data-original-title="55%" class="value tooltips">55%</div>
                          </div>
                          <div class="bar">
                              <div class="title">MAY</div>
                              <div data-placement="top" data-toggle="tooltip" data-original-title="20%" class="value tooltips">20%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">JUN</div>
                              <div data-placement="top" data-toggle="tooltip" data-original-title="39%" class="value tooltips">39%</div>
                          </div>
                          <div class="bar">
                              <div class="title">JUL</div>
                              <div data-placement="top" data-toggle="tooltip" data-original-title="75%" class="value tooltips">75%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">AUG</div>
                              <div data-placement="top" data-toggle="tooltip" data-original-title="45%" class="value tooltips">45%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">SEP</div>
                              <div data-placement="top" data-toggle="tooltip" data-original-title="50%" class="value tooltips">50%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">OCT</div>
                              <div data-placement="top" data-toggle="tooltip" data-original-title="42%" class="value tooltips">42%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">NOV</div>
                              <div data-placement="top" data-toggle="tooltip" data-original-title="60%" class="value tooltips">60%</div>
                          </div>
                          <div class="bar ">
                              <div class="title">DEC</div>
                              <div data-placement="top" data-toggle="tooltip" data-original-title="90%" class="value tooltips">90%</div>
                          </div>
                      </div>
 </div> -->

<!-- <div class="graph" id="hero-area"></div> -->


  </section>
</section>
<?php
  // $data = $data . "['Total Users '," . $total . "],";
  // $data = $data . "['Login Users '," . $login . "],";
  // $data = $data . "['Suspend Users '," . $suspend . "],";
  // $data = $data . "['Login Users '," . $login . "],";
?><!-- 
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script> -->
<!-- <script src="assets/morris.js-0.4.3/morris.min.js" type="text/javascript"></script>
<script src="assets/morris.js-0.4.3/raphael-min.js" type="text/javascript"></script> -->


<script type="text/javascript">

 /* Highcharts.chart('piexhart', {
    title: {
      text: ''
    },
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 50,
            beta: 0
        }
    },
    tooltip: {
        enabled: true,
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 25,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Total % ',
        data: [
            <?php echo $data; ?>
        ]
    }]
  });*/
</script>

<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<!-- <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script> -->
<!-- <script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<script>
window.onload = function() {

var dataPoints = [];
var dataPoints1 = [];
var dataPoints2 = [];
var dataPoints3 = [];

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title: {
    text: "Daily Report Of Last 30 Days",
    fontSize: 22
  },
  axisX: {
    valueFormatString: "DD MMM,YY"
  },
  axisY: {
    title: "",
    titleFontSize: 24
  },
  data: [{
    name: "Goals",
    type: "spline",
    yValueFormatString: "#,### Goals Created",
    showInLegend: true,
    dataPoints: dataPoints
  },
  {
    name: "Events",
    type: "spline",
    yValueFormatString: "#,### Events Created",
    showInLegend: true,
    dataPoints: dataPoints1
  },
  {
    name: "Task",
    type: "spline",
    yValueFormatString: "#,### Task Created",
    showInLegend: true,
    dataPoints: dataPoints2
  },
  {
    name: "Challenges",
    type: "spline",
    yValueFormatString: "#,### Challenge Created",
    showInLegend: true,
    dataPoints: dataPoints3
  }]
});
chart.render();
function addData(data) {
  for (var i = 0; i < data.length; i++) {
    dataPoints.push({
      x: new Date(data[i].datee),
      y: data[i].units
    });
  }
  chart.render();
}
function addData1(data) {
  // console.log(data.length);return false;
  // var date = new Date(data[0].datee);
  // var months=["JAN","FEB","MAR","APR","MAY","JUN","JUL",
  //         "AUG","SEP","OCT","NOV","DEC"];
  // var val=date.getDate()+" "+months[date.getMonth()]+" "+date.getFullYear();
  for (var i = 0; i < data.length; i++) {
    dataPoints1.push({
      x: new Date(data[i].datee),
      y: data[i].units
    });
  }
  chart.render();
}
function addData2(data) {
  for (var i = 0; i < data.length; i++) {
    dataPoints2.push({
      x: new Date(data[i].datee),
      y: data[i].units
    });
  }
  chart.render();
}
function addData3(data) {
  for (var i = 0; i < data.length; i++) {
    dataPoints3.push({
      x: new Date(data[i].datee),
      y: data[i].units
    });
  }
  chart.render();
}
$.getJSON("http://goachievenow.com/admin/Dashboard/spline/1", addData);
$.getJSON("http://goachievenow.com/admin/Dashboard/spline/2", addData1);
$.getJSON("http://goachievenow.com/admin/Dashboard/spline/3", addData2);
$.getJSON("http://goachievenow.com/admin/Dashboard/spline/4", addData3);
}
</script>





