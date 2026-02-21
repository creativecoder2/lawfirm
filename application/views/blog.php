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
                                <div class="blog-item <?= ($b['quote'] ? 'blog-item-2' : '') ?>">
                                    <div class="blog-img">
                                        <?php if($b['quote']): ?>
                                            <div class="blog-s2">
                                                <div class="blog-content-3">
                                                    <ul class="post-meta">
                                                        <li><img src="https://ui-avatars.com/api/?name=<?= urlencode($b['author']) ?>&background=bc9355&color=fff" alt="" style="border-radius: 50%; width: 40px;"></li>
                                                        <li><a href="#">By <?= $b['author'] ?></a></li>
                                                        <li class="clr"><?= $b['category_name'] ?></li>
                                                        <li> <?= date('M d, Y', strtotime($b['date_published'])) ?></li>
                                                    </ul>
                                                    <h2><?= $b['title'] ?></h2>
                                                    <p><?= strip_tags(substr($b['quote'], 0, 200)) ?>...</p>
                                                    <a href="<?= site_url('blog_detail/'.$b['slug']) ?>">read more..</a>
                                                </div>
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
                                            <ul class="post-meta">
                                                <li><img src="https://ui-avatars.com/api/?name=<?= urlencode($b['author']) ?>&background=bc9355&color=fff" alt="" style="border-radius: 50%; width: 40px;"></li>
                                                <li><a href="#">By <?= $b['author'] ?></a></li>
                                                <li class="clr"><?= $b['category_name'] ?></li>
                                                <li> <?= date('M d, Y', strtotime($b['date_published'])) ?></li>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(!$b['quote']): ?>
                                        <div class="blog-content-2">
                                            <h2><?= $b['title'] ?></h2>
                                            <p><?= strip_tags(substr($b['description'], 0, 300)) ?>...</p>
                                            <a href="<?= site_url('blog_detail/'.$b['slug']) ?>">read more..</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-info">No blog posts found.</div>
                        <?php endif; ?>

                        <!-- Pagination (Static for now if not needed, or simplified) -->
                        <div class="row">
                            <div class="col-12">
                                <div class="pagination-wrapper pagination-wrapper-2">
                                    <ul>
                                        <li><span>1</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
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
                             <div class="col-lg-12 col-md-6 col-12 col-g">
                                <div class="widget tag-widget">
                                    <h3>Tags</h3>
                                    <ul>
                                        <?php if(!empty($all_tags)): foreach(array_slice($all_tags, 0, 15) as $tag): ?>
                                            <li><a href="<?= site_url('blog/tag/'.urlencode($tag)) ?>"><?= $tag ?></a></li>
                                        <?php endforeach; else: ?>
                                            <li>No tags found</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                             </div>
                             <div class="col-lg-12 col-md-6 col-12">
                                <div class="widget instagram">
                                    <h3>Instagram Feed</h3>
                                    <ul class="d-flex flex-wrap">
                                        <?php 
                                        // Mock Instagram feed using latest blog images
                                        $insta_images = $this->db->select('image, slug')->limit(6)->order_by('id', 'DESC')->get('blogs')->result_array();
                                        foreach($insta_images as $img): ?>
                                            <li><a href="<?= site_url('blog-detail/'.$img['slug']) ?>"><img src="<?= base_url($img['image']) ?>" alt="" style="width: 80px; height: 80px; object-fit: cover; margin: 2px;"></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
       </div>
   </div>



