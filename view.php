
<?php require_once('system/function.php'); ?>
<?php require_once('header.php'); ?>

<style>
    .img {
        max-width: 300px;
        max-height: 350px;
        padding: 1px;
        width: 300px;
        height: 300px;
        border: 1px solid black;
    }

    .a {
        margin-top: 7px;
        margin-bottom: 7px;
    }
</style>

    <div class="container">

        <br><br><br>
        
        <?php if(!empty($_SESSION['view_images'][0])) { ?>
            <h1>View All Image's</h1>
            <div class="row justify-content-center content_div text-center">
                <?php foreach($_SESSION['view_images'] as $key => $val) { ?>
                    <div class="col-sm-4">
                        <a class="" href="<?= $val; ?>" target="_blank"><img class="img" src="<?= $val; ?>"></a>
                        <br>
                        <a class="btn btn-ft border-2 rounded-5 btn-outline-success a" href="<?= $val; ?>" download><b>Download</b></a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="row justify-content-center content_div text-center">
            <div class="col-sm-2">
                <button onclick="back()" class="btn btn-ft border-2 rounded-5 btn-danger"><b>HOME</b></button>
            </div>
        </div>

        <div class="row justify-content-center content_div text-center">
            <?php
                if(!empty($_SESSION['download_file_url'][0]) && empty($_SESSION['view_images'][0])) {
                    foreach($_SESSION['download_file_url'] as $key => $val) {
            ?>
            <div>
                <object data="<?= $val; ?>" type="application/pdf" width="300" height="200">
                    <a class="btn btn-ft border-2 rounded-5 btn-outline-success" href="<?= $val; ?>" download><b>Download</b></a>
                </object>
            </div>
            <?php } } ?>
        </div>
    </div>

<?php require_once('footer.php'); ?>
