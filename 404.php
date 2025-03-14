
<?php 

    require_once('system/function.php'); 
    require_once('header.php'); 

    session_destroy();

?>

    <br><br><br>

<!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area text-center shadow dark bg-fixed text-light" style="background-image: url(assets/img/banner/8.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Error Page</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?= base_url; ?>"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active">404</li>
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
            <div class="row align-center">
                <div class="col-lg-6 thumb">
                    <img src="assets/img/illustration/5.png" alt="Thumb">
                </div>
                <div class="col-lg-6">
                    <div class="error-box">
                        <h1>404</h1>
                        <h2>Sorry page was not Found!</h2>
                        <p>
                            Household shameless incommode at no objection behaviour. Especially do at he possession insensible sympathize boisterous.
                        </p>
                        <a class="btn circle btn-gradient effect btn-md" href="<?= base_url; ?>">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End 404 -->

<?php require_once('footer.php'); ?>
