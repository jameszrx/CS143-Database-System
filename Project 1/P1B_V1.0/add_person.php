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
				<h2><strong>Actor / Actress / Director Input Page</strong></h2>
				<!-- Input form -->
					<form action="<?php $_PHP_SELF?>" method="POST">
						<span class="req"><small><i>* required field</i></small></span><br><br>
							Title*:
							<input type="radio" name="title" value="actor"/> Actor
							<input type="radio" name="title" value="director"/> Director
						<br><br>

						Last Name*: <input type="text" class="form-control" name="lastName" placeholder="eg: Johnson" required/>
						<br>
						First Name*: <input type="text" class="form-control" name="firstName" placeholder="eg: Sarah" required/>
						<br>
						Gender*: <input type="radio" name="gender" value="female" required/> Female
										<input type="radio" name="gender" value="male"/> Male
						<br><br>
						Date of Birth*: <input class="form-control" type="date" name="dateofbirth" required/>
						<br>
						Date of Death: <input type="date" class="form-control" name="dateofdeath"/>
						<br>
						<input type="submit" value="submit" class="btn btn-primary"/>
					</form>

						<?php
							//Connect to the database
							if($_SERVER["REQUEST_METHOD"] == "POST"){

							$db_connection = mysqli_connect("localhost", "cs143", "");

							if (mysqli_connect_errno()){
				  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
				  		}

							//Select a database
							mysqli_select_db($db_connection, "TEST");

							//Extract query content from the request
							$title = trim($_POST['title']);
							$lastName = trim($_POST['lastName']);
							$firstName = trim($_POST['firstName']);
							$gender = trim($_POST['gender']);
							//$bdate = mysqli_real_escape_string($db_connection, $_POST['dateofbirth']);
							$bdate = $_POST['dateofbirth'];
							$bdate = date("Y-m-d", strtotime($bdate));

							if(!empty($_POST["dateofdeath"])){
								$ddate = $_POST['dateofdeath'];
								$ddate = date("Y-m-d", strtotime($ddate));
								//echo "$ddate\r\n";
							} else {
								$ddate = "NULL";
							}

							//find the id
							$idquery = mysqli_query($db_connection, "SELECT id FROM MaxPersonID") or die(mysql_error());
							$result = mysqli_fetch_array($idquery);
							$id = $result[0];
							$id = $id + 1;
							//Update the MaxPersonID
							$updateMaxId = "UPDATE MaxPersonID SET id = $id";

							//Generate the query
							if($title=="actor"){
								if($ddate <> "NULL"){
									$addquery = "INSERT INTO Actor VALUES ('$id', '$lastName', '$firstName', '$gender', '$bdate', '$ddate')";
								} else {
									$addquery = "INSERT INTO Actor VALUES ('$id', '$lastName', '$firstName', '$gender', '$bdate', NULL)";
								}
								echo "<br>";
								echo "<strong>An actor record with id $id will be created...</strong>";
							} elseif($title=="director"){
								if($ddate <> "NULL"){
									$addquery = "INSERT INTO Director VALUES ('$id', '$lastName', '$firstName', '$bdate', '$ddate')";
								} else {
									$addquery = "INSERT INTO Director VALUES ('$id', '$lastName', '$firstName', '$bdate', NULL)";
								}
								echo "<br>";
								echo "<strong>A director record with id $id will be created...</strong>";
							}
							//Execute the query
							$rs = mysqli_query($db_connection, $addquery);

							if(!$rs){
								echo ('Invalid query: ' . mysqli_error($db_connection));
								echo "<br><br>";
							} else{
								mysqli_query($db_connection, $updateMaxId);
								echo "<br><br>";
								echo "<strong>Insertion successful!</strong>";
								echo "<br><br>";
							}
							mysqli_free_result($rs);
							mysqli_close($db_connection);
						}			
					?>

				</div>
			</div>
		</div>
		
	 

	

	</body>

</html>

