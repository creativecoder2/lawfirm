<div class="content-header">
    <h1>
        Compose Email
        <small><?= $subscriber ? 'Replying to ' . $subscriber['email'] : 'Sending to all subscribers' ?></small>
    </h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Email Details</h3>
                <a href="<?= site_url('admin/subscribers') ?>" class="btn btn-secondary btn-sm pull-right"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
            
            <?= form_open('admin/subscriber_send_email') ?>
                <?php if($subscriber): ?>
                    <input type="hidden" name="email" value="<?= $subscriber['email'] ?>">
                <?php endif; ?>

                <div class="box-body p-4">
                    <div class="form-group mb-4">
                        <label>To</label>
                        <input type="text" class="form-control" value="<?= $subscriber ? $subscriber['email'] : 'All Active Subscribers' ?>" disabled>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label>Subject</label>
                        <input type="text" name="subject" class="form-control" required placeholder="Enter email subject...">
                    </div>
                    
                    <div class="form-group">
                        <label>Message Content</label>
                        <textarea class="form-control editor" name="message" rows="10"></textarea>
                    </div>
                </div>

                <div class="box-footer bg-light p-4 text-right">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="fa fa-paper-plane mr-2"></i> Send Email Now
                    </button>
                </div>
            <?= form_close() ?>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">System Note</h3>
            </div>
            <div class="box-body">
                <p class="text-muted">
                    This message will be sent using the system's SMTP settings. A customized "Thank You" signature and your law firm logo will be automatically attached to the bottom of the email.
                </p>
                <hr>
                <div class="alert alert-info py-2">
                    <i class="fa fa-info-circle"></i> Use the editor to format your reply professionaly.
                </div>
            </div>
        </div>
    </div>
</div>
