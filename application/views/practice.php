<!-- .breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2 id="practice-breadcrumb-title"><?= !empty($practice['title']) ? $practice['title'] : 'Practice Area' ?></h2>
                        <ul>
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li><span>Practice area details</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->    
    <!-- .practice-details-area start -->
    <div class="practice-details-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12 p-p">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-12">  
                            <div class="field-section">
                                <div class="field-img">
                                    <img src="<?= base_url('assets/images/practice/2.jpg') ?>" alt="">
                                </div>
                                <div class="field-content">
                                    <h3><span><?= isset($settings['experience_years']) ? $settings['experience_years'] : '25' ?></span><?= isset($settings['experience_text']) ? $settings['experience_text'] : 'Years of Experience In This Field' ?></h3>
                                    <div class="btns">
                                        <div class="btn-style"><a href="<?= base_url('contact') ?>">Contact Us Now</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 col-12">
                          <div class="practice-catagory-item">
                             <div class="widget-title">
                                <h3 class="text-left">Category</h3>
                              </div>
                            <div class="practice-section">
                                <ul id="practice-category-list">
                                    <?php if(!empty($all_practices)): ?>
                                        <?php foreach($all_practices as $p): ?>
                                            <li class="<?= (!empty($practice) && $practice['id'] == $p['id']) ? 'active' : '' ?>" data-id="<?= $p['id'] ?>">
                                                <a href="<?= base_url('practice/'.$p['slug']) ?>" class="practice-cat-link" data-slug="<?= $p['slug'] ?>" data-title="<?= $p['title'] ?>"><?= $p['title'] ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12" id="practice-content-area">
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
                                    <h2> Our Services Include:</h2>
                                    <div class="services-list">
                                        <?= $practice['services'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="alert alert-info">No practice area content found.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- .practice-details-area end -->

    <!--our team-->
    <?php if(!empty($teams)): ?>
    <div class="team-area ptb-100-70">
        <div class="container">
            <div class="col-l2">
                <div class="section-title-1  text-center">
                    <span>Meet Our Experts</span>
                    <h2>Qualified Attorneys</h2>
                </div>
            </div>
            <div class="team-active owl-carousel owl-theme">
                <?php foreach($teams as $team): ?>
                    <div class="team-item">
                        <div class="team-single">
                            <div class="team-img">
                                <img src="<?= base_url($team['image']) ?>" alt="<?= $team['name'] ?>">
                                <div class="social-1st">
                                    <ul>
                                        <?php if(!empty($team['facebook'])): ?>
                                            <li><a href="<?= $team['facebook'] ?>"><i class="fa fa-facebook"></i></a></li>
                                        <?php endif; ?>
                                        <?php if(!empty($team['twitter'])): ?>
                                            <li><a href="<?= $team['twitter'] ?>"><i class="fa fa-twitter"></i></a></li>
                                        <?php endif; ?>
                                        <?php if(!empty($team['linkedin'])): ?>
                                            <li><a href="<?= $team['linkedin'] ?>"><i class="fa fa-linkedin"></i></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-content">
                                <h4><a href="<?= base_url('attorney/' . (isset($team['slug']) ? $team['slug'] : $team['id'])) ?>"><?= $team['name'] ?></a></h4>
                                <span><?= $team['designation'] ?></span>
                                <p><?= isset($team['description']) ? $team['description'] : '' ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

<style>
#practice-category-list li.active a {
    color: #bc9355;
    font-weight: 700;
    border-left: 3px solid #bc9355;
    padding-left: 8px;
}
#practice-content-area {
    transition: opacity 0.3s ease;
}
#practice-content-area.loading {
    opacity: 0.4;
    pointer-events: none;
}
</style>

<script>
$(document).ready(function() {
    $(document).on('click', '.practice-cat-link', function(e) {
        e.preventDefault();
        var slug = $(this).data('slug');
        var title = $(this).data('title');
        var url = '<?= base_url("practice/") ?>' + slug;

        // Update sidebar highlight
        $('#practice-category-list li').removeClass('active');
        $(this).closest('li').addClass('active');

        // Show loading state
        $('#practice-content-area').addClass('loading');

        // AJAX request
        $.ajax({
            url: url,
            type: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function(response) {
                $('#practice-content-area').html(response);
                $('#practice-content-area').removeClass('loading');
                $('#practice-breadcrumb-title').text(title);
                // Update browser URL without reload
                history.pushState({ slug: slug }, title, url);
            },
            error: function() {
                $('#practice-content-area').removeClass('loading');
            }
        });
    });

    // Handle browser back/forward
    window.onpopstate = function(event) {
        if (event.state && event.state.slug) {
            window.location.href = '<?= base_url("practice/") ?>' + event.state.slug;
        }
    };
});
</script>
