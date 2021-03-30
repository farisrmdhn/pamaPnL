 <h1><?= $title?></h1>
  <br>
 <table class="table table-hover">
  <tr class="table-primary">
    <th>Nama Site</th>
    <th>Nama Perijinan / Sertifikasi</th>
    <th>Kategori Perijinan</th>
    <th colspan="2">Divisi/Dept. Terkait</th>
    <th colspan="2">Tanggal Terbit / Expired</th>
    <th>Nomor Izin</th>
    <th>Atas Nama</th>
    <th>Status</th>
    <th></th>
  </tr>
  <?php
  $num = 1; 
  foreach($details as $detail):?>
    <tr>
      <td><?php echo $detail['name']?></td>
      <td><?php echo $detail['nama']?></td>
      <td><?php echo $detail['kategori']?></td>
      <td><?php echo $detail['divisi_1']?></td>
      <td><?php echo $detail['divisi_2']?></td>
      <td><?php if($detail['tgl_terbit'] != '0000-00-00'){echo $detail['tgl_terbit'];}?></td>
      <td><?php if($detail['tgl_expired'] != '0000-00-00'){echo $detail['tgl_expired'];}?></td>
      <td><?php echo $detail['no_izin']?></td>
      <td><?php echo $detail['atas_nama']?></td>
      <td class="text-center">
        <?php if($detail['status'] == '0'):?>
          <div class="bg-secondary" style="border: 0.1 solid black; border-radius: 50%; height: 10px; width: 10px; display: inline-block;"></div>
        <?php elseif($detail['status'] == '1' || $detail['status'] == 2):?>
          <div class="bg-success" style="border: 0.1 solid black; border-radius: 50%; height: 10px; width: 10px; display: inline-block;"></div>
          <?php
            $date_now = new DateTime(date('Y-m-d'));
            $tgl_terbit = new DateTime($detail['tgl_terbit']);
            $tgl_expired = new DateTime($detail['tgl_expired']);

            //now - exp
            $diff1 =$date_now->diff($tgl_expired);
            //days differnece
            $diff1 = $diff1->days;
            //exp - terbit
            $diff2 = $tgl_terbit->diff($tgl_expired);
            $diff2 = $diff2->days;

            if($diff2 == 0){
              $diff2 = 1;
            }

            // return $diff1;
            $per =  (round((($diff1/$diff2) * 100), 2));
          ?>
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $per; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $per;?>% ; background-color: blue;"></div>
          </div>
          <!-- BEkas In Progress 
          <p><strong class="text-warning"><?php
            $due_date = new DateTime($detail['due_date']);
            $date_now = new DateTime(date('Y-m-d'));
            $diff = $due_date->diff($date_now);
            $diff = $diff->days;
            echo $diff;
          ?> d</strong></p> -->
        <?php elseif($detail['status'] == '4'):?>
          <div class="bg-warning" style="border: 0.1 solid black; border-radius: 50%; height: 10px; width: 10px; display: inline-block;"></div>
          <?php
            $date_now = new DateTime(date('Y-m-d'));
            $tgl_terbit = new DateTime($detail['tgl_terbit']);
            $tgl_expired = new DateTime($detail['tgl_expired']);

            //now - exp
            $diff1 =$date_now->diff($tgl_expired);
            //days differnece
            $diff1 = $diff1->days;
            //exp - terbit
            $diff2 = $tgl_terbit->diff($tgl_expired);
            $diff2 = $diff2->days;

            if($diff2 == 0){
              $diff2 = 1;
            }

            // return $diff1;
            $per =  (round((($diff1/$diff2) * 100), 2));
          ?>
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="<?php echo $per; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $per;?>% ;"></div>
          </div>
        <?php else:?>
          <div class="bg-danger" style="border: 0.1 solid black; border-radius: 50%; height: 10px; width: 10px; display: inline-block;"></div>
        <?php endif;?>
      </td>
      <td>
        <a class="btn btn-success" href="<?php echo base_url();?>permitsAndLicenses/detail/<?php echo $detail['id'];?>/<?php echo $detail['id_site']?>">Details</a>
      </td>
  <?php endforeach;?>
</table> 