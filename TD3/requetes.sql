-- PLUCHARD MAXIMILIEN


-- 1/ SELECTION SIMPLES
-- a/ Afficher toutes les personnes dans Cast.
SELECT * FROM Cast;

-- b/ Afficher toutes les personnes vivantes.
SELECT * FROM Cast
  WHERE deathYear IS NULL;
  
-- c/ Afficher toutes les personnes vivantes qui ont plus de 65 ans
SELECT * FROM Cast
WHERE deathYear IS NULL
AND birthYear + 65 < YEAR(NOW());
  
-- d/ Afficher la personne vivante la plus vielle de la BDD
SELECT * FROM Cast
WHERE birthYear = (
  SELECT MIN(birthYear)
  FROM Cast
  WHERE deathYear IS NULL
);

-- e/ Affiche toutes les personnes entre 30 et 50 ans. Triées selon l'age de maniere decroissante
SELECT * FROM Cast
WHERE birthYear BETWEEN YEAR(NOW())-50 AND YEAR(NOW())-30
ORDER BY birthYear DESC;

-- f/ Afficher les films ayant 'the' dans son titre ( sans prendre en compte la casse )
SELECT * FROM Movie
WHERE title LIKE "%the%";


-- 2 JOINTURES
-- a/ Afficher le titre et la date de sortie des films étatsuniens, trié du film le plus récent au plus ancien.
SELECT title, releaseDate FROM Movie
INNER JOIN Country ON Movie.idCountry = Country.code
WHERE name = "United States of America"
ORDER BY releaseDate DESC;

-- b/ Afficher le titre, la date de sortie et le nom du pays des films qui ont moins de 10 ans, trié du plus ancien au plus récent
SELECT title, releaseDate, name FROM Movie
INNER JOIN Country ON Movie.idCountry = Country.code
WHERE YEAR(releaseDate) > YEAR(NOW()) - 10
ORDER BY releaseDate DESC;

-- c/ Affiche le titre et le genre des films americains ou italiens de plus de 20 ans
SELECT title, Genre.name FROM Movie
INNER JOIN Country ON Movie.idCountry = Country.code
INNER JOIN MovieGenre ON MovieGenre.idMovie = Movie.id
INNER JOIN Genre ON MovieGenre.idGenre = Genre.id
WHERE Country.name = "United States of America"
OR Country.name = "Italy"
AND YEAR(releaseDate) < YEAR(NOW()) - 20;

