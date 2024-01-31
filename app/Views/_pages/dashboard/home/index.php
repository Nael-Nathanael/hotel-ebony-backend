<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<?= view("_components/HeroEditor", [
    "field_bg" => "HOME_HERO_BG",
    "field_title" => "HOME_HERO_TITLE",
    "field_subtitle" => "HOME_HERO_SUBTITLE",
]) ?>

<div class="container py-4">
    <section class="py-4">
        <div class="row">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <div class="col">
                    <?php $highlight = call("HOME_ARTICLE_HIGHLIGHT_$i", False) ?>
                    <?php if ($highlight): ?>
                        <?php
                        $article_candidates = array_filter($articles, function ($e) use ($highlight) {
                            return $e->slug == $highlight;
                        });
                        $article = reset($article_candidates)
                        ?>
                        <div
                                class="p-2 position-relative text-center w-100 d-flex justify-content-center align-items-end font-josefin-sans h4 mb-0 text-white"
                                style="aspect-ratio: 16 / 9; background-size: contain; background-image: url('<?= $article->imgUrl ?>');"
                        >
                            <div class="w-100 h-100 top-0 start-0 position-absolute"
                                 style="background-image: linear-gradient(to top, #000 0%, transparent 80%)"></div>

                            <button
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#selectArticleModal"
                                    class="top-0 end-0 m-2 btn btn-sm btn-primary position-absolute"
                                    onclick="
                                            for (let element of document.getElementsByClassName('changeArticleHighlightButton')) {
                                            element.setAttribute('name', '<?= "HOME_ARTICLE_HIGHLIGHT_$i" ?>')
                                            }"
                            >
                                <i class="bi bi-pen"></i> Edit
                            </button>

                            <span class="position-relative">
                                <?= session()->get("LANG") ? $article->title : $article->title_id ?: $article->title ?>
                            </span>
                        </div>
                    <?php else: ?>
                        <button
                                type="button"
                                class="btn btn-outline-primary w-100 d-flex justify-content-center align-items-center"
                                style="aspect-ratio: 16 / 9;"
                                data-bs-toggle="modal"
                                data-bs-target="#selectArticleModal"
                                onclick="for (let element of document.getElementsByClassName('changeArticleHighlightButton')) {
                                        element.setAttribute('name', '<?= "HOME_ARTICLE_HIGHLIGHT_$i" ?>')
                                        }"
                        >
                            Select Article Highlight <?= $i ?>
                        </button>
                    <?php endif ?>
                </div>
            <?php endfor ?>
        </div>
    </section>
    <section class="py-4">
        <div class="row g-5 align-items-center">
            <div class="col-6">
                <div class="h2 font-marcellus mb-4">
                    <?= summon_editable_div("(Judul)", "HOME_HEADER_TITLE") ?>
                </div>
                <div>
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "CKEDITOR",
                                    "label" => "",
                                    "id" => "HOME_HEADER_SUBTITLE",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
            </div>
            <div class="col-6">
                <?= summon_image_field("HOME", "HOME_HEADER_IMG") ?>
            </div>
        </div>
    </section>

    <section class="py-4">
        <div class="h2 font-marcellus mb-4 d-flex justify-content-center align-items-center">
            <?= summon_editable_div("(Our Facility)", "HOME_FACILITY_TITLE") ?>
        </div>

        <div class="row">
            <?php for ($i = 1; $i <= 2; $i++): ?>
                <div class="col-6">
                    <div class="position-relative">
                        <img alt="HOME_CAROUSEL_IMG_<?= $i ?>"
                             src="<?= call("HOME_CAROUSEL_IMG_$i", PLACEHOLDER_IMG) ?>"
                             class="w-100" style="aspect-ratio: 16 / 9"/>

                        <div class="position-absolute top-0 end-0 m-2">
                            <?= summon_image_button("HOME_CAROUSEL_IMG_$i") ?>
                        </div>

                        <div class="position-absolute top-0 start-0 w-100 h-100 p-2 d-flex flex-column justify-content-between">
                            <div>
                                <div class="h3 font-marcellus mb-4">
                                    <?= summon_editable_div("(Title)", "HOME_CAROUSEL_TITLE_$i") ?>
                                </div>
                                <div style="text-align: justify" class="w-50 font-josefin-sans">
                                    <?= summon_editable_div("(Description)", "HOME_CAROUSEL_DESCRIPTION_$i") ?>
                                </div>
                            </div>

                            <div style="text-align: justify; width: fit-content"
                                 class="font-josefin-sans mt-auto border px-3 py-1 pt-2 border-dark">
                                <?= summon_editable_div("(Button Text)", "HOME_CAROUSEL_BUTTON_TEXT_$i") ?>
                            </div>
                        </div>
                    </div>
                    <?= view("_components/LinesFieldGroup",
                        [
                            "fields" => [
                                [
                                    "type" => "LinesField",
                                    "label" => "URL Tombol",
                                    "id" => "HOME_CAROUSEL_BUTTON_URL_$i",
                                ],
                            ]
                        ]
                    ) ?>
                </div>
            <?php endfor ?>
        </div>
    </section>


    <section class="py-4">
        <div class="h2 font-marcellus mb-4 d-flex justify-content-center align-items-center">
            <?= summon_editable_div("(Rooms & Suites)", "HOME_ROOMS_TITLE") ?>
        </div>

        <a
                href="<?= route_to("dashboard.rooms.index") ?>"
                class="btn btn-outline-primary w-100 d-flex justify-content-center align-items-center"
                style="min-height: 200px">
            Manage Rooms & Suites
        </a>

        <div class="h6 font-josefin-sans mt-4 text-decoration-underline d-flex justify-content-center align-items-center">
            <?= summon_editable_div("(View All Rooms)", "HOME_ROOMS_ALL") ?>
        </div>
    </section>
</div>


<div class="modal fade" id="selectArticleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg small">
        <div class="modal-content">
            <div class="modal-header">
                Choose Article
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td>
                                <div>
                                    <b class="me-2">EN: </b><?= $article->title ?>
                                </div>
                                <div>
                                    <b class="me-2">ID: </b><?= $article->title_id ?>
                                </div>
                            </td>
                            <td width="1" style="vertical-align: middle">
                                <form action="<?= route_to("object.lines.update", "HOME") ?>" method="post">
                                    <button name="" value="<?= $article->slug ?>"
                                            class="btn btn-sm btn-outline-primary changeArticleHighlightButton"
                                            type="submit">
                                        Choose
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer border-0 text-center">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close
                </button>
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

