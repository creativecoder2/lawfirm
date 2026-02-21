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
   <div class="blog-page-area section-padding">
       <div class="container">
           <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="blog-left-bar">
                        <div class="blog-item">
                            <div class="blog-img">
                                <div class="blog-s2 <?= ($blog['video_url'] ? 'video-holder' : '') ?>">
                                    <img src="<?= base_url($blog['image']) ?>" alt="<?= $blog['title'] ?>">
                                    <?php if($blog['video_url']): ?>
                                        <a href="<?= $blog['video_url'] ?>" class="video-btn" data-type="iframe" target="_blank">
                                            <i class="fa fa-play" aria-hidden="true"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <ul class="post-meta">
                                    <li><img src="https://ui-avatars.com/api/?name=<?= urlencode($blog['author']) ?>&background=bc9355&color=fff" alt="" style="border-radius: 50%; width: 40px;"></li>
                                    <li><a href="#">By <?= $blog['author'] ?></a></li>
                                    <li class="clr"><?= $blog['category_name'] ?></li>
                                    <li> <?= date('M d, Y', strtotime($blog['date_published'])) ?></li>
                                </ul>
                            </div>
                            <div class="blog-content-2">
                                <h2><?= $blog['title'] ?></h2>
                                <div class="blog-description">
                                    <?= $blog['description'] ?>
                                </div>
                            </div>
                        </div>

                        <?php if($blog['quote']): ?>
                            <blockquote>
                                “<?= $blog['quote'] ?>”
                            </blockquote>
                        <?php endif; ?>

                        <div class="tag-share">
                            <div class="tag">
                                <ul>
                                    <?php if($blog['tags']): $tags = explode(',', $blog['tags']); foreach($tags as $t): ?>
                                        <li><a href="<?= site_url('blog/tag/'.urlencode(trim($t))) ?>"><?= trim($t) ?></a></li>
                                    <?php endforeach; endif; ?>
                                </ul>
                            </div>
                            <div class="share">
                                <ul>
                                    <?php 
                                    $current_url = current_url();
                                    $share_title = urlencode($blog['title']);
                                    ?>
                                    <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?= $current_url ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://twitter.com/intent/tweet?text=<?= $share_title ?>&url=<?= $current_url ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $current_url ?>&title=<?= $share_title ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="javascript:void(0)" onclick="window.print()"><i class="fa fa-print" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="author-box">
                            <div class="author-avatar">
                                <a href="#" target="_blank"><img src="https://ui-avatars.com/api/?name=<?= urlencode($blog['author']) ?>&background=bc9355&color=fff&size=100" alt="" style="border-radius: 50%;"></a>
                            </div>
                            <div class="author-content">
                                <a href="#" class="author-name"><?= $blog['author'] ?></a>
                                <p><?= !empty($blog['author_bio']) ? $blog['author_bio'] : 'Legal Expert and Author at '.($settings['company_name'] ?? 'Antigravity Law').'. Specializing in '.$blog['category_name'].' and dedicated to providing clear legal insights.' ?></p>
                                <div class="socials">
                                    <ul class="social-lnk">
                                        <?php 
                                        $has_author_links = false;
                                        if(!empty($blog['author_facebook'])) { echo '<li><a href="'.$blog['author_facebook'].'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>'; $has_author_links = true; }
                                        if(!empty($blog['author_twitter'])) { echo '<li><a href="'.$blog['author_twitter'].'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>'; $has_author_links = true; }
                                        if(!empty($blog['author_linkedin'])) { echo '<li><a href="'.$blog['author_linkedin'].'" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>'; $has_author_links = true; }
                                        if(!empty($blog['author_instagram'])) { echo '<li><a href="'.$blog['author_instagram'].'" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>'; $has_author_links = true; }

                                        if(!$has_author_links && !empty($settings['social_links'])): foreach($settings['social_links'] as $sl): ?>
                                            <li><a href="<?= $sl['link'] ?>" target="_blank"><i class="<?= $sl['icon'] ?>" aria-hidden="true"></i></a></li>
                                        <?php endforeach; endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- end author-box -->
                        <div class="more-posts">
                            <div class="previous-post">
                                <a href="<?= site_url('blog') ?>">
                                    <span class="post-control-link"><i class="fa fa-long-arrow-left"></i> Back to Blog</span>
                                </a>
                            </div>
                        </div> <!-- end more-posts -->
                        <div class="comments-area">
                            <div class="comments-section">
                                <h3 class="comments-title"><?= $comment_count ?> Comments</h3>
                                <ol class="comments">
                                    <?php 
                                    function render_comments($comments, $is_reply = false) {
                                        foreach($comments as $c): ?>
                                            <li class="comment <?= ($is_reply ? 'reply' : '') ?>" id="comment-<?= $c['id'] ?>">
                                                <div id="div-comment-<?= $c['id'] ?>">
                                                    <div class="comment-theme">
                                                        <div class="comment-image">
                                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($c['name']) ?>&background=bc9355&color=fff" alt="" style="border-radius: 50%;">
                                                        </div>
                                                    </div>
                                                    <div class="comment-main-area">
                                                        <div class="comment-wrapper">
                                                            <div class="comments-meta">
                                                                <div class="comments-reply">
                                                                    <a class="comment-reply-link reply-btn" href="#comment-form" data-id="<?= $c['id'] ?>" data-name="<?= $c['name'] ?>"><span class="comment-reply-link"><i class="fa fa-reply" aria-hidden="true"></i>Reply</span></a>
                                                                </div>
                                                                <h4><?= $c['name'] ?> 
                                                                    <?php if($c['is_approved'] == 0): ?>
                                                                        <span class="badge-waiting-approval">Waiting for approval</span>
                                                                    <?php endif; ?>
                                                                </h4>
                                                                <span class="comments-date">says <?= date('M d, Y', strtotime($c['created_at'])) ?> at <?= date('h:i A', strtotime($c['created_at'])) ?></span>
                                                            </div>
                                                            <div class="comment-area-sub">
                                                                <p><?= nl2br(htmlspecialchars($c['comment'])) ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if(!empty($c['replies'])): ?>
                                                    <ul class="children">
                                                        <?php render_comments($c['replies'], true); ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach;
                                    }
                                    
                                    if(!empty($comments)) {
                                        render_comments($comments);
                                    } else {
                                        echo '<p>No approved comments yet. Be the first to comment!</p>';
                                    }
                                    ?>
                                </ol>
                            </div> <!-- end comments-section -->
                            <div class="comment-respond">
                                <h3 class="comment-reply-title" id="comment-form-title">Leave a Comment</h3>
                                <form method="post" id="blog-comment-form" class="comment-form">
                                    <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">
                                    <input type="hidden" name="parent_id" id="parent_id" value="0">
                                    
                                    <div id="reply-to-alert" class="alert alert-info" style="display:none; padding: 10px; margin-bottom: 20px;">
                                        Replying to <strong id="reply-name"></strong>
                                        <button type="button" class="close" id="cancel-reply">&times;</button>
                                    </div>

                                    <div class="form-textarea">
                                        <textarea id="comment" name="comment" placeholder="Write Your Comments..." required></textarea>
                                    </div>
                                    <div class="form-inputs">
                                        <input placeholder="Name" type="text" name="name" required>
                                        <input placeholder="Email" type="email" name="email" required>
                                        <input placeholder="Website (Optional)" type="url" name="website">
                                    </div>
                                    <div class="form-submit">
                                        <button type="submit" class="theme-btn" id="submit-comment">Post Comment</button>
                                    </div>
                                </form>
                            </div>

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $('.reply-btn').on('click', function(e) {
                                        e.preventDefault();
                                        var parentId = $(this).data('id');
                                        var name = $(this).data('name');
                                        $('#parent_id').val(parentId);
                                        $('#reply-name').text(name);
                                        $('#reply-to-alert').show();
                                        $('#comment-form-title').text('Leave a Reply');
                                        $('html, body').animate({
                                            scrollTop: $("#blog-comment-form").offset().top - 100
                                        }, 500);
                                    });

                                    $('#cancel-reply').on('click', function() {
                                        $('#parent_id').val('0');
                                        $('#reply-to-alert').hide();
                                        $('#comment-form-title').text('Leave a Comment');
                                    });

                                    $('#blog-comment-form').on('submit', function(e) {
                                        e.preventDefault();
                                        var form = $(this);
                                        var btn = $('#submit-comment');
                                        
                                        btn.prop('disabled', true).text('Submitting...');

                                        $.ajax({
                                            url: '<?= site_url("welcome/add_blog_comment") ?>',
                                            type: 'POST',
                                            data: form.serialize(),
                                            dataType: 'json',
                                            success: function(response) {
                                                if (response.status === 'success') {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Success!',
                                                        text: response.message,
                                                        confirmButtonColor: '#bc9355'
                                                    }).then(() => {
                                                        location.reload();
                                                    });
                                                } else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Error',
                                                        text: response.message,
                                                        confirmButtonColor: '#bc9355'
                                                    });
                                                    btn.prop('disabled', false).text('Post Comment');
                                                }
                                            },
                                            error: function() {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: 'Something went wrong. Please try again later.'
                                                });
                                                btn.prop('disabled', false).text('Post Comment');
                                            }
                                        });
                                    });
                                });
                            </script>
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
                                    <h3 class="text-left">Recent Posts</h3>
                                    <div class="posts">
                                        <?php foreach($recent_blogs as $rb): ?>
                                            <div class="post">
                                                <div class="img-holder">
                                                    <img src="<?= base_url($rb['image']) ?>" alt="<?= $rb['title'] ?>">
                                                </div>
                                                <div class="details">
                                                    <a href="<?= site_url('blog_detail/'.$rb['slug']) ?>">
                                                        <p><?= substr($rb['title'], 0, 50) ?>...</p>
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
                                            <li><a href="<?= site_url('blog_detail/'.$img['slug']) ?>"><img src="<?= base_url($img['image']) ?>" alt="" style="width: 80px; height: 80px; object-fit: cover; margin: 2px;"></a></li>
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
    <!-- blog-area start -->



