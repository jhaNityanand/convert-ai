
<?php

    require_once('system/function.php');

    $message = "";
    $error = "";
    $display = "none";

    if(!empty($_GET['url'])) {
        session_destroy();
    }

    if(isset($_REQUEST['url']) && !empty($_REQUEST['url'])) {

        $conditions = [
            'url' => $_REQUEST['url'],
            'status' => 1,
        ];
        $return = single_row('`compress_data`', $conditions, $conn);

        if(!empty($return['id'])) {
            // $message = "<div class='alert alert-success'>Record Get Successfully.</div>";
        } 
        else if(empty($return['id'])) {
            $message = "<div class='alert alert-danger reload'>Record not Found.</div>";
        }
        else {
            $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
        }
    } else {
        session_destroy();
        header("Location: ".base_url);
    }

    if(isset($_REQUEST["file_submit_zip"])) {
        
        $display = "block";
        if(count($_FILES["formFile"]["name"]) > 0 && !empty($_FILES["formFile"])) {

        if(!empty($_REQUEST['url'])) {

            $conditions = ['url' => $_REQUEST['url']];
            $return = single_row('`compress_data`', $conditions, $conn);

            if(!empty($return['id'])) {

            $folder_path = "system/uploaded/zip/folder-".time()."-".rand();
            $new_name = [];
            $new_type = [];
            $new_path = [];
            mkdir($folder_path);

            // echo "<pre>";
            // print_r($_FILES["formFile"]);
            // die;
        
            $total = count($_FILES['formFile']['name']);
            for( $i=0 ; $i < $total ; $i++ )
            {
                $filename = $_FILES['formFile']["name"][$i];
                $filetype = $_FILES['formFile']["type"][$i];
                $filetemp = $_FILES['formFile']["tmp_name"][$i];
        
                $path = $folder_path."/".($i+1)."-".$filename;
                move_uploaded_file($filetemp, $path);
                $new_name[] = $filename;
                $new_type[] = $filetype;
                $new_path[] = $path;
            }

            $data = [
                '`ip_address`' => getenv("REMOTE_ADDR"),
                '`browser`' => $_SERVER['HTTP_USER_AGENT'],
                '`file_name`' => implode(',', $new_name),
                '`file_type`' => implode(',', $new_type),
                '`file_content`' => $folder_path,
                '`converted_to`' => $return['type'],
            ];
            $return_data = insert("`received_data`", $data, $conn);

            if(!empty($return_data['last_id'])) {

                    $zipcreated = "system/uploaded/zip/zip-".time()."-".rand().".zip";
                    $return_data1 = zip($new_path, $zipcreated, $return_data['last_id'], $conn);

                if(!empty($return_data1['last_id'])) {

                    $data = ['file_content' => $zipcreated];
                    $conditions = ['id' => $return_data['last_id']];
                    update_data("received_data", $data, $conditions, $conn);

                    array_map('unlink', glob($folder_path."/*.*"));
                    rmdir($folder_path);
                    $_SESSION['download_file_url'] = $return_data1['file_url'];
                    $display = "none";
                }
                else {
                    // API not call properly.
                    $message = "<div class='alert alert-danger'>Something Went Wrong...</div>";
                    $display = "none";
                }
            }
            else {
                    // Insert received_data error.
                    $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
                    $display = "none";
            }
            } 
            else {
                // Record not get error.
                $message = "<div class='alert alert-danger reload'>Record not Found.</div>";
                $display = "none";
            }
        }
        else {
                // Converted ID not found error.
                $message = "<div class='alert alert-danger reload'>Something Went Wrong.</div>";
                $display = "none";
        }
        }
        else {
            // Select a file error.
            $message = "<div class='alert alert-danger'>Please Select a File.</div>";
            $display = "none";
        }
    }

    if(isset($_REQUEST["file_submit_images"])) {
        
        $display = "block";
        if(count($_FILES["formFile"]["name"]) > 0 && !empty($_REQUEST["quality"])) {

            if(!empty($_REQUEST['url'])) {

                $conditions = ['url' => $_REQUEST['url']];
                $return = single_row('`compress_data`', $conditions, $conn);

                if(!empty($return['id'])) {

                    $folder_path = "system/uploaded/images/folder-".time()."-".rand();
                    $folder_path_com = "system/uploaded/images/folder_com-".time()."-".rand();
                    $new_name = [];
                    $new_type = [];
                    $new_path = [];
                    $new_path_com = [];
                    mkdir($folder_path);
                    mkdir($folder_path_com);

                    // echo "<pre>";
                    // print_r($_FILES["formFile"]);
                    // die;
                
                    $total = count($_FILES['formFile']['name']);
                    for( $i=0 ; $i < $total ; $i++ )
                    {
                        $filename = $_FILES['formFile']["name"][$i];
                        $filetype = $_FILES['formFile']["type"][$i];
                        $filetemp = $_FILES['formFile']["tmp_name"][$i];

                        $path = $folder_path."/".($i+1)."-".$filename;
                        move_uploaded_file($filetemp, $path);
                        $new_name[] = $filename;
                        $new_type[] = $filetype;
                        $new_path[] = $path;

                        if(in_array($filetype, explode(', ', $return['file_type']))) {

                            $source = $path;
                            $destination = $folder_path_com."/".($i+1)."-".$filename;
                            $quality = $_REQUEST["quality"];
                            $return_data_com = compress($source, $destination, $quality);
                            $new_path_com[] = $destination;
                            $_SESSION['view_images'][] = $return_data_com;
                        }
                    }

                    $data = [
                        '`ip_address`' => getenv("REMOTE_ADDR"),
                        '`browser`' => $_SERVER['HTTP_USER_AGENT'],
                        '`file_name`' => implode(',', $new_name),
                        '`file_type`' => implode(',', $new_type),
                        '`file_content`' => $folder_path . ", Quality-".$_REQUEST['quality'],
                        '`converted_to`' => $return['type'],
                    ];
                    $return_data = insert("`received_data`", $data, $conn);

                    if(!empty($return_data['last_id'])) {

                        $tr = time()."-".rand();
                        $zipcreated = "system/uploaded/images/zip-".$tr.".zip";
                        $return_data1 = zip($new_path, $zipcreated, $return_data['last_id'], $conn);

                        $zipcreated_com = "system/uploaded/images/zip-".$tr."-com.zip";
                        $return_data_com = zip($new_path_com, $zipcreated_com, $return_data['last_id'], $conn);

                        if(!empty($return_data1['last_id']) && !empty($return_data_com['last_id'])) {

                            $data = ['file_content' => $zipcreated];
                            $conditions = ['id' => $return_data['last_id']];
                            update_data("received_data", $data, $conditions, $conn);

                            array_map('unlink', glob($folder_path."/*.*"));
                            rmdir($folder_path);
                            // array_map('unlink', glob($folder_path_com."/*.*"));
                            // rmdir($folder_path_com);

                            $_SESSION['download_file_url'] = $return_data_com['file_url'];
                            $display = "none";
                        }
                        else {
                            // API not call properly.
                            $message = "<div class='alert alert-danger'>Something Went Wrong...</div>";
                            $display = "none";
                        }
                    }
                    else {
                            // Insert received_data error.
                            $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
                            $display = "none";
                    }
                } 
                else {
                    // Record not get error.
                    $message = "<div class='alert alert-danger reload'>Record not Found.</div>";
                    $display = "none";
                }
            }
            else {
                // Converted ID not found error.
                $message = "<div class='alert alert-danger reload'>Something Went Wrong.</div>";
                $display = "none";
            }
        }
        else {
            // Select a file error.
            $message = "<div class='alert alert-danger'>All Fields are Required.</div>";
            $display = "none";
        }
    }

    if(isset($_REQUEST["file_submit_pdf"])) 
    {
        $display = "block";
        if(!empty($_FILES["formFile"]["name"])) {

            $filename = $_FILES["formFile"]["name"];
            $filetype = $_FILES["formFile"]["type"];
            $filetemp = $_FILES["formFile"]["tmp_name"];

            if(!empty($_REQUEST['url'])) {

                $conditions = ['url' => $_REQUEST['url']];
                $return = single_row('`compress_data`', $conditions, $conn);

                if(!empty($return['id'])) {

                    if(in_array($filetype, explode(', ', $return['file_type']))) {

                        $path = "system/uploaded/".time()."-".$filename;
                        $path2 = "system/uploaded/base64_encoded/".time()."-".rand().".txt";
                        move_uploaded_file($filetemp, $path);
                        $content = chunk_split(base64_encode(file_get_contents($path)));
                        
                        $data = [
                        '`ip_address`' => getenv("REMOTE_ADDR"),
                        '`browser`' => $_SERVER['HTTP_USER_AGENT'],
                        '`file_name`' => $filename,
                        '`file_type`' => $filetype,
                        // '`file_content`' => $path2,
                        '`file_content`' => $path,
                        '`converted_to`' => $return['type'],
                        ];

                        $return_data = insert("`received_data`", $data, $conn);

                        if(!empty($return_data['last_id'])) {

                            // make_text_file($path2, $content);
                            // unlink($path);
                            $return_data1 = compress_pdf_api($return_data['last_id'], $content, $filename, $conn);

                            if(!empty($return_data1['last_id'])) {

                                $_SESSION['download_file_url'] = $return_data1['file_url'];
                                $display = "none";
                            }
                            else {
                                // API not call properly.
                                $message = "<div class='alert alert-danger'>Something Went Wrong...</div>";
                                $display = "none";
                            }
                        }
                        else {
                            // Insert received_data error.
                            $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
                            $display = "none";
                        }
                    }
                    else {
                        // Choose wrong file error.
                        $message = "<div class='alert alert-danger'>Please Select Valid File Format.</div>";
                        $display = "none";
                    }
                } 
                else {
                    // Record not get error.
                    $message = "<div class='alert alert-danger reload'>Record not Found.</div>";
                    $display = "none";
                }
            }
            else {
                // Converted ID not found error.
                $message = "<div class='alert alert-danger reload'>Something Went Wrong.</div>";
                $display = "none";
            }
        }
        else {
            // Select a file error.
            $message = "<div class='alert alert-danger'>Please Select a Valid File.</div>";
            $display = "none";
        }
    }
  
?>

<?php require_once('header.php'); ?>

<div class="container">
    <br>
    <div class="row content_div">
        <div class="col-md-6 mx-auto">

            <br><br>
            
            <div> <b> <?= $message; ?> </b> </div>

            <?php if(!empty($return['id'])) { ?>
            <div class="shadow card border-secondary border-3 p-4 rounded bg-white">
                <div class="card-body">
                    <h3 class="card-title mb-3 text-center">
                        <b><?= (!empty($return['title'])) ? $return['title'] : ''; ?></b>
                    </h3>

                    <?php if(!empty($return['type']) && $return['type'] == "PDF") { ?>
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        <div class="mb-3">

                            <label for="formFile" class="form-label">Browse your file: </label>

                            <input class="form-control example" type="file" name="formFile"
                                accept="<?= (!empty($return['accept'])) ? $return['accept'] : ''; ?>"
                                data-toggle="tooltip" data-placement="top"
                                title=" <?= (!empty($return['accept'])) ? $return['accept'] : ''; ?>"
                                <?= ($return['multiple'] == '1') ? 'multiple' : ''; ?> required>

                            <input type="hidden" name="url"
                                value="<?= (!empty($return['url'])) ? $return['url'] : ''; ?>">
                            <input type="hidden" name="submit" value="">
                        </div>
                        <div style="float: left;">
                            <button type="button" class="btn btn-ft border-2 rounded-5 btn-danger"
                                onClick="back()"><b class="button">Back</b></button>
                        </div>
                        <div style="float: right;">
                            <button type="submit" class="btn btn-ft border-2 rounded-5 btn-primary"
                                name="file_submit_pdf"><b class="button">Compress PDF</b></button>
                        </div>
                    </form>
                    <?php } ?>

                    <?php if(!empty($return['type']) && $return['type'] == "Zip") { ?>
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        <div class="mb-3">

                            <label for="formFile" class="form-label">Browse your file: </label>

                            <input class="form-control example" type="file" name="formFile[]"
                                accept="<?= (!empty($return['accept'])) ? $return['accept'] : ''; ?>"
                                data-toggle="tooltip" data-placement="top"
                                title=" <?= (!empty($return['accept'])) ? $return['accept'] : ''; ?>"
                                <?= ($return['multiple'] == '1') ? 'multiple' : ''; ?> required>

                            <input type="hidden" name="url"
                                value="<?= (!empty($return['url'])) ? $return['url'] : ''; ?>">
                            <input type="hidden" name="submit" value="">
                        </div>
                        <div style="float: left;">
                            <button type="button" class="btn btn-danger"
                                onClick="back()"><b class="button">Back</b></button>
                        </div>
                        <div style="float: right;">
                            <button type="submit" class="btn btn-primary"
                                name="file_submit_zip"><b class="button">Convert to Zip</b></button>
                        </div>
                    </form>
                    <?php } ?>

                    <?php if(!empty($return['type']) && $return['type'] == "Images") { ?>
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data"
                        autocomplete="off">

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Set Images Quality: </label>

                            <input type="number" class="form-control example" name="quality" data-toggle="tooltip"
                                data-placement="top" title="Set Images Quality (1 to 99)" min="1" max="99" step="1"
                                placeholder="Enter Images Quality" required />
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Browse your file: </label>

                            <input class="form-control example" type="file" name="formFile[]"
                                accept="<?= (!empty($return['accept'])) ? $return['accept'] : ''; ?>"
                                data-toggle="tooltip" data-placement="top"
                                title=" <?= (!empty($return['accept'])) ? $return['accept'] : ''; ?>"
                                <?= ($return['multiple'] == '1') ? 'multiple' : ''; ?> required />

                            <input type="hidden" name="url"
                                value="<?= (!empty($return['url'])) ? $return['url'] : ''; ?>">
                            <input type="hidden" name="submit" value="">
                        </div>
                        <div style="float: left;">
                            <button type="button" class="btn btn-ft border-2 rounded-5 btn-danger"
                                onClick="back()"><b class="button">Back</b></button>
                        </div>
                        <div style="float: right;">
                            <button type="submit" class="btn btn-ft border-2 rounded-5 btn-primary"
                                name="file_submit_images"><b class="button">Compress Now</b></button>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="row justify-content-center content_div text-center">
        <?php if(!empty($_SESSION['view_images'][0])) { ?>
            <div class="col-sm-1">
                <br>
                <a class="btn btn-ft border-2 rounded-5 btn-outline-dark" href="view.php" target="_blank"><b> View </b></a>
            </div>
        <?php } ?>
        <?php if(!empty($_SESSION['download_file_url'])) { ?>
        <div class="col-sm-1">
            <br>
            <?php 
                foreach($_SESSION['download_file_url'] as $key => $val) {
                    echo '<a style="padding-bottom: 5px;" class="trigger btn btn-ft border-2 rounded-5 btn-outline-success" href="'. $val. '" download><b>Download</b></a>';
                }
            ?>
        </div>
        <div class="col-sm-12">
            <button id="click" style="display: none;"
                class="button btn btn-ft border-2 rounded-5 btn-outline-success"><b class="button">
                    Download </b></button>
        </div>
        <?php } ?>
    </div>

    <div class="row content_div">
        <?php if(!empty($return['description'])) { ?>
            <div class="col-md-8 mx-auto">
                <br>
                <h4><b> Description: </b></h4>
                <h6>
                    <?= (!empty($return['description'])) ? $return['description'] : ''; ?>
                </h6>
            </div>
        <?php } ?>
    </div>
</div>

<?php require_once('footer.php'); ?>
