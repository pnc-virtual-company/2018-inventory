<!--We just need a JS file //-->
<script src="<?php echo base_url();?>assets/js/Chart-2.7.1.min.js"></script>
<br>
<div class="container " id="container">
  <div class="row">
    <div class="col-1"></div>
    <div class="col4 col-sm-12 col-lg-4 col-xs-12">
      <table class="table table-bordered bg-light">
        <tr class="bg-info text-white">
          <th>Condition</th>
          <th>Number of items</th>
        </tr>
        <tr>
          <td>New</td>
          <td>
            <?php 
            foreach ($reportNew as $key ) {

              $new= $key->countNew;
              echo $new;
            }
            ?>    
          </td>
        </tr>
        <tr>
          <td>Fair</td>
          <td>
            <?php 
            foreach ($reportFair as $key ) {
              $fair = $key->countFair;
              echo $fair;
            }
            ?>   
          </td>
        </tr>
        <tr>
          <td>Damaged</td>
          <td>
            <?php 
            foreach ($reportDamaged as $key ) {
              $Damaged = $key->countDamaged;
              echo $Damaged;
            }
            ?>   
          </td>
        </tr><tr>
          <td>Broken</td>
          <td>
            <?php 
            foreach ($reportBroken as $key ) {
              $Broken = $key->countBroken;
              echo $Broken;
            }
            ?>   
          </td>
        </tr>
      </table>
    </div>
    <div class="col-2"></div>
    <div class="col-4 col-sm-12 col-lg-4 col-xs-12 text-center">
      <!-- <h3>Nb of items by condition Pie chart</h3> -->
      <canvas id="pie-chart" width="667" height="450" class="chartjs-render-monitor">
      </canvas>
    </div>
  </div>
  <br><hr><br>
  <div class="row">
    <div class="col-1"></div>
    <div class="col-4 col-sm-12 col-lg-4 col-xs-12">
      <table class="table table-bordered bg-light">
        <thead>
          <tr class="bg-info text-white">
            <th>Department</th>
            <th>Number of items</th>
          </tr>
        </thead>
        <tbody id="showdata">

        </tbody>
      </table>
    </div>
    <div class="col-1"></div>
    <div class="col-6 col-sm-12 col-lg-6 col-xs-12 text-center">
      <!-- <h3>Nb of items by department Bar chart</h3> -->
      <canvas id="bar-chart" width="1000" height="450">

      </canvas>
    </div>
  </div>
</div><br><br>
<script>
  $(function(){
    showDepartment();
    var bar ='';
    // function count item and add to table
    function showDepartment(){
     $.ajax({
       type: 'ajax',
       url: '<?php echo base_url();?>/reports/showDepCount',
       async: true,
       dataType: 'json',
       success: function(data){
         var html = '';
         var i;                              
         for(i=0; i<data.length; i++){
           html +='<tr>'+
           '<td>'+
           data[i].department+
           '<td>'+data[i].itemcount+'</td>'+
           '</tr>';

           bar += '"'+ data[i].department+'",';
         }
         $('#showdata').html(html);
       },
       error: function(){
         alert('Could not get Data from Database');
       }
     });
   }

 });

  piechart();
  barchart();
// fucntion count item by condition report pie chart
function piechart(){
  new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: [ 
      "New", 
      "Fair", 
      "Damaged",
      "Broken",
      ],
      datasets: [{
        // label: "Population (millions)",
        backgroundColor: [
        "#00C853", 
        "#0091EA",
        "#FB8C00",
        "#E65100"
        ],
        data: [<?php echo $new; ?>,<?php echo $fair; ?>,<?php echo $Damaged; ?>,<?php echo $Broken; ?>]
      }]
    },
    options: {
      legend: {
       position: 'right'
     },
     title: {
      display: true,
      text: 'Number of items by condition:'
    }
  }
});
}

var plugin={
        afterDatasetsDraw: function(chart, easing) {
            // To only draw at the end of animation, check for easing === 1
            var ctx = chart.ctx;
            chart.data.datasets.forEach(function (dataset, i) {
                var meta = chart.getDatasetMeta(i);
                if (!meta.hidden) {
                    meta.data.forEach(function(element, index) {
                        // Draw the text in black, with the specified font
                        ctx.fillStyle = 'rgb(0, 0, 0)';

                        var fontSize = 16;
                        var fontStyle = 'normal';
                        var fontFamily = 'Helvetica Neue';
                        ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                        // Just naively convert to string for now
                        var dataString = dataset.data[index].toString();

                        // Make sure alignment settings are correct
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';

                        var padding = 5;
                        var position = element.tooltipPosition();
                        ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                    });
                }
            });
        }
    };

// funciton count item and set in bar chart
function barchart(){
  $.ajax({
    url: '<?php echo base_url();?>/reports/showDepCount',
    type: 'POST',
    dataType: 'json',
    success: function(data){
      var depCount = [];
      var dep = [];
      var i;                              
      for(i=0; i<data.length; i++){
        dep.push(data[i].department);
        depCount.push(data[i].itemcount);
      }
      var chartdata = {
        data: depCount,
        labels: dep,
        datasets: [{
          label: "Number of items by department",
          backgroundColor: [
          "#546e7a",
          "#9e9d24",
          "#e65100",
          "#8e5ea2",
          "#3cba9f",
          "#3e95cd", 
          "#e8c3b9",
          "#e8c3a9",
          "#e8c2b9",
          "#3caa9f",
          "#a8c3d9",
          "#00897b",
          "#43a047",
          ],
          data: depCount
        }] 
      };
          // Draw bar chart
          var ctx = $("#bar-chart");
          // create object bar chart
          var barChart = new Chart(ctx, {
            plugins: [plugin],
            type: 'bar',
            data: chartdata,
            options: {
              title: {
                display: true,
                text: 'Number of items by department:'
              },
              legend: {
                display: false,
              },
              scales: {
                yAxes: [{
                  id: 'y-axis-0',
                  gridLines: {
                    display: true,
                    lineWidth: 0.5,
                    color: "rgba(0,0,0,0.30)"
                  },
                  ticks: {
                    beginAtZero:true,
                    mirror:false,
                    suggestedMin: 0,
                    // suggestedMax: 500,
                  },
                  afterBuildTicks: function(chart) {

                  }
                }],
                xAxes: [{
                  id: 'x-axis-0',
                  gridLines: {
                    display: false
                  },
                  ticks: {
                    beginAtZero: true
                  }
                }]
              }

            }
          });
        },
        error: function(){
          alert('your coding is wrong,please check it again and look one by one(focus)....');
        }
      });
}

</script>