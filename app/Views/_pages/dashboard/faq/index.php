<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>
    <div class="container my-2">
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <div class="card-title">
                    FAQs
                </div>
                <div class="card-toolkit">
                    <a class="btn btn-outline-success btn-sm" href="<?= route_to("dashboard.faq.create") ?>">
                        Create New
                    </a>
                </div>
            </div>
            <?php $faq_model = model("FaqModel") ?>
            <?php $faqs = $faq_model
                ->orderBy("number ASC, created_at DESC")
                ->findAll() ?>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="1">No</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th width="1">Edit</th>
                        <th width="1">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($faqs as $key => $value): ?>
                        <tr>
                            <td><?= $value->number ? "$value->number." : "" ?></td>
                            <td><?= $value->q ?></td>
                            <td><?= $value->a ?></td>
                            <td style="vertical-align: center" class="text-center">
                                <a class="btn btn-outline-warning btn-sm"
                                   href="<?= route_to("dashboard.faq.update", $value->id) ?>">
                                    Edit
                                </a>
                            </td>
                            <td style="vertical-align: center" class="text-center">
                                <form action="<?= route_to("object.faq.delete", $value->id) ?>"
                                      method="post">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>