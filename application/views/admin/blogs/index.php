<div class="content-header">
    <h1>
        Blog Posts
        <small>Publish and manage latest legal insights and news</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Publication List</h3>
                <a href="<?= base_url('admin/blog_add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create Post</a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable" data-table="blogs">
                    <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th width="120">Cover</th>
                        <th>Article Details</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th width="180">Actions</th>
                        <th style="display:none;" class="priority-col">Priority</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($blogs as $b): ?>
                    <tr data-id="<?= $b['id'] ?>" data-priority="<?= isset($b['priority']) ? $b['priority'] : 0 ?>">
                        <td><?= $b['id'] ?></td>
                        <td>
                            <img src="<?= base_url($b['image']) ?>" class="img-thumbnail rounded" style="max-height: 60px;">
                        </td>
                        <td>
                            <div class="font-weight-bold"><?= $b['title'] ?></div>
                            <small class="text-muted mr-2"><i class="fa fa-calendar-o"></i> <?= date('M d, Y', strtotime($b['date_published'])) ?></small>
                            <span class="badge bg-light p-1 border ml-2 text-primary"><?= $b['category_name'] ?: 'Uncategorized' ?></span>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark p-2 border"><?= $b['author'] ?></span>
                        </td>
                        <td>
                            <?php if($b['is_active'] == 1): ?>
                                <a href="<?= base_url('admin/blog_status/'.$b['id'].'/0') ?>" class="btn btn-success btn-sm">Active</a>
                            <?php else: ?>
                                <a href="<?= base_url('admin/blog_status/'.$b['id'].'/1') ?>" class="btn btn-danger btn-sm">Inactive</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url('admin/blog_view/'.$b['id']) ?>" class="btn btn-info btn-sm" title="View"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('admin/blog_edit/'.$b['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url('admin/blog_delete/'.$b['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                        <td style="display:none;"><?= isset($b['priority']) ? $b['priority'] : 0 ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
