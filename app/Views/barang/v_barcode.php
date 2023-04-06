<div class="barcode-conatiner">
    <?php if (in_array($tipe, ["JPG", "PNG"])) {
        echo '<img src="data:image/png;base64,' . base64_encode($barcode) . '"/>';
    } else {
        echo $barcode;
        echo $tipe;
    }
    ?>
    <span class="barcode-text"><?php echo $text ?></span>
</div>
<style>
    .barcode-text {
        letter-spacing: 7px;
        margin-top: 7px;
        display: block;
    }
</style>​