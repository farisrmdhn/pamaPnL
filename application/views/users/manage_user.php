<h1><?= $title?></h1>

<a class="btn btn-success" href="<?php echo base_url();?>users/add_user">Add New User</a>
 <br>
 <br>
 <table class="table table-hover">
  <tr class="table-primary">
    <th>No</th>
    <th>Nama</th>
    <th>Username</th>
    <th>Type</th>
    <th>Last Login</th>
    <th></th>
  </tr>
  <?php foreach($users as $user):?>
    <tr>
      <td>
          <?php echo $user['id']?>
      </td>
      <td>
          <?php echo $user['name']?>
      </td>
      <td>
          <?php echo $user['username']?>
      </td>
      <td>
          <?php echo $user['user_type']?>
      </td>
      <td>
          <?php echo $user['last_login']?>
      </td>
      <td>
          <a class="btn btn-dark" href="<?php echo base_url();?>users/edit_user/<?php echo $user['id']?>">Edit</a>
      </td>
    </tr>
  <?php endforeach;?>
</table> 