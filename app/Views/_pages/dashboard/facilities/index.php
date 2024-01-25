<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<?= view("_components/HeroEditor", [
    "field_bg" => "FACILITY_HERO_BG",
    "field_title" => "FACILITY_HERO_TITLE",
    "field_subtitle" => "FACILITY_HERO_SUBTITLE",
]) ?>

<div class="container mb-5">
    <div class="w-100 text-end mb-4">
        <a class="btn btn-outline-success btn-sm" href="<?= route_to("dashboard.facilities.create") ?>">
            Create New
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover" id="article_table" data-ordering="false">
            <thead>
            <tr>
                <th style="width: 1px">No</th>
                <th class="text-nowrap">
                    <?php if (session()->get("LANG") == "EN_"): ?>
                        Homepage View
                    <?php else: ?>
                        Tampilan Beranda
                    <?php endif ?>
                </th>
                <th class="text-nowrap">
                    <?php if (session()->get("LANG") == "EN_"): ?>
                        Facility Menu View
                    <?php else: ?>
                        Tampilan Menu Fasilitas
                    <?php endif ?>
                </th>
                <th class="text-center" width="1">Edit</th>
                <th class="text-center" width="1">Delete</th>
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
                            <p class="text-danger mb-0 mt-1 marcellus">
                                <?php if (session()->get("LANG") == "EN_"): ?>
                                    <?= $facility->label ?>
                                <?php else: ?>
                                    <?= $facility->label_id ?: $facility->label ?>
                                <?php endif ?>
                            </p>
                            <p class="text-decoration-underline lh-2 fs-5 marcellus">
                                <?php if (session()->get("LANG") == "EN_"): ?>
                                    <?= $facility->title ?>
                                <?php else: ?>
                                    <?= $facility->title_id ?: $facility->title ?>
                                <?php endif ?>
                            </p>
                        <?php else: ?>
                            <?php if (session()->get("LANG") == "EN_"): ?>
                                Not shown in homepage
                            <?php else: ?>
                                Tidak tampil di homepage
                            <?php endif ?>
                        <?php endif ?>
                    </td>
                    <td style="vertical-align: center">
                        <div class="position-relative bg-primary w-100"
                             style="max-width: 600px; aspect-ratio: 2 / 1">
                            <img alt="cover" class="w-100 h-100"
                                 style="object-fit: cover; object-position: center"
                                 src="<?= $facility->imgUrl ?>"/>
                            <div class="position-absolute marcellus top-50 start-50 translate-middle text-center lh-sm <?= $facility->isWhiteText ? 'text-white' : '' ?>">
                                <p class="mb-0 text-uppercase h1">
                                    <?php if (session()->get("LANG") == "EN_"): ?>
                                        <?= $facility->label ?>
                                    <?php else: ?>
                                        <?= $facility->label_id ?: $facility->label ?>
                                    <?php endif ?>
                                </p>
                                <small>
                                    <?php if (session()->get("LANG") == "EN_"): ?>
                                        <?= $facility->description ?>
                                    <?php else: ?>
                                        <?= $facility->description_id ?: $facility->description ?>
                                    <?php endif ?>
                                </small>
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
<?= $this->endSection(); ?>

<?= $this->section("javascript") ?>
<script>
    new DataTable('#article_table');
</script>
<?= $this->endSection(); ?>
