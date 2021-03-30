 <h1><?= $title?></h1>
 <?php if($this->session->userdata('user_type') == 0):?>
<div class="row">
    <div class="col-md-12">
      <h3>Fulfillment : <span style="color: <?php echo $fulfillment_bar[2]?>;"><?php echo $fulfillment_bar[0]; ?> %</span></h3>
      <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $fulfillment_bar[1]?>" role="progressbar" aria-valuenow="<?php echo $fulfillment_bar[0]; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $fulfillment_bar[0]; ?>%"></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <h3>Expiration due : <span style="color: blue;"> <?php echo $exp_bar; ?> %</span></h3>
      <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $exp_bar; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $exp_bar; ?>%; background-color: blue;"></div>
      </div>
    </div>
  </div>

<?php endif;?>
 <br>
 <table class="table table-hover">
  <tr class="table-primary">
    <th>No</th>
    <th>Nama Perijinan / Sertifikasi</th>
    <th>Kategori Perijinan</th>
    <th>Site</th>
    <th>PLC</th>
    <th colspan="2">Divisi/Dept. Terkait</th>
    <th>Keterangan</th>
    <th ></th>
  </tr>
  <?php foreach($pl_matrixes as $pl_matrix):?>
    <tr>
      <td><?php echo $pl_matrix['id']?></td>
      <td><?php echo $pl_matrix['nama']?></td>
      <td><?php echo $pl_matrix['kategori']?></td>
      <td><?php echo $pl_matrix['site']?></td>
      <td><?php echo $pl_matrix['plc']?></td>
      <td><?php echo $pl_matrix['divisi_1']?></td>
      <td><?php echo $pl_matrix['divisi_2']?></td>
      <td><?php echo $pl_matrix['keterangan']?></td>
      <td>
        <?php if($this->session->userdata('user_type') == 0):?>
          <a class="btn btn-success" href="permitsAndLicenses/detail/<?php echo $pl_matrix['id']?>">Detail</a>
        <?php else:?>
          <a class="btn btn-success" href="permitsAndLicenses/all_pl_details/<?php echo $pl_matrix['id']?>">Details</a>
        <?php endif;?>
      </td>
    </tr>
  <?php endforeach;?>
</table> 