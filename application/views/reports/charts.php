<!--We just need a JS file //-->
<script src="<?php echo base_url();?>assets/js/Chart-2.7.1.min.js"></script>
<style>
  #table-info {
    display: none;
  }
  .filter-select {
    margin-bottom: 10px;
  }
  .report-collumn {
    padding: 0;
  }
  .selection .select2-selection {
    height: 37px;
    padding-top: 3px;
  }

  .selection .select2-selection .select2-selection__arrow {
    height: 37px;
  }
</style>
<div class="container " id="container">
  <u><h2 class="text-center"><?php echo $title; ?></h2></u>
  <div class="row filter-select">
    <label for="filter">Type of report:</label>
    <select class="form-control" id="choose-filter" name="filter">
      <option value="Conditions" selected>Conditions</option>
      <option value="Categories">Categories</option>
      <option value="Materials">Materials</option>
      <option value="Departments">Departments</option>
      <option value="Brands">Brands</option>
      <option value="Location">Location</option>
      <option value="Owner">Owner</option>
    </select>
  </div>
  <div class="row">
    <div class="report-collumn col"></div>
    <div class="report-collumn col-5">
      <table id="table-info" class="table table-bordered bg-light">
        <thead>
          <tr class="bg-info text-white">
            <th id="selection-type"></th>
            <th>Number of items</th>
          </tr>
        </thead>
        <tbody id="data-table">
        </tbody>
      </table>
    </div>
    <div class="report-collumn col"></div>
    <div class="report-collumn col-4">
      <canvas id="chart" width="500" height="500" class="chartjs-render-monitor">
      </canvas>
    </div>
    <div class="report-collumn col"></div>
  </div>
  <!-- <br><hr><br>
  <div class="row">
    <div class="col-1"></div>
    <div class="col-4 col-sm-12 col-lg-4 col-xs-12">
      <br>
      <br>
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
      <h3>Nb of items by department Bar chart</h3>
      <canvas id="bar-chart" width="1000" height="650">

      </canvas>
    </div>
  </div> -->
</div>
<script type="text/javascript">
  $(function(){
    const urlsFilter = {
      Conditions: 'reports/getCountCondition',
      Categories: 'reports/getItemCountByCategory',
      Materials: 'reports/getItemCountByMaterial',
      Departments: 'reports/getItemCountByDepartment',
      Brands: 'reports/getItemCountByBrand',
      Location: 'reports/getItemCountByLocation',
      Owner: 'reports/getItemCountByOwner'
    }
    let chart = new Chart($("#chart"), { //draw a pie chart
      responsive: true,
      type: 'pie',
      data: {
        // labels: json.result.map(j => j.key),
        datasets: [{
          backgroundColor: [
            "#00C853",
            "#0091EA",
            "#FB8C00",
            "#E65100",
            "#00C853",
            "#0091EA",
            "#FB8C00",
            "#E65100",
          ],
          // data get from controller
          // data: json.result.map(j => j.count)
        }]
      },
      options: {
        legend: {
         position: 'right'
        },
         title: {
          padding: 40,
          fontSize: 15,
          display: true,
          // text: `Number of items by ${json.title}:`
        }
      }
    });
    $('#choose-filter').select2({
      minimumResultsForSearch: Infinity
    });
    $('#choose-filter').on('select2:select', function (e) {
      showChart(urlsFilter[e.params.data.text]);
    });
    // function count department from item and add into table
    showChart(urlsFilter.Conditions);
    function showChart(url){
      fetch('<?php echo base_url();?>' + url, { credentials: 'include' })
      .then((response) => response.json())
      .then(json => {
        $('#selection-type').html(json.title.charAt(0).toUpperCase() + json.title.slice(1));
        $('#data-table').empty();
        json.result.forEach(row => {
          $('#data-table').append(
            `<tr>
              <td>${row.key}</td>
              <td>${row.count}</td>
            </tr>`
          )
        });
        $('#table-info').fadeIn();
        let i = 0;
        chart.options.title.text = `Number of items by ${json.title}:`;
        while(i < chart.data.labels.length && i < json.result.length) {
          chart.data.labels[i] = json.result[i].key;
          chart.data.datasets[0].data[i] = json.result[i].count;
          i++;
        }
        if(chart.data.labels.length > json.result.length) {
          let length = chart.data.labels.length;
          for(i; i < length; i++){
            removeData(chart);
          }
        }
        if(chart.data.labels.length < json.result.length) {
          let length = json.result.length;
          for(i; i < length; i++){
            addData(chart, json.result[i].key, json.result[i].count);
          }
        }
        chart.data.datasets[0].backgroundColor = getColorPaletteGradient(json.result.length);
        chart.update();
      });
    }
    // function showDepartment(){
    //   $.ajax({
    //     type: 'ajax',
    //     //access to controller report to get data count department
    //     url: '<?php echo base_url();?>/reports/showDepCount',
    //     async: true,
    //     dataType: 'json',
    //     success: function(data){
    //       var html = '';
    //       var i;
    //       for(i=0; i<data.result.length; i++)
    //       {
    //         html +='<tr>'+
    //         '<td>'+data.result[i].department+'</td>'+
    //         '<td>'+data.result[i].itemcount+'</td>'+
    //        '</tr>';
    //       }
    //       $('#showdata').html(html);
    //     },
    //     error: function()
    //     {
    //      alert('Could not get Data from Database');
    //     }
    //   });
    // }

    function addData(chart, label, data) {
      chart.data.labels.push(label);
      chart.data.datasets[0].data.push(data);
      chart.update();
    }

    function removeData(chart) {
        chart.data.labels.pop();
        chart.data.datasets[0].data.pop();
        chart.update();
    }

    function getColorPaletteGradient(number) {
      // let firstColor = ['ee', '09', '79'];
      // let secondColor = ['ff', '6a', '00'];
      let firstColor = ['2d', '14', 'e8'];
      let secondColor = ['00', 'ff', '7b'];
      let colors = ['#' + firstColor[0] + firstColor[1] + firstColor[2]];
      for(let i = 1; i <= number - 2; i++){
        let r = parseInt(firstColor[0], 16) +
          (parseInt(secondColor[0], 16) - parseInt(firstColor[0], 16)) / number * (i + 1);
        let g = parseInt(firstColor[1], 16) +
          (parseInt(secondColor[1], 16) - parseInt(firstColor[1], 16)) / number * (i + 1);
        let b = parseInt(firstColor[2], 16) +
          (parseInt(secondColor[2], 16) - parseInt(firstColor[2], 16)) / number * (i + 1);
        colors.push(
          '#' +
          (Math.trunc(r).toString(16).length === 2 ? Math.trunc(r).toString(16) : '0' + Math.trunc(r).toString(16)) +
          (Math.trunc(g).toString(16).length === 2 ? Math.trunc(g).toString(16) : '0' + Math.trunc(g).toString(16)) +
          (Math.trunc(b).toString(16).length === 2 ? Math.trunc(b).toString(16) : '0' + Math.trunc(b).toString(16))
        )
      }
      colors.push('#' + secondColor[0] + secondColor[1] + secondColor[2]);
      return colors;
    }
  });
  // barchart(); //call function barchart to use


  // variable store plugin show value on chart (use in bar chart)
  // var plugin={
  //   afterDatasetsDraw: function(chart, easing)
  //   {
  //     // To only draw at the end of animation, check for easing === 1
  //     var ctx = chart.ctx;
  //     chart.data.datasets.forEach(function (dataset, i)
  //     {
  //       var meta = chart.getDatasetMeta(i);
  //       if (!meta.hidden)
  //       {
  //         meta.data.forEach(function(element, index) {
  //           // Draw the text in black, with the specified font
  //           ctx.fillStyle = 'rgb(0, 0, 0)';
  //           var fontSize = 16;
  //           var fontStyle = 'normal';
  //           var fontFamily = 'Helvetica Neue';
  //           ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);
  //           // Just naively convert to string for now
  //           var dataString = dataset.data[index].toString();
  //           // Make sure alignment settings are correct
  //           ctx.textAlign = 'center';
  //           ctx.textBaseline = 'middle';
  //           var padding = 5;
  //           var position = element.tooltipPosition();
  //           ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
  //         });
  //       }
  //     });
  //   }
  // };
  //
  // // function count item and set in bar chart
  // function barchart(){
  //   fetch('<?php echo base_url();?>reports/showDepCount', { credentials: 'include' })
  //   .then((response) => response.json())
  //   .then(json => {
  //       // Draw bar chart
  //     var ctx = $("#bar-chart");
  //     // create object bar chart
  //     var barChart = new Chart(ctx,
  //     {
  //       plugins: [plugin],
  //       type: 'bar',
  //       data: {
  //         labels: json.result.map(j => j.department),
  //         datasets: [{
  //           backgroundColor: [
  //             "#546e7a",
  //             "#9e9d24",
  //             "#e65100",
  //             "#8e5ea2",
  //             "#3cba9f",
  //             "#3e95cd",
  //             "#e8c3b9",
  //             "#e8c3a9",
  //             "#e8c2b9",
  //             "#3caa9f",
  //             "#a8c3d9",
  //             "#00897b",
  //             "#43a047",
  //           ],
  //           data: json.result.map(j => j.itemcount)
  //         }]
  //       },
  //       options: {
  //       title: {
  //         padding: 40,
  //         fontSize: 15,
  //         display: true,
  //         text: json.title
  //       },
  //       legend: {
  //         display: false,
  //       },
  //       scales: {
  //         yAxes: [{
  //           id: 'y-axis-0',
  //           gridLines: {
  //             display: true,
  //             lineWidth: 0.5,
  //             color: "rgba(0,0,0,0.30)"
  //           },
  //           ticks: {
  //             beginAtZero:true,
  //             mirror:false,
  //             suggestedMin: 0,
  //                   // suggestedMax: 500,
  //           },
  //           afterBuildTicks: function(chart)
  //           {
  //
  //           }
  //         }],
  //         xAxes: [{
  //           id: 'x-axis-0',
  //           gridLines:
  //           {
  //             display: false
  //           },
  //           ticks:
  //           {
  //             beginAtZero: true
  //           }
  //         }]
  //       }
  //
  //     }
  //   });
  // });
//}

</script>
