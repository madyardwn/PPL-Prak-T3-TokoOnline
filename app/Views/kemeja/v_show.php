<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<?php $validation = \Config\Services::validation(); ?>

<h2>Detail Data Barang</h2>
<table class="table">
  <tr>
    <td>Nama Game</td>
    <td>
      <p><?php echo $barang['namabrg'] ?></p>
    </td>
  </tr>

  <tr>
    <td>Harga</td>
    <td>
      <p>Rp. <?php echo number_format($barang['harga'], 0, ',', '.') ?></p>
    </td>
  </tr>

  <tr>
    <td>Diskon</td>
    <td>
      <p><?php echo $barang['diskon'] ?>%</p>
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
      <img src="<?php echo base_url('namafile/' . $barang['namafile']) ?>" alt="<?php echo $barang['namabrg'] ?>" style="width: 200px; object-fit: cover;">
    </td>
  </tr>

  <tr>
    <td>Berat (Kg)</td>
    <td>
      <p><?php echo $barang['berat'] / 1000 ?> kg</p>
    </td>
  </tr>


  <tr>
    <td></td>
    <td>
      <a href="<?php echo base_url('kemeja') ?>" class="btn btn-secondary">Kembali</a>
    </td>
  </tr>
</table>
<?php echo $this->endSection(); ?>
