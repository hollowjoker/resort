<?php
    include("../includes/db.conn.php");
    include("../includes/conf.class.php");
    include("../includes/admin.class.php");
    include("../includes/search.class.php");
    $bsisearch = new bsiSearch();

    $checkIn = $_POST['check_in'];
    $checkOut = $_POST['check_out'];
    $availableRooms = [];
    foreach($bsisearch->roomType as $room_type) {
        foreach($bsisearch->multiCapacity as $capid => $capvalues) {
            $room_result = $bsisearch->getAvailableRooms($room_type['rtid'], $room_type['rtname'], $capid, $checkIn, $checkOut);
            $sqlroomcheck=$mysqli->query("select * from bsi_room where roomtype_id=".$room_type['rtid']." and capacity_id=".$capid);
            $i = 0;
            $roomData = [];
            while ($result = $sqlroomcheck->fetch_assoc()) {
                if ($i == 0) {
                    $roomData = $result;
                    $i++;
                }
            }
            if($sqlroomcheck->num_rows) {
                $availableRooms[] = [
                    'rtId' => $room_type['rtid'],
                    'rtname' => $room_type['rtname'],
                    'captitle' => $capvalues['captitle'],
                    'capval' => $capvalues['capval'],
                    'total' => $bsiCore->get_currency_symbol($bsisearch->currency).$bsiCore->getExchangemoney($room_result['totalprice'],$bsisearch->currency),
                    'grandTotal' => (int)str_replace(',', '', $bsiCore->getExchangemoney($room_result['totalprice'],$bsisearch->currency)),
                    'roomdropdown' => $room_result['roomdropdown'],
                    'roomId' => $roomData['room_ID']
                ];
            }
        }
    }
    
    echo json_encode($availableRooms);
?>