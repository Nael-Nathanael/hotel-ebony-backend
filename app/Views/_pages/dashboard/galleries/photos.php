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
        <div
                class="card mx-auto">
            <div class="card-header">
                Album Foto <?= $gallery->title ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($photos as $photo): ?>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                            <div class="position-relative border">
                                <form action="<?= route_to("object.galleries.photos.delete", $photo->id) ?>"
                                      method="post">
                                    <button
                                            type="button"
                                            class="btn btn-sm btn-danger p-0 m-0 fs-5 position-absolute start-100 translate-middle d-flex justify-content-center align-items-center"
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

                                <img src="<?= $photo->url ?>" alt="<?= $photo->url ?>" class="w-100 shadow-sm"
                                     style="aspect-ratio: 16 / 9; object-fit: contain; object-position: center"/>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <form class="col-12 col-md-6 col-lg-4 col-xl-3" method="post" id="form"
                          enctype="multipart/form-data"
                          action="<?= route_to("object.galleries.photos", $gallery->slug) ?>">
                        <input name="img"
                               onchange="document.getElementById('form').submit()"
                               type="file"
                               class="d-none"
                               id="img"
                        >
                        <button type="button" onclick="document.getElementById('img').click()"
                                class="btn btn-outline-primary w-100 h-100">
                            + Upload New Photo
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>