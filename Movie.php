<?php

session_start();

$canRate = 0;
if(isset($_SESSION['username'],$_SESSION['userEmail']))
{
    $canRate = 1;               //The Only thing that depends upon wether user is Logged in or not
}

 if(!isset($_GET['LFail'])){
     $_GET['LFail']=0;
 }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MCDB</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="navBar.css">
    <link rel="stylesheet" type="text/css" href="LoginCSS.css">
    <link rel="stylesheet" href="MovieCSS.css">
    <link rel="stylesheet" type="text/css" href="LoginDiv.css">
    <link rel="stylesheet" type="text/css" href="AccountHandlerCSS.css">
    <script src="MovieGenreJS.js"></script>
    <script src="LoginJS.js"></script>
    <script src="MovieJS.js"></script>
    <script src="navBar.js"></script>
    <script src="AccountHandler.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Wendy One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Arapey' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
        <div id="backgroundImg"></div>
        
        <div id="content">
        <div class="topFlex">
        <header>
                <div class="navBar" style="background-color: #303030">
                        <a href="#top" class="hamButton" onclick="openMenu()">☰</a>
                        <a class="pageTitle" href="index.php" id="logo">MCDB</a>
                        <a class="navItems" href="toppop.php?type=top&media=movies">Top Movies</a>
                        <a class="navItems" href="toppop.php?type=pop&media=movies">Popular Movies</a>
                        <a class="navItems" href="toppop.php?type=top&media=tv">Top TV Shows</a>
                        <a class="navItems" href="toppop.php?type=pop&media=tv">Popular TV Shows</a>
                        <a class="navItems" href="moviegenre.php">Genrefy</a>
                        <a class="searchClose" onclick="closeSearch()">&times;</a>
                        <img src="search-3-xxl.png" alt="Search" class="searchButton" width="24px" height="24px" onclick="openSearch()" >
                        <a class="login" onclick="openLogin('<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>')">Login</a>
                        <a id="user"> 
                        <a class="login" href="LogOut.php?signOut=true&page=<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" id="signOut"> Sign Out </a>
                        <a class="login" onclick="showSignOut()"><?php if(isset($_SESSION['username'],$_SESSION['userEmail'])) echo $_SESSION['username']; ?></a> 
                        </a>
                        <input type="text" name="search" id="search" placeholder="Search Movies..." oninput="searchMovie(this.value)">  
                        <div class="searchResult" style="width:100%;">
                        <ul id="searchList" >
                        </ul>
                        <a  style="font-size:1em; margin-left:2%" href="advsearch.php">ADVANCED SEARCH</a>
                        </div> 
                 </div> 
        </header>
        <div class="sideNav">
        <a href="#" id="clsBtn"  class="hamMenuItems" onclick="closeMenu()">&times;</a>
        <a class="hamMenuItems" href='toppop.php?type=top&media=movies'>Top Movie</a>
        <a class="hamMenuItems" href='toppop.php?type=pop&media=movies'>Popular Movies</a>
        <a class="hamMenuItems" href='toppop.php?type=top&media=tv'>Top TV Shows</a>
        <a class="hamMenuItems" href='toppop.php?type=pop&media=tv'>Popular TV Shows</a>
        <a class="hamMenuItems" id="dropDown" onclick="dropDown()">Generefy</a>
        <div class="dropdownContainer">
            <a class="dropdownItem" href="moviegenre.php?requestedGenre=Action">- Action</a>
            <a class="dropdownItem" href="moviegenre.php?requestedGenre=Adventure">- Adventure</a>
            <a class="dropdownItem" href="moviegenre.php?requestedGenre=Drama">- Drama</a>
            <a class="dropdownItem" href="moviegenre.php?requestedGenre=Comedy">- Comedy</a>
            <a class="dropdownItem" href="moviegenre.php?requestedGenre=Horror">- Horror</a>
            <a class="dropdownItem" href="moviegenre.php?requestedGenre=Family">- Family</a>
            <a class="dropdownItem" href="moviegenre.php?requestedGenre=Thriller">- Thriller</a>
            <a class="dropdownItem" href="moviegenre.php?requestedGenre=Crime">- Crime</a>
            <a class="dropdownItem" href="moviegenre.php?requestedGenre=Mystery">- Mystery</a>
            <a class="dropdownItem" href="moviegenre.php?requestedGenre=Documentary">- Documentary</a>
            <a class="dropdownItem" href="moviegenre.php?requestedGenre=Science Fiction">- Science Fiction</a>
        </div>
    </div>
        <div id="thumbnail">
                <img src="images/dpthumb.jpg" alt="Image Not Available" id="thumbImg">
        </div>
        <div id="generalInfo">
                <h1 id="movieName"></h1><br>
                <div id="movieRating">
                        <div id="starPic">
                                <p id="rating">  </p>
                        </div>
                </div>
                
                <p id="movieActors">
                        Actors: <span>Value</span>
                </p>
                <p id="movieDirectors">
                        Directors: <span>Value</span>
                </p>
                <p id="movieProducers">
                        Producers: <span>Value</span>
                </p>

                <p id="userRating">
                        <span id="s0" class="rateStar">&#x2606;</span><span id="s1" class="rateStar">&#x2606;</span><span id="s2" class="rateStar">&#x2606;</span><span id="s3" class="rateStar">&#x2606;</span><span id="s4" class="rateStar">&#x2606;</span><span id="s5" class="rateStar">&#x2606;</span><span id="s6" class="rateStar">&#x2606;</span><span id="s7" class="rateStar">&#x2606;</span><span id="s8" class="rateStar">&#x2606;</span><span id="s9" class="rateStar">&#x2606;</span>
                </p>
                <a onclick="openLogin()" id="loginToRate">
                Login To Rate
                </a>
        </div>
        <div id="movieInfo">
                <h1 id="movieInfoH1">Movie Info</h1>
                <p id="releaseDate">Release Date: <span>Value</span></p>
                <p id="movieLength">Length: <span>Value</span></p>
                <p id="movieGenres">Genres: <span>Value</span></p>
                <p id="movieInfoRating">Rating: <span>Value</span></p><br>
                <a href="#trailers">Trailers</a><br>
                <a href="#PGs">Similar Movies</a><br>
                <a href="#comments">Comments</a><br>
                <a href="#episodeGuide" id="epGLink">Episode Guide</a>
        </div>
        <div id="synopsis">
                <h1>Synopsis</h1><br>
                <p>         
                </p>
        </div>
        <div id="trailers">
                <h1>Trailers</h1>
        </div>
        <a id="episodeGuideBtn">
                <h1>Episode Guide</h1>
        </a>
        <div id="episodeGuide">
                <h1>Seasons </h1>
                <div class="seasonLinks"></div>
                <div id="episodes">
                </div>
        </div>
        <div id="parentsGComm">
                <div id="PGs">
                        <h1>Similar Movies</h1>
                        <div class="similarFlex">
                        </div>
                </div>
                <div id="comments">
                        <h1>Comments</h1>
                        <p class="commentStatus"></p>
                        <div id="usersComment">
                                <textarea name="inputComment" placeholder="Share Your Views..."></textarea>
                                <input type="button" name="commentBtn" id="commentBtn" value="Submit" onclick="addUserComment()">
                        </div>
                        <hr style="border-color: black">
                        <br>
                        <div id="allComments">
                        </div>
                </div>
        </div>
    </div>
    <footer>
        <p> <script> var date = new Date(); document.getElementsByTagName('footer')[0].getElementsByTagName('p')[0].innerHTML = "Movie Chronicle Database Copyright &copy; "+ date.getFullYear();  </script></p>
</footer>
</div>
<div class="loginPage" onclick="bodyDark()" style="display:none">
        <div id="blur"></div>
        <div id="loginForm">
        <a class="closeLoginBtn" onclick="closeLogin()">&times;</a>
        <h1 id="label1">LOGIN</h1>    
        <form action="<?php echo 'loginT.php?return='.htmlspecialchars($_SERVER['PHP_SELF']).'?'.htmlspecialchars($_SERVER['QUERY_STRING']);?>" method="POST">
                    <?php if($_GET['LFail']==1){
                    echo '<script> displayErrorMessage("Invalid email or password"); </script>'; }
                    ?>
                    <label for="Name" class="formElem">
                    <h1 id="label">Email</h1>
                    </label><br>
                    <input type="email" autofocus placeholder="Enter Email..." name="email" class="formElem formInput" required><br>
                    <label for="Password" class="formElem">
                    <h1 id="label">Password</h1>
                    </label><br>
                    <input type="password" placeholder=" Enter Password..." name="password" class="formElem formInput" required><br>
                    <input type="submit" id="submitBtn" value="Login"><br>
                    
                    
            </form>
        </div>
        <a id="signUp" href="SignUp.php">Signup To MCDB ?</a>
    </div>
</body>
</html>

<?php

$serverName = "localhost:3306";
$userName = "root";

if(isset($_GET["blast"]))
try
{
        $connect = new PDO("mysql:host=$serverName;dbname=dbmsp",$userName);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Get Movie Info
        $sqlQuery = $connect->prepare("SELECT * FROM movie WHERE ID=:requestedMovie;");
        $sqlQuery->bindParam(":requestedMovie",$_GET["blast"]);

        $sqlQuery->execute();
        $movieObject = $sqlQuery->fetch();
        $movieJSON = json_encode($movieObject);
        $_SESSION['movieID'] = $_GET["blast"];

        //Get Actors Info
        $sqlQuery = $connect->prepare("SELECT DISTINCT name FROM actor INNER JOIN actormovie ON actormovie.actorid = actor.id AND actormovie.movieid=:requestedMovie ");
        $sqlQuery->bindParam(":requestedMovie",$_GET["blast"]);
        $sqlQuery->execute();
        
        $actors = "";
        while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC))
        {
        $actors.=$row["name"];
        $actors.=", ";
        }
        if(strlen($actors))
        $actors[strlen($actors) - 2] = '.';
        $actors = str_replace("'","\'",$actors);

        //Get Producers Info
        $sqlQuery = $connect->prepare("SELECT DISTINCT name FROM producer INNER JOIN producermovie ON producermovie.producerid = producer.id AND producermovie.movieid=:requestedMovie ");
        $sqlQuery->bindParam(":requestedMovie",$_GET["blast"]);
        $sqlQuery->execute();
        
        $producers = "";
        while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC))
        {
        $producers.=$row["name"];
        $producers.=", ";
        }
        if(strlen($producers))
        $producers[strlen($producers) - 2] = '.';
        $producers = str_replace("'","\'",$producers);

        //Get Directors Info
        $sqlQuery = $connect->prepare("SELECT DISTINCT name FROM director INNER JOIN directormovie ON directormovie.directorid = director.id AND directormovie.movieid=:requestedMovie ");
        $sqlQuery->bindParam(":requestedMovie",$_GET["blast"]);
        $sqlQuery->execute();
        
        $director = "";
        while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC))
        {
        $director.=$row["name"];
        $director.=", ";
        }
        if(strlen($director))
        $director[strlen($director) - 2] = '.';
        $director = str_replace("'","\'",$director);

        //Get Movie Genres
        $sqlQuery = $connect->prepare("SELECT DISTINCT genreName FROM genre INNER JOIN moviegenre ON moviegenre.genreid = genre.id AND moviegenre.movieid=:requestedMovie ");
        $sqlQuery->bindParam(":requestedMovie",$_GET["blast"]);
        $sqlQuery->execute();
        
        $genres = "";
        while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC))
        {
        $genres.=$row["genreName"];
        $genres.=", ";
        }
        if(strlen($genres))
        $genres[strlen($genres) - 2] = '.';

        //Get Similar Movies/TvShows
        if($movieObject["isTvSeries"]=='0')
        $sqlQuery = $connect->prepare("SELECT DISTINCT movie.id, movie.name, movie.thumbnail FROM movie INNER JOIN moviegenre ON moviegenre.genreID IN(SELECT DISTINCT moviegenre.genreID FROM moviegenre INNER JOIN movie ON moviegenre.movieID=:requestedMovie) AND moviegenre.movieID=movie.id AND isTvSeries=0 AND movie.id<>:requestedMovie");
        else
        $sqlQuery = $connect->prepare("SELECT DISTINCT movie.id, movie.name, movie.thumbnail FROM movie INNER JOIN moviegenre ON moviegenre.genreID IN(SELECT DISTINCT moviegenre.genreID FROM moviegenre INNER JOIN movie ON moviegenre.movieID=:requestedMovie) AND moviegenre.movieID=movie.id AND isTvSeries=1 AND movie.id<>:requestedMovie");
        $sqlQuery->bindParam(":requestedMovie",$_GET["blast"]);
        $sqlQuery->execute();

        $similarMovies = array();
        while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC))
        {
                $similarMovie = array();
                array_push($similarMovie,$row["id"]);
                array_push($similarMovie,$row["name"]);
                array_push($similarMovie,$row["thumbnail"]);
                array_push($similarMovies,$similarMovie);
        }

        $similarMoviesJSON = json_encode($similarMovies);

        //Get Movie Trailers
        $sqlQuery = $connect->prepare("SELECT DISTINCT trailer FROM trailer INNER JOIN movie ON trailer.movieID = :requestedMovie LIMIT 3");
        $sqlQuery->bindParam(":requestedMovie",$_GET["blast"]);
        $sqlQuery->execute();

        $trailers = "";
        while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC))
        {
        $trailers.=$row["trailer"];
        $trailers.=",";
        }

        //Get Seasons and First Episode List If Tv Series
        if($movieObject["isTvSeries"]=='1')
        {
        $sqlQuery = $connect->prepare("SELECT noOfSeasons FROM tvSeries WHERE tvSeries.seriesID = :requestedMovie;");
        $sqlQuery->bindParam(":requestedMovie",$_GET["blast"]);
        $sqlQuery->execute();
        $row = $sqlQuery->fetch();
        $noOfSeasons = $row["noOfSeasons"];

        $sqlQuery = $connect->prepare("SELECT DISTINCT name,thumbnail,length FROM episode INNER JOIN tvseries ON episode.seriesID = :requestedMovie AND seasonNumber=1");
        $sqlQuery->bindParam(":requestedMovie",$_GET["blast"]);
        $sqlQuery->execute();

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
        }

        //Get User Rating If User Online
        $_SESSION["userRating"] = null;
        if($canRate)            //User is Logged In Only Then canRate will be 1
        {
        $sqlQuery = $connect->prepare("SELECT rating FROM userRating WHERE userRating.userID=:userID AND userRating.movieID=:requestedMovie;");
        $sqlQuery->bindParam(':userID',$_SESSION["userID"]);
        $sqlQuery->bindParam(":requestedMovie",$_GET["blast"]);
        $sqlQuery->execute();

        if($sqlQuery->rowCount()==1)
        {
        $row = $sqlQuery->fetch();
        $_SESSION["userRating"] = $row["rating"];
        }
        }

        //Get Movie Comments
        $sqlQuery = $connect->prepare("SELECT comment,guest.name FROM userComment,guest WHERE movieid=:requestedMovie AND guest.id=userComment.guestid ORDER BY userComment.id DESC; ");
        $sqlQuery->bindParam(":requestedMovie",$_GET["blast"]);
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

        if($movieObject["isTvSeries"]=='1')
        echo "<script> loadMovieInfo(".$movieJSON.",'".$actors."','".$producers."','".$director."','".$genres."','".$trailers."',".$commentsJSON.",".$similarMoviesJSON.",".$_SESSION["userRating"].");
        loadTvSeriesSeasons(".$noOfSeasons.",".$episodesJSON.");
        </script>";
        else
        echo "<script> loadMovieInfo(".$movieJSON.",'".$actors."','".$producers."','".$director."','".$genres."','".$trailers."',".$commentsJSON.",".$similarMoviesJSON.",".$_SESSION["userRating"]."); </script>";
}
        
catch(PDOException $e)
{
        echo $e->getMessage();
}

else
echo "<script> document.getElementsByTagName('body')[0].innerHTML = ' '; </script> <h1> This Page doesn't exist. </h1>";

$connect = null;

?>

<?php
 if(isset($_SESSION['username'],$_SESSION['userEmail']))
 {
     echo "<script> bossIsIn(); </script>";
 }
?>

<script>

var canRate = "<?php echo $canRate; ?>";

</script>