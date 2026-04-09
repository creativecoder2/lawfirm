<div class="content-header">
    <h1>
        Edit Chatbot Knowledge
        <small>Update AI memory for "<?= $k['topic'] ?>"</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Knowledge Update Form</h3>
                <a href="<?= base_url('admin/chatbot_knowledge') ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            
            <div class="box-body">
                <form action="<?= base_url('admin/chatbot_knowledge_edit/'.$k['id']) ?>" method="POST">
                    <div class="form-group">
                        <label for="topic">Topic / Keyword</label>
                        <input type="text" name="topic" id="topic" class="form-control" value="<?= $k['topic'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Content / Information</label>
                        <textarea name="content" id="content" class="form-control" rows="6" required><?= $k['content'] ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="link_title">Button/Link Title (Optional)</label>
                            <input type="text" name="link_title" id="link_title" class="form-control" value="<?= $k['link_title'] ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="link_url">Button/Link URL (Optional)</label>
                            <input type="url" name="link_url" id="link_url" class="form-control" value="<?= $k['link_url'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_active">Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" <?= $k['is_active'] == 1 ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= $k['is_active'] == 0 ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Knowledge</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
