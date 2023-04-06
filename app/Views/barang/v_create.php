<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<?php $validation = \Config\Services::validation(); ?>

<div class="row mb-3 mt-3 justify-content-between">
  <form action="<?php echo base_url('barang/store') ?>" method="post" enctype="multipart/form-data">
    <table class="table">
      <tr>
        <td>Nama Barang</td>
        <td><input autocomplete="off" placeholder="Nama Barang" type="text" name="nama_barang" class="form-control" value="<?php echo old('nama_barang') ?>"></td>
        <td>
          <?php if ($validation->getError('nama_barang')) { ?>
            <i class="text-danger"><?php echo $error = $validation->getError('nama_barang'); ?></i>
          <?php } ?>
        </td>
      </tr>
      <tr>
        <td>Harga</td>
        <td><input autocomplete="off" placeholder="Harga" type="number" name="harga" class="form-control"></td>
        <td>
          <?php if ($validation->getError('harga')) { ?>
            <i class="text-danger"><?php echo $error = $validation->getError('harga'); ?></i>
          <?php } ?>
        </td>
      </tr>
      <tr>
        <td>Stok</td>
        <td><input autocomplete="off" placeholder="Stok" type="int" name="stok" class="form-control"></td>
        <td>
          <?php if ($validation->getError('stok')) { ?>
            <i class="text-danger"><?php echo $error = $validation->getError('stok'); ?></i>
          <?php } ?>
        </td>
      </tr>
      <tr>
        <td>Gambar</td>
        <td><input type="file" name="gambar"></td>
        <td>
          <?php if ($validation->getError('gambar')) { ?>
            <i class="text-danger"><?php echo $error = $validation->getError('gambar'); ?></i>
          <?php } ?>
        </td>
      </tr>

      <!--barcode-->
      <tr>
        <td>Barcode</td>
        <td><input type="file" name="barcode"></td>
        <td>
          <?php if ($validation->getError('barcode')) { ?>
            <i class="text-danger"><?php echo $error = $validation->getError('barcode'); ?></i>
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
</div>

<?php echo $this->endSection(); ?>