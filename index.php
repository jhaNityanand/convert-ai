
<?php 

    require_once('system/function.php'); 
    require_once('header.php'); 

    // echo rand(); die; 
    session_destroy();

    $conditions = [
        'ip_address' => getenv("REMOTE_ADDR"),
    ];
    delete_data('`multiple_images`', $conditions, $conn);

    $query = 'SELECT blog.*, COUNT(blog_comment.id) AS c_id FROM `blog` LEFT JOIN blog_comment ON blog.id = blog_comment.blog_id WHERE blog.status = 1 GROUP BY blog.id ORDER BY RAND(blog_comment.blog_id) LIMIT 0, 3';
    $all_data_blog_query = select_all_by_query($query, $conn);

?>

<!-- Start Banner 
    ============================================= -->
    <div class="banner-area content-bg circle-shape">
        <!-- Background -->
        <div class="bg" style="background-image: url(assets/img/banner/1.jpg);"></div>
        <!-- End Background -->
        <div class="item">
            <div class="container">
                <div class="row align-center">

                    <div class="col-lg-7 offset-lg-5">
                        <div class="content">
                            <h4 class="wow fadeInUp">For millions of users</h4>
                            <h2 class="wow fadeInDown">Powerful Digital <strong>IT solutions Company</strong></h2>
                            <p class="wow fadeInLeft">
                                Affixed pretend account ten natural. Need eat week even yet that. Incommode delighted he resolving sportsmen do in listening.
                            </p>
                            <a href="#" class="btn-animate wow fadeInRight">
                                <span class="circle">
                                  <span class="icon arrow"></span>
                                </span>
                                <span class="button-text">Get started</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner -->

    <br><br>

<!-- Start Case Studies Area
    ============================================= -->
    <!-- <div class="case-studies-area bg-gray default-padding-bottom">
        
        <div class="fixed-shape-top">
            <img src="assets/img/shape/bg-7.png" alt="Shape">
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h2 class="area-title">Our Recent Launched Converter</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fill">
            <div class="case-carousel text-center text-light owl-carousel owl-theme">
                <?php foreach ($all_data_com as $key => $value) { ?>
                    <div class="item">
                        <div class="thumb">
                            <img src="assets/img/portfolio/2.png" alt="Thumb">
                        </div>
                        <div class="info">
                            <div class="tags">
                                <a href="#"><?= strtoupper(str_replace('-', ' ', $value['url'])); ?></a>
                            </div>
                            <h4>
                                <a href="<?= base_url; ?>compress.php?url=<?= $value['url']; ?>" class="btn btn-ft rounded-5 btn-outline-danger"><b>Compress Now</b></a>
                            </h4>
                        </div>
                    </div>
                <?php } ?>
                <?php foreach ($all_data as $key => $value) { ?>
                    <div class="item">
                        <div class="thumb">
                            <img src="assets/img/portfolio/1.png" alt="Thumb">
                        </div>
                        <div class="info">
                            <div class="tags">
                                <a href="#"><?= strtoupper(str_replace('-', ' ', $value['url'])); ?></a>
                            </div>
                            <h4>
                                <?php if($value['id'] == '31') { ?>
                                    <a href="<?= base_url; ?>convert_m.php?url=<?= $value['url']; ?>" class="btn btn-ft rounded-5 btn-outline-danger"><b>Convert Now</b></a>
                                <?php } else { ?>
                                    <a href="<?= base_url; ?>convert.php?url=<?= $value['url']; ?>" class="btn btn-ft rounded-5 btn-outline-danger"><b>Convert Now</b></a>
                                <?php } ?>
                            </h4>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div> -->
    <!-- End Case Studies Area -->

<!-- Start Technology Area
    ============================================= -->
    <div class="technology-area default-padding-bottom bottom-less">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h5>Technology Index</h5>
                        <h2 class="area-title">Technology which we are using <br> in our platforms</h2>
                        <div class="devider"></div>
                        <p>
                            Outlived no dwelling denoting in peculiar as he believed. Behaviour excellent middleton be as it curiosity departure ourselves very extreme future. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="technology-items text-center">
                <div class="row">
                    <!-- Single Item -->
                    <div class="single-item col-lg-2 col-md-4 col-sm-6">
                        <a href="#">
                            <i class="fab fa-node-js"></i>
                            <h5>Node JS</h5>
                        </a>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-2 col-md-4 col-sm-6">
                        <a href="#">
                            <i class="fab fa-python"></i>
                            <h5>Python</h5>
                        </a>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-2 col-md-4 col-sm-6">
                        <a href="#">
                            <i class="fab fa-java"></i>
                            <h5>JavaScript</h5>
                        </a>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-2 col-md-4 col-sm-6">
                        <a href="#">
                            <i class="fab fa-php"></i>
                            <h5>PHP</h5>
                        </a>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-2 col-md-4 col-sm-6">
                        <a href="#">
                            <i class="fab fa-mailchimp"></i>
                            <h5>Mailchimp</h5>
                        </a>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-2 col-md-4 col-sm-6">
                        <a href="#">
                            <i class="fab fa-docker"></i>
                            <h5>Docker</h5>
                        </a>
                    </div>
                    <!-- End Single Item -->
                </div>
            </div>
        </div>
        <!-- Bottom Shape -->
        <div class="fixed-shape-bottom">
            <img src="assets/img/shape/1.jpg" alt="Shape">
        </div>
        <!-- End Bottom Shape -->
    </div>
    <!-- End Technology Area -->

<!-- Start Blog Area 
    ============================================= -->
    <div style="padding-bottom: 5px;" class="blog-area default-padding-bottom bottom-less">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h5>Our Blog</h5>
                        <h1 class="area-title">Latest News & Articles <br> Directly from Blog</h1>
                        <div class="devider"></div>
                        <p>
                            Outlived no dwelling denoting in peculiar as he believed. Behaviour excellent middleton be as it curiosity departure ourselves very extreme future. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="blog-items">
                <div class="row">
                    <?php
                        foreach ($all_data_blog_query as $key => $value) {
                    ?>
                    <!-- Single Item -->
                    <div class="single-item col-lg-4">
                        <div class="item">
                            <div class="thumb">
                                <img style="height: 100%; width: 100%;" src="assets/img/blog/<?php $arr = explode('/', $value['image']); echo end($arr); ?>" alt="Thumb">
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
                                <p>
                                    <?= substr($value['quote'], 0, 100)."....."; ?>
                                </p>
                                <a class="btn-more" href="<?= base_url; ?>blog-single.php?url=<?= $value['url']; ?>">Read More <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <?php
                        }
                    ?>
                    <!-- Single Item -->
                    <div class="single-item col-lg-12 text-center">
                        <a href="<?= base_url; ?>blog.php" class="btn btn-primary"><b> View More Post </b></a>
                    </div>
                    <!-- End Single Item -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog Area Area -->
    
<?php require_once('footer.php'); ?>
