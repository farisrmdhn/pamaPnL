<?php if($this->session->flashdata('login_success')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('login_success').'</p>'; ?>
<?php endif; ?>
<?php if($this->session->flashdata('change_password')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('change_password').'</p>'; ?>
<?php endif; ?>

<h1><?= $title ?></h1>
<p><span class="badge badge-dark">last login : <?php echo $info['last_login'];?></span></p>
<p>id : <?php echo $info['id'];?> | my username : <?php echo $info['username'];?></p>

<?php if($this->session->userdata('user_type') == 0):?>
  <a class="btn btn-primary" href="<?php echo base_url();?>permitsAndLicenses/pl_site_detail/<?php echo $info['id'];?>"><?php echo $info['name'];?> Permit/License Detail</a>
  <a class="btn btn-dark" href="<?php echo base_url();?>permitsAndLicenses/select_pl">Input Permit/License Detail</a>
<?php endif;?>

<a class="btn btn-danger" href="<?php echo base_url();?>users/change_password">Change Password</a>

<br>
<br>
<?php if($this->session->userdata('user_type') == 0):?>
  <div style="margin-top: 20px; border: 3px solid black; padding: 15px;">
  	<div class="row">
  		<div class="col-md-12">
  			<h3>Fulfillment : <span style="color: <?php echo $fulfillment_bar[2]?>;"><?php echo $fulfillment_bar[0]; ?> %</span></h3>
  			<div class="progress">
  			  <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $fulfillment_bar[1]?>" role="progressbar" aria-valuenow="<?php echo $fulfillment_bar[0]; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $fulfillment_bar[0]; ?>%"></div>
  			</div>
  		</div>
  		<div class="col-md-12">
  			<h3>Expiration Due : <span style="color: blue;"><?php echo $exp_bar; ?> %</span></h3>
  			<div class="progress">
  			  <div class="progress-bar progress-bar-striped progress-bar-animated ?>" role="progressbar" aria-valuenow="<?php echo $exp_bar; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_bar; ?>%; background-color: blue;"></div>
  			</div>
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-md-8" style="margin-top: 25px;">
  			<h3>Progress</h3>
  			<hr>
  			<canvas id="donut-chart2"></canvas>
        <div class="text-center">
          <div class="col-md-3" style="display: inline-block;">
            <div style="border: 0.1 solid black; border-radius: 50%; height: 15px; width: 15px; display: inline-block; background-color: #808080;"></div>
            <a href="<?php echo base_url(); ?>permitsAndLicenses/pl_site_details_by_status/<?php echo $info['id'];?>/0" style="color: black;"> Not Yet Started </a>
          </div>
          <div class="col-md-2" style="display: inline-block;">
            <div style="border: 0.1 solid black; border-radius: 50%; height: 15px; width: 15px; display: inline-block; background-color: #6eeb34;"></div>
            <a href="<?php echo base_url(); ?>permitsAndLicenses/pl_site_details_by_status/<?php echo $info['id'];?>/1" style="color: black;"> Done </a>
          </div>
          <div class="col-md-2" style="display: inline-block;">
            <div style="border: 0.1 solid black; border-radius: 50%; height: 15px; width: 15px; display: inline-block; background-color: #f7df05;"></div>
            <a href="<?php echo base_url(); ?>permitsAndLicenses/pl_site_details_by_status/<?php echo $info['id'];?>/4" style="color: black;"> Proses Perpanjangan </a>
          </div>
          <div class="col-md-2" style="display: inline-block;">
            <div style="border: 0.1 solid black; border-radius: 50%; height: 15px; width: 15px; display: inline-block; background-color: #eb4f34;"></div>
            <a href="<?php echo base_url(); ?>permitsAndLicenses/pl_site_details_by_status/<?php echo $info['id'];?>/3" style="color: black;"> Expired </a>
          </div>
        </div>
  		</div>
  	</div>
  </div>
<?php endif;?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script  type="text/javascript">
  $(function(){
      //get the bar chart canvas
      var ctx = $("#donut-chart2");
      var data = JSON.parse(`<?php echo $donut2_data; ?>`);

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
