<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>
<div class="container">
    <section>
        <div class="card shadow">
            <div class="card-header">
                <div class="card-title">
                    Galleries
                </div>
                <div class="card-toolkit">
                    <a class="btn btn-outline-success btn-sm" href="<?= route_to("dashboard.galleries.create") ?>">
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
                            <th class="text-nowrap w-100">Judul Album</th>
                            <th class="text-nowrap text-center" data-sortable="false">Manage Photo</th>
                            <th class="text-nowrap text-center" data-sortable="false">Edit</th>
                            <th class="text-center text-center" data-sortable="false">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($galleries as $index => $gallery): ?>
                            <tr>
                                <td style="vertical-align: center"><?= $index + 1 ?></td>
                                <td style="vertical-align: center">
                                    <?= $gallery->title ?>
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
        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section("javascript") ?>
<script>
    new DataTable('#article_table');
</script>
<?= $this->endSection(); ?>
