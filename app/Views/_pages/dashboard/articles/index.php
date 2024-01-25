<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<?= view("_components/HeroEditor", [
    "field_bg" => "ARTICLE_HERO_BG",
    "field_title" => "ARTICLE_HERO_TITLE",
    "field_subtitle" => "ARTICLE_HERO_SUBTITLE",
]) ?>

<div class="container mb-3">
    <div class="w-100 text-end mb-3">
        <a class="btn btn-outline-success btn-sm" href="<?= route_to("dashboard.articles.create") ?>">
            Create New
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover" id="article_table">
            <thead>
            <tr>
                <th style="width: 1px">No</th>
                <th class="w-100">

                    <?php if (session()->get("LANG") == "EN_"): ?>
                        Title
                    <?php else: ?>
                        Judul
                    <?php endif ?>
                </th>
                <th class="text-nowrap">

                    <?php if (session()->get("LANG") == "EN_"): ?>
                        Published At
                    <?php else: ?>
                        Tanggal Publikasi
                    <?php endif ?>
                </th>
                <th class="text-nowrap">
                    <?php if (session()->get("LANG") == "EN_"): ?>
                        Updated At
                    <?php else: ?>
                        Terakhir Diupdate
                    <?php endif ?>
                </th>
                <th class="text-center" width="1" data-sortable="false"></th>
                <th class="text-center" width="1" data-sortable="false"></th>
                <th class="text-center" width="1" data-sortable="false">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($articles as $index => $article): ?>
                <tr>
                    <td style="vertical-align: center"><?= $index + 1 ?></td>
                    <td style="vertical-align: center">
                        <small class="fw-bold">EN</small> <?= $article->title ?><br>

                        <small class="fw-bold">ID</small> <?= $article->title_id ?: $article->title ?>
                    </td>
                    <td style="vertical-align: center">
                        <?= $article->created_at ?>
                    </td>
                    <td style="vertical-align: center">
                        <?= $article->updated_at ?>
                    </td>
                    <td style="vertical-align: center" class="text-center">
                    </td>
                    <td style="vertical-align: center" class="text-center">
                        <a class="btn btn-outline-primary btn-sm text-nowrap w-100 text-start"
                           href="<?= route_to("dashboard.articles.update", $article->slug) ?>?lang=en">
                            <i class="bi bi-pen me-1"></i> English
                        </a>
                        <a class="btn btn-outline-primary btn-sm text-nowrap w-100 text-start mb-1"
                           href="<?= route_to("dashboard.articles.update", $article->slug) ?>?lang=id">
                            <i class="bi bi-pen me-1"></i> Indonesia
                        </a>
                    </td>
                    <td style="vertical-align: center" class="text-center">
                        <form action="<?= route_to("object.articles.delete", $article->slug) ?>"
                              method="post">
                            <button type="submit" class="btn btn-outline-danger btn-sm">
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
