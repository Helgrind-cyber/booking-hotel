<?php
session_start();
define('TITLE', 'Dashboard');
require_once '../../config/utils.php';
checkAdminLoggedIn();

# Lấy ra tất cả bản ghi trong bảng users
$getMemberSql = "select * from users where role_id = 1";
$users = queryExecute($getMemberSql, true);

# Lấy ra tất cả bản ghi trong bảng contacts
$getContactsSql = "select * from contacts";
$contacts = queryExecute($getContactsSql, true);

# Lấy ra tất cả bản ghi trong bảng new_categories
$getNewCategoriesSql = "select * from new_categories";
$new_categories = queryExecute($getNewCategoriesSql, true);

# Lấy ra tất cả bản ghi trong bảng news
$getNewsSql = "select * from news";
$news = queryExecute($getNewsSql, true);

# Lấy ra tất cả bản ghi trong bảng services
$getServicesSql = "select * from services";
$services = queryExecute($getServicesSql, true);

# Lấy ra tất cả bản ghi trong bảng customer feedbacks
$getFeedbacksSql = "select * from customer_feedbacks";
$feedbacks = queryExecute($getFeedbacksSql, true);

# Lấy ra tất cả bản ghi trong bảng web setting
$getWebSettingSql = "select * from web_settings";
$webSetting = queryExecute($getWebSettingSql, true);

# Lấy ra tất cả bản ghi trong bảng room services
$getRoomServicesQuery = "select * from room_services";
$roomServices = queryExecute($getRoomServicesQuery, true);

?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once '../_share/style.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include_once '../_share/header.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include_once '../_share/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-4">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?= count($users); ?></h3>
                                    <p>Người dùng</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="<?= ADMIN_URL . 'users' ?>" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-4">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?= count($contacts); ?></h3>
                                    <p>Contacts</p>
                                </div>
                                <div class="icon">
                                    <i class="fal fa-address-card"></i>
                                </div>
                                <a href="<?= ADMIN_URL . 'contacts' ?>" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-4">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?= count($news); ?></h3>
                                    <p>Tin tức</p>
                                </div>
                                <div class="icon">
                                    <i class="fad fa-newspaper"></i>
                                </div>
                                <a href="<?= ADMIN_URL . 'news' ?>" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-4">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= count($feedbacks); ?></h3>
                                    <p>Feedbacks</p>
                                </div>
                                <div class="icon">
                                    <i class="far fa-comment-alt-dots"></i>
                                </div>
                                <a href="<?= ADMIN_URL . 'customer_feedbacks' ?>" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Row 2 -->
                    <div class="row">
                        <div class="col-lg-3 col-4">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= count($services); ?></h3>
                                    <p>Dịch vụ</p>
                                </div>
                                <div class="icon">
                                    <i class="fal fa-concierge-bell"></i>
                                </div>
                                <a href="<?= ADMIN_URL . 'services' ?>" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-4">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?= count($webSetting); ?></h3>
                                    <p>Web setting</p>
                                </div>
                                <div class="icon">
                                    <i class="far fa-cogs"></i>
                                </div>
                                <a href="<?= ADMIN_URL . 'web_settings' ?>" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-4">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?= count($roomServices); ?></h3>
                                    <p>Room services</p>
                                </div>
                                <div class="icon">
                                    <i class="fal fa-hotel"></i>
                                </div>
                                <a href="<?= ADMIN_URL . 'room_services' ?>" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once '../_share/footer.php'; ?>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php include_once '../_share/script.php'; ?>

</body>

</html>
