
<?php

  require_once('system/function.php');

  $message = "";
  $error = "";
  $display = "none";

  if(isset($_REQUEST['url']) && !empty($_REQUEST['url'])) 
  {
    $conditions = [
      'url' => $_REQUEST['url'],
      'status' => 1,
    ];
    $return = single_row('`convert_data`', $conditions, $conn);

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


  if(isset($_REQUEST["file_submit"])) 
  {
    $display = "block";

    if(!empty($_FILES["formFile"]["name"]) || !empty($_REQUEST["formFile"])) {

      if(!empty($_FILES["formFile"]["name"])) {

        $filename = $_FILES["formFile"]["name"];
        $filetype = $_FILES["formFile"]["type"];
        $filetemp = $_FILES["formFile"]["tmp_name"];
      }
      else {
        $filename = $_REQUEST['formFile'];
        $filetype = "url";
        $filetemp = "";
      }

      if(!empty($_REQUEST['url'])) {

        $conditions = ['url' => $_REQUEST['url']];
        $return = single_row('`convert_data`', $conditions, $conn);

        if(!empty($return['id'])) {

          if(in_array($filetype, explode(', ', $return['file_type'])) || $return['file_type'] == "any") {
            
            if(!empty($_FILES["formFile"]["name"])) {

              $path = "system/uploaded/".time()."-".$filename;
              $path2 = "system/uploaded/base64_encoded/".time()."-".rand().".txt";
              move_uploaded_file($filetemp, $path);

              $content = chunk_split(base64_encode(file_get_contents($path)));
            }
            else {
              $path = $_REQUEST['formFile'];
              $path2 = $_REQUEST['formFile'];
              $content = $_REQUEST['formFile'];
            }

            $data = [
              '`ip_address`' => getenv("REMOTE_ADDR"),
              '`browser`' => $_SERVER['HTTP_USER_AGENT'],
              '`file_name`' => $filename,
              '`file_type`' => $filetype,
              // '`file_content`' => $path2,
              '`file_content`' => $path,
              '`converted_to`' => $return['to'],
            ];

            $return_data = insert("`received_data`", $data, $conn);

            if(!empty($return_data['last_id'])) {

              if($return['type'] == "File") {

                // make_text_file($path2, $content);
                // unlink($path);
                $return_data1 = convert_api_file($return['from'], $return['to'], $return_data['last_id'], $content, $filename, $conn);

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
              else if($return['type'] == "Url") {
                
                $return_data1 = convert_api_url($return['from'], $return['to'], $return_data['last_id'], $content, $filename, $conn);

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
                // Convert_data type error.
                $message = "<div class='alert alert-danger reload'>Something Went Wrong.</div>";
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

                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="mb-3">
                            
                            <?php if(!empty($return['type']) && $return['type'] == "File") { ?>

                              <label for="formFile" class="form-label">Browse your file: </label>
                              
                              <input class="form-control example" type="file" name="formFile"
                                accept="<?= (!empty($return['accept'])) ? $return['accept'] : ''; ?>"
                                data-toggle="tooltip" data-placement="top"
                                title=" <?= (!empty($return['accept'])) ? $return['accept'] : ''; ?>"
                                <?= ($return['multiple'] == '1') ? 'multiple' : ''; ?> required>

                              <?php } else if(!empty($return['type']) && $return['type'] == "Url") { ?>

                                <label for="formFile" class="form-label">Browse your URL: </label>

                                <input class="form-control example" type="url" name="formFile"
                                data-toggle="tooltip" data-placement="top"
                                title=" <?= (!empty($return['accept'])) ? $return['accept'] : ''; ?>"
                                placeholder="https://example.com" required>

                              <?php } ?>

                            <input type="hidden" name="url"
                                value="<?= (!empty($return['url'])) ? $return['url'] : ''; ?>">
                            <input type="hidden" name="submit" value="">
                        </div>
                        <div style="float: left;">
                            <button type="button" class="btn rounded-5 btn-danger"
                                onClick="back()"><b class="button">Back</b></button>
                        </div>
                        <div style="float: right;">
                            <button type="submit" class="btn rounded-5 btn-primary"
                                name="file_submit"><b class="button">Convert Now</b></button>
                        </div>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="row justify-content-center content_div text-center">
        <?php if(!empty($_SESSION['download_file_url'])) { ?>
        <div class="col-sm-12">
          <br>
            <?php 
              foreach($_SESSION['download_file_url'] as $key => $val) {
                  echo '<a style="padding-bottom: 5px;" class="trigger btn btn-ft border-2 rounded-5 btn-outline-success" href="'. $val. '" download><b>Download - '. ($key + 1) .'</b></a> &nbsp;';
              }
            ?>
        </div>
        <div class="col-sm-12">
            <button id="click" style="display: none;" class="button btn btn-ft border-2 rounded-5 btn-outline-success"><b class="button">
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

<script>
  // document.location.hash = "url=<?= $_REQUEST['url']; ?>";
</script>
