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
                                <label>Video URL <small class="text-muted">(YouTube/Vimeo Embed Link)</small></label>
                                <input type="text" class="form-control" name="video_url" value="<?= isset($settings['video_url']) ? $settings['video_url'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>OR Upload Video File</label>
                                <?php if(isset($settings['video_file']) && !empty($settings['video_file'])): ?>
                                    <div class="mb-2">
                                        <i class="fa fa-video-camera"></i> Current Video: <code><?= basename($settings['video_file']) ?></code>
                                        <a href="<?= base_url($settings['video_file']) ?>" target="_blank" class="btn btn-xs btn-default">View</a>
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" name="video_file">
                                <small class="text-muted">Allowed types: mp4, webm, ogg. Max size: 20MB.</small>
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

                            <hr>
                            <h4 class="box-title" style="margin-bottom: 20px;">Practice Area Widget</h4>
                            <div class="form-group">
                                <label>Years of Experience <small class="text-muted">(Number shown in the big widget)</small></label>
                                <input type="number" class="form-control" name="experience_years" value="<?= isset($settings['experience_years']) ? $settings['experience_years'] : '25' ?>" placeholder="25">
                            </div>
                            <div class="form-group">
                                <label>Experience Widget Text</label>
                                <input type="text" class="form-control" name="experience_text" value="<?= isset($settings['experience_text']) ? $settings['experience_text'] : 'Years of Experience In This Field' ?>" placeholder="Years of Experience In This Field">
                            </div>

                            <hr>
                            <h4 class="box-title" style="margin-bottom: 20px;">Contact Page Content</h4>
                            <div class="form-group">
                                <label>Contact Section Heading</label>
                                <input type="text" class="form-control" name="contact_page_title" value="<?= isset($settings['contact_page_title']) ? $settings['contact_page_title'] : 'Our Contacts' ?>" placeholder="Our Contacts">
                            </div>
                            <div class="form-group">
                                <label>Contact Section Sub-text</label>
                                <textarea class="form-control" name="contact_page_text" rows="3" placeholder="Short paragraph under the heading..."><?= isset($settings['contact_page_text']) ? $settings['contact_page_text'] : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Map Location Address</label>
                                <input type="text" class="form-control" name="contact_map_address" value="<?= isset($settings['contact_map_address']) ? $settings['contact_map_address'] : '' ?>" placeholder="e.g. Mozang Chungi, Lahore">
                                <small class="text-muted">Enter the address to show on the map. This is simpler than using embed code.</small>
                            </div>
                            <div class="form-group">
                                <label>Advanced: Google Maps Embed URL</label>
                                <input type="text" class="form-control" name="contact_map_url" value="<?= isset($settings['contact_map_url']) ? $settings['contact_map_url'] : '' ?>" placeholder="Paste the full Google Maps embed src URL here">
                                <small class="text-muted">If this is filled, it will take priority over the address above. Go to Google Maps → Share → Embed a map → Copy the <code>src="..."</code> URL only.</small>
                            </div>

                            <hr>
                            <h4 class="box-title" style="margin-bottom: 20px;">Free Consultation Page</h4>
                            <div class="form-group">
                                <label>Upper Section Title</label>
                                <input type="text" class="form-control" name="free_consultation_title" value="<?= isset($settings['free_consultation_title']) ? $settings['free_consultation_title'] : 'Get a Free Consultation' ?>">
                            </div>
                            <div class="form-group">
                                <label>Upper Section Description</label>
                                <textarea class="form-control" name="free_consultation_desc" rows="3"><?= isset($settings['free_consultation_desc']) ? $settings['free_consultation_desc'] : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Form Heading</label>
                                <input type="text" class="form-control" name="free_consultation_form_title" value="<?= isset($settings['free_consultation_form_title']) ? $settings['free_consultation_form_title'] : 'Book your Appointment' ?>">
                            </div>
                            <div class="form-group">
                                <label>Lower Section Title</label>
                                <input type="text" class="form-control" name="free_consultation_footer_title" value="<?= isset($settings['free_consultation_footer_title']) ? $settings['free_consultation_footer_title'] : 'Why Choose Our Legal Services?' ?>">
                            </div>
                            <div class="form-group">
                                <label>Lower Section Description</label>
                                <textarea class="form-control" name="free_consultation_footer_desc" rows="3"><?= isset($settings['free_consultation_footer_desc']) ? $settings['free_consultation_footer_desc'] : '' ?></textarea>
                            </div>

                            <hr>
                            <h4 class="box-title" style="margin-bottom: 20px; color: #bc9355;"><i class="fa fa-credit-card"></i> PayPro Configuration (PKR Only)</h4>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>PayPro Username</label>
                                        <input type="text" class="form-control" name="paypro_username" value="<?= isset($settings['paypro_username']) ? $settings['paypro_username'] : '' ?>" placeholder="E.g. LE_Law_Firm">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>PayPro Password</label>
                                        <input type="password" class="form-control" name="paypro_password" value="<?= isset($settings['paypro_password']) ? $settings['paypro_password'] : '' ?>" placeholder="Your Password">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>PayPro Client ID</label>
                                        <input type="text" class="form-control" name="paypro_client_id" value="<?= isset($settings['paypro_client_id']) ? $settings['paypro_client_id'] : '' ?>" placeholder="Client ID">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>PayPro Client Secret</label>
                                        <input type="password" class="form-control" name="paypro_client_secret" value="<?= isset($settings['paypro_client_secret']) ? $settings['paypro_client_secret'] : '' ?>" placeholder="Client Secret">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4 class="box-title" style="margin-bottom: 20px; color: #3c8dbc;"><i class="fa fa-plug"></i> Website Widgets</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>AI Chatbot Assistant</label>
                                        <select class="form-control" name="chatbot_status">
                                            <option value="enabled" <?= (isset($settings['chatbot_status']) && $settings['chatbot_status'] == 'enabled') ? 'selected' : '' ?>>Enabled</option>
                                            <option value="disabled" <?= (isset($settings['chatbot_status']) && $settings['chatbot_status'] == 'disabled') ? 'selected' : '' ?>>Disabled</option>
                                        </select>
                                        <small class="text-muted">Turn the AI floating chatbot on or off.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>WhatsApp Floating Button</label>
                                        <select class="form-control" name="whatsapp_status">
                                            <option value="enabled" <?= (isset($settings['whatsapp_status']) && $settings['whatsapp_status'] == 'enabled') ? 'selected' : '' ?>>Enabled</option>
                                            <option value="disabled" <?= (isset($settings['whatsapp_status']) && $settings['whatsapp_status'] == 'disabled') ? 'selected' : '' ?>>Disabled</option>
                                        </select>
                                        <small class="text-muted">Turn the WhatsApp contact button on or off.</small>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4 class="box-title" style="margin-bottom: 20px; color: #bc9355;"><i class="fa fa-gears"></i> Gemini AI Configuration</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gemini API Key</label>
                                        <input type="text" class="form-control" name="gemini_api_key" value="<?= isset($settings['gemini_api_key']) ? $settings['gemini_api_key'] : '' ?>" placeholder="Paste your Gemini API Key here">
                                        <small class="text-muted"><a href="https://aistudio.google.com/app/apikey" target="_blank">Get API Key from Google AI Studio</a></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gemini API URL</label>
                                        <input type="text" class="form-control" name="gemini_api_url" value="<?= isset($settings['gemini_api_url']) ? $settings['gemini_api_url'] : 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent' ?>" placeholder="Gemini API Endpoint URL">
                                        <small class="text-muted">Default: gemini-1.5-flash endpoint</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger" style="background-color: #f8d7da !important; color: #721c24 !important; border-color: #f5c6cb !important; margin-top: 10px; font-size: 13px;">
                                        <i class="fa fa-exclamation-triangle"></i> <strong>CAUTION:</strong> Do not modify these Gemini settings unless you are an authorized developer. Incorrect values will immediately break the AI Chatbot's ability to respond to users.
                                    </div>
                                </div>
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
