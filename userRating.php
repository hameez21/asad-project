<?php
session_start();

$serverName = "localhost:3306";
$userName = "root";
if(isset($_GET["userRateNumber"]))
{
        try
        {
                $connect = new PDO("mysql:host=$serverName;dbname=DBMSP",$userName);
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //--------------FOR FUTURE USE------------------//
                $sqlQuery = $connect->prepare("SELECT rating FROM userRating WHERE userRating.userID=:userID AND userRating.movieID=:requestedMovie;");
                $sqlQuery->bindParam(':userID',$_SESSION["userID"]);
                $sqlQuery->bindParam(":requestedMovie",$_SESSION["movieID"]);
                $sqlQuery->execute();
                $row = $sqlQuery->fetch();
                $previousUserRating = $row["rating"];

                $sqlQuery = $connect->prepare("SELECT rating FROM movie WHERE id=:requestedMovie;");
                $sqlQuery->bindParam(":requestedMovie",$_SESSION["movieID"]);
                $sqlQuery->execute();
                $row = $sqlQuery->fetch();
                $movieRating = $row["rating"];

                $sqlQuery = $connect->prepare("SELECT COUNT(*) userCount, SUM(rating) totalMovieRating FROM userrating WHERE movieid=:requestedMovie;");
                $sqlQuery->bindParam(":requestedMovie",$_SESSION["movieID"]);
                $sqlQuery->execute();
                $row = $sqlQuery->fetch();
                $userCount = $row["userCount"];
                $totalMovieRating = $row["totalMovieRating"];

                if($totalMovieRating == NULL)           //Incase no user has rated the movie yet (DB returns NULL)
                $totalMovieRating = 0;

                //-------------MAIN TASK----------------------//
                //Update If Already Rated
                
                if($previousUserRating!=null)   
                $sqlQuery = $connect->prepare("UPDATE userRating SET rating=:userRating WHERE userRating.userID=:userID AND userRating.movieID=:requestedMovie; ");
                //Insert If Rated First Time
                else                    
                $sqlQuery = $connect->prepare("INSERT INTO userRating(userID,movieID,rating) VALUES(:userID,:requestedMovie,:userRating);");
                
                //General Variables Necessary To Be Binded In Either Condition
                $sqlQuery->bindParam(':userID',$_SESSION["userID"]);
                $sqlQuery->bindParam(':userRating',$_GET["userRateNumber"]);
                $sqlQuery->bindParam(":requestedMovie",$_SESSION["movieID"]);

                $sqlQuery->execute();

                //Prepare For Adding User's Rating Effect to the actual Movie Rating

                if($previousUserRating != $_GET["userRateNumber"])              //If user gives the same rating again
                {
                if($previousUserRating!=null)
                {
                        $totalMovieRating -= $previousUserRating;               //Remove old effect
                        $totalMovieRating += $_GET["userRateNumber"];           //Add new one
                        $totalMovieRating /= $userCount;                        //Recalculate Average  
                }

                else
                {
                        $totalMovieRating += $_GET["userRateNumber"];
                        $totalMovieRating /= ($userCount+1);
                }

                $movieRating += $totalMovieRating;
                $movieRating /= 2;
                }
                
                //Update the actual Movie Rating
                $sqlQuery = $connect->prepare("UPDATE movie SET rating=:newMovieRating WHERE id=:requestedMovie;");
                $sqlQuery->bindParam(":newMovieRating",$movieRating);
                $sqlQuery->bindParam(":requestedMovie",$_SESSION["movieID"]);

                $sqlQuery->execute();
        }

        catch(PDOException $e)
        {
                echo $e->getMessage();
        } 
        $connect = null;
} 

?>