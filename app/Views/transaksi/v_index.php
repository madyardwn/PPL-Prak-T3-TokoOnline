<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<?php if (session()->getFlashdata('pesan')) : ?>
  <div class="alert alert-success" role="alert">
    <?php echo session()->getFlashdata('pesan'); ?>
  </div>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-4 g-4">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">No Transaksi</th>
        <th scope="col">Nama Pembeli</th>
        <th scope="col">Alamat</th>
        <th scope="col">Kecamatan</th>
        <th scope="col">Kota</th>
        <th scope="col">Nomor Telepon</th>
        <th scope="col">Total Transaksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; ?>
      <?php foreach ($transaksi as $t) : ?>
        <tr>
          <th scope="row"><?php echo $no++; ?></th>
          <td><?php echo $t['idtrans']; ?></td>
          <td><?php echo $t['nama']; ?></td>
          <td><?php echo $t['alamat']; ?></td>
          <td><?php echo $t['kecamatan']; ?></td>
          <td><?php echo $t['kota']; ?></td>
          <td><?php echo $t['hp']; ?></td>
          <td><?php echo 'Rp ' . number_format($t['total'], 0, ',', '.'); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php echo $this->endSection(); ?>
