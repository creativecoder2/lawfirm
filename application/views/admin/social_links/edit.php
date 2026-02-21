<div class="content-header">
    <h1>
        Edit Social Link
        <small>Update existing social media icon</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Link Information</h3>
                <a href="<?= site_url('admin/social_links') ?>" class="btn btn-secondary btn-sm pull-right"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
            
            <?= form_open('admin/social_link_edit/'.$social_link['id']) ?>
                <div class="box-body p-4">
                    <div class="form-group mb-4">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="<?= $social_link['title'] ?>" required>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label>Select Icon</label>
                        <select name="icon" class="form-control" required>
                            <option value="fa fa-facebook" <?= $social_link['icon'] == 'fa fa-facebook' ? 'selected' : '' ?>>Facebook</option>
                            <option value="fa fa-twitter" <?= $social_link['icon'] == 'fa fa-twitter' ? 'selected' : '' ?>>Twitter / X</option>
                            <option value="fa fa-linkedin" <?= $social_link['icon'] == 'fa fa-linkedin' ? 'selected' : '' ?>>LinkedIn</option>
                            <option value="fa fa-instagram" <?= $social_link['icon'] == 'fa fa-instagram' ? 'selected' : '' ?>>Instagram</option>
                            <option value="fa fa-youtube" <?= $social_link['icon'] == 'fa fa-youtube' ? 'selected' : '' ?>>YouTube</option>
                            <option value="fa fa-whatsapp" <?= $social_link['icon'] == 'fa fa-whatsapp' ? 'selected' : '' ?>>WhatsApp</option>
                            <option value="fa fa-tiktok" <?= $social_link['icon'] == 'fa fa-tiktok' ? 'selected' : '' ?>>TikTok</option>
                            <option value="fa fa-pinterest" <?= $social_link['icon'] == 'fa fa-pinterest' ? 'selected' : '' ?>>Pinterest</option>
                            <option value="fa fa-skype" <?= $social_link['icon'] == 'fa fa-skype' ? 'selected' : '' ?>>Skype</option>
                            <option value="fa fa-envelope" <?= $social_link['icon'] == 'fa fa-envelope' ? 'selected' : '' ?>>Email (Envelope)</option>
                        </select>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label>Link URL</label>
                        <input type="text" name="link" class="form-control" value="<?= $social_link['link'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Priority / Order</label>
                        <input type="number" name="priority" class="form-control" value="<?= $social_link['priority'] ?>">
                    </div>
                </div>

                <div class="box-footer bg-light p-4">
                    <button type="submit" class="btn btn-primary btn-lg">Update Social Link</button>
                    <a href="<?= site_url('admin/social_links') ?>" class="btn btn-link">Cancel</a>
                </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
