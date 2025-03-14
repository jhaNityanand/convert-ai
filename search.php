
<?php 

    require_once('system/function.php'); 
    require_once('header.php');

    if(isset($_REQUEST['text']))
    {
        if(!empty($_REQUEST['text']))
        {
            $query = "SELECT * FROM `convert_data` WHERE title LIKE '%".$_REQUEST['text']."%'";
            $all_data_query = select_all_by_query($query, $conn);
    
            $query = "SELECT * FROM `compress_data` WHERE title LIKE '%".$_REQUEST['text']."%'";
            $all_data_query_com = select_all_by_query($query, $conn);

            $query = "SELECT * FROM `blog` WHERE title LIKE '%".$_REQUEST['text']."%'";
            $all_data_query_blog = select_all_by_query($query, $conn);
        }
    }

    session_destroy();

?>

    <br><br><br>

<!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area text-center shadow dark bg-fixed text-light" style="background-image: url(assets/img/banner/8.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Search Results</h2>
                    <ul class="breadcrumb">
                        <li><a href="<?= base_url; ?>"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#">Search</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

<!-- Start 404 
    ============================================= -->
    <div style="padding-top: 50px;padding-bottom: 5px;" class="error-page-area default-padding">
        <div class="container">
            <div class="row align-center text-center">

                <?php if(count($all_data_query) < 1 && count($all_data_query_com) < 1 && count($all_data_query_blog) < 1) { ?>
                    
                    <div class="col-lg-12">
                        <h1>No Result Found.</h1>
                        <a class="btn circle btn-gradient effect btn-md" href="<?= base_url; ?>">Back to Home</a>
                    </div>

                <?php } else if(!empty($_REQUEST['text']) && (count($all_data_query) >= 1 || count($all_data_query_com) >= 1  || count($all_data_query_blog) >= 1)) { ?>
                    
                    <div class="col-lg-12">
                        <h1>Result Found.</h1>

                        <div class="row text-left">
                            <?php foreach ($all_data_query_blog as $key => $value) { ?>
                                <div class="col-lg-3 p-1">
                                    <a href="<?= base_url; ?>blog-single.php?url=<?= $value['url']; ?>" class="btn btn-primary"><?= $value['title']; ?></a>
                                </div>
                            <?php } ?>
                            <?php foreach ($all_data_query_com as $key => $value) { ?>
                                <div class="col-lg-3 p-1">
                                    <a href="<?= base_url; ?>compress.php?url=<?= $value['url']; ?>" class="btn btn-primary"><?= $value['title']; ?></a>
                                </div>
                            <?php } ?>
                            <?php foreach ($all_data_query as $key => $value) { ?>
                                <div class="col-lg-3 p-1">
                                    <?php if($value['id'] == '31') { ?>
                                        <a href="<?= base_url; ?>convert_m.php?url=<?= $value['url']; ?>" class="btn btn-primary"><?= $value['title']; ?></a>
                                    <?php } else { ?>
                                        <a href="<?= base_url; ?>convert.php?url=<?= $value['url']; ?>" class="btn btn-primary"><?= $value['title']; ?></a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>

                    </div>

                <?php } else { ?>

                    <div class="col-lg-12">
                        <a class="btn circle btn-gradient effect btn-md" href="<?= base_url; ?>">Back to Home</a>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
    <!-- End 404 -->

<?php require_once('footer.php'); ?>
