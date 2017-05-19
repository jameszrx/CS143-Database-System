-- Query 1: Names of all the actors in the movie 'Die Another Day'
SELECT CONCAT(Actor.first,' ',Actor.last)
FROM Actor, MovieActor, Movie
WHERE Movie.title = 'Die Another Day' AND MovieActor.mid = Movie.id AND MovieActor.aid = Actor.id;

-- Query 2: Count of all the actors who acted in multiple movies
SELECT COUNT(DISTINCT mat1.aid)
FROM MovieActor mat1, MovieActor mat2
WHERE mat1.mid<>mat2.mid AND mat1.aid = mat2.aid;

-- Query 3: Title of movies that sell more than 1,000,000 tickets
SELECT Movie.title
FROM Movie, Sales
WHERE Sales.mid = Movie.id AND Sales.ticketsSold > 1000000;

-- Query 4: Find the name of directors who has directed more that 1 moive that have imdb rating greater than 5
SELECT DISTINCT d.first, d.last, mr.imdb
FROM Director d, MovieDirector md1, MovieDirector md2, MovieRating mr
WHERE md1.did = md2.did AND md1.mid <> md2.mid AND md1.did = d.id AND mr.mid = md1.mid AND mr.imdb > 70;

-- Query 5: Find the Average total income of movies belonging to Drama category
SELECT AVG(s.totalIncome)
FROM Sales s, MovieGenre mg
WHERE mg.genre = 'Drama' AND s.mid = mg.mid;
