<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Add New Actor or Director</title>
		<link href="./css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/add_page.css" rel="stylesheet">
	</head>

	<body>
		<nav class="navbar navbar-defalt navbar-fixed-top topside">
      <div class="container-fluid">
        <div class="navbar-header navbar-defalt">
          <a class="navbar-brand topside">CS143 DataBase Query System</a>
        </div>
      </div>
    </nav>


    <br><br>
    <div class="container">
    	<div class="row">
    		<div class="col-sm-2 col-md-2 leftside">
    			<ul class="nav nav-sidebar">
    				<br>
            <p><strong>Add new content</strong></p>
            <li><a href="add_person.php">Add Actor/Director</a></li>
            <li><a href="add_movieinfo.php">Add Movie Information</a></li>
            <li><a href="add_movie_actor_relation.php">Add Movie/Actor Relation</a></li>
            <li><a href="add_movie_director_relation.php">Add Movie/Director Relation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <p><strong>Browsering Content</strong></p>
            <li><a href="Show_A.php">Show Actor Information</a></li>
            <li><a href="Show_M.php">Show Movie Information</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <p><strong>Search Interface</strong></p>
            <li><a href="search.php">Search/Actor Movie</a></li>
          </ul>
    		</div>


	    	<div class="col-sm-10 col-md-10 main">
				<h2><strong>Actor / Actress / Movie Search Page</strong></h2>
				<hr>
				<!-- Input form -->
					<label for="search_input">Search:</label>
					<form class="form-group" method ="GET" id="usrform" action="<?php $_SERVER[PHP_SELF]?>">
						<input type="text" class="form-control" placeholder="Search..." name="search_input"><br>
						<input type="submit" value="submit" class="btn btn-primary"/>
					</form>

						<?php
							//if no http input is inserted, return a default page
							if(isset($_REQUEST["search_input"])){
							//Connect to the database
							$db_connection = mysqli_connect("localhost", "cs143", "");

							if (!$db_connection){
				  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}

							//Select a database
							mysqli_select_db($db_connection, "TEST");

							//Extract query content from the request
							$input_string = trim($_REQUEST["search_input"]);
							$keywords = preg_split("/[\s,]+/", $input_string);
							if ($input_string == null) {
								$rs = mysqli_query($db_connection,"SELECT * FROM Actor") or die(mysqli_error());
								$rs_movie = mysqli_query($db_connection,"SELECT * FROM Movie") or die(mysqli_error());
							} else {
								if(count($keywords) == 1) {
									$rs = mysqli_query($db_connection,"SELECT * FROM Actor WHERE first like '$keywords[0]' OR last like '$keywords[0]'") or die(mysqli_error());
								} else if (count($keywords) == 2){
									$rs = mysqli_query($db_connection,"SELECT * FROM Actor WHERE (first like '$keywords[0]' AND last like '$keywords[1]') OR (first like '$keywords[1]' AND last like '$keywords[0]')") or die(mysqli_error());
								}
								$movie_query = "SELECT * FROM Movie WHERE title like '%{$keywords[0]}%'";
								for ($i = 1; $i < count($keywords); $i++) {
									$movie_query = $movie_query." AND title like '%{$keywords[$i]}%'";
								}
								$rs_movie = mysqli_query($db_connection, $movie_query) or die(mysqli_error());
							}

							//print actor results
							echo "<h4><b>matching Actors are:</b></h4>";
							echo "<table class = 'table table-bordered table-condensed table-hover'>\n<tr align=center>";
							echo "<br>";

							echo "<td><b>Name</b></td>";
							echo "<td><b>Gender</b></td>";
							echo "<td><b>Date of Birth</b></td>";
							
							echo "</tr>\n";
							while ($row = mysqli_fetch_row($rs)) {
								echo "<tr align=center>";

								echo '<td><a href="Show_A.php?identifier='."$row[0]".'">'."$row[2] $row[1]".'</a></td>';
								echo "<td>$row[3]</td>";
								echo "<td>$row[4]</td>";
								echo "</tr>\n";
							}
							echo "</table>";

							//print movie results
							echo "<h4><b>matching Movies are:</b></h4>";
							echo "<table class = 'table table-bordered table-condensed table-hover'>\n<tr align=center>";
							echo "<br>";

							echo "<td><b>Title</b></td>";
							echo "<td><b>Year</b></td>";
							
							
							echo "</tr>\n";
							while ($row = mysqli_fetch_row($rs_movie)) {
								echo "<tr align=center>";
								echo '<td><a href= "Show_M.php?identifier='."$row[0]".'">'."$row[1]".'</a></td>';
								echo "<td>$row[2]</td>";
								echo "</tr>\n";
							}
							echo "</table>";

							mysqli_free_result($rs);
							mysqli_free_result($rs_movie);
							mysqli_close($db_connection);
						}
					?>

				</div>
			</div>
		</div>
		
	 

	

	</body>

</html>

