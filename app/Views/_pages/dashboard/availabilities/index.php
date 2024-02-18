<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<?php $start = $_GET['s'] ?? date('Y-m-d'); ?>

<?php $readonly = "readonly" ?>

<?= view("_components/PageHero", [
    "breadcrumbs" => [
        "Room Availabilities"
    ],
    "fluid" => true,
    "help" => "Menu ini dalam mode <span class='fw-bold text-warning'>View Only</span>. Perubahan alotment atau availabilities bisa dilakukan di sistem CakraSoft."
]); ?>


<div class="container-fluid py-2">
    <form class="pb-3" style="width: 300px" id="form">
        <input name="s" type="date"
               value="<?= $start ?>"
               onchange="document.getElementById('form').submit()" class="form-control">
    </form>

    <div class="table-responsive">
        <table class="table" style="font-size: 12px">
            <thead class="text-center">
            <tr>
                <th width="1" style="vertical-align: middle">Date</th>
                <th width="1" style="vertical-align: middle"></th>
                <?php foreach ($rooms as $room): ?>
                    <th nowrap>
                        <?= $room->name ?>
                    </th>
                <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < 7; $i++): ?>
                <tr>
                    <th nowrap width="1" rowspan="3"
                        style="vertical-align: middle"><?= date("d / m / Y", strtotime($start . " +$i days")) ?></th>

                    <th nowrap style="vertical-align: middle">Available Room</th>

                    <?php foreach ($rooms as $room): ?>
                        <?php
                        /* Lookup availability for $room->availabilities */
                        $lookup = array_filter($room->availabilities, function ($availability) use ($i) {
                            global $start;
                            return $availability->date == date("Y-m-d", strtotime($start . " +$i days"));
                        });
                        if (count($lookup) > 0) {
                            $lookup = reset($lookup);
                        } else {
                            $lookup = (object)[
                                "count" => "",
                                "price" => "",
                                "rate_code" => ""
                            ];
                        }
                        ?>
                        <td>
                            <?php if ($readonly): ?>
                                <p class="text-center mb-0">
                                    <?= $lookup->count ?: "No" ?> Room
                                </p>
                            <?php else: ?>
                                <div class="align-items-center d-flex position-relative">
                                    <label for="<?= $room->slug . "count" . $i ?>"
                                           class="small position-absolute end-0 top-50 translate-middle-y me-2"></label>

                                    <input class="form-control form-control-sm" placeholder="0" type="number"
                                           name="<?= $room->slug . "count" . $i ?>"
                                           value="<?= $lookup->count ?>"
                                           onchange="updateAvailability(this, '<?= date("Y-m-d", strtotime($start . " +$i days")) ?>', '<?= $room->slug ?>', 'count')"
                                    >
                                </div>
                            <?php endif ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <th nowrap style="vertical-align: middle">Price</th>

                    <?php foreach ($rooms as $room): ?>
                        <?php
                        /* Lookup availability for $room->availabilities */
                        $lookup = array_filter($room->availabilities, function ($availability) use ($i) {
                            global $start;
                            return $availability->date == date("Y-m-d", strtotime($start . " +$i days"));
                        });
                        if (count($lookup) > 0) {
                            $lookup = reset($lookup);
                        } else {
                            $lookup = (object)[
                                "count" => "",
                                "price" => "",
                                "rate_code" => ""
                            ];
                        }
                        ?>
                        <td>
                            <?php if ($readonly): ?>
                                <p class="text-center mb-0">
                                    <?= $lookup->price ?: $room->price ?>
                                </p>
                            <?php else: ?>
                                <div class="align-items-center d-flex position-relative">
                                    <label for="<?= $room->slug . "price" . $i ?>"
                                           class="small position-absolute end-0 top-50 translate-middle-y me-2"></label>

                                    <input class="form-control form-control-sm"
                                           type="number"
                                           name="<?= $room->slug . "price" . $i ?>"
                                           value="<?= $lookup->price ?>"
                                           placeholder="<?= $room->price ?>"
                                           onchange="updateAvailability(this, '<?= date("Y-m-d", strtotime($start . " +$i days")) ?>', '<?= $room->slug ?>', 'price')"
                                    >
                                </div>
                            <?php endif ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <th nowrap style="vertical-align: middle">Rate Code</th>

                    <?php foreach ($rooms as $room): ?>
                        <?php
                        /* Lookup availability for $room->availabilities */
                        $lookup = array_filter($room->availabilities, function ($availability) use ($i) {
                            global $start;
                            return $availability->date == date("Y-m-d", strtotime($start . " +$i days"));
                        });
                        if (count($lookup) > 0) {
                            $lookup = reset($lookup);
                        } else {
                            $lookup = (object)[
                                "count" => "",
                                "price" => "",
                                "rate_code" => ""
                            ];
                        }
                        ?>
                        <td>
                            <?php if ($readonly): ?>
                                <p class="text-center mb-0">
                                    <?= $lookup->rate_code ?: $room->rate_code ?: '-' ?>
                                </p>
                            <?php else: ?>
                                <div class="align-items-center d-flex position-relative">
                                    <label for="<?= $room->slug . "rate_code" . $i ?>"
                                           class="small position-absolute end-0 top-50 translate-middle-y me-2"></label>

                                    <input class="form-control form-control-sm"
                                           name="<?= $room->slug . "rate_code" . $i ?>"
                                           placeholder="<?= $room->rate_code ?>" value="<?= $lookup->rate_code ?>"

                                           onchange="updateAvailability(this, '<?= date("Y-m-d", strtotime($start . " +$i days")) ?>', '<?= $room->slug ?>', 'rate_code')"
                                    >
                                </div>
                            <?php endif ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
                <tr class="border border-dark">
                </tr>
            <?php endfor; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section("javascript"); ?>
<script>
    async function updateAvailability(element, date, room_slug, aspect) {
        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                room_slug: room_slug,
                date: date,
                [aspect]: element.value
            })
        };

        fetch("<?= route_to("object.rooms.sync-availabilities-single") ?>", requestOptions)
            .then(async data => {
                console.log(await data.json())

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
</script>
<?= $this->endSection(); ?>
