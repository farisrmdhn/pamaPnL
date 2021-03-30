
<br>
<h3><?=$title?></h3>
<br>
<div style="color: red;"><?php echo validation_errors(); ?></div>
<form method="POST" action="<?php echo base_url();?>permitsAndLicenses/perpanjangan">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group" id="due_date">
				<label>Site Name : </label>
				<input class="form-control" type="text" name="name" value="<?php echo $detail['name'];?>" disabled>
			</div>
			<div class="form-group" id="due_date">
				<label>Nama izin / lisensi : </label>
				<input class="form-control" type="text" name="name" value="<?php echo $detail['nama'];?>" disabled>
			</div>
			<div class="form-group">
				<label>Due date : </label>
				<input class="form-control" type="date" name="due_date" required="">
			</div>
			<div class="form-group">
				<label>Keterangan : </label>
				<textarea class="form-control" name="keterangan" required=""></textarea>
			</div>
			<input type="hidden" name="id" value="<?php echo $detail['id_pl'] ?>">
			<input type="hidden" name="id_site" value="<?php echo $detail['id_site'];?>">
			<input type="hidden" name="id_detail" value="<?php echo $detail['id'];?>">
			<input class="btn btn-success float-right" type="submit" name="submit" value="Continue">
		</div>
	</div>
</form>