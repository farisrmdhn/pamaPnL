 <h1><?= $title?></h1>
 <br>
 <table class="table table-hover">
  <tr class="table-primary">
    <th class="col-md-1">No</th>
    <th class="col-md-1">Nama</th>
    <th>Fulfillment</th>
    <th class="col-md-1"></th>
    <th class="col-md-1"></th>
  </tr>
  <?php // Karena nomor 8 gaada?>
  <?php for($i = 0; $i < 7;$i++):?>
    <tr>
      <td>
          <?php echo $users[0][$i]['id']?>
      <td>
          <?php echo $users[0][$i]['name'];?>
      </td>
      <td>
        <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $users[1][$i][1]?>" role="progressbar" aria-valuenow="<?php echo $users[1][$i][0]; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $users[1][$i][0]; ?>%"></div>
        </div>
      </td>
      <td>
        <span style="color: <?php echo $users[1][$i][2]?>;"><?php echo $users[1][$i][0]; ?> %</span>
      </td>
      <td>
          <a class="btn btn-success" href="users/site_detail/<?php echo $users[0][$i]['id']?>">Detail</a>
      </td>
    </tr>
  <?php endfor;?>
  <?php for($i = 7; $i < 20;$i++):?>
    <tr>
      <td>
          <?php echo $users[0][$i]['id']?>
      <td>
          <?php echo $users[0][$i]['name'];?>
      </td>
      <td>
        <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $users[1][$i + 1][1]?>" role="progressbar" aria-valuenow="<?php echo $users[1][$i + 1][0]; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $users[1][$i + 1][0]; ?>%"></div>
        </div>
      </td>
      <td>
        <span style="color: <?php echo $users[1][$i + 1][2]?>;"><?php echo $users[1][$i + 1][0]; ?> %</span>
      </td>
      <td>
          <a class="btn btn-success" href="users/site_detail/<?php echo $users[0][$i]['id']?>">Detail</a>
      </td>
    </tr>
  <?php endfor;?>
</table> 