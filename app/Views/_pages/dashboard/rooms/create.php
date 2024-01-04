<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("head"); ?>
    <style>
        label {
            font-size: 14px;
        }
    </style>
<?= $this->endsection(); ?>

<?= $this->section("content"); ?>
    <div class="container my-4">
        <form enctype="multipart/form-data" method="post" action="<?= route_to("object.rooms.create") ?>"
              class="card">
            <div class="card-header">
                <h5 class="m-0">
                    Tambah Room
                </h5>
            </div>
            <div class="card-body">
                <div class="pb-3">
                    <h6>Data Room</h6>
                    <div class="row g-3">
                        <div class="col-9">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control form-control-sm"
                                       placeholder="Nama Room" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="type">Tipe</label>
                                <select class="form-select form-select-sm" required name="type" id="type">
                                    <option value="ROOM" selected>Room</option>
                                    <option value="SUITES">Suite</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea type="text" name="description" id="description"
                                          class="form-control form-control-sm"
                                          placeholder="Deskripsi" rows="7"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-2">
                                <label for="price">Harga per malam</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Rp. </span>
                                    <input type="number" name="price" id="price" class="form-control form-control-sm"
                                           placeholder="Harga" value="1000000" required>
                                    <span class="input-group-text">per night</span>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="capacity">Capacity</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" name="capacity" id="capacity"
                                           class="form-control form-control-sm"
                                           placeholder="Harga" value="2" required>
                                    <span class="input-group-text">Guest per Room</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="size">Luas</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" step=".01" name="size" id="size"
                                           class="form-control form-control-sm"
                                           value="28" required>
                                    <span class="input-group-text">m<sup>2</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-3">
                    <h6>Bedding Options</h6>

                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="input-group input-group-sm">
                                <input type="number" name="king_bed_count" id="king_bed_count"
                                       class="form-control form-control-sm"
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
                                       class="form-control form-control-sm"
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
                                       class="form-control form-control-sm"
                                       value="0" min="0" required>
                                <span class="input-group-text">Twin Bed(s)</span>
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

                                        <img src="<?= $facility_option->icon ?>" width="40" height="40"
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
            </div>
            <div class="card-footer border-0">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </form>
    </div>
<?= $this->endSection(); ?>