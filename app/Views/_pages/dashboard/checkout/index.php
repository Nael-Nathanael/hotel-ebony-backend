<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>

<?= view("_components/PageHero", [
    "breadcrumbs" => [
        "Checkout Page"
    ]
]); ?>

<div class="container pb-5 pt-2">
    <div class="row">
        <div class="col-8">
            <div class="h3 fw-normal text-uppercase font-marcellus mb-3">
                <?= summon_editable_div("Guest Details", "CHECKOUT_GUEST_DETAILS") ?>
            </div>

            <div class="row g-3">
                <div class="col-12">
                    <div class="mb-1">
                        <?= summon_editable_div("Full name", "CHECKOUT_FULL_NAME") ?>
                    </div>
                    <div class="w-100 border p-3">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-1">
                        <?= summon_editable_div("Email", "CHECKOUT_EMAIL") ?>
                    </div>
                    <div class="w-100 border p-3">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-1">
                        <?= summon_editable_div("Phone number (optional)", "CHECKOUT_PHONE") ?>
                    </div>
                    <div class="w-100 border p-3">
                    </div>
                </div>
                <div class="col-12">
                    <div>
                        <?= summon_editable_div("Special Request", "CHECKOUT_SPECIAL_REQUEST") ?>
                    </div>
                    <div class="mb-1 small">
                        <?= summon_editable_div("Requests are subject to availability", "CHECKOUT_SPECIAL_REQUEST_ALT") ?>
                    </div>
                    <div class="w-100 border p-5">
                    </div>
                </div>
                <div class="col-12">
                    <div>
                        <?= summon_editable_div("Bed Selection", "CHECKOUT_BED_SELECTION") ?>
                    </div>
                    <div class="mb-1 small">
                        <?= summon_editable_div("What bed configuration do you prefer", "CHECKOUT_BED_SELECTION_ALT") ?>
                    </div>
                    <div class="w-100 p-3">
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1 small d-flex gap-2">
                        <?= summon_editable_div("By proceeding with this booking. I agree to Hotel Ebony's ", "CHECKOUT_TNC_PREFIX") ?>
                        <?= summon_editable_div("Terms of Use and Privacy ", "CHECKOUT_TNC") ?>
                    </div>
                    <div class="text-uppercase fw-bold fs-6 text-white px-2 py-1"
                         style="width: fit-content;background-color: #6e5e5e;">
                        <?= summon_editable_div("Proceed to Payment", "CHECKOUT_PROCEED_BUTTON") ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="h3 fw-normal text-uppercase mb-3">
                {{ <span class="font-marcellus">Room Name</span> }}
            </div>
            <p class="mb-3">{{ Room Description }}</p>
            <p class="mb-1">{{ Check In Date }} - {{ Check Out Date }} </p>
            <p class="mb-1">{{ Total Guest }} </p>
            <p class="mb-1">{{ Room Size }} </p>
            <p class="mb-1">{{ Bed Option }} @ {{ Total Room }} </p>
            <p class="text-success mb-1">{{ Total Price }} </p>
            <p>{{ Price Breakdown }}</p>
            <hr>
            <div class="h4 fw-normal text-uppercase mb-3 font-marcellus">
                <?= summon_editable_div("Facilities", "CHECKOUT_FACILITIES") ?>
            </div>
            <p class="mb-1">{{ Room Facility 1 }}</p>
            <p class="mb-1">{{ Room Facility 2 }}</p>
            <p class="mb-1">{{ Room Facility 3 }}</p>
            <p class="mb-0">{{ Room Facility ... }}</p>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

