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
        "Rooms" => route_to("dashboard.rooms.index"),
        "New Rooms"
    ],
    "help" => 'Foto-foto ruangan ditambahkan melalui menu "Edit Images" setelah room disimpan'
]); ?>
<div class="container my-4">
    <form enctype="multipart/form-data" method="post" action="<?= route_to("object.rooms.create") ?>">
        <div class="pb-3">
            <div class="row g-3 align-items-center">
                <div class="col-7">
                    <div class="w-100 d-flex justify-content-center align-items-center border"
                         style="aspect-ratio: 16 / 9">
                        {{ Room Images }}
                    </div>
                </div>
                <div class="col-5 font-josefin-sans lh-1 d-flex gap-3 flex-column">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group font-marcellus">
                                <label for="name">Room / Suites Name</label>
                                <input type="text" name="name" id="name" class="form-control lh-1"
                                       placeholder="Room / Suites Name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-select form-select-sm" required name="type" id="type">
                                    <option value="ROOM" selected>Room</option>
                                    <option value="SUITES">Suite</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="description">Description (EN)</label>
                                <textarea type="text" name="description" id="description"
                                          class="form-control"
                                          placeholder="Description" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="description_id">Deskripsi (ID)</label>
                                <textarea type="text" name="description_id" id="description_id"
                                          class="form-control"
                                          placeholder="Deskripsi" rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <div class="input-group input-group-sm">
                            <input type="number" name="capacity" id="capacity"
                                   class="form-control" style="width: fit-content"
                                   placeholder="2" value="2" required>
                            <span class="input-group-text">Guests</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="size">Room Size</label>
                        <div class="input-group input-group-sm">
                            <input type="number" step=".01" name="size" id="size"
                                   class="form-control"
                                   value="28" required>
                            <span class="input-group-text">m<sup>2</sup></span>
                        </div>
                    </div>

                    <div class="">
                        <label>Bedding Options</label>
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="input-group input-group-sm">
                                    <input type="number" name="king_bed_count" id="king_bed_count"
                                           class="form-control"
                                           value="1" min="0" required>
                                    <span class="input-group-text">King Bed(s)</span>
                                </div>
                            </div>
                            <div class="mx-2">
                                /
                            </div>
                            <div class="flex-grow-1">
                                <div class="input-group input-group-sm">
                                    <input type="number" name="queen_bed_count" id="queen_bed_count"
                                           class="form-control"
                                           value="0" min="0" required>
                                    <span class="input-group-text">Queen Bed(s)</span>
                                </div>
                            </div>
                            <div class="mx-2">
                                /
                            </div>
                            <div class="flex-grow-1">
                                <div class="input-group input-group-sm">
                                    <input type="number" name="twin_bed_count" id="twin_bed_count"
                                           class="form-control"
                                           value="0" min="0" required>
                                    <span class="input-group-text">Twin Bed(s)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">IDR </span>
                                    <input type="number" name="price" id="price" class="form-control pb-0"
                                           placeholder="Harga" required>
                                    <span class="input-group-text">/ night</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="min_alotment">Min Alotment</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" name="min_alotment" id="min_alotment" class="form-control pb-0"
                                           placeholder="2" value="2" required>
                                    <span class="input-group-text">Room</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pb-3">
            <h6>Room Facilities</h6>

            <div class="row g-2">
                <?php foreach ($facility_options as $facility_option): ?>
                    <div class="col-3">
                        <div class="card p-2">
                            <div class="form-check align-items-center d-flex gap-1">
                                <input class="form-check-input me-2" type="checkbox"
                                       value="<?= $facility_option->slug ?>"
                                       name="facility_option[]">

                                <img src="<?= $facility_option->icon ?>" width="25" height="25"
                                     style="object-fit: contain">

                                <small>
                                    <?= $facility_option->name ?>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="pb-3">
            <div class="row">
                <div class="col-6">
                    <h6>Room Terms and Conditions (EN)</h6>

                    <input type="hidden" name="tnc" id="tnc">
                    <div class="document-editor__toolbar border-0"></div>
                    <div class="editor border shadow-none bg-white" style="min-height: 150px">

                    </div>
                </div>
                <div class="col-6">
                    <h6>Room Terms and Conditions (ID)</h6>

                    <input type="hidden" name="tnc_id" id="tnc_id">
                    <div class="document-editor__toolbar_id border-0"></div>
                    <div class="editor_id border shadow-none bg-white" style="min-height: 150px">

                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>
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
                    'bold',
                    'italic',
                    'underline',
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
                document.getElementById("tnc").value = editor.getData();
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
                    'bold',
                    'italic',
                    'underline',
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
                document.getElementById("tnc_id").value = editor.getData();
            });

            // Set a custom container for the toolbar.
            document.querySelector('.document-editor__toolbar_id').appendChild(editor.ui.view.toolbar.element);
            document.querySelector('.ck-toolbar').classList.add('ck-reset_all');
        })
</script>
<?= $this->endSection(); ?>
