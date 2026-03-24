<!-- .breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Case Stadies</h2>
                        <ul>
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li><span>Resent Case Studies</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- case studiess area start -->
    <div class="studies-area section-padding studies-area-2">
        <div class="container">
            <div class="col-l2">
                <div class="section-title-1 text-center">
                    <span>Here Our Best Work</span>
                    <h2>Our Resent Case Studies</h2>
                </div>
            </div>
            <div class="col-12">
                <div class="studies-menu text-center">
                    <button class="active btn-filter" data-filter="*">All</button>
                    <?php if(!empty($categories)): foreach($categories as $cat): ?>
                        <button class="btn-filter" data-filter=".<?= $cat['slug'] ?>"><?= $cat['name'] ?></button>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <div class="row grid">
                <?php $this->load->view('case_studies_partial', ['case_studies' => $case_studies]); ?>
            </div>
            
            <?php if(isset($has_more) && $has_more): ?>
            <div class="row">
                <div class="col-12 text-center" style="margin-top: 50px;">
                    <div class="btn-style">
                        <a href="javascript:void(0)" id="load-more-btn" data-offset="4">Load More</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- case studiess area end -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        var $grid = $('.grid').isotope({
            itemSelector: '.grid-item',
            layoutMode: 'fitRows'
        });

        // Sync with existing Isotope category buttons
        $('.studies-menu').on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $(this).addClass('active').siblings().removeClass('active');
            $grid.isotope({ filter: filterValue });
        });

        // Load More Functionality
        $('#load-more-btn').on('click', function() {
            var btn = $(this);
            var offset = btn.attr('data-offset');
            
            btn.text('Loading...');
            
            $.ajax({
                url: '<?= base_url("welcome/get_more_cases") ?>',
                type: 'GET',
                data: { offset: offset },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        var $items = $(response.html);
                        
                        // Wait for images to load before adding to Isotope
                        $items.imagesLoaded(function() {
                            $grid.append($items).isotope('appended', $items);
                            
                            // Update offset
                            btn.attr('data-offset', parseInt(offset) + 4);
                            btn.text('Load More');
                            
                            if (!response.has_more) {
                                btn.parent().parent().fadeOut();
                            }
                        });
                    } else {
                        btn.parent().parent().fadeOut();
                    }
                },
                error: function() {
                    btn.text('Load More');
                    alert('Error loading cases. Please try again.');
                }
            });
        });
    });
    </script>



