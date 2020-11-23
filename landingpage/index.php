<?php
    include('header.php');
    include("../includes/db.conn.php");
    include("../includes/admin.class.php");
    $result = $bsiAdminMain->getRoomsListSql();
    
?>
<section>
    <div class="container">
        <div class="event-card card-holder">
            <?php if(count($result)): ?>
                <?php foreach($result as $key => $value ): ?>
                    <div class="card">
                        <div class="card-main">
                            <div class="card-body">
                                <?php
                                    $price = $bsiAdminMain->getPricePlan($value['rtid'], $value['cid']);
                                    $image = $bsiAdminMain->getRoomPhoto($value['rtid'], $value['cid']);
                                ?>
                                <img src="<?= $image ? '../gallery/'.$image['img_path'] : '../images/no_photo.jpg'?>"/>
                                <div class="card-body__content">
                                    <span>Php <?= number_format($price[strtolower(date('D'))], 2)?></span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <ul class="card-footer__list">
                                    <li>
                                        <span><?= $value['type'] ?> (<?= $value['title']?>)</span>
                                    </li>
                                    <li>
                                        <span>Max Occupancy /rm:</span>
                                        <span><?= $value['capacity'] ?> adult/rm</span>
                                    </li>
                                    <li>
                                        <span>Max Child /rm:</span>
                                        <span><?= $value['child']?> child/rm</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif;?>
        </div>
    </div>
</section>
<div id="content_container">
    <div id="welcome">
        <p id="home_header">
            Quality Service and Comfort for an affordable price...
        </p>
        <p>We invite you to enjoy a pleasant stay in Hans guest house, an ideal place for relaxing or vacation in hans guest house.</p>
        <p>We are a hotel with a pleasant family atmosphere, safe and quiet, located in a residential area without public transportation noise. We provide rooms with comfortable beds, air conditioning or fans.</p>
        <p id="home_header">Services we offer:</p>
        <ul>
            <li><i class="icon-li icon-ok"></i>Wireless Internet Access</li>
            <li>Cable TV channels</li>
            <li>Air conditioning or fans</li>
            <li>Clean rooms</li>
        </ul>
    </div>
    <span id="img_shadow"><img src="images/1011_n.png"/></span>
    <div class="call_to_action" id="orn"><a href="catalogue.php">View Rooms</a></div>
    <div class="call_to_action" id="grn"><a href="eventhall.php">View Event Halls</a></div>
</div>
<?php include('footer.php') ?>