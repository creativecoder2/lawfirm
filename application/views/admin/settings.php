<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Site Settings
            <small>Manage global site settings</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">General Settings</h3>
                    </div>
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                    <?php endif; ?>
                    <form role="form" method="post" action="<?= base_url('admin/settings') ?>" enctype="multipart/form-data">
                        <div class="box-body">
                            <!-- Contact Info -->
                            <div class="form-group">
                                <label>Site Title</label>
                                <input type="text" class="form-control" name="site_title" value="<?= isset($settings['site_title']) ? $settings['site_title'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Site Logo</label>
                                <?php if(isset($settings['site_logo']) && !empty($settings['site_logo'])): ?>
                                    <div class="mb-2">
                                        <img src="<?= base_url($settings['site_logo']) ?>" class="img-thumbnail" style="max-height: 80px; background: #333;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" name="site_logo">
                                <small class="text-muted">Recommended: PNG with transparency. Size: 180x50px.</small>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="contact_phone" value="<?= isset($settings['contact_phone']) ? $settings['contact_phone'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="contact_email" value="<?= isset($settings['contact_email']) ? $settings['contact_email'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="contact_address" value="<?= isset($settings['contact_address']) ? $settings['contact_address'] : '' ?>">
                                <div class="form-group">
                                <label>Footer About Text</label>
                                <textarea class="form-control" name="footer_about_text" rows="3"><?= isset($settings['footer_about_text']) ? $settings['footer_about_text'] : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Newsletter Description</label>
                                <textarea class="form-control" name="newsletter_description" rows="2"><?= isset($settings['newsletter_description']) ? $settings['newsletter_description'] : '' ?></textarea>
                                <small class="text-muted">Short text displayed under the Newsletter heading in the footer.</small>
                            </div>
                             <div class="form-group">
                                <label>Copyright Text</label>
                                <input type="text" class="form-control" name="copyright_text" value="<?= isset($settings['copyright_text']) ? $settings['copyright_text'] : '' ?>">
                                <small class="text-muted">e.g. © 2026 LEGAL EAGLE Law Firm. All rights reserved.</small>
                            </div>
                            <div class="form-group">
                                <label>Office Hours (Header)</label>
                                <input type="text" class="form-control" name="office_hours" value="<?= isset($settings['office_hours']) ? $settings['office_hours'] : '' ?>" placeholder="Mon - Thurs : 08.00 am - 09.00 pm">
                            </div>
                            <hr>
                            <h4 class="box-title" style="margin-bottom: 20px;">Contact Section (Home/About)</h4>
                            <div class="form-group">
                                <label>Contact Section Title</label>
                                <input type="text" class="form-control" name="contact_section_title" value="<?= isset($settings['contact_section_title']) ? $settings['contact_section_title'] : '' ?>" placeholder="Are You Interest To Contact With Us?">
                            </div>
                            <div class="form-group">
                                <label>Detailed Office Hours (Contact Section)</label>
                                <textarea class="form-control" name="contact_section_hours" rows="4" placeholder="Mon – Thur: 8:00 AM – 9:00 PM&#10;Friday: 2:00 PM – 6:00 PM&#10;Saturday: 8:AM – 9:30 PM&#10;ONLINE APPOINTMENT: 24/7"><?= isset($settings['contact_section_hours']) ? $settings['contact_section_hours'] : '' ?></textarea>
                                <small class="text-muted">Use new lines for each timing entry.</small>
                            </div>
                        </div>

                            <!-- About Section -->
                            <div class="form-group">
                                <label>About Title</label>
                                <input type="text" class="form-control" name="about_title" value="<?= isset($settings['about_title']) ? $settings['about_title'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>About Text</label>
                                <textarea class="form-control editor" name="about_text"><?= isset($settings['about_text']) ? $settings['about_text'] : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>About Image</label>
                                <?php if(isset($settings['about_image']) && !empty($settings['about_image'])): ?>
                                    <div class="mb-2">
                                        <img src="<?= base_url($settings['about_image']) ?>" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" name="about_image">
                                <small class="text-muted">Allowed types: jpg, png, jpeg. Max size: 2MB.</small>
                            </div>
                            <div class="form-group">
                                <label>Signature Image</label>
                                <?php if(isset($settings['signature_image']) && !empty($settings['signature_image'])): ?>
                                    <div class="mb-2">
                                        <img src="<?= base_url($settings['signature_image']) ?>" class="img-thumbnail" style="max-height: 100px; background: #f8f9fa;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" name="signature_image">
                                <small class="text-muted">Tailored for signature png/jpg. Recommended size: 200x80px.</small>
                            </div>
                             <div class="form-group">
                                <label>Video URL</label>
                                <input type="text" class="form-control" name="video_url" value="<?= isset($settings['video_url']) ? $settings['video_url'] : '' ?>">
                            </div>

                            <!-- Consultation Section -->
                            <div class="form-group">
                                <label>Consultation Title</label>
                                <input type="text" class="form-control" name="consultation_title" value="<?= isset($settings['consultation_title']) ? $settings['consultation_title'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Consultation Text</label>
                                <textarea class="form-control editor" name="consultation_text"><?= isset($settings['consultation_text']) ? $settings['consultation_text'] : '' ?></textarea>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
