<div class="content-header">
    <h1>
        Blog Comments
        <small>Manage and moderate user comments on your blog</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Comment Moderation List</h3>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-2"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable">
                    <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th>Blog Topic</th>
                            <th>User Info</th>
                            <th>Comment Snippet</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($comments)): foreach($comments as $c): ?>
                        <tr>
                            <td><?= $c['id'] ?></td>
                            <td>
                                <div class="font-weight-bold"><?= $c['blog_title'] ?></div>
                                <?php if($c['parent_id'] > 0): ?>
                                    <span class="badge bg-light p-1 border text-primary" style="font-size: 10px;">Reply to #<?= $c['parent_id'] ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-left">
                                <span class="badge bg-light text-dark p-2 border"><strong><?= $c['name'] ?></strong></span><br>
                                <small class="text-muted"><?= $c['email'] ?></small>
                            </td>
                            <td class="text-left">
                                <div style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <?= htmlspecialchars($c['comment']) ?>
                                </div>
                            </td>
                            <td>
                                <?php if($c['is_approved']): ?>
                                    <span class="btn btn-success btn-xs" style="cursor: default; padding: 2px 8px;">Approved</span>
                                <?php else: ?>
                                    <span class="btn btn-warning btn-xs" style="cursor: default; padding: 2px 8px;">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <small class="text-muted"><?= date('M d, Y', strtotime($c['created_at'])) ?><br><?= date('h:i A', strtotime($c['created_at'])) ?></small>
                            </td>
                            <td>
                                <div class="action-buttons d-flex">
                                    <?php if(!$c['is_approved']): ?>
                                        <a href="<?= site_url('admin/blog_comment_status/'.$c['id'].'/1') ?>" class="btn btn-success btn-sm mr-2" title="Approve"><i class="fa fa-check"></i> Approve</a>
                                    <?php else: ?>
                                        <a href="<?= site_url('admin/blog_comment_status/'.$c['id'].'/0') ?>" class="btn btn-warning btn-sm mr-2" title="Unapprove"><i class="fa fa-times"></i> Unapprove</a>
                                    <?php endif; ?>
                                    
                                    <button type="button" class="btn btn-info btn-sm mr-2" data-toggle="modal" data-target="#commentModal<?= $c['id'] ?>" title="View Full"><i class="fa fa-eye"></i> View</button>
                                    
                                    <a href="<?= site_url('admin/blog_comment_delete/'.$c['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </td>
                        </tr>

                        <!-- View Modal -->
                        <div class="modal fade" id="commentModal<?= $c['id'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Comment by <?= $c['name'] ?></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Blog:</strong> <?= $c['blog_title'] ?></p>
                                        <p><strong>Email:</strong> <?= $c['email'] ?></p>
                                        <p><strong>Website:</strong> <?= $c['website'] ? : 'N/A' ?></p>
                                        <hr>
                                        <p><strong>Comment Content:</strong></p>
                                        <div class="p-3 bg-light border" style="border-radius: 5px;">
                                            <?= nl2br(htmlspecialchars($c['comment'])) ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <?php if(!$c['is_approved']): ?>
                                            <a href="<?= site_url('admin/blog_comment_status/'.$c['id'].'/1') ?>" class="btn btn-success">Approve Now</a>
                                        <?php else: ?>
                                            <a href="<?= site_url('admin/blog_comment_status/'.$c['id'].'/0') ?>" class="btn btn-warning">Unapprove Now</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
