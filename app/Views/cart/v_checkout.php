<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <i>* <?php echo session()->getFlashdata('pesan'); ?></i>
<?php endif; ?>
<?php $validation = \Config\Services::validation(); ?>

<div class="row">
    <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">3</span>
        </h4>
        <ul class="list-group mb-3">
            <?php foreach ($cart as $c) : ?>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0"><?php echo $c['nama']; ?></h6>
                        <small class="text-muted"><?php echo $c['qty']; ?></small>
                    </div>
                    <span class="text-muted"><?php echo $c['qty'] * $c['harga']; ?></span>
                </li>
            <?php endforeach; ?>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (IDR)</span>
                <strong><?php echo $total; ?></strong>
            </li>
        </ul>
    </div>
    <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Checkout</h4>
        <form action="<?php echo base_url('barang/cart/checkout') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="username">Nama Pembeli</label>
                <div class="input-group">
                    <input autocomplete="off" placeholder="Nama Pembeli" type="text" name="nama" class="form-control">
                    <?php if ($validation->getError('nama')) { ?>
                        <i class="text-danger"><?php echo $error = $validation->getError('nama'); ?></i>
                    <?php } ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="username">Alamat</label>
                <div class="input-group">
                    <input autocomplete="off" placeholder="Alamat" type="text" name="alamat" class="form-control">
                    <?php if ($validation->getError('alamat')) { ?>
                        <i class="text-danger"><?php echo $error = $validation->getError('alamat'); ?></i>
                    <?php } ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="username">Kecamatan</label>
                <div class="input-group">
                    <input autocomplete="off" placeholder="Kecamatan" type="text" name="kecamatan" class="form-control">
                    <?php if ($validation->getError('kecamatan')) { ?>
                        <i class="text-danger"><?php echo $error = $validation->getError('kecamatan'); ?></i>
                    <?php } ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="username">Kota</label>
                <div class="input-group">
                    <input autocomplete="off" placeholder="Kota" type="text" name="kota" class="form-control">
                    <?php if ($validation->getError('kota')) { ?>
                        <i class="text-danger"><?php echo $error = $validation->getError('kota'); ?></i>
                    <?php } ?>
                </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
        </form>
    </div>
</div>


<?php echo $this->endSection(); ?>