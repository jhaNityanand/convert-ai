
<?php
    $title = "Compress | Convert Application";
    require_once('../layouts/config.php');
    require_once('../layouts/function.php');
    require_once('../layouts/header.php');
    
    $conditions = [
        'created_by' => $_SESSION['user_login_detail']['id']
    ];
    // $all_data = select_all('`compress_data`', $conn);
    $all_data = select_all_by_conditions('`compress_data`',$conditions, $conn);

    if(isset($_REQUEST['multiple_submit']))
    {
        if($_SESSION['user_login_detail']['id'] == $_REQUEST['created_by'])
        {
            if(isset($_REQUEST['id']) && isset($_REQUEST['multiple']))
            {
                if($_REQUEST['multiple'] == '0') {
                    $multiple = 1;
                } else {
                    $multiple = 0;
                }
                $data = ['multiple' => $multiple];
                $conditions = ['id' => $_REQUEST['id']];
                $return = update_data('`compress_data`', $data, $conditions, $conn);

                if(!empty($return)) {
                    $message = "<div class='alert alert-success'>Record Updated Successfully (multiple).</div>";
                } else {
                    $message = "<div class='alert alert-danger'>Something Went Wrong (multiple).<br>".$return['error']."</div>";
                }
            }else {
                $message = "<div class='alert alert-danger'>Something Went Wrong (multiple).</div>";
            }
        } else {
            $message = "<div class='alert alert-danger reload'>You Don't have Permission to Access.</div>";
        }
    }

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
                $return = update_data('`compress_data`', $data, $conditions, $conn);

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
            $return = delete_data('`compress_data`', $conditions, $conn);

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
        <h3>Compress Data Display
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
                    <!-- <th>Accept Type</th> -->
                    <th>URL</th>
                    <th>No. of File</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($all_data as $key => $val){ ?>
                        <tr>
                            <td><?= ($key + 1); ?></td>
                            <td><?= $val['title']; ?></td>
                            <!-- <td><?= $val['accept']; ?></td> -->
                            <td><?= $val['url']; ?></td>
                            <td>
                                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $val['id']; ?>">
                                    <input type="hidden" name="created_by" value="<?= $val['created_by']; ?>">
                                    <input type="hidden" name="multiple" value="<?= $val['multiple']; ?>">
                                    <?= ($val['multiple'] == '0') ? '<button type="submit" name="multiple_submit" class="btn btn-ft border-2 rounded-5 btn-outline-dark"><b> Single </b></button>' : '<button type="submit" name="multiple_submit" class="btn btn-ft border-2 rounded-5 btn-outline-info"><b> Multiple </b></button>' ?>
                                </form>
                            </td>
                            <td><?= $val['type']; ?></td>
                            <td>
                                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $val['id']; ?>">
                                    <input type="hidden" name="created_by" value="<?= $val['created_by']; ?>">
                                    <input type="hidden" name="status" value="<?= $val['status']; ?>">
                                    <?= ($val['status'] == '0') ? '<button type="submit" name="status_submit" class="btn btn-ft border-2 rounded-5 btn-outline-secondary"><b> InActive </b></button>' : '<button type="submit" name="status_submit" class="btn btn-ft border-2 rounded-5 btn-outline-warning"><b> Active </b></button>' ?>
                                </form>
                            </td>
                            <td>
                                <button title="File Type" onClick="open_model('<?= $val['title']; ?>', '<?= $val['file_type']; ?>')" class="btn btn-ft border-2 rounded-5 btn-outline-secondary"><b> <i class="fas fa-eye"></i> </b></button>
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
            <input type="hidden" id="go_back" value="admin/compress">
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Accept File Type</h4>
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
    require_once('../layouts/footer.php');
?>

<script>
    function add_new()
    {
        if(confirm('Are you sure?'))
        {
            window.location.href = "<?= base_url ?>admin/compress/add.php";
        }
    }
    function edit(id, created_by)
    {
        if(confirm('Are you sure?'))
        {
            window.location.href = "<?= base_url ?>admin/compress/edit.php?e_id="+id;
        }
    }
    function deletes(id, created_by)
    {
        if(confirm('Are you sure?'))
        {
            window.location.href = "<?= base_url ?>admin/compress/index.php?d_id="+id+"&c_id="+created_by;
        }
    }

    function open_model(title, data) {
        $("#myModal").modal('show');
        $("#title").html(title);
        $("#data").html(data);
    }

    $(".close").on("click", function(){
        $("#myModal").modal('hide');
    });
</script>
