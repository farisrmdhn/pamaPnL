 <h1><?= $title?> : <?php echo $details[0]['name']; ?></h1>
 <br>
 <table class="table table-hover">
  <tr class="table-primary">
    <th>No</th>
    <th>Nama Perijinan / Sertifikasi</th>
    <th>Kategori Perijinan</th>
    <th>Status</th>
    <th>Avaibility</th>
  </tr>
  <form action="<?php echo base_url(); ?>permitsAndLicenses/update_na" method="POST">
    <?php foreach($details as $detail):?>
      <tr>
        <td><?php echo $detail['pl_no']?></td>
        <td><?php echo $detail['nama']?></td>
        <td><?php echo $detail['kategori']?></td>
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
          <select name="isna_<?php echo $detail['pl_no']?>" class="form-control">
            <?php if($detail['isna'] == "0"):?>
              <option selected value="0">Available</option>
              <option value="1">N/A </option>
            <?php else:?>
              <option selected value="1">N/A</option>
              <option value="0">Available</option>
            <?php endif;?>
          </select>
        </td>
      </tr>
    <?php endforeach;?>
</table> 
<div class="row">
    <div class="col-md-12">
      <?php if($this->session->userdata('user_type') == 2):?>
        <input type="hidden" name="id_site" value="<?php echo $id_site;?>">
      <?php endif;?>
      <input type="submit" class="btn btn-success float-right" name="submit" value="Apply">
    </div>
  </div>
</form>