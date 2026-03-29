<!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 10002;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center" style="border-radius: 20px; border: none; overflow: hidden;">
            <div class="modal-header border-0" style="background: #1a1a1a; color: #fff;">
                <h5 class="modal-title" style="color: #fff; width: 100%;">Share this Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff; opacity: 1;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-center gap-3 mb-4" style="gap: 20px;">
                    <a href="#" class="btn btn-primary share-link facebook" target="_blank" style="background:#3b5998; border:0; width:60px; height:60px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-direction: column;">
                        <i class="fa fa-facebook fa-lg"></i>
                        <span style="font-size:10px; margin-top:5px;">Facebook</span>
                    </a>
                    <a href="#" class="btn btn-info share-link twitter" target="_blank" style="background:#1da1f2; border:0; width:60px; height:60px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-direction: column;">
                        <i class="fa fa-twitter fa-lg"></i>
                        <span style="font-size:10px; margin-top:5px;">Twitter</span>
                    </a>
                    <a href="#" class="btn btn-success share-link whatsapp" target="_blank" style="background:#25d366; border:0; width:60px; height:60px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-direction: column;">
                        <i class="fa fa-whatsapp fa-lg"></i>
                        <span style="font-size:10px; margin-top:5px;">WhatsApp</span>
                    </a>
                </div>
                <div class="input-group">
                    <input type="text" id="share-link-input" class="form-control" readonly style="background: #f8f9fa;">
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="copy-btn-modal" type="button" style="background: #d0a15e; border: 0;">Copy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Share Trigger
    $(document).on('click', '.share-trigger', function() {
        const id = $(this).data('id');
        const title = $(this).data('title');
        const url = $(this).data('link');
        
        $('#share-link-input').val(url);
        $('#shareModal').modal('show');
        
        $('.share-link.facebook').attr('href', `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`);
        $('.share-link.twitter').attr('href', `https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`);
        $('.share-link.whatsapp').attr('href', `https://api.whatsapp.com/send?text=${encodeURIComponent(title + " " + url)}`);

        // Track share
        $.post('<?= site_url("welcome/track_video_action") ?>', {id: id, type: 'share'}, function(res) {
            try {
                const data = JSON.parse(res);
                if(data.status === 'success') {
                    $(`#shares-${id}`).text(data.count);
                }
            } catch(e) {}
        });
    });

    // Copy Link
    $(document).on('click', '.copy-link, #copy-btn-modal', function() {
        const link = $(this).hasClass('copy-link') ? $(this).data('link') : $('#share-link-input').val();
        copyToClipboard(link);
        alert("Link copied to clipboard!");
    });

    function copyToClipboard(text) {
        const temp = $("<input>");
        $("body").append(temp);
        temp.val(text).select();
        document.execCommand("copy");
        temp.remove();
    }
});
</script>
