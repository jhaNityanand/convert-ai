
<?php 

    $conditions = [
        'status' => 1,
    ];
    // $all_data = select_all('`convert_data`', $conn);
    $all_data = select_all_by_conditions('`convert_data`',$conditions, $conn);
    $all_data_com = select_all_by_conditions('`compress_data`',$conditions, $conn);
    $all_data_blog = select_all_by_conditions('`blog`',$conditions, $conn);

    $query = 'SELECT blog.*, COUNT(blog_comment.id) AS c_id FROM `blog` LEFT JOIN blog_comment ON blog.id = blog_comment.blog_id WHERE blog.status = 1 GROUP BY blog.id';
    $all_data_blog = select_all_by_query($query, $conn);
    
    $query = "SELECT *, COUNT(id) AS c_id FROM `convert_data` GROUP BY sequence HAVING COUNT(*) > 1 ORDER BY c_id DESC";
    $all_data_query = select_all_by_query($query, $conn);

    $query = "SELECT *, COUNT(id) AS c_id FROM `convert_data` GROUP BY sequence HAVING COUNT(*) < 2 ORDER BY c_id DESC";
    $all_data_query_other = select_all_by_query($query, $conn);

    $query = "SELECT *, count(id) AS cat_id FROM `blog` GROUP BY category ORDER BY cat_id DESC";
    $all_data_blog_cat = select_all_by_query($query, $conn);

    $all_keywords_url = [];
    $all_keywords_title = [];
    $all_keywords = [];
    $all_keywords_accept = [];

    foreach ($all_data as $key => $value) {
        $all_keywords_url[] = $value['url'];
        $all_keywords_title[] = $value['title'];
        $all_keywords_accept[] = $value['accept'];
    }
    foreach ($all_data_com as $key => $value) {
        $all_keywords_url[] = $value['url'];
        $all_keywords_title[] = $value['title'];
        $all_keywords_accept[] = $value['accept'];
    }
    foreach ($all_data_blog as $key => $value) {
        $all_keywords_url[] = $value['url'];
        $all_keywords_title[] = $value['title'];
    }

    $urlss = implode(', ', $all_keywords_url);
    $titless = implode(', ', $all_keywords_title);
    $tagss = implode(', ', $all_keywords);

    $accept = implode(', ', $all_keywords_accept);
    $accept = explode(', ', $accept);
    $accept = array_unique($accept);
    $accept = str_replace('.', '', implode(', ', $accept));

    /* echo "<pre>";
    print_r($accept);
    die; */

?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from validthemes.live/themeforest/solion/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Mar 2023 06:00:35 GMT -->

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="<?= (!empty($return['meta_title'])) ? $return['meta_title'] : $titless; ?>">
    <meta name="description" content="<?= (!empty($return['meta_description'])) ? $return['meta_description'] : 'File conversion involves changing the format of a file, while file compression involves reducing its size without affecting its quality.' /* $urlss; */ /* $urlss.', '.$titless.', '.$tagss; */ ?>">
    <meta name="keywords" content="<?= (!empty($return['accept'])) ? str_replace('.', '', $return['accept']).', '.$return['key_words'].', '.$return['url'] : $accept; ?>">
    <meta name="author" content="<?= (!empty($return['meta_author'])) ? $return['meta_author'] : 'convertai.in'; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='pageKey' content="<?= (!empty($return['accept'])) ? str_replace('.', '', $return['accept']).', '.$return['key_words'].', '.$return['url'].', '.$return['title'] : $accept; ?>">
    <meta name='target' content='all, <?= (!empty($return['accept'])) ? str_replace('.', '', $return['accept']) : $accept; ?>'>
    <meta name='HandheldFriendly' content='True'>
    <meta name='MobileOptimized' content='320'>
    <meta name='date' content='<?= date('Y M d G:i:s'); ?>'>
    <meta name='search_date' content='<?= date('Y M d G:i:s'); ?>'>
    <meta name='copyright' content='convertai'>
    <meta name='language' content='ES'>
    <meta name='robots' content='index,follow'>
    <meta name='topic' content="<?= (!empty($return['title'])) ? $return['title'] : $titless; ?>">
    <meta name='summary' content="<?= (!empty($return['description'])) ? strip_tags($return['description']) : 'Converting and compressing files are important tasks that can help save storage space and optimize file transfers. File conversion involves changing the format of a file, while file compression involves reducing its size without affecting its quality. Both tasks can be accomplished using various software tools and techniques, depending on the specific needs and preferences of the user. Effective file conversion and compression can improve file management, increase accessibility, and enhance productivity.'; ?>">
    <meta name='url' content='<?= base_url; ?>'>
    <meta name='identifier-URL' content='<?= base_url; ?>'>
    <meta name='directory' content='submission'>
    <meta name='pagename' content="<?= (!empty($return['title'])) ? $return['title'] : 'Convert Application' ?>" Reilly Media>
    <meta name='category' content='<?= (!empty($return['accept'])) ? str_replace('.', '', $return['accept']) : $accept; ?>'>
    <meta name='coverage' content='Worldwide'>
    <meta name='distribution' content='Global'>
    <meta name='rating' content='General'>
    <meta name='revisit-after' content='7 days'>
    <meta name="subtitle" content="<?= (!empty($return['meta_title'])) ? $return['meta_title'] : 'Convert Application'; ?>">
    <meta name="news_keywords" content="<?= $accept; ?>">
    <meta name="tag" content="<?= $titless.', '.$urlss; ?>">
    <meta name="blog" content="<?= $titless.', '.$urlss; ?>">

    <meta property="og:site_name" content="convertai - Online tools for convert files"/>
    <meta property="og:title" content="<?= (!empty($return['meta_title'])) ? $return['meta_title'] : $titless; ?>"/>
    <meta property="og:description" content="<?= (!empty($return['meta_description'])) ? $return['meta_description'] : 'File conversion involves changing the format of a file, while file compression involves reducing its size without affecting its quality.' /* $urlss; */ /* $urlss.', '.$titless.', '.$tagss; */ ?>"/>
    <meta property="og:image" content="assets/img/favicon.svg"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?= base_url; ?>"/>

    <!-- ========== Page Title ========== -->
    <title><?= (!empty($return['title'])) ? $return['title'] : 'Convert Application'; ?></title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="assets/img/favicon.svg" type="image/x-icon">

    <link rel="canonical" href="https://convertai.in/" />
    <link rel="alternate" hreflang='x-default' href='https://convertai.in/'/>

    <!-- ========== Start Stylesheet ========== -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/themify-icons.css" rel="stylesheet" />
    <link href="assets/css/flaticon-set.css" rel="stylesheet" />
    <link href="assets/css/magnific-popup.css" rel="stylesheet" />
    <link href="assets/css/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/animate.css" rel="stylesheet" />
    <link href="assets/css/bootsnav.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet" />
    <!-- ========== End Stylesheet ========== -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5/html5shiv.min.js"></script>
      <script src="assets/js/html5/respond.min.js"></script>
    <![endif]-->

    <!-- Icon cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <!-- ========================================== -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KEMR30YM6F"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-KEMR30YM6F');
    </script>
    <!-- ========================================== -->

</head>

<body>

    <!-- Preloader Start -->
    <div class="se-pre-con"></div>
    <!-- Preloader Ends -->

    <!-- Header 
    ============================================= -->
    <header id="home">

        <!-- Start Navigation -->
        <nav class="navbar navbar-default attr-bg navbar-fixed dark no-background bootsnav">

            <!-- Start Top Search -->
            <div class="container">
                <div class="row">
                    <div class="top-search">
                        <div class="input-group">
                            <form action="search.php" method="GET">
                                <input type="text" name="text" class="form-control" placeholder="Search">
                                <button name="" type="submit">
                                    <i class="ti-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->

            <div class="container">

                <!-- Start Atribute Navigation -->
                <div class="attr-nav inc-border">
                    <ul>
                        <li class="search"><a href="#"><i class="fas fa-search"></i></a></li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="<?= base_url; ?>">
                        <img src="assets/img/logo.svg" class="logo" alt="Logo">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tools</a>
                            <?php 
                                $count = count($all_data_query);
                                if($count > 0) {
                            ?>
                                <ul class="dropdown-menu">
                                    <?php foreach ($all_data_query as $key => $value) { ?>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= strtoupper($value['sequence']); ?></a>
                                            <?php 
                                                $conditions = [
                                                    'sequence' => $value['sequence'],
                                                ];
                                                $sub_data = select_all_by_conditions('`convert_data`',$conditions, $conn);
                                                $sub_count = count($sub_data);
                                                if($sub_count > 0) {
                                            ?>
                                                <ul class="dropdown-menu">
                                                    <?php foreach ($sub_data as $key => $value) { ?>
                                                        <li><a href="<?= base_url; ?>convert.php?url=<?= $value['url']; ?>"><?= $value['title']; ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other</a>
                            <ul class="dropdown-menu">
                                <?php foreach ($all_data_query_other as $key => $value) { ?>
                                    <li>
                                        <?php if($value['id'] == '31') { ?>
                                            <a href="<?= base_url; ?>convert_m.php?url=<?= $value['url']; ?>"><?= $value['title']; ?></a>
                                        <?php } else { ?>
                                            <a href="<?= base_url; ?>convert.php?url=<?= $value['url']; ?>"><?= $value['title']; ?></a>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                                <?php foreach ($all_data_com as $key => $value) { ?>
                                    <li><a href="<?= base_url; ?>compress.php?url=<?= $value['url']; ?>"><?= $value['title']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Convert </a>
                            <ul class="dropdown-menu">
                                <?php foreach ($all_data_query_other as $key => $value) { ?>
                                    <li>
                                        <?php if($value['id'] == '31') { ?>
                                            <a href="<?= base_url; ?>convert_m.php?url=<?= $value['url']; ?>"><?= $value['title']; ?></a>
                                        <?php } else { ?>
                                            <a href="<?= base_url; ?>convert.php?url=<?= $value['url']; ?>"><?= $value['title']; ?></a>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                                <?php foreach ($all_data_query as $key => $value) { ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= strtoupper($value['sequence']); ?></a>
                                        <?php 
                                            $conditions = [
                                                'sequence' => $value['sequence'],
                                            ];
                                            $sub_data = select_all_by_conditions('`convert_data`',$conditions, $conn);
                                            $sub_count = count($sub_data);
                                            if($sub_count > 0) {
                                        ?>
                                            <ul class="dropdown-menu">
                                                <?php foreach ($sub_data as $key => $value) { ?>
                                                    <li><a href="<?= base_url; ?>convert.php?url=<?= $value['url']; ?>"><?= $value['title']; ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Compress </a>
                            <?php 
                                $count = count($all_data_com);
                                if($count > 0) {
                            ?>
                                <ul class="dropdown-menu">
                                    <?php foreach ($all_data_com as $key => $value) { ?>
                                        <li><a href="<?= base_url; ?>compress.php?url=<?= $value['url']; ?>"><?= $value['title']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                        <li class="dropdown">
                            <a href="<?= base_url; ?>blog.php">Blog</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>

        </nav>
        <!-- End Navigation -->

    </header>
    <!-- End Header -->
