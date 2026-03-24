    </div> <!-- End container-fluid -->

    <footer class="admin-footer">
        © 2026 LEGAL EAGLE Law Firm. All rights reserved. Admin Panel.
    </footer>

</div> <!-- End admin-content -->
</div> <!-- End wrapper -->

<!-- Scripts -->
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

<script>
$(document).ready(function() {
    // Robust DataTables Initialization for all grids
    $('.table-datatable').each(function() {
        var $thisTable = $(this);
        var tableName = $thisTable.data('table');
        
        if ($.fn.DataTable.isDataTable($thisTable)) {
            $thisTable.DataTable().destroy();
        }

        var priorityIndex = $thisTable.find('thead th.priority-col').index();
        if (priorityIndex === -1) {
            priorityIndex = $thisTable.find('thead th').filter(function() {
                return $(this).text().trim() === 'Priority';
            }).index();
        }

        if (priorityIndex === -1) {
            // Last column fallback if Priority header isn't found
            priorityIndex = $thisTable.find('thead th').length - 1;
        }
        
        console.log('Initializing DataTable for ' + tableName + ' with priorityIndex: ' + priorityIndex);

        var table = $thisTable.DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "order": [[priorityIndex, 'asc']], 
            "rowReorder": {
                "selector": 'tr[data-id]',
                "dataSrc": priorityIndex,
                "update": true 
            }
        });

        table.on('row-reorder', function(e, diff, edit) {
            var orders = [];
            
            for (var i = 0, ien = diff.length; i < ien; i++) {
                var rowNode = diff[i].node;
                var id = $(rowNode).data('id');
                var newPosition = diff[i].newPosition;
                
                if (id !== undefined) {
                    orders.push({
                        id: id,
                        priority: newPosition
                    });
                }
            }

            if (orders.length > 0 && tableName) {
                console.log('Sending reorder for ' + tableName, orders);
                $.ajax({
                    url: '<?= base_url("admin/update_order") ?>',
                    type: 'POST',
                    data: {
                        table: tableName,
                        orders: orders
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Show a small toast notification
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Ordering updated',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });
                        } else {
                            console.error('Reorder update failed:', response.message);
                        }
                    }
                });
            }
        });
    });

    // Global Delete Confirmation with SweetAlert2
    $(document).on('click', '.delete-confirm', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#bc9355', 
            cancelButtonColor: '#333',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-primary btn-lg px-4 mr-2',
                cancelButton: 'btn btn-default btn-lg px-4'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });

    // CKEditor 5 Initialization
    if ($('.editor').length > 0) {
        $('.editor').each(function() {
            ClassicEditor
                .create(this, {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                            'blockQuote', 'insertTable', 'undo', 'redo'
                        ]
                    }
                })
                .then(editor => {
                    console.log('CKEditor 5 initialized', editor);
                })
                .catch(error => {
                    console.error('CKEditor error', error);
                });
        });
    }

    // Real-time Notifications Polling
    function fetchNotifications() {
        $.ajax({
            url: '<?= site_url("admin/ajax_get_notifications") ?>',
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res) {
                    $('#notif-dropdown').html(res.html);
                    
                    var badge = $('.dropdown-toggle i.fa-bell-o').siblings('.badge-danger');
                    if (res.total > 0) {
                        if (badge.length) {
                            badge.text(res.total);
                        } else {
                            $('<span class="badge badge-danger" style="position: absolute; top: -8px; right: -10px; background: #e74c3c; color: white; border-radius: 50%; padding: 3px 6px; font-size: 10px;">'+res.total+'</span>').insertAfter('.dropdown-toggle i.fa-bell-o');
                        }
                    } else {
                        if (badge.length) badge.remove();
                    }

                    // Update Sidebar Badges
                    updateSidebarBadge('.sidebar-count-appointments', res.appointments, 'danger');
                    updateSidebarBadge('.sidebar-count-contacts', res.contacts, 'danger');
                    updateSidebarBadge('.sidebar-count-subscribers', res.subscribers, 'danger');
                }
            }
        });
    }

    function updateSidebarBadge(selector, count, colorClass) {
        var el = $(selector);
        if (el.length) {
            el.text(count);
            if (count > 0) {
                el.show();
            } else {
                el.hide();
            }
        }
    }

    // Fetch every 15 seconds
    setInterval(fetchNotifications, 15000);
});
</script>

</body>
</html>
