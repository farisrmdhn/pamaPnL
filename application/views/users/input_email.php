<?php if($this->session->flashdata('login_success')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('login_success').'</p>'; ?>
<?php endif; ?>
<br>
<h3><?=$title?></h3>
<br>
<div style="color: red;">This account doesn't have a registered email, please input email to continue</div>
<div style="color: red;"><?php echo validation_errors(); ?></div>
<form method="POST" action="<?php echo base_url();?>users/input_email">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group" id="due_date">
				<label>Site Name : </label>
				<input class="form-control" type="text" name="name" value="<?php echo$this->session->userdata('name');?>" disabled>
			</div>
			<div class="form-group">
				<label>Email : </label>
				<input class="form-control" type="email" name="email" required="">
			</div>
			<div class="form-group">
				<label>Confirm Email : </label>
				<input class="form-control" type="email" name="email2" required="">
			</div>
			<input type="hidden" name="id" value="<?php echo $this->session->userdata('id');?>">
			<input class="btn btn-success float-right" type="submit" name="submit" value="Continue">
		</div>
	</div>
</form>