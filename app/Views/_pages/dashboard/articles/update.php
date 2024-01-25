<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("head"); ?>
<style>
    .material-form-control {
        border-right: 0;
        border-radius: 0;
        border-left: 0;
        border-top: 0;
        padding-left: 0 !important;
        padding-right: 0 !important;
        padding-bottom: 0 !important;
    }

    .form-floating > label {
        padding-left: 0;
    }

    .material-form-control:focus {
        outline: none;
        border-color: black;
        box-shadow: none;
    }

    .ck-toolbar {
        border: none !important;
        background-color: transparent !important;
        padding: 0 !important;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
<?= view("_components/PageHero", [
    "breadcrumbs" => [
        "Articles" => route_to("dashboard.articles.index"),
        "Update Article (" . ($_GET['lang'] == 'id' ? 'Bahasa Indonesia' : 'English Language') . ")"
    ],
    "fluid" => true,
]); ?>

<div class="container-fluid">
    <form action="<?= route_to("object.articles.update", $article->slug) ?>?lang=<?= $_GET['lang'] ?>" method="post"
          id="articleForm"
          enctype="multipart/form-data">
        <input type="hidden" name="content<?= $_GET['lang'] == 'id' ? '_id' : '' ?>" id="content">

        <div class="row" style="min-height: 600px">
            <div class="col-lg-9 border-end">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control material-form-control" id="title"
                           name="title<?= $_GET['lang'] == 'id' ? '_id' : '' ?>"
                           placeholder="title"
                           value="<?= $_GET['lang'] == 'id' ? ($article->title_id ?: $article->title) : $article->title ?>"
                           required>
                    <label for="title"><?= $_GET['lang'] == 'id' ? 'Judul (ID)' : 'Title (EN)' ?></label>
                </div>
                <div class="row mb-3">
                    <div class="document-editor__toolbar border-0"></div>
                </div>
                <div class="container bg-light py-4">
                    <div class="editor border shadow-none bg-white" style="min-height: 700px">
                        <?= $_GET['lang'] == 'id' ? ($article->content_id ?: $article->content) : $article->content ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 d-flex align-items-end flex-column">
                <div class="my-2">
                    <button type="submit" class="btn btn-outline-primary">
                        Publish
                    </button>
                </div>
                <hr/>
                <div class="w-100">
                    <div class="card shadow-sm mb-2">
                        <div class="card-header">
                            Post Settings
                        </div>
                        <div class="card-body">
                            <img src="<?= $article->imgUrl ?>" class="w-100 shadow-sm border" alt="oldCoverImage"
                                 style="height: 100px; object-fit: cover">
                            <div class="form-group mb-3">
                                <label for="coverImage">Cover Image</label>
                                <input type="file" name="coverImage" id="coverImage" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="short_description"><?= $_GET['lang'] == 'id' ? 'Deskripsi Singkat (ID)' : 'Short Description (EN)' ?></label>
                                <textarea required id="short_description"
                                          name="short_description<?= $_GET['lang'] == 'id' ? '_id' : '' ?>"
                                          class="form-control"
                                          rows="5"><?= $_GET['lang'] == 'id' ? ($article->short_description_id ?: $article->short_description) : $article->short_description ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-2">
                        <div class="card-header">
                            Advance Settings
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="keywords">Keywords <?= $_GET['lang'] == 'id' ? '(ID)' : '(EN)' ?></label>
                                <input type="text" name="keywords<?= $_GET['lang'] == 'id' ? '_id' : '' ?>"
                                       id="keywords" class="form-control"
                                       placeholder="Keywords"
                                       value="<?= $_GET['lang'] == 'id' ? ($article->keywords_id ?: $article->keywords) : $article->keywords ?>"
                                       required>
                            </div>


                            <div class="form-group mb-3">
                                <label for="meta_title">Meta Title <?= $_GET['lang'] == 'id' ? '(ID)' : '(EN)' ?></label>
                                <input type="text" name="meta_title<?= $_GET['lang'] == 'id' ? '_id' : '' ?>"
                                       id="meta_title" class="form-control"
                                       placeholder="Meta Title"
                                       value="<?= $_GET['lang'] == 'id' ? ($article->meta_title_id ?: $article->meta_title) : $article->meta_title ?>"
                                       required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="meta_description">Meta Description <?= $_GET['lang'] == 'id' ? '(ID)' : '(EN)' ?></label>
                                <textarea required id="meta_description"
                                          name="meta_description<?= $_GET['lang'] == 'id' ? '_id' : '' ?>"
                                          class="form-control"
                                          rows="5"><?= $_GET['lang'] == 'id' ? ($article->meta_description_id ?: $article->meta_description) : $article->meta_description ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection(); ?>

<?= $this->section("javascript") ?>

<script>
    DecoupledDocumentEditor
        .create(document.querySelector('.editor'), {
            extraPlugins: [MyCustomUploadAdapterPlugin],
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'fontSize',
                    'fontFamily',
                    '|',
                    'fontColor',
                    'fontBackgroundColor',
                    '|',
                    'bold',
                    'italic',
                    'underline',
                    'strikethrough',
                    '|',
                    'alignment',
                    '|',
                    'numberedList',
                    'bulletedList',
                    '|',
                    'outdent',
                    'indent',
                    '|',
                    'todoList',
                    'link',
                    'blockQuote',
                    'imageUpload',
                    'insertTable',
                    'mediaEmbed',
                    '|',
                    'undo',
                    'redo',
                    'imageInsert'
                ]
            },
            language: 'en',
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:inline',
                    'imageStyle:block',
                    'imageStyle:side'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells',
                    'tableCellProperties',
                    'tableProperties'
                ]
            },
            licenseKey: '',
        })
        .then(editor => {
            window.editor = editor;

            editor.model.document.on('change', () => {
                document.getElementById("content").value = editor.getData();
            });

            // Set a custom container for the toolbar.
            document.querySelector('.document-editor__toolbar').appendChild(editor.ui.view.toolbar.element);
            document.querySelector('.ck-toolbar').classList.add('ck-reset_all');
        })

    document.getElementById("content").value = `<?= $article->content ?>`

    function changeCarousel() {
        document.getElementById("existing-carousel").classList.add("d-none")
        document.getElementById("new-carousel").classList.remove("d-none")
        document.getElementById("carousel-changed").value = 1
    }

    function unchangeCarousel() {
        document.getElementById("existing-carousel").classList.remove("d-none")
        document.getElementById("new-carousel").classList.add("d-none")
        document.getElementById("carousel-changed").value = 0
    }

    function addCarouselInput() {
        const newElement = document.createElement("div")
        newElement.innerHTML = `
        <div class="d-flex mb-2">
            <div class="input-group me-2">
                <input type="file" name="carousel[]" class="form-control form-control-sm">
            </div>

            <button type="button" class="btn-outline-danger btn btn-sm p-0"
                    onclick="this.parentNode.remove()" style="width: 35px">
                -
            </button>
        </div>
        `
        document.getElementById("carousel-inputs").appendChild(newElement)
    }
</script>
<?= $this->endSection(); ?>
