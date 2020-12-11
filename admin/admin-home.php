<?php 
include("access.php");
include("header.php"); 
include("../includes/conf.class.php");	
include("../includes/admin.class.php");
?>

	<div class="filter-holder">
		<form action="admin-home.php" id="filterForm">
			<div class="form-group">
				<label for="">Filter Year: </label>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-info" data-filter="sub">
					<i class="fa fa-chevron-left"></i>
				</button>
			</div>
			<div class="form-group">
				<input type="text" class="form-control text-center" name="a_startDate" readonly autocomplete="off" value="<?= isset($_GET['a_startDate']) ? $_GET['a_startDate'] : date('Y') ?>" />
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-info" data-filter="add">
					<i class="fa fa-chevron-right"></i>
				</button>
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

	const postRequestUrl = 'chartResultGetter.php';

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
			const returnDataVal = JSON.parse(returnData);
			let labels = [];
			let actualData = [];
			let forecastedData = [];
			for(let i = 1; i <= 12; i++) {
				labels.push(moment(returnDataVal[0][i].start_date).format('MMM YYYY'));
				actualData.push(returnDataVal[0][i].total);
			}
			for(let i = 1; i <= 12; i++) {
				forecastedData.push(returnDataVal[1][i].total);
			}
			new Chart(monthlyBookingsChart, {
				responsive: true,
				type: 'line',
				data: {
					labels: labels,
					datasets: [
						{
							label: "Actual Numbers",
							data: actualData,
							backgroundColor: 'rgba(167, 166, 244, .5)',
							borderColor: '#6ff',
							borderWidth: 3
						},
						{
							label: "Forcasting Analytics",
							data: forecastedData,
							backgroundColor: 'rgba(254, 92, 54, .5)',
							borderColor: '#feb449',
							borderWidth: 3
						},
					],
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

	$('[data-filter]').click(function () {
		const value = moment($('[name="a_startDate"]').val());
		if ($(this).data('filter') == 'add') {
			$('[name="a_startDate"]').val(value.add(1, 'year').format('YYYY'));
		} else {
			$('[name="a_startDate"]').val(value.subtract(1, 'year').format('YYYY'));
		}
		$('#filterForm').submit();
	});
} );
</script> 
<script type="text/javascript" src="js/bsi_datatables.js"></script>
<link href="css/data.table.css" rel="stylesheet" type="text/css" />
<link href="css/jqueryui.css" rel="stylesheet" type="text/css" />    
<?php include("footer.php"); ?> 