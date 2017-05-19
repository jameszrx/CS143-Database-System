<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CS143 Database Query System</title>
<link href="./css/add_page.css" rel="stylesheet">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> 
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 
<script>
$(document).ready(function () {
  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {          
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });  
});
</script>

<style>
#wrapper {
  -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  -webkit-transition: all 0.5s ease;
  padding-left: 0;
  -webkit-transition: all 0.5s ease;
  transition: all 0.5s ease;
}

#wrapper.toggled { padding-left: 350px; }

#wrapper.toggled #sidebar-wrapper { width: 350px; }

#wrapper.toggled #page-content-wrapper {
  margin-right: -350px;
  position: absolute;
}

#sidebar-wrapper {
  -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  -webkit-transition: all 0.5s ease;
  background: #1a1a1a;
  height: 100%;
  left: 350px;
  margin-left: -350px;
  overflow-x: hidden;
  overflow-y: auto;
  -webkit-transition: all 0.5s ease;
  transition: all 0.5s ease;
  width: 0;
  z-index: 1000;
}
#sidebar-wrapper::-webkit-scrollbar {
 display: none;
}

#page-content-wrapper {
  padding-top: 70px;
  width: 100%;
}

/*-------------------------------*/
/*     Sidebar nav styles        */
/*-------------------------------*/

.sidebar-nav {
  list-style: none;
  margin: 0;
  padding: 0;
  position: absolute;
  top: 0;
  width: 350px;
}

.sidebar-nav li {
  display: inline-block;
  line-height: 20px;
  position: relative;
  width: 100%;
}

.sidebar-nav li:before {
  -moz-transition: width 0.2s ease-in;
  -ms-transition: width 0.2s ease-in;
  -webkit-transition: width 0.2s ease-in;
  background-color: #1c1c1c;
  content: '';
  height: 100%;
  left: 0;
  position: absolute;
  top: 0;
  -webkit-transition: width 0.2s ease-in;
  transition: width 0.2s ease-in;
  width: 3px;
  z-index: -1;
}

.sidebar-nav li:first-child a {
  background-color: #1a1a1a;
  color: #ffffff;
}

.sidebar-nav li:nth-child(2):before { background-color: #52418a; }

.sidebar-nav li:nth-child(3):before { background-color: #5c499c; }

.sidebar-nav li:nth-child(4):before { background-color: #6651ad; }

.sidebar-nav li:nth-child(5):before { background-color: #7562b5; }

.sidebar-nav li:nth-child(6):before { background-color: #8473be; }

.sidebar-nav li:nth-child(7):before { background-color: #9485c6; }

.sidebar-nav li:nth-child(8):before { background-color: #a396ce; }

.sidebar-nav li:nth-child(9):before { background-color: #b2a7d6; }

.sidebar-nav li:hover:before {
  -webkit-transition: width 0.2s ease-in;
  transition: width 0.2s ease-in;
  width: 100%;
}

.sidebar-nav li a {
  color: #dddddd;
  display: block;
  padding: 10px 15px 10px 30px;
  text-decoration: none;
}

.sidebar-nav li.open:hover before {
  -webkit-transition: width 0.2s ease-in;
  transition: width 0.2s ease-in;
  width: 100%;
}

.sidebar-nav .dropdown-menu {
  background-color: #222222;
  border-radius: 0;
  border: none;
  box-shadow: none;
  margin: 0;
  padding: 0;
  position: relative;
  width: 100%;
}

.sidebar-nav li a:hover, .sidebar-nav li a:active, .sidebar-nav li a:focus, .sidebar-nav li.open a:hover, .sidebar-nav li.open a:active, .sidebar-nav li.open a:focus {
  background-color: transparent;
  color: #ffffff;
  text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
  font-size: 20px;
  height: 65px;
  line-height: 44px;
}

/*-------------------------------*/
/*       Hamburger-Cross         */
/*-------------------------------*/

.hamburger {
  background: transparent;
  border: none;
  display: block;
  height: 32px;
  margin-left: 15px;
  position: fixed;
  top: 20px;
  width: 32px;
  z-index: 999;
}

.hamburger:hover { outline: none; }

.hamburger:focus { outline: none; }

.hamburger:active { outline: none; }

.hamburger.is-closed:before {
  -webkit-transform: translate3d(0, 0, 0);
  -webkit-transition: all 0.35s ease-in-out;
  color: #000000;
  content: '';
  display: block;
  font-size: 14px;
  line-height: 32px;
  opacity: 0;
  text-align: center;
  width: 100px;
}

.hamburger.is-closed:hover before {
  -webkit-transform: translate3d(-100px, 0, 0);
  -webkit-transition: all 0.35s ease-in-out;
  display: block;
  opacity: 1;
}

.hamburger.is-closed:hover .hamb-top {
  -webkit-transition: all 0.35s ease-in-out;
  top: 0;
}

.hamburger.is-closed:hover .hamb-bottom {
  -webkit-transition: all 0.35s ease-in-out;
  bottom: 0;
}

.hamburger.is-closed .hamb-top {
  -webkit-transition: all 0.35s ease-in-out;
  background-color: rgba(0, 0, 0, 0.7);
  top: 5px;
}

.hamburger.is-closed .hamb-middle {
  background-color: rgba(0, 0, 0, 0.7);
  margin-top: -2px;
  top: 50%;
}

.hamburger.is-closed .hamb-bottom {
  -webkit-transition: all 0.35s ease-in-out;
  background-color: rgba(0, 0, 0, 0.7);
  bottom: 5px;
}

.hamburger.is-closed .hamb-top, .hamburger.is-closed .hamb-middle, .hamburger.is-closed .hamb-bottom, .hamburger.is-open .hamb-top, .hamburger.is-open .hamb-middle, .hamburger.is-open .hamb-bottom {
  height: 4px;
  left: 0;
  position: absolute;
  width: 100%;
}

.hamburger.is-open .hamb-top {
  -webkit-transform: rotate(45deg);
  -webkit-transition: -webkit-transform 0.2s cubic-bezier(0.73, 1, 0.28, 0.08);
  background-color: #000000;
  margin-top: -2px;
  top: 50%;
}

.hamburger.is-open .hamb-middle {
  background-color: #000000;
  display: none;
}

.hamburger.is-open .hamb-bottom {
  -webkit-transform: rotate(-45deg);
  -webkit-transition: -webkit-transform 0.2s cubic-bezier(0.73, 1, 0.28, 0.08);
  background-color: #000000;
  margin-top: -2px;
  top: 50%;
}

.hamburger.is-open:before {
  -webkit-transform: translate3d(0, 0, 0);
  -webkit-transition: all 0.35s ease-in-out;
  color: #000000;
  content: '';
  display: block;
  font-size: 14px;
  line-height: 32px;
  opacity: 0;
  text-align: center;
  width: 100px;
}

.hamburger.is-open:hover before {
  -webkit-transform: translate3d(-100px, 0, 0);
  -webkit-transition: all 0.35s ease-in-out;
  display: block;
  opacity: 1;
}

/*-------------------------------*/
/*          Dark Overlay         */
/*-------------------------------*/

.overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.4);
  z-index: 1;
}

</style>

</head>

<body>
<div id="wrapper">
  <div class="overlay"></div>
  
  <!-- Sidebar -->
  <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
    <ul class="nav sidebar-nav">
      <li class="sidebar-brand"> <a href="index.php"> CS143 DataBase Query System</a> </li>
      <li> <a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a> </li>
      <li> <a href="search.php"><i class="fa fa-fw fa-file-o"></i> Search page</a> </li>
      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Add New Content <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li class="dropdown-header"></li>
          <li><a href="add_person.php">Add Actor/Director</a></li>
          <li><a href="add_movieinfo.php">Add Movie Information</a></li>
          <li><a href="add_movie_actor_relation.php">Add Movie/Actor Relation</a></li>
          <li><a href="add_movie_director_relation.php">Add Movie/Director Relation</a></li>
        </ul>
      </li>
      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Browsering Content <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li class="dropdown-header"></li>
          <li><a href="Show_A.php">Show Actor Information</a></li>
          <li><a href="Show_M.php">Show Movie Information</a></li>
        </ul>
      </li>
      
    </ul>
  </nav>
  <!-- /#sidebar-wrapper --> 
  
  <!-- Page Content -->
  <div id="page-content-wrapper">
    <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas"> <span class="hamb-top"></span> <span class="hamb-middle"></span> <span class="hamb-bottom"></span> </button>

    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
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
								mysqli_select_db($db_connection, "CS143");

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
  </div>
  <!-- /#page-content-wrapper --> 
  
</div>
<!-- /#wrapper --> 
</body>
</html>
