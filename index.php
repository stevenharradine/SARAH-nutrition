<?php
	session_start();
	require_once '../../global.php';

	if( isset ($_SESSION['usertype']) ) {
		$USER_ID = $_SESSION['USER_ID'];
		
		$year = $_REQUEST['year'];
		$month = $_REQUEST['month'];
		$day = $_REQUEST['day'];
		
		$total_calories = 0;
		$total_fat = 0;
		$total_fat_saturated = 0;
		$total_fat_trans = 0;
		$total_sodium = 0;
		$total_cholesterol = 0;
		$total_carbohydrate = 0;
		$total_fiber = 0;
		$total_sugar = 0;
		$total_protein = 0;
		
		DB_Connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_NAME);
		
		$data = mysql_query("SELECT COUNT(*) FROM `nutrition_history` WHERE `USER_ID` = $USER_ID AND `date` LIKE '$year-$month-$day%'") or die(mysql_error());
		$row = mysql_fetch_array( $data );
		$number_of_records = $row['COUNT(*)'];
		
		$nutrition_history_data = mysql_query("SELECT * FROM `nutrition_history` WHERE `USER_ID` = $USER_ID AND `date` LIKE '$year-$month-$day%'") or die(mysql_error());
		
		$page_title = 'Nutrition';
		if (! (isset ($_REQUEST['year']) && isset ($_REQUEST['month']) && isset ($_REQUEST['day']))) {
			$meta = "<meta http-equiv='refresh' content='0;url=index.php?year=" . date("Y") . "&month=" . date("m") . "&day=" . date("d") . "' />";
		}
		
		$alt_menu = '<a href="add.php" class="add">Add</a>';
		
		include '../../views/_header.php';
?>
<table>
<thead>
	<tr>
		<th></th>
		<th></th>
		<th></th>
		<th colspan="3">Fat</th>
		<th></th>
		<th></th>
		<th colspan="3">Carbohydrate</th>
		<th></th>
		<th></th>
	</tr>
	<tr>
		<th></th>
		<th>Qty</th>
		<th>Calories</th>
		<th>Total</th>
		<th>Satruated</th>
		<th>Trans</th>
		<th>Sodium</th>
		<th>Cholesterol</th>
		<th>Total</th>
		<th>Fiber</th>
		<th>Sugar</th>
		<th>Protein</th>
	</tr>
</thead>
<tbody>
<?php
		while (($nutrition_history_row = mysql_fetch_array( $nutrition_history_data )) != null) {
			$nutrition_data = mysql_query("SELECT * FROM `nutrition_information` WHERE `FOOD_ID` = " . $nutrition_history_row['FOOD_ID']) or die(mysql_error());
			$nutrition_row = mysql_fetch_array( $nutrition_data );
				
?>
<tr>
	<th><?php echo $nutrition_row['name']; ?></th>
	<td><?php echo $nutrition_history_row['quantity']; ?></td>
	<td><?php echo $nutrition_row['calories'] *= $nutrition_history_row['quantity']; $total_calories += $nutrition_row['calories']; ?></td>
	<td><?php echo $nutrition_row['fat'] *= $nutrition_history_row['quantity']; $total_fat += $nutrition_row['fat'];?></td>
	<td><?php echo $nutrition_row['fat_saturated'] *= $nutrition_history_row['quantity']; $total_fat_saturated += $nutrition_row['fat_saturated'];?></td>
	<td><?php echo $nutrition_row['fat_trans'] *= $nutrition_history_row['quantity']; $total_fat_trans += $nutrition_row['fat_trans'];?></td>
	<td><?php echo $nutrition_row['sodium'] *= $nutrition_history_row['quantity']; $total_sodium += $nutrition_row['sodium']; ?></td>
	<td><?php echo $nutrition_row['cholesterol'] *= $nutrition_history_row['quantity']; $total_cholesterol += $nutrition_row['cholesterol']; ?></td>
	<td><?php echo $nutrition_row['carbohydrate'] *= $nutrition_history_row['quantity']; $total_carbohydrate += $nutrition_row['carbohydrate']; ?></td>
	<td><?php echo $nutrition_row['fiber'] *= $nutrition_history_row['quantity']; $total_fiber += $nutrition_row['fiber']; ?></td>
	<td><?php echo $nutrition_row['sugar'] *= $nutrition_history_row['quantity']; $total_sugar += $nutrition_row['sugar']; ?></td>
	<td><?php echo $nutrition_row['protein'] *= $nutrition_history_row['quantity']; $total_protein += $nutrition_row['protein']; ?></td>
</tr>
<?php
			}
?>
	</tbody>
	<tfoot>
		<tr>
			<td></td>
			<td></td>
			<td><?php echo $total_calories; ?></td>
			<td><?php echo $total_fat; ?></td>
			<td><?php echo $total_fat_saturated; ?></td>
			<td><?php echo $total_fat_trans; ?></td>
			<td><?php echo $total_sodium; ?></td>
			<td><?php echo $total_cholesterol; ?></td>
			<td><?php echo $total_carbohydrate; ?></td>
			<td><?php echo $total_fiber; ?></td>
			<td><?php echo $total_sugar; ?></td>
			<td><?php echo $total_protein; ?></td>
		</tr>
	</tfoot>
</table>
<?php
		include '../../views/_footer.php';
	} else {
		require_once ('../../auth/login.php');
	}
