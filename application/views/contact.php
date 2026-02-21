<!-- .breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Contact</h2>
                        <ul>
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li><span>Contact</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
   <!-- .contact-page-area start -->
   <div class="contact-page-area section-padding">
       <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="contact-page-item">
                        <h2><?= isset($settings['contact_page_title']) ? $settings['contact_page_title'] : 'Our Contacts' ?></h2>
                        <?php if(!empty($settings['contact_page_text'])): ?>
                            <p><?= nl2br($settings['contact_page_text']) ?></p>
                        <?php endif; ?>
                        <div class="adress">
                            <h3>Address</h3>
                            <span><?= isset($settings['contact_address']) ? $settings['contact_address'] : '245 King Street, Victoria, Australia' ?></span>
                        </div>
                        <div class="phone">
                            <h3>Phone</h3>
                            <span><?= isset($settings['contact_phone']) ? $settings['contact_phone'] : '0-123-456-7890' ?></span>
                        </div>
                        <div class="email">
                            <h3>Email</h3>
                            <span><?= isset($settings['contact_email']) ? $settings['contact_email'] : 'sample@gmail.com' ?></span>
                        </div>
                        <?php if(!empty($settings['office_hours'])): ?>
                        <div class="adress">
                            <h3>Office Hours</h3>
                            <span><?= nl2br($settings['office_hours']) ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="contact-area contact-area-2 contact-area-3">
                        <h2>Quick Contact Form</h2>
                        <div class="contact-form">
                            <form id="contact-form-main">
                                <div class="half-col">
                                    <input type="text" name="name" id="c_name" class="form-control" placeholder="Your Name *">
                                </div>
                                <div class="half-col">
                                    <input type="email" name="email" id="c_email" class="form-control" placeholder="Your Email *">
                                </div>
                                <div class="half-col">
                                    <input type="text" name="phone" id="c_phone" class="form-control" placeholder="Your Phone">
                                </div>
                                <div class="half-col">
                                    <input type="text" name="address" id="c_address" class="form-control" placeholder="Your Address">
                                </div>
                                <div>
                                    <textarea class="form-control" name="message" id="c_message" placeholder="Your Message *" rows="5"></textarea>
                                </div>
                                <div class="submit-btn-wrapper">
                                    <button type="submit" class="theme-btn" id="contact-submit-btn">Send Message</button>
                                    <div id="contact-loader" style="display:none; margin-left: 15px; display:none;">
                                        <i class="fa fa-refresh fa-spin fa-2x"></i>
                                    </div>
                                </div>
                            </form>
                            <div id="contact-success" class="alert alert-success" style="display:none; margin-top:15px;"></div>
                            <div id="contact-error" class="alert alert-danger" style="display:none; margin-top:15px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-xs-12">
                    <div class="contact-map">
                        <?php 
                            $map_url = isset($settings['contact_map_url']) && !empty($settings['contact_map_url']) 
                                ? $settings['contact_map_url'] 
                                : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57763.58882182253!2d55.38442113562169!3d25.195692423227655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43496ad9c645%3A0xbde66e5084295162!2sDubai!5e0!3m2!1sen!2s!4v1540725271741';
                        ?>
                        <iframe src="<?= htmlspecialchars($map_url) ?>" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
   </div>
   <!-- .contact-page-area end -->

<script>
// Wait for everything including Footer's jQuery to be loaded
window.addEventListener('load', function() {
    document.getElementById('contact-form-main').addEventListener('submit', function(e) {
        e.preventDefault();
        var name    = document.getElementById('c_name').value.trim();
        var email   = document.getElementById('c_email').value.trim();
        var phone   = document.getElementById('c_phone').value.trim();
        var address = document.getElementById('c_address').value.trim();
        var message = document.getElementById('c_message').value.trim();

        if (!name || !email || !message) {
            document.getElementById('contact-error').style.display = 'block';
            document.getElementById('contact-error').innerText = 'Please fill all required fields (Name, Email, Message).';
            document.getElementById('contact-success').style.display = 'none';
            return;
        }

        var btn = document.getElementById('contact-submit-btn');
        btn.disabled = true;
        btn.innerText = 'Sending...';
        document.getElementById('contact-error').style.display = 'none';
        document.getElementById('contact-success').style.display = 'none';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= base_url("contact_submit") ?>', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function() {
            btn.disabled = false;
            btn.innerText = 'Send Message';
            try {
                var res = JSON.parse(xhr.responseText);
                if (res.status === 'success') {
                    document.getElementById('contact-form-main').reset();
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Message Sent!',
                            text: res.message,
                            confirmButtonColor: '#bc9355'
                        });
                    } else {
                        document.getElementById('contact-success').style.display = 'block';
                        document.getElementById('contact-success').innerText = res.message;
                    }
                } else {
                    document.getElementById('contact-error').style.display = 'block';
                    document.getElementById('contact-error').innerText = res.message;
                }
            } catch(err) {
                document.getElementById('contact-error').style.display = 'block';
                document.getElementById('contact-error').innerText = 'Something went wrong. Please try again.';
            }
        };
        xhr.onerror = function() {
            btn.disabled = false;
            btn.innerText = 'Send Message';
            document.getElementById('contact-error').style.display = 'block';
            document.getElementById('contact-error').innerText = 'Network error. Please try again.';
        };
        var params = 'name=' + encodeURIComponent(name)
                   + '&email=' + encodeURIComponent(email)
                   + '&phone=' + encodeURIComponent(phone)
                   + '&address=' + encodeURIComponent(address)
                   + '&message=' + encodeURIComponent(message);
        xhr.send(params);
    });
});
</script>
