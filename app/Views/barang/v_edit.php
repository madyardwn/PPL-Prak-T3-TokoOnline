<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<?php $validation = \Config\Services::validation(); ?>

<h2>Edit Data Barang</h2>
<form action="<?php echo base_url('barang/update/' . $barang['id']) ?>" method="post" enctype="multipart/form-data">
  <table class="table">
    <tr>
      <td>Nama Game</td>
      <td><input autocomplete="off" type="text" name="nama_barang" value="<?php echo $barang['nama_barang'] ?>" class="form-control"></td>
      <td>
        <?php if ($validation->getError('id')) { ?>
          <i>* <?php echo $error = $validation->getError('id'); ?></i>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td>Harga</td>
      <td><input autocomplete="off" type="text" name="harga" value="<?php echo $barang['harga'] ?>" class="form-control"></td>
      <td>
        <?php if ($validation->getError('harga')) { ?>
          <i>* <?php echo $error = $validation->getError('harga'); ?></i>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td>Stok</td>
      <td><input autocomplete="off" type="text" name="stok" value="<?php echo $barang['stok'] ?>" class="form-control"></td>
      <td>
        <?php if ($validation->getError('stok')) { ?>
          <i>* <?php echo $error = $validation->getError('stok'); ?></i>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td>Gambar</td>
      <td>
        <img src="<?php echo base_url('gambar/' . $barang['gambar']) ?>" class="card-img-top" alt="<?php echo $barang['nama_barang'] ?>" style="height: 200px; object-fit: cover; width: 200px;">
        <br>
        <br>
        <input type="file" name="gambar" class="form-control">
      </td>
      <td>
        <?php if ($validation->getError('gambar')) { ?>
          <i>* <?php echo $error = $validation->getError('gambar'); ?></i>
        <?php } ?>
      </td>
    </tr>

    <tr>
      <td>Barcode</td>
      <td>
        <img src="<?php echo base_url('gambar/' . $barang['barcode']) ?>" class="card-img-top" alt="<?php echo $barang['nama_barang'] ?>" style="height: 200px; object-fit: cover; width: 200px;">
        <br>
        <br>
        <input type="file" name="gambar" class="form-control">
      </td>
      <td>
        <?php if ($validation->getError('barcode')) { ?>
          <i>* <?php echo $error = $validation->getError('barcode'); ?></i>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <input type="submit" class="btn btn-primary" value="Simpan">
        <a href="<?php echo base_url('barang') ?>" class="btn btn-secondary">Kembali</a>
      </td>
    </tr>
  </table>
</form>
<?php echo $this->endSection(); ?>