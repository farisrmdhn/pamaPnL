<h1>All Site Details : <?php echo $pl_matrixes['nama'];?></h1>
<table class="table table-hover">
  <tr class="table-primary">
    <th>Kategori</th>
    <th>PLC</th>
    <th colspan="2">Divisi</th>
    <th>Keterangan</th>
  </tr>
    <tr>
      <td><?php echo $pl_matrixes['kategori'];?></td>
      <td><?php echo $pl_matrixes['plc'];?></td>
      <td><?php echo $pl_matrixes['divisi_1'];?></td>
      <td><?php echo $pl_matrixes['divisi_2'];?></td>
      <td><?php echo $pl_matrixes['keterangan'];?></td>
    </tr>
</table>

 <table class="table table-hover">
  <tr class="table-primary">
    <th>No</th>
    <th>Nama Site</th>
    <th colspan="2">Tanggal Terbit / Expired</th>
    <th>Nomor Izin</th>
    <th>Atas Nama</th>
    <th></th>
  </tr>
  <?php foreach($details as $detail):?>
    <tr>
      <td><?php echo $detail['id_site']?></td>
      <td><?php echo $detail['name']?></td>
      <td><?php echo $detail['tgl_terbit']?></td>
      <td><?php echo $detail['tgl_expired']?></td>
      <td><?php echo $detail['no_izin']?></td>
      <td><?php echo $detail['atas_nama']?></td>
      <td>
        <a class="btn btn-success" href="<?php echo base_url();?>permitsAndLicenses/detail/<?php echo $detail['id_pl'];?>/<?php echo $detail['id_site']?>">Details</a>
      </td>
  <?php endforeach;?>
</table> 