<!-- .breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Latest News</h2>
                        <ul>
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li><span>Blog</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- .breadcumb-area end -->
   <div class="blog-page-area section-padding">
       <div class="container">
           <div class="row">
               <div class="col-lg-8 col-md-12 col-12">
                   <div class="blog-left-bar">
                       <?php if(isset($search_keyword)): ?>
                            <div class="alert alert-info">
                                Search results for: <strong><?= htmlspecialchars($search_keyword) ?></strong>
                                <a href="<?= site_url('blog') ?>" class="pull-right">Clear Search</a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if(isset($filter_tag)): ?>
                            <div class="alert alert-info">
                                Showing posts tagged with: <strong><?= htmlspecialchars($filter_tag) ?></strong>
                                <a href="<?= site_url('blog') ?>" class="pull-right">Clear Tag</a>
                            </div>
                        <?php endif; ?>

                       <?php if(!empty($blogs)): ?>
                            <?php foreach($blogs as $b): ?>
                                <div class="blog-item <?= ($b['quote'] ? 'blog-item-2' : '') ?>" style="background: #fff; margin-bottom: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 10px; overflow: hidden;">
                                    <div class="blog-img" style="position: relative;">
                                        <?php if($b['quote']): ?>
                                            <div class="blog-s2" style="background: #1a1a1a; color: #fff; padding: 40px;">
                                                <img src="<?= base_url($b['image']) ?>" alt="<?= $b['title'] ?>" style="opacity: 0.3; position: absolute; top:0; left:0; width:100%; height:100%; object-fit: cover;">
                                                <div class="blog-content-3" style="position: relative; z-index: 1;">
                                                    <ul class="post-meta">
                                                        <li><img src="https://ui-avatars.com/api/?name=<?= urlencode($b['author']) ?>&background=bc9355&color=fff" alt="" style="border-radius: 50%; width: 40px;"></li>
                                                        <li><a href="#" style="color: #fff;">By <?= $b['author'] ?></a></li>
                                                        <li class="clr" style="color: #bc9355;"><?= $b['category_name'] ?></li>
                                                        <li style="color: #ccc;"> <?= date('M d, Y', strtotime($b['date_published'])) ?></li>
                                                    </ul>
                                                    <h2 style="color: #fff; margin-top: 20px;"><?= $b['title'] ?></h2>
                                                    <p style="color: #eee;"><?= strip_tags(substr($b['quote'], 0, 200)) ?>...</p>
                                                    <div class="share-options mt-3">
                                                        <a href="<?= site_url('blog_detail/'.$b['slug']) ?>" class="theme-btn btn-sm" style="padding: 8px 20px;">read more..</a>
                                                        <button onclick="copyToClipboard('<?= site_url('blog_detail/'.$b['slug']) ?>', this)" class="btn btn-dark btn-sm ml-2" title="Copy Link"><i class="fa fa-link"></i></button>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(site_url('blog_detail/'.$b['slug'])) ?>" target="_blank" class="btn btn-dark btn-sm ml-1"><i class="fa fa-facebook"></i></a>
                                                        <a href="https://twitter.com/intent/tweet?url=<?= urlencode(site_url('blog_detail/'.$b['slug'])) ?>" target="_blank" class="btn btn-dark btn-sm ml-1"><i class="fa fa-twitter"></i></a>
                                                        <a href="https://api.whatsapp.com/send?text=<?= urlencode($b['title'] . ' ' . site_url('blog_detail/'.$b['slug'])) ?>" target="_blank" class="btn btn-dark btn-sm ml-1"><i class="fa fa-whatsapp"></i></a>
                                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(site_url('blog_detail/'.$b['slug'])) ?>" target="_blank" class="btn btn-dark btn-sm ml-1"><i class="fa fa-linkedin"></i></a>
                                                    </div>
                                                </div>
                                                <i class="fa fa-quote-right" style="position: absolute; bottom: 30px; right: 30px; font-size: 60px; color: rgba(188, 147, 85, 0.2);"></i>
                                            </div>
                                        <?php else: ?>
                                            <div class="blog-s2 <?= ($b['video_url'] ? 'video-holder' : '') ?>">
                                                <img src="<?= base_url($b['image']) ?>" alt="<?= $b['title'] ?>">
                                                <?php if($b['video_url']): ?>
                                                    <a href="<?= $b['video_url'] ?>" class="video-btn" data-type="iframe" target="_blank">
                                                        <i class="fa fa-play" aria-hidden="true"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <div style="padding: 30px 30px 0;">
                                                <ul class="post-meta">
                                                    <li><img src="https://ui-avatars.com/api/?name=<?= urlencode($b['author']) ?>&background=bc9355&color=fff" alt="" style="border-radius: 50%; width: 40px;"></li>
                                                    <li><a href="#">By <?= $b['author'] ?></a></li>
                                                    <li class="clr"><?= $b['category_name'] ?></li>
                                                    <li> <?= date('M d, Y', strtotime($b['date_published'])) ?></li>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(!$b['quote']): ?>
                                        <div class="blog-content-2" style="padding: 0 30px 30px;">
                                            <h2><?= $b['title'] ?></h2>
                                            <p><?= strip_tags(substr($b['description'], 0, 300)) ?>...</p>
                                            <div class="d-flex align-items-center mt-3">
                                                <a href="<?= site_url('blog_detail/'.$b['slug']) ?>" class="theme-btn btn-sm" style="padding: 8px 20px;">read more..</a>
                                                <div class="ml-auto">
                                                    <button onclick="copyToClipboard('<?= site_url('blog_detail/'.$b['slug']) ?>', this)" class="btn btn-light btn-sm" title="Copy Link" style="background: #f8f9fa;"><i class="fa fa-link"></i></button>
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(site_url('blog_detail/'.$b['slug'])) ?>" target="_blank" class="btn btn-light btn-sm ml-1" style="background: #f8f9fa;"><i class="fa fa-facebook"></i></a>
                                                    <a href="https://twitter.com/intent/tweet?url=<?= urlencode(site_url('blog_detail/'.$b['slug'])) ?>" target="_blank" class="btn btn-light btn-sm ml-1" style="background: #f8f9fa;"><i class="fa fa-twitter"></i></a>
                                                    <a href="https://api.whatsapp.com/send?text=<?= urlencode($b['title'] . ' ' . site_url('blog_detail/'.$b['slug'])) ?>" target="_blank" class="btn btn-light btn-sm ml-1" style="background: #f8f9fa;"><i class="fa fa-whatsapp"></i></a>
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(site_url('blog_detail/'.$b['slug'])) ?>" target="_blank" class="btn btn-light btn-sm ml-1" style="background: #f8f9fa;"><i class="fa fa-linkedin"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-info">No blog posts found.</div>
                        <?php endif; ?>

                        <!-- Pagination -->
                        <?php if(!empty($blogs) && !empty($pagination_links)): ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="pagination-wrapper pagination-wrapper-2">
                                        <?= $pagination_links ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                   </div>
               </div>
                <div class="col-lg-4 col-12">
                    <div class="blog-right-bar practice-details-area case-stadies-details-area">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="widget search-widget">
                                    <form action="<?= site_url('welcome/blog_search') ?>" method="GET">
                                        <div>
                                            <input type="text" name="keyword" class="form-control" placeholder="Search Post.." value="<?= isset($search_keyword) ? $search_keyword : '' ?>" required>
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
                                        <?php foreach($categories as $cat): ?>
                                            <li><a href="<?= site_url('blog/category/'.$cat['slug']) ?>"><?= $cat['name'] ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                              </div>
                             </div>
                             <div class="col-lg-12 col-md-6">
                                <div class="practice-section resent-section practice-catagory-item">
                                    <h3 class="text-left">Recent Case</h3>
                                    <div class="posts">
                                        <?php foreach($recent_cases as $rc): ?>
                                            <div class="post">
                                                <div class="img-holder">
                                                    <img src="<?= base_url($rc['image']) ?>" alt="<?= $rc['title'] ?>">
                                                </div>
                                                <div class="details">
                                                    <a href="<?= site_url('case_studies_details/'.$rc['slug']) ?>">
                                                        <p><?= substr($rc['title'], 0, 50) ?>...</p>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                             </div>
                           
                        </div>
                    </div>
                </div>
           </div>
       </div>
   </div>



