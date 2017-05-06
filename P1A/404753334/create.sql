-- Create Movie table
-- Set id as primary key
-- Check the rating and year
CREATE TABLE Movie(
	id INT NOT NULL,
	title VARCHAR(100) NOT NULL,
	year INT NOT NULL,
	rating VARCHAR(10),
	company VARCHAR(50),
	PRIMARY KEY(id),
	CHECK(rating IS NULL OR rating='G' OR rating='PG' OR rating='PG-13' OR rating='R' OR rating='NC-17'),
	CHECK(year>999 AND year<10000)
) ENGINE=InnoDB;

-- Create Actor table
-- Set id as primary key
CREATE TABLE Actor(
	id INT NOT NULL,
	last VARCHAR(20),
	first VARCHAR(20),
	sex VARCHAR(6),
	dob DATE NOT NULL,
	dod DATE,
	PRIMARY KEY(id)
) ENGINE=InnoDB;

-- Create Sales table
-- Set foreign key constraint with id in movie table
CREATE TABLE Sales(
	mid INT NOT NULL,
	ticketsSold INT,
	totalIncome INT,
	FOREIGN KEY (mid) references Movie(id)
) ENGINE=InnoDB;

-- Create Director table
-- Set id as primary key
CREATE TABLE Director(
	id INT NOT NULL,
	last VARCHAR(20),
	first VARCHAR(20),
	dob DATE,
	dod DATE,
	PRIMARY KEY(id)
) ENGINE=InnoDB;

-- Create MovieGenre table
-- Set foreign key constraint with id in movie table
CREATE TABLE MovieGenre(
	mid INT NOT NULL,
	genre VARCHAR(20) NOT NULL,
	FOREIGN KEY (mid) references Movie(id)
) ENGINE=InnoDB;

-- Create MovieDirector table
-- Set foreign key constraint with id in Movie table
-- Set foreign key constraint with id in Director table
CREATE TABLE MovieDirector(
	mid INT NOT NULL,
	did INT NOT NULL,
	FOREIGN KEY (mid) references Movie(id),
	FOREIGN KEY (did) references Director(id)
) ENGINE=InnoDB;

-- Create MovieActor table
-- Set foreign key constraint with id in Movie table
-- Set foreign key constraint with id in Actor table
CREATE TABLE MovieActor(
	mid INT NOT NULL,
	aid INT NOT NULL,
	role VARCHAR(50),
	FOREIGN KEY (mid) references Movie(id),
	FOREIGN KEY (aid) references Actor(id)
) ENGINE=InnoDB;

-- Create MovieRating table
-- Set foreign key constraint with id in movie table
CREATE TABLE MovieRating(
	mid INT NOT NULL,
	imdb INT,
	rot INT,
	FOREIGN KEY (mid) references Movie(id)
) ENGINE=InnoDB;

-- Create Review table
-- Set foreign key constraint with id in movie table
-- Check is rating of an movie is within 0 and 10
CREATE TABLE Review(
	name VARCHAR(20),
	time TIMESTAMP,
	mid INT NOT NULL,
	rating INT NOT NULL,
	comment VARCHAR(500),
	FOREIGN KEY (mid) references Movie(id),
	CHECK(rating>=0 AND rating<=10)
) ENGINE=InnoDB;

-- Create MaxPersonID table
CREATE TABLE MaxPersonID(
	id INT NOT NULL
) ENGINE=InnoDB;

-- Create MaxMovieID table
CREATE TABLE MaxMovieID(
	id INT NOT NULL
) ENGINE=InnoDB;
