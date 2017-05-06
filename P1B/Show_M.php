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
				<h2><strong>Movie Information Page</strong></h2>
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
								$rs = mysqli_query($db_connection,"SELECT Actor.first, Actor.last, MovieActor.role, Actor.id FROM Actor, MovieActor WHERE MovieActor.mid = $id AND MovieActor.aid = Actor.id") or die(mysqli_error());
								$rs_movie = mysqli_query($db_connection,"SELECT * FROM Movie WHERE id = $id") or die(mysqli_error());
								$rs_director = mysqli_query($db_connection,"SELECT Director.first, Director.last FROM MovieDirector, Director WHERE mid = $id AND MovieDirector.did = Director.id") or die(mysqli_error());
								$rs_genre = mysqli_query($db_connection,"SELECT genre FROM MovieGenre WHERE mid = $id") or die(mysqli_error());
								$rs_review = mysqli_query($db_connection,"SELECT AVG(rating), COUNT(rating) FROM Review WHERE mid = $id") or die(mysqli_error());
								$rs_comment = mysqli_query($db_connection,"SELECT name, rating, time, comment FROM Review WHERE mid = $id") or die(mysqli_error());

								//$time = date("Y-m-d H:i:sa");
								//mysqli_query($db_connection,"INSERT INTO Review VALUES ('bbb','$time', $id, 1, 'fantastic!')");

							}


							//movie results
							echo "<h4><b>Movie Information is : </b></h4>";
							$movie = mysqli_fetch_row($rs_movie);

							echo "Title: $movie[1] <br>";
							echo "Producer: $movie[4]<br>";
							echo "MPAA Rating: $movie[3]<br>";

							//multiple directors?
							$director = mysqli_fetch_row($rs_director);
							if ($director == null) {
								echo "Director: N/A";
							} else {
								echo "Director: $director[0] $director[1]";
								while ($director = mysqli_fetch_row($rs_director)) {
									echo ",$director[0] $director[1]";
								}	
							}
							echo "<br>";

							//multiple genres?
							$genre = mysqli_fetch_row($rs_genre);
							if ($genre == null) {
								echo "Genre: N/A";
							} else {
								echo "Genre: $genre[0]";
								while ($genre = mysqli_fetch_row($rs_genre)) {
									echo ",$genre[0]";
								}
							}
							echo "<br>";

							//Actors info
							echo "<h4><b>Actors in this Movie : </b></h4>";
							echo "<table class = 'table table-bordered table-condensed table-hover'>\n<tr align=center>";
							echo "<br>";

							echo "<td><b>Name</b></td>";
							echo "<td><b>Role</b></td>";
							

							echo "</tr>\n";
							while ($row = mysqli_fetch_row($rs)) {
								echo "<tr align=center>";
								echo '<td><a href="Show_A.php?identifier='."$row[3]".'">'."$row[2] $row[1]".'</a></td>';
								echo "<td>$row[2]</td>";
								echo "</tr>\n";
							}
							echo "</table><hr>";

							//user review:
							$review = mysqli_fetch_row($rs_review);
							echo "<h4><b>User Review : </b></h4>";
							echo "Average score for this Movie is $review[0]/5 based on $review[1] people's reviews.<br>";
							echo '<a href= "add_comment.php?MovieID='."$movie[0]".'">leave your comment as well!</a><hr>';

							//user comments details
							echo "<h4><b>Comment detials shown below : </b></h4>";
							echo "<hr>";

							while ($row_comment = mysqli_fetch_row($rs_comment)) {
								echo "$row_comment[0] rates the this movie with score $row_comment[1] and left a review at $row_comment[2]<br>comment:<br>$row_comment[3]<br>";
							}
							

							mysqli_free_result($rs);
							mysqli_free_result($rs_movie);
							mysqli_free_result($rs_genre);
							mysqli_free_result($rs_director);
							mysqli_free_result($rs_review);
							mysqli_free_result($rs_comment);
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

