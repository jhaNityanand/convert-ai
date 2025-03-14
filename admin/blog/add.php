
<?php
    require_once('../layouts/config.php');
    require_once('../layouts/function.php');
    require_once('../layouts/header.php');

    if(isset($_REQUEST['submit']))
    {
        if(empty($_REQUEST['title'])) {
            $title = "Title Field is Required.";
        }
        if(empty($_FILES['image']["name"])) {
            $image = "Image Field is Required.";
        }
        if(empty($_REQUEST['author'])) {
            $author = "Author Field is Required.";
        }
        if(empty($_REQUEST['quote'])) {
            $quote = "Quote Field is Required.";
        }
        if(empty($_REQUEST['category'])) {
            $category = "Category Field is Required.";
        }
        if(empty($_REQUEST['content'])) {
            $content = "Content Field is Required.";
        }
        if(empty($_REQUEST['meta_title'])) {
            $meta_title = "Meta Title Field is Required.";
        }
        if(empty($_REQUEST['meta_author'])) {
            $meta_author = "Meta Author Field is Required.";
        }
        if(empty($_REQUEST['meta_description'])) {
            $meta_description = "Meta Description Field is Required.";
        }
        if(empty($_REQUEST['key_words'])) {
            $key_words = "Key Words Field is Required.";
        }
        if(empty($_REQUEST['url'])) {
            $url = "URL Field is Required.";
        }

        if(!empty($_FILES['image']["name"]))
        {
            $filename = $_FILES["image"]["name"];
            $filetype = $_FILES["image"]["type"];
            $filetemp = $_FILES["image"]["tmp_name"];

            if(in_array('image', explode('/', $filetype))) {
                // $path = 'assets/img/blog/'.time()."-".$filename;
                $path = '../../assets/img/blog/'.time()."-".$filename;
                move_uploaded_file($filetemp, $path);
            } 
            else {
                $path = '';
                $image = "Only Image Accepted.";
            }
        }

        $data = [
            '`created_by`' => $_SESSION['user_login_detail']['id'],
            '`title`' => $_REQUEST['title'],
            '`image`' => $path,
            '`author`' => $_REQUEST['author'],
            '`quote`' => $_REQUEST['quote'],
            '`category`' => $_REQUEST['category'],
            '`content`' => $_REQUEST['content'],
            '`meta_title`' => $_REQUEST['meta_title'],
            '`meta_author`' => $_REQUEST['meta_author'],
            '`meta_description`' => $_REQUEST['meta_description'],
            '`key_words`' => $_REQUEST['key_words'],
            'url' => str_replace(' ', '-', strtolower($_REQUEST['url'])),
        ];

        if (in_array(null, $data, true) || in_array('', $data, true)) {
            // There are null (or empty) values.
        } else {
            $return = insert('`blog`', $data, $conn);
            
            if(!empty($return) && !empty($return['last_id']) != 0) {
                $message = "<div class='alert alert-success'>Record Inserted Successfully.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
            }
        }
    }
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" autocomplete="on">
    <div class="card card-body rounded bg-white">
        <div class="card-header">
            <h3>Blog Data Insert</h3>
            <?= (!empty($message)? $message : ''); ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Title: </b></label>
                        <input type="text" class="form-control" name="title" value="" placeholder="Title" required>
                        <small> <?= (!empty($title) ? $title : ''); ?></small>
                    </div>
                    <br>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Image: </b></label>
                        <input type="file" class="form-control" name="image" accept="image/*" required>
                        <small> <?= (!empty($image) ? $image : ''); ?></small>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Author: </b></label>
                        <input type="text" class="form-control" name="author" value="" placeholder="Author" required>
                        <small> <?= (!empty($author) ? $author : ''); ?></small>
                    </div>
                    <br>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Quote: </b></label>
                        <input type="text" class="form-control" name="quote" value="" placeholder="Quote"
                            required>
                        <small> <?= (!empty($quote) ? $quote : ''); ?></small>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Category: </b></label>
                        <select name="category" class="form-control" value="" required>
                            <option value="">Select Category</option>
                            <option value="PDF">PDF</option>
                            <option value="Excel">Excel</option>
                            <option value="DOCX">DOCX</option>
                            <option value="PPT">PPT</option>
                            <option value="Image">Image</option>
                            <option value="HTML">HTML</option>
                            <option value="ODC">ODC</option>
                            <option value="Website">Website</option>
                            <option value="Compress">Compress</option>
                            <option value="Other">Other</option>
                        </select>
                        <small> <?= (!empty($url) ? $url : ''); ?></small>
                    </div>
                    <br>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>URL: </b></label>
                        <input type="text" class="form-control" name="url" value="" placeholder="URL"
                            required>
                        <small> <?= (!empty($url) ? $url : ''); ?></small>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label><b>Content: </b></label>
                        <textarea rows="4" class="form-control" name="content" placeholder="Content"
                            required></textarea>
                        <small> <?= (!empty($content) ? $content : ''); ?></small>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Meta Title: </b></label>
                        <input type="text" class="form-control" name="meta_title" value="" placeholder="Meta Title" required>
                        <small> <?= (!empty($meta_title) ? $meta_title : ''); ?></small>
                    </div>
                    <br>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Meta Author: </b></label>
                        <input type="text" class="form-control" name="meta_author" value="" placeholder="Meta Author"
                            required>
                        <small> <?= (!empty($meta_author) ? $meta_author : ''); ?></small>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Meta Description: </b></label>
                        <textarea rows="3" class="form-control" name="meta_description" placeholder="Meta Description"
                            required></textarea>
                        <small> <?= (!empty($meta_description) ? $meta_description : ''); ?></small>
                    </div>
                    <br>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Key Words: </b></label>
                        <textarea rows="3" class="form-control" name="key_words" placeholder="Key Words" required></textarea>
                        <small> <?= (!empty($key_words) ? $key_words : ''); ?></small>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-12">
                    <div style="float: right;">
                        <input type="hidden" id="go_back" value="admin/blog">
                        <button type="button" class="btn btn-ft border-2 rounded-5 btn-outline-danger"
                            onClick="history.back();"><b> Back </b></button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-ft border-2 rounded-5 btn-outline-primary"
                            name="submit"><b>
                                Submit </b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
    require_once('../layouts/footer.php');
?>
