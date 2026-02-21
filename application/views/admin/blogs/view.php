<div class="content-header">
    <h1>
        Blog Post Details
        <small>Review published article content and metadata</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Article Overview</h3>
                <a href="<?= base_url('admin/blogs') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            <div class="box-body no-padding">
                <table class="table detail-table">
                    <tr>
                        <th width="200">Article ID</th>
                        <td><span class="badge bg-light text-dark">#<?= $blog['id'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Cover Image</th>
                        <td>
                            <img src="<?= base_url($blog['image']) ?>" class="img-thumbnail rounded shadow-sm" style="max-width: 400px;">
                        </td>
                    </tr>
                    <tr>
                        <th>Post Title</th>
                        <td><strong><?= $blog['title'] ?></strong></td>
                    </tr>
                    <tr>
                        <th>Author Name</th>
                        <td><span class="badge bg-light text-dark p-2 border"><?= $blog['author'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Date Published</th>
                        <td><i class="fa fa-calendar"></i> <?= date('F d, Y', strtotime($blog['date_published'])) ?></td>
                    </tr>
                    <tr>
                        <th>External Link</th>
                        <td><code><?= $blog['link'] ?: 'N/A' ?></code></td>
                    </tr>
                    <tr>
                        <th>Visibility Status</th>
                        <td>
                            <?php if($blog['is_active'] == 1): ?>
                                <span class="badge bg-success">Published</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Draft</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="box-footer">
                <a href="<?= base_url('admin/blog_edit/'.$blog['id']) ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit Blog Post</a>
            </div>
        </div>
    </div>
</div>
