<?php

session_start();

$serverName = "localhost:3306";
$userName = "root";
if(isset($_GET["seasonNumber"]))
{
        try
        {
                $connect = new PDO("mysql:host=$serverName;dbname=DBMSP",$userName);
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sqlQuery = $connect->prepare("SELECT DISTINCT name,thumbnail,length FROM episode INNER JOIN tvseries ON episode.seriesID = :requestedMovie AND seasonNumber=:seasonNumber");

                $sqlQuery->bindParam(':requestedMovie',$_SESSION["movieID"]);
                $sqlQuery->bindParam(':seasonNumber',$_GET["seasonNumber"]);

                if($sqlQuery->execute())
                {
                    $episodes = array();
                    while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC))
                    {
                    $episode = array();
                    array_push($episode,$row["name"]);
                    array_push($episode,$row["thumbnail"]);
                    array_push($episode,$row["length"]);

                    array_push($episodes,$episode);
                    }

                    $episodesJSON = json_encode($episodes);
                    echo $episodesJSON;
                }
        }
                
        catch(PDOException $e)
        {
                echo $e->getMessage();
        } 
        $connect = null;
}

?>