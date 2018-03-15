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

-- d/ Afficher tous les noms et prénoms acteurs/actrices (sans doublon), triés par nom puis prénom.
SELECT DISTINCT firstname, lastname FROM Actor
INNER JOIN Cast ON Cast.id = Actor.idActor
ORDER BY lastname ASC, firstname ASC

-- e/ Afficher le titre et le genre des films francais joués par Elodie Deshayes avec son rôle dans ces films
SELECT title, Genre.name, Actor.name FROM Cast
INNER JOIN Actor ON Cast.id = Actor.idActor
INNER JOIN Movie ON Movie.id = Actor.idMovie
INNER JOIN MovieGenre ON Movie.id = MovieGenre.idMovie
INNER JOIN Genre ON Genre.id = MovieGenre.idGenre
WHERE Cast.firstname = "Élodie"
AND Cast.lastname = "Deshayes"

-- f/ Afficher les noms et prénoms ainsi que le rôle des acteurs/actrices des films réalisés par Myriam Anik, trié selon leur rôle.
SELECT firstname, lastname, Actor.name, Movie.title FROM Cast
INNER JOIN Actor ON Cast.id = Actor.idActor
INNER JOIN Movie ON Movie.id = Actor.idMovie
WHERE Movie.id = (
  SELECT Movie.id FROM Cast 
  INNER JOIN Director ON Cast.id = Director.idDirector
  INNER JOIN Movie ON Movie.id = Director.idMovie
  WHERE lastname = "Anik"
  AND firstname = "Myriam"
)
ORDER BY Actor.name


-- 2 REQUETES COMPLEXES
-- a/ Afficher le genre et le nombre de films pour chaque genre
SELECT Genre.name, COUNT(Movie.id) AS Nombre FROM Movie
INNER JOIN MovieGenre ON Movie.id = MovieGenre.idMovie
INNER JOIN Genre ON Genre.id = MovieGenre.idGenre
GROUP BY Genre.name

-- b/ Afficher le nombre de films ayant "Voix Off" dans la liste des acteurs
SELECT COUNT(Movie.id) AS Nombre FROM Cast
INNER JOIN Actor ON Cast.id = Actor.idActor
INNER JOIN Movie ON Movie.id = Actor.idMovie
WHERE Actor.name = "Voix Off"

-- c/ Afficher les noms et prenoms des acteurs qui ont joué en tant que "Développeur" ou "Développeuse"
SELECT firstname, lastname FROM Cast
INNER JOIN Actor ON Cast.id = Actor.idActor
INNER JOIN Movie ON Movie.id = Actor.idMovie
WHERE Actor.name = "Développeur"
OR Actor.name = "Développeuse"

-- d/ Afficher le nom du film réalisé par plus d'une personne
SELECT title FROM Director
INNER JOIN Movie ON Movie.id = Director.idMovie
GROUP BY idDirector
HAVING COUNT(idDirector) > 1

-- e/ Afficher le titre, le genre, le pays, la date de sortie et le nom-prénom du/des réalisateurs selon les filtres suivants (vous mettez les valeurs des critères de la manière que vous souhaitez) :

-- le titre doit avoir telle chaîne de caractères,
-- le genre doit être parmi plusieurs genres qui ont été renseignés,
-- le pays doit être parmi plusieurs pays qui ont été renseignés,
-- la date doit être entre une fourchette de dates,
-- une chaîne de caractères doit se retrouver dans le prénom + nom du réalisateur/réalisatrice (essayez de concaténer avec CONCAT ou || , cf la documentation SQL ou le support)

SELECT title,
Genre.name AS Genre,
Country.name AS Country,
releaseDate, firstname, lastname
FROM Movie
INNER JOIN MovieGenre ON Movie.id = MovieGenre.idMovie
INNER JOIN Genre ON Genre.id = MovieGenre.idGenre
INNER JOIN Country ON Movie.idCountry = Country.code
INNER JOIN Director ON Movie.id = Director.idMovie
INNER JOIN Cast ON Cast.id = Director.idDirector
WHERE title LIKE "%The%"
AND Genre.name IN ("Crime", "Drama", "Thriller", "Fantasy")
AND Country.name IN ("United States of America")
AND YEAR(releaseDate) BETWEEN YEAR(NOW()) - 20 AND YEAR(NOW()) - 5
AND CONCAT(firstname, ' ', lastname) LIKE "%ter Jack%"