<?php
session_start();
define('TITLE', 'News');
require_once '../../config/utils.php';
checkAdminLoggedIn();
// lấy thông tin của người dùng ra ngoài thông id trên đường dẫn
$id = isset($_GET['id']) ? $_GET['id'] : -1;

$getUserQuery = "select * from users where id = '$id'";
$user = queryExecute($getNewsByIdQuery, false);
$getNewsByIdQuery = "select n.*, u.name as authorName
                    from news n join users u
                    on n.author_id = u.id
                    where n.id = '$id'";
$news = queryExecute($getNewsByIdQuery, false);
if (!$news) {
    header("location: " . ADMIN_URL . 'news?msg=Bài viết không tồn tại');
    die;
}

// kiểm tra xem có quyền để thực hiện edit hay không
if ($_SESSION[AUTH]['role_id'] < 1) {
    header("location: " . ADMIN_URL . 'news?msg=Bạn không có quyền sửa thông tin bài viết này');
    die;
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once '../_share/style.php'; ?>
    <!-- Script single-use only -->
    <script src="https://cdn.tiny.cloud/1/09n2cu8687a01c6pb501sbldantk25a45y32kbe1uneb85j4/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
                <div class="container-fluid border-bottom">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Cập nhật bài viết</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <form id="add-user-form" action="<?= ADMIN_URL . 'news/save-edit.php' ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $news['id'] ?>">
                        <div class="row p-4">
                            <div class="form-group col-md-6 col-12">
                                <div class="col-md-6 offset-md-3">
                                    <img src="<?= BASE_URL . $news['feature_image'] ?>" id="preview-img" class="img-fluid">
                                </div>
                            </div>
                            <div class="custom-file col-md-6 col-12">
                                <input type="file" class="custom-file-input" id="inputGroupFile02" name="feature_image" onchange="encodeImageFileAsURL(this)">
                                <label class="custom-file-label" for="inputGroupFile02"><span class="text-danger">*</span>Ảnh đại diện bài viết</label>
                            </div>
                        </div>
                        <textarea class="news_content" id="" cols="30" rows="10" name="news_content"></textarea>
                        <div class="col d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">Tạo</button>&nbsp;
                            <a href="<?= ADMIN_URL . 'news' ?>" class="btn btn-danger">Hủy</a>
                        </div>
                    </form>
                    <!-- /.row -->
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
    <script>
        // Tinymce
        tinymce.init({
            selector: '.news_content',
            height: 400,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });

        function encodeImageFileAsURL(element) {
            var file = element.files[0];
            if (file === undefined) {
                $('#preview-img').attr('src', "<?= BASE_URL . $news['feature_image'] ?>");
                return false;
            }
            var reader = new FileReader();
            reader.onloadend = function() {
                $('#preview-img').attr('src', reader.result)
            }
            reader.readAsDataURL(file);
        }
        $('#edit-user-form').validate({
            rules: {
                news_content: {
                    required: true
                },
                feature_image: {
                    required: true,
                    extension: "png|jpg|jpeg|gif"
                }
            },
            messages: {
                news_content: {
                    required: "Hãy nhập nội dung bài viết"
                },
                feature_image: {
                    required: "Hãy nhập ảnh đại diện",
                    extension: "Hãy nhập đúng định dạng ảnh (jpg | jpeg | png | gif)"
                }
            }
        });
    </script>
</body>

</html>
