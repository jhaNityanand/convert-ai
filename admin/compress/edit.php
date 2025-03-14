
<?php
    require_once('../layouts/config.php');
    require_once('../layouts/function.php');
    require_once('../layouts/header.php');


    if(isset($_REQUEST['e_id']) && !empty($_REQUEST['e_id'])) {
        $conditions = ['id' => $_REQUEST['e_id']];
        $return = single_row('`compress_data`', $conditions, $conn);

        if(!empty($return['id'])) {

            if($_SESSION['user_login_detail']['id'] != $return['created_by'])
            {
                $message = "<div class='alert alert-danger reload'>You Don't have Permission to Access.</div>";
            }
            // $message = "<div class='alert alert-success'>Record Get Successfully.</div>";
        } 
        else if(empty($return['id'])) {
            $message = "<div class='alert alert-danger reload'>Record not Found.</div>";
        }
        else {
            $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
        }
    } else {
        header("Location: ".base_url."admin/compress");
    }

    if(isset($_REQUEST['submit']))
    {
        if(empty($_REQUEST['title'])) {
            $title = "Title Field is Required.";
        }
        if(empty($_REQUEST['accept'])) {
            $accept = "Accept Field is Required.";
        }
        if(empty($_REQUEST['file_type'])) {
            $file_type = "File Type Field is Required.";
        }
        if(empty($_REQUEST['multiple'])) {
            $multiple = "Number of File Field is Required.";
        }
        if(empty($_REQUEST['type'])) {
            $type = "Type Field is Required.";
        }
        if(empty($_REQUEST['meta_title'])) {
            $meta_title = "Meta Title Field is Required.";
        }
        if(empty($_REQUEST['meta_author'])) {
            $meta_author = "Meta Author Field is Required.";
        }
        if(empty($_REQUEST['description'])) {
            $description = "Description Field is Required.";
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
        $data = [
            'title' => $_REQUEST['title'],
            'accept' => $_REQUEST['accept'],
            'file_type' => $_REQUEST['file_type'],
            'multiple' => $_REQUEST['multiple'],
            'type' => $_REQUEST['type'],
            'description' => $_REQUEST['description'],
            'meta_title' => $_REQUEST['meta_title'],
            'meta_author' => $_REQUEST['meta_author'],
            'meta_description' => $_REQUEST['meta_description'],
            'key_words' => $_REQUEST['key_words'],
            'url' => str_replace(' ', '-', strtolower($_REQUEST['url'])),
        ];

        if (in_array(null, $data, true) || in_array('', $data, true)) {
            // There are null (or empty) values.
        } else {
            $conditions = ['id' => $_REQUEST['e_id']];
            $return = update_data('`compress_data`', $data, $conditions, $conn);

            if(!empty($return)) {
                $message = "<div class='alert alert-success'>Record Updated Successfully.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
            }
        }
    }
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" autocomplete="on">
    <div class="card card-body rounded bg-white">
        <div class="card-header">
            <h3>Compress Data Update</h3>
            <?= (!empty($message)? $message : ''); ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Title: </b></label>
                        <input type="text" class="form-control" name="title" value="<?= (!empty($return['title'])) ? $return['title'] : '' ?>" placeholder="Title" required>
                        <small> <?= (!empty($title) ? $title : ''); ?></small>
                    </div>
                    <br>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Accept Type: </b></label>
                        <input type="text" class="form-control" name="accept" value="<?= (!empty($return['accept'])) ? $return['accept'] : '' ?>" placeholder="Accept Type"
                            required>
                        <small> <?= (!empty($accept) ? $accept : ''); ?></small>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>File Type: </b></label>
                        <input type="text" class="form-control" name="file_type" value="<?= (!empty($return['file_type'])) ? $return['file_type'] : '' ?>" placeholder="File Type"
                            required>
                        <small> <?= (!empty($file_type) ? $file_type : ''); ?></small>
                    </div>
                    <br>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Number of File: </b></label>
                        <select class="form-control" name="multiple" required>
                            <option value="">Select a Option</option>
                            <option value="00" <?= ($return['multiple'] == "0") ? 'selected' : '' ?>>Single</option>
                            <option value="01" <?= ($return['multiple'] == "1") ? 'selected' : '' ?>>Multiple</option>
                        </select>
                        <small> <?= (!empty($multiple) ? $multiple : ''); ?></small>
                    </div>
                    <br>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Type: </b></label>
                        <select class="form-control" name="type" required>
                            <option value="">Select a Option</option>
                            <option value="PDF" <?= ($return['type'] == "PDF") ? 'selected' : '' ?>>PDF</option>
                            <option value="Zip" <?= ($return['type'] == "Zip") ? 'selected' : '' ?>>Zip</option>
                            <option value="Images" <?= ($return['type'] == "Images") ? 'selected' : '' ?>>Images</option>
                        </select>
                        <small> <?= (!empty($type) ? $type : ''); ?></small>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Meta Title: </b></label>
                        <input type="text" class="form-control" name="meta_title" value="<?= (!empty($return['meta_title'])) ? $return['meta_title'] : '' ?>" placeholder="Meta Title" required>
                        <small> <?= (!empty($meta_title) ? $meta_title : ''); ?></small>
                    </div>
                    <br>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Meta Author: </b></label>
                        <input type="text" class="form-control" name="meta_author" value="<?= (!empty($return['meta_author'])) ? $return['meta_author'] : '' ?>" placeholder="Meta Author"
                            required>
                        <small> <?= (!empty($meta_author) ? $meta_author : ''); ?></small>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Description: </b></label>
                        <textarea rows="3" class="form-control" name="description" placeholder="Description" required>
                            <?= (!empty($return['description'])) ? $return['description'] : '' ?>
                        </textarea>
                        <small> <?= (!empty($description) ? $description : ''); ?></small>
                    </div>
                    <br>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Meta Description: </b></label>
                        <textarea rows="3" class="form-control" name="meta_description" placeholder="Meta Description"
                            required>
                            <?= (!empty($return['meta_description'])) ? $return['meta_description'] : '' ?>
                        </textarea>
                        <small> <?= (!empty($meta_description) ? $meta_description : ''); ?></small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Key Words: </b></label>
                        <textarea rows="2" class="form-control" name="key_words" placeholder="Key Words" required>
                            <?= (!empty($return['key_words'])) ? $return['key_words'] : '' ?>
                        </textarea>
                        <small> <?= (!empty($key_words) ? $key_words : ''); ?></small>
                    </div>
                    <br>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>URL: </b></label>
                        <input type="text" class="form-control" name="url" value="<?= (!empty($return['url'])) ? $return['url'] : '' ?>" placeholder="URL"
                            required>
                        <small> <?= (!empty($url) ? $url : ''); ?></small>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-12">
                    <div style="float: right;">
                        <input type="hidden" name="e_id" value="<?= (!empty($return['id'])) ? $return['id'] : '' ?>">
                        <input type="hidden" id="go_back" value="admin/compress">
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
