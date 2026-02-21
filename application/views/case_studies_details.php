<!-- .breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Case Studies Details</h2>
                        <ul>
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li><span>Case Studies</span></li>
                            <li><span><?= $case_study['title'] ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- .practice-details-area start -->
    <div class="practice-details-area case-stadies-details-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="practice-section-img practice-section-img-2">
                        <img src="<?= base_url($case_study['image']) ?>" alt="">
                    </div>
                    <div class="practice-section-text practice-section-text-2">
                        <h2><?= $case_study['title'] ?></h2>
                        <h5><?= $case_study['subtitle'] ?></h5>
                        <p class="category-badge">Category: <?= $case_study['category_name'] ?></p>
                        <hr>
                        <div><?= nl2br($case_study['description']) ?></div>
                    </div>
                </div>
                <div class="col-lg-4 p-p">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="widget search-widget">
                                <form>
                                    <div>
                                        <input type="text" class="form-control" placeholder="Search Post..">
                                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                            <div class="col-lg-12 col-md-6">
                              <div class="practice-catagory-item">
                                 <div class="widget-title">
                                    <h3 class="text-left">Category</h3>
                                  </div>
                                <div class="practice-section">
                                    <ul>
                                        <?php if(!empty($categories)): foreach($categories as $cat): ?>
                                            <li><a href="<?= base_url() ?>?cat=<?= $cat['slug'] ?>"><?= $cat['name'] ?></a></li>
                                        <?php endforeach; endif; ?>
                                    </ul>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="practice-section resent-section practice-catagory-item">
                                    <h3 class="text-left">Recent Cases</h3>
                                    <div class="posts">
                                        <?php if(!empty($recent_cases)): foreach($recent_cases as $recent): ?>
                                        <div class="post post2">
                                            <div class="img-holder">
                                                <img src="<?= base_url($recent['image']) ?>" alt style="width: 80px; height: 80px; object-fit: cover;">
                                            </div>
                                            <div class="details">
                                                <p><a href="<?= site_url('case_studies_details/'.$recent['slug']) ?>"><?= $recent['title'] ?></a></p>
                                                <span><?= $recent['category_name'] ?></span>
                                            </div>
                                        </div>
                                        <?php endforeach; endif; ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .practice-details-area end -->
     <!-- case studiess area start -->
    <div class="studies-area studies-area-3 section-padding">
        <div class="container">
            <!-- studies area start -->
            <div class="col-l2">
                <div class="section-title section-title2">
                    <h2>Related Case Studies</h2>
                </div>
            </div>
            <div class="row">
                <?php if(!empty($related_cases)): foreach($related_cases as $related): ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="studies-item">
                        <div class="studies-single">
                            <img src="<?= base_url($related['image']) ?>" alt="">
                        </div>
                        <a href="<?= site_url('case_studies_details/'.$related['slug']) ?>" class="overlay-text">
                            <div class="text-inner">
                                <p class="sub"><?= $related['category_name'] ?></p>
                                <h3><?= $related['title'] ?></h3>
                            </div>
                        </a>  
                    </div>
                </div>
                <?php endforeach; else: ?>
                    <div class="col-12"><p>No related case studies found.</p></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- case studiess area end -->



