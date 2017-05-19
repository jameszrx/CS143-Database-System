<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Add New Movie</title>
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
    			<h2><strong>New Movie Input Page</strong></h2>
    			<!-- Input form -->
					<form action="<?php $_PHP_SELF?>" method="POST">
						<span class="req"><small><i>* required field</i></small></span><br><br>
						Movie title*: <input type="text" class="form-control" name="title" placeholder="eg: Wolverine" required/>
						<br>
						Year*: <input type="text" class="form-control" name="year" placeholder="eg: 2017" required/>
						<br>
						Rating: 
							<select class="form-control" name="rating">
								<option value="none" selected="selected">Please Select</option>
								<option value="G">G</option>
								<option value="PG">PG</option>
								<option value="PG-13">PG-13</option>
								<option value="R">R</option>
								<option value="NC-17">NC-17</option>
							</select>
						<br>
						Company: <input type="text" class="form-control" name="company" placeholder="eg: Universal"/>
						<br>
						Genre: 
						<input type="checkbox" name="genre[]" value="Action">Action</input>
	                    <input type="checkbox" name="genre[]" value="Adult">Adult</input>
	                    <input type="checkbox" name="genre[]" value="Adventure">Adventure</input>
	                    <input type="checkbox" name="genre[]" value="Animation">Animation</input>
	                    <input type="checkbox" name="genre[]" value="Comedy">Comedy</input>
	                    <input type="checkbox" name="genre[]" value="Crime">Crime</input>
	                    <input type="checkbox" name="genre[]" value="Documentary">Documentary</input>
	                    <input type="checkbox" name="genre[]" value="Drama">Drama</input>
	                    <input type="checkbox" name="genre[]" value="Family">Family</input>
	                    <input type="checkbox" name="genre[]" value="Fantasy">Fantasy</input>
	                    <input type="checkbox" name="genre[]" value="Horror">Horror</input>
	                    <input type="checkbox" name="genre[]" value="Musical">Musical</input>
	                    <input type="checkbox" name="genre[]" value="Mystery">Mystery</input>
	                    <input type="checkbox" name="genre[]" value="Romance">Romance</input>
	                    <input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi</input>
	                    <input type="checkbox" name="genre[]" value="Short">Short</input>
	                    <input type="checkbox" name="genre[]" value="Thriller">Thriller</input>
	                    <input type="checkbox" name="genre[]" value="War">War</input>
	                    <input type="checkbox" name="genre[]" value="Western">Western</input>
						<br>
						<input type="submit" value="submit" class="btn btn-primary"/>
					</form>

					<!-- Data processing -->
					  <?php
					  	if($_SERVER["REQUEST_METHOD"] == "POST"){
					  		$db_connection = mysqli_connect("localhost", "cs143", "");

								if (mysqli_connect_errno()){
					  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
					  		}

								//Select a database
								mysqli_select_db($db_connection, "TEST");

								//Extract query content from the request
								$title = trim($_POST["title"]);
								$year = trim($_POST["year"]);

								$rating = $_POST["rating"];
								//$rating = !($rating == "none") ? "'$rating'" : "NULL";
								if($rating == "none"){
									$rating = "NULL";
								} else {
									$rating = "'$rating'";
								}

								$company = trim($_POST["company"]);
								if(empty($_POST["company"]) || $company == ""){
									$company = "NULL";
								} else {
									$company = "'$company'";
								}

								// find the movie id
								$idquery = mysqli_query($db_connection, "SELECT id FROM MaxMovieID") or die(mysql_error());
								$id_result = mysqli_fetch_array($idquery);
								$id = $id_result[0];
								$id = $id + 1;
								
								//create query to update maxID
								$updateMaxID = "UPDATE MaxMovieID SET id = $id";

								//generate insert query
								$query_insert = "INSERT INTO Movie VALUES ('$id','$title', '$year', $rating, $company)";

								//do the insertion and update
								$insert_result = mysqli_query($db_connection, $query_insert);
								if(!$insert_result){
									echo ('Invalid query: ' . mysqli_error($db_connection));
									echo "<br>";
								} else {
									mysqli_query($db_connection, $updateMaxID);
									echo "<br>";
									echo "<strong>Insertion successful!</strong>";
									echo "<br>";
									echo "<strong>The id of the new record is : " . $id . ".</strong>";
									echo "<br>";
								}

								$genre = $_POST["genre"];
								for($i=0; $i < count($genre); $i++){
									$igenre = $genre[$i];
									$genre_query = "INSERT INTO MovieGenre VALUES ('$id', '$igenre')";
									$genre_result = mysqli_query($db_connection, $genre_query);
									if($genre_result){
										echo "<strong>Your No.$i genre ($igenre) classification has been inserted successfully.</strong>";
										echo "<br>";
									} else {
										echo ('Invalid query: ' . mysqli_error($db_connection));
									}
								}

								mysqli_free_result($insert_result);
								mysqli_close($db_connection);
					  	}
					  ?>

    		</div>
    	</div>
   </div>

	</body>
</html>