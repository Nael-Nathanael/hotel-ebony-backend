<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>
    <div class="container my-2">

        <form method="post" enctype="multipart/form-data" action="<?= route_to("object.psy.create") ?>" class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Register Psikolog</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name<span class='text-danger'>*</span></label>
                            <input
                                    id="name"
                                    placeholder="Name"
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    required
                            >
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="isAvailable">Tersedia?<span class='text-danger'>*</span></label>
                            <select name="isAvailable" class="form-select" required id="isAvailable">
                                <option value="1" selected>Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="SIPP">SIPP<span class='text-danger'>*</span></label>
                            <input
                                    id="SIPP"
                                    placeholder="1067-21-2-2"
                                    type="text"
                                    class="form-control"
                                    name="SIPP"
                            >
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="STR">STR<span class='text-danger'>*</span></label>
                            <input
                                    id="STR"
                                    placeholder="13 24 8 2 1 22-4442490"
                                    type="text"
                                    class="form-control"
                                    name="STR"
                            >
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="sesi">Total Sesi<span class='text-danger'>*</span></label>
                            <input
                                    id="sesi"
                                    placeholder="Total Sesi"
                                    type="number"
                                    value="0"
                                    class="form-control"
                                    name="sesi"
                                    required
                            >
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="rating">Total Rating<span class='text-danger'>*</span></label>
                            <input
                                    id="rating"
                                    placeholder="Min 0, Max 100"
                                    type="number"
                                    min="0"
                                    value="100"
                                    max="100"
                                    class="form-control"
                                    name="rating"
                                    required
                            >
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="reviews">Total Reviews<span class='text-danger'>*</span></label>
                            <input
                                    id="reviews"
                                    placeholder="Total Reviews"
                                    type="number"
                                    min="0"
                                    value="0"
                                    max="100"
                                    class="form-control"
                                    name="reviews"
                                    required
                            >
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="pengalaman_praktik">Pengalaman Praktik<span class='text-danger'>*</span></label>
                            <input
                                    id="pengalaman_praktik"
                                    placeholder="4 - 10 Tahun"
                                    type="text"
                                    value="4 - 10 Tahun"
                                    class="form-control"
                                    name="pengalaman_praktik"
                                    required
                            >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tag">Kategori<span class='text-danger'>*</span></label>
                            <input
                                    id="tag"
                                    placeholder="Psikolog Klinis Umum"
                                    type="text"
                                    value="Psikolog Klinis Umum"
                                    class="form-control"
                                    name="tag"
                                    required
                            >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="mastery">Keahlian<span class='text-danger'>*</span></label>
                            <input
                                    id="mastery"
                                    placeholder="Adiksi, Anak & Remaja, Anak Berkebutuhan Khusus"
                                    type="text"
                                    class="form-control"
                                    name="mastery"
                                    required
                            >
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="photo">Foto<span class='text-danger'>*</span></label>
                            <input type="file" id="photo" required name="photo" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Deskripsi<span class='text-danger'>*</span></label>
                            <textarea
                                    id="description"
                                    type="text"
                                    class="form-control"
                                    name="description"
                                    rows="3"
                            ></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <h6>Education</h6>

                        <div id="educationRowContainer" class="w-100">
                            <div class="d-flex justify-content-between w-100 gap-3">
                                <div class="form-group flex-grow-1">
                                    <label>Institute</label>
                                    <input
                                            placeholder="Institute"
                                            type="text"
                                            class="form-control"
                                            name="institute[]"
                                            required
                                    >
                                </div>
                                <div class="form-group flex-grow-1">
                                    <label>Major</label>
                                    <input
                                            placeholder="Major"
                                            type="text"
                                            class="form-control"
                                            name="major[]"
                                            required
                                    >
                                </div>
                                <div class="form-group flex-grow-1">
                                    <label>Year</label>
                                    <input
                                            placeholder="Tahun Kelulusan"
                                            type="text"
                                            class="form-control"
                                            name="year[]"
                                            required
                                    >
                                </div>

                                <button class="btn btn-danger btn-sm invisible" type="button">
                                    Delete
                                </button>
                            </div>
                        </div>
                        <button class="w-100 btn btn-primary btn-sm mt-2" type="button" onclick="addEdu()">
                            Add More Education
                        </button>
                    </div>
                    <div class="offset-1 col-1">
                    </div>
                </div>
            </div>
            <div class="card-footer border-0">
                <button class="btn btn-primary mx-auto">
                    Submit
                </button>
            </div>
        </form>
    </div>

    <script>
        function deleteThisRow(element) {
            element.parentElement.parentElement.remove()
        }

        function addEdu() {
            let h1 = document.createElement("div")
            h1.classList.add("d-flex")
            h1.classList.add("justify-content-between")
            h1.classList.add("w-100")
            h1.classList.add("gap-3")
            h1.classList.add("mt-2")
            h1.innerHTML = `
                                <div class="form-group flex-grow-1">
                                    <label>Institute</label>
                                    <input
                                            placeholder="Institute"
                                            type="text"
                                            class="form-control"
                                            name="institute[]"
                                            required
                                    >
                                </div>
                                <div class="form-group flex-grow-1">
                                    <label>Major</label>
                                    <input
                                            placeholder="Major"
                                            type="text"
                                            class="form-control"
                                            name="major[]"
                                            required
                                    >
                                </div>
                                <div class="form-group flex-grow-1">
                                    <label>Year</label>
                                    <input
                                            placeholder="Tahun Kelulusan"
                                            type="text"
                                            class="form-control"
                                            name="year[]"
                                            required
                                    >
                                </div>

<div class="form-group">
<label for="" class="invisible">.</label>
                                <button class="d-block btn btn-danger btn-sm" type="button" onclick="deleteThisRow(this)">
                                    Delete
                                </button>
</div>
            `
            document.getElementById("educationRowContainer").append(h1)
        }
    </script>
<?= $this->endSection(); ?>