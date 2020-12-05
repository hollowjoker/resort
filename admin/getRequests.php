<?php
    include("../includes/db.conn.php");
    include("../includes/conf.class.php");
    include("../includes/admin.class.php");

    if(isset($_POST['requestType']) && $_POST['requestType'] == 'getNotification') {
        $result = $bsiAdminMain->getNotification();
        echo $result;
    }

    if(isset($_POST['requestType']) && $_POST['requestType'] == 'readNotification') {
        $result = $bsiAdminMain->readNotification();
        echo $result;
    }
?>