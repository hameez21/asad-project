<?php
if(!isset($_SESSION["starter"]))
{
    session_start();
    $_SESSION["starter"] = true;
}

$serverName = "localhost:3306";
$userName = "root";

if(!isset($_SESSION["reqGen"]))
{
if(isset($_GET["pg"]))
{
try
{
        $connect = new PDO("mysql:host=$serverName;dbname=DBMSP",$userName);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Get Movie Info
        $sqlQuery = $connect->prepare("SELECT id,name,cover,thumbnail,synopsis,releaseDate,rating FROM movie ORDER BY releaseDate DESC LIMIT 20 OFFSET :reqpg;");
        $sqlQuery->bindParam(':reqpg',$_GET["pg"], PDO::PARAM_INT);
        $sqlQuery->execute();

        $movies = array();
        while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC))
        {
            $sqlQueryGenre = $connect->prepare("SELECT genreName FROM genre INNER JOIN moviegenre ON moviegenre.genreID=genre.id AND moviegenre.movieID=:currentID ");
            $sqlQueryGenre->bindParam(':currentID',$row["id"]);

            $sqlQueryGenre->execute();

            $genres = "";
            while($genreRow = $sqlQueryGenre->fetch(PDO::FETCH_ASSOC))
            {
                $genres.=$genreRow["genreName"];
                $genres.=", ";
            }
            if(strlen($genres))
            $genres[strlen($genres) - 2] = ".";
            $oneMovie = array();
            array_push($oneMovie,$row,$genres);
            array_push($movies,$oneMovie);
        }

        $moviesJSON = json_encode($movies);

        echo $moviesJSON;
}
        
catch(PDOException $e)
{
        echo $e->getMessage();
}
}
}

else
{
if(isset($_GET["pg"]))
{
try
{
        $connect = new PDO("mysql:host=$serverName;dbname=DBMSP",$userName);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Get Movie Info Genre Wise
        $sqlQuery = $connect->prepare("SELECT DISTINCT movie.id,name,cover,thumbnail,synopsis,releaseDate,rating FROM movie INNER JOIN moviegenre ON moviegenre.movieid=movie.id INNER JOIN genre ON moviegenre.genreID = (SELECT DISTINCT genre.id FROM genre WHERE genre.genreName LIKE :reqGenre) ORDER BY releaseDate DESC LIMIT 20 OFFSET :reqpg;");
        $sqlQuery->bindParam(':reqGenre',$_SESSION["reqGen"]);
        $sqlQuery->bindParam(':reqpg',$_GET["pg"], PDO::PARAM_INT);
        $sqlQuery->execute();

        $movies = array();
        while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC))
        {
            $sqlQueryGenre = $connect->prepare("SELECT genreName FROM genre INNER JOIN moviegenre ON moviegenre.genreID=genre.id AND moviegenre.movieID=:currentID ");
            $sqlQueryGenre->bindParam(':currentID',$row["id"]);

            $sqlQueryGenre->execute();

            $genres = "";
            while($genreRow = $sqlQueryGenre->fetch(PDO::FETCH_ASSOC))
            {
                $genres.=$genreRow["genreName"];
                $genres.=", ";
            }
            if(strlen($genres))
            $genres[strlen($genres) - 2] = ".";
            $oneMovie = array();
            array_push($oneMovie,$row,$genres);
            array_push($movies,$oneMovie);
        }

        $moviesJSON = json_encode($movies);

        echo $moviesJSON;
}
        
catch(PDOException $e)
{
        echo $e->getMessage();
}
}
}

$connect = null;

?>