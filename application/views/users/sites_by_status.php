 <h1><?= $title?></h1>

<!-- INI DIGANTI JADI BARCHART BERISIKAN SEMUA SITE -->
  
 <br>
  <a class="btn btn-primary" href="<?php echo base_url();?>permitsAndLicenses/all_details_by_status/<?php echo $status?>">All Site List</a>
 <br>
 <br>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
          <select class="custom-select" onchange="location = this.value">
            <option>Select site</option>
            <?php foreach($sites as $site):?>
              <option value="<?php echo base_url();?>users/site_details_by_status/<?php echo $site['id']?>/<?php echo $status?>"><?php echo $site['name']?></option>
            <?php endforeach;?>
        </select>
      </div>
    </div>
  </div>

 <div style="margin-top: 20px; border: 3px solid black; padding: 15px;">
  <div class="row">
    <div class="col-md-12">
      <p><small class="text-danger">** satuan dalam %</small></p>
      <canvas id="bar-chart"></canvas>
    </div>
  </div>
</div>
<!-- <?php if($status == 0):?>
  <th class="col-md-2">Not yet started</th>
<?php elseif($status == 1):?>
  <th class="col-md-2">In progress</th>
<?php else:?>
  <th class="col-md-2">Done</th>
<?php endif;?> -->
 
<!--<?php if($status == 0):?>
  <a class="btn btn-danger" href="<?php echo base_url();?>users/site_details_by_status/<?php echo $sites[0][$i]['id']?>/<?php echo $status?>">List</a>
<?php elseif($status == 1):?>
  <a class="btn btn-warning" href="<?php echo base_url();?>users/site_details_by_status/<?php echo $sites[0][$i]['id']?>/<?php echo $status?>">List</a>
<?php else:?>
  <a class="btn btn-success" href="<?php echo base_url();?>users/site_details_by_status/<?php echo $sites[0][$i]['id']?>/<?php echo $status?>">List</a>
<?php endif;?> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script  type="text/javascript">
  $(function(){
      //get the bar chart canvas
      var ctx = $("#bar-chart");
      var data = JSON.parse(`<?php echo $all_status; ?>`);
      var site_names = JSON.parse(`<?php echo $site_names; ?>`);

      data = {
          datasets: [{
              data: data,
              backgroundColor : [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
              ]
          }],

          // These labels appear in the legend and in the tooltips when hovering different arcs
          labels: site_names
      };

      var options = {
        responsive: true,
        legend: {
          display: false,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
      };
 
      //create bar Chart class object
      var chart1 = new Chart(ctx, {
        type: "bar",
        data: data,
        options: options
      });
 
  });
</script>