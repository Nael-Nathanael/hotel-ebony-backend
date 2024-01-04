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
        <form enctype="multipart/form-data" method="post" action="<?= route_to("object.rooms.update-images") ?>"
              class="card">
            <div class="card-header">
                <div>
                    <small class="text-secondary">Update Foto</small>
                    <h5 class="m-0">
                        <?= $room->name ?>
                    </h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row align-items-center g-4">
                    <?php foreach ($room->images as $image): ?>
                        <?php if ($image->id != '0'): ?>
                            <div class="col-6">
                                <div class="position-relative" style="max-width: 600px">
                                    <div class="position-absolute top-0 start-100 translate-middle">
                                        <button type="button"
                                                class="btn btn-danger btn-sm p-0 d-flex justify-content-center align-items-center rounded-circle"
                                                style="width: 20px; height: 20px" onclick="confirmBeforeSubmit(
                                                this,
                                                'Hapus Foto?',
                                                'Foto yang telah dihapus tidak dapat dikembalikan',
                                                '<?= route_to("object.rooms.delete-image", $image->id) ?>'
                                                )">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                                <img src="<?= $image->imgUrl ?>" alt="<?= $image->imgUrl ?>" class="w-100"
                                     style="aspect-ratio: 2 / 1"/>
                            </div>

                        <?php endif ?>
                    <?php endforeach; ?>


                    <div class="col-12">
                        <div class="w-100 mx-auto border border-primary d-flex justify-content-center align-items-center rounded cursor-pointer"
                             style="max-width: 300px; aspect-ratio: 2 / 1"
                             onclick="document.getElementById('<?= $room->slug . "new" ?>').click()">
                            <i class="bi bi-plus fs-2 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <form action="<?= route_to('object.rooms.add-image', $room->slug) ?>"
          method="post"
          id="<?= $room->slug . "_form" ?>" enctype="multipart/form-data">
        <input class="d-none" id="<?= $room->slug . "new" ?>"
               name="img"
               onchange="document.getElementById('<?= $room->slug . "_form" ?>').submit()"
               type="file">
    </form>
<?= $this->endSection(); ?>