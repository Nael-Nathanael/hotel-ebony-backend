<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("head"); ?>
    <style>
        label {
            font-size: 14px;
        }
    </style>
<?= $this->endsection(); ?>

<?= $this->section("content"); ?>
<?= view("_components/PageHero", [
    "breadcrumbs" => [
        "Facilities" => route_to("dashboard.facilities.index"),
        "Update Facility"
    ]
]); ?>

    <div class="container mb-4">
        <form enctype="multipart/form-data" method="post"
              action="<?= route_to("object.facilities.update", $facility->id) ?>">

            <div class="position-relative p-4 mt-3 mb-5">
                <div class="row align-items-center gx-3 gy-1">
                    <div class="col-12 text-center">
                        <h5>Bahasa Inggris</h5>
                    </div>
                    <div class="col-3 text-end font-marcellus text-secondary">
                        <div class="d-flex align-items-end flex-column justify-content-center mb-3">
                            <input type="text" name="label" id="label"
                                   class="fs-4 text-uppercase text-end form-control py-0"
                                   placeholder="Input Label" value="<?= $facility->label ?>" required
                                   style="outline: none !important;">
                            <label for="label" class="mb-0">Label</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <img alt="cover" class="preview_img w-100"
                             style="object-fit: cover; aspect-ratio: 16 / 9; object-position: center"
                             src="<?= $facility->imgUrl ?>"
                        />
                    </div>
                    <div class="col-3 font-marcellus">
                        <div class="d-flex flex-column gap-4">
                            <h3 class="mb-0 text-uppercase h1 preview_label">Label</h3>

                            <div class="form-group">
                                <textarea type="text" name="description" id="description"
                                          class="form-control form-control-sm"
                                          placeholder="Description" rows="7"><?= $facility->description ?></textarea>
                                <label for="description" class="text-secondary">Description (EN)</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 offset-3">
                        <label for="img">
                            *Gambar dapat diubah via menu "Edit Daftar Gambar" di halaman "Daftar Fasilitas" <br/>
                            *Gambar akan sama untuk tampilan bahasa inggris dan bahasa indonesia <br>
                            *Ukuran gambar yang direkomendasikan: 1920 x 1080 (Dimensi 16 / 9)
                        </label>
                    </div>
                </div>
            </div>

            <div class="position-relative p-4 mt-3">
                <div class="row align-items-center gx-3 gy-1">

                    <div class="col-12 text-center">
                        <h5>Bahasa Indonesia</h5>
                    </div>

                    <div class="col-3 text-end font-marcellus text-secondary">

                        <div class="d-flex align-items-end flex-column justify-content-center">
                            <input type="text" name="label_id" id="label_id"
                                   class="fs-4 text-uppercase text-end form-control py-0"
                                   placeholder="Input Label for ID" value="<?= $facility->label_id ?>" required
                                   style="outline: none !important;">
                            <label for="label_id" class="mb-0">Label (ID)</label>
                        </div>

                    </div>
                    <div class="col-6">
                        <img alt="cover" class="preview_img w-100"
                             style="object-fit: cover; aspect-ratio: 16 / 9; object-position: center"
                             src="<?= $facility->imgUrl ?>"
                        />
                    </div>
                    <div class="col-3 font-marcellus">
                        <div class="d-flex flex-column gap-4">
                            <h3 class="mb-0 text-uppercase h1 preview_label_id">Label</h3>

                            <div class="form-group mb-3">
                                <textarea type="text" name="description_id" id="description_id"
                                          class="form-control form-control-sm"
                                          placeholder="Deskripsi" rows="7"><?= $facility->description_id ?></textarea>
                                <label for="description_id" class="text-secondary">Deskripsi (ID)</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="isShownOnHomepage">Tampilkan di Homepage</label>
                <select name="isShownOnHomepage" id="isShownOnHomepage" required
                        class="form-select-sm form-select">
                    <option value="1" <?= $facility->isShownOnHomepage ? "selected" : "" ?>>Tampil</option>
                    <option value="0" <?= $facility->isShownOnHomepage ? "" : "selected" ?>>Tidak Tampil</option>
                </select>
            </div>

            <div class="row g-5 mb-3">
                <div class="col-6 preview_isShownOnHomepage">
                    <div style="width: fit-content">
                        <h6>Homepage View (EN)</h6>

                        <img width="350" alt="thumbnail"
                             class="preview_thumbnailImg"
                             style="object-fit: cover; object-position: center; aspect-ratio: 1 / 1"
                             src="<?= $facility->thumbnailUrl ?>"/>
                        <input type="file" name="thumbnailImg" id="thumbnailImg"
                               class="form-control form-control-sm mb-0">

                        <small class="d-block text-secondary" style="font-size: 10px">
                            *Gambar akan sama untuk tampilan bahasa inggris dan bahasa indonesia <br>
                            *Ukuran gambar yang direkomendasikan: 1080 x 1080 (Dimensi 1 / 1)
                        </small>

                        <p class="text-danger mb-0 mt-1 marcellus preview_label">
                            Label</p>

                        <div class="mb-0 text-decoration-underline lh-2 fs-5 marcellus">
                            <input type="text" name="title" id="title" class="form-control"
                                   placeholder="Edit Title (EN)" value="<?= $facility->title ?>"
                                   style="outline: none !important">
                            <label for="title" class="d-none">Edit Title (EN)</label>
                        </div>
                    </div>
                </div>
                <div class="col-6 preview_isShownOnHomepage">
                    <div style="width: fit-content">
                        <h6>Tampilan Beranda (ID)</h6>

                        <img width="350" alt="thumbnail"
                             class="preview_thumbnailImg"
                             style="object-fit: cover; object-position: center; aspect-ratio: 1 / 1"
                             src="<?= $facility->thumbnailUrl ?>"/>

                        <p class="text-danger mb-0 mt-1 marcellus preview_label_id">
                            Label</p>

                        <div class="mb-0 text-decoration-underline lh-2 fs-5 marcellus">
                            <input type="text" name="title_id" id="title_id"
                                   class="form-control" value="<?= $facility->title_id ?>"
                                   placeholder="Edit Judul" style="outline: none !important">
                            <label for="title_id" class="d-none">Edit Judul (ID)</label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <h6>Full View (EN)</h6>

                    <input type="hidden" name="content" id="content">
                    <div class="document-editor__toolbar border-0"></div>
                    <div class="editor border shadow-none bg-white" style="min-height: 500px">
                        <?= $facility->content ?>
                    </div>
                </div>
                <div class="col-6">
                    <h6>Tampilan Penuh (ID)</h6>

                    <input type="hidden" name="content_id" id="content_id">
                    <div class="document-editor__toolbar_id border-0"></div>
                    <div class="editor_id border shadow-none bg-white" style="min-height: 500px">
                        <?= $facility->content_id ?>
                    </div>
                </div>
            </div>

            <div class="w-100 mt-5 text-center">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </form>
    </div>
<?= $this->endSection(); ?>

<?= $this->section('javascript') ?>
    <script>
        bindSelectToPreview("isWhiteText", (value) => {
            if (Number(value) === 0) {
                for (let element of document.getElementsByClassName('preview_isWhiteText')) {
                    element.classList.remove('text-white')
                    element.classList.add('text-dark')
                }
            } else {
                for (let element of document.getElementsByClassName('preview_isWhiteText')) {
                    element.classList.add('text-white')
                    element.classList.remove('text-dark')
                }
            }
        })

        bindSelectToPreview("isShownOnHomepage", (value) => {
            if (Number(value) === 0) {
                for (let element of document.getElementsByClassName('preview_isShownOnHomepage')) {
                    element.classList.add('d-none')
                }
                for (let element of document.getElementsByClassName('!preview_isShownOnHomepage')) {
                    element.classList.remove('d-none')
                }
            } else {
                for (let element of document.getElementsByClassName('preview_isShownOnHomepage')) {
                    element.classList.remove('d-none')
                }
                for (let element of document.getElementsByClassName('!preview_isShownOnHomepage')) {
                    element.classList.add('d-none')
                }
            }
        })

        bindInputToPreview("label")
        bindInputToPreview("title")
        bindInputToPreview("description")

        bindInputToPreview("label_id")
        bindInputToPreview("title_id")
        bindInputToPreview("description_id")

        bindInputImageToPreview("img")
        bindInputImageToPreview("thumbnailImg")

        document.getElementById("label").dispatchEvent(new Event('keyup'));
        document.getElementById("title").dispatchEvent(new Event('keyup'));
        document.getElementById("description").dispatchEvent(new Event('keyup'));

        document.getElementById("label_id").dispatchEvent(new Event('keyup'));
        document.getElementById("title_id").dispatchEvent(new Event('keyup'));
        document.getElementById("description_id").dispatchEvent(new Event('keyup'));

        document.getElementById("isShownOnHomepage").dispatchEvent(new Event('change'));
        document.getElementById("isWhiteText").dispatchEvent(new Event('change'));
    </script>

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
                editor.model.document.on('change', () => {
                    document.getElementById("content").value = editor.getData();
                });

                // Set a custom container for the toolbar.
                document.querySelector('.document-editor__toolbar').appendChild(editor.ui.view.toolbar.element);
                document.querySelector('.ck-toolbar').classList.add('ck-reset_all');
            })


        DecoupledDocumentEditor
            .create(document.querySelector('.editor_id'), {
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
                editor.model.document.on('change', () => {
                    document.getElementById("content_id").value = editor.getData();
                });

                // Set a custom container for the toolbar.
                document.querySelector('.document-editor__toolbar_id').appendChild(editor.ui.view.toolbar.element);
                document.querySelector('.ck-toolbar').classList.add('ck-reset_all');
            })


        document.getElementById("content").value = `<?= $facility->content ?>`
        document.getElementById("content_id").value = `<?= $facility->content_id ?>`
    </script>
<?= $this->endSection(); ?>