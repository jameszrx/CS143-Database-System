<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		<title>New Comments</title>
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
    			<h2><strong>Add a comments to movie</strong></h2>
    			<br>
    			<form method="POST" action="<?php $_PHP_SELF?>">
	    			Movie Name:
	    			<select name="mov" class="form-control" required>
		    			<?php
		    				$mid = $_REQUEST["MovieID"];
		    				$mname_query = "SELECT title, year FROM Movie WHERE id = $mid";
		    				$mname_result = mysqli_query($db_connection, $mname_query);
		    				$data = mysqli_fetch_array($mname_result);
		    				echo "<option value=$mid selected>$data[0] ($data[1])</option>";
		    			?>
	    			</select>
	    			<br>

	    			Your name:
	    			<input name="username" type="text" placeholder="Anonymous" class="form-control"/>
	    			<br>

	    			Rating*:
	    			<select name="rating" class="form-control" required>
	    				<option value="1">1</option>
	    				<option value="2">2</option>
	    				<option value="3">3</option>
	    				<option value="4">4</option>
	    				<option value="5">5</option>
	    			</select>
	    			<br>

	    			Comments:
	    			<input type="textarea" rows="5" name="comment" class="form-control"/>
	    			<br>
	    			<input type="submit" value="submit" class="btn btn-primary"/>
	    			<br><br>
    			</form>
    		</div>

    		<?php
		    	if($_SERVER["REQUEST_METHOD"] == "POST"){
		    		$movID = $_POST["mov"];
		    		$rating = $_POST["rating"];
		    		$username = trim($_POST["username"]);
		    		if(empty($_POST["username"]) || $name == ""){
		    			$username = "Anonymous";
		    		} else {
		    			$username = "'$username'";
		    		}
		    		$time = date("Y-m-d H:i:s");
		    		$comment = trim($_POST["comment"]);
		    		if(empty($_POST["comment"]) || $comment == ""){
		    			$comment = "NULL";
		    		} else {
		    			$comment = "'$comment'";
		    		}

		    		$comment_query = "INSERT INTO Review VALUES('$username', '$time', '$movID', '$rating', $comment)";
		    		$insert_result = mysqli_query($db_connection, $comment_query);
		    		if($insert_result){
		    			echo "<div>You have successfully added a comment!</div><br>";
		    		} else {
		    			echo '<div>Invalid query: ' . mysqli_error($db_connection) . "</div>";
		    			echo "<br>";
		    		}
		    		echo "<a href= 'Show_M.php?identifier=$movID'>Click here to go back to the movie page</a>";
						mysqli_close($db_connection);
		    	}
		    ?>

    	</div>
    </div>

	</body>


</html>