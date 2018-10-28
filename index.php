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
    <link rel="stylesheet" type="text/css" href="navBar.css">
    <link rel="stylesheet" type="text/css" href="AccountHandlerCSS.css">
    <link rel="stylesheet" type="text/css" href="LoginCSS.css">
    <link rel="stylesheet" type="text/css" href="LoginDIV.css">
    <script src="LoginJS.js"></script>
    <script src="indexJS.js"></script>
    <script src="navBar.js"></script>
    <script src="AccountHandler.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Wendy One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Arapey' rel='stylesheet'>
    <title>Home - MCDB</title>
</head>
<body >
<div id="backgroundImg"></div>
    <div class="navBar" style="background-color: #303030;height:auto;position:sticky;-webkit-position:sticky">
        <a href="#top" class="hamButton" onclick="openMenu()">☰</a>
        <a class="pageTitle" href="index.php">MCDB</a>
        <a class="navItems" href='toppop.php?type=top&media=movies'>Top Movies</a>
        <a class="navItems" href='toppop.php?type=pop&media=movies'>Popular Movies</a>
        <a class="navItems" href='toppop.php?type=top&media=tv'>Top TV Shows</a>
        <a class="navItems" href='toppop.php?type=pop&media=tv'>Popular TV Shows</a>
        <a class="navItems" href="moviegenre.php">Generefy</a>
        <a class="searchClose" onclick="closeSearch()">&times;</a>
        <img src="Images/search-3-xxl.png" alt="Search" class="searchButton" width="24px" height="24px" onclick="openSearch()" >
        <a class="login" onclick="openLogin()">Login</a>
        <a id="user"> 
                        <a class="login" href="LogOut.php?signOut=true&page=<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" id="signOut"> Sign Out </a>
                        <a class="login" onclick="showSignOut()"><?php if(isset($_SESSION['username'],$_SESSION['userEmail'])) echo $_SESSION['username']; ?></a> 
                        </a>
        <input type="text" name="search" id="search" placeholder="Search Movies" oninput="searchMovie(this.value)"> 
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
    <div class="pageContent">
        <div class="theaterList" style="margin-top: 3%;">
            <h2 class="theater" style="color: white; margin-left: 20PX;">In Theater</h2>
            <div class="flexCa">
                <div class="flexContainer"  style="">
                    <div class="imageHolder ih1" id="imageHolder1">
                        <img id="movieImage1" class="movieImage" src="Images/Deadpool.png">
                        <a class="homeMovDetail" href="">Deadpool</a>
                    </div>
                    <div class="flexSide">
                        <div class="imageHolder ih2" id="imageHolder2">
                            <img id="movieImage2" class="movieImage" src="Images/Got.jpg" >
                            <a class="homeMovDetail" id="homeMovDetail2" href="">Got</a>
                        </div>
                        <div class="imageHolder ih3" id="imageHolder3">
                            <img id="movieImage3" class="movieImage" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" >
                            <a class="homeMovDetail"  href="">COCO</a>
                        </div>
                    </div>
                </div>
                <div class=flexContainer>
                    <div class="imageHolder ih4" id="imageHolder1">
                        <img id="movieImage1" class="movieImage" src="Images/Deadpool.png">
                        <a class="homeMovDetail" href="">Deadpool</a>
                    </div>
                    <div class="flexSide">
                        <div class="imageHolder ih5" id="imageHolder2">
                            <img id="movieImage2" class="movieImage" src="Images/Got.jpg" >
                            <a class="homeMovDetail" id="homeMovDetail2" href="">Got</a>
                        </div>
                        <div class="imageHolder ih6" id="imageHolder3">
                            <img id="movieImage3" class="movieImage" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" >
                            <a class="homeMovDetail"  href="">COCO</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="theaterList" >
            <h2 class="theater" style="color: white; margin-left: 20PX;">On Tv</h2>
            <div class="flexCa">
            <div class="flexContainer" style="">
                <div class="tvimageHolder tvih1" id="imageHolder1">
                    <img id="tvImage1" class="tvImage" src="Images/Got.jpg">
                    <a class="homeMovDetail" >Deadpool</a>
                </div>
                <div class="flexSide">
                    <div class="tvimageHolder tvih2" id="imageHolder2">
                        <img id="tvImage2" class="tvImage" src="Images/moviebg.jpg" >
                        <a class="homeMovDetail" id="homeMovDetail2">Deadpool</a>
                    </div>
                    <div class="tvimageHolder tvih3" id="imageHolder3">
                         <img id="tvImage3" class="tvImage" src="Images/super.jpg" >
                         <a class="homeMovDetail"  >Deadpool</a>
                    </div>
                </div>
            </div>
            <div class="flexContainer">    
                <div class="tvimageHolder tvih4" id="imageHolder1">
                    <img id="tvImage1" class="tvImage" src="Images/Got.jpg">
                    <a class="homeMovDetail" >Deadpool</a>
                </div>
                <div class="flexSide">
                    <div class="tvimageHolder tvih5" id="imageHolder2">
                        <img id="tvImage2" class="tvImage" src="Images/moviebg.jpg" >
                        <a class="homeMovDetail" id="homeMovDetail2">Deadpool</a>
                    </div>
                    <div class="tvimageHolder tvih6" id="imageHolder3">
                         <img id="tvImage3" class="tvImage" src="Images/super.jpg" >
                         <a class="homeMovDetail"  >Deadpool</a>
                    </div>
                </div>
            </div>    
            </div>
            </div>  
        </div>
    </div>
    <div class="otherContent">
        <div class="popularMovie">
            <h2 style="color:white;">Most Popular Movies this Month</h2>
            <div class="flexC">
            <div class="moviePop">
                <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                    <a class="rate">5</a>
                    <a class="movName" href="">Deadpool</a>
                    <a class="relDate">25-jun-2018</a>
                </div>
                </div>
            <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                        <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName" href="">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>                
                </div>  
            <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName" href="">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>
                </div>
                <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName" href="">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>
                </div>
                <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName" href="">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>
                </div>
                <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>
                </div>
                </div>
            <div class="BrowseMore" >
            <a class="browseLink" href="toppop.php?type=pop&media=movies" >Browse more</a>
                </div>
        </div>
        <div class="popularMovie">
            <h2 style="color:white;">Top Movies of all time</h2>
            <div class="flexC">
            <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                    
                    <div class="popDetail">
                            <a class="rate">5</a>
                            <a class="movName" href="">Deadpool</a>
                            <a class="relDate">25-jun-2018</a>
                        </div>
                </div>
            <div class="moviePop"><img src="Images/Deadpool.png" class="popImage">
                    
                <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName" href="">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>
                </div>  
            <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                    
                    <div class="popDetail">
                            <a class="rate">5</a>
                            <a class="movName" href="">Deadpool</a>
                            <a class="relDate">25-jun-2018</a>
                        </div>
                </div>
                <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                    
                    <div class="popDetail">
                            <a class="rate">5</a>
                            <a class="movName" href="">Deadpool</a>
                            <a class="relDate">25-jun-2018</a>
                        </div>
                </div>
                <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                    
                    <div class="popDetail">
                            <a class="rate">5</a>
                            <a class="movName" href="">Deadpool</a>
                            <a class="relDate">25-jun-2018</a>
                        </div>
                </div>
                <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                    
                    <div class="popDetail">
                            <a class="rate">5</a>
                            <a class="movName" href="">Deadpool</a>
                            <a class="relDate">25-jun-2018</a>
                        </div>
                </div>
                </div>
            <div class="BrowseMore" >
            <a class="browseLink" href="toppop.php?type=top&media=movies" >Browse more</a>
                </div>
        </div>
        <div class="popularMovie">
            <h2 style="color:white;">Most Popular Tv Shows this Month</h2>
            <div class="flexC">
            <div class="moviePop">
                <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                    <a class="rate">5</a>
                    <a class="movName" href="">Deadpool</a>
                    <a class="relDate">25-jun-2018</a>
                </div>
                </div>
            <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                        <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName" href="">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>                
                </div>  
            <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName" href="">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>
                </div>
                <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName" href="">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>
                </div>
                <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName" href="">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>
                </div>
                <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>
                </div>
                </div>
            <div class="BrowseMore" >
            <a class="browseLink" href="toppop.php?type=pop&media=tv">Browse more</a>
                </div>
        </div>
        <div class="popularMovie">
            <h2 style="color:white;">Top Rated Tv Shows</h2>
            <div class="flexC">
            <div class="moviePop">
                <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                    <a class="rate">5</a>
                    <a class="movName" href="">Deadpool</a>
                    <a class="relDate">25-jun-2018</a>
                </div>
                </div>
            <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                        <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName" href="">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>                
                </div>  
            <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName" href="">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>
                </div>
                <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName" href="">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>
                </div>
                <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName" href="">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>
                </div>
                <div class="moviePop">
                    <img src="Images/Deadpool.png" class="popImage">
                <div class="popDetail">
                        <a class="rate">5</a>
                        <a class="movName">Deadpool</a>
                        <a class="relDate">25-jun-2018</a>
                    </div>
                </div>
                </div>
            <div class="BrowseMore" >
            <a class="browseLink" href="toppop.php?type=top&media=tv">Browse more</a>
                </div>
        </div>
    </div>
    <footer><p> <script> var date = new Date(); document.getElementsByTagName('footer')[0].getElementsByTagName('p')[0].innerHTML = "Movie Chronicle Database Copyright &copy; "+ date.getFullYear();  </script></p></footer>
</body>
</html>

<style>
 body{
        width: 100%;
        height:300vw;
        background-color: rgba(0, 0, 0, 0.7);
        font-family: 'Arapey','Wendy One','Sofia','Times New Roman', Times, serif;
        overflow: auto;
    }
h2,a
    {
    font-family: 'Ubuntu','Times New Roman', Times, serif;
    font-weight: bolder;
    font-size: 150%;
    }
    a
    {
    text-decoration: underline;
    font-size: 100%;
    transition: 0.5s all;
    }
    footer p
    {
    top: calc(50% - 0.5em);
    font-size: 1em;
    }
.pageContent{
    display: block;
    width:100%;
    height:100%;
    margin: auto;
    background-position: center;
    background-size: cover;
    
    margin-top: 0px;
    }
#backgroundImg
{
    background-image: url("Images/bgc.jpg");
    width:100%;
    height:100%;
    position: fixed;
    z-index: -1;
}
.theaterList{
    height:50%;  
    width: 100%;
}
h2:hover{
 color:rgb(187, 70,49 );
 font-size:200%;
 cursor: pointer;
 transition: 0.2s;
}
.flexCa{
    display:flex;
    flex-wrap:nowrap;
    height:80%;
    width:100%;
    overflow-x:auto;
    padding: 10px 0 10px 0;
}
.imageHolder, .tvimageHolder{
   width: 100%;
   height: 80%;
   max-height:300px;
   position: relative;
cursor:pointer;
}
.movieImage{
    width:100%;
    height:100%;
    background-color: black;
    object-fit: cover;
    object-position: top;
    animation: fade 1.2s;
    
}
div{
    overflow:hidden;
}

@keyframes fade {
  from {opacity: .6} 
  to {opacity: 1}}
  .tvImage{
    width:100%;
    height:100%;
    background-color: black;
    object-fit: cover;
    object-position: top;
    animation: fade 1.2s;
}
#tvImage2,#tvImage3{
    display:none;    
}
.BrowseMore{
    border-bottom: 7px rgb(187, 70,49 ) solid;
    
     width:90%; padding:2%;padding-bottom: 1%; padding-right: 0;
      margin:auto;
      margin-top: 2%;
      background-color: rgba(0, 0, 0, 0.7); 
}

.browseLink{
    font-size: 1em; color:white; padding-left: 2px;
    transition: 0.2s ease;
    cursor:pointer
}
a:hover{
    color:rgb(187, 70,49 );
    cursor:pointer;
}
a,h2{
    color:white;
    transition: 0.2s
}

.browseLink:hover{
    
    color:rgb(187, 70,49 );
}
.popularMovie{
    height:80%;
    width:90%;
    background-color: rgba(250, 250, 250, 0.1);
    padding: 10px;
    margin: auto;        
    box-shadow: 2px 2px 5px black;
    margin-top:10%;                  
}

.flexC
{
    position: relative;
    display: flex;
    flex-wrap: nowrap;
    justify-content: flex-start;
    height: 80%;
    width: 100%;
    overflow: hidden;
    overflow-x: auto;
}

.flexC::-webkit-scrollbar, #episodes::-webkit-scrollbar,.flexCa::-webkit-scrollbar
{
	height: 10px;
    background: #303030;
    border-radius: 10px;
}   
.flexC::-webkit-scrollbar-thumb, #episodes::-webkit-scrollbar-thumb,.flexCa::-webkit-scrollbar-thumb
{
    background-color: rgb(187, 70, 49);
    border-radius: 10px;
}

.moviePop{
    position:relative;
    display: block;
    height:90%;
    min-width: 94%;
    background-color: black;
    margin: 2%;
    box-shadow: 1px 1px 5px black;}
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 1em;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
background-color:rgba(0,0,0,0.5);
}
/* Position the "next button" to the right */
.next{
  right: 0;
  border-radius: 3px 0 0 3px;
}
.prev{
left: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover{
  background-color: rgba(0,0,0,0.8);
}
.ddActive{
    background-color: green;
}

.homeMovDetail{
    position: absolute; bottom: 0%;padding:8px;padding-left:3%;padding-right: 0;
    background-color: rgba(50, 50, 50, 0.6);
    width: 97%;
    color:white;
     font-size:80%;
    animation:fade 1.2s;
    display:block;
}
.otherContent{
    width:95%;
    height: auto;
    margin:2%;
    
}
.popImage{
    width: 100%;
    height:100%;
    object-fit: cover;
    object-position: top;
}
.popDetail{
    height:20%;
    width:100%;
    position:absolute;
    bottom:0;
    overflow:hidden;
    background-color:rgba(50, 50, 50, 0.7);
    border-bottom: 5px rgb(187, 70,49 ) solid
}
.rate{
    border:rgb(187, 70,49 ) solid; margin:1%; padding:1.5%;
    position: absolute;
    bottom: 0;
    font-size:120%;  
}
.movName{
    font-size:1em;
    position: absolute;
    left: 10%;
    margin-left:3%;
    margin-top:2%
    
}
.relDate{
    font-size :60%;
    position:absolute;
    left:12%;
    bottom:0;
    margin:1%;
    color:gray;
    font-style:italic;
}

footer
{
    width: 100%;
    height: 3%;
    position: sticky;
    position: -webkit-sticky;
    top: 95%;
    background-color: #303030;
}

.flexContainer{
    display: flex;
    width:100%;
    height:100%;
    min-width:200%;
    flex-direction:row;
    justify-content:left;
    flex-wrap:nowrap;
    margin:auto;
    margin-left:5%;
    position:static;
    transition:0.5s ease-out;
    
    
}
.flexSide{
    display:flex;
    flex-direction:row;
    min-width:50%;
    min-height:100%;
    margin-right:2%;
}
.flexSide::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
    background: transparent; 
     /* optional: just make scrollbar invisible */
}
.imageHolder,.tvimageHolder{
    
    min-width: 40%;
    background-size: cover;
    background-position:center;
    margin: 4px;
    max-height:100%;
    height:100%;
    position: relative;
}
.homeMovDetail{
    width: 97%;
    bottom:0%;
}

#imageHolder2,#imageHolder3{
    position: relative;
    display:inline-block;
    max-width:100%;
    max-height: 100%;
    object-fit: cover;
    object-position: top;
    }
    #movieImage2,#movieImage3,#tvImage2,#tvImage3{
        display:inline-block;
    width:100%;
    max-height: 100%;
    object-fit: cover;
    object-position: top;
       
    }

@media screen and (min-width:700px){
    footer p
{
    position: relative;
    top: calc(50% - 0.6em);
    text-align: center;
    font-size: 1.2em;
}
    body{
        height:100vw;
    }
    .theaterList{
        position:relative;
    }
.movName{
    font-size:1em;
    
}
.relDate{
    font-size:100%;
}
.rate{
    font-size:150%;
}
.browseLink{
    font-size:1.5em;
}
.popularMovie{
    margin:auto;
    max-width:90%;
    margin:3%;
    height: 50%;
    padding: 10px;
}
.flexContainer{
    min-width:100%;
}
.imageHolder,.tvimageHolder{
    float: left;
    max-width: 100%;
    min-width:50%;
    background-size: cover;
    background-position:center;
    margin: 4px;
    max-height:100%;
    height:100%;
    position: relative;
}
.homeMovDetail{
    width: 97%;
    bottom:0%;
    font-size:150%;
}
.flexSide{
    display:flex;
    flex-direction:column;
    max-width:80%;
    margin-right:2%;
}
#imageHolder2,#imageHolder3{
    position: relative;
    display:inline-block;
    max-width:100%;
    max-height: 50%;
    object-fit: cover;
    object-position: CENTER;
    }
    #movieImage2,#movieImage3,#tvImage2,#tvImage3{
        display:inline-block;
    width:100%;
    max-height: 100%;
    object-fit: cover;
    object-position: CENTER;
       
    }
    .moviePop{
        min-width: 48%;
        width:40%;
        height: 80%;
        margin: 1% 2% 1% 2%;
    }
.next,.prev{
    display:block;
    padding-right:10px;
    padding-top:20px;
    padding-bottom:20px;
    top:45%;
}
.prev{
    left:3%
}
.next{
    right:2.5%;
    z-index:2;
    
}

}
</style>
<script src="indexJS.js">
         
</script>
<script src="navBar.js"></script>
<?php
$servername="localhost";
$username="root";

$_SESSION['logged']=0;
if($_SESSION['logged']==1){
    echo "<script> var login=document.getElementsByClassName('login');
                    login[0].style.display='none';</script>";
}
try{
$connect=new PDO("mysql:host=$servername;dbname=dbmsp",$username);
$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$theatreQuery= $connect->prepare("select id,name,cover,synopsis,releaseDate from movie WHERE isTvSeries=0 order by releaseDate desc LIMIT 6;");
$theatreQuery->execute();
$theaterList = array();
while ($row=$theatreQuery->fetch()) {
    $theaterMovie = array();
    array_push($theaterMovie,$row["id"]);
    array_push($theaterMovie,$row["name"]);
    array_push($theaterMovie,$row["cover"]);
    array_push($theaterList,$theaterMovie);
}

$theaterJson=json_encode($theaterList);


$onTvQuery= $connect->prepare("select id, name, cover from movie WHERE isTvSeries=1 order by releaseDate desc LIMIT 6;");
$onTvQuery->execute();
$onTvList = array();
while ($row=$onTvQuery->fetch()) {
    $tvShow = array();
    array_push($tvShow,$row["id"]);
    array_push($tvShow,$row["name"]);
    array_push($tvShow,$row["cover"]);
    array_push($onTvList,$tvShow);
}

$onTvJson=json_encode($onTvList);

$mostPopQuery= $connect->prepare("select id, name, cover, releaseDate, rating from movie WHERE isTvSeries=0 order by popularity desc LIMIT 6;");
$mostPopQuery->execute();
$popList = array();
while ($row=$mostPopQuery->fetch()) {
    $popMovie = array();
    array_push($popMovie,$row["id"]);
    array_push($popMovie,$row["name"]);
    array_push($popMovie,$row["cover"]);
    array_push($popMovie,$row["releaseDate"]);
    array_push($popMovie,$row["rating"]);
    array_push($popList,$popMovie);
}

$popJson=json_encode($popList);


$allTopQuery= $connect->prepare("select id, name, cover, releaseDate, rating from movie WHERE isTvSeries=0 order by rating desc LIMIT 6;");
$allTopQuery->execute();
$allTopList = array();
while ($row=$allTopQuery->fetch()) {
    $topMovie = array();
    array_push($topMovie,$row["id"]);
    array_push($topMovie,$row["name"]);
    array_push($topMovie,$row["cover"]);
    array_push($topMovie,$row["releaseDate"]);
    array_push($topMovie,$row["rating"]);
    array_push($allTopList,$topMovie);
}

$allTopJson=json_encode($allTopList);

$mostPopTvQuery= $connect->prepare("select id, name, cover, releaseDate, rating from movie WHERE isTvSeries=1  order by popularity desc LIMIT 6;");
$mostPopTvQuery->execute();
$popTvList = array();
while ($row=$mostPopTvQuery->fetch()) {
    $popTv = array();
    array_push($popTv,$row["id"]);
    array_push($popTv,$row["name"]);
    array_push($popTv,$row["cover"]);
    array_push($popTv,$row["releaseDate"]);
    array_push($popTv,$row["rating"]);
    array_push($popTvList,$popTv);
}

$popTvJson=json_encode($popTvList);


$allTopTvQuery= $connect->prepare("select id, name, cover, releaseDate, rating from movie WHERE isTvSeries=1 order by rating desc LIMIT 6;");
$allTopTvQuery->execute();
$allTopTvList = array();
while ($row=$allTopTvQuery->fetch()) {
    $topTvMovie = array();
    array_push($topTvMovie,$row["id"]);
    array_push($topTvMovie,$row["name"]);
    array_push($topTvMovie,$row["cover"]);
    array_push($topTvMovie,$row["releaseDate"]);
    array_push($topTvMovie,$row["rating"]);
    array_push($allTopTvList,$topTvMovie);
}

$allTopTvJson=json_encode($allTopTvList);


echo "<script> loadData(".$theaterJson.",".$onTvJson.",".$popJson.",".$allTopJson.",".$popTvJson.",".$allTopTvJson."); </script>";
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<?php
 if(isset($_SESSION['username'],$_SESSION['userEmail']))
 {
     echo "<script> bossIsIn(); </script>";
 }
?>