<?php
session_start();

$serverName = "localhost:3306";
$userName = "root";
if(isset($_GET["userComment"]))
{
        try
        {
            $connect = new PDO("mysql:host=$serverName;dbname=DBMSP",$userName);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if(isset($_GET["guestName"]))               //Guest Is Commenting
            {
            $sqlQuery = $connect->prepare("INSERT INTO guest(name) VALUES(:guestName);
            INSERT INTO userComment(guestID,movieID,comment) VALUES((SELECT id FROM guest ORDER BY id DESC LIMIT 1),:requestedMovie,:userComment);");
            $sqlQuery->bindParam(":guestName",$_GET["guestName"]);
                
            }
            else                                        //User Comments
            {
            $sqlQuery = $connect->prepare("INSERT INTO userComment(guestID,movieID,comment) VALUES(:guestID,:requestedMovie,:userComment);");
            $sqlQuery->bindParam(":guestID",$_SESSION["userID"]);
            }

            //General Variables Necessary To Be Binded In Either Condition
            $sqlQuery->bindParam(":userComment",$_GET["userComment"]);
            $sqlQuery->bindParam(":requestedMovie",$_SESSION["movieID"]);

            //Send The Last Inserted comment to JS for frontend
            if($sqlQuery->execute())                                
            {
                $sqlQuery = $connect->prepare("SELECT comment,guest.name FROM userComment,guest WHERE movieid=:requestedMovie AND guest.id=userComment.guestid ORDER BY userComment.id DESC LIMIT 1; ");
                $sqlQuery->bindParam(":requestedMovie",$_SESSION["movieID"]);
                $sqlQuery->execute();
        
                $comments = array();
                while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC))
                {
                $comment = array();
                array_push($comment,$row["name"]);
                array_push($comment,$row["comment"]);
                array_push($comments,$comment);
                }
        
                $commentsJSON = json_encode($comments);

                echo $commentsJSON;
            }
            else
            echo '0';
        }
                
        catch(PDOException $e)
        {
                echo $e->getMessage();
        } 
        $connect = null;
}

?>