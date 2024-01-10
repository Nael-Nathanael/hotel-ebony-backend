<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("head"); ?>
    <style>
        label {
            font-size: 14px;
        }
    </style>
<?= $this->endsection(); ?>

<?= $this->section("content"); ?>
    <div class="container my-4">
        <form enctype="multipart/form-data" method="post"
              action="<?= route_to("object.vouchers.update", $voucher->code) ?>"
              class="card mx-auto" style="max-width: 400px">
            <div class="card-header">
                Ubah Voucher
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="code">Kode</label>
                    <input type="text" name="code" value="<?= $voucher->code ?>" id="code"
                           class="form-control form-control-sm"
                           placeholder="code" readonly>
                </div>

                <div class="form-group mb-3 preview_isShownOnHomepage">
                    <label for="price_reduction">Potongan Harga</label>
                    <input type="number" required min="10000" value="<?= $voucher->price_reduction ?>" name="price_reduction" id="price_reduction"
                           class="form-control form-control-sm">
                </div>

                <div class="form-group mb-3">
                    <label for="description">Deskripsi</label>
                    <textarea type="text" name="description" id="description"
                              class="form-control form-control-sm"
                              placeholder="Deskripsi" rows="3"><?= $voucher->description ?></textarea>
                </div>
            </div>
            <div class="card-footer border-0">
                <button type="submit" class="btn btn-sm btn-primary">
                    Simpan
                </button>
            </div>
        </form>
    </div>
<?= $this->endSection(); ?>