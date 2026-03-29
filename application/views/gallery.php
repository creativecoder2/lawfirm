<style>
    /* Gallery Grid CSS */
    .gallery-grid-section {
        padding: 50px 0;
        background: #f8f9fa;
    }

    .video-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 15px;
    }

    @media (max-width: 1200px) { .video-grid { grid-template-columns: repeat(4, 1fr); } }
    @media (max-width: 991px) { .video-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 576px) { .video-grid { grid-template-columns: repeat(2, 1fr); } }

    .grid-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        aspect-ratio: 9/16;
        background: #000;
        cursor: pointer;
        transition: transform 0.3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .grid-item:hover {
        transform: scale(1.03);
        z-index: 5;
    }

    .grid-item video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.8;
        transition: 0.3s;
    }

    .grid-item:hover video {
        opacity: 1;
    }

    .grid-item .item-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 15px 10px;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: #fff;
        pointer-events: none;
    }

    .grid-item .item-overlay h5 {
        color: #fff;
        font-size: 0.9rem;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Fullscreen TikTok Overlay */
    #tiktok-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #000;
        z-index: 9999;
        display: none; /* Hidden by default */
    }

    .close-overlay {
        position: absolute;
        top: 20px;
        right: 20px;
        color: #fff;
        font-size: 30px;
        z-index: 10001;
        cursor: pointer;
        background: rgba(0,0,0,0.5);
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }

    .close-overlay:hover {
        background: #d0a15e;
    }

    .gallery-container {
        height: 100%;
        overflow-y: scroll;
        scroll-snap-type: y mandatory;
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
    }

    .video-slide video {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }

    .video-overlay-bottom {
        position: absolute;
        bottom: 40px;
        left: 20px;
        right: 80px;
        color: #fff;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.8);
        z-index: 10;
        pointer-events: none;
    }

    .video-overlay-right {
        position: absolute;
        right: 15px;
        bottom: 120px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        z-index: 11;
    }

    .action-btn {
        background: rgba(255, 255, 255, 0.15);
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
        backdrop-filter: blur(5px);
    }
</style>

<!-- Breadcumb -->
<section class="breadcumb-area" style="background: #1a1a1a; padding: 40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 style="color: #d0a15e; margin: 0;">Video Gallery</h2>
                <p style="color: #999; margin-top: 10px;">Watch our latest legal insights and case highlights</p>
            </div>
        </div>
    </div>
</section>

<!-- Grid Section -->
<section class="gallery-grid-section">
    <div class="container-fluid" style="padding: 0 40px;">
        <div class="video-grid">
            <?php if(!empty($videos)): foreach($videos as $index => $v): ?>
            <div class="grid-item open-tiktok" data-index="<?= $index ?>" data-id="<?= $v['id'] ?>">
                <video muted loop preload="metadata">
                    <source src="<?= base_url($v['video_path']) ?>" type="video/mp4">
                </video>
                <div class="item-overlay">
                    <h5><?= $v['title'] ?></h5>
                    <small><i class="fa fa-eye"></i> <?= $v['views'] ?> views</small>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-12 text-center py-5">
                <h3>No videos found.</h3>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Fullscreen TikTok Overlay -->
<div id="tiktok-overlay">
    <div class="close-overlay">&times;</div>
    
    <div class="gallery-container" id="video-gallery">
        <?php if(!empty($videos)): foreach($videos as $v): ?>
        <div class="video-slide" id="slide-<?= $v['id'] ?>" data-id="<?= $v['id'] ?>" data-title="<?= htmlspecialchars($v['title']) ?>" data-url="<?= site_url('gallery/'.$v['id']) ?>">
            <video class="gallery-video" loop preload="none" playsinline>
                <source src="<?= base_url($v['video_path']) ?>" type="video/mp4">
            </video>

            <div class="video-overlay-bottom">
                <h3 style="color:#fff;"><?= $v['title'] ?></h3>
                <p><?= $v['description'] ?></p>
            </div>

            <div class="video-overlay-right">
                <div class="action-btn">
                    <i class="fa fa-eye fa-lg"></i>
                    <span style="font-size:12px;" id="views-<?= $v['id'] ?>"><?= $v['views'] ?></span>
                </div>
                <button class="action-btn share-trigger" data-id="<?= $v['id'] ?>" data-title="<?= htmlspecialchars($v['title']) ?>" data-link="<?= site_url('gallery/'.$v['id']) ?>">
                    <i class="fa fa-share-alt fa-lg"></i>
                    <span style="font-size:12px;" id="shares-<?= $v['id'] ?>"><?= $v['shares'] ?></span>
                </button>
                <button class="action-btn copy-link" data-link="<?= site_url('gallery/'.$v['id']) ?>">
                    <i class="fa fa-link fa-lg"></i>
                </button>
            </div>
        </div>
        <?php endforeach; endif; ?>
    </div>
</div>

<!-- Modal etc. -->
<?php $this->load->view('gallery_modals'); // Separated for cleanliness ?>

<script>
$(document).ready(function() {
    const $overlay = $('#tiktok-overlay');
    const $gallery = $('#video-gallery');

    // Hover play on grid
    $('.grid-item').hover(
        function() { $(this).find('video')[0].play(); },
        function() { 
            const v = $(this).find('video')[0];
            v.pause();
            v.currentTime = 0;
        }
    );

    // Open TikTok View
    $('.open-tiktok').on('click', function() {
        const id = $(this).data('id');
        $overlay.fadeIn();
        $('body').css('overflow', 'hidden');
        
        // Scroll to the specific video
        const target = document.getElementById('slide-' + id);
        if(target) {
            target.scrollIntoView();
        }
    });

    // Close Overlay
    $('.close-overlay').on('click', function() {
        $overlay.fadeOut();
        $('body').css('overflow', 'auto');
        // Pause all videos
        $('.gallery-video').each(function() { this.pause(); });
        // Reset URL to gallery
        window.history.pushState(null, null, '<?= site_url("gallery") ?>');
    });

    // Vertical Scroll Logic (Intersection Observer)
    const observerOptions = {
        root: document.querySelector('#video-gallery'),
        threshold: 0.7
    };

    const videoObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const video = entry.target.querySelector('video');
            const videoId = entry.target.dataset.id;
            
            if (entry.isIntersecting) {
                // Preload and play
                video.preload = "auto";
                video.play().catch(e => console.log("Autoplay blocked"));
                
                if(!$(video).data('tracked')) {
                    trackAction(videoId, 'view');
                    $(video).data('tracked', true);
                }
                window.history.pushState(null, null, entry.target.dataset.url);
                document.title = entry.target.dataset.title + " | Gallery";
            } else {
                video.pause();
            }
        });
    }, observerOptions);

    document.querySelectorAll('.video-slide').forEach(slide => {
        videoObserver.observe(slide);
    });

    // Auto-open if ID in URL
    <?php if(isset($active_video)): ?>
    setTimeout(() => {
        $('.open-tiktok[data-id="<?= $active_video['id'] ?>"]').click();
    }, 500);
    <?php endif; ?>

    function trackAction(id, type) {
        $.post('<?= site_url("welcome/track_video_action") ?>', {id: id, type: type}, function(res) {
            try {
                const data = JSON.parse(res);
                if(data.status === 'success') {
                    $(`#${type}s-${id}`).text(data.count);
                }
            } catch(e) {}
        });
    }

    // Reuse share functions...
});
</script>
