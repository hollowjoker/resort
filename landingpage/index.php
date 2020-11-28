<?php
    include('header.php');
    include("../includes/db.conn.php");
    include("../includes/admin.class.php");
    $result = $bsiAdminMain->getRoomsListSql();
    
?>
<style>
.divbot{
	background-image: url(images/resortimg3.jpg);
	background-position: relative;
background-repeat: no-repeat;
background-size: cover;
background-attachment:fixed;
min-height:1000px;
}
</style>
<section>
   <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

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




        <p id="home_header">
            Welcome to Creative Techies Resort
        </p>
		<p>Welcome to Creative Beach Resort & Spa: An invitation for a truly unforgettable, lasting memory combining the very best
		<p>of luxury and serenity.

<p>A short ride from Tagbilaran Airport, discover a paradise hideaway where luxurious seclusion meets exotic natural beauty.
 <p>This verdant, beach-fringed island offers sophisticated pleasures on land and water - from genuine Filipino therapies in
 <p>the spa to splashing, sailing or diving in the jewel-like Mindanao Sea and Bohol's most pristine lagoon.
 <p>This stunning resort on the island of Panglao combines the scenic qualities and escapist nature of Bohol facing the Mindanao
  <p>Sea with the high standards and myriad facilities synonymous with Filipino hospitality. Yet whilst it features almost 15 
  <p>single-detached luxury villas, their varying locations along the beach front mean tranquillity and privacy can still be readily attained.
 <p>Awash with Bougainvillea, Bird of Paradise and other native blossoms, this luxurious private island resort has an exotic
  <p>village-like feel, making it perfect for families and couples for whom a social environment is an important part of the holiday experience.
 <p>On the accommodation front, there are beautifully-appointed villas or Balai with outdoor showers and whirlpools, as well as
  <p>an enticing collection of pool villas and suites with breathtaking views into the sea.

 <p>The design of the 15 Balais of Eskaya draws on the traditions of generations of craftsmen, with a generous use of timber and 
  <p>thatch; the result is a refined natural look that complements the surrounding nature, viewed through floor to ceiling windows. 
  <p>Satellite TVs, DVD players, mini-bars and generous patios are standard throughout. And when it comes to dining, anything from Asian
  <p>dishes, Italian specialties and native fare are on offer at the main restaurant, massage under the stars, and the in-villa spa 
 <p> service designed for those seeking a little more privacy.
 <p>At its hub lies an infinity pool, so big and inviting that if it were not for the swim-up bar, one could almost imagine it
  <p>was created by nature. Its sun deck and adjacent beaches are the most popular venues for relaxation, although the water sports
 <p> center, PADI dive school and various island-hopping adventures ensure there is plenty of daytime diversity.
 <p>Eskaya, a vibrant garden island resort, favored for its intimacy and rustic luxury, is poised to become another legendary 
 <p> 100% Filipino-owned resort with unrivaled, intuitive Filipino hospitality and service. The unstinting dedication of its staff
  <p>will continue to create magical moments to make your stay truly unforgettable. So come and escape with us. Truly memorable,
  <p>truly Eskaya.

 <p><b>Fact Sheet</b>
 <p>Tagbilaran Airport: 25 minutes by land transfer

 <p>Check in time: 2:00 pm

 <p>Check out time: 12:00 pm

 <p><b>Early arrivals and late departures</b>
 <p>If your arrival is early in the day and you prefer immediate access to your room, we recommend reserving for the prior 
  <p>night to guarantee immediate access. Similarly, for late departures, reserving an additional night will guarantee access 
 <p> until you leave the Resort. If you choose not to reserve, we will be glad to store your bags at the Front Office and make our
  <p>common area facilities available for you to freshen up.

 <p><b>Guaranteed reservations and deposits</b>
 <p>A guaranteed reservation assures you of a room even if you check in late (after 6:00 pm). If a room is not available, we 
 <p> will arrange your accommodation in another hotel at our expense, and provide transportation to and from Eskaya as reasonable.
 <p> All reservations made must be guaranteed to a major credit card. Certain arrival dates and rates may require a deposit. 
  <p>Please check for full deposit requirements at time of booking.

 <p><b>Cancellation policy</b>
 <p>Cancellations for a room reservation must be received 45 days prior to the expected day of arrival, and may differ by
  <p>arrival date and room type. If cancellation of a guaranteed reservation is not received by the required date, the Resort 
 <p>will charge for accommodation based on the expected date of arrival and room type. For details of cancellation policies and 
  <p>deposit requirements, please check at time of booking.

 <p><b>Credit cards</b>
 <p>The following cards are accepted: American Express, JCB, MasterCard, Visa.


 <div class="divbot">
 </div>
 
    <style>
.footer_container {
   position: relative;
   left: 0;
   bottom: 0;
   width: 100%;
   height:80px;
   background-color: black;
   color: white;
   text-align: center;
   margin-bottom:-200px;
}
</style>
<div class="footer_container">
  <p>Creative Techies Resort</p>
</div>
<?php include('footer.php') ?>