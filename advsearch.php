<?php 
session_start();
 if(!isset($_GET['LFail'])){
     $_GET['LFail']=0;
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="LoginCSS.css">
    <link rel="stylesheet" type="text/css" href="LoginDIV.css">
    <link rel="stylesheet" type="text/css" href="navBar.css">
    <link rel="stylesheet" type="text/css" href="AccountHandlerCSS.css">
    <script src="LoginJS.js"></script>
    <script src="indexJS.js"></script>
    <script src="navBar.js"></script>
    <script src="advsearch.js"></script>
    <script src="AccountHandler.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Wendy One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Arapey' rel='stylesheet'>
    <title>Advanced Search - MCDB</title>
</head>
<body style="height:100%">
    <header STYLE="position:absolute;top:0;">
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
    </header>
    <div class="loginPage" >
        <div id="blur"></div>
        <div id="loginForm">
        <h1 id="label1">LOGIN</h1>
        <a class="closeLoginBtn" onclick="closeLogin()">&times;</a>    
        <form action="<?php echo 'loginT.php?return='.htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                    <?php if($_GET['LFail']==1){
                    echo 'Invalid email or password'; }
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
    <div id="backgroundImg"></div>
    <div id="flexContainer" style="z-index: 3;">
        <form id="searchForm" style="margin:auto;margin-top:10%;width:70%;overflow:hidden">
        <input class="searchBar2" type="text" autofocus placeholder="Search.." oninput="searchMovieAdv(this.value)">
        <label id="myLabel" STYLE="COLOR:WHITE;">Search By :</label>
        <select class="list" name="" id="searchBy">
            <option value="movie">Movie</option>
            <option value="tv series">Tv Series</option>
            <option value="actor">Actor</option>
            <option value="director">Director</option>
            <option value="producer">Producer</option>
        </select>
    </form>
    </div> 
    <div class="searchResultAdv" onscroll="scrollMob()">
            <ul id="searchListAdv" >
                
            </ul>
         </div>
         <footer>
        <p> <script> var date = new Date(); document.getElementsByTagName('footer')[0].getElementsByTagName('p')[0].innerHTML = "Movie Chronicle Database Copyright &copy; "+ date.getFullYear();  </script></p>
</footer>
</body>
</html>
<style>
body{
    width: 100%;
    height:100%;
}
.login
{
    color: white;
}
.login:hover
{
    cursor: pointer;
}
.searchBar2,select{
    border: none;
    border-bottom: 3px solid rgb(187, 70, 49);
    padding: 10px;
    color: white;
    font-family: 'Arapey','Wendy One','Sofia','Times New Roman', Times, serif;
    font-size: 1.2em;
    transition: 0.5s;
    margin:auto;
    width:50%;
    background-color: transparent;
    
}
.searchBar2.mob{
    max-height:0.6px;
    font-size:0.8em;
    transition:0.2s;
    margin-bottom:1%;
    margin-top:0%;
}
select{
    width:20%;
    font-family: 'Arapey','Wendy One','Sofia','Times New Roman', Times, serif;
    font-size: 1.2em;
    transition: 0.5s border;
    background-color: transparent;
       
}
option{
    color:white;
    font-family: 'Arapey','Wendy One','Sofia','Times New Roman', Times, serif;
    font-size: 1.3em;
    transition: 0.5s border;
    background-color:rgb(50,50,50);
    

}
.searchResultAdv::-webkit-scrollbar
{
	height: 10px;
    background: #303030;
    border-radius: 10px;
    width: 10px;
}   
.searchResultAdv::-webkit-scrollbar-thumb
{
    background-color: rgb(187, 70, 49);
    border-radius: 10px;
}
label{
    font-family: 'Arapey','Wendy One','Sofia','Times New Roman', Times, serif;
    font-size: 1.2em;
    margin-left:10%;
}
.searchBar2:focus
{

    outline: none;
    border: 3px solid rgb(187, 70, 49);
    border-radius: 5px;
}

select 
{
    border: 3px solid rgb(187, 70, 49);
    border-radius: 5px;
}

#backgroundImg{
    position:absolute;
    top:0;
    left:0;
    z-index: -1;
}
.searchResultAdv,.searchListAdv{
    height:30vw;
    width:80%;
    margin:auto;
    overflow-y: auto;
    overflow-x: hidden;
    margin-top:3%;
}
h1,h2,a
{
    font-family: 'Ubuntu','Wendy One','Sofia','Times New Roman', Times, serif;
}
footer
{
    width: 100%;
    height: 5%;
    position: fixed;
    top: 95%;
    background-color: #303030;
}

footer p
{
    position: relative;
    top: calc(50% - 0.6em);
    text-align: center;
    font-size: 1.2em;
}
@media screen and (max-width:900px){
    .searchResultAdv,.searchListAdv{
        height:40vw;
        width:100%;
    }
    .searchBar2{
        margin-top:5%;
        width:80%;
        margin-bottom:10%;
        display: block;
        
        }
    select{
        width:80%;
        display:block;
        margin:auto;
    }
}
@media screen and (max-width:500px){
    .searchResultAdv,.searchListAdv{
        height:100vw;
      
    }
    .searchBar2{
        margin-top:20%
    }
    .searchBar2.mob{
        margin-top:10%;
    }
    footer p
    {
    top: calc(50% - 0.5em);
    font-size: 1em;
    }
    
}
</style>
<?php
 if(isset($_SESSION['username'],$_SESSION['userEmail']))
 {
     echo "<script> bossIsIn(); </script>";
 }
?>