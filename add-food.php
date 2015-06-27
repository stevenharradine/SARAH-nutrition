<?php
	session_start();
	require_once '../../global.php';

	if( isset ($_SESSION['usertype']) ) {
		$USER_ID = $_SESSION['USER_ID'];
		
		$page_title = 'Add food | Nutrition | Budget';
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
		<table>
			<tr>
				<th>Name</th>
				<td></td>
			</tr>
			<tr>
				<th>Brand</th>
				<td></td>
			</tr>
			<tr>
				<th>Serving size</th>
				<td></td>
			</tr>
			<tr>
				<th>Serving size units</th>
				<td></td>
			</tr>
			<tr>
				<th>Calories</th>
				<td></td>
			</tr>
			<tr>
				<th>Fat</th>
				<td></td>
			</tr>
			<tr>
				<th>Saturated fat</th>
				<td></td>
			</tr>
			<tr>
				<th>Trans-fat</th>
				<td></td>
			</tr>
			<tr>
				<th>Monosaturated fat</th>
				<td></td>
			</tr>
			<tr>
				<th>Polysaturated fat</th>
				<td></td>
			</tr>
			<tr>
				<th>Cholesterol</th>
				<td></td>
			</tr>
			<tr>
				<th>Sodium</th>
				<td></td>
			</tr>
			<tr>
				<th>Potassium</th>
				<td></td>
			</tr>
			<tr>
				<th>Carbohydrate</th>
				<td></td>
			</tr>
			<tr>
				<th>Fiber</th>
				<td></td>
			</tr>
			<tr>
				<th>Insoluble fiber</th>
				<td></td>
			</tr>
			<tr>
				<th>Soluble fiber</th>
				<td></td>
			</tr>
			<tr>
				<th>Sugar</th>
				<td></td>
			</tr>
			<tr>
				<th>Protein</th>
				<td></td>
			</tr>
			<tr>
				<th>Calcium</th>
				<td></td>
			</tr>
			<tr>
				<th>Zinc</th>
				<td></td>
			</tr>
			<tr>
				<th>Copper</th>
				<td></td>
			</tr>
			<tr>
				<th>Manganese</th>
				<td></td>
			</tr>
			<tr>
				<th>Selenium</th>
				<td></td>
			</tr>
			<tr>
				<th>Fluoride</th>
				<td></td>
			</tr>
			<tr>
				<th>Niacin</th>
				<td></td>
			</tr>
			<tr>
				<th>Folate</th>
				<td></td>
			</tr>
			<tr>
				<th>Magnesium</th>
				<td></td>
			</tr>
			<tr>
				<th>Phosphorus</th>
				<td></td>
			</tr>
			<tr>
				<th>Iron</th>
				<td></td>
			</tr>
			<tr>
				<th>Riboflavin</th>
				<td></td>
			</tr>
			<tr>
				<th>Vitamin A</th>
				<td></td>
			</tr>
			<tr>
				<th>Vitamin B12</th>
				<td></td>
			</tr>
			<tr>
				<th>Vitamin C</th>
				<td></td>
			</tr>
			<tr>
				<th>Vitamin D</th>
				<td></td>
			</tr>
			<tr>
				<th>Vitamin E</th>
				<td></td>
			</tr>
			<tr>
				<th>Vitamin K</th>
				<td></td>
			</tr>
			<tr>
				<th>Thiamine</th>
				<td></td>
			</tr>
			<tr>
				<th>Vitamin B6</th>
				<td></td>
			</tr>
			<tr>
				<th>Pantothenic Acid</th>
				<td></td>
			</tr>
			<tr>
				<th>Choline</th>
				<td></td>
			</tr>
			<tr>
				<th>Bataine</th>
				<td></td>
			</tr>
		</table>
<?php
		include '../../views/_footer.php';
	} else {
		require_once ('../../auth/login.php');
	}	