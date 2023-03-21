<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<div class="row mb-3 mt-3 justify-content-between">
  <div class="col-md-4">
    <a href="<?php echo base_url('barang/create') ?>" class="fa fa-plus btn btn-primary"> Tambah Game </a>
  </div>
  <div class="col-md-4">
    <form action="<?php echo base_url('barang') ?>" method="get">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari Game" name="keyword">
        <button class="fa fa-search btn btn-secondary" type="submit" name="submit"></button>
      </div>
    </form>
  </div>
</div>

<?php if (session()->getFlashdata('pesan')) : ?>
  <i>* <?php echo session()->getFlashdata('pesan'); ?></i>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-4 g-4">
  <?php foreach ($barang as $b) : ?>
    <div class="col">
      <div class="card">
        <img src="<?php echo base_url('gambar/' . $b['gambar']) ?>" class="card-img-top" alt="<?php echo $b['nama_barang'] ?>" style="height: 200px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title"><?php echo $b['nama_barang'] ?></h5>
          <!-- stok -->
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Stok : <?php echo $b['stok'] ?></li>
          <li class="list-group-item">Harga : Rp. <?php echo number_format($b['harga'], 0, ',', '.') ?></li>
        </ul>
        <div class="card-footer text-center">
          <a href="<?php echo base_url('barang/edit/' . $b['id']) ?>" class="fa fa-edit btn btn-warning" style="font-size: 12px;"> Edit</a>
          <a href="<?php echo base_url('barang/delete/' . $b['id']) ?>" class="fa fa-trash btn btn-danger" style="font-size: 12px;"> Hapus</a>
          <a href="<?php echo base_url('barang/show/' . $b['id']) ?>" class="fa fa-info btn btn-info text-white" style="font-size: 12px;"> Detail</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<!-- pagination -->
<div class="row mt-3">
  <div class="col">
    <?php echo $pager->links('barang', 'barang_pagination') ?>
  </div>
</div>

<?php echo $this->endSection(); ?>
</script>
