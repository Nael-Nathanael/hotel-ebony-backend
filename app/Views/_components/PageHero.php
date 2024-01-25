<div class="w-100 mb-4 d-flex justify-content-end flex-column p-2 text-white position-relative"
     style="
             height: 150px;
             background: url('<?= PLACEHOLDER_IMG ?>') center;
             background-size: cover;
             ">
    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="opacity: .45; z-index: 100; background-color: black"></div>
    <div style="z-index: 101">
        <div class="<?= isset($fluid) && $fluid ? 'container-fluid  ' : 'container' ?>">
            <?php if (count($breadcrumbs) > 1): ?>
                <div class="small">
                    <?php foreach (array_slice($breadcrumbs, 0, -1) as $breadcrumb => $link): ?>
                        <a class="text-light fw-lighter text-decoration-none"
                           href="<?= $link ?>">
                            <?= $breadcrumb ?>
                        </a>
                        /
                    <?php endforeach; ?>
                    <a class="text-light fw-lighter text-decoration-none" href="#"><?= end($breadcrumbs) ?></a>
                </div>
            <?php endif; ?>
            <div class="font-marcellus h3 mb-0">
                <?= end($breadcrumbs) ?>
            </div>
            <?php if (isset($help) && $help): ?>
                <small class="text-white"><i class="bi bi-info-circle"></i> <?= $help ?></small>
            <?php endif ?>
        </div>
    </div>
</div>