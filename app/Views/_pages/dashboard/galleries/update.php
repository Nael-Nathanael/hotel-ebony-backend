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
        <form enctype="multipart/form-data" method="post" action="<?= route_to("object.galleries.update", $gallery->slug) ?>"
              class="card mx-auto" style="max-width: 500px">
            <div class="card-header">
                Ubah Nama Album
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="title">Judul Album</label>
                    <input type="text" name="title" id="title" class="form-control"
                           placeholder="Judul Album" value="<?= $gallery->title ?>" required>
                </div>
            </div>
            <div class="card-footer border-0">
                <button type="submit" class="btn btn-primary mx-auto">
                    Simpan
                </button>
            </div>
        </form>
    </div>
<?= $this->endSection(); ?>