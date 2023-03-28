<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>مدیریت لایسنس برنامه | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">

<div class="wrapper">

    <header class="main-header">
        <?php require('app/views/admin/include/header.php'); ?>
    </header>

    <aside class="main-sidebar direction">
        <?php require('app/views/admin/include/sidebar.php'); ?>
    </aside>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small>مدیریت لایسنس برنامه</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">License</li>
            </ol>
        </section>

        <section class="content" style="min-height: unset;padding-bottom: 0">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">مدیریت لایسنس برنامه</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-4'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%" align="right" for="username">:نام کاربری راست چین</label>
                                            <input style="border-radius: 3px;text-align:left" type="text" class="form-control" id="username" name="username" required>
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%" align="right" for="order_code">:کد سفارش راست چین</label>
                                            <input style="border-radius: 3px;text-align:left" type="text" class="form-control" id="order_code" name="order_code" required>
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%" align="right" for="order_code">:دامنه ثبت شده در راست چین</label>
                                            <input style="border-radius: 3px;text-align:left" type="text" class="form-control" readonly value="<?= $_SERVER['SERVER_NAME'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <input id="btnsubmit" class="btn btn-dropbox" value="فعالسازی" type="submit">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <?php require('app/views/admin/include/footer.php'); ?>
    </footer>
    <?php require('app/views/admin/include/skinSidebar.php'); ?>
</div>
<?php require('app/views/admin/include/publicJS.php'); ?>

<script>
    $("#btnsubmit").on('click', function () {
        var username = document.getElementById("username").value;
        var order_code = toEnglishNumber(document.getElementById("order_code").value);

        if (username == "") {
            $.wnoty({type: 'warning', message: 'نام کاربری را وارد کنید.'});
        } else if (order_code == "") {
            $.wnoty({type: 'warning', message: 'کد سفارش را وارد کنید.'});
        } else {
            $("#btnsubmit").attr("disabled", "disabled");
            document.getElementById("btnsubmit").value =("در حال بررسی...");

            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("username", username);
                formData.append("order_code", order_code);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/checkLicense",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $("#btnsubmit").removeAttr("disabled");
                        document.getElementById("btnsubmit").value =("فعالسازی");

                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});

                        if (data.status == "ok") {
                            location.reload();
                        }
                    }
                });
            } else {
                $("#btnsubmit").removeAttr("disabled");
                document.getElementById("btnsubmit").value =("فعالسازی");
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان افزودن وجود ندارد.'});
            }
        }
    });
</script>

</body>
</html>