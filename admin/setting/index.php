
<?php
    $title = "Setting | Convert Application";
    require_once('../layouts/config.php');
    require_once('../layouts/function.php');
    require_once('../layouts/header.php');

    $conditions = [
        'created_by' => $_SESSION['user_login_detail']['id']
    ];
    // $all_data = select_all('`setting`', $conn);
    $all_data = select_all_by_conditions('`setting`',$conditions, $conn);

    if(isset($_REQUEST['status_submit']))
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

            $return = single_row('`setting`', $conditions, $conn);
            if(!empty($return['total_used']) && $return['total_used'] >= 250) {
                $message = "<div class='alert alert-danger reload'>Can't Change Status.</div>";
            } else {
                $return = update_data('`setting`', $data, $conditions, $conn);
                if(!empty($return)) {
                    $message = "<div class='alert alert-success'>Record Updated Successfully (status).</div>";
                } else {
                    $message = "<div class='alert alert-danger'>Something Went Wrong (status).<br>".$return['error']."</div>";
                }
            }
        }else {
            $message = "<div class='alert alert-danger'>Something Went Wrong (status).</div>";
        }
    }

    if(isset($_REQUEST['d_id']))
    {
        $conditions = ['id' => $_REQUEST['d_id']];
        $return = delete_data('`setting`', $conditions, $conn);

        if(!empty($return)) {
            $message = "<div class='alert alert-success'>Record Deleted Successfully.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Something Went Wrong.<br>".$return['error']."</div>";
        }
    }
?>

<div class="card card-body rounded bg-white">
    <div class="card-header">
        <h3>Setting Data Display
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
                    <th>Email</th>
                    <th>Password</th>
                    <th>API Secret</th>
                    <th>API Key</th>
                    <th>Total Used</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($all_data as $key => $val){ ?>
                        <tr>
                            <td><?= ($key + 1); ?></td>
                            <td><?= $val['email']; ?></td>
                            <td><?= $val['password']; ?></td>
                            <td><?= $val['api_secret']; ?></td>
                            <td><?= $val['api_key']; ?></td>
                            <td><?= $val['total_used']; ?></td>
                            <td>
                                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $val['id']; ?>">
                                    <input type="hidden" name="status" value="<?= $val['status']; ?>">
                                    <?= ($val['status'] == '0') ? '<button type="submit" name="status_submit" class="btn btn-ft border-2 rounded-5 btn-outline-dark"><b> InActive </b></button>' : '<button type="submit" name="status_submit" class="btn btn-ft border-2 rounded-5 btn-outline-info"><b> Active </b></button>' ?>
                                </form>
                            </td>
                            <td>
                                <button onClick="edit('<?= $val['id']; ?>')" class="btn btn-ft border-2 rounded-5 btn-outline-success"><b> <i class="fas fa-edit"></i> </b></button> 
                                &nbsp;
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
            <input type="hidden" id="go_back" value="admin/setting">
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
            window.location.href = "<?= base_url ?>admin/setting/add.php";
        }
    }
    function edit(id)
    {
        if(confirm('Are you sure?'))
        {
            window.location.href = "<?= base_url ?>admin/setting/edit.php?e_id="+id;
        }
    }
    function deletes(id)
    {
        if(confirm('Are you sure?'))
        {
            window.location.href = "<?= base_url ?>admin/setting/index.php?d_id="+id;
        }
    }
</script>
