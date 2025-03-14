
<?php
    if(empty($_SESSION['user_login_detail']) && empty($_SESSION['user_login_detail']['id']))
    {
        header("Location: ".base_url."admin/users/login.php");
    }
?>

<footer class="main-footer navbar-light bg-light footer"><br>
    <strong>Copyright &copy; 2022-2023 <a href="#">Nityanand Jha</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.6.0
    </div>
</footer>

</div>

<script>
    $(document).ready(function(){
        if($("div").hasClass("not_reload") == true) {
            setTimeout(() => {
                $(".empty_div").html('');
            }, 2000);
        } else {
            if($("div").hasClass("alert-success") == true) {
                var go_back = $("#go_back").val();
                setTimeout(() => {
                    window.location.href = '<?= base_url; ?>'+go_back;
                }, 2000);
            }
            if($("div").hasClass("reload") == true) {
                var go_back = $("#go_back").val();
                setTimeout(() => {
                    window.location.href = '<?= base_url; ?>'+go_back;
                }, 2000);
            }
        }

        $('table').DataTable({
            "autoWidth": false,
            "responsive": true,
            "scrollX": true,
        });

        $('textarea').each(function(){
            $(this).val($(this).val().trim());
        });
    });

    CKEDITOR.replace( 'content' );
</script>

</body>

</html>
