<!-- .breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Case Stadies</h2>
                        <ul>
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li><span>Resent Case Studies</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- case studiess area start -->
    <div class="studies-area section-padding studies-area-2">
        <div class="container">
            <!-- studies area start -->
            <div class="col-l2">
                <div class="section-title-1 text-center">
                    <span>Here Our Best Work</span>
                    <h2>Our Resent Case Studies</h2>
                </div>
            </div>
            <div class="col-12">
                <div class="studies-menu text-center">
                    <button class="active" data-filter="*">All</button>
                    <?php if(!empty($categories)): foreach($categories as $cat): ?>
                        <button data-filter=".<?= $cat['slug'] ?>"><?= $cat['name'] ?></button>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <div class="row grid">
                <?php if(!empty($case_studies)): foreach($case_studies as $cs): ?>
                <div class="col-lg-4 col-md-6 col-sm-6 grid-item <?= $cs['category_slug'] ?>">
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
            </div>
            <div class="btn-style"><a href="#">Load More</a></div>
        </div>
    </div>
    <!-- case studiess area end -->



