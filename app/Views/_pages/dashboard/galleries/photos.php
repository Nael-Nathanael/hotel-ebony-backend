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
        call("MENU_GALLERY", "Gallery") => route_to("dashboard.galleries.index"),
        "Manage Album: " . $gallery->title
    ]
]); ?>

    <div class="container my-5">
        <div class="row g-4">
            <?php foreach ($photos as $photo): ?>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative w-100 bg-light" style="aspect-ratio: 16 / 9">
                        <form action="<?= route_to("object.galleries.photos.delete", $photo->id) ?>"
                              method="post" class="position-absolute start-100 translate-middle">
                            <button
                                    type="button"
                                    class="btn btn-sm btn-danger p-0 m-0 fs-5 d-flex justify-content-center align-items-center"
                                    style="width: 20px; height: 20px"
                                    onclick="confirmBeforeSubmit(
                                            this,
                                            'Hapus Foto?',
                                            'Foto yang telah dihapus tidak dapat dikembalikan'
                                        )"
                            >
                                <i class="bi bi-x"></i>
                            </button>
                        </form>

                        <img src="<?= $photo->url ?>" alt="<?= $photo->url ?>" class="w-100"
                             style="aspect-ratio: 16 / 9; object-fit: cover; object-position: center"/>
                    </div>
                </div>
            <?php endforeach; ?>
            <form class="col-12 col-md-6 col-lg-4 col-xl-3" method="post" id="form"
                  enctype="multipart/form-data"
                  action="<?= route_to("object.galleries.photos", $gallery->slug) ?>">
                <input name="img"
                       onchange="document.getElementById('form').submit()"
                       type="file"
                       accept=".jpg, .jpeg, .png"
                       class="d-none"
                       id="img"
                >
                <button type="button" onclick="document.getElementById('img').click()"
                        class="btn btn-outline-primary w-100 h-100">
                    + Upload New Photo
                </button>
                <small class="text-secondary lh-1 d-block" style="font-size: 12px">
                    *Ukuran gambar yang direkomendasikan: 1920 x 1080 (Dimensi 16 / 9)
                </small>
            </form>
        </div>
    </div>
<?= $this->endSection(); ?>