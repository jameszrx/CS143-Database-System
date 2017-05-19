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
				<h2><strong>Actor Information Page</strong></h2>
				<hr>
				<!-- Input form -->
						<?php
							if(isset($_REQUEST["identifier"])){
							//Connect to the database
							$db_connection = mysqli_connect("localhost", "cs143", "");

							if (!$db_connection){
				  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
							}

							//Select a database
							mysqli_select_db($db_connection, "TEST");

							//Extract query content from the request
							$id = $_REQUEST["identifier"];
							
							if ($id == null) {
								$rs = mysqli_query($db_connection,"SELECT * FROM Actor") or die(mysqli_error());
								$rs_movie = mysqli_query($db_connection,"SELECT * FROM Movie") or die(mysqli_error());
							} else {
								$rs = mysqli_query($db_connection,"SELECT * FROM Actor WHERE id = $id") or die(mysqli_error());
								$rs_movie = mysqli_query($db_connection,"SELECT MovieActor.role, Movie.title, Movie.id FROM Movie, MovieActor WHERE MovieActor.aid = $id AND MovieActor.mid = Movie.id") or die(mysqli_error());
							}
							
							echo "<h4><b>The Actor information is:</b></h4>";
							echo "<table class = 'table table-bordered table-condensed table-hover'>\n<tr align=center>";
							echo "<br>";

							echo "<td><b>Name</b></td>";
							echo "<td><b>Gender</b></td>";
							echo "<td><b>Date of Birth</b></td>";
							echo "<td><b>Date of Death</b></td>";

							echo "</tr>\n";
							while ($row = mysqli_fetch_row($rs)) {
								echo "<tr align=center>";
								echo "<td>$row[2] $row[1]</td>";
								echo "<td>$row[3]</td>";
								echo "<td>$row[4]</td>";
								if ($row[5] == null) {
									echo "<td>Still Alive</td>";
								} else {
									echo "<td>$row[5]</td>";
								}
								echo "</tr>\n";
							}
							echo "</table>";

							//movie results
							echo "<h4><b>Actor's Movies and Role:</b></h4>";
							echo "<table class = 'table table-bordered table-condensed table-hover'>\n<tr align=center>";
							echo "<br>";

							echo "<td><b>Role</b></td>";
							echo "<td><b>Title</b></td>";							
							
							echo "</tr>\n";
							while ($row = mysqli_fetch_row($rs_movie)) {
								echo "<tr align=center>";
								echo "<td>$row[0]</td>";
								echo '<td><a href= "Show_M.php?identifier='."$row[2]".'">'."$row[1]".'</a></td>';
								echo "</tr>\n";
							}
							echo "</table>";

							mysqli_free_result($rs);
							mysqli_free_result($rs_movie);
							mysqli_close($db_connection);
						}
					?>
					<label for="search_input">Search:</label>
					<form class="form-group" method ="GET" id="usrform" action="search.php">
						<input type="text" class="form-control" placeholder="Search..." name="search_input"><br>
						<input type="submit" value="submit" class="btn btn-primary"/>
					</form>
				</div>
			</div>
		</div>
		
	 

	

	</body>

</html>

