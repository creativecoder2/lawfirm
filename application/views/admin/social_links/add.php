<div class="content-header">
    <h1>
        Add Social Link
        <small>Add a new social media icon to the footer</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Link Information</h3>
                <a href="<?= site_url('admin/social_links') ?>" class="btn btn-secondary btn-sm pull-right"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
            
            <?= form_open('admin/social_link_add') ?>
                <div class="box-body p-4">
                    <div class="form-group mb-4">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required placeholder="e.g. Facebook">
                    </div>
                    
                    <div class="form-group mb-4">
                        <label>Select Icon</label>
                        <select name="icon" class="form-control" required>
                            <option value="">-- Choose Social Icon --</option>
                            <option value="fa fa-facebook">Facebook</option>
                            <option value="fa fa-twitter">Twitter / X</option>
                            <option value="fa fa-linkedin">LinkedIn</option>
                            <option value="fa fa-instagram">Instagram</option>
                            <option value="fa fa-youtube">YouTube</option>
                            <option value="fa fa-whatsapp">WhatsApp</option>
                            <option value="fa fa-tiktok">TikTok</option>
                            <option value="fa fa-pinterest">Pinterest</option>
                            <option value="fa fa-skype">Skype</option>
                            <option value="fa fa-envelope">Email (Envelope)</option>
                        </select>
                        <small class="text-muted">Choose the social media platform for this link.</small>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label>Link URL</label>
                        <input type="text" name="link" class="form-control" required placeholder="https://facebook.com/your-profile">
                    </div>

                    <div class="form-group">
                        <label>Priority / Order</label>
                        <input type="number" name="priority" class="form-control" value="1">
                    </div>
                </div>

                <div class="box-footer bg-light p-4">
                    <button type="submit" class="btn btn-primary btn-lg">Add Social Link</button>
                    <a href="<?= site_url('admin/social_links') ?>" class="btn btn-link">Cancel</a>
                </div>
            <?= form_close() ?>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Quick Tip</h3>
            </div>
            <div class="box-body">
                <p>Common Social Icons:</p>
                <ul>
                    <li><strong>Facebook:</strong> <code>fa fa-facebook</code></li>
                    <li><strong>Twitter/X:</strong> <code>fa fa-twitter</code></li>
                    <li><strong>LinkedIn:</strong> <code>fa fa-linkedin</code></li>
                    <li><strong>Instagram:</strong> <code>fa fa-instagram</code></li>
                    <li><strong>YouTube:</strong> <code>fa fa-youtube</code></li>
                    <li><strong>WhatsApp:</strong> <code>fa fa-whatsapp</code></li>
                </ul>
                <p class="mt-3">You can find more icons at <a href="https://fontawesome.com/v4.7/icons/" target="_blank">FontAwesome 4.7</a></p>
            </div>
        </div>
    </div>
</div>
