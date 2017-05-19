<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Director-Movie Relation</title>
		<link href="./css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/add_page.css" rel="stylesheet">
	</head>

	<body>

		<!-- Database Connection -->
		<?php
			$db_connection = mysqli_connect("localhost", "cs143", "");
			if (mysqli_connect_errno()){
		  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
			mysqli_select_db($db_connection, "TEST");
		?>

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
    			<h2><strong>Movie Director Relation</strong></h2>
    			<!-- Input form -->
					<div>
						<form action="<?php $_PHP_SELF?>" method="POST">
						<span class="req"><small><i>* required field</i></small></span><br><br>
						Movie title*: 
						<select name="mtitle" class="form-control" required>
							<option value="" disabled selected>Please Input Movie Title</option>
							<?php
								$all_movie_query = "SELECT id, title, year FROM Movie ORDER BY title";
								$all_movie_result = mysqli_query($db_connection, $all_movie_query);

								if($all_movie_result){
									while($row = mysqli_fetch_row($all_movie_result)){
										echo "<option value=$row[0]>$row[1], ($row[2])</option>";
									}
								}
							?>
						</select>
						<br>

						Director name*: 
						<select name="dirname" class="form-control" required>
							<option value="" disabled selected>Please Input Director Name</option>
							<?php
								$all_direct_query = "SELECT id, last, first FROM Director ORDER BY first";
								$all_direct_result = mysqli_query($db_connection, $all_direct_query);

								if($all_direct_result){
									while($dirRow = mysqli_fetch_row($all_direct_result)){
										echo "<option value=$dirRow[0]>$dirRow[2] $dirRow[1]</option>";
									}
								}
							?>
						</select>
						<br>

						<input type="submit" value="submit" class="btn btn-primary"/>
						<br><br>
						</form>

						<!-- Form Date Processing -->
						<?php
							if($_SERVER["REQUEST_METHOD"] == "POST"){
								$mid = $_POST["mtitle"];
								echo "<strong>The movie id you chose is: $mid </strong><br><br>";
								$did = $_POST["dirname"];
								echo "<strong>The director id you chose is: $did </strong><br><br>";

								$insert_query = "INSERT INTO MovieDirector VALUES ($mid, $did)";
								$insert_result = mysqli_query($db_connection, $insert_query);

								if($insert_result){
									echo "<strong>A director-movie relation has been successfully inserted!</strong>";
								} else {
									echo 'Invalid query: ' . mysqli_error($db_connection);
								}
								mysqli_close($db_connection);
							}
						?>

					</div>
    		</div>
    	</div>
    </div>

		

		

	</body>

</html>