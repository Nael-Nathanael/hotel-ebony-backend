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
        <form enctype="multipart/form-data" method="post" action="<?= route_to("object.rooms.update", $room->slug) ?>"
              class="card">
            <div class="card-header">
                <h5 class="m-0">
                    Edit Room
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
                                       placeholder="Nama Room" required value="<?= $room->name ?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="type">Tipe</label>
                                <select class="form-select form-select-sm" required name="type" id="type">
                                    <option <?= $room->type == "ROOM" ? "selected" : '' ?> value="ROOM">
                                        Room
                                    </option>
                                    <option <?= $room->type == "SUITES" ? "selected" : '' ?> value="SUITES">
                                        Suite
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea type="text" name="description" id="description"
                                          class="form-control form-control-sm"
                                          placeholder="Deskripsi" rows="7"><?= $room->description ?></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-2">
                                <label for="price">Price</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Rp. </span>
                                    <input type="number" name="price" id="price" class="form-control form-control-sm"
                                           placeholder="Harga" value="<?= $room->price ?>"
                                           required>
                                    <span class="input-group-text">per night</span>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="capacity">Capacity</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" name="capacity" id="capacity"
                                           class="form-control form-control-sm"
                                           placeholder="Harga" value="<?= $room->capacity ?>" required>
                                    <span class="input-group-text">Guest per Room</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="size">Size</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" step=".01" name="size" id="size"
                                           class="form-control form-control-sm"
                                           value="<?= $room->size ?>" required>
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
                                <?php
                                $bed_option = array_filter($room->beds, function ($e) {
                                    return $e->bed_type == "KING";
                                });

                                if (count($bed_option) == 0) {
                                    $bed_count = 0;
                                } else {
                                    $bed_count = reset($bed_option)->bed_count;
                                }
                                ?>
                                <input type="number" name="king_bed_count" id="king_bed_count"
                                       class="form-control form-control-sm"
                                       value="<?= $bed_count ?>" min="0" required>
                                <span class="input-group-text">King Bed(s)</span>
                            </div>
                        </div>
                        <div class="mx-2">
                            /
                        </div>
                        <div class="flex-grow-1">
                            <?php
                            $bed_option = array_filter($room->beds, function ($e) {
                                return $e->bed_type == "QUEEN";
                            });

                            if (count($bed_option) == 0) {
                                $bed_count = 0;
                            } else {
                                $bed_count = reset($bed_option)->bed_count;
                            }
                            ?>
                            <div class="input-group input-group-sm">
                                <input type="number" name="queen_bed_count" id="queen_bed_count"
                                       class="form-control form-control-sm"
                                       value="<?= $bed_count ?>" min="0" required>
                                <span class="input-group-text">Queen Bed(s)</span>
                            </div>
                        </div>
                        <div class="mx-2">
                            /
                        </div>
                        <div class="flex-grow-1">
                            <?php
                            $bed_option = array_filter($room->beds, function ($e) {
                                return $e->bed_type == "TWIN";
                            });

                            if (count($bed_option) == 0) {
                                $bed_count = 0;
                            } else {
                                $bed_count = reset($bed_option)->bed_count;
                            }
                            ?>
                            <div class="input-group input-group-sm">
                                <input type="number" name="twin_bed_count" id="twin_bed_count"
                                       class="form-control form-control-sm"
                                       value="<?= $bed_count ?>" min="0" required>
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
                                        <?php
                                        $checked = array_filter($room->facilities, function ($e) use ($facility_option) {
                                            return $e->slug == $facility_option->slug;
                                        });

                                        $checked = count($checked) > 0;
                                        ?>
                                        <input class="form-check-input me-2" type="checkbox"
                                               value="<?= $facility_option->slug ?>"
                                               name="facility_option[]"
                                            <?php if ($checked): ?>
                                                checked
                                            <?php endif ?>
                                        >

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
                <button type="submit" class="btn btn-primary btn-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
<?= $this->endSection(); ?>