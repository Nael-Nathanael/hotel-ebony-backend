<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>
<div class="container py-2">
    <div class="card shadow-sm mb-3">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="m-0">Room Facility Option</h6>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                Create New
            </button>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <?php foreach ($options as $facility_option): ?>
                    <div class="col-3">
                        <div class="card shadow-sm p-2 position-relative">
                            <div class="position-absolute top-0 start-100 translate-middle">
                                <form action="<?= route_to("object.room-facilities.delete", $facility_option->slug) ?>"
                                      method="post">
                                    <button type="button"
                                            class="btn btn-danger btn-sm p-0 d-flex justify-content-center align-items-center rounded-circle"
                                            style="width: 20px; height: 20px" onclick="confirmBeforeSubmit(
                                            this,
                                            'Hapus Fasilitas?',
                                            'Fasilitas yang telah dihapus tidak dapat dikembalikan'
                                        )">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="align-items-center d-flex position-relative">
                                <img src="<?= $facility_option->icon ?? PLACEHOLDER_IMG ?>" width="40" height="40"
                                     onclick="document.getElementById('<?= $facility_option->slug . "_icon" ?>').click()"
                                     style="cursor: pointer; object-fit: contain" class="me-3"
                                     alt="<?= $facility_option->name ?>"
                                >

                                <form action="<?= route_to('object.room-facilities.updateImg', $facility_option->slug) ?>"
                                      method="post"
                                      id="<?= $facility_option->slug . "_form" ?>" enctype="multipart/form-data">
                                    <input class="d-none" id="<?= $facility_option->slug . "_icon" ?>"
                                           name="icon"
                                           onchange="document.getElementById('<?= $facility_option->slug . "_form" ?>').submit()"
                                           type="file">
                                </form>

                                <input type="text" class="form-control form-control-sm"
                                       value="<?= $facility_option->name ?>"
                                       name="<?= $facility_option->slug ?>"
                                       id="<?= $facility_option->slug ?>"
                                       onkeyup="updateOptionName(this)">

                                <label for="<?= $facility_option->slug ?>"
                                       class="small position-absolute end-0 top-50 translate-middle-y me-2"></label>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="post" enctype="multipart/form-data" action="<?= route_to("object.room-facilities.create") ?>"
              class="modal-content">
            <div class="modal-body card">
                <div class="align-items-center d-flex position-relative">
                    <img src="<?= PLACEHOLDER_IMG ?>" width="40" height="40"
                         style="cursor: pointer; object-fit: contain"
                         class="me-3 preview_createImg"
                         onclick="document.getElementById('createImg').click()"
                    >

                    <input type="file" name="icon" class="d-none" id="createImg">

                    <input type="text" class="form-control form-control-sm"
                           name="name" placeholder="Nama Fasilitas" required>
                </div>
            </div>
            <div class="modal-footer border-0 text-center">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>


<?= $this->section("javascript"); ?>
<script>
    function updateOptionName(element) {
        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                slug: element.name,
                name: element.value
            })
        };

        fetch("<?= route_to("object.room-facilities.update") ?>", requestOptions)
            .then(_ => {
                const saved = "<span class='text-success fw-bolder'> (auto-saved)</span>"
                const label = $(`label[for="${element.name}"]`);
                if (label.children("span").length === 0) {
                    label.append(saved)
                    setTimeout(function () {
                        label.children("span").remove()
                    }, 2000);
                }
            })
            .catch(error => {
                console.error(error)
            });
    }

    bindInputImageToPreview('createImg')
</script>
<?= $this->endSection(); ?>
