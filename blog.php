
<?php 

    require_once('system/function.php'); 
    require_once('header.php'); 

    if(empty($_REQUEST['url'])) {
        $url = '';
    } else {
        $url = $_REQUEST['url'];
        
        $query = 'SELECT blog.*, COUNT(blog_comment.id) AS c_id FROM `blog` LEFT JOIN blog_comment ON blog.id = blog_comment.blog_id WHERE blog.status = 1 AND blog.category = "'.$url.'" GROUP BY blog.id';
        $all_data_blog = select_all_by_query($query, $conn);
    }

    session_destroy();

?>

    <br><br><br>

    <div class="container">
        <!-- Start Breadcrumb 
        ============================================= -->
        <!-- <div class="breadcrumb-area text-center shadow dark bg-fixed text-light" style="background-image: url(assets/img/banner/11.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Blog <?= (!empty($url)) ? 'Category' : ''; ?></h2>
                        <ul class="breadcrumb">
                            <li><a href="<?= base_url; ?>"><i class="fas fa-home"></i> Home</a></li>
                            <li><a href="<?= base_url; ?>blog.php">Blog</a></li>
                            <?= (!empty($url)) ? '<li class="active">'.$url.'</li>' : ''; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- End Breadcrumb -->

        <!-- <br> -->
        <div class="row">
            <div class="col-sm-4">
                <select id="change_cat">
                    <option value="">Select a Category</option>
                    <?php foreach ($all_data_blog_cat as $key => $value) { ?>
                            <option value="<?= $value['category']; ?>" <?= ($value['category'] == $url) ? 'selected' : ''; ?>><?= $value['category']; ?> (<?= $value['cat_id']; ?>)</option>                   
                    <?php } ?>
                </select>
            </div>
        </div>

        <?php
            if(empty($all_data_blog[0])) {
        ?>
            <div class="row justify-content-center text-center">
            <div class="col-sm-12">
                <h1><b>No Record Found</b></h1>
            </div>
        </div>
        <?php
            }
        ?>

        <!-- Start Blog
        ============================================= -->
        <div style="padding-top: 5px;padding-bottom: 5px;" class="blog-area grid-colum default-padding">
            <div class="container">
                <div class="blog-items">
                    <div class="blog-content">
                        <div class="blog-item-box">
                            <div class="row">
                                <?php
                                    foreach ($all_data_blog as $key => $value) {
                                ?>
                                <!-- Single Item -->
                                <div class="col-lg-4 col-md-6 single-item">
                                    <div class="item wow fadeInUp" data-wow-delay="500ms">
                                        <div class="thumb">
                                            <a href="<?= base_url; ?>blog-single.php?url=<?= $value['url']; ?>">
                                                <img style="height: 100%; width: 100%;" src="assets/img/blog/<?php $arr = explode('/', $value['image']); echo end($arr); ?>" alt="Thumb">
                                            </a>
                                            <div class="date"><?= date('d', strtotime($value['created_at'])); ?> <span><?= date('M, Y', strtotime($value['created_at'])); ?></span></div>
                                        </div>
                                        <div class="info">
                                            <div class="meta">
                                                <ul>
                                                    <li><a href="#"><i class="fas fa-user"></i> <?= current(explode(' ', $value['author'])); ?></a></li>
                                                    <li><a href="#"><i class="fas fa-comments"></i> <?= $value['c_id']; ?> Comments</a></li>
                                                </ul>
                                            </div>
                                            <h4>
                                                <a href="<?= base_url; ?>blog-single.php?url=<?= $value['url']; ?>"><?= $value['title']; ?></a>
                                            </h4>
                                            <a class="btn-more" href="<?= base_url; ?>blog-single.php?url=<?= $value['url']; ?>">Read More <i class="fas fa-long-arrow-alt-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <?php
                                    }
                                ?>
                            </div>
                            
                            <!-- Pagination -->
                            <!-- <div class="row">
                                <div class="col-md-12 pagi-area text-center">
                                    <nav aria-label="navigation">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Blog -->
    </div>

<?php require_once('footer.php'); ?>

<script>
    $('#change_cat').on('change', function(){
        window.location.href = '<?= base_url; ?>blog.php?url='+$(this).val();
    });
</script>
