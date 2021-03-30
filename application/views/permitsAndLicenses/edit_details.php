<h1><?= $title ?></h1>
<?php if($this->session->userdata('user_type') == 0):?>
<a class="btn btn-danger" href="<?php echo base_url();?>permitsAndLicenses/select_pl"><< Go Back</a>
<?php else:?>
<?php endif;?>
<br>
<br>
<?php echo form_open_multipart('permitsAndLicenses/update_details') ?>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<fieldset disabled="">
					<label><strong>Step 1 :</strong> Select Permit / License</label>
				    <select class="custom-select">
				    	<option selected=""><?php echo $detail['nama']?></option>
					</select>
				</fieldset>
			</div>
			<input type="hidden" name="status" value="1">
			<!-- Selektor model lama 
			<div class="form-group">
				<label><strong>Step 2 :</strong> Input Status</label>
				<select class="custom-select" id="status_selector" name="status">
			    	<option selected="" value="">--Choose Status--</option>
			    	<option value="0">Not yet started</option>
			    	<option value="1">In Progress</option>
			    	<option value="2">Done</option>
				</select>
			</div>
			<div class="form-group" id="due_date" style="display: none;">
				<label>Due date : </label>
				<input class="form-control" type="date" name="due_date">
			</div> -->
			<div class="form-group">
				<label><strong>Step 2 :</strong> Input Details</label>
			</div>
			<div class="form-group">
				<label>Tanggal Terbit : </label>
				<input class="form-control" type="date" name="tgl_terbit" required="" value="<?php echo $detail['tgl_terbit'];?>">
			</div>
			<div class="form-group">
				<label>Tanggal Expired : </label>
				<input class="form-control" type="date" name="tgl_expired" required="" value="<?php echo $detail['tgl_expired'];?>">
			</div>

			<?php if((4 <= $detail['id_pl']) && ($detail['id_pl'] <= 20) || (($detail['id_pl'] == 24) || ($detail['id_pl'] == 25))):?>
				<div class="form-group">
					<label>Atas Nama 1 :</label>
					<input class="form-control" type="text" name="atas_nama" required="">
				</div>
				<div class="form-group">
					<label>Atas Nama 2 :
					<small style="color: red;">Leave empty if not needed</small></label>
					<input class="form-control" type="text" name="atas_nama_2">
				</div>
				<div class="form-group">
					<label>Atas Nama 3 :</label>
					<small style="color: red;">Leave empty if not needed</small>
					<input class="form-control" type="text" name="atas_nama_3">
				</div>

				<div class="form-group">
					<label>Atas Nama 4 :
					<small style="color: red;">Leave empty if not needed</small></label>
					<input class="form-control" type="text" name="atas_nama_4">
				</div>

				<div class="form-group">
					<label>Atas Nama 5 :
					<small style="color: red;">Leave empty if not needed</small></label>
					<input class="form-control" type="text" name="atas_nama_5">
				</div>
				<input type="hidden" name="no_izin" value="">
			<?php else:?>
				<div class="form-group">
					<label>Nomor Izin :</label>
					<input class="form-control" type="text" name="no_izin" required="" value="<?php echo $detail['no_izin'];?>">
				</div>
				<input type="hidden" name="atas_nama" value="">
				<input type="hidden" name="atas_nama_2" value="">
				<input type="hidden" name="atas_nama_3" value="">
				<input type="hidden" name="atas_nama_4" value="">
				<input type="hidden" name="atas_nama_5" value="">
			<?php endif;?>
		</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Keterangan</label>
					<textarea class="form-control" name="keterangan"><?php echo $detail['tgl_terbit'];?></textarea>
				</div>	
				<div class="form-group">
					<label>Masa Berlaku</label>
					<input class="step_3_4 required form-control" type="number" name="masa_berlaku" placeholder="Dalam Tahun" required="" value="<?php echo $detail['masa_berlaku'];?>">
				</div>	
			    <div class="form-group">
			      <label><strong>Step 3 :</strong> Upload Dokumen</label>
			      <input type="file" class="form-control-file" name="image" aria-describedby="fileHelp" required="">
			      <small id="fileHelp" class="form-text text-muted">Format file : PNG, JPG, JPEG.</small>
			    </div>
			</div>
	</div>
	<br>
	<div class="form-group col-md-3 offset-md-9">
		<input type="hidden" name="default_image" value="<?php echo $detail['image']; ?>">
		<input type="hidden" name="id" value="<?php echo $detail['id']; ?>">
		<input type="hidden" name="id_pl" value="<?php echo $detail['id_pl']; ?>">
		<input type="hidden" name="id_site" value="<?php echo $detail['id_site']; ?>">
		<input type="submit" class="btn btn-success form-control" name="submit" value="Input">
	</div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	