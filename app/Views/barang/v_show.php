<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<?php $validation = \Config\Services::validation(); ?>

<h2>Detail Data Barang</h2>
<table class="table">
  <tr>
    <td>Nama Game</td>
    <td>
      <p><?php echo $barang['nama_barang'] ?></p>
    </td>
  </tr>

  <tr>
    <td>Harga</td>
    <td>
      <p><?php echo $barang['harga'] ?></p>
    </td>
  </tr>

  <tr>
    <td>Stok</td>
    <td>
      <p><?php echo $barang['stok'] ?></p>
    </td>
  </tr>

  <tr>
    <td>Gambar</td>
    <td>
      <img src="<?php echo base_url('gambar/' . $barang['gambar']) ?>" alt="<?php echo $barang['nama_barang'] ?>" style="width: 200px; object-fit: cover;">
    </td>
  </tr>

  <tr>
    <td>Gambar 2</td>
    <td>
      <img src="<?php echo base_url('gambar/' . $barang['barcode']) ?>" alt="<?php echo $barang['nama_barang'] ?>" style="width: 200px; object-fit: cover;">
    </td>
  </tr>

  <tr>
    <td></td>
    <td>
      <a href="<?php echo base_url('barang') ?>" class="btn btn-secondary">Kembali</a>
    </td>
  </tr>
</table>
<?php echo $this->endSection(); ?>
