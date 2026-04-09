<!-- .footer-area start -->
    <div class="footer-area">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-logo">
                            <a href="<?= base_url() ?>">
                                <img src="<?= base_url(isset($settings['site_logo']) ? $settings['site_logo'] : 'assets/images/logo/logo-2.png') ?>" alt="Logo">
                            </a>
                        </div>
                        <p><?= isset($settings['footer_about_text']) ? nl2br($settings['footer_about_text']) : 'Providing exceptional legal services with integrity and dedication.' ?></p>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-link">
                            <h3>Quick Link</h3>
                            <ul>
                                <?php if(isset($settings['footer_menus'])): foreach($settings['footer_menus'] as $menu): ?>
                                    <li><a href="<?= (strpos($menu['link'], 'http') === 0) ? $menu['link'] : base_url($menu['link']) ?>"><?= $menu['title'] ?></a></li>
                                <?php endforeach; endif; ?>
                                
                                <?php if(isset($settings['footer_pages'])): foreach($settings['footer_pages'] as $fpage): ?>
                                    <li><a href="<?= site_url('page/'.$fpage['slug']) ?>"><?= $fpage['title'] ?></a></li>
                                <?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-practice bd-0">
                            <h3>Practice Area</h3>
                            <ul>
                                <?php if(isset($settings['footer_practice'])): foreach($settings['footer_practice'] as $fp): ?>
                                    <li><a href="<?= site_url('practice/' . $fp['slug']) ?>"><?= $fp['title'] ?></a></li>
                                <?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget newsletter-widget">
                            <div class="widget-title">
                                <h3>Newsletter</h3>
                            </div>
                            <p><?= isset($settings['newsletter_description']) ? $settings['newsletter_description'] : 'Join our newsletter to stay updated with our latest insights and news.' ?></p>
                            <form id="newsletter-form">
                                <div class="input-1">
                                    <input type="email" name="email" class="form-control" placeholder="Email Address *" required>
                                </div>
                                <div class="submit clearfix">
                                    <button type="submit"><i class="fa fa-envelope-o" aria-hidden="true"></i></button>
                                </div>
                                <div id="newsletter-message" style="margin-top: 10px; font-size: 14px;"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-9 col-12">
                            <span><?= isset($settings['copyright_text']) ? $settings['copyright_text'] : '© '.date('Y').' LEGAL EAGLE Law Firm. All rights reserved' ?></span>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-3 col-12">
                            <ul class="d-flex">
                                <?php if(isset($settings['social_links'])): foreach($settings['social_links'] as $sl): ?>
                                    <li><a href="<?= $sl['link'] ?>" target="_blank"><i class="<?= $sl['icon'] ?>" aria-hidden="true"></i></a></li>
                                <?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .footer-area end -->

   
   <!-- All JavaScript files
================================================== -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <!-- Plugins for this template -->
    <script src="<?= base_url('assets/js/jquery-plugin-collection.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.slicknav.min.js') ?>"></script>
    <!-- Custom script for this template -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      new WOW().init();

      $(document).ready(function() {
          $('#newsletter-form').on('submit', function(e) {
              e.preventDefault();
              var form = $(this);
              var email = form.find('input[name="email"]').val();

              $.ajax({
                  url: '<?= site_url('welcome/subscribe') ?>',
                  type: 'POST',
                  data: {email: email},
                  dataType: 'json',
                  success: function(response) {
                      if (response.status === 'success') {
                          Swal.fire({
                              icon: 'success',
                              title: 'Subscription Successful!',
                              text: response.message,
                              confirmButtonColor: '#c29255'
                          });
                          form.trigger('reset');
                      } else {
                          Swal.fire({
                              icon: 'info',
                              title: 'Notice',
                              text: response.message,
                              confirmButtonColor: '#c29255'
                          });
                      }
                  },
                  error: function() {
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong. Please try again later.',
                      });
                  }
              });
          });
      });
    </script>
    <script>
    function copyToClipboard(text, btn) {
        const el = document.createElement('textarea');
        el.value = text;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        
        const originalHtml = btn.innerHTML;
        const width = btn.offsetWidth;
        btn.style.width = width + 'px';
        btn.innerHTML = '<i class="fa fa-check"></i>';
        btn.classList.add('btn-success');
        
        setTimeout(() => {
            btn.innerHTML = originalHtml;
            btn.classList.remove('btn-success');
            btn.style.width = '';
        }, 2000);
    }
    </script>

    
    
    
    <style>
    /* Full Screen Search Overlay */
    .search-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(26, 21, 14, 0.98);
        backdrop-filter: blur(10px);
        z-index: 99999;
        display: none;
        opacity: 0;
        transition: opacity 0.4s ease;
        overflow-y: auto;
    }
    .search-overlay.active {
        display: block;
        opacity: 1;
    }
    .search-overlay-close {
        position: absolute;
        top: 30px;
        right: 40px;
        cursor: pointer;
        z-index: 100000;
        transition: transform 0.3s;
    }
    .search-overlay-close:hover {
        transform: rotate(90deg);
    }
    .close-icon {
        font-size: 60px;
        color: #d0a15e;
        line-height: 1;
        font-weight: 300;
    }
    .search-overlay-content {
        margin-top: 15vh;
        padding-bottom: 50px;
    }
    .search-form-wrapper {
        position: relative;
    }
    .search-form {
        position: relative;
        border-bottom: 2px solid rgba(208, 161, 94, 0.3);
        margin-bottom: 40px;
    }
    .search-form input {
        width: 100%;
        background: transparent;
        border: none;
        color: #fff;
        font-size: 40px;
        padding: 20px 60px 20px 0;
        font-weight: 300;
        outline: none !important;
    }
    .search-form input::placeholder {
        color: rgba(255,255,255,0.2);
    }
    .search-form button {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: #d0a15e;
        font-size: 30px;
        cursor: pointer;
    }
    .search-results-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    .overlay-search-item {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 12px;
        padding: 15px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        text-decoration: none !important;
    }
    .overlay-search-item:hover {
        background: rgba(208, 161, 94, 0.1);
        border-color: #d0a15e;
        transform: translateY(-5px);
    }
    .overlay-search-item img {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
        margin-right: 20px;
    }
    .overlay-search-info span {
        font-size: 10px;
        color: #d0a15e;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1px;
        display: block;
        margin-bottom: 5px;
    }
    .overlay-search-info h4 {
        margin: 0;
        font-size: 16px;
        color: #fff;
        font-weight: 500;
        line-height: 1.4;
    }
    .overlay-no-results {
        text-align: center;
        color: rgba(255,255,255,0.4);
        font-size: 20px;
        width: 100%;
        padding: 40px;
    }
    .overlay-loading {
        text-align: center;
        width: 100%;
        padding: 40px;
        color: #d0a15e;
    }
    </style>

    <script>
    $(document).ready(function() {
        const overlay = $('.search-overlay');
        const trigger = $('.search-overlay-trigger');
        const close = $('.search-overlay-close');
        const input = $('#overlay_search_input');
        const results = $('#overlay_search_results');
        let searchTimer;

        trigger.on('click', function() {
            overlay.addClass('active').fadeIn(300);
            setTimeout(() => input.focus(), 350);
            $('body').css('overflow', 'hidden');
        });

        close.on('click', function() {
            overlay.fadeOut(300, function() {
                $(this).removeClass('active');
                $('body').css('overflow', 'auto');
                input.val('');
                results.empty();
            });
        });

        input.on('input', function() {
            clearTimeout(searchTimer);
            const keyword = $(this).val().trim();

            if (keyword.length < 2) {
                results.empty();
                return;
            }

            results.html('<div class="overlay-loading"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');

            searchTimer = setTimeout(function() {
                $.ajax({
                    url: '<?= site_url("welcome/ajax_search") ?>',
                    type: 'GET',
                    data: { keyword: keyword },
                    dataType: 'json',
                    success: function(data) {
                        results.empty();
                        if (data.length > 0) {
                            data.forEach(item => {
                                results.append(`
                                    <a href="${item.url}" class="overlay-search-item">
                                        <img src="${item.image}" alt="">
                                        <div class="overlay-search-info">
                                            <span>${item.type}</span>
                                            <h4>${item.title}</h4>
                                        </div>
                                    </a>
                                `);
                            });
                        } else {
                            results.html('<div class="overlay-no-results">No matches found for "' + keyword + '"</div>');
                        }
                    }
                });
            }, 200);
        });

        // Close on escape key
        $(document).keyup(function(e) {
            if (e.key === "Escape") close.click();
        });
    });
    </script>

<?php
// Custom Footer Code from SEO Settings
$seo_custom_footer = $settings['seo_custom_footer'] ?? '';
$seo_gtm_footer = $settings['seo_gtm_id'] ?? '';
if($seo_custom_footer) echo $seo_custom_footer;
if($seo_gtm_footer): ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= $seo_gtm_footer ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>

    <!-- AI Chatbot Assistant -->
    <?php if(($settings['chatbot_status'] ?? 'enabled') == 'enabled'): ?>
    <div id="legal-chatbot-wrapper">
        <div id="chatbot-bubble">
            <i class="fa fa-comments"></i>
            <span class="bubble-notif">1</span>
        </div>

        <div id="chatbot-tooltip">
            <span id="close-tooltip">&times;</span>
            Hi! I am your Legal Assistant. How can I help you? ⚖️
        </div>

        <div id="chatbot-window">
            <div class="chatbot-header">
                <div class="bot-info">
                    <img src="<?= base_url(isset($settings['site_logo']) ? $settings['site_logo'] : 'assets/images/logo/logo-2.png') ?>" alt="Bot">
                    <div>
                        <h4>Legal Assistant</h4>
                        <span class="status-online">Online</span>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <button id="reset-chatbot" title="Reset Chat"><i class="fa fa-rotate-left"></i></button>
                    <button id="close-chatbot">&times;</button>
                </div>
            </div>

            <div id="chatbot-lead-form">
                <div class="lead-form-header">
                    <h3>Start Your Consultation</h3>
                    <p>Please provide some details to begin.</p>
                </div>
                <form id="chatbot-details-form">
                    <div class="form-group-custom">
                        <input type="text" name="chat_name" id="chat_name" placeholder="Full Name *" required>
                    </div>
                    <div class="form-group-custom">
                        <input type="text" name="chat_phone" id="chat_phone" placeholder="Phone Number *" required>
                    </div>
                    <div class="form-group-custom">
                        <select name="chat_category" id="chat_category" required>
                            <option value="" disabled selected>Select Category *</option>
                            <?php if(!empty($practice_areas)): foreach($practice_areas as $pa): ?>
                                <option value="<?= $pa['id'] ?>"><?= $pa['title'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="form-group-custom">
                        <input type="text" name="chat_city" id="chat_city" placeholder="City *" required>
                    </div>
                    <button type="submit" class="theme-btn chat-submit-btn">Start Chat</button>
                    <div id="lead-error" style="color: #e74c3c; font-size: 12px; margin-top: 10px; display: none; text-align: center;"></div>
                </form>
            </div>

            <div id="chatbot-main-ui">
                <div id="chatbot-messages">
                    <div class="msg-bot">Hello! Welcome to <b>Legal Eagle Law</b>. I am your Legal Assistant. How can I help you today?</div>
                </div>
                <div class="chatbot-input">
                    <input type="text" id="chat-input-field" placeholder="Type your question...">
                    <button id="send-chat-msg"><i class="fa fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
    </div>

    <style>
        #legal-chatbot-wrapper { position: fixed; bottom: 30px; right: 30px; z-index: 999999; font-family: 'Inter', sans-serif; }
        #chatbot-bubble { 
            width: 60px; height: 60px; background: #bc9355; border-radius: 50%; 
            display: flex; align-items: center; justify-content: center; color: #fff; font-size: 28px; 
            cursor: pointer; box-shadow: 0 10px 25px rgba(188,147,85,0.4); 
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
            position: relative;
            animation: pulse-ring 2s infinite;
        }
        #chatbot-bubble i { animation: shake 5s infinite; }
        #chatbot-bubble:hover { transform: scale(1.1); animation: none; }
        
        @keyframes pulse-ring {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(188,147,85, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 15px rgba(188,147,85, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(188,147,85, 0); }
        }
        @keyframes shake {
            0%, 90%, 100% { transform: rotate(0); }
            92% { transform: rotate(15deg); }
            94% { transform: rotate(-15deg); }
            96% { transform: rotate(10deg); }
            98% { transform: rotate(-10deg); }
        }
        .bubble-notif { position: absolute; top: -5px; right: -5px; background: #ff4757; color: #fff; font-size: 10px; padding: 2px 6px; border-radius: 10px; border: 2px solid #fff; font-weight: 700; }
        
        #chatbot-window { 
            position: fixed; bottom: 90px; right: 30px; width: 380px; height: 500px; max-height: calc(100vh - 120px);
            background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); 
            display: none; flex-direction: column; z-index: 99999; overflow: hidden; 
            font-family: 'Inter', sans-serif;
            border: 1px solid rgba(0,0,0,0.05); 
        }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        
        .chatbot-header { background: #bc9355; color: #fff; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; }
        .bot-info { display: flex; align-items: center; gap: 12px; }
        .bot-info img { width: 35px; height: 35px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.3); }
        .bot-info h4 { margin: 0; font-size: 15px; font-weight: 600; }
        .status-online { font-size: 10px; display: flex; align-items: center; gap: 4px; opacity: 0.9; }
        .status-online::before { content: ''; width: 6px; height: 6px; background: #2ecc40; border-radius: 50%; }
        #close-chatbot { background: none; border: none; color: #fff; font-size: 24px; cursor: pointer; opacity: 0.7; }
        #close-chatbot:hover { opacity: 1; }
        
        #reset-chatbot { background: none; border: none; color: #fff; font-size: 16px; cursor: pointer; opacity: 0.7; transition: transform 0.3s; padding: 5px; }
        #reset-chatbot:hover { opacity: 1; transform: rotate(-180deg); }
        
        #chatbot-messages { flex: 1; padding: 20px; overflow-y: auto; overflow-x: hidden; background: #fafafa; display: flex; flex-direction: column; gap: 10px; }
        .msg-bot, .msg-user { 
            padding: 12px 16px; 
            border-radius: 18px; 
            line-height: 1.5; 
            font-size: 14px; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;
            max-width: 85%;
            white-space: pre-wrap;
        }
        .msg-bot { background: #fff; color: #444; align-self: flex-start; border-bottom-left-radius: 2px; box-shadow: 0 2px 5px rgba(0,0,0,0.03); border: 1px solid #eee; }
        .msg-user { background: #bc9355; color: #fff; align-self: flex-end; border-bottom-right-radius: 2px; box-shadow: 0 4px 10px rgba(188,147,85,0.2); }
        
        .quick-suggests { margin-top: 10px; display: flex; flex-wrap: wrap; gap: 6px; }
        .quick-suggests button { background: rgba(188,147,85,0.1); border: 1px solid rgba(188,147,85,0.3); color: #bc9355; font-size: 11px; padding: 4px 10px; border-radius: 15px; cursor: pointer; transition: all 0.2s; }
        .quick-suggests button:hover { background: #bc9355; color: #fff; }
        
        .bot-link-btn { display: inline-block; background: #bc9355; color: #fff !important; padding: 6px 14px; border-radius: 6px; font-size: 12px; margin-top: 8px; text-decoration: none; font-weight: 600; text-align: center; width: 100%; transition: opacity 0.2s; }
        .bot-link-btn:hover { opacity: 0.9; }
        
        .chatbot-input { padding: 15px; background: #fff; border-top: 1px solid #eee; display: flex; gap: 10px; }
        .chatbot-input input { flex: 1; border: 1px solid #ddd; border-radius: 25px; padding: 10px 15px; font-size: 14px; outline: none; transition: border-color 0.3s; }
        .chatbot-input input:focus { border-color: #bc9355; }
        .chatbot-input button { background: #bc9355; border: none; width: 40px; height: 40px; border-radius: 50%; color: #fff; cursor: pointer; transition: transform 0.2s; }
        .chatbot-input button:hover { transform: scale(1.05); }
        
        /* Mobile adjustment */
        @media (max-width: 480px) {
            #chatbot-window { width: calc(100vw - 40px); height: 80vh; bottom: 70px; right: 20px; }
            #chatbot-bubble { width: 50px; height: 50px; font-size: 22px; }
        }

        #chatbot-lead-form { 
            display: none; padding: 25px; flex: 1; overflow-y: auto; background: #fff; 
        }
        #chatbot-main-ui { 
            display: none; flex-direction: column; flex: 1; height: calc(100% - 65px);
        }
        .lead-form-header { text-align: center; margin-bottom: 20px; }
        .lead-form-header h3 { color: #333; margin-bottom: 8px; font-size: 18px; font-weight: 700; }
        .lead-form-header p { color: #777; font-size: 13px; }
        
        .form-group-custom { margin-bottom: 12px; }
        .form-group-custom input, .form-group-custom select {
            height: 45px; border-radius: 8px; border: 1px solid #ddd; width: 100%; padding: 10px 15px; font-size: 14px;
        }
        .form-group-custom input:focus, .form-group-custom select:focus {
            border-color: #bc9355; outline: none; box-shadow: 0 0 0 2px rgba(188,147,85,0.1);
        }
        .chat-submit-btn { width: 100%; height: 45px; border-radius: 8px; font-weight: 600; cursor: pointer; }

        #chatbot-tooltip {
            position: absolute;
            bottom: 80px;
            right: 0;
            width: 220px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 12px 15px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border: 1px solid rgba(188, 147, 85, 0.2);
            font-size: 13px;
            color: #444;
            display: none;
            line-height: 1.4;
            animation: slideUp 0.3s ease-out;
            z-index: 10000;
        }
        #chatbot-tooltip::after {
            content: '';
            position: absolute;
            bottom: -8px;
            right: 25px;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-top: 8px solid #fff;
        }
        #close-tooltip {
            position: absolute;
            top: 2px;
            right: 6px;
            font-size: 16px;
            cursor: pointer;
            color: #999;
        }
        #close-tooltip:hover { color: #333; }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const bubble = document.getElementById('chatbot-bubble');
            const windowEl = document.getElementById('chatbot-window');
            const closeBtn = document.getElementById('close-chatbot');
            const inputField = document.getElementById('chat-input-field');
            const sendBtn = document.getElementById('send-chat-msg');
            const messagesWrap = document.getElementById('chatbot-messages');
            
            const leadFormDiv = document.getElementById('chatbot-lead-form');
            const mainChatDiv = document.getElementById('chatbot-main-ui');
            const detailForm = document.getElementById('chatbot-details-form');
            const resetBtn = document.getElementById('reset-chatbot');

            if (!bubble || !windowEl) return;

            // State management
            let isSubmitted = localStorage.getItem('chatbot_lead_submitted');
            
            function toggleUI(submitted) {
                if(submitted) {
                    if (leadFormDiv) leadFormDiv.style.display = 'none';
                    if (mainChatDiv) mainChatDiv.style.display = 'flex';
                } else {
                    if (leadFormDiv) leadFormDiv.style.display = 'block';
                    if (mainChatDiv) mainChatDiv.style.display = 'none';
                }
            }

            toggleUI(isSubmitted);

            // History Management
            function saveChatHistory(msg, isBot, links = []) {
                let history = JSON.parse(localStorage.getItem('chatbot_history') || '[]');
                history.push({ msg, isBot, links });
                localStorage.setItem('chatbot_history', JSON.stringify(history));
            }

            function loadChatHistory() {
                const history = JSON.parse(localStorage.getItem('chatbot_history') || '[]');
                if (history.length > 0) {
                    // Clear initial welcome if history exists
                    if (messagesWrap) messagesWrap.innerHTML = '';
                    addChatTimestamp();
                    history.forEach(item => {
                        appendMsg(item.msg, item.isBot, item.links, false); // false to avoid double saving
                    });
                }
            }

            // Auto-open logic
            setTimeout(() => {
                windowEl.style.display = 'flex';
                const notif = document.querySelector('.bubble-notif');
                if (notif) notif.style.display = 'none';
                loadChatHistory();
            }, 1000);

            // Add Chat Start Time
            function addChatTimestamp() {
                if (!document.getElementById('chat-start-time')) {
                    const now = new Date();
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
                    const timeStr = now.toLocaleDateString('en-US', options);
                    
                    const timeDiv = document.createElement('div');
                    timeDiv.id = 'chat-start-time';
                    timeDiv.style.textAlign = 'center';
                    timeDiv.style.fontSize = '11px';
                    timeDiv.style.color = '#999';
                    timeDiv.style.margin = '10px 0 20px 0';
                    timeDiv.style.padding = '5px 10px';
                    timeDiv.style.background = 'rgba(0,0,0,0.03)';
                    timeDiv.style.borderRadius = '20px';
                    timeDiv.style.display = 'inline-block';
                    timeDiv.style.width = 'fit-content';
                    timeDiv.style.alignSelf = 'center';
                    timeDiv.innerText = `Chat started on ${timeStr}`;
                    
                    if (messagesWrap) messagesWrap.prepend(timeDiv);
                }
            }
            addChatTimestamp();

            function closeChat() {
                windowEl.style.display = 'none';
                // Show tooltip after 10 seconds of closing
                setTimeout(() => {
                    if (windowEl.style.display === 'none') {
                        const tooltip = document.getElementById('chatbot-tooltip');
                        if (tooltip) tooltip.style.display = 'block';
                    }
                }, 10000);
            }

            bubble.onclick = () => {
                if (windowEl.style.display === 'flex') {
                    closeChat();
                } else {
                    windowEl.style.display = 'flex';
                    const tooltip = document.getElementById('chatbot-tooltip');
                    if (tooltip) tooltip.style.display = 'none';
                    const notif = document.querySelector('.bubble-notif');
                    if (notif) notif.style.display = 'none';
                    if(isSubmitted && inputField) inputField.focus();
                }
            };

            if (closeBtn) closeBtn.onclick = closeChat;

            const closeTooltipBtn = document.getElementById('close-tooltip');
            if (closeTooltipBtn) {
                closeTooltipBtn.onclick = function(e) {
                    e.stopPropagation();
                    this.parentElement.style.display = 'none';
                };
            }
            
            // Clicking the tooltip also opens the chat
            const tooltipEl = document.getElementById('chatbot-tooltip');
            if (tooltipEl) {
                tooltipEl.onclick = function(e) {
                    if (e.target.id !== 'close-tooltip') {
                        this.style.display = 'none';
                        windowEl.style.display = 'flex';
                        if(isSubmitted && inputField) inputField.focus();
                    }
                };
            }

            // Lead Form Submission
            if (detailForm) {
                detailForm.onsubmit = (e) => {
                    e.preventDefault();
                    const submitBtn = detailForm.querySelector('button');
                    const errorDiv = document.getElementById('lead-error');
                    
                    submitBtn.disabled = true;
                    submitBtn.innerText = 'Connecting...';
                    errorDiv.style.display = 'none';

                    jQuery.ajax({
                        url: '<?= site_url("welcome/chatbot_lead_submit") ?>',
                        type: 'POST',
                        data: {
                            name: document.getElementById('chat_name').value,
                            phone: document.getElementById('chat_phone').value,
                            category_id: document.getElementById('chat_category').value,
                            city: document.getElementById('chat_city').value
                        },
                        dataType: 'json',
                        success: function(res) {
                            if(res.status === 'success') {
                                localStorage.setItem('chatbot_lead_submitted', 'true');
                                toggleUI(true);
                                if (inputField) setTimeout(() => inputField.focus(), 100);
                            } else {
                                submitBtn.disabled = false;
                                submitBtn.innerText = 'Start Chat';
                                errorDiv.innerText = res.message || 'Error occurred.';
                                errorDiv.style.display = 'block';
                            }
                        },
                        error: function() {
                            submitBtn.disabled = false;
                            submitBtn.innerText = 'Start Chat';
                            errorDiv.innerText = 'Server error. Please try again.';
                            errorDiv.style.display = 'block';
                        }
                    });
                };
            }

            window.sendQuickMsg = (msg) => {
                if (inputField) {
                    inputField.value = msg;
                    sendMsg();
                }
            };

            function appendMsg(msg, isBot, links = [], shouldSave = true) {
                if (!messagesWrap) return;
                const div = document.createElement('div');
                div.className = isBot ? 'msg-bot' : 'msg-user';
                
                // Markdown bold and newlines helper
                let html = msg.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');
                
                if(links && links.length > 0) {
                    html += '<div style="margin-top:10px; display:flex; flex-direction:column; gap:5px;">';
                    links.forEach(l => {
                        html += `<a href="${l.url}" target="_blank" class="bot-link-btn">${l.title}</a>`;
                    });
                    html += '</div>';
                }
                div.innerHTML = html;
                messagesWrap.appendChild(div);
                messagesWrap.scrollTop = messagesWrap.scrollHeight;

                if (shouldSave) {
                    saveChatHistory(msg, isBot, links);
                }
            }

            function sendMsg() {
                if (!inputField) return;
                const val = inputField.value.trim();
                if(!val) return;
                
                appendMsg(val, false);
                inputField.value = '';

                // Show typing indicator
                const typing = document.createElement('div');
                typing.className = 'msg-bot';
                typing.innerHTML = '<i class="fa fa-spinner fa-spin"></i> assistant is thinking...';
                if (messagesWrap) {
                    messagesWrap.appendChild(typing);
                    messagesWrap.scrollTop = messagesWrap.scrollHeight;
                }

                // Call Backend
                jQuery.ajax({
                    url: '<?= site_url("welcome/chat_query") ?>',
                    type: 'POST',
                    data: { message: val },
                    dataType: 'json',
                    success: function(res) {
                        typing.remove();
                        if(res.status === 'success') {
                            appendMsg(res.message, true, res.links);
                        } else {
                            appendMsg("Sorry, I'm having trouble connecting to my knowledge base.", true);
                        }
                    },
                    error: function() {
                        typing.remove();
                        appendMsg("Error communicating with server.", true);
                    }
                });
            }

            if (sendBtn) sendBtn.onclick = sendMsg;
            if (inputField) inputField.onkeypress = (e) => { if(e.key === 'Enter') sendMsg(); };

            // Reset Chat Logic
            if (resetBtn) {
                resetBtn.onclick = () => {
                    if (confirm("Are you sure you want to reset the chat? This will clear your history.")) {
                        localStorage.removeItem('chatbot_lead_submitted');
                        localStorage.removeItem('chatbot_history');
                        isSubmitted = false;
                        if (messagesWrap) {
                            messagesWrap.innerHTML = '<div class="msg-bot">Hello! Welcome to <b>Legal Eagle Law</b>. I am your Legal Assistant. How can I help you today?</div>';
                            addChatTimestamp();
                        }
                        toggleUI(false);
                    }
                };
            }
        });
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- AI Chatbot Assistant End -->
    <?php endif; ?>
    
    <!-- WhatsApp Floating Button -->
    <?php if(($settings['whatsapp_status'] ?? 'enabled') == 'enabled'): ?>
    <a href="https://wa.me/923224490008" class="whatsapp-float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>
    <?php endif; ?>

    <style>
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 30px;
            right: 105px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 33px;
            box-shadow: 2px 2px 15px rgba(0,0,0,0.2);
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none !important;
            transition: all 0.3s ease;
            animation: pulse-whatsapp 2s infinite;
        }
        .whatsapp-float:hover {
            background-color: #128c7e;
            transform: scale(1.1);
            color: #fff;
        }
        @keyframes pulse-whatsapp {
            0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }
        @media screen and (max-width: 767px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 30px;
                right: 85px;
                font-size: 25px;
            }
        }
    </style>
    <!-- End WhatsApp Floating Button -->
</body>

</html>



