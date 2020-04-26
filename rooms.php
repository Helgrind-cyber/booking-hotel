<?php
session_start();
define('TITLE', 'Rooms');
require_once './config/utils.php';
$loggedInUser = isset($_SESSION[AUTH]) ? $_SESSION[AUTH] : null;

// get data from web_settings
$getWebSettingQuery = "select * from web_settings where id = 1";
$webSetting = queryExecute($getWebSettingQuery, false);

// get data from url
$arrival = isset($_GET['arrival']) ? $_GET['arrival'] : "";
$departure = isset($_GET['departure']) ? $_GET['departure'] : "";
$adult = isset($_GET['adult']) ? $_GET['adult'] : "";
$children = isset($_GET['children']) ? $_GET['children'] : "";

// get room types query
$getRoomTypesQuery = "select r.* from room_types r";
if ($adult !== "" && $children !== "") {
    $getRoomTypesQuery .= " where (r.adult like'%$adult%'
                                    or r.children like '%$children%')
                                and status = 1 ORDER BY r.id DESC";
} else {
    $getRoomTypesQuery .= " where status = 1 ORDER BY r.id DESC";
}
$rooms = queryExecute($getRoomTypesQuery, true);

for ($i = 0; $i < count($rooms); $i++) {
    $getServiceQuery = "select s.id, s.name
                                from room_service_xref sxr
                                join room_services s
                            on sxr.services_id = s.id
                        where sxr.room_id = " . $rooms[$i]['id'];
    $services = queryExecute($getServiceQuery, true);
    $rooms[$i]['room_sv'] = $services;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <?php include_once './public/_share/link.php'; ?>
</head>

<body>
    <!-- start header -->
    <?php include_once './public/_share/header.php'; ?>
    <!-- end header -->

    <!-- List rooms -->
    <div class="list-room">
        <div class="container">
            <!-- Rooms List -->
            <?php foreach ($rooms as $room) : ?>
                <div class="list-room-content">
                    <div class="row">
                        <div class="col-md-3 col-3 list-room-img">
                            <a href="">
                                <img src="<?= BASE_URL . $room['feature_image'] ?>" width="200" alt="">
                            </a>
                        </div>
                        <div class="col-md-6 col-6 list-room-introduce">
                            <h3><a href="rooms-detail.php?id=<?= $room['id'] ?>&arrival=<?= $arrival ?>&departure=<?= $departure ?>"><?= $room['name'] ?></a><small></small></h3>
                            <p><?= $room['short_descript'] ?></p>
                            <div class="room_service">
                                <h5>Dịch vụ phòng</h5>
                                <div class="room-service-grid">
                                    <?php foreach ($room['room_sv'] as $rService) : ?>
                                        <span><i class="fad fa-check-circle"></i><?= $rService['name'] ?></span>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-3 list-room-detail">
                            <h5><?= $room['price'] ?> VNĐ</h5>
                            <p>PER NIGHT</p>
                            <p><?= $room['adult'] ?> Người lớn & <?= $room['children'] ?> Trẻ em</p>
                            <a href="<?=BASE_URL?>room-details.php?id=<?= $room['id'] ?>&arrival=<?= $arrival ?>&departure=<?= $departure ?>&adult=<?=$adult?>&children=<?=$children?>" class="btn">ROOM DETAIL</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <!-- Rooms List End -->
        </div>
    </div>
    <!-- List rooms -->

    <!-- start footer -->
    <?php include_once './public/_share/footer.php'; ?>
    <!-- end footer -->
    <!-- start script link -->
    <?php include_once './public/_share/script.php'; ?>
    <!-- end script link -->
    <script>
        setTimeout(() => {
            sessionStorage.clear();
        }, 2500);
    </script>
</body>

</html>
