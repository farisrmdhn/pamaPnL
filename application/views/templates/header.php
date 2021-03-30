<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Permit and License</title>

	<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
    <a class="navbar-brand" href="#">Permit and License</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <?php if($this->session->userdata('user_type') == 2):?>
            <a class="nav-link" href="<?php echo base_url();?>admin_dashboard">My Dashboard</a>
          <?php else:?>
            <a class="nav-link" href="<?php echo base_url();?>dashboard/<?php echo $this->session->userdata('id');?>">My Dashboard</a>
          <?php endif;?>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url();?>permitsAndLicenses">P&L Identification Matrix</a>
        </li>
        <?php if(($this->session->userdata('user_type') == 2) ||($this->session->userdata('user_type') == 1)):?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>sitelist">Site List</a>
          </li>
        <?php endif;?>
        <!--li class="nav-item">
          <a class="nav-link" href="<?php echo base_url();?>help">Help</a>
        </li-->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if($this->session->userdata('logged_in')) : ?>
            <li class="nav-item">
             <a class="nav-link" href="<?php echo base_url(); ?>users/logout">Log out<span class="sr-only">(current)</span></a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container">