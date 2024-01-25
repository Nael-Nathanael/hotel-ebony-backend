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
        "Create New Album"
    ]
]); ?>

    <div class="container my-4">
        <form enctype="multipart/form-data" method="post" action="<?= route_to("object.galleries.create") ?>">

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="title">Title (EN)</label>
                        <input type="text" name="title" id="title" class="form-control"
                               placeholder="Title" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label for="title_id">Judul (ID)</label>
                        <input type="text" name="title_id" id="title_id" class="form-control"
                               placeholder="Judul">
                    </div>
                </div>
            </div>
            <div class="w-100 text-center">
                <button type="submit" class="btn btn-sm btn-primary mx-auto">
                    Simpan
                </button>
            </div>
        </form>
    </div>
<?= $this->endSection(); ?>