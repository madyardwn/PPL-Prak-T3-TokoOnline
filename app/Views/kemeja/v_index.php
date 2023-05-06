<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<div class="row mb-3 mt-3 justify-content-between">
  <div class="col-md-4">
    <a href="<?php echo base_url('kemeja/create') ?>" class="fa fa-plus btn btn-primary"> Tambah Kemeja </a>
    <a href="<?php echo base_url('kemeja/cart') ?>" class="fa fa-shopping-cart btn btn-success">
      <!-- session cart item -->
      <?php if (session()->has('cart')) : ?>
            <?php $count = 0; ?>
            <?php foreach (session()->get('cart')['items'] as $key => $value) : ?>
                <?php $count += $value['qty']; ?>
            <?php endforeach; ?>
            <?php echo $count; ?>
      <?php else : ?>

      <?php endif; ?>
    </a>
  </div>
  <div class="col-md-4">
    <form action="<?php echo base_url('kemeja') ?>" method="get">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari Kemeja" name="keyword">
        <button class="fa fa-search btn btn-secondary" type="submit" name="submit"></button>
      </div>
    </form>
  </div>
</div>

<?php if (session()->getFlashdata('pesan')) : ?>
  <div class="alert alert-success" role="alert">
    <?php echo session()->getFlashdata('pesan'); ?>
  </div>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-4 g-4">
  <?php foreach ($kemeja as $b) : ?>
    <div class="col">
      <div class="card">
        <img src="<?php echo base_url('namafile/' . $b['namafile']) ?>" class="card-img-top" alt="<?php echo $b['namabrg'] ?>" style="height: 200px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title"><?php echo $b['namabrg'] ?></h5>
          <!-- stok -->
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Diskon : <?php echo $b['diskon'] ?>%</li>
          <li class="list-group-item">Stok : <?php echo $b['stok'] ?></li>
          <li class="list-group-item">Harga : Rp <?php echo number_format($b['harga'], 0, ',', '.') ?></li>
          <li class="list-group-item">Berat : <?php echo $b['berat'] / 1000 ?> Kg</li>
        </ul>
        <div class="card-footer text-center">
          <a href="<?php echo base_url('kemeja/edit/' . $b['idkemeja']) ?>" class="fa fa-edit btn btn-warning" style="font-size: 10px;"> Edit</a>
          <a href="<?php echo base_url('kemeja/delete/' . $b['idkemeja']) ?>" class="fa fa-trash btn btn-danger" style="font-size: 10px;"> Delete</a>
          <a href="<?php echo base_url('kemeja/show/' . $b['idkemeja']) ?>" class="fa fa-eye btn btn-info" style="font-size: 10px;"> Detail</a>
        </div>
        <!-- add to cart -->
        <div class="card-footer text-center">
          <form action="<?php echo base_url('kemeja/cart/add/' . $b['idkemeja']) ?>" method="get">
            <button type="submit" class="fa fa-shopping-cart btn btn-success" style="font-size: 12px;"> Add to Cart</button>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<!-- pagination -->
<div class="row mt-3">
  <div class="col">
    <?php echo $pager->links('kemeja', 'barang_pagination') ?>
  </div>
</div>

<?php echo $this->endSection(); ?>
</script>
