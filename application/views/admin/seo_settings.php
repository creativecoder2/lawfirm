<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-search"></i> SEO Settings
            <small>Search Engine Optimization</small>
        </h1>
    </section>

    <section class="content">
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('admin/seo_settings_save') ?>" enctype="multipart/form-data">
            <div class="row">
                <!-- Global Meta Tags -->
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-globe"></i> Global Meta Tags</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Meta Title <small class="text-muted">(appears in browser tab & search results)</small></label>
                                <input type="text" name="seo_meta_title" class="form-control" value="<?= $seo['seo_meta_title'] ?? '' ?>" placeholder="Legal Eagle Law Firm | Premier Legal Services" maxlength="70">
                                <small class="text-muted">Recommended: 50-60 characters. <span id="title-count" class="text-info">0</span>/70</small>
                            </div>
                            <div class="form-group">
                                <label>Meta Description <small class="text-muted">(shown below title in search results)</small></label>
                                <textarea name="seo_meta_description" class="form-control" rows="3" placeholder="We provide expert legal services in family law, criminal defense, corporate law..." maxlength="160"><?= $seo['seo_meta_description'] ?? '' ?></textarea>
                                <small class="text-muted">Recommended: 150-160 characters. <span id="desc-count" class="text-info">0</span>/160</small>
                            </div>
                            <div class="form-group">
                                <label>Meta Keywords <small class="text-muted">(comma separated)</small></label>
                                <input type="text" name="seo_meta_keywords" class="form-control" value="<?= $seo['seo_meta_keywords'] ?? '' ?>" placeholder="law firm, lawyer, attorney, legal services, family law">
                            </div>
                            <div class="form-group">
                                <label>Canonical URL <small class="text-muted">(preferred domain version)</small></label>
                                <input type="url" name="seo_canonical_url" class="form-control" value="<?= $seo['seo_canonical_url'] ?? '' ?>" placeholder="https://www.yourdomain.com">
                            </div>
                        </div>
                    </div>

                    <!-- Open Graph (Social Media) -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-share-alt"></i> Open Graph / Social Media</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>OG Title <small class="text-muted">(displayed when shared on Facebook/LinkedIn)</small></label>
                                <input type="text" name="seo_og_title" class="form-control" value="<?= $seo['seo_og_title'] ?? '' ?>" placeholder="Leave empty to use Meta Title">
                            </div>
                            <div class="form-group">
                                <label>OG Description</label>
                                <textarea name="seo_og_description" class="form-control" rows="2" placeholder="Leave empty to use Meta Description"><?= $seo['seo_og_description'] ?? '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>OG Image <small class="text-muted">(1200x630 recommended)</small></label>
                                <?php if(!empty($seo['seo_og_image'])): ?>
                                    <div class="mb-2">
                                        <img src="<?= base_url($seo['seo_og_image']) ?>" style="max-height:100px; border:1px solid #ddd; border-radius:4px; padding:2px;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="seo_og_image" class="form-control" accept="image/*">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Facebook App ID</label>
                                        <input type="text" name="seo_fb_app_id" class="form-control" value="<?= $seo['seo_fb_app_id'] ?? '' ?>" placeholder="Optional">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Twitter Handle</label>
                                        <input type="text" name="seo_twitter_handle" class="form-control" value="<?= $seo['seo_twitter_handle'] ?? '' ?>" placeholder="@yourbrand">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Schema / Structured Data -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-code"></i> Schema / Structured Data (JSON-LD)</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Business Name</label>
                                <input type="text" name="seo_schema_name" class="form-control" value="<?= $seo['seo_schema_name'] ?? '' ?>" placeholder="Legal Eagle Law Firm">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Business Type</label>
                                        <select name="seo_schema_type" class="form-control">
                                            <option value="LegalService" <?= ($seo['seo_schema_type'] ?? '') == 'LegalService' ? 'selected' : '' ?>>Legal Service</option>
                                            <option value="Attorney" <?= ($seo['seo_schema_type'] ?? '') == 'Attorney' ? 'selected' : '' ?>>Attorney</option>
                                            <option value="LawFirm" <?= ($seo['seo_schema_type'] ?? '') == 'LawFirm' ? 'selected' : '' ?>>Law Firm</option>
                                            <option value="Organization" <?= ($seo['seo_schema_type'] ?? '') == 'Organization' ? 'selected' : '' ?>>Organization</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Business Phone</label>
                                        <input type="text" name="seo_schema_phone" class="form-control" value="<?= $seo['seo_schema_phone'] ?? '' ?>" placeholder="+92 322 4490008">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Business Address</label>
                                <input type="text" name="seo_schema_address" class="form-control" value="<?= $seo['seo_schema_address'] ?? '' ?>" placeholder="Office No 3, Kareem Chamber, Mozang Chungi, Lahore">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="seo_schema_city" class="form-control" value="<?= $seo['seo_schema_city'] ?? '' ?>" placeholder="Lahore">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State/Province</label>
                                        <input type="text" name="seo_schema_state" class="form-control" value="<?= $seo['seo_schema_state'] ?? '' ?>" placeholder="Punjab">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" name="seo_schema_country" class="form-control" value="<?= $seo['seo_schema_country'] ?? '' ?>" placeholder="PK">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="col-md-4">
                    <!-- Robots & Indexing -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-robot"></i> Indexing & Crawling</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Robots Meta Tag</label>
                                <select name="seo_robots" class="form-control">
                                    <option value="index, follow" <?= ($seo['seo_robots'] ?? '') == 'index, follow' ? 'selected' : '' ?>>Index, Follow (Recommended)</option>
                                    <option value="index, nofollow" <?= ($seo['seo_robots'] ?? '') == 'index, nofollow' ? 'selected' : '' ?>>Index, No Follow</option>
                                    <option value="noindex, follow" <?= ($seo['seo_robots'] ?? '') == 'noindex, follow' ? 'selected' : '' ?>>No Index, Follow</option>
                                    <option value="noindex, nofollow" <?= ($seo['seo_robots'] ?? '') == 'noindex, nofollow' ? 'selected' : '' ?>>No Index, No Follow</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Google Site Verification</label>
                                <input type="text" name="seo_google_verification" class="form-control" value="<?= $seo['seo_google_verification'] ?? '' ?>" placeholder="Verification code">
                                <small class="text-muted">From Google Search Console</small>
                            </div>
                            <div class="form-group">
                                <label>Bing Site Verification</label>
                                <input type="text" name="seo_bing_verification" class="form-control" value="<?= $seo['seo_bing_verification'] ?? '' ?>" placeholder="Verification code">
                            </div>
                        </div>
                    </div>

                    <!-- Analytics & Tracking -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-line-chart"></i> Analytics & Tracking</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Google Analytics ID</label>
                                <input type="text" name="seo_google_analytics" class="form-control" value="<?= $seo['seo_google_analytics'] ?? '' ?>" placeholder="G-XXXXXXXXXX or UA-XXXXXXXX-X">
                            </div>
                            <div class="form-group">
                                <label>Google Tag Manager ID</label>
                                <input type="text" name="seo_gtm_id" class="form-control" value="<?= $seo['seo_gtm_id'] ?? '' ?>" placeholder="GTM-XXXXXXX">
                            </div>
                            <div class="form-group">
                                <label>Facebook Pixel ID</label>
                                <input type="text" name="seo_fb_pixel" class="form-control" value="<?= $seo['seo_fb_pixel'] ?? '' ?>" placeholder="Optional">
                            </div>
                        </div>
                    </div>

                    <!-- Custom Head Code -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-code"></i> Custom Code</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Custom &lt;head&gt; Code</label>
                                <textarea name="seo_custom_head" class="form-control" rows="4" placeholder="Add custom meta tags, scripts, or CSS here..."><?= $seo['seo_custom_head'] ?? '' ?></textarea>
                                <small class="text-muted">Injected before closing &lt;/head&gt;</small>
                            </div>
                            <div class="form-group">
                                <label>Custom Footer Code</label>
                                <textarea name="seo_custom_footer" class="form-control" rows="4" placeholder="Add tracking scripts, widgets, etc..."><?= $seo['seo_custom_footer'] ?? '' ?></textarea>
                                <small class="text-muted">Injected before closing &lt;/body&gt;</small>
                            </div>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <button type="submit" class="btn btn-primary btn-block btn-lg" style="background:#d0a15e; border-color:#d0a15e; font-weight:700; border-radius:6px;">
                        <i class="fa fa-save"></i> Save SEO Settings
                    </button>
                </div>
            </div>
        </form>
    </section>
</div>

<script>
// Character counters
document.addEventListener('DOMContentLoaded', function() {
    var titleInput = document.querySelector('[name="seo_meta_title"]');
    var descInput = document.querySelector('[name="seo_meta_description"]');
    var titleCount = document.getElementById('title-count');
    var descCount = document.getElementById('desc-count');

    function updateCount(el, counter, max) {
        var len = el.value.length;
        counter.textContent = len;
        counter.className = len > max ? 'text-danger' : (len > max * 0.8 ? 'text-warning' : 'text-info');
    }

    if (titleInput) {
        updateCount(titleInput, titleCount, 60);
        titleInput.addEventListener('input', function() { updateCount(this, titleCount, 60); });
    }
    if (descInput) {
        updateCount(descInput, descCount, 155);
        descInput.addEventListener('input', function() { updateCount(this, descCount, 155); });
    }
});
</script>
