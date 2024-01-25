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
    <div class="table-responsive">
        <table class="table table-hover" id="article_table">
            <thead>
            <tr>
                <th style="width: 1px">No</th>
                <th class="text-nowrap">Album (EN)</th>
                <th class="text-nowrap w-100">Album (ID)</th>
                <th class="text-nowrap text-center">Manage Photo</th>
                <th class="text-nowrap text-center">Edit</th>
                <th class="text-center text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($galleries as $index => $gallery): ?>
                <tr>
                    <td style="vertical-align: center"><?= $index + 1 ?></td>
                    <td style="vertical-align: center" nowrap>
                        <?= $gallery->title ?>
                    </td>
                    <td style="vertical-align: center" nowrap>
                        <?= $gallery->title_id ?>
                    </td>
                    <td style="vertical-align: center" class="text-center">
                        <a class="btn btn-outline-primary btn-sm"
                           href="<?= route_to("dashboard.galleries.photos", $gallery->slug) ?>">
                            Photo
                        </a>
                    </td>
                    <td style="vertical-align: center" class="text-center">
                        <a class="btn btn-outline-warning btn-sm"
                           href="<?= route_to("dashboard.galleries.update", $gallery->slug) ?>">
                            Edit
                        </a>
                    </td>
                    <td style="vertical-align: center" class="text-center">
                        <form action="<?= route_to("object.galleries.delete", $gallery->slug) ?>"
                              method="post">
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmBeforeSubmit(
                                            this,
                                            'Hapus Album?',
                                            'Album yang telah dihapus tidak dapat dikembalikan'
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
    new DataTable('#article_table', {
        ordering: false
    });
</script>
<?= $this->endSection(); ?>
