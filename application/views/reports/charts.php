<!--We just need a JS file //-->
<script src="<?php echo base_url();?>assets/js/Chart-2.7.1.min.js"></script>
<br>
<div class="container-fluid" id="container">
  <div class=" row">
    <div class="col-2  col-sm-12 col-lg-2 col-xs-12">
      <table class="table table-bordered table-sm">
        <tr class="bg-primary text-center text-white">
          <th>Condition</th>
          <th>Nb of items</th>
        </tr>
        <tr>
          <td>New</td>
          <td>105</td>
        </tr>
        <tr>
          <td>Fair</td>
          <td>360</td>
        </tr>
        <tr>
          <td>Damaged</td>
          <td>43</td>
        </tr><tr>
          <td>Broken</td>
          <td>8</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
        <tr class="bg-primary text-center text-white">
          <th>Department</th>
          <th>Nb of items</th>
        </tr>
        <tr>
          <td>Admin</td>
          <td>10</td>
        </tr>
        <tr>
          <td>ERO</td>
          <td>2</td>
        </tr>
        <tr>
          <td>WEP</td>
          <td>60</td>
        </tr>
        <tr>
          <td>SNA</td>
          <td>80</td>
        </tr>
      </table>
    </div>
    <div class="col-5 col-sm-12 col-lg-5 col-xs-12 text-center">
      <!-- <h3>Nb of items by condition</h3> -->
      <canvas id="pie-chart" width="800" height="450"></canvas>
    </div>
    <div class="col-5 col-sm-12 col-lg-5 col-xs-12 text-center">
      <!-- <h3>Nb of items by department</h3> -->
      <canvas id="bar-chart" width="800" height="450"></canvas>
    </div>
  </div>
</div>



<script type="text/javascript">
  new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: ["New", "Fiar", "Damaged", "Broken",],
      datasets: [{
        label: "Population (millions)",
        backgroundColor: ["#00C853", "#0091EA","#FB8C00","#E65100"],
        data: [105,360,43,8]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Nb of items by condition'
      }
    }
  });
</script>

<script type="text/javascript">
// Bar chart
new Chart(document.getElementById("bar-chart"), {
  type: 'bar',
  data: {
    labels: ["Admin", "ERO", "WEP", "SNA"],
    datasets: [
    {
      label: "Population (millions)",
      backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9"],
      data: [10,2,60,80]
    }
    ]
  },
  options: {
    legend: { display: false },
    title: {
      display: true,
      text: 'Nb of items by department'
    }
  }
});
</script>