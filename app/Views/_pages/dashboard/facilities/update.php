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
              action="<?= route_to("object.facilities.update", $voucher->id) ?>"
              class="card">
            <div class="card-header">
                Edit Fasilitas
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h4>Data Fasilitas</h4>

                        <div class="form-group mb-3">
                            <label for="isWhiteText">Tampilkan di Homepage</label>
                            <select name="isShownOnHomepage" id="isShownOnHomepage" required
                                    class="form-select-sm form-select">
                                <option value="1" <?= $voucher->isShownOnHomepage ? 'selected' : '' ?>>Tampil</option>
                                <option value="0" <?= $voucher->isShownOnHomepage ? '' : 'selected' ?>>Tidak Tampil
                                </option>
                            </select>
                        </div>

                        <div class="form-group mb-3 preview_isShownOnHomepage">
                            <label for="thumbnailImg">Gambar Thumbnail</label>
                            <input type="file" name="thumbnailImg" id="thumbnailImg"
                                   class="form-control form-control-sm">
                        </div>

                        <div class="form-group mb-3">
                            <label for="img">Gambar Cover</label>
                            <input type="file" name="img" id="img" class="form-control form-control-sm">
                        </div>

                        <div class="form-group mb-3">
                            <label for="label">Label</label>
                            <input type="text" name="label" id="label" class="form-control form-control-sm"
                                   placeholder="Label" required value="<?= $voucher->label ?>">
                        </div>

                        <div class="form-group mb-3 preview_isShownOnHomepage">
                            <label for="title">Judul</label>
                            <input type="text" name="title" id="title" class="form-control form-control-sm"
                                   placeholder="Judul" value="<?= $voucher->title ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Deskripsi</label>
                            <textarea type="text" name="description" id="description"
                                      class="form-control form-control-sm"
                                      placeholder="Deskripsi" rows="3"><?= $voucher->description ?></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="isWhiteText">Warna Teks</label>
                            <select name="isWhiteText" id="isWhiteText" required class="form-select-sm form-select">
                                <option value="1" <?= $voucher->isWhiteText ? 'selected' : '' ?>>Putih</option>
                                <option value="0" <?= $voucher->isWhiteText ? '' : 'selected' ?>>Hitam</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-8">
                        <h4>Draft</h4>

                        <div class="card card-body mb-2 preview_isShownOnHomepage">
                            <h6>Tampilan Homepage</h6>

                            <div>
                                <img width="150" height="150" alt="thumbnail"
                                     class="preview_isShownOnHomepage preview_thumbnailImg"
                                     style="object-fit: cover; object-position: center"
                                     src="<?= $voucher->thumbnailUrl ?>"/>
                                <p class="text-danger mb-0 mt-1 marcellus preview_isShownOnHomepage preview_label">
                                    Label</p>
                                <p class="mb-0 text-decoration-underline lh-2 fs-5 marcellus preview_isShownOnHomepage preview_title">
                                    Judul</p>
                                <span class="!preview_isShownOnHomepage d-none mb-0">Tidak tampil di homepage</span>
                            </div>
                        </div>

                        <div class="card card-body">
                            <h6>Tampilan Penuh</h6>

                            <div class="position-relative w-100"
                                 style="max-width: 600px;aspect-ratio: 2 / 1">
                                <img alt="cover" class="w-100 h-100 preview_img"
                                     style="object-fit: cover; object-position: center"
                                     src="<?= $voucher->imgUrl ?>"
                                />
                                <div class="position-absolute marcellus top-50 start-50 translate-middle text-center lh-sm preview_isWhiteText text-white">
                                    <p class="mb-0 text-uppercase h1 preview_label">Label</p>
                                    <small class="preview_description">Deskripsi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </form>
    </div>
<?= $this->endSection(); ?>

<?= $this->section('javascript') ?>
    <script>
        bindSelectToPreview("isWhiteText", (value) => {
            if (Number(value) === 0) {
                for (let element of document.getElementsByClassName('preview_isWhiteText')) {
                    element.classList.remove('text-white')
                    element.classList.add('text-dark')
                }
            } else {
                for (let element of document.getElementsByClassName('preview_isWhiteText')) {
                    element.classList.add('text-white')
                    element.classList.remove('text-dark')
                }
            }
        })

        bindSelectToPreview("isShownOnHomepage", (value) => {
            if (Number(value) === 0) {
                for (let element of document.getElementsByClassName('preview_isShownOnHomepage')) {
                    element.classList.add('d-none')
                }
                for (let element of document.getElementsByClassName('!preview_isShownOnHomepage')) {
                    element.classList.remove('d-none')
                }
            } else {
                for (let element of document.getElementsByClassName('preview_isShownOnHomepage')) {
                    element.classList.remove('d-none')
                }
                for (let element of document.getElementsByClassName('!preview_isShownOnHomepage')) {
                    element.classList.add('d-none')
                }
            }
        })

        bindInputToPreview("label")
        bindInputToPreview("title")
        bindInputToPreview("description")
        bindInputImageToPreview("img")
        bindInputImageToPreview("thumbnailImg")

        document.getElementById("label").dispatchEvent(new Event('keyup'));
        document.getElementById("title").dispatchEvent(new Event('keyup'));
        document.getElementById("description").dispatchEvent(new Event('keyup'));
        document.getElementById("isShownOnHomepage").dispatchEvent(new Event('change'));
        document.getElementById("isWhiteText").dispatchEvent(new Event('change'));
    </script>
<?= $this->endSection(); ?>