<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<?php $validation = \Config\Services::validation(); ?>

<div class="row mb-3 mt-3 justify-content-between">
  <form action="<?php echo base_url('kemeja/store') ?>" method="post" enctype="multipart/form-data">
    <table class="table">
      <tr>
        <td>Nama Kemeja</td>
        <td><input autocomplete="off" placeholder="Nama Kemeja" type="text" name="namabrg" class="form-control"></td>
        <td>
          <?php if ($validation->getError('namabrg')) { ?>
            <i class="text-danger"><?php echo $error = $validation->getError('namabrg'); ?></i>
          <?php } ?>
        </td>
      </tr>
      <tr>
        <td>Harga (Rp)</td>
        <td><input autocomplete="off" placeholder="Harga (Rp)" type="number" name="harga" class="form-control"></td>
        <td>
          <?php if ($validation->getError('harga')) { ?>
            <i class="text-danger"><?php echo $error = $validation->getError('harga'); ?></i>
          <?php } ?>
        </td>
      </tr>
      <tr>
        <td>Stok (pcs)</td>
        <td><input autocomplete="off" placeholder="Stok (pcs)" type="int" name="stok" class="form-control"></td>
        <td>
          <?php if ($validation->getError('stok')) { ?>
            <i class="text-danger"><?php echo $error = $validation->getError('stok'); ?></i>
          <?php } ?>
        </td>
      </tr>

      <!-- Discount -->
      <tr>
        <td>Discount (%)</td>
        <td><input autocomplete="off" placeholder="Discount (%)" type="number" name="diskon" class="form-control"></td>
        <td>
          <?php if ($validation->getError('discount')) { ?>
            <i class="text-danger"><?php echo $error = $validation->getError('discount'); ?></i>
          <?php } ?>
        </td>
      </tr>

      <tr>
        <td>Gambar</td>
        <td><input type="file" name="namafile"></td>
        <td>
          <?php if ($validation->getError('namafile')) { ?>
            <i class="text-danger"><?php echo $error = $validation->getError('namafile'); ?></i>
          <?php } ?>
        </td>
      </tr>

      <tr>
        <td>Berat (gram)</td>
        <td><input autocomplete="off" placeholder="Berat (gram)" type="int" name="berat" class="form-control"></td>
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
</div>

<?php echo $this->endSection(); ?>
