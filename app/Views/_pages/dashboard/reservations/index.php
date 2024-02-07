<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>
<?= view("_components/PageHero", [
    "breadcrumbs" => [
        "Reservations"
    ],
]); ?>

<div class="container pb-5">
    <div class="pb-3 w-100 d-flex justify-content-end">
        <div class="d-flex align-items-center gap-2">
            <label for="online_reservation">Online Reservation</label>
            <form method="post" class="btn-group" action="<?= route_to("object.config.update") ?>">
                <button type="submit"
                        name="ONLINE_RESERVATION"
                        value="1"
                        class="btn btn-<?= callConfig("ONLINE_RESERVATION", false) ? "" : "outline-" ?>success btn-sm">
                    Active
                </button>
                <button type="submit"
                        name="ONLINE_RESERVATION"
                        value="0"
                        class="btn btn-<?= callConfig("ONLINE_RESERVATION", false) ? "outline-" : "" ?>danger btn-sm">
                    Not Active
                </button>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover small" id="reservation">
            <thead>
            <tr>
                <th width="1">No</th>
                <th>Reservation ID</th>
                <th>Guest Data</th>
                <th>Guest Count</th>
                <th>Room</th>
                <th>Preferred Bed Type</th>
                <th>Reservation Date</th>
                <th>Payment Information</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($reservations as $idx => $reservation): ?>
                <tr>
                    <td><?= $idx + 1 ?></td>
                    <td>
                        <a
                                class="text-decoration-none"
                                href="https://hotel-ebony-batulicin-fe.vercel.app/payment-status/<?= $reservation->reservation_id ?>">
                            <?= $reservation->reservation_id ?>
                        </a>
                    </td>
                    <td>
                        <?= $reservation->guest_name ?><br/>
                        <small class="text-secondary" style="font-size: 12px">
                            <?= $reservation->guest_email ?> / <?= $reservation->guest_phone ?>
                        </small>
                    </td>
                    <td>
                        <div>
                            <?= $reservation->total_guest ?> Adult Guest
                        </div>
                        <div>
                            <?= $reservation->total_guest_child ?> Child Guests
                        </div>
                    </td>
                    <td>
                        <?= $reservation->room_count ?>
                        <?= $reservation->room->name ?>
                    </td>
                    <td>
                        <?= ucwords(strtolower($reservation->bed_type)) ?> Bed
                    </td>
                    <td class="text-center">
                        <?= $reservation->check_in_date ?><br>
                        to <br/>
                        <?= $reservation->check_out_date ?>
                    </td>
                    <td>
                        <?= $reservation->total_fee ?> (<?= $reservation->rate_code ?>)<br>
                        <?php if ($reservation->status == "PAID"): ?>
                            <span class="text-success fw-bold">Paid</span> @ <?= $reservation->paid_at ?>
                        <?php else: ?>
                            <span class="text-warning fw-bold"><?= ucwords(strtolower($reservation->status)) ?>, Unpaid</span>
                        <?php endif ?>
                    </td>
                    <td>
                        <?= $reservation->created_at ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>


<?= $this->section("javascript"); ?>
<script>
    new DataTable('table#reservation');
</script>
<?= $this->endSection(); ?>
