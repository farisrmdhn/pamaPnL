<?php if($this->session->flashdata('login_success')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('login_success').'</p>'; ?>
<?php endif; ?>
<?php if($this->session->flashdata('change_password')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('change_password').'</p>'; ?>
<?php endif; ?>
<h1><?= $title ?></h1>
<p><span class="badge badge-dark">last login : <?php echo $info['last_login'];?></span></p>
<p>id : <?php echo $info['id'];?> | my username : <?php echo $info['username'];?></p>


<a class="btn btn-success" href="<?php echo base_url();?>users/manage_user">Manage User</a>
<a class="btn btn-danger" href="<?php echo base_url();?>users/change_password">Change Password</a>
<a class="btn btn-primary" href="<?php echo base_url();?>users/export">Download full report</a>
<br>
<div style="margin-top: 20px; border: 3px solid black; padding: 15px;">
	<div class="row">
		<div class="col-md-12">
			<h3>Total Fulfillment : <span style="color: <?php echo $fulfillment_bar[2]?>;"><?php echo $fulfillment_bar[0]; ?> %</span></h3>
			<div class="progress">
			  <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $fulfillment_bar[1]?>" role="progressbar" aria-valuenow="<?php echo $fulfillment_bar[0]; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $fulfillment_bar[0]; ?>%"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8" style="margin-top: 25px;">
			<h3><a style="color: black;" href="<?php echo base_url(); ?>sitelist">Total Progress</a></h3>
			<hr>
			<canvas id="donut-chart"></canvas>
      <div class="text-center">
          <div class="col-md-3" style="display: inline-block;">
            <div style="border: 0.1 solid black; border-radius: 50%; height: 15px; width: 15px; display: inline-block; background-color: #808080;"></div>
            <a href="<?php echo base_url(); ?>users/sites_by_status/0" style="color: black;"> Not Yet Started </a>
          </div>
          <div class="col-md-2" style="display: inline-block;">
            <div style="border: 0.1 solid black; border-radius: 50%; height: 15px; width: 15px; display: inline-block; background-color: #6eeb34;"></div>
            <a href="<?php echo base_url(); ?>users/sites_by_status/1" style="color: black;"> Done </a>
          </div>
          <div class="col-md-2" style="display: inline-block;">
            <div style="border: 0.1 solid black; border-radius: 50%; height: 15px; width: 15px; display: inline-block; background-color: #f7df05;"></div>
            <a href="<?php echo base_url(); ?>users/sites_by_status/4" style="color: black;"> Proses Perpanjangan </a>
          </div>
          <div class="col-md-2" style="display: inline-block;">
            <div style="border: 0.1 solid black; border-radius: 50%; height: 15px; width: 15px; display: inline-block; background-color: #eb4f34;"></div>
            <a href="<?php echo base_url(); ?>users/sites_by_status/3" style="color: black;"> Expired </a>
          </div>
      </div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script  type="text/javascript">
  $(function(){
      //get the bar chart canvas
      var ctx = $("#donut-chart");
      var data = JSON.parse(`<?php echo $donut_data; ?>`);

      data = {
      datasets: [{
          data: data,
          backgroundColor : ['#808080', '#6eeb34', '#f7df05', '#eb4f34'],
          hoverBackgroundColor : ['#838383', '#00ff00', '#f3f705', '#ff0000']
      }],

      // These labels appear in the legend and in the tooltips when hovering different arcs
      labels: [
          'Not yet started',
          'Done',
          'Proses Perpanjangan',
          'Expired'
      ]
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
        type: "doughnut",
        data: data,
        options: options
      });
 
  });
</script>