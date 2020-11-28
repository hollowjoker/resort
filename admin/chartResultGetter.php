<?php
    include("../includes/db.conn.php");
    include("../includes/admin.class.php");
    $type = $_POST['type'];
    $result = '';
    if ($type == 'bookingsMonthly') {
        $result = $bsiAdminMain->getAnalyticsBookings();
    } elseif ($type == 'mostMonth' || $type == 'leastMonth') {
        $result = $bsiAdminMain->getAnalyticsBookingMonth($type);
    } elseif ($type == 'mostRoom' || $type == 'leastRoom' || $type == 'allRooms') {
        $result = $bsiAdminMain->getAnalyticsBookingRoom($type);
    }
    print_r($result);
?>