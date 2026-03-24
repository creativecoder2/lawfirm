<!-- expert-area start -->
<div class="team-area ptb-100-70" id="global-team-section">
    <div class="container">
        <div class="col-l2">
            <div class="section-title-1  text-center">
                <span>Meet Our Experts</span>
                <h2>Qualified Attorneys</h2>
            </div>
        </div>
        <div class="team-active owl-carousel">
            <?php if(!empty($teams)): foreach($teams as $team): ?>
            <div class="cms-team-card" onclick="if(!event.target.closest('.social-hover')) window.location.href='<?= site_url('attorney/'.$team['slug']) ?>'" style="cursor: pointer;">
                <div class="card-inner">
                    <div class="card-image-wrapper">
                        <img src="<?= base_url($team['image']) ?>" alt="<?= $team['name'] ?>">
                        <div class="social-hover">
                            <ul>
                                <?php if(!empty($team['facebook'])): ?><li><a href="<?= $team['facebook'] ?>" onclick="event.stopPropagation();"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
                                <?php if(!empty($team['twitter'])): ?><li><a href="<?= $team['twitter'] ?>" onclick="event.stopPropagation();"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
                                <?php if(!empty($team['linkedin'])): ?><li><a href="<?= $team['linkedin'] ?>" onclick="event.stopPropagation();"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <h4><a href="<?= site_url('attorney/'.$team['slug']) ?>" onclick="event.stopPropagation();"><?= $team['name'] ?></a></h4>
                        <span class="designation"><?= $team['designation'] ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>

<style>
/* Attorney Card Premium Styling */
.cms-team-card {
    padding: 10px;
    transition: all 0.3s ease;
}
.cms-team-card .card-inner {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.03);
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.cms-team-card:hover .card-inner {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}
.card-image-wrapper {
    position: relative;
    width: 100%;
    padding-top: 110%; /* Aspect ratio */
    overflow: hidden;
    background: #f8f9fa;
}
.card-image-wrapper img {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.cms-team-card:hover img {
    transform: scale(1.05);
}
.social-hover {
    position: absolute;
    bottom: -40px;
    left: 0; width: 100%;
    background: rgba(188,147,85,0.9);
    display: flex;
    justify-content: center;
    padding: 8px 0;
    transition: bottom 0.3s ease;
}
.cms-team-card:hover .social-hover {
    bottom: 0;
}
.social-hover ul {
    display: flex;
    gap: 15px;
    margin: 0; padding: 0;
    list-style: none;
}
.social-hover li a {
    color: #fff;
    font-size: 14px;
    transition: opacity 0.2s;
}
.social-hover li a:hover { opacity: 0.8; }

.card-content {
    padding: 20px 15px;
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.card-content h4 {
    margin: 0 0 5px;
    font-size: 18px;
    font-weight: 600;
    color: #333;
}
.card-content h4 a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
}
.card-content h4 a:hover { color: #bc9355; }
.card-content .designation {
    font-size: 13px;
    color: #bc9355;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
/* Override Owl Carousel for this section */
.team-area .owl-item {
    transition: transform 0.3s ease;
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof jQuery !== 'undefined' && jQuery('.team-active').length) {
            var $owl = jQuery('.team-active');
            $owl.owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                smartSpeed: 800,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                responsive: {
                    0: { items: 1 },
                    600: { items: 2 },
                    1000: { items: 3 },
                    1200: { items: 4 }
                }
            });
        }
    });
</script>
<!-- expert-area end -->
