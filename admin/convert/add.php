
<?php
    require_once('../layouts/config.php');
    require_once('../layouts/function.php');
    require_once('../layouts/header.php');

    if(isset($_REQUEST['submit']))
    {
        if(empty($_REQUEST['title'])) {
            $title = "Title Field is Required.";
        }
        if(empty($_REQUEST['accept'])) {
            $accept = "Accept Field is Required.";
        }
        if(empty($_REQUEST['from'])) {
            $from = "Accept From Field is Required.";
        }
        if(empty($_REQUEST['to'])) {
            $to = "Converted to Field is Required.";
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
            '`created_by`' => $_SESSION['user_login_detail']['id'],
            '`title`' => $_REQUEST['title'],
            '`accept`' => $_REQUEST['accept'],
            '`from`' => $_REQUEST['from'],
            '`to`' => $_REQUEST['to'],
            '`file_type`' => $_REQUEST['file_type'],
            '`multiple`' => $_REQUEST['multiple'],
            '`type`' => $_REQUEST['type'],
            '`description`' => $_REQUEST['description'],
            '`meta_title`' => $_REQUEST['meta_title'],
            '`meta_author`' => $_REQUEST['meta_author'],
            '`meta_description`' => $_REQUEST['meta_description'],
            '`key_words`' => $_REQUEST['key_words'],
            'url' => str_replace(' ', '-', strtolower($_REQUEST['url'])),
        ];

        if (in_array(null, $data, true) || in_array('', $data, true)) {
            // There are null (or empty) values.
        } else {
            $return = insert('`convert_data`', $data, $conn);
            
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
            <h3>Convert Data Insert</h3>
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
                        <label><b>Accept Type: </b></label>
                        <input type="text" class="form-control" name="accept" value="" placeholder="Accept Type"
                            required>
                        <small> <?= (!empty($accept) ? $accept : ''); ?></small>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Accept From: </b></label>
                        <input type="text" class="form-control" name="from" value="" placeholder="Accept From" required>
                        <small> <?= (!empty($from) ? $from : ''); ?></small>
                    </div>
                    <br>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Converted To: </b></label>
                        <input type="text" class="form-control" name="to" value="" placeholder="Converted To" required>
                        <small> <?= (!empty($to) ? $to : ''); ?></small>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>File Type: </b></label>
                        <input type="text" class="form-control" name="file_type" value="" placeholder="File Type"
                            required>
                        <small> <?= (!empty($file_type) ? $file_type : ''); ?></small>
                    </div>
                    <br>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label><b>Number of File: </b></label>
                        <select class="form-control" name="multiple" required>
                            <option value="">Select a Option</option>
                            <option value="00">Single</option>
                            <option value="01">Multiple</option>
                        </select>
                        <small> <?= (!empty($multiple) ? $multiple : ''); ?></small>
                    </div>
                    <br>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label><b>Type: </b></label>
                        <select class="form-control" name="type" required>
                            <option value="">Select a Option</option>
                            <option value="File">File</option>
                            <option value="Url">Url</option>
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
                        <label><b>Description: </b></label>
                        <textarea rows="3" class="form-control" name="description" placeholder="Description" required></textarea>
                        <small> <?= (!empty($description) ? $description : ''); ?></small>
                    </div>
                    <br>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Meta Description: </b></label>
                        <textarea rows="3" class="form-control" name="meta_description" placeholder="Meta Description"
                            required></textarea>
                        <small> <?= (!empty($meta_description) ? $meta_description : ''); ?></small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label><b>Key Words: </b></label>
                        <textarea rows="2" class="form-control" name="key_words" placeholder="Key Words" required></textarea>
                        <small> <?= (!empty($key_words) ? $key_words : ''); ?></small>
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
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-12">
                    <div style="float: right;">
                        <input type="hidden" id="go_back" value="admin/convert">
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
