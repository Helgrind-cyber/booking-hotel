<?php
/**
 * 1. lấy id xuống
 * 2. kiểm tra xem có quyền để xóa tài khoản với id đc nhận hay không
 * 4. thực hiện câu lệnh xóa với csdl
 * 5. điều hướng về danh sách
 *
 */
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$id = isset($_GET['id']) ? $_GET['id'] : -1;

$getRemovenNewsQuery = "select * from news where id = $id";
$removeNews = queryExecute($getRemovenNewsQuery, false);
if(!$removeNews){
    header("location: " . ADMIN_URL . "news?msg=Tài khoản không tồn tại");
    die;
}

$removeNewsQuery = "delete from news where id = $id";
queryExecute($removeNewsQuery, false);
header("location: " . ADMIN_URL . "news?msg=Xóa tài khoản thành công");
die;