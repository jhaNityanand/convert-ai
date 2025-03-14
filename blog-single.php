
<?php 

    require_once('system/function.php'); 

    if(isset($_REQUEST['url']) && !empty($_REQUEST['url'])) {

        $conditions = [
            'url' => $_REQUEST['url'],
            'status' => 1,
        ];
        $return = single_row('`blog`', $conditions, $conn);

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

    $recent = [];
    $comments = [];
    if(!empty($return['id'])) {

        $query = "SELECT * FROM `blog` WHERE id < '".$return['id']."' LIMIT 1";
        $previous = select_all_by_query($query, $conn);
    
        $query = "SELECT * FROM `blog` WHERE id > '".$return['id']."' LIMIT 1";
        $next = select_all_by_query($query, $conn);
    
        $query = "SELECT * FROM `blog` WHERE id != '".$return['id']."' ORDER BY id DESC LIMIT 0, 10";
        $recent = select_all_by_query($query, $conn);

        $query = "SELECT * FROM `blog_comment` WHERE blog_id = '".$return['id']."' AND status = 1";
        $comments = select_all_by_query($query, $conn);
    }

    $conditions = [
        'ip_address' => getenv("REMOTE_ADDR"),
    ];
    $comment_data = single_row('`blog_comment`', $conditions, $conn);

    require_once('header.php'); 

?>

    <br><br><br>

    <div style="padding-left: 7px; padding-right: 7px;" class="container">
        <div class="row">
            <div class="col-sm-12">
                <?= (!empty($message)) ? $message : ''; ?>
            </div>
        </div>

        <!-- Start Breadcrumb 
        ============================================= -->
        <!-- <div class="breadcrumb-area text-center shadow dark bg-fixed text-light" style="background-image: url(assets/img/banner/11.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Blog Single</h2>
                        <ul class="breadcrumb">
                            <li><a href="<?= base_url; ?>"><i class="fas fa-home"></i> Home</a></li>
                            <li><a href="<?= base_url; ?>blog.php">Blog</a></li>
                            <li class="active"><?= (!empty($return['title'])) ? $return['title'] : ''; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- End Breadcrumb -->

        <!-- Start Blog
        ============================================= -->
        <div style="padding-top: 5px;padding-bottom: 5px;" class="blog-area single full-blog right-sidebar full-blog default-padding">
            <div class="container">
                <div class="blog-items">
                    <div class="row">
                        <div class="blog-content wow fadeInUp col-lg-8 col-md-12">
                            <div class="item">

                                <div class="blog-item-box">
                                    <!-- Start Post Thumb -->
                                    <div class="thumb">
                                        <?php if(!empty($return['image'])){
                                            $img = explode('/', $return['image']);
                                            $image = end($img);
                                        } else {
                                            $image = '';
                                        } ?>
                                        <img style="height: 100%; width: 100%;" src="assets/img/blog/<?= $image; ?>" alt="Thumb">
                                    </div>
                                    <!-- Start Post Thumb -->

                                    <div style="margin-left: -22px;margin-right: -22px;" class="info">
                                        <div class="meta">
                                            <ul>
                                                <li><i class="fas fa-calendar-alt"></i> <?= (!empty($return['created_at'])) ? date('d M, Y', strtotime($return['created_at'])) : ''; ?></li>
                                                <li><a href="#"><i class="fas fa-comments"></i> <?= (!empty($comments[0])) ? count($comments) : '0'; ?> Comments</a></li>
                                            </ul>
                                        </div>
                                        <h1>
                                            <b><?= (!empty($return['title'])) ? $return['title'] : ''; ?></b>
                                        </h1>

                                        <?= (!empty($return['content'])) ? $return['content'] : ''; ?>

                                        <blockquote>
                                            <?= (!empty($return['quote'])) ? $return['quote'] : ''; ?>
                                            <cite>– <?= (!empty($return['author'])) ? $return['author'] : ''; ?></cite>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>

                            <!-- Start Post Pagination -->
                            <div class="post-pagi-area">
                                <?php if(!empty($previous[0]['title'])) { ?>
                                    <a href="<?= base_url; ?>blog-single.php?url=<?= $previous[0]['url']; ?>">
                                        <i class="fas fa-angle-double-left"></i> Previus Post
                                        <h5><?= substr($previous[0]['title'], 0, 20)."....."; ?></h5>
                                    </a>
                                <?php } else { ?>
                                    <a href="#"></a>
                                <?php } ?>
                                <?php if(!empty($next[0]['title'])) { ?>
                                    <a href="<?= base_url; ?>blog-single.php?url=<?= $next[0]['url']; ?>">
                                        Next Post <i class="fas fa-angle-double-right"></i>
                                        <h5><?= substr($next[0]['title'], 0, 20)."....."; ?></h5>
                                    </a>
                                <?php } else { ?>
                                    <a href="#"></a>
                                <?php } ?>
                            </div>
                            <!-- End Post Pagination -->

                            <!-- Start Blog Comment -->
                            <div class="blog-comments">
                                <div class="comments-area">
                                    <div class="comments-title">
                                        <h4>
                                            <?= (!empty($comments[0])) ? count($comments) : '0'; ?> comments
                                        </h4>
                                        <div class="comments-list">
                                            <?php foreach ($comments as $key => $value) { ?>
                                                <div class="commen-item">
                                                    <!-- <div class="avatar">
                                                        <img src="assets/img/teams/user.png" alt="Author">
                                                    </div> -->
                                                    <div class="content">
                                                        <div class="title text-left">
                                                            <h5><?= $value['name']; ?></h5>
                                                            <span><?= date('d M, Y', strtotime($value['created_at'])); ?></span>
                                                        </div>
                                                        <p>
                                                            <?= $value['comment']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <!-- <div class="commen-item reply">
                                                <div class="avatar">
                                                    <img src="assets/img/teams/user.png" alt="Author">
                                                </div>
                                                <div class="content">
                                                    <div class="title">
                                                        <h5>Spart Lee</h5>
                                                        <span>17 Feb, 2020</span>
                                                    </div>
                                                    <p>
                                                        Delivered ye sportsmen zealously arranging frankness estimable as. Nay any article enabled musical shyness yet sixteen yet blushes. Entire its the did figure wonder off. 
                                                    </p>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <?php if(!empty($return['title'])) { ?>
                                        <div class="comments-form">
                                            <div class="title">
                                                <h4>Leave a comments</h4>
                                            </div>
                                            <form action="#" method="POST" id="commentform" class="contact-comments">
                                                <input type="hidden" value="<?= (!empty($return['id'])) ? $return['id'] : ''; ?>" name="blog_id">
                                                <input type="hidden" value="comment" name="check">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <!-- Name -->
                                                            <input value="<?= (!empty($comment_data['name'])) ? $comment_data['name'] : ''; ?>" name="name" class="form-control" placeholder="Name *" type="text" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <!-- Email -->
                                                            <input value="<?= (!empty($comment_data['email'])) ? $comment_data['email'] : ''; ?>" name="email" class="form-control" placeholder="Email *" type="email" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group comments">
                                                            <!-- Comment -->
                                                            <textarea name="comment" class="form-control" placeholder="Comment *" required></textarea>
                                                        </div>
                                                        <div class="form-group full-width submit">
                                                            <button type="submit">
                                                                Post Comments
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- End Comments Form -->
                        </div>
                        <!-- Start Sidebar -->
                        <div class="sidebar wow fadeInLeft col-lg-4 col-md-12">
                            <aside class="">
                                <div class="sidebar-item recent-post">
                                    <div class="title">
                                        <h4>Recent Post</h4>
                                    </div>
                                    <ul>
                                        <?php foreach ($recent as $key => $value) { ?>
                                        <li>
                                            <div class="thumb">
                                                <a href="<?= base_url; ?>blog-single.php?url=<?= $value['url']; ?>">
                                                    <img style="height: 100%; width: 100%;" src="assets/img/blog/<?php $arr = explode('/', $value['image']); echo end($arr); ?>" alt="Thumb">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <a href="<?= base_url; ?>blog-single.php?url=<?= $value['url']; ?>"><?= substr($value['title'], 0, 25).'.....'; ?></a>
                                                <div class="meta-title">
                                                    <span class="post-date"><i class="fas fa-calendar-alt"></i> <?= date('d F, Y', strtotime($value['created_at'])); ?></span>
                                                </div>
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="sidebar-item category">
                                    <div class="title">
                                        <h4>category list</h4>
                                    </div>
                                    <div class="sidebar-info">
                                        <ul>
                                            <?php foreach ($all_data_blog_cat as $key => $value) { ?>
                                                <li>
                                                    <a href="<?= base_url; ?>blog.php?url=<?= $value['category']; ?>"><?= $value['category']; ?> <span>(<?= $value['cat_id']; ?>)</span></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </aside>
                        </div>
                        <!-- End Start Sidebar -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Blog -->
    </div>

<?php require_once('footer.php'); ?>

<script>
    $(function () {
        $('#commentform').bind('submit', function () {
          $.ajax({
            type: 'post',
            url: 'system/ajax.php',
            data: $('#commentform').serialize(),
            dataType: 'json',
            success: function(data) {
              $('#commentform').trigger("reset");
              alert('Thanking You for Send Comment.');
            },
            error: function(data) {
                $('#commentform').trigger("reset");
                alert('Thanking You for Send Comment.');
            }
          });
          return false;
        });
    });
</script>
