<div class="content-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Chatbot Leads <small>Manage leads generated from the website chatbot</small></h1>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-12">
        <div class="box" style="border-radius: 10px; overflow: hidden; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            <div class="box-body" style="padding: 0;">
                <div class="table-responsive">
                    <table class="table table-hover" id="leadsTable" style="margin-bottom: 0;">
                        <thead style="background: #fafafa; border-bottom: 1px solid #eee;">
                            <tr>
                                <th style="padding: 15px 20px;">#</th>
                                <th style="padding: 15px 20px;">Name</th>
                                <th style="padding: 15px 20px;">Phone</th>
                                <th style="padding: 15px 20px;">Category</th>
                                <th style="padding: 15px 20px;">City</th>
                                <th style="padding: 15px 20px;">Date</th>
                                <th style="padding: 15px 20px; text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($leads)): foreach($leads as $idx => $lead): ?>
                            <tr style="border-bottom: 1px solid #f9f9f9;">
                                <td style="padding: 15px 20px; vertical-align: middle;"><?= $idx + 1 ?></td>
                                <td style="padding: 15px 20px; vertical-align: middle;">
                                    <div style="font-weight: 600; color: #333;"><?= $lead['name'] ?></div>
                                </td>
                                <td style="padding: 15px 20px; vertical-align: middle;">
                                    <a href="tel:<?= $lead['phone'] ?>" style="color: #666; text-decoration: none;">
                                        <i class="fa fa-phone" style="color: #2ecc71; margin-right: 5px;"></i> <?= $lead['phone'] ?>
                                    </a>
                                </td>
                                <td style="padding: 15px 20px; vertical-align: middle;">
                                    <span class="label label-info" style="background-color: rgba(52, 152, 219, 0.1); color: #3498db; border: 1px solid rgba(52, 152, 219, 0.2); font-weight: 500; font-size: 11px;">
                                        <?= !empty($lead['category_name']) ? $lead['category_name'] : 'General' ?>
                                    </span>
                                </td>
                                <td style="padding: 15px 20px; vertical-align: middle; color: #666;">
                                    <i class="fa fa-map-marker" style="color: #e74c3c; margin-right: 5px;"></i> <?= $lead['city'] ?>
                                </td>
                                <td style="padding: 15px 20px; vertical-align: middle; color: #999; font-size: 12px;">
                                    <?= date('d M Y, h:i A', strtotime($lead['created_at'])) ?>
                                </td>
                                <td style="padding: 15px 20px; vertical-align: middle; text-align: center;">
                                    <a href="<?= site_url('admin/chatbot_lead_delete/'.$lead['id']) ?>" class="btn btn-sm" style="color: #e74c3c; border: 1px solid #f9e2e2; background: #fff5f5;" onclick="return confirm('Are you sure you want to delete this lead?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="7" class="text-center" style="padding: 50px; color: #aaa;">
                                    <i class="fa fa-comments-o" style="font-size: 40px; margin-bottom: 15px; display: block;"></i>
                                    No chatbot leads found yet.
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #fcfaf7 !important;
    }
    .label {
        padding: 4px 8px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
