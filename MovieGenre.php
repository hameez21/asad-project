<?php

session_start();

if(!isset($_GET['LFail']))
{
    $_GET['LFail']=0;
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Genrefied - MCDB</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="navBar.css">
    <link rel="stylesheet" type="text/css" href="LoginCSS.css">
    <link rel="stylesheet" type="text/css" href="LoginDiv.css">
    <link rel="stylesheet" href="MovieGenreCSS.css">
    <link rel="stylesheet" type="text/css" href="AccountHandlerCSS.css">
    <script src="LoginJS.js"></script>  
    <script src="navBar.js"></script>
    <script src="MovieGenreJS.js"></script>
    <script src="AccountHandler.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Wendy One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Arapey' rel='stylesheet'>
</head>
<body>
    <div id="backgroundImg"></div>
    <div id="content">
    <div class="loginPage" onclick="bodyDark()">
        <div id="blur"></div>
        <div id="loginForm">
        <h1 id="label1">LOGIN</h1>
        <a class="closeLoginBtn" onclick="closeLogin()">&times;</a>    
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
        <a id="signUp" href="SignUp.php">Signup To MovieDB ?</a>
    </div>
    <div class="topFlex">
        <header>
                <div class="navBar" style="background-color: #303030">
                        <a href="#top" class="hamButton" onclick="openMenu()">☰</a>
                        <a class="pageTitle" href="index.php" id="logo">MCDB</a>
                        <a class="navItems" href="toppop.php?type=top&media=movies">Top Movies</a>
                        <a class="navItems" href="toppop.php?type=pop&media=movies">Popular Movies</a>
                        <a class="navItems" href="toppop.php?type=top&media=tv">Top TV Shows</a>
                        <a class="navItems" href="toppop.php?type=pop&media=tv">Popular TV Shows</a>
                        <a class="navItems" href="moviegenre.php">Generefy</a>
                        <a class="searchClose" onclick="closeSearch()">&times;</a>
                        <img src="search-3-xxl.png" alt="Search" class="searchButton" width="24px" height="24px" onclick="openSearch()" >
                        <a class="login" onclick="openLogin()">Login</a>
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
        <div class="genreLinks">
                <a class="genreLink">Action</a>
                <a class="genreLink">Adventure</a>
                <a class="genreLink">Animation</a>
                <a class="genreLink">Crime</a>
                <a class="genreLink">Mystery</a>
                <a class="genreLink">Science Fiction</a>
                <a class="genreLink">Drama</a>
                <a class="genreLink">Documentary</a>
                <a class="genreLink">Comedy</a>
                <a class="genreLink">Horror</a>
                <a class="genreLink">Family</a>
                <a class="genreLink">Thriller</a>
        </div>
        <div class="genreLinks" id="pages">
        </div>
        <div class="moviesList">

        </div>
    </div>
    <footer>
        <p> <script> var date = new Date(); document.getElementsByTagName('footer')[0].getElementsByTagName('p')[0].innerHTML = "Movie Chronicle Database Copyright &copy; "+ date.getFullYear();  </script></p>
    </footer>
    </div>
</body>
</html>

<?php


$serverName = "localhost:3306";
$userName = "root";

if(!isset($_GET["requestedGenre"]))
{
try
{
        $connect = new PDO("mysql:host=$serverName;dbname=DBMSP",$userName);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Get Movie Info
        $sqlQuery = $connect->prepare("SELECT id,name,cover,thumbnail,synopsis,releaseDate,rating FROM movie ORDER BY releaseDate DESC LIMIT 20 OFFSET 0;");
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

        $sqlQuery = $connect->prepare("SELECT COUNT(*) countMovies FROM movie;");
        $sqlQuery->execute();
        $row = $sqlQuery->fetch();
        $movieCount = $row["countMovies"];
        $_SESSION["reqGen"] = null;

        echo "<script> loadMovieList(".$moviesJSON.");
             loadPages(".$movieCount."); 
             var pageLinks = document.getElementsByClassName('pageLink');
             pageLinks[0].style.color = 'rgb(187, 70, 49)';
             </script>";
}
        
catch(PDOException $e)
{
        echo "<script> displayErrorMessage('".trim($e->getMessage())."'); </script>";
}
}

else
{
try
{
        $connect = new PDO("mysql:host=$serverName;dbname=DBMSP",$userName);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Get Movie Info Genre Wise
        $sqlQuery = $connect->prepare("SELECT DISTINCT movie.id,name,cover,thumbnail,synopsis,releaseDate,rating FROM movie INNER JOIN moviegenre ON moviegenre.movieid=movie.id INNER JOIN genre ON moviegenre.genreID = (SELECT DISTINCT genre.id FROM genre WHERE genre.genreName LIKE :reqGenre) ORDER BY releaseDate DESC LIMIT 20 OFFSET 0;");
        $sqlQuery->bindParam(':reqGenre',$_GET["requestedGenre"]);
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
        $_SESSION["reqGen"] = $_GET["requestedGenre"];

        $sqlQuery = $connect->prepare("SELECT COUNT(DISTINCT movie.id) countMovies FROM movie INNER JOIN moviegenre ON moviegenre.movieid=movie.id INNER JOIN genre ON moviegenre.genreID = (SELECT DISTINCT genre.id FROM genre WHERE genre.genreName LIKE :reqGenre); ");
        $sqlQuery->bindParam(':reqGenre',$_GET["requestedGenre"]);
        $sqlQuery->execute();
        $row = $sqlQuery->fetch();
        $movieGenreCount = $row["countMovies"];

        echo 
        "<script> 
        loadMovieList(".$moviesJSON."); 
        loadPages(".$movieGenreCount.");
        var genreLinks = document.getElementsByClassName('genreLink');
        for(var i=0; i<genreLinks.length; i++)
        if(genreLinks[i].innerText == '".$_GET["requestedGenre"]."')
        genreLinks[i].style.color = 'rgb(187, 70, 49)';
        var pageLinks = document.getElementsByClassName('pageLink');
        pageLinks[0].style.color = 'rgb(187, 70, 49)';
        document.getElementsByTagName('title')[0].innerText = '".$_GET["requestedGenre"]."' + ' Movies - MovieDB';
        </script>";
}
        
catch(PDOException $e)
{
        echo "<script> displayErrorMessage('".trim($e->getMessage())."'); </script>";
}
}

$connect = null;

?>

<?php
 if(isset($_SESSION['username'],$_SESSION['userEmail']))
 {
     echo "<script> bossIsIn(); </script>";
 }
?>