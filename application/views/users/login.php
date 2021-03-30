<!DOCTYPE html>
<html>
<head>
	<title>Login|Permit and License</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="container">
	  <a class="navbar-brand" href="<?php echo base_url();?>">Permit and License</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarColor01">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="<?php echo base_url();?>help">Help</a>
	      </li>
	    </ul>
	  </div>
	</div>
	</nav>

	<div class="container">
		<?php if($this->session->flashdata('login_failed')): ?>
			<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
		<?php endif; ?>
		<?php if($this->session->flashdata('logout')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('logout').'</p>'; ?>
		<?php endif; ?>
		<div class="row" style="margin-top: 50px;" >
			<div class="col-md-6 offset-md-3  text-center">
				<h3><?= $title ?></h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<form method="post" action="<?php echo base_url();?>login">
					<div class="form-group">
				      <label>Username</label>
				      <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
				    </div>

				    <div class="form-group">
				      <label>Password</label>
				      <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
				    </div>
				    <div class="text-right">
						<input type="submit" class="btn btn-primary" value="Sign In">
					</div>
				</form>
			</div>
		</div>
    </div>
</body>
</html>