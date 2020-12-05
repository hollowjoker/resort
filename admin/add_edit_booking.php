<?php 
include("access.php");
if(isset($_POST['submitCapacity'])){
	include("../includes/db.conn.php"); 
	include("../includes/conf.class.php");
	include("../includes/admin.class.php");
	$bsiAdminMain->add_edit_adminBooking();
	header("location:view_bookings.php");	
	exit;
}
include("header.php"); 
include("../includes/conf.class.php");
include("../includes/admin.class.php");
if(isset($_GET['id']) && $_GET['id'] != ""){
	$id = $bsiCore->ClearInput($_GET['id']);
	if($id){
		$result = $mysqli->query($bsiAdminMain->getCapacitysql($id));
		$row    = $result->fetch_assoc();
		$readonly = 'readonly="readonly"';
	}else{
		$row    = NULL;
		$readonly = '';
	}
}else{
	header("location:view_bookings.php");
	exit;
}
?>  
 <link rel="stylesheet" type="text/css" href="css/jquery.validate.css" />
      <div id="container-inside">
      <span style="font-size:16px; font-weight:bold"></span>
      <hr />
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="form1">
          <div class="table-holder">
            <table cellpadding="5" cellspacing="2" border="0" class="custom-main-table">
              <tr>
                <td><strong>Check In Date:</strong></td>
                <td valign="middle"><input type="text" name="check_in" id="check_in" readonly class="required" style="width:250px;" date-picker="1" autocomplete="off" /></td>
              </tr>
              <tr>
              <tr>
                <td><strong>Check Out Date:</strong></td>
                <td valign="middle"><input type="text" name="check_out" id="check_out" readonly class="required" style="width:250px;" date-picker="2" autocomplete="off" /></td>
              </tr>
              <tr>
                <td><strong>Adult/Room:</strong></td>
                <td><?= $bsiCore->capacitycombo();?></td>
              </tr>
              <tr>
                <td><strong>Child/Room:</strong></td>
                <td><?= $bsiCore->getChildcomboNew(); ?></td>
              </tr>
              <tr>
                <td><strong>Currency:</strong></td>
                <td><?= $bsiCore->get_currency_combo3New($bsiCore->currency_code()); ?></td>
              </tr>
              <tr>
                <td><strong>Available Rooms:</strong></td>
                <td>
                </td>
              </tr>
            </table>
            <table  cellpadding="5" cellspacing="2" border="0" class="custom-main-table">
              <tr>
                <td><strong>First Name:</strong></td>
                <td valign="middle"><input type="text" name="fname" id="fname"></td>
              </tr>
              <tr>
                <td><strong>Last Name:</strong></td>
                <td valign="middle"><input type="text" name="lname" id="lname"></td>
              </tr>
              <tr>
                <td><strong>Email:</strong></td>
                <td valign="middle"><input type="text" name="email" id="lname"></td>
              </tr>
            </table>
          </div>
          <table class="table custom-table" id="roomResult">
            <thead>
              <tr>
                <th>Room Name</th>
                <th>Max Occupancy</th>
                <th>Total Price / Room</th>
                <th>Select Number of Room</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                <td><span class="grandTotal">0</span></td>
              </tr>
            </tfoot>
          </table>
          <div class="text-right">
            <input type="hidden" name="addedit" value="<?=$id?>">
            <input type="submit" value="Submit" name="submitCapacity" style="background:#e5f9bb; cursor:pointer; cursor:hand;"/>
          </div>
        </form>
      </div>
<script type="text/javascript">
	$().ready(function() {
		$("#form1").validate();
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    
    var checkin = $('[date-picker="1"]').datepicker({
      onRender: function(date) {
        return date.valueOf() < now.valueOf() ? 'disabled' : '';
      },
      format: 'mm/dd/yyyy',
    }).on('changeDate', function (ev) {
      if (ev.date.valueOf() > checkout.date.valueOf()) {
        var newDate = new Date(ev.date)
        newDate.setDate(newDate.getDate() + <?php echo  $bsiCore->config['conf_min_night_booking']; ?>);
        checkout.setValue(newDate);
        $('#btn_room_search').attr('disabled', false);
      }
      checkin.hide();
      $('[date-picker="2"]')[0].focus();
    }).data('datepicker');

    var checkout = $('[date-picker="2"]').datepicker({
      onRender: function(date) {
        var checkoutdt = parseInt(checkin.date.valueOf())+(60*60*24*1000*<?php echo  ($bsiCore->config['conf_min_night_booking']-1); ?>);
        return date.valueOf() <= checkoutdt ? 'disabled' : '';
      },
      format: 'mm/dd/yyyy',
    }).on('changeDate', function(ev) {
        if ($('[date-picker="2"]').val() && $('[date-picker="1"]').val()) {
          $.post('roomAvailability.php', {
            check_in: $('[date-picker="1"]').val(),
            check_out: $('[date-picker="2"]').val(),
            capacity: $('[name="capacity"]').val(),
            child_per_room: $('[name="child_per_room"]').val(),
            currency: $('[name="currency"]').val(),
            request: 'ajax'
          }).done(function (returnData) {
            const data = JSON.parse(returnData);
            if (data.length) {
              let strAppend = '';
              data.forEach((inData) => {
                strAppend += 
                `<tr>
                  <td><strong>${inData.rtname}</strong>(${inData.captitle})</td>
                  <td>${inData.capval}</td>
                  <td>${inData.total}</td>
                  <td>
                    <select name="svars_selectedrooms[]" style="width: 100px;">${inData.roomdropdown}</select>
                    <input type="hidden" name="room_id[]" value="${inData.roomId}">
                    <input type="hidden" name="rt_id[]" value="${inData.rtId}">
                    <input type="hidden" name="grandTotal[]" value="${inData.grandTotal}">
                    <input type="hidden" name="roomname[]" value="${inData.rtname}(${inData.captitle})">
                    <input type="hidden" name="capacitytitle[]" value="${inData.rtname}(${inData.captitle})">
                    <input type="hidden" name="capacityCount[]" value="${inData.capval}">
                    <input type="hidden" name="currencySymbol" value="${inData.currencySymbol}">
                  </td>
                  <td>
                    ${inData.currencySymbol}
                    <span>
                      0
                    </span>
                    <input type="hidden" data-compute="total" value="0"/>
                  </td>
                </tr>`;
              });
              $('#roomResult tbody').html(strAppend);
              let taxedGrandTotal = 0;
              $('[name="svars_selectedrooms[]"]').change(function () {
                let lineTotal = 0;
                lineTotal = $(this).val() * $(this).closest('td').find('[name="grandTotal[]"]').val();
                $(this).closest('tr').find('span').text(lineTotal);
                $(this).closest('tr').find('[data-compute="total"]').val(lineTotal);
                $('[data-compute="total"]').each(function () {
                  taxedGrandTotal = parseInt(taxedGrandTotal) + parseInt($(this).val());
                });
                $('.grandTotal').text(`${$('[name="currencySymbol"]').val()}${taxedGrandTotal.toFixed(2)}`);
              });
            }
          });
        }
        checkout.hide();
    }).data('datepicker');



		
});
         
</script>      
<script src="js/jquery.validate.js" type="text/javascript"></script>
<?php include("footer.php"); ?> 
