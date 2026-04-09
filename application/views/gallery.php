<style>
    /* Gallery Grid CSS */
    .gallery-grid-section {
        padding: 60px 0;
        background: #fdfaf5;
    }

    .video-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 12px;
    }

    @media (max-width: 1400px) { .video-grid { grid-template-columns: repeat(6, 1fr); } }
    @media (max-width: 1200px) { .video-grid { grid-template-columns: repeat(5, 1fr); } }
    @media (max-width: 991px) { .video-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 576px) { .video-grid { grid-template-columns: repeat(2, 1fr); } }

    .grid-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        aspect-ratio: 9/16;
        background: #111;
        cursor: pointer;
        transition: all 0.4s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        border: 1px solid rgba(0,0,0,0.05);
    }

    .grid-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        border-color: rgba(208, 161, 94, 0.3);
    }

    .grid-item video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.8;
        transition: 0.5s;
    }

    .grid-item:hover video {
        opacity: 1;
        transform: scale(1.05);
    }

    .grid-item .item-overlay {
        position: absolute;
        bottom: 8px;
        left: 8px;
        right: 8px;
        padding: 10px;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 10px;
        border: 1px solid rgba(255,255,255,0.1);
        color: #fff;
        pointer-events: none;
        transition: 0.3s;
    }

    .grid-item:hover .item-overlay {
        background: rgba(208, 161, 94, 0.1);
        border-color: rgba(208, 161, 94, 0.4);
    }

    .grid-item .item-overlay h5 {
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        margin: 0 0 2px 0;
        line-height: 1.2;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .action-btn { background: rgba(255, 255, 255, 0.15); border: none; color: #fff; width: 50px; height: 50px; border-radius: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; backdrop-filter: blur(5px); transition: 0.3s; }
    .action-btn:hover { background: rgba(208, 161, 94, 0.8); transform: scale(1.1); }
</style>

<!-- Breadcumb -->
<section class="breadcumb-area" style="background: linear-gradient(rgba(0,0,0,0.72), rgba(0,0,0,0.72)), url('<?= base_url('assets/images/breadcumb/breadcumb-1.jpg') ?>') center center / cover no-repeat; padding: 80px 0; min-height: 200px; display: flex; align-items: center;">
    <div class="container text-center" style="width: 100%;">
        <h2 style="color: #fff; margin: 0; font-size: 2.5rem; font-weight: 700;">Gallery</h2>
        <p style="color: #d0a15e; margin-top: 12px; font-size: 1rem; font-weight: 500;">
            <a href="<?= site_url() ?>" style="color: #fff; text-decoration: none;">Home</a>
            <span style="color: #d0a15e; margin: 0 8px;">/</span>
            <span style="color: #d0a15e;">Gallery</span>
        </p>
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
                    <small style="font-size: 0.75rem;"><i class="fa fa-eye"></i> <?= $v['views'] ?> views</small>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-12 text-center py-5"><h3>No videos found.</h3></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $this->load->view('includes/video_overlay'); ?>
<?php $this->load->view('gallery_modals'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof jQuery === 'undefined') { window.addEventListener('load', initGalleryPage); } else { initGalleryPage(); }
});

function initGalleryPage() {
    const $ = jQuery;
    
    // Hover play on grid
    $(document).on('mouseenter', '.grid-item', function() {
        const v = $(this).find('video')[0];
        if(v) v.play();
    }).on('mouseleave', '.grid-item', function() {
        const v = $(this).find('video')[0];
        if(v) { v.pause(); v.currentTime = 0; }
    });

    // Handle auto-open if coming from a direct link
    <?php if(isset($active_video['id'])): ?>
    setTimeout(() => { 
        if(window.openVideoOverlay) openVideoOverlay(<?= $active_video['id'] ?>);
    }, 500);
    <?php endif; ?>
}
</script>
