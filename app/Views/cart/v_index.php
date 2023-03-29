<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<h1>Cart</h1>

<!-- Display Cart -->
<table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th width="150">Gambar</th>
      <th>Nama Barang</th>
      <th>Harga</th>
      <th>Qty</th>
      <th>Subtotal</th>
      <th width="100">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; ?>
    <?php foreach ($cart as $c) : ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><img src="<?php echo base_url('gambar/' . $c->gambar); ?>" alt="<?php echo $c->nama_barang; ?>" width="150" height="200"></td>
        <td><?php echo $c->nama_barang; ?></td>
        <td>Rp. <?php echo number_format($c->harga, 0, ',', '.'); ?></td>
        <td><?php echo $c->qty; ?></td>
        <td>Rp. <?php echo number_format($c->subtotal, 0, ',', '.'); ?></td>
        <td>
          <a href="<?php echo base_url('cart/delete/' . $c->id); ?>" class="btn btn-danger btn-sm">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
    <tr>
      <td colspan="5" align="right">Total</td>
      <td>Rp. <?php echo number_format($total->total, 0, ',', '.'); ?></td>
      <td>
        <a href="<?php echo base_url('barang/cart/checkout'); ?>" class="btn btn-success btn-sm">Checkout</a>
      </td>
    </tr>
  </tbody>
</table>

<?php echo $this->endSection(); ?>
