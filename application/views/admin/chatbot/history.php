<div class="content-header">
    <h1>
        Chatbot History & Logs
        <small>Monitor conversations grouped by user session</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Conversations Overview</h3>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable">
                    <thead>
                        <tr>
                            <th width="150">Started At</th>
                            <th width="150">Ended At</th>
                            <th width="250">User Identification</th>
                            <th>Messages</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sessions as $s): ?>
                            <tr>
                                <td class="small">
                                    <?= date('d M Y', strtotime($s['started_at'])) ?><br>
                                    <?= date('h:i A', strtotime($s['started_at'])) ?>
                                </td>
                                <td class="small">
                                    <?= date('d M Y', strtotime($s['ended_at'])) ?><br>
                                    <?= date('h:i A', strtotime($s['ended_at'])) ?>
                                </td>
                                <td>
                                    <?php if(!empty($s['user_name'])): ?>
                                        <strong><?= $s['user_name'] ?></strong><br>
                                        <span class="text-muted small"><?= $s['user_phone'] ?></span>
                                    <?php else: ?>
                                        <span class="text-muted italic">Guest / Unknown</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge badge-primary"><?= $s['msg_count'] ?> messages</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="<?= base_url('admin/chatbot_history_view/'.$s['identifier']) ?>" class="btn btn-info btn-sm" title="View Full Chat Thread">
                                            <i class="fa fa-eye"></i> View Thread
                                        </a>
                                        <a href="<?= base_url('admin/chatbot_history_session_delete/'.$s['identifier']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete Entire Thread">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
