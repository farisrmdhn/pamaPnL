<h1>Edit User : <?php echo $info['username'];?></h1>
<div style="color: red;"><?php echo validation_errors(); ?></div>
<form method="post" action="<?php echo base_url();?>users/edit_user/<?php echo $info['id'];?>">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Name</label>
				<input class="form-control" type="text" name="name" value="<?php echo $info['name'];?>">
			</div>
			<div class="form-group">
				<label>Username</label>
				<input class="form-control" type="text" name="username" value="<?php echo $info['username'];?>">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input class="form-control" type="email" name="email" value="<?php echo $info['email'];?>">
			</div>
			<div class="form-group">
				<label class="text-danger"> *Only input password if want to reset</label>
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
				<select class="custom-select" name="user_type" disabled="">
					<?php if($info['user_type'] == 0):?>
						<option value="0" selected="">Site</option>
					<?php elseif($info['user_type'] == 1):?>
						<option value="1" selected="">Viewer</option>
					<?php else:?>
						<option value="2" selected="">Admin</option>
					<?php endif;?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<input type="hidden" name="id" value="<?php echo $info['id']?>">
			<input type="hidden" name="default_password" value="<?php echo $info['password']?>">
			<input type="submit" class="btn btn-primary float-right" name="submit" value="Update">
		</div>
	</div>
</form>