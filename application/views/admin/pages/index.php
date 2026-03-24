<div class="content-header">
    <h1>
        Pages Management
        <small>Create and manage custom pages like Privacy Policy, Terms, etc.</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Custom Pages List</h3>
                <a href="<?= base_url('admin/page_add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Page</a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable" data-table="pages">
                    <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Header</th>
                        <th>Footer</th>
                        <th width="200">Actions</th>
                        <th style="display:none;" class="priority-col">Priority</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pages as $p): ?>
                    <tr data-id="<?= $p['id'] ?>">
                        <td><?= $p['id'] ?></td>
                        <td>
                            <strong><?= $p['title'] ?></strong>
                        </td>
                        <td>
                            <code>/page/<?= $p['slug'] ?></code>
                        </td>
                        <td>
                            <?php if($p['show_in_header'] == 1): ?>
                                <a href="<?= base_url('admin/page_header_status/'.$p['id'].'/0') ?>" class="btn btn-success btn-sm"><i class="fa fa-toggle-on"></i> Show</a>
                            <?php else: ?>
                                <a href="<?= base_url('admin/page_header_status/'.$p['id'].'/1') ?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-toggle-off"></i> Hide</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($p['show_in_footer'] == 1): ?>
                                <a href="<?= base_url('admin/page_footer_status/'.$p['id'].'/0') ?>" class="btn btn-success btn-sm"><i class="fa fa-toggle-on"></i> Show</a>
                            <?php else: ?>
                                <a href="<?= base_url('admin/page_footer_status/'.$p['id'].'/1') ?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-toggle-off"></i> Hide</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url('page/'.$p['slug']) ?>" target="_blank" class="btn btn-info btn-sm" title="View"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('admin/page_edit/'.$p['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url('admin/page_delete/'.$p['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                        <td style="display:none;"><?= isset($p['priority']) ? $p['priority'] : 0 ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
