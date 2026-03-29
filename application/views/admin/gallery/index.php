<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Video Gallery
            <small>Manage your TikTok-style video gallery</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Video Gallery</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Video List</h3>
                        <div class="box-tools">
                            <a href="<?= site_url('admin/gallery_bulk_add') ?>" class="btn btn-success btn-sm">
                                <i class="fa fa-cloud-upload"></i> Bulk Add Videos
                            </a>
                            <a href="<?= site_url('admin/gallery_add') ?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Add New Video
                            </a>
                        </div>
                    </div>
                    
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
                    <?php endif; ?>
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger m-4"><?= $this->session->flashdata('error') ?></div>
                    <?php endif; ?>

                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Priority</th>
                                    <th>Video</th>
                                    <th>Title</th>
                                    <th>Views</th>
                                    <th>Shares</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($videos)): foreach($videos as $v): ?>
                                <tr>
                                    <td><?= $v['priority'] ?></td>
                                    <td>
                                        <video width="120" height="80" muted>
                                            <source src="<?= base_url($v['video_path']) ?>" type="video/mp4">
                                        </video>
                                    </td>
                                    <td>
                                        <strong><?= $v['title'] ?></strong><br>
                                        <small class="text-muted"><?= substr($v['description'], 0, 50) ?>...</small>
                                    </td>
                                    <td><span class="label label-info"><?= $v['views'] ?></span></td>
                                    <td><span class="label label-warning"><?= $v['shares'] ?></span></td>
                                    <td>
                                        <?php if($v['is_active']): ?>
                                            <a href="<?= site_url('admin/gallery_status/'.$v['id'].'/0') ?>" class="label label-success">Active</a>
                                        <?php else: ?>
                                            <a href="<?= site_url('admin/gallery_status/'.$v['id'].'/1') ?>" class="label label-danger">Inactive</a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('admin/gallery_edit/'.$v['id']) ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                        <a href="<?= site_url('admin/gallery_delete/'.$v['id']) ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No videos found.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
