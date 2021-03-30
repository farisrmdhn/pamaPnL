<br>
<h3><?=$title?></h3>
<br>
<div style="color: red;"><?php echo validation_errors(); ?></div>
<form method="POST" action="<?php echo base_url();?>users/change_password">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group" id="due_date">
				<label>Site Name : </label>
				<input class="form-control" type="text" name="name" value="<?php echo$this->session->userdata('name');?>" disabled>
			</div>
			<div class="form-group">
				<label>Password : </label>
				<input class="form-control" type="password" name="old_password" placeholder="Your current password">
			</div>
			<div class="form-group">
				<label>New Password : </label>
				<input class="form-control" type="password" name="new_password" placeholder="Your new password ">
			</div>
			<div class="form-group">
				<label>Confirm New Password : </label>
				<input class="form-control" type="password" name="new_password2" placeholder="Re-type new password">
			</div>
			<input type="hidden" name="id" value="<?php echo $this->session->userdata('id');?>">
			<input class="btn btn-danger float-right" type="submit" name="submit" value="Change">
		</div>
	</div>
</form>