<style>
    /* Fullscreen TikTok Overlay */
    #tiktok-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #000;
        z-index: 99999;
        display: none;
    }

    .close-overlay {
        position: absolute;
        top: 20px;
        right: 20px;
        color: #fff;
        font-size: 30px;
        z-index: 100001;
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

    .close-overlay:hover { background: #d0a15e; }

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
        background: #000;
    }

    .video-wrapper {
        position: relative;
        height: 100%;
        width: auto;
        aspect-ratio: 9/16;
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 100%;
    }

    .video-slide video {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .video-overlay-bottom {
        position: absolute;
        bottom: 30px;
        left: 15px;
        right: 80px;
        color: #fff;
        z-index: 10;
        padding: 15px 20px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .video-overlay-bottom h3 {
        margin-bottom: 5px;
        font-weight: 700;
        letter-spacing: 0.5px;
        font-size: 1.1rem;
        color: #fff !important;
        text-shadow: 0 1px 3px rgba(0,0,0,0.5);
    }

    .description-container {
        font-size: 0.85rem;
        line-height: 1.4;
        opacity: 0.95;
        text-shadow: 0 1px 2px rgba(0,0,0,0.5);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .description-container.expanded {
        -webkit-line-clamp: unset;
        display: block;
        max-height: 200px;
        overflow-y: auto;
    }

    .read-more-btn {
        display: inline-block;
        color: #fff;
        font-weight: bold;
        text-decoration: underline;
        cursor: pointer;
        font-size: 0.8rem;
        margin-top: 5px;
        pointer-events: auto;
    }

    .video-progress-container {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: rgba(255,255,255,0.1);
        z-index: 20;
    }

    .video-progress-bar {
        height: 100%;
        background: #d0a15e;
        width: 0%;
        transition: width 0.1s linear;
        box-shadow: 0 0 10px rgba(208, 161, 94, 0.5);
    }

    .play-pause-indicator {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.5);
        background: rgba(0,0,0,0.4);
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center; color: #fff; z-index: 15; pointer-events: none; transition: 0.3s;
        opacity: 0;
    }

    .play-pause-indicator.show { transform: translate(-50%, -50%) scale(1); opacity: 1; }

    .video-overlay-right { position: absolute; right: 15px; bottom: 150px; display: flex; flex-direction: column; gap: 20px; z-index: 11; }
    
    .action-btn { background: rgba(255, 255, 255, 0.15); border: none; color: #fff; width: 50px; height: 50px; border-radius: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; backdrop-filter: blur(5px); transition: 0.3s; }
    .action-btn:hover { background: rgba(208, 161, 94, 0.8); transform: scale(1.1); }
</style>

<!-- Fullscreen TikTok Overlay -->
<div id="tiktok-overlay">
    <div class="close-overlay">&times;</div>
    <div class="gallery-container" id="video-gallery">
        <?php if(!empty($videos)): foreach($videos as $v): ?>
        <div class="video-slide" id="slide-<?= $v['id'] ?>" data-id="<?= $v['id'] ?>" data-title="<?= htmlspecialchars($v['title']) ?>" data-url="<?= site_url('v/'.$v['id']) ?>">
            <div class="video-wrapper">
                <div class="play-pause-indicator"><i class="fa fa-play fa-2x"></i></div>
                <video class="gallery-video" loop preload="none" playsinline onwaiting="this.parentElement.querySelector('.video-loader').style.display='flex'" onplaying="this.parentElement.querySelector('.video-loader').style.display='none'">
                    <source src="<?= base_url($v['video_path']) ?>" type="video/mp4">
                </video>
                <div class="video-loader" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none; z-index: 14; color: #fff;"><i class="fa fa-spinner fa-spin fa-3x"></i></div>
                <div class="video-overlay-bottom">
                    <h3><?= $v['title'] ?></h3>
                    <div class="description-container" id="desc-<?= $v['id'] ?>"><?= $v['description'] ?></div>
                    <?php if(isset($v['description']) && strlen($v['description']) > 80): ?>
                    <a class="read-more-btn" onclick="toggleReadMore(event, 'desc-<?= $v['id'] ?>')">Read more</a>
                    <?php endif; ?>
                </div>
                <div class="video-overlay-right">
                    <div class="action-btn">
                        <i class="fa fa-eye fa-lg"></i>
                        <span style="font-size:12px;" id="views-<?= $v['id'] ?>"><?= $v['views'] ?></span>
                    </div>
                    <button class="action-btn share-trigger" data-id="<?= $v['id'] ?>" data-title="<?= htmlspecialchars($v['title']) ?>" data-link="<?= site_url('v/'.$v['id']) ?>">
                        <i class="fa fa-share-alt fa-lg"></i>
                        <span style="font-size:12px;" id="shares-<?= $v['id'] ?>"><?= $v['shares'] ?></span>
                    </button>
                    <button class="action-btn copy-link" data-link="<?= site_url('v/'.$v['id']) ?>">
                        <i class="fa fa-link fa-lg"></i>
                    </button>
                </div>
                <div class="video-progress-container"><div class="video-progress-bar" id="progress-<?= $v['id'] ?>"></div></div>
            </div>
        </div>
        <?php endforeach; endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof jQuery === 'undefined') { window.addEventListener('load', initGallery); } else { initGallery(); }
});

function initGallery() {
    const $ = jQuery;
    const $overlay = $('#tiktok-overlay');
    
    // Open TikTok View
    $(document).on('click', '.open-tiktok', function() {
        const id = $(this).data('id');
        openVideoOverlay(id);
    });

    window.openVideoOverlay = function(id) {
        $overlay.fadeIn();
        $('body').css('overflow', 'hidden');
        const target = document.getElementById('slide-' + id);
        if(target) {
            target.scrollIntoView();
            const video = target.querySelector('video');
            if(video) { video.muted = false; video.play().catch(() => { video.muted = true; video.play(); }); }
        }
    };

    $('.close-overlay').on('click', function() {
        $overlay.fadeOut();
        $('body').css('overflow', 'auto');
        $('.gallery-video').each(function() { this.pause(); });
        // Restore URL behavior if needed, or just let it stay on the current page
        // window.history.pushState(null, null, '<?= site_url("gallery") ?>');
    });

    // Vertical Scroll Logic (Intersection Observer)
    const observerOptions = { root: document.querySelector('#video-gallery'), threshold: 0.5 };
    
    const videoObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const video = entry.target.querySelector('video');
            const videoId = entry.target.dataset.id;
            const $progressBar = $(entry.target).find('.video-progress-bar');
            
            if (entry.isIntersecting) {
                video.preload = "auto";
                video.play().catch(() => {});
                
                // Track View
                trackAction(videoId, 'view');
                
                // Progress Bar
                video.ontimeupdate = function() {
                    const percentage = (video.currentTime / video.duration) * 100;
                    $progressBar.css('width', percentage + '%');
                };

                // Update URL and title only if we are on the gallery page
                if(window.location.pathname.includes('gallery')) {
                    window.history.pushState(null, null, entry.target.dataset.url);
                    document.title = entry.target.dataset.title + " | Gallery";
                }
            } else {
                video.pause();
                video.ontimeupdate = null;
            }
        });
    }, observerOptions);

    $('.video-slide').each(function() { videoObserver.observe(this); });

    $(document).on('click', '.video-wrapper', function(e) {
        // Don't toggle if clicking buttons, links, or description
        if (e.target.closest('.action-btn, .read-more-btn, .description-container')) return;
        
        const video = this.querySelector('video');
        if (!video) return;

        const $indicator = $(this).find('.play-pause-indicator');
        const $icon = $indicator.find('i');
        
        if (video.paused) { 
            video.muted = false; 
            video.play(); 
            $icon.removeClass('fa-play').addClass('fa-pause'); 
        } else { 
            video.pause(); 
            $icon.removeClass('fa-pause').addClass('fa-play'); 
        }
        
        $indicator.removeClass('show'); // Force restart animation
        void $indicator[0].offsetWidth; // Reflow
        $indicator.addClass('show');
        setTimeout(() => { $indicator.removeClass('show'); }, 800);
    });

    function trackAction(id, type) {
        const key = `gallery_${type}ed`;
        const items = JSON.parse(localStorage.getItem(key) || '[]');
        if (items.includes(id)) return;
        items.push(id);
        localStorage.setItem(key, JSON.stringify(items));
        $.post('<?= site_url("welcome/track_video_action") ?>', {id: id, type: type}, function(res) {
            try { 
                const d = JSON.parse(res); 
                if(d.status === 'success') $(`#${type}s-${id}`).text(d.count);
            } catch(e) {}
        });
    }
}

function toggleReadMore(e, id) {
    e.preventDefault(); e.stopPropagation();
    const container = document.getElementById(id);
    const btn = e.target;
    if (container.classList.contains('expanded')) { container.classList.remove('expanded'); btn.innerText = 'Read more'; }
    else { container.classList.add('expanded'); btn.innerText = 'Read less'; }
}
</script>
