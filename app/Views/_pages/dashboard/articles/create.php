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
<div class="container-fluid">
    <section>
        <form action="<?= route_to("object.articles.create") ?>" method="post" id="articleForm"
              enctype="multipart/form-data">
            <input type="hidden" name="content" id="content">

            <div class="row" style="min-height: 600px">
                <div class="col-lg-9 border-end">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control material-form-control" id="title" name="title"
                               placeholder="title"
                               required>
                        <label for="title">Title</label>
                    </div>
                    <div class="row mb-3">
                        <div class="document-editor__toolbar border-0"></div>
                    </div>
                    <div class="container bg-light py-4">
                        <div class="editor border shadow-none bg-white" style="min-height: 700px">

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
                                <div class="form-group mb-3">
                                    <label for="coverImage">Cover Image</label>
                                    <input type="file" name="coverImage" id="coverImage" class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="short_description">Short Description</label>
                                    <textarea required id="short_description" name="short_description"
                                              class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-2">
                            <div class="card-header">
                                Advance Settings
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="keywords">Keywords</label>
                                    <input type="text" name="keywords" id="keywords" class="form-control"
                                           placeholder="Keywords" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" name="meta_title" id="meta_title" class="form-control"
                                           placeholder="Meta Title" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea required id="meta_description" name="meta_description"
                                              class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
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

</script>
<?= $this->endSection(); ?>
