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
        <th scope="col">Nama Barang</th>
        <th scope="col">Jumlah</th>
        <th scope="col">Harga Satuan</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; ?>
      <?php foreach ($penjualan as $p) : ?>
        <tr>
          <th scope="row"><?php echo $no++; ?></th>
          <td><?php echo $p['idtrans']; ?></td>
          <td><?php echo $p['namabrg']; ?></td>
          <td><?php echo $p['jmljual']; ?></td>
          <td><?php echo $p['hargajual']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php echo $this->endSection(); ?>
