
<?php
    $title = "Dashboard | Convert Application";
    require_once('layouts/config.php');
    require_once('layouts/function.php');
    require_once('layouts/header.php');
    require_once('../system/mail/email.php');
    
    $query = 'SELECT blog_comment.*, blog.title FROM `blog_comment` JOIN blog ON blog_comment.blog_id = blog.id  ORDER BY blog_comment.status ASC';
    $all_data = select_all_by_query($query, $conn);

    if(isset($_REQUEST['status_submit']))
    {
        if($_SESSION['user_login_detail']['id'])
        {
            if(isset($_REQUEST['id']) && isset($_REQUEST['status']))
            {
                if($_REQUEST['status'] == '0') {
                    $status = 1;

                    $to      = $_REQUEST['email'];
                    $subject = 'Comment.';
                    $message = '';
                    $message .= '<p>I want to take a moment to express my gratitude for your visit. It meant a lot to me to have you here, and I truly appreciate your support.</p><br>';
                    $message .= '<h3>Your Comment is Approved by ADMIN.</h3>';
                    $message .= '<a href="'.base_url.'" target="_blank"><b>Visit Again</b></a>';
            
                    $return = send_mail($to, $subject, $message);

                    if($return['status'] == false) {
                        echo json_encode($return);
                        exit;
                    }

                } else {
                    $status = 0;

                    $to      = $_REQUEST['email'];
                    $subject = 'Comment.';
                    $message = '';
                    $message .= '<p>I want to take a moment to express my gratitude for your visit. It meant a lot to me to have you here, and I truly appreciate your support.</p><br>';
                    $message .= '<h3>Your Comment is not Approved by ADMIN.</h3>';
                    $message .= '<a href="'.base_url.'" target="_blank"><b>Visit Again</b></a>';
            
                    $return = send_mail($to, $subject, $message);

                    if($return['status'] == false) {
                        echo json_encode($return);
                        exit;
                    }

                }
                $data = ['status' => $status];
                $conditions = ['id' => $_REQUEST['id']];
                $return = update_data('`blog_comment`', $data, $conditions, $conn);

                if(!empty($return)) {
                    $message = "<div class='alert alert-success'>Record Updated Successfully (status).</div>";
                } else {
                    $message = "<div class='alert alert-danger'>Something Went Wrong (status).<br>".$return['error']."</div>";
                }
            }else {
                $message = "<div class='alert alert-danger'>Something Went Wrong (status).</div>";
            }
        } else {
            $message = "<div class='alert alert-danger reload'>You Don't have Permission to Access.</div>";
        }
    }

    if(isset($_REQUEST['d_id']))
    {
        if($_SESSION['user_login_detail']['id'])
        {
            $conditions = ['id' => $_REQUEST['d_id']];
            $return = delete_data('`blog_comment`', $conditions, $conn);

            if(!empty($return)) {
                $message = "<div class='alert alert-success'>Record Deleted Successfully.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
            }
        } else {
            $message = "<div class='alert alert-danger reload'>You Don't have Permission to Access.</div>";
        }
    }

?>

<div class="card card-body rounded bg-white">
    <div class="card-header">
        <h3>Blog Comment Data Display</h3>
        <?= (!empty($message)? $message : ''); ?>
    </div>
    <div class="card-body">
        <div class="row">
            <table>
                <thead>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Title</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($all_data as $key => $val){ ?>
                        <tr>
                            <td><?= ($key + 1); ?></td>
                            <td><?= $val['name']; ?></td>
                            <td><?= $val['email']; ?></td>
                            <td><?= $val['title']; ?></td>
                            <td>
                                <button onClick="open_model('<?= $val['comment']; ?>')" class="btn btn-ft border-2 rounded-5 btn-outline-primary"><b> <i class="fas fa-eye"></i> </b></button>
                            </td>
                            <td>
                                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $val['id']; ?>">
                                    <input type="hidden" name="email" value="<?= $val['email']; ?>">
                                    <input type="hidden" name="status" value="<?= $val['status']; ?>">
                                    <?= ($val['status'] == '0') ? '<button type="submit" name="status_submit" class="btn btn-ft border-2 rounded-5 btn-outline-warning"><b> InActive </b></button>' : '<button type="submit" name="status_submit" class="btn btn-ft border-2 rounded-5 btn-outline-success"><b> Active </b></button>' ?>
                                </form>
                            </td>
                            <td>
                                <button onClick="deletes('<?= $val['id']; ?>')" class="btn btn-ft border-2 rounded-5 btn-outline-danger"><b> <i class="fas fa-trash"></i> </b></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <input type="hidden" id="go_back" value="admin">
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Display Blog Comment</h4>
                <button type="button" class="close btn btn-ft border-2 rounded-5 btn-outline-danger" data-dismiss="modal"><b> &times; </b></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row text-left">
                    <div class="col-sm-12">
                        <h5 id="title"></h5>
                        <div>
                            <p id="data"></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="close btn btn-ft border-2 rounded-5 btn-outline-danger" data-dismiss="modal"><b> Close </b></button>
            </div>
        </div>
    </div>
</div>

<?php
    require_once('layouts/footer.php');
?>

<script>
    function deletes(id)
    {
        if(confirm('Are you sure?'))
        {
            window.location.href = "<?= base_url ?>admin/index.php?d_id="+id;
        }
    }

    function open_model(data) {
        $("#myModal").modal('show');
        $("#data").html(data);
    }

    $(".close").on("click", function(){
        $("#myModal").modal('hide');
    });
</script>
