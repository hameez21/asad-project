<?php
$searchQuery=$_REQUEST['q'];
if(!isset($_REQUEST['searchBy']))
    $_REQUEST['searchBy']="unset";
$searchBy=$_REQUEST['searchBy'];

try{
        
    $pdo = new PDO("mysql:host=localhost;dbname=dbmsp", "root", "");
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($searchQuery!==""){
    $searchQuery="%".$searchQuery."%";
    if($searchBy=="unset"){
    $sqlQuery=$pdo->prepare("select movie.id as movID , name , group_concat(distinct genreName) as genreName , isTvSeries from movie inner join moviegenre inner join genre where movie.id=moviegenre.movieid and moviegenre.genreid=genre.id and movie.name LIKE :search group by movie.id");
    $sqlQuery->bindParam(":search",$searchQuery);
    $sqlQuery->execute();
}   
    else{
        if($searchBy=="Movie"){
            $sqlQuery=$pdo->prepare("select movie.id as movID , name , group_concat(distinct genreName) as genreName , isTvSeries from movie inner join moviegenre inner join genre where movie.id=moviegenre.movieid and moviegenre.genreid=genre.id and isTvSeries=0 and movie.name LIKE :search group by movie.id");
            $sqlQuery->bindParam(":search",$searchQuery);
            $sqlQuery->execute();
        }
        if($searchBy=="Tv Series"){
            $sqlQuery=$pdo->prepare("select movie.id as movID , name , group_concat(distinct genreName) as genreName , isTvSeries from movie inner join moviegenre inner join genre where movie.id=moviegenre.movieid and moviegenre.genreid=genre.id and isTvSeries=1 and movie.name LIKE :search group by movie.id");
            $sqlQuery->bindParam(":search",$searchQuery);
            $sqlQuery->execute();
        }
        if($searchBy=="Actor"){
        $sqlQuery=$pdo->prepare("select movie.id as movID , movie.name , group_concat(distinct genreName) as genreName , isTvSeries from movie inner join moviegenre inner join genre inner join actor inner join actormovie where movie.id=moviegenre.movieid and moviegenre.genreid=genre.id and movie.id=actormovie.movieID and actormovie.actorID=actor.id and actor.name like :search group by movie.id");
        $sqlQuery->bindParam(":search",$searchQuery);
        $sqlQuery->execute();    
    } 
    if($searchBy=="Director"){
        $sqlQuery=$pdo->prepare("select movie.id as movID , movie.name , group_concat(distinct genreName) as genreName , isTvSeries from movie inner join moviegenre inner join genre inner join director inner join directormovie where movie.id=moviegenre.movieid and moviegenre.genreid=genre.id and movie.id=directormovie.movieID and directormovie.directorID=director.id and director.name like :search group by movie.id");
        $sqlQuery->bindParam(":search",$searchQuery);
        $sqlQuery->execute();    
    }
    if($searchBy=="Producer"){
        $sqlQuery=$pdo->prepare("select movie.id as movID , movie.name , group_concat(distinct genreName) as genreName , isTvSeries from movie inner join moviegenre inner join genre inner join producer inner join producermovie where movie.id=moviegenre.movieid and moviegenre.genreid=genre.id and movie.id=producermovie.movieID and producermovie.producerID=producer.id and producer.name like :search group by movie.id");
        $sqlQuery->bindParam(":search",$searchQuery);
        $sqlQuery->execute();    
    } 
    }
    $results="";
    while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC))
    {   
        if($row['isTvSeries']==0)
        $results=$results."<li><div class='resultDiv'><img class='resultImage'><a class='resultLinks' href=movie.php?blast=".$row['movID'].">".$row['name']."<br/>".$row['genreName']."</a></div></li>";  
        else
        $results=$results."<li><div class='resultDiv'><img class='resultImage'><a class='resultLinks' href=movie.php?blast=".$row['movID'].">".$row['name']."<br/>".$row['genreName']."<br/>Tv Series</a></div></li>";  }}
        
        echo $results === "" ? "<a style='color:white;font-size:1.3em;text-decoration:none'>No Result Found</a>" : $results;
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}




?>