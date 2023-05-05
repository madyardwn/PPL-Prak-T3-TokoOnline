<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<?php $validation = \Config\Services::validation(); ?>

<h2>Edit Data Kemeja</h2>
<form action="<?php echo base_url('kemeja/update/' . $barang['idkemeja']) ?>" method="post" enctype="multipart/form-data">
  <table class="table">
    <tr>
      <td>Nama Kemeja</td>
      <td><input autocomplete="off" type="text" name="namabrg" value="<?php echo $barang['namabrg'] ?>" class="form-control"></td>
      <td>
        <?php if ($validation->getError('namabrg')) { ?>
          <i class="text-danger"><?php echo $error = $validation->getError('namabrg'); ?></i>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td>Harga (Rp)</td>
      <td><input autocomplete="off" type="text" name="harga" value="<?php echo $barang['harga'] ?>" class="form-control"></td>
      <td>
        <?php if ($validation->getError('harga')) { ?>
          <i class="text-danger"><?php echo $error = $validation->getError('harga'); ?></i>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td>Stok (pcs)</td>
      <td><input autocomplete="off" type="text" name="stok" value="<?php echo $barang['stok'] ?>" class="form-control"></td>
      <td>
        <?php if ($validation->getError('stok')) { ?>
          <i class="text-danger"><?php echo $error = $validation->getError('stok'); ?></i>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td>Discount (%)</td>
      <td><input autocomplete="off" type="text" name="diskon" value="<?php echo $barang['diskon'] ?>" class="form-control"></td>
      <td>
        <?php if ($validation->getError('diskon')) { ?>
          <i class="text-danger"><?php echo $error = $validation->getError('diskon'); ?></i>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td>Gambar</td>
      <td>
        <img src="<?php echo base_url('namafile/' . $barang['namafile']) ?>" class="card-img-top" alt="<?php echo $barang['namafile'] ?>" style="width: 150px;">
        <br>
        <br>
        <input type="file" name="namafile" class="form-control">
      </td>
      <td>
        <?php if ($validation->getError('namafile')) { ?>
          <i class="text-danger"><?php echo $error = $validation->getError('namafile'); ?></i>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td>Berat (gram)</td>
      <td><input autocomplete="off" type="text" name="berat" value="<?php echo $barang['berat'] ?>" class="form-control"></td>
      <td>
        <?php if ($validation->getError('berat')) { ?>
          <i class="text-danger"><?php echo $error = $validation->getError('berat'); ?></i>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <input type="submit" class="btn btn-primary" value="Simpan">
        <a href="<?php echo base_url('kemeja') ?>" class="btn btn-warning">Kembali</a>
      </td>
    </tr>
  </table>
</form>
<?php echo $this->endSection(); ?>
