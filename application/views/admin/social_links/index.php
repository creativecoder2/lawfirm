<div class="content-header">
    <h1>
        Social Links
        <small>Manage footer social media icons</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Social Links List</h3>
                <a href="<?= site_url('admin/social_link_add') ?>" class="btn btn-primary btn-sm pull-right">
                    <i class="fa fa-plus"></i> Add New Link
                </a>
            </div>
            <div class="box-body p-0">
                <table class="table table-striped table-hover mt-3" id="socialLinksTable">
                    <thead>
                        <tr>
                            <th width="80" class="text-center">Order</th>
                            <th style="display:none;" class="priority-col">Priority</th>
                            <th>Icon</th>
                            <th>Link URL</th>
                            <th width="150" class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="sortable" data-table="social_links">
                        <?php if(!empty($social_links)): foreach($social_links as $link): ?>
                        <tr data-id="<?= $link['id'] ?>">
                            <td class="text-center handle" style="cursor: move;">
                                <i class="fa fa-ellipsis-v"></i>
                            </td>
                            <td><strong><?= $link['title'] ?></strong></td>
                            <td><i class="<?= $link['icon'] ?> fa-2x"></i> <small class="text-muted ml-2">(<?= $link['icon'] ?>)</small></td>
                            <td><a href="<?= $link['link'] ?>" target="_blank"><?= $link['link'] ?></a></td>
                            <td class="text-right">
                                <a href="<?= site_url('admin/social_link_edit/'.$link['id']) ?>" class="btn btn-info btn-xs mr-1">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="javascript:void(0)" onclick="confirmDeleteSocial(<?= $link['id'] ?>)" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDeleteSocial(id) {
    Swal.fire({
        title: 'Delete Social Link?',
        text: "This icon will be removed from your footer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= site_url('admin/social_link_delete/') ?>" + id;
        }
    })
}

$(function() {
    $(".sortable").sortable({
        handle: ".handle",
        update: function(event, ui) {
            var order = [];
            $(this).find('tr').each(function(index) {
                order.push({
                    id: $(this).data('id'),
                    priority: index + 1
                });
            });

            $.ajax({
                url: "<?= base_url('admin/update_order') ?>",
                type: "POST",
                data: {
                    table: 'social_links',
                    order: order
                },
                success: function(response) {
                    console.log("Order updated");
                }
            });
        }
    });
});
</script>
