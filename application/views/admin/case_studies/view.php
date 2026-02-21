<div class="content-header">
    <h1>
        Case Study Details
        <small>View full report and gallery for this success story</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Case Study Overview</h3>
                <a href="<?= base_url('admin/case_studies') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            <div class="box-body no-padding">
                <table class="table detail-table">
                    <tr>
                        <th width="200">Case ID</th>
                        <td><span class="badge bg-light text-dark">#<?= $case_study['id'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Cover Image</th>
                        <td>
                            <img src="<?= base_url($case_study['image']) ?>" class="img-thumbnail rounded shadow-sm" style="max-width: 400px;">
                        </td>
                    </tr>
                    <tr>
                        <th>Case Title</th>
                        <td><strong><?= $case_study['title'] ?></strong></td>
                    </tr>
                    <tr>
                        <th>Brief Subtitle</th>
                        <td><?= $case_study['subtitle'] ?></td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td><span class="badge bg-primary">ID: <?= $case_study['category_id'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Full Narrative</th>
                        <td>
                            <div class="p-3 bg-light rounded border-left" style="border-left: 4px solid #d0a15e;">
                                <?= nl2br($case_study['description']) ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Publication Status</th>
                        <td>
                            <?php if($case_study['is_active'] == 1): ?>
                                <span class="badge bg-success">Published</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Draft</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="box-footer">
                <a href="<?= base_url('admin/case_study_edit/'.$case_study['id']) ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit Case Study</a>
            </div>
        </div>
    </div>
</div>
