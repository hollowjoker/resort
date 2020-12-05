<?php 
include("access.php");
include("header.php"); 
include("../includes/conf.class.php");	
include("../includes/admin.class.php");
?>

	<div class="filter-holder">
		<form action="admin-home.php">
			<div class="form-group">
				<label for="">Filter: </label>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="a_startDate" autocomplete="off" date-picker="1" value="<?= isset($_GET['a_startDate']) ? $_GET['a_startDate'] : ''?>" />
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="a_endDate" autocomplete="off" date-picker="2" value="<?= isset($_GET['a_endDate']) ? $_GET['a_endDate'] : ''?>"/>
			</div>
			<div class="form-group">
				<button class="btn btn-info">Search</button>
			</div>
		</form>
	</div>
	<div class="chart-holder">
		<div class="chart-holder-panels">
			<div class="chart-holder-panels__holder panel-success">
				<div class="chart-holder-panels__holder--icon">
					<i class="fa fa-chevron-up"></i>
				</div>
				<div class="chart-holder-panels__holder--detail" data-content="most-month">
					<span data-pop="total">0</span>
					<span data-filter="month">Month</span>
					<span>Month w/ most Booking</span>
				</div>
			</div>
		</div>
		<div class="chart-holder-panels">
			<div class="chart-holder-panels__holder panel-danger">
				<div class="chart-holder-panels__holder--icon">
					<i class="fa fa-chevron-down"></i>
				</div>
				<div class="chart-holder-panels__holder--detail" data-content="least-month">
					<span data-pop="total">0</span>
					<span data-filter="month">Month</span>
					<span>Month w/ least Booking</span>
				</div>
			</div>
		</div>
		<div class="chart-holder-panels">
			<div class="chart-holder-panels__holder panel-success">
				<div class="chart-holder-panels__holder--icon">
					<i class="fa fa-chevron-up"></i>
					<i class="fa fa-bookmark-o"></i>
				</div>
				<div class="chart-holder-panels__holder--detail" data-content="most-room">
					<span data-pop="total">0</span>
					<span data-filter="room">Room Name</span>
					<span>Room w/ most Booking</span>
				</div>
			</div>
		</div>
		
		<div class="chart-holder-panels">
			<div class="chart-holder-panels__holder panel-danger">
				<div class="chart-holder-panels__holder--icon">
					<i class="fa fa-chevron-down"></i>
					<i class="fa fa-bookmark-o"></i>
				</div>
				<div class="chart-holder-panels__holder--detail" data-content="least-room">
					<span data-pop="total">0</span>
					<span data-filter="room">Room Name</span>
					<span>Room w/ least Booking</span>
				</div>
			</div>
		</div>
	</div>
	<div class="chart-holder">
		<div class="chart-holder__canvas">
			<div class="chart-holder__canvas--header">No. Bookings /month</div>
			<canvas id="bookingsMonth" height="300"></canvas>
		</div>
	</div>
	<div class="chart-holder">
		<div class="chart-holder__canvas">
			<div class="chart-holder__canvas--header">No. Bookings /room</div>
			<canvas id="bookingsRoom" height="300"></canvas>
		</div>
	</div>
	<div id="container-inside">
		<span style="font-size:16px; font-weight:bold"><?=LAST_10_BOOKING?></span>
		<hr />
		<table class="display datatable" border="0" id="test5">
			<?=$bsiAdminMain->homewidget(1)?>
		</table>
		<br />
		
		<span style="font-size:16px; font-weight:bold"><?=TODAY_CHECK_IN?></span>
		<hr />
		<table class="display datatable" border="0">
			<?=$bsiAdminMain->homewidget(2)?>
		</table>
		<br />
		
		<span style="font-size:16px; font-weight:bold"><?=TODAY_CHECK_OUT?></span>
		<hr />
		<table class="display datatable" border="0">
			<?=$bsiAdminMain->homewidget(3)?>
		</table>
		<br />
	</div>
<script type="text/javascript" src="js/DataTables/jquery.dataTables.js"></script>
<script>
 $(document).ready(function() {
	var oTable = $('.datatable').dataTable( {
			"bJQueryUI": true,
			"sScrollX": "",
			"bSortClasses": false,
			"aaSorting": [[0,'desc']],
			"bAutoWidth": true,
			"bInfo": true,
			"sScrollY": "100%",	
			"sScrollX": "100%",
			"bScrollCollapse": true,
			"sPaginationType": "full_numbers",
			"bRetrieve": true,
			"oLanguage": {
							"sSearch": "<?=DT_SEARCH?>:",
							"sInfo": "<?=DT_SINFO1?> _START_ <?=DT_SINFO2?> _END_ <?=DT_SINFO3?> _TOTAL_ <?=DT_SINFO4?>",
							"sInfoEmpty": "<?=DT_INFOEMPTY?>",
							"sZeroRecords": "<?=DT_ZERORECORD?>",
							"sInfoFiltered": "(<?=DT_FILTER1?> _MAX_ <?=DT_FILTER2?>)",
							"sEmptyTable": "<?=DT_EMPTYTABLE?>",
							"sLengthMenu": "<?=DT_LMENU?> _MENU_ <?=DT_SINFO4?>",
							"oPaginate": {
											"sFirst":    "<?=DT_FIRST?>",
											"sPrevious": "<?=DT_PREV?>",
											"sNext":     "<?=DT_NEXT?>",
											"sLast":     "<?=DT_LAST?>"
											}
							}
	} );

	$('[date-picker="1"], [date-picker="2"]').datepicker();

	const options = {
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero: true
				}
			}]
		}
	};

	let postRequestUrl = '../admin/chartResultGetter.php';

	$.post(
		postRequestUrl,
		{type: "mostMonth"}
	).done(function (returnData) {
		if (returnData != '') {
			const data = JSON.parse(returnData);
			const mainContainer = $('[data-content="most-month"]');
			mainContainer.find('[data-pop="total"]').text(data.total);
			mainContainer.find('[data-filter="month"]').text(moment(data.start_date).format('MMM YYYY'));
		}
	});
	$.post(
		postRequestUrl,
		{type: "leastMonth"}
	).done(function (returnData) {
		if (returnData != '') {
			const data = JSON.parse(returnData);
			const mainContainer = $('[data-content="least-month"]');
			mainContainer.find('[data-pop="total"]').text(data.total);
			mainContainer.find('[data-filter="month"]').text(moment(data.start_date).format('MMM YYYY'));
		}
	});

	$.post(
		postRequestUrl,
		{type: "mostRoom"}
	).done(function (returnData) {
		if (returnData != '') {
			const data = JSON.parse(returnData);
			const mainContainer = $('[data-content="most-room"]');
			mainContainer.find('[data-pop="total"]').text(data.sumed);
			mainContainer.find('[data-filter="room"]').text(`${data.type_name} (${data.title})`);
		}
	});
	
	$.post(
		postRequestUrl,
		{type: "leastRoom"}
	).done(function (returnData) {
		if (returnData != '') {
			const data = JSON.parse(returnData);
			const mainContainer = $('[data-content="least-room"]');
			mainContainer.find('[data-pop="total"]').text(data.sumed);
			mainContainer.find('[data-filter="room"]').text(`${data.type_name} (${data.title})`);
		}
	});

	var monthlyBookingsChart = $('#bookingsMonth');
	$.post(
		postRequestUrl,
		{
			type: "bookingsMonthly",
			a_startDate: "<?= isset($_GET['a_startDate']) ? $_GET['a_startDate'] : '' ?>",
			a_endDate: "<?= isset($_GET['a_endDate']) ? $_GET['a_endDate'] : '' ?>"
		}
	).done(function (returnData) {
		if (returnData != '') {
			const data = JSON.parse(returnData);
			let labels = [];
			let datas = [];
			data.forEach((data, key) => {
				labels.push(moment(data.start_date).format('MMM YYYY'));
				datas.push(data.total);
			});
			new Chart(monthlyBookingsChart, {
				responsive: true,
				type: 'line',
				data: {
					labels: labels,
					datasets: [{
						label: '# of Booking',
						data: datas,
						backgroundColor: 'rgba(167, 166, 244, .5)',
						borderColor: '#6ff',
						borderWidth: 3
					}]
				},
				options: options
			});
		}
	});

	var roomBookingsChart = $('#bookingsRoom');
	$.post(
		postRequestUrl,
		{ type: "allRooms" }
	).done(function (returnData) {
		if (returnData != '') {
			const data = JSON.parse(returnData);
			let labels = [];
			let datas = [];
			data.forEach((data, key) => {
				labels.push(`${data.type_name} (${data.title})`);
				datas.push(data.sumed);
			});
			new Chart(roomBookingsChart, {
				responsive: true,
				type: 'line',
				data: {
					labels: labels,
					datasets: [{
						label: '# of Booking',
						data: datas,
						backgroundColor: 'rgba(167, 166, 244, .5)',
						borderColor: '#6ff',
						borderWidth: 3
					}]
				},
				options: options
			});
		}
	});

	
	$('.notification-holder').click(function () {
		$(this).find('.notification-menu').toggleClass('show');
		$.post('../admin/getRequests.php',{
			requestType: 'readNotification'
		}).done(function (returnData) {
			getNotif();
		});
	});

	setInterval(function () {
		getNotif();
	}, 5000);

	getNotif();

	function getNotif() {
		$.post('../admin/getRequests.php',{
			requestType: 'getNotification'
		}).done(function (returnData) {
			const data = JSON.parse(returnData);
			if (returnData.length) {
				let toAppend = '';
				let closed = 0;
				data.forEach((inData) => {
					let icon = '';
					if (inData.type == 1) {
						icon = 'mobile';
					} else if (inData.type == 2) {
						icon = 'wifi';
					}
					if (inData.status == 0) {
						closed += 1;
					}
					toAppend += `
					<li class="border-${icon}">
						<div class="detail-holder">
							<span>${inData.first_name} ${inData.surname} - Room # ${inData.room_no}</span>
							<span>
								<i class="fa fa-${icon}" style="margin-right: 5px; font-size: 16px"></i>
								<span>${inData.message}</span>
							</span>
							<span><i class="fa fa-clock-o" style="margin-right: 5px;"></i>${moment(inData.date_created).fromNow()}</span>
						</div>
					</li>`;
				});
				$('.notification-menu ul').html(toAppend);
				$('[data-badge="count"]').removeClass('show');
				if (closed > 0) {
					$('[data-badge="count"]').addClass('show');
				}
				$('[data-badge="count"]').text(closed);
			}
		});
	}
} );
</script> 
<script type="text/javascript" src="js/bsi_datatables.js"></script>
<link href="css/data.table.css" rel="stylesheet" type="text/css" />
<link href="css/jqueryui.css" rel="stylesheet" type="text/css" />    
<?php include("footer.php"); ?> 