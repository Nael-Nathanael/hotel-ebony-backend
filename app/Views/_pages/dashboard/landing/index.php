<?= $this->extend("_layouts/base_layout"); ?>

<?= $this->section("content"); ?>
    <div class="container">
        <section>
            <div class="card shadow-sm">
                <div class="card-header">
                    <div class="card-title">
                        Carousel Banner
                    </div>
                    <div class="card-toolkit">
                        <button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal"
                                data-bs-target="#carouselBanner_create_modal">
                            Create New
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 1px">No</th>
                                <th>Image</th>
                                <th>Headline</th>
                                <th>Description</th>
                                <th>Link to</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($carouselBanners as $index => $carouselBanner): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td>
                                        <img src="<?= $carouselBanner->imgUrl ?>" style="max-width: 200px"
                                             alt="<?= $carouselBanner->headline ?>">
                                    </td>
                                    <td>
                                        <?= $carouselBanner->headline ?>
                                    </td>
                                    <td>
                                        <?= $carouselBanner->description ?>
                                    </td>
                                    <td>
                                        <?= $carouselBanner->link ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="carouselBanner_create_modal" tabindex="-1"
         aria-labelledby="carouselBanner_create_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form action="<?= route_to("object.carouselBanner.create") ?>" enctype="multipart/form-data" method="post"
                  class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carouselBanner_create_modalLabel">Create New Carousel Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="img">Upload Banner Image</label>
                        <input class="form-control" type="file" name="img" id="img" required>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="headline" name="headline" placeholder="Headline"
                               required>
                        <label for="headline">Headline</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Description" id="description" name="description"
                                  style="min-height: 100px"></textarea>
                        <label for="description">Description</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="url" class="form-control" id="link" name="link" placeholder="Link to"
                               required>
                        <label for="link">Link to</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection(); ?>