<!DOCTYPE html>
<html>
	<head><title>Database Query Page</title></head>
	<body>
		<h2><strong>Database Query Interface</strong></h2>
		

		<!-- Input form -->
		<p>
		<form action="/~cs143/Project_1A/query.php" method="POST">
			<h3>Please input your database query here!</h3>
			<textarea name="query" cols="80" rows="10" placeholder="Please type your SQL query here."></textarea>
			<input type="submit" value="submit"/>
		</form>
		</p>

		<p><i><small>Note: tables and fields are case sensitive.</small></i></p>

		<?php 
			//Connect to the database
			$db_connection = mysql_connect("localhost", "cs143", "");

			//Select a database
			mysql_select_db("TEST", $db_connection);

			//Extract query content from the request
			$userquery = $_POST["query"];

			//Execute the query
			$rs = mysql_query($userquery, $db_connection) or die(mysql_error());

			//Create an array to hold all queries
			$container = array();
		?>


		<br>
		<p>
			<h3>Your query result:</h3>
			<table>
				<!-- Output the name of attribute as first row -->
				<tr align="center">
					<?php
						$i = 0;
						while($i < mysql_num_fields($rs)){
							$col_title = mysql_fetch_field($rs, $i);
							echo "<td><strong>" .$col_title->name. "</strong></td>";
							$i++;
						}
					?>
				</tr>

				<!-- Output the query result -->
				<?php
					$j = 0;
					while($row = mysql_fetch_row($rs)){
						echo '<tr align="center">';
						$count = count($row);
						$cnt = 0;
						while($cnt < $count){
							$curr_row = current($row);
							if($curr_row == NULL){
								echo "<td>N/A</td>";
							} else {
								echo "<td>".$curr_row."</td>";
							}
							next($row);
							$cnt++;
						}
						echo '</tr>';
						$i++;
					}
				?>

			</table>
		</p>

		<!-- Free result space and close connection -->
		<?php
			mysql_free_result($rs);
			mysql_close($db_connection);
		?>
	</body>


</html>