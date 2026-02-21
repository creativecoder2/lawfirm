<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Blog Post
            <small>Edit homepage blog post</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Blog Post</h3>
                        <a href="<?= base_url('admin/blogs') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                    <?php endif; ?>
                    <?= form_open_multipart('admin/blog_edit/'.$blog['id']) ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" value="<?= $blog['title'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea class="form-control editor" name="description" rows="10"><?= $blog['description'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Quote (Optional)</label>
                                        <textarea class="form-control" name="quote" rows="3" placeholder="Enter a special quote"><?= $blog['quote'] ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Current Image</label><br>
                                        <img src="<?= base_url($blog['image']) ?>" class="img-thumbnail" style="max-height: 150px;"><br>
                                        <label>Change Image (Optional)</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category_id" class="form-control" required>
                                            <option value="">Select Category</option>
                                            <?php foreach($categories as $cat): ?>
                                                <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $blog['category_id'] ? 'selected' : '') ?>><?= $cat['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Author Name</label>
                                        <input type="text" class="form-control" name="author" value="<?= $blog['author'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Author Bio</label>
                                        <textarea class="form-control" name="author_bio" rows="3" placeholder="Short description about the author"><?= $blog['author_bio'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Date Published</label>
                                        <input type="date" class="form-control" name="date_published" value="<?= $blog['date_published'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tags (Comma separated)</label>
                                        <input type="text" class="form-control" name="tags" value="<?= $blog['tags'] ?>" placeholder="e.g. Attorney, Lawyer">
                                    </div>
                                    <div class="form-group">
                                        <label>Video URL</label>
                                        <input type="text" class="form-control" name="video_url" value="<?= $blog['video_url'] ?>" placeholder="Optional video link">
                                    </div>
                                    <hr>
                                    <h4>Author Social Links</h4>
                                    <div class="form-group">
                                        <label>Author Facebook</label>
                                        <input type="text" class="form-control" name="author_facebook" value="<?= $blog['author_facebook'] ?>" placeholder="https://facebook.com/username">
                                    </div>
                                    <div class="form-group">
                                        <label>Author Twitter</label>
                                        <input type="text" class="form-control" name="author_twitter" value="<?= $blog['author_twitter'] ?>" placeholder="https://twitter.com/username">
                                    </div>
                                    <div class="form-group">
                                        <label>Author LinkedIn</label>
                                        <input type="text" class="form-control" name="author_linkedin" value="<?= $blog['author_linkedin'] ?>" placeholder="https://linkedin.com/in/username">
                                    </div>
                                    <div class="form-group">
                                        <label>Author Instagram</label>
                                        <input type="text" class="form-control" name="author_instagram" value="<?= $blog['author_instagram'] ?>" placeholder="https://instagram.com/username">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update Blog Post</button>
                            <a href="<?= base_url('admin/blogs') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
