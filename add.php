<?php
	session_start();
	require_once '../../global.php';

	if( isset ($_SESSION['usertype']) ) {
		$USER_ID = $_SESSION['USER_ID'];
		
		$year	= $_REQUEST['year'];
		$month	= $_REQUEST['month'];
		$day	= $_REQUEST['day'];
		$food_id	= isset ($_REQUEST['food_id']) ? $_REQUEST['food_id'] : null;
		$time_stamp	= $_REQUEST['time_stamp'] != 'CURRENT_TIMESTAMP' ? '\'' . $_REQUEST['time_stamp'] . '\'' : "CURRENT_TIMESTAMP";
		$quantity	= isset ($_REQUEST['quantity']) ? $_REQUEST['quantity'] : 1;
		$db_write_success = 0;
		
		DB_Connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_NAME);
		
		if (isset ($_REQUEST['food_id']) && isset ($_REQUEST['quantity']) && isset ($_REQUEST['time_stamp'])) {
			$db_write_success = mysql_query("INSERT INTO  `sarah`.`nutrition_history` (`NUTRITION_HISTORY_ID` ,`USER_ID` ,`FOOD_ID`, `quantity`, `date`)VALUES (NULL ,  '$USER_ID',  '$food_id', '$quantity', $time_stamp);") or die(mysql_error());
		}
		
		$sql = "SELECT `FOOD_ID`,`name`,`brand`,`serving_size`,`serving_unit` FROM `nutrition_information`" . (isset ($_REQUEST['search']) ? " WHERE `name` LIKE '%" . $_REQUEST['search'] . "%'" : "");
		$nutrition_data = mysql_query($sql) or die(mysql_error());
		
		$page_title = 'Add | Nutrition';
		$style = <<<EOD
				.date, .add {
					float: right;
					margin: 5px 0;
				}
				tfoot tr td {
					font-weight: bold;
				}
EOD;
		$alt_menu = '<a href="add.php" class="add">Add</a>';

		include '../../views/_header.php';
?>
		<?php
			if (isset ($_REQUEST['food_id']) && isset ($_REQUEST['quantity']) && isset ($_REQUEST['time_stamp'])) {
				if ($db_write_success)
					echo "<p class=\"notice\">Write successful</p>";
				else
					echo "<p class=\"notice error\">Write failed</p>";
			}
		?>
		<table>
			<thead>
				<tr>
					<td>
						<form action="add.php" method="post">
							<input type="text" name="search" />
							<input type="submit" value="Find" />
						</form>
					</td>
					<td>Quantity</td>
					<td>YYYY-MM-DD HH:MM:SS</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<form action="add.php" method="post">
					<tr>
						<td>
							<select name="food_id">
								<?php
									while (($nutrition_data_row = mysql_fetch_array( $nutrition_data )) != null) {
										$food_id		= $nutrition_data_row['FOOD_ID'];
										$name			= $nutrition_data_row['name'];
										$brand			= $nutrition_data_row['brand'] == '' ? '' : '(' . $nutrition_data_row['brand'] . ')';
										$serving_size	= $nutrition_data_row['serving_size'];
										$serving_unit	= $nutrition_data_row['serving_unit'];
										echo "<option value=\"$food_id\">$name $brand - $serving_size $serving_unit</option>";
									}
								?>
							</select>
						</td>
						<td><input type="text" name="quantity" value="1" size="3" /></td>
						<td><input type="text" name="time_stamp" value="<?php echo isset($_REQUEST['time_stamp']) ? $_REQUEST['time_stamp'] : "CURRENT_TIMESTAMP"; ?>" /></td>
						<td><input type="submit" value="I ate that" /></td>
					</tr>
				</form>
			</tbody>
		</table>
<?php
		include '../../views/_footer.php';
	} else {
		require_once ('../../auth/login.php');
	}