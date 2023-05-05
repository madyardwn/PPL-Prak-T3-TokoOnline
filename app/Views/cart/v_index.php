<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<h1>Cart</h1>

<?php if (session()->getFlashdata('pesan')) : ?>
  <div class="alert alert-success" role="alert">
    <?php echo session()->getFlashdata('pesan'); ?>
  </div>
<?php endif; ?>

<!-- clear cart -->
<div class="mb-3 text-right d-flex justify-content-end">
  <a href=" <?php echo base_url('kemeja/cart/destroy'); ?>" class="fa-pull-right fa fa-trash" style="text-decoration: none; font-size: 20px; color: red;"></a>
</div>

<!-- Display Cart -->
<table class="table table-bordered">
  <thead>
    <tr class="text-center">
      <th width="50">No</th>
      <th width="100">Gambar</th>
      <th>Kemeja</th>
      <th width="120">Harga</th>
      <th width="100">Jumlah</th>
      <th width="150">Subtotal</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; ?>
    <?php foreach ($cart as $c) : ?>
      <tr>
        <td class="text-center"><?php echo $no++; ?></td>
        <td>
          <img src="<?php echo base_url('namafile/' . $c['namafile']); ?>" width="100">
        </td>
        <td><?php echo $c['nama']; ?></td>
        <td>Rp. <?php echo number_format($c['harga'], 0, ',', '.'); ?></td>
        <td class="text-center border">
          <a href="<?php echo base_url('kemeja/cart/reduce/' . $c['id']); ?>" class="fa fa-minus text-danger small" style="text-decoration: none;"></a>
          <p class="d-inline border px-2"><?php echo $c['qty']; ?></p>
          <a href="<?php echo base_url('kemeja/cart/add/' . $c['id']); ?>" class="fa fa-plus text-success small" style="text-decoration: none;"></a>

        </td>
        <td>Rp. <?php echo number_format($c['subtotal'], 0, ',', '.'); ?></td>
      </tr>
    <?php endforeach; ?>
    <tr>
      <td colspan="5" align="right" style="font-weight: bold;">Total</td>
      <td>Rp. <?php echo number_format($total, 0, ',', '.'); ?></td>
    </tr>
  </tbody>
</table>

<!-- Checkout -->
<div class="mb-3 text-right d-flex justify-content-end">
  <a href="<?php echo base_url('kemeja/cart/checkout'); ?>" class="btn btn-primary">Checkout</a>
</div>

<?php echo $this->endSection(); ?>