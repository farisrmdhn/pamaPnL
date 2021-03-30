<h1>Create new user</h1>
<div style="color: red;"><?php echo validation_errors(); ?></div>
<form method="post" action="<?php echo base_url();?>users/add_user">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Name</label>
				<input class="form-control" type="text" name="name">
			</div>
			<div class="form-group">
				<label>Username</label>
				<input class="form-control" type="text" name="username">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input class="form-control" type="password" name="password">
			</div>
			<div class="form-group">
				<label>Confirm Password</label>
				<input class="form-control" type="password" name="password2">
			</div>
			<div class="form-group">
				<label>User Type</label>
				<select class="custom-select" name="user_type">
					<option value="0">Site</option>
					<option value="1">Viewer</option>
					<option value="2">Admin</option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<input type="submit" class="btn btn-primary float-right" name="submit" value="Create">
		</div>
	</div>
</form>