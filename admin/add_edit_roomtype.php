<?php 
include("access.php");
if(isset($_POST['submitRoomtype'])){
  echo '<pre>';
  $_POST['capacity_title'] = $_POST['roomtype_title'];
	include("../includes/db.conn.php"); 
	include("../includes/conf.class.php");
	include("../includes/admin.class.php");
	$bsiAdminMain->add_edit_roomtype();
	$bsiAdminMain->add_edit_capacity();
	header("location:roomtype.php");	
	exit;
}
include("header.php"); 
include("../includes/conf.class.php");
include("../includes/admin.class.php");
if(isset($_GET['id']) && $_GET['id'] != ""){
	$id = $bsiCore->ClearInput($_GET['id']);
	if($id){
		$result = $mysqli->query($bsiAdminMain->getRoomtypesql($id));
    $row    = $result->fetch_assoc();
    
    $resultCapacity = $mysqli->query($bsiAdminMain->getCapacitysql($id));
    $rowCapacity = $resultCapacity->fetch_assoc();
		$readonly = 'readonly="readonly"';
	}else{
		$row    = NULL;
		$rowCapacity = NULL;
		$readonly = '';
	}
}else{
	header("location:admin_capacity.php");
	exit;
}
?>  
 <link rel="stylesheet" type="text/css" href="css/jquery.validate.css" />
      <div id="container-inside">
      <span style="font-size:16px; font-weight:bold"><?php echo ROOM_TYPE_ADD_AND_EDIT;?></span>
      <hr />
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="form1" enctype="multipart/form-data">
          <table cellpadding="5" cellspacing="2" border="0">
            <tr>  
              <td><strong><?php echo ROOM_TYPE_TITLE;?>:</strong></td>
              <td valign="middle"><input type="text" name="roomtype_title" id="roomtype_title" class="required" value="<?= isset($row['type_name']) ? $row['type_name'] : ''?>" style="width:250px;" /> &nbsp;&nbsp;<?php echo EXAMPLE_DELUXE_AND_STANDARD;?></td>
            </tr>
            <tr>
              <td valign="top"><strong><?php echo DESCRIPTION_FACILITIES_TEXT; ?>:</strong></td>
              <td><textarea rows="5" cols="3" name="description" id="description" style="width:700px; height:150px;"><?php echo isset($row['description']) ? $row['description'] : '';?></textarea></td>
            </tr>
            <tr>
              </tr>
            <tr>
              <td><strong><?php echo ADD_EDIT_CAPACITY_NUMBER_OF_ADULT; ?>:</strong></td>
              <td>
                <input type="text" name="no_adult" id="no_adult" <?=$readonly?> value="<?= isset($rowCapacity['capacity']) ? $rowCapacity['capacity'] : ''?>" class="required number" style="width:70px;"  />
                <input type="hidden" name="capacity_title" id="capacity_title" class="required" value="<?=$rowCapacity['roomtype_title'] ? $rowCapacity['roomtype_title'] : ''?>" style="width:250px;" />
              </td>
            </tr>
            <tr>           
              <td><input type="hidden" name="addedit" value="<?=$id?>"></td>
              <td><input type="submit" value="<?php echo ROOM_TYPE_SUBMIT;?>" name="submitRoomtype" style="background:#e5f9bb; cursor:pointer; cursor:hand;"/></td>
            </tr>
          </table>
        </form>
      </div>
<script type="text/javascript">
	$().ready(function() { $("#form1").validate(); });       
</script>      
<script src="js/jquery.validate.js" type="text/javascript"></script>
<?php include("footer.php"); ?> 
