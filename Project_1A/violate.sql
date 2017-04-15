-- Constraint 1: Primary key of Movie
-- violate: A movie with id = 12 alrady exists
INSERT INTO Movie VALUES(12, 'Fury', 2014, 'PG', 'Unknown');

-- Constraint 2: Range of rating
-- violate: The rating value is not within the desired range
INSERT INTO Movie VALUES(4458, 'Doctor Not Strange', 2016, 'HEY', 'Daydream');

-- Constraint 3: Year must be a 4-digit integer
-- violate: Release year is not within 1000 ~ 9999
INSERT INTO Movie VALUES(1377, 'Another Day', 900, 'PG-13', 'Disney');

-- Constraint 4: Primary key of Actor
-- violate: Insert an actor who has the same id with another existed one
INSERT INTO Actor VALUES(19, 'Paul', 'Allen', 'Male', 1988-08-13, NULL);

-- Constraint 5: mid of Sales is a foreign key of Movie
-- violate: There's no id = 1233 in Movie
INSERT INTO Sales VALUES(1233, 4444, 5555);

-- Constraint 6: Primary key of Director
-- violate: Insert a director with a duplivate id
INSERT INTO Director VALUES(745, 'Harden', 'James', 1987-04-07, NULL);

-- Constraint 7: mid in MovieGenre is a foreign key of Movie
-- violate: There's no id = 1233 in Movie
INSERT INTO MovieGenre VALUES(1233, 'Drama');

-- Constraint 8: mid in MovieDirector is a foreign key of Movie
-- violate: There's no id = 1233 in Movie
INSERT INTO MovieDirector VALUES(1233, 7242);

-- Constraint 9: did in MovieDirector is a foreign key of Director
-- violate: There's no id = 7777 in Director
INSERT INTO MovieDirector VALUES(46, 7777);

-- Constraint 10: mid in MovieActor is a foreign key of Movie
-- violate: There's no id = 1233 in Movie
INSERT INTO MovieActor VALUES(1233, 109, 'Hunter');

-- Constraint 11: aid in MovieActor is a foreign key of Actor
-- violate: There's no id = 9464 in Actor
INSERT INTO MovieActor VALUES(395, 9464, 'Vampire');

-- Constraint 12: mid in MovieRating is a foreign key of Movie
-- violate: There's no id = 1233 in Movie
INSERT INTO MovieRating VALUES(1233, 5, 7);

-- Constraint 13: mid in Review is a foreign key of Movie
-- violate: There's no id = 1233 in Movie
INSERT INTO Review VALUES('Blah', '12-31-2014 00:00:00', 1233, 7, 'Nice one!');

-- Constraint 14: Value of Rating should be in the range of 0~10
-- violate: Insert a rating with value 15
INSERT INTO Review VALUES('BlahBlah', '12-31-2014 00:00:00', 2342, 15, 'Excellent!');