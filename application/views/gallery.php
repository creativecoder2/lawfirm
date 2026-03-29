<style>
    /* TikTok Style Gallery CSS */
    .gallery-container {
        height: calc(100vh - 100px); /* Adjust based on header height */
        overflow-y: scroll;
        scroll-snap-type: y mandatory;
        background: #000;
        position: relative;
    }

    .video-slide {
        height: 100%;
        width: 100%;
        scroll-snap-align: start;
        scroll-snap-stop: always;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #000;
    }

    .video-slide video {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }

    /* Overlays */
    .video-overlay-bottom {
        position: absolute;
        bottom: 20px;
        left: 20px;
        right: 80px;
        color: #fff;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.8);
        z-index: 10;
        pointer-events: none;
    }

    .video-overlay-bottom h3 {
        color: #fff;
        margin-bottom: 5px;
        font-size: 1.2rem;
    }

    .video-overlay-bottom p {
        font-size: 0.9rem;
        opacity: 0.9;
        margin: 0;
    }

    .video-overlay-right {
        position: absolute;
        right: 15px;
        bottom: 100px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        align-items: center;
        z-index: 11;
    }

    .action-btn {
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: #fff;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: 0.3s;
        backdrop-filter: blur(5px);
        padding: 5px;
    }

    .action-btn:hover {
        background: rgba(188, 147, 85, 0.8);
    }

    .action-btn i {
        font-size: 1.4rem;
    }

    .action-btn span {
        font-size: 0.7rem;
        margin-top: 2px;
    }

    /* Breadcumb override for Gallery */
    .breadcumb-area.gallery-page {
        padding: 20px 0;
        background: #1a1a1a;
    }

    /* Scroll Indicators */
    .scroll-hint {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        color: #fff;
        animation: bounce 2s infinite;
        z-index: 20;
        opacity: 0.7;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {transform: translateY(0) translateX(-50%);}
        40% {transform: translateY(-10px) translateX(-50%);}
        60% {transform: translateY(-5px) translateX(-50%);}
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
        .gallery-container {
            height: calc(100vh - 70px);
        }
    }
</style>

<!-- Breadcumb -->
<div class="breadcumb-area gallery-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2 style="font-size: 24px;">Video Gallery</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="gallery-container" id="video-gallery">
    <?php if(!empty($videos)): foreach($videos as $index => $v): ?>
    <div class="video-slide" data-id="<?= $v['id'] ?>" data-title="<?= htmlspecialchars($v['title']) ?>" data-url="<?= site_url('gallery/'.$v['id']) ?>">
        <video class="gallery-video" loop preload="metadata" playsinline>
            <source src="<?= base_url($v['video_path']) ?>" type="video/mp4">
        </video>

        <!-- Bottom Text info -->
        <div class="video-overlay-bottom">
            <h3><?= $v['title'] ?></h3>
            <p><?= $v['description'] ?></p>
        </div>

        <!-- Right Side Actions -->
        <div class="video-overlay-right">
            <div class="action-btn" title="Views">
                <i class="fa fa-eye"></i>
                <span class="view-count" id="views-<?= $v['id'] ?>"><?= $v['views'] ?></span>
            </div>
            
            <button class="action-btn share-trigger" data-id="<?= $v['id'] ?>" data-title="<?= htmlspecialchars($v['title']) ?>" data-link="<?= site_url('gallery/'.$v['id']) ?>" title="Share">
                <i class="fa fa-share-alt"></i>
                <span class="share-count" id="shares-<?= $v['id'] ?>"><?= $v['shares'] ?></span>
            </button>

            <button class="action-btn copy-link" data-link="<?= site_url('gallery/'.$v['id']) ?>" title="Copy Link">
                <i class="fa fa-link"></i>
                <span>Link</span>
            </button>
        </div>

        <?php if($index == 0): ?>
        <div class="scroll-hint">
            <i class="fa fa-angle-double-down"></i>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; else: ?>
    <div class="video-slide">
        <div class="text-white text-center">
            <h3>No videos available.</h3>
            <p>Please check back later.</p>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <h5 class="modal-title">Share this Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-center gap-3 mb-4" style="gap: 20px;">
                    <a href="#" class="btn btn-primary share-btn facebook" style="background:#3b5998; border:0; width:50px; height:50px; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="fa fa-facebook fa-lg"></i></a>
                    <a href="#" class="btn btn-info share-btn twitter" style="background:#1da1f2; border:0; width:50px; height:50px; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="fa fa-twitter fa-lg"></i></a>
                    <a href="#" class="btn btn-success share-btn whatsapp" style="background:#25d366; border:0; width:50px; height:50px; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="fa fa-whatsapp fa-lg"></i></a>
                    <a href="#" class="btn btn-danger share-btn linkedin" style="background:#0077b5; border:0; width:50px; height:50px; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="fa fa-linkedin fa-lg"></i></a>
                </div>
                <div class="input-group">
                    <input type="text" id="share-link-input" class="form-control" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="copy-btn-modal" type="button">Copy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    const observerOptions = {
        root: document.querySelector('#video-gallery'),
        threshold: 0.6
    };

    const videoObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const video = entry.target.querySelector('video');
            const videoId = entry.target.dataset.id;
            
            if (entry.isIntersecting) {
                video.play();
                // Track view via AJAX if not already tracked in this session
                if(!$(video).data('tracked')) {
                    trackAction(videoId, 'view');
                    $(video).data('tracked', true);
                }
                // Update URL without reloading if needed
                window.history.pushState(null, null, entry.target.dataset.url);
                document.title = entry.target.dataset.title + " | Video Gallery";
            } else {
                video.pause();
            }
        });
    }, observerOptions);

    document.querySelectorAll('.video-slide').forEach(slide => {
        videoObserver.observe(slide);
    });

    // Track views/shares function
    function trackAction(id, type) {
        $.post('<?= site_url("welcome/track_video_action") ?>', {id: id, type: type}, function(res) {
            const data = JSON.parse(res);
            if(data.status === 'success') {
                $(`#${type}s-${id}`).text(data.count);
            }
        });
    }

    // Share Modal Logic
    $('.share-trigger').on('click', function() {
        const id = $(this).data('id');
        const title = $(this).data('title');
        const url = $(this).data('link');
        
        $('#share-link-input').val(url);
        $('#shareModal').modal('show');
        
        // Update share buttons
        $('.share-btn.facebook').attr('href', `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`);
        $('.share-btn.twitter').attr('href', `https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`);
        $('.share-btn.whatsapp').attr('href', `https://api.whatsapp.com/send?text=${encodeURIComponent(title + " " + url)}`);
        $('.share-btn.linkedin').attr('href', `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`);

        // Track share action
        trackAction(id, 'share');
    });

    // Copy Link Logic
    $('.copy-link, #copy-btn-modal').on('click', function() {
        const link = $(this).hasClass('copy-link') ? $(this).data('link') : $('#share-link-input').val();
        
        const temp = $("<input>");
        $("body").append(temp);
        temp.val(link).select();
        document.execCommand("copy");
        temp.remove();
        
        alert("Link copied to clipboard!");
    });

    // Autoplay first video on interaction if needed
    $('#video-gallery').on('click', function() {
        const activeSlide = document.elementFromPoint(window.innerWidth / 2, window.innerHeight / 2).closest('.video-slide');
        if(activeSlide) {
            const video = activeSlide.querySelector('video');
            if(video.paused) video.play();
        }
    });
});
</script>
