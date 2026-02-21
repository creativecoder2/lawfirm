<div class="content-wrapper">
    <section class="content-header">
        <h1>
            View Message
            <small>Contact form submission detail</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Message from <?= $message['name'] ?></h3>
                        <div class="box-tools pull-right">
                            <a href="<?= site_url('admin/contact_messages') ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 180px; background: #f9f9f9;">Name</th>
                                <td><strong><?= $message['name'] ?></strong></td>
                            </tr>
                            <tr>
                                <th style="background: #f9f9f9;">Email</th>
                                <td><a href="mailto:<?= $message['email'] ?>"><?= $message['email'] ?></a></td>
                            </tr>
                            <tr>
                                <th style="background: #f9f9f9;">Phone</th>
                                <td><?= $message['phone'] ?: 'N/A' ?></td>
                            </tr>
                            <tr>
                                <th style="background: #f9f9f9;">Address</th>
                                <td><?= $message['address'] ?: 'N/A' ?></td>
                            </tr>
                            <tr>
                                <th style="background: #f9f9f9;">Received On</th>
                                <td><?= date('F d, Y - H:i', strtotime($message['created_at'])) ?></td>
                            </tr>
                            <tr>
                                <th style="background: #f9f9f9;">Message</th>
                                <td style="white-space: pre-wrap; font-size: 14px; line-height: 1.6;"><?= nl2br($message['message']) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="box-footer">
                        <?php if($message['phone']): 
                            $wa_msg = "Hello " . $message['name'] . ", I'm following up on your contact message...";
                            $wa_url = "https://wa.me/" . preg_replace('/[^0-9]/', '', $message['phone']) . "?text=" . urlencode($wa_msg);
                        ?>
                            <a href="<?= $wa_url ?>" target="_blank" class="btn btn-success"><i class="fa fa-whatsapp"></i> Chat on WhatsApp</a>
                        <?php endif; ?>
                        <a href="mailto:<?= $message['email'] ?>" class="btn btn-primary"><i class="fa fa-envelope"></i> Reply via Email</a>
                        <a href="<?= site_url('admin/contact_delete/'.$message['id']) ?>" class="btn btn-danger delete-confirm pull-right"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
