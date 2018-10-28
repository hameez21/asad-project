<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/genre/movie/list?api_key=0d304b1ba6e0966ca6e984bbbad2f636&language=en-US",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);
$array=(array) json_decode($response);
$result=(array) $array['genreS'];

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    echo json_encode($result[0]);
   /* try{
        
        $pdo = new PDO("mysql:host=localhost;dbname=dbmsp", "root", "");
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $i=0;
        while(0){
          
            whi
        $sqlQuery=$pdo->prepare("INSERT INTO movie (id,name,cover,thumbnail,synopsis,parentsGuide,releaseDate,rating,popularity,isTvSeries) values (:movid,:movTitle,:movBackdrop,:movPoster,:movOverview,:movAdult,:movRelease,:movVote,:movPopularity,0)");
        $sqlQuery->bindParam(":movid",$movie['id']);
        $sqlQuery->bindParam(":movTitle",$movie['title']);
        $sqlQuery->bindParam(":movBackdrop",$movie['backdrop_path']);
        $sqlQuery->bindParam(":movPoster",$movie['poster_path']);
        $sqlQuery->bindParam(":movOverview",$movie['overview']);
        $sqlQuery->bindParam(":movAdult",$movie['adult']);
        $sqlQuery->bindParam(":movRelease",$movie['release_date']);
        $sqlQuery->bindParam(":movVote",$movie['vote_average']);
        $sqlQuery->bindParam(":movPopularity",$movie['popularity']);
        echo json_encode($movie['title'])."<br/>";
        $sqlQuery->execute();
        $i=$i+1;
    }
    }
    catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }  */
}