<?php if(!empty($case_studies)): foreach($case_studies as $cs): ?>
<div class="col-lg-4 col-md-6 col-sm-6 grid-item <?= $cs['category_slug'] ?> case-grid-item" data-title="<?= strtolower($cs['title']) ?>">
    <div class="studies-item">
        <div class="studies-single">
            <img src="<?= base_url($cs['image']) ?>" alt="">
        </div>
        <a href="<?= site_url('case_studies_details/'.$cs['slug']) ?>" class="overlay-text">
            <div class="text-inner">
                <p class="sub"><?= $cs['category_name'] ?></p>
                <h3><?= $cs['title'] ?></h3>
            </div>
        </a>  
    </div>
</div>
<?php endforeach; endif; ?>
