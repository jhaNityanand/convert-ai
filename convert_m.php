
<?php

  require_once('system/function.php');

  $message = "";
  $error = "";
  $display = "none";

  if(isset($_REQUEST['url']) && !empty($_REQUEST['url'])) {

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
    session_destroy();
    $display = "block";

    if(count($_FILES["formFile"]["name"]) > 0) {

      if(!empty($_REQUEST['url'])) {

        $conditions = ['url' => $_REQUEST['url']];
        $return = single_row('`convert_data`', $conditions, $conn);

        if(!empty($return['id'])) {

          $folder_path = "system/uploaded/multiple_images/folder-".time()."-".rand();
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

              if(in_array('image', explode('/', $filetype))) {

                $data = [
                  '`ip_address`' => getenv("REMOTE_ADDR"),
                  '`image`' => $path,
                ];
                $return_data = insert("`multiple_images`", $data, $conn);
                // $_SESSION['id'][] = $return_data['last_id'];
                // $_SESSION['path'][] = $path;
              }
          }
          $display = "none";
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

  if(isset($_REQUEST['convert_to_pdf']))
  {
    $folder_path = "system/uploaded/multiple_images/folder-".time()."-".rand();
    mkdir($folder_path);

    $conditions = [
      '`ip_address`' => getenv("REMOTE_ADDR"),
    ];
    // $all_record = select_all_by_conditions_ip('multiple_images', $conditions, $conn);
    
    $query = "SELECT * FROM `multiple_images` WHERE ip_address = '".getenv('REMOTE_ADDR')."' ORDER BY id DESC";
    $all_record = select_all_by_query($query, $conn);

    $content = [];
    $filename = [];
    $api_data = [];
    foreach ($all_record as $key => $value) {
      
      $content[] = chunk_split(base64_encode(file_get_contents($value['image'])));
      $source_file = $value['image'];
      $destination_path = $folder_path . '/' . pathinfo($source_file, PATHINFO_BASENAME);
      $filename[] = $folder_path . '/' . pathinfo($source_file, PATHINFO_BASENAME);

      $api_data[] = [
        "Name" => pathinfo($source_file, PATHINFO_BASENAME), 
        "Data" => chunk_split(base64_encode(file_get_contents($value['image']))),
      ];

      rename($source_file, $destination_path);
    }

    $content_data = json_encode($api_data, true);

    $path = "system/uploaded/multiple_images";
    RemoveEmptySubFolders($path);

    $conditions = [
        'ip_address' => getenv("REMOTE_ADDR"),
    ];
    delete_data('`multiple_images`', $conditions, $conn);

    if(!empty($_REQUEST['url'])) {

      $conditions = ['url' => $_REQUEST['url']];
      $return = single_row('`convert_data`', $conditions, $conn);

      if(!empty($return['id'])) {

        $data = [
          '`ip_address`' => getenv("REMOTE_ADDR"),
          '`browser`' => $_SERVER['HTTP_USER_AGENT'],
          '`file_name`' => implode(',', $filename),
          '`file_type`' => $return['file_type'],
          '`file_content`' => $folder_path,
          '`converted_to`' => $return['to'],
        ];
    
        $return_data = insert("`received_data`", $data, $conn);
    
        if(!empty($return_data['last_id'])) {
          
          $return_data1 = convert_to_pdf_api($return['from'], $return['to'], $return_data['last_id'], $api_data, $conn);

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
  
?>

<?php require_once('header.php'); ?>

<style>
    .view_image {
        border: 1px solid black;
        margin-top: 15px;
        margin-bottom: 15px;
        width: 110px;
        height: 120px;
        background-size: contain;
        background-repeat:no-repeat;
        background-position-x: center;
        background-position-y: center;
    }
    .delete_button {
        float: right;
    }
    .numbering {
      float: left;
    }
</style>


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
                              
                              <input class="form-control example" type="file" name="formFile[]"
                                accept="<?= (!empty($return['accept'])) ? $return['accept'] : ''; ?>"
                                data-toggle="tooltip" data-placement="top"
                                title=" <?= (!empty($return['accept'])) ? $return['accept'] : ''; ?>"
                                <?= ($return['multiple'] == '1') ? 'multiple' : ''; ?> required>

                              <?php } ?>

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
                                name="file_submit"><b class="button">Upload</b></button>
                        </div>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="row px-5 justify-content-center content_div text-center">
        <?php
          $conditions = [
            '`ip_address`' => getenv("REMOTE_ADDR"),
          ];
          $view_datas = select_all_by_conditions_ip('multiple_images', $conditions, $conn);

          if(!empty($view_datas)) {
        ?>
        <div class="col-sm-12 mx-auto">
          <div class="row justify-content-center content_div text-center">
            <?php
                foreach($view_datas as $key => $val) {
            ?>
            <div class="col-sm-2 remove_<?= $key; ?>">
              <!-- <img class="view_image" src="<?= $val['image']; ?>" alt=""> -->
              <div class="view_image" style="background-image: url('<?= $val['image']; ?>');">
                  <div class="">
                    <!-- <button class="numbering btn btn-ft border-2 rounded-5 btn-outline-primary"><b><?= $key+1; ?></b></button> -->
                    <button onclick="deletes('<?= $key; ?>', '<?= $val['id']; ?>')" class="delete_button btn btn-ft border-2 rounded-5 btn-outline-danger"><b>X</b></button>
                  </div>
              </div>
            </div>
            <?php } ?>
            <input type="hidden" id="count_img" value="<?= ($key + 1); ?>">
          </div>
        </div>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="col-sm-12 mx-auto hide_div">
            <input type="hidden" name="url" value="images-to-pdf">
            <button name="convert_to_pdf" class="btn btn-success" type="submit"><b>Convert to PDF</b></button>
          </div>
        </form>
        <?php } ?>
    </div>

    <div class="row justify-content-center download_view content_div text-center">
        <?php if(!empty($_SESSION['download_file_url'][0])) { ?>
        <div class="col-sm-12">
          <br>
            <?php 
              // header('Location: '.base_url.'view.php');
              
              foreach($_SESSION['download_file_url'] as $key => $val) {
                  echo '<a style="padding-bottom: 5px;" class="trigger btn btn-ft border-2 rounded-5 btn-outline-success" href="'. $val. '" download><b>Download</b></a> &nbsp;';
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
  function deletes(i, id) {

    $.ajax({
      url: "system/ajax.php",
      method:'POST',
      data: {'check': 'delete_image', 'id': id},
      // dataType: 'json',
      success: function(result) {
        $(".remove_"+i).remove();
      },
      error: function(result) {
        alert(result);
      }
    });

    var count = $('#count_img').val();
    $('#count_img').val((count - 1));

    if ($('#count_img').val() == '0') {
        $('.hide_div').remove();
    }

    // 230110020558
    // Jha@1234567
  }

  $(document).ready(function() {

    if(document.getElementById('count_img')) {
        $('.download_view').remove();
    } else {
      // $('.download_view').remove();
    }

    $('.trigger').click();
      
  });

  // document.location.hash = "url=<?= $_REQUEST['url']; ?>";
</script>
