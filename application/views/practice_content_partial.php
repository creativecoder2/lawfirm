<?php if(!empty($practice)): ?>
    <div class="practice-section-img">
        <img src="<?= !empty($practice['image']) ? base_url($practice['image']) : base_url('assets/images/practice/3.jpg') ?>" alt="<?= $practice['title'] ?>">
    </div>
    <div class="practice-section-text">
        <h2><?= $practice['title'] ?></h2>
        <?php if(!empty($practice['subtitle'])): ?>
            <h5><?= $practice['subtitle'] ?></h5>
        <?php endif; ?>
        <div class="description-text">
            <?= $practice['description'] ?>
        </div>
    </div>
    
    <?php if(!empty($practice['services'])): ?>
        <div class="organigation-area">
            <div class="organigation-text">
                <h2>Our Services Include:</h2>
                <div class="services-list">
                    <?= $practice['services'] ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php else: ?>
    <div class="alert alert-info">No practice area content found.</div>
<?php endif; ?>
