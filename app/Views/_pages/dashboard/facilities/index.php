<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>
<div class="container my-3">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <?= summon_image_field("FACILITY", "FACILITY_HERO_BG") ?>
                </div>
                <div class="col-6">
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "Judul",
                                    "id" => "FACILITY_HERO_TITLE",
                                ],
                                [
                                    "type" => "LinesField",
                                    "label" => "Subjudul",
                                    "id" => "FACILITY_HERO_SUBTITLE",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="card shadow">
            <div class="card-header">
                <div class="card-title">
                    Facilities
                </div>
                <div class="card-toolkit">
                    <a class="btn btn-outline-success btn-sm" href="<?= route_to("dashboard.facilities.create") ?>">
                        Create New
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="article_table" data-ordering="false">
                        <thead>
                        <tr>
                            <th style="width: 1px">No</th>
                            <th class="text-nowrap">Tampilan Homepage</th>
                            <th class="text-nowrap">Tampilan Fasilitas</th>
                            <th class="text-nowrap">Edit</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($facilities as $index => $facility): ?>
                            <tr>
                                <td style="vertical-align: center"><?= $index + 1 ?></td>
                                <td style="vertical-align: center">
                                    <?php if ($facility->isShownOnHomepage): ?>
                                        <img width="150" height="150" alt="thumbnail"
                                             style="object-position: center; object-fit: cover;"
                                             src="<?= $facility->thumbnailUrl ?>"/>
                                        <p class="text-danger mb-0 mt-1 marcellus"><?= $facility->label ?></p>
                                        <p class="text-decoration-underline lh-2 fs-5 marcellus"><?= $facility->title ?></p>
                                    <?php else: ?>
                                        Tidak tampil di homepage
                                    <?php endif ?>
                                </td>
                                <td style="vertical-align: center">
                                    <div class="position-relative bg-primary w-100"
                                         style="max-width: 600px; aspect-ratio: 2 / 1">
                                        <img alt="cover" class="w-100 h-100"
                                             style="object-fit: cover; object-position: center"
                                             src="<?= $facility->imgUrl ?>"/>
                                        <div class="position-absolute marcellus top-50 start-50 translate-middle text-center lh-sm <?= $facility->isWhiteText ? 'text-white' : '' ?>">
                                            <p class="mb-0 text-uppercase h1"><?= $facility->label ?></p>
                                            <small><?= $facility->description ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: center" class="text-center">
                                    <a class="btn btn-outline-warning btn-sm"
                                       href="<?= route_to("dashboard.facilities.update", $facility->id) ?>">
                                        Edit
                                    </a>
                                </td>
                                <td style="vertical-align: center" class="text-center">
                                    <form action="<?= route_to("object.facilities.delete", $facility->id) ?>"
                                          method="post">
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmBeforeSubmit(
                                            this,
                                            'Hapus Fasilitas?',
                                            'Fasilitas yang telah dihapus tidak dapat dikembalikan'
                                        )">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section("javascript") ?>
<script>
    new DataTable('#article_table');
</script>
<?= $this->endSection(); ?>
