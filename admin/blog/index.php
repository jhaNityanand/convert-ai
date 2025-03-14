
<?php
    $title = "Blog | Convert Application";
    require_once('../layouts/config.php');
    require_once('../layouts/function.php');
    require_once('../layouts/header.php');
    
    $conditions = [
        'created_by' => $_SESSION['user_login_detail']['id']
    ];
    // $all_data = select_all('`blog`', $conn);
    $all_data = select_all_by_conditions('`blog`',$conditions, $conn);

    if(isset($_REQUEST['status_submit']))
    {
        if($_SESSION['user_login_detail']['id'] == $_REQUEST['created_by'])
        {
            if(isset($_REQUEST['id']) && isset($_REQUEST['status']))
            {
                if($_REQUEST['status'] == '0') {
                    $status = 1;
                } else {
                    $status = 0;
                }
                $data = ['status' => $status];
                $conditions = ['id' => $_REQUEST['id']];
                $return = update_data('`blog`', $data, $conditions, $conn);

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

    if(isset($_REQUEST['d_id']) && isset($_REQUEST['c_id']))
    {
        if($_SESSION['user_login_detail']['id'] == $_REQUEST['c_id'])
        {
            $conditions = ['id' => $_REQUEST['d_id']];
            $delete_img = single_row('`blog`', $conditions, $conn);
            unlink($delete_img['image']);
            $return = delete_data('`blog`', $conditions, $conn);

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
        <h3>Blog Data Display
        <div style="float: right;">
        <button onclick="add_new()" class="btn btn-ft border-2 rounded-5 btn-outline-primary"><b> Add New <i class="fas fa-plus"></i> </b></button>
        </div></h3>
        <?= (!empty($message)? $message : ''); ?>
    </div>
    <div class="card-body">
        <div class="row">
            <table>
                <thead>
                    <th>Sr. No.</th>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Author</th>
                    <th>Banner</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($all_data as $key => $val){ ?>
                        <tr>
                            <td><?= ($key + 1); ?></td>
                            <td><?= $val['title']; ?></td>
                            <td><?= $val['url']; ?></td>
                            <td><?= $val['author']; ?></td>
                            <td>
                                <img src="<?= $val['image']; ?>" width="100" height="75" alt="">
                            </td>
                            <td><?= $val['category']; ?></td>
                            <td>
                                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $val['id']; ?>">
                                    <input type="hidden" name="created_by" value="<?= $val['created_by']; ?>">
                                    <input type="hidden" name="status" value="<?= $val['status']; ?>">
                                    <?= ($val['status'] == '0') ? '<button type="submit" name="status_submit" class="btn btn-ft border-2 rounded-5 btn-outline-secondary"><b> InActive </b></button>' : '<button type="submit" name="status_submit" class="btn btn-ft border-2 rounded-5 btn-outline-warning"><b> Active </b></button>' ?>
                                </form>
                            </td>
                            <td>
                                <!-- The Modal -->
                                <div class="modal myModal_close" id="myModal_<?= $key; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Display Blog <b id="content_blog_<?= $key; ?>"></b></h4>
                                                <button type="button" class="close btn btn-ft border-2 rounded-5 btn-outline-danger" data-dismiss="modal"><b> &times; </b></button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="row text-left">
                                                    <div class="col-sm-12">
                                                        <h5 id="title"><?= $val['title']; ?></h5>
                                                        <div id='content_<?= $key; ?>'>
                                                            <?= $val['content']; ?>
                                                        </div>
                                                        <div id='quote_<?= $key; ?>'>
                                                            <?= $val['quote']; ?>
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
                                
                                <button title="Content" onClick="open_model('myModal_<?= $key; ?>', 'content_<?= $key; ?>', 'quote_<?= $key; ?>', 'content_blog_<?= $key; ?>', 'Content')" class="btn btn-ft border-2 rounded-5 btn-outline-dark"><b> <i class="fas fa-eye"></i> </b></button>
                                &nbsp;
                                <button title="Quote" onClick="open_model('myModal_<?= $key; ?>', 'quote_<?= $key; ?>', 'content_<?= $key; ?>', 'content_blog_<?= $key; ?>', 'Quote')" class="btn btn-ft border-2 rounded-5 btn-outline-warning"><b> <i class="fas fa-eye"></i> </b></button>
                                &nbsp;
                                <button onClick="edit('<?= $val['id']; ?>', '<?= $val['created_by']; ?>')" class="btn btn-ft border-2 rounded-5 btn-outline-success"><b> <i class="fas fa-edit"></i> </b></button> 
                                &nbsp;
                                <button onClick="deletes('<?= $val['id']; ?>', '<?= $val['created_by']; ?>')" class="btn btn-ft border-2 rounded-5 btn-outline-danger"><b> <i class="fas fa-trash"></i> </b></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <input type="hidden" id="go_back" value="admin/blog">
        </div>
    </div>
</div>

<?php
    require_once('../layouts/footer.php');
?>

<script>
    function add_new()
    {
        if(confirm('Are you sure?'))
        {
            window.location.href = "<?= base_url ?>admin/blog/add.php";
        }
    }
    function edit(id, created_by)
    {
        if(confirm('Are you sure?'))
        {
            window.location.href = "<?= base_url ?>admin/blog/edit.php?e_id="+id;
        }
    }
    function deletes(id, created_by)
    {
        if(confirm('Are you sure?'))
        {
            window.location.href = "<?= base_url ?>admin/blog/index.php?d_id="+id+"&c_id="+created_by;
        }
    }

    function open_model(id, id_dis, id_hid, id_con_quo, vars) {
        $("#"+id).modal('show');
        $("#"+id_dis).show();
        $("#"+id_hid).hide();
        $("#"+id_con_quo).html(vars);
    }

    $(".close").on("click", function(){
        $(".myModal_close").modal('hide');
    });
</script>
