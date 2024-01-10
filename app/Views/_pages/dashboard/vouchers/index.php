<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>
<div class="container">
    <section>
        <div class="card shadow">
            <div class="card-header">
                <div class="card-title">
                    Vouchers
                </div>
                <div class="card-toolkit">
                    <a class="btn btn-outline-success btn-sm" href="<?= route_to("dashboard.vouchers.create") ?>">
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
                            <th class="text-nowrap">Code</th>
                            <th class="text-nowrap">Nominal Potongan</th>
                            <th class="text-nowrap">Deskripsi</th>
                            <th class="text-center" width="1">Edit</th>
                            <th class="text-center" width="1">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($vouchers as $index => $voucher): ?>
                            <tr>
                                <td style="vertical-align: center"><?= $index + 1 ?></td>
                                <td style="vertical-align: center">
                                    <?= $voucher->code ?>
                                </td>
                                <td style="vertical-align: center">
                                    <?= $voucher->price_reduction ?>
                                </td>
                                <td style="vertical-align: center">
                                    <?= $voucher->description ?>
                                </td>
                                <td style="vertical-align: center" class="text-center">
                                    <a class="btn btn-outline-warning btn-sm"
                                       href="<?= route_to("dashboard.vouchers.update", $voucher->code) ?>">
                                        Edit
                                    </a>
                                </td>
                                <td style="vertical-align: center" class="text-center">
                                    <form action="<?= route_to("object.vouchers.delete", $voucher->code) ?>"
                                          method="post">
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmBeforeSubmit(
                                            this,
                                            'Hapus Voucher?',
                                            'Voucher yang telah dihapus tidak dapat dikembalikan'
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
