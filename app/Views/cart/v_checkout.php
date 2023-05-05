<?php echo $this->extend('layout/v_template'); ?>

<?php echo $this->section('content'); ?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo session()->getFlashdata('pesan'); ?>
    </div>
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
                    <span class="text-muted">Rp <?php echo number_format($c['qty'] * $c['harga'], 0, ',', '.'); ?></span>
                </li>
            <?php endforeach; ?>

            <li class="list-group-item d-flex justify-content-between">
                <span>Berat</span>
                <strong id="berat" class="text-muted"><?php echo $berat / 1000; ?> Kg</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Ongkir</span>
                <strong id="ongkir">Rp <?php echo number_format($ongkir, 0, ',', '.'); ?></strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (IDR)</span>
                <strong id="total">Rp <?php echo number_format($total, 0, ',', '.'); ?></strong>
            </li>

        </ul>
    </div>
    <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Checkout</h4>
        <form action="<?php echo base_url('kemeja/cart/checkout') ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="total">
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

            <div class="mb-3">
                <label for="kodepos">Kodepos</label>
                <select class="form-control" name="kodepos">
                    <option value="" selected disabled>Pilih Kodepos</option>
                    <?php foreach ($kodepos as $k) : ?>
                        <option value="<?php echo $k['id']; ?>"><?php echo $k['kodepos_tujuan']; ?> | Rp <?php echo number_format($k['ongkir_per_kilo'], 0, ',', '.') ?>/Kg</option>
                    <?php endforeach; ?>
                </select>
                <?php if ($validation->getError('kodepos')) { ?>
                    <i class="text-danger"><?php echo $error = $validation->getError('kodepos'); ?></i>
                <?php } ?>
            </div>

            <div class="mb-3">
                <label for="nomor_telepon">Nomor Telepon</label>
                <div class="input-group">
                    <input autocomplete="off" placeholder="Nomor Telepon" type="text" name="nomor_telepon" class="form-control">
                    <?php if ($validation->getError('nomor_telepon')) { ?>
                        <i class="text-danger"><?php echo $error = $validation->getError('nomor_telepon'); ?></i>
                    <?php } ?>
                </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('select[name="kodepos"]').on('change', function() {
            var id = $(this).val();

            if (id) {
                $.ajax({
                    url: "<?php echo base_url('kemeja/cart/getOngkir') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        const formatRupiah = (value) => {
                            const formatter = new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0
                            });
                            return formatter.format(value);
                        };

                        $('strong#ongkir').html(formatRupiah(data.ongkir));
                        $('strong#total').html(formatRupiah(data.total));
                        $('input[name="total"]').val(data.total);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error get data from ajax');
                    }
                });
            } else {
                $('#ongkir').html('0');
            }
        });
    });
</script>

<?php echo $this->endSection(); ?>
