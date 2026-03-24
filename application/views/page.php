
<!-- .breadcumb-area start -->
<div class="breadcumb-area breadcumb-3" style="background-image: url(<?= base_url('assets/images/breadcumb/bg.jpg') ?>);">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap">
                    <h2><?= $page['title'] ?></h2>
                    <ul>
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li><span><?= $page['title'] ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->

<div class="page-content-area py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="custom-page-content" style="font-size: 16px; line-height: 1.8; color: #555;">
                    <?= $page['content'] ?>
                </div>
            </div>
        </div>
    </div>
</div>
