<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?php echo $title ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>

<body>

  <!-- Responsive navbar-->
  <nav class="navbar navbar-expand-lg bg-light fixed-top">
    <div class="container">
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item me-3">
            <a class="nav-link text-dark" href="<?php echo base_url('barang') ?>">Home</a>
          </li>
          <li class="nav-item me-3">
            <a class="nav-link text-dark" href="<?php echo base_url('barang/transaksi') ?>">Transaksi</a>
          </li>
          <li class="nav-item me-3">
            <a class="nav-link text-dark" href="<?php echo base_url('barang/penjualan') ?>">Penjualan</a>
          </li>
        </ul>

        <!-- logout -->
        <div class="d-flex">
          <a href="<?php echo base_url('barang/logout') ?>" class="btn btn-danger">Logout</a>
        </div>
      </div>

    </div>
  </nav>
  <!-- Page content -->
  <div style="min-height: 80vh; margin-top: 70px; margin-bottom: 70px;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php echo $this->renderSection('content') ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="bg-primary py-3">
    <div class="container text-center">
      <span class="text-light">Copyrigth &copy; JTK POLBAN 2021</span>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</body>

</html>
