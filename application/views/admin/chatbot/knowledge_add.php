<div class="content-header">
    <h1>
        Add Chatbot Knowledge
        <small>Teach your AI something new</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Knowledge Entry Form</h3>
                <a href="<?= base_url('admin/chatbot_knowledge') ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            
            <div class="box-body">
                <form action="<?= base_url('admin/chatbot_knowledge_add') ?>" method="POST">
                    <div class="form-group">
                        <label for="topic">Topic / Keyword (e.g. "Special Discount", "Refund Policy")</label>
                        <input type="text" name="topic" id="topic" class="form-control" placeholder="Enter key topic" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Content / Information (The answer the bot should give)</label>
                        <textarea name="content" id="content" class="form-control" rows="6" placeholder="Provide detailed information about this topic..." required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="link_title">Button/Link Title (Optional)</label>
                            <input type="text" name="link_title" id="link_title" class="form-control" placeholder="e.g. Visit Offer Page">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="link_url">Button/Link URL (Optional)</label>
                            <input type="url" name="link_url" id="link_url" class="form-control" placeholder="https://example.com/page">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_active">Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Knowledge</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
