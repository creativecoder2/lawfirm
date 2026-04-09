<div class="content-header">
    <h1>
        Chatbot Knowledge Base
        <small>Add custom "Brain" pieces to your AI assistant</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Knowledge List</h3>
                <a href="<?= base_url('admin/chatbot_knowledge_add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Knowledge</a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable">
                    <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th>Topic/Keyword</th>
                            <th>Content/Answer</th>
                            <th>Associated Link</th>
                            <th>Status</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($knowledge as $k): ?>
                            <tr>
                                <td><?= $k['id'] ?></td>
                                <td><strong><?= $k['topic'] ?></strong></td>
                                <td><?= mb_strimwidth($k['content'], 0, 100, "...") ?></td>
                                <td>
                                    <?php if(!empty($k['link_url'])): ?>
                                        <a href="<?= $k['link_url'] ?>" target="_blank"><?= $k['link_title'] ?: 'View Link' ?></a>
                                    <?php else: ?>
                                        <span class="text-muted">No Link</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($k['is_active'] == 1): ?>
                                        <a href="<?= base_url('admin/chatbot_knowledge_status/'.$k['id'].'/0') ?>" class="btn btn-success btn-sm">Active</a>
                                    <?php else: ?>
                                        <a href="<?= base_url('admin/chatbot_knowledge_status/'.$k['id'].'/1') ?>" class="btn btn-danger btn-sm">Inactive</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="<?= base_url('admin/chatbot_knowledge_edit/'.$k['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a href="<?= base_url('admin/chatbot_knowledge_delete/'.$k['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
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
