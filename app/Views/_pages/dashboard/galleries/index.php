<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<?= view("_components/HeroEditor", [
    "field_bg" => "GALLERY_HERO_BG",
    "field_title" => "GALLERY_HERO_TITLE",
    "field_subtitle" => "GALLERY_HERO_SUBTITLE",
]) ?>

<div class="container mb-5">
    <div class="w-100 text-end mb-3">
        <a class="btn btn-outline-success btn-sm" href="<?= route_to("dashboard.galleries.create") ?>">
            <i class="bi bi-plus"></i> Create New
        </a>
    </div>

    <div class="row g-2">
        <?php foreach ($galleries as $index => $gallery): ?>
            <div class="col-4">
                <div class="w-100 position-relative">
                    <img src="<?= PLACEHOLDER_IMG ?>" alt="<?= $gallery->title ?>" class="w-100"
                         style="aspect-ratio: 16 / 9">
                    <p class="w-100 m-0 lh-1 mt-1 mb-2">
                        <b>EN&nbsp;: </b><?= $gallery->title ?><br>
                        <b>ID&nbsp;&nbsp;: </b><?= $gallery->title_id ?: $gallery->title ?>
                    </p>

                    <div class="position-absolute top-0 end-0">
                        <div class="m-2 d-flex gap-2">
                            <a class="btn btn-primary btn-sm"
                               href="<?= route_to("dashboard.galleries.photos", $gallery->slug) ?>">
                                <i class="bi bi-images me-1"></i> Edit
                            </a>

                            <a class="btn text-white btn-warning btn-sm text-nowrap"
                               style=""
                               href="<?= route_to("dashboard.galleries.update", $gallery->slug) ?>">
                                <i class="bi bi-pen me-1"></i> Rename
                            </a>

                            <form action="<?= route_to("object.galleries.delete", $gallery->slug) ?>"
                                  method="post">
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmBeforeSubmit(
                                            this,
                                            'Hapus Album?',
                                            'Album yang telah dihapus tidak dapat dikembalikan'
                                        )">
                                    <i class="bi bi-trash me-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection(); ?>
