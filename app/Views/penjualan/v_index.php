<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<?php if (session()->getFlashdata('pesan')) : ?>
  <i>* <?php echo session()->getFlashdata('pesan'); ?></i>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-4 g-4">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">No Transaksi</th>
        <th scope="col">ID Barang</th>
        <th scope="col">Jumlah</th>
        <th scope="col">Harga</th>
      </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($penjualan as $p) : ?>
            <tr>
            <th scope="row"><?php echo $no++; ?></th>
            <td><?php echo $p['no_transaksi']; ?></td>
            <td><?php echo $p['id_barang']; ?></td>
            <td><?php echo $p['jumlah_jual']; ?></td>
            <td><?php echo $p['harga_jual']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php echo $this->endSection(); ?>
