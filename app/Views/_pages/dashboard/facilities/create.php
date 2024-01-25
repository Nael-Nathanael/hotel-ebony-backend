<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("head"); ?>
    <style>
        label {
            font-size: 14px;
        }
    </style>
<?= $this->endsection(); ?>

<?= $this->section("content"); ?>
<?= view("_components/PageHero", [
    "breadcrumbs" => [
        "Facilities" => route_to("dashboard.facilities.index"),
        "New Facility"
    ]
]); ?>
    <div class="container mb-4">
        <form enctype="multipart/form-data" method="post" action="<?= route_to("object.facilities.create") ?>">
            <div class="row">
                <div class="col-4">
                    <h4>Data Fasilitas</h4>

                    <div class="form-group mb-3">
                        <label for="isWhiteText">Tampilkan di Homepage</label>
                        <select name="isShownOnHomepage" id="isShownOnHomepage" required
                                class="form-select-sm form-select">
                            <option value="1" selected>Tampil</option>
                            <option value="0">Tidak Tampil</option>
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
                        <label for="label">Label (EN)</label>
                        <input type="text" name="label" id="label" class="form-control form-control-sm"
                               placeholder="Label" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="label_id">Label (ID)</label>
                        <input type="text" name="label_id" id="label_id" class="form-control form-control-sm"
                               placeholder="Label" required>
                    </div>

                    <div class="form-group mb-3 preview_isShownOnHomepage">
                        <label for="title">Title (EN)</label>
                        <input type="text" name="title" id="title" class="form-control form-control-sm"
                               placeholder="Title">
                    </div>

                    <div class="form-group mb-3 preview_isShownOnHomepage">
                        <label for="title_id">Judul (ID)</label>
                        <input type="text" name="title_id" id="title_id" class="form-control form-control-sm"
                               placeholder="Judul">
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Description (EN)</label>
                        <textarea type="text" name="description" id="description"
                                  class="form-control form-control-sm"
                                  placeholder="Description" rows="3"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description_id">Deskripsi (ID)</label>
                        <textarea type="text" name="description_id" id="description_id"
                                  class="form-control form-control-sm"
                                  placeholder="Deskripsi" rows="3"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="isWhiteText">Warna Teks</label>
                        <select name="isWhiteText" id="isWhiteText" required class="form-select-sm form-select">
                            <option value="1" selected>Putih</option>
                            <option value="0">Hitam</option>
                        </select>
                    </div>

                </div>
                <div class="col-8">
                    <h4>Draft</h4>

                    <div class="row g-2">
                        <div class="col-6">
                            <div class="card card-body mb-2 preview_isShownOnHomepage">
                                <h6>Homepage View (EN)</h6>

                                <div>
                                    <img width="150" height="150" alt="thumbnail"
                                         class="preview_isShownOnHomepage preview_thumbnailImg"
                                         style="object-fit: cover; object-position: center"
                                         src="<?= PLACEHOLDER_IMG ?>"/>
                                    <p class="text-danger mb-0 mt-1 marcellus preview_isShownOnHomepage preview_label">
                                        Label</p>
                                    <p class="mb-0 text-decoration-underline lh-2 fs-5 marcellus preview_isShownOnHomepage preview_title">
                                        Title</p>
                                    <span class="!preview_isShownOnHomepage d-none mb-0">Not shown in homepage</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-body mb-2 preview_isShownOnHomepage">
                                <h6>Tampilan Beranda (ID)</h6>

                                <div>
                                    <img width="150" height="150" alt="thumbnail"
                                         class="preview_isShownOnHomepage preview_thumbnailImg"
                                         style="object-fit: cover; object-position: center"
                                         src="<?= PLACEHOLDER_IMG ?>"/>
                                    <p class="text-danger mb-0 mt-1 marcellus preview_isShownOnHomepage preview_label_id">
                                        Label</p>
                                    <p class="mb-0 text-decoration-underline lh-2 fs-5 marcellus preview_isShownOnHomepage preview_title_id">
                                        Judul</p>
                                    <span class="!preview_isShownOnHomepage d-none mb-0">Tidak tampil di homepage</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-body">
                                <h6>Facility Menu View (EN)</h6>

                                <div class="position-relative w-100"
                                     style="max-width: 600px;aspect-ratio: 2 / 1">
                                    <img alt="cover" class="w-100 h-100 preview_img"
                                         style="object-fit: cover; object-position: center"
                                         src="<?= PLACEHOLDER_IMG ?>"
                                    />
                                    <div class="position-absolute marcellus top-50 start-50 translate-middle text-center lh-sm preview_isWhiteText text-white">
                                        <p class="mb-0 text-uppercase h1 preview_label">Label</p>
                                        <small class="preview_description">Description</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-body">
                                <h6>Facility Menu View (ID)</h6>

                                <div class="position-relative w-100"
                                     style="max-width: 600px;aspect-ratio: 2 / 1">
                                    <img alt="cover" class="w-100 h-100 preview_img"
                                         style="object-fit: cover; object-position: center"
                                         src="<?= PLACEHOLDER_IMG ?>"
                                    />
                                    <div class="position-absolute marcellus top-50 start-50 translate-middle text-center lh-sm preview_isWhiteText text-white">
                                        <p class="mb-0 text-uppercase h1 preview_label_id">Label</p>
                                        <small class="preview_description_id">Deskripsi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">
                Simpan
            </button>
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

        bindInputToPreview("label_id")
        bindInputToPreview("title_id")
        bindInputToPreview("description_id")

        bindInputImageToPreview("img")
        bindInputImageToPreview("thumbnailImg")
    </script>
<?= $this->endSection(); ?>