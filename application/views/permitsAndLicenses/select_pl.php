<h1><?= $title ?></h1>
<?php if($this->session->userdata('user_type') == 0):?>
	<a class="btn btn-danger" href="<?php echo base_url();?>dashboard/<?php echo $this->session->userdata('id'); ?>"><< Go Back</a>
<?php else:?>
	<a class="btn btn-danger" href="<?php echo base_url();?>admin_dashboard"><< Go Back</a>
<?php endif;?>
<br>
<br>
<form method="post" action="<?php echo base_url();?>permitsAndLicenses/edit_details">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label><strong>Step 1 :</strong> Select Permit / License</label>
			    <select class="custom-select" name="id">
			    	<?php foreach($details as $detail):?>
			    		<option value="<?php echo $detail['id']; ?>"><?php echo $detail['nama']?></option>
			    	<?php endforeach;?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<?php if($this->session->userdata('user_type') == 2):?>
				<input type="hidden" name="id_site" value="<?php echo $user['id'];?>">
			<?php endif;?>
			<input type="submit" class="btn btn-success float-right" name="submit" value="Go">
		</div>
	</div>
</form>
	