<?php if($this->session->flashdata('input_success')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('input_success').'</p>'; ?>
<?php endif; ?>
<h1>Details</h1>
<br>
<?php if($this->session->userdata('user_type') != 1):?>
  <div class="row">
    <div class="col-md-1">
      <form method="post" action="<?php echo base_url();?>permitsAndLicenses/edit_details">
        <input type="hidden" name="id" value="<?php echo $pl_matrixes['id']; ?>">
        <input type="hidden" name="id_site" value="<?php echo $id_site; ?>">
        <input type="submit" class="btn btn-success" name="submit" value="Edit">
      </form>
    </div>
    <?php if($detail['status'] == 2 || $detail['status'] == 3):?>
    <div class="col-md-2">
      <form method="post" action="<?php echo base_url();?>permitsAndLicenses/perpanjangan">
        <input type="hidden" name="id" value="<?php echo $pl_matrixes['id']; ?>">
        <input type="hidden" name="id_site" value="<?php echo $id_site; ?>">
        <input type="submit" class="btn btn-dark" name="submit" value="Perpanjang Izin / Lisensi">
      </form>
    </div>
    <?php endif;?>
  </div>
  
<?php endif;?>
<br>
<div class="row">
  <div class="col-md-12">
   <?php 
      if($detail['status'] == '0'){
        echo '<h3> Status : <span class="text-secondary">Not yet started</span></h3>';
      }elseif ($detail['status'] == '1' || $detail['status'] == 2) {
        echo '<h3> Status : <span class="text-success">Done</span></h3>';
      }elseif ($detail['status'] == 4){
        echo '<h3> Status : <span class="text-warning">Proses Perpanjangan</span> </h3><h3>Due Date :<span class="text-danger"> '.$detail['due_date'].'</span></h3>';
      }else{
        echo '<h3> Status : <span class="text-danger">Expired</span></h3>';
      }
    ?>
  </div>
</div>
<br>
<?php if($detail['status'] == '0'):?>
<?php elseif($detail['status'] == '1' || $detail['status'] == 2):?>
   <div class="row">
    <div class="col-md-12">
      <h3>Expiration due : <span style="color: blue;"> <?php echo $exp_bar; ?> %</span></h3>
      <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $exp_bar; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_bar; ?>%; background-color: blue;"></div>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
  <div class="col-md-5">
    <table class="table table-hover">
      <tr>
        <th class="table-primary">Nama</th>
        <td><?php echo $pl_matrixes['nama'];?></td>
      </tr>
      <tr>
        <th class="table-primary">Kategori</th>
        <td><?php echo $pl_matrixes['kategori'];?></td>
      </tr>
      <tr>
        <th class="table-primary">Divisi 1</th>
        <td><?php echo $pl_matrixes['divisi_1'];?></td>
      </tr>
      <tr>
        <th class="table-primary">Divisi 2</th>
        <td><?php echo $pl_matrixes['divisi_2'];?></td>
      </tr>
    </table>
  </div>
  <div class="col-md-7">
    <table class="table table-hover">
      <tr>
        <th class="table-primary">Masa Berlaku</th>
        <td><?php echo $detail['masa_berlaku']?> tahun</td>
      </tr>
      <tr>
        <th class="table-primary">Tanggal Terbit</th>
        <td><?php echo $detail['tgl_terbit']?></td>
      </tr>
      <tr>
        <th class="table-primary">Tanggal Expired</th>
        <td><?php echo $detail['tgl_expired']?></td>
      </tr>
      <?php if($detail['atas_nama'] == NULL):?>
        <tr>
          <th class="table-primary">No. Izin</th>
          <td><?php echo $detail['no_izin']?></td>
        </tr>
      <?php else:?>
        <tr>
          <th class="table-primary" rowspan="5">Atas Nama</th>
          <td><?php echo $detail['atas_nama']?></td>
        </tr>
        <?php if($detail['atas_nama_2'] != NULL):?>
          <tr>
            <td><?php echo $detail['atas_nama_2']?></td>
          </tr>
        <?php endif;?>
        <?php if($detail['atas_nama_3'] != NULL):?>
          <tr>
            <td><?php echo $detail['atas_nama_3']?></td>
          </tr>
        <?php endif;?>
        <?php if($detail['atas_nama_4'] != NULL):?>
          <tr>
            <td><?php echo $detail['atas_nama_4']?></td>
          </tr>
        <?php endif;?>
        <?php if($detail['atas_nama_5'] != NULL):?>
          <tr>
            <td><?php echo $detail['atas_nama_5']?></td>
          </tr>
        <?php endif;?>
      <?php endif;?>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <table class="table table-hover">
      <tr>
        <th class="table-primary col-md-2">Keterangan</th>
        <td><?php echo $detail['keterangan']?></td>
      </tr>
    </table>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12 text-center">
    <h3>Dokumen</h3>
    <img width="800" height="1000" src="<?php echo base_url();?>assets/dokumen/<?php echo $detail['image'];?>">
  </div>
</div>
  <!-- Bekas In progress 
  <div class="row">
    <div class="col-md-12">
      <h3>Due date : <span class="text-warning"><?php echo $exp_bar; ?> Days Remaining</span></h3>
      <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $exp_bar; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_bar; ?>%; background-color: blue;"></div>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-hover">
        <tr>
          <th class="table-primary col-md-2">Due date : </th>
          <td><?php echo $detail['due_date'];?></td>
        </tr>
        <tr>
          <th class="table-primary col-md-2">Keterangan : </th>
          <td><?php echo $detail['keterangan'];?></td>
        </tr>
      </table>
    </div>
  </div> -->
<?php elseif($detail['status'] == '4'):?>
  <div class="row">
    <div class="col-md-12">
      <h3>Expiration due : <span class="text-warning"> <?php echo $exp_bar; ?> %</span></h3>
      <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="<?php echo $exp_bar; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_bar; ?>%;"></div>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
  <div class="col-md-5">
    <table class="table table-hover">
      <tr>
        <th class="table-primary">Nama</th>
        <td><?php echo $pl_matrixes['nama'];?></td>
      </tr>
      <tr>
        <th class="table-primary">Kategori</th>
        <td><?php echo $pl_matrixes['kategori'];?></td>
      </tr>
      <tr>
        <th class="table-primary">Divisi 1</th>
        <td><?php echo $pl_matrixes['divisi_1'];?></td>
      </tr>
      <tr>
        <th class="table-primary">Divisi 2</th>
        <td><?php echo $pl_matrixes['divisi_2'];?></td>
      </tr>
    </table>
  </div>
  <div class="col-md-7">
    <table class="table table-hover">
      <tr>
        <th class="table-primary">Masa Berlaku</th>
        <td><?php echo $detail['masa_berlaku']?> tahun</td>
      </tr>
      <tr>
        <th class="table-primary">Tanggal Terbit</th>
        <td><?php echo $detail['tgl_terbit']?></td>
      </tr>
      <tr>
        <th class="table-primary">Tanggal Expired</th>
        <td><?php echo $detail['tgl_expired']?></td>
      </tr>
      <?php if($detail['atas_nama'] == NULL):?>
        <tr>
          <th class="table-primary">No. Izin</th>
          <td><?php echo $detail['no_izin']?></td>
        </tr>
      <?php else:?>
        <tr>
          <th class="table-primary" rowspan="5">Atas Nama</th>
          <td><?php echo $detail['atas_nama']?></td>
        </tr>
        <?php if($detail['atas_nama_2'] != NULL):?>
          <tr>
            <td><?php echo $detail['atas_nama_2']?></td>
          </tr>
        <?php endif;?>
        <?php if($detail['atas_nama_3'] != NULL):?>
          <tr>
            <td><?php echo $detail['atas_nama_3']?></td>
          </tr>
        <?php endif;?>
        <?php if($detail['atas_nama_4'] != NULL):?>
          <tr>
            <td><?php echo $detail['atas_nama_4']?></td>
          </tr>
        <?php endif;?>
        <?php if($detail['atas_nama_5'] != NULL):?>
          <tr>
            <td><?php echo $detail['atas_nama_5']?></td>
          </tr>
        <?php endif;?>
      <?php endif;?>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <table class="table table-hover">
      <tr>
        <th class="table-primary col-md-2">Keterangan</th>
        <td><?php echo $detail['keterangan']?></td>
      </tr>
    </table>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12 text-center">
    <h3>Dokumen</h3>
    <img width="800" height="1000" src="<?php echo base_url();?>assets/dokumen/<?php echo $detail['image'];?>">
  </div>
</div>
<?php else:?>
  <div class="row">
  <div class="col-md-5">
    <table class="table table-hover">
      <tr>
        <th class="table-primary">Nama</th>
        <td><?php echo $pl_matrixes['nama'];?></td>
      </tr>
      <tr>
        <th class="table-primary">Kategori</th>
        <td><?php echo $pl_matrixes['kategori'];?></td>
      </tr>
      <tr>
        <th class="table-primary">Divisi 1</th>
        <td><?php echo $pl_matrixes['divisi_1'];?></td>
      </tr>
      <tr>
        <th class="table-primary">Divisi 2</th>
        <td><?php echo $pl_matrixes['divisi_2'];?></td>
      </tr>
    </table>
  </div>
  <div class="col-md-7">
    <table class="table table-hover">
      <tr>
        <th class="table-primary">Masa Berlaku</th>
        <td><?php echo $detail['masa_berlaku']?> tahun</td>
      </tr>
      <tr>
        <th class="table-primary">Tanggal Terbit</th>
        <td><?php echo $detail['tgl_terbit']?></td>
      </tr>
      <tr>
        <th class="table-primary">Tanggal Expired</th>
        <td><?php echo $detail['tgl_expired']?></td>
      </tr>
      <?php if($detail['atas_nama'] == NULL):?>
        <tr>
          <th class="table-primary">No. Izin</th>
          <td><?php echo $detail['no_izin']?></td>
        </tr>
      <?php else:?>
        <tr>
          <th class="table-primary" rowspan="5">Atas Nama</th>
          <td><?php echo $detail['atas_nama']?></td>
        </tr>
        <?php if($detail['atas_nama_2'] != NULL):?>
          <tr>
            <td><?php echo $detail['atas_nama_2']?></td>
          </tr>
        <?php endif;?>
        <?php if($detail['atas_nama_3'] != NULL):?>
          <tr>
            <td><?php echo $detail['atas_nama_3']?></td>
          </tr>
        <?php endif;?>
        <?php if($detail['atas_nama_4'] != NULL):?>
          <tr>
            <td><?php echo $detail['atas_nama_4']?></td>
          </tr>
        <?php endif;?>
        <?php if($detail['atas_nama_5'] != NULL):?>
          <tr>
            <td><?php echo $detail['atas_nama_5']?></td>
          </tr>
        <?php endif;?>
      <?php endif;?>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <table class="table table-hover">
      <tr>
        <th class="table-primary col-md-2">Keterangan</th>
        <td><?php echo $detail['keterangan']?></td>
      </tr>
    </table>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12 text-center">
    <h3>Dokumen</h3>
    <img width="800" height="1000" src="<?php echo base_url();?>assets/dokumen/<?php echo $detail['image'];?>">
  </div>
</div>
<?php endif;?>