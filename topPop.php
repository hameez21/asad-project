<?php
session_start();
if(!isset($_GET['LFail'])){
    $_GET['LFail']=0;
}
    if(!isset($_GET['page'])){
        $_GET['page']=0;
    }

    if(!isset($_GET['type'])){
        $_GET['type']="top";
    }
    
    if(!isset($_GET['media'])){
        $_GET['media']="movies";
    }
    if($_GET['type']=='pop'){
        $head='popular';
    }
    else{
        $head='top';
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="navBar.css">
    <link rel="stylesheet" type="text/css" href="LoginCSS.css">
    <link rel="stylesheet" type="text/css" href="LoginDIV.css">
    <link rel="stylesheet" type="text/css" href="AccountHandlerCSS.css">
    <script src="navBar.js"></script>
    <script src="LoginJS.js"></script>
    <script src="toppop.js"></script>
    <script src="AccountHandler.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Wendy One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Arapey' rel='stylesheet'>
    <title><?php ucfirst($head)." ".ucfirst($_GET['media'])?></title>
</head>
<header style="height:7.5%;z-index:10;position:sticky;top:0;background-color:#FFFFFF">
    <div class="navBar" style="background-color: #303030;min-height:100%;height:auto;padding:0;padding-top:0.5%;">
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
</header>
<body>
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
    <h1 id="title" style="margin:5%;margin-bottom:0;color:white;display:block;"><?php echo ucfirst($head)." ".ucfirst($_GET['media'])?></h1>
    <div class="container"> 
        <div class="movieDetail">
                <div class="movImage">
                        <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                        </div>
            <div class="flexContainer">
            <div class="flexDetail">
                <p class="rate">5 </p>
                <div class="det">
                <p class="name"><strong>COCO</strong></p>
                <p class="release">25-jun-2017</p></div>
            </div>
            <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
            <div class="moreInfo"><a class="link">MoreInfo</a></div>
        </div>
        <div class="flexDetail400">
                <p class="rate1">5 </p>
                <div class="det1">
                <p class="name1"><strong>COCO</strong></p>
                <p class="release1">25-jun-2017</p></div>
            </div>
        </div>
        <div class="movieDetail">
                <div class="movImage">
                        <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                        </div>
                        <div class="flexContainer">
                <div class="flexDetail">
                    <p class="rate">5 </p>
                    <div class="det">
                    <p class="name"><strong>COCO</strong></p>
                    <p class="release">25-jun-2017</p></div>
                </div>
                <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                <div class="moreInfo"><a class="link">MoreInfo</a></div>
            </div>
            <div class="flexDetail400">
                    <p class="rate1">5 </p>
                    <div class="det1">
                    <p class="name1"><strong>COCO</strong></p>
                    <p class="release1">25-jun-2017</p></div>
                </div>
            </div>
            <div class="movieDetail">
                    <div class="movImage">
                            <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                            </div>    
                <div class="flexContainer">
                    <div class="flexDetail">
                        <p class="rate">5 </p>
                        <div class="det">
                        <p class="name"><strong>COCO</strong></p>
                        <p class="release">25-jun-2017</p></div>
                    </div>
                    <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                    <div class="moreInfo"><a class="link">MoreInfo</a></div>
                </div>
                <div class="flexDetail400">
                        <p class="rate1">5 </p>
                        <div class="det1">
                        <p class="name1"><strong>COCO</strong></p>
                        <p class="release1">25-jun-2017</p></div>
                    </div>
                </div>
                <div class="movieDetail">
                        <div class="movImage">
                        <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                        </div>
                        <div class="flexContainer">
                        <div class="flexDetail">
                            <p class="rate">5 </p>
                            <div class="det">
                            <p class="name"><strong>COCO</strong></p>
                            <p class="release">25-jun-2017</p></div>
                        </div>
                        <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                        <div class="moreInfo"><a class="link">MoreInfo</a></div>
                    </div>
                    <div class="flexDetail400">
                            <p class="rate1">5 </p>
                            <div class="det1">
                            <p class="name1"><strong>COCO</strong></p>
                            <p class="release1">25-jun-2017</p></div>
                        </div>
                    </div>
                    <div class="movieDetail">
                            <div class="movImage">
                                <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                            </div>
                            <div class="flexContainer">
                            <div class="flexDetail">
                                <p class="rate">5 </p>
                                <div class="det">
                                <p class="name"><strong>COCO</strong></p>
                                <p class="release">25-jun-2017</p></div>
                            </div>
                            <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                            <div class="moreInfo"><a class="link">MoreInfo</a></div>
                        </div>
                        <div class="flexDetail400">
                                <p class="rate1">5 </p>
                                <div class="det1">
                                <p class="name1"><strong>COCO</strong></p>
                                <p class="release1">25-jun-2017</p></div>
                            </div>    
                    </div>
                    <div class="movieDetail">
                <div class="movImage">
                        <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                        </div>
            <div class="flexContainer">
            <div class="flexDetail">
                <p class="rate">5 </p>
                <div class="det">
                <p class="name"><strong>COCO</strong></p>
                <p class="release">25-jun-2017</p></div>
            </div>
            <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
            <div class="moreInfo"><a class="link">MoreInfo</a></div>
        </div>
        <div class="flexDetail400">
                <p class="rate1">5 </p>
                <div class="det1">
                <p class="name1"><strong>COCO</strong></p>
                <p class="release1">25-jun-2017</p></div>
            </div>
        </div>
        <div class="movieDetail">
                <div class="movImage">
                        <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                        </div>
                        <div class="flexContainer">
                <div class="flexDetail">
                    <p class="rate">5 </p>
                    <div class="det">
                    <p class="name"><strong>COCO</strong></p>
                    <p class="release">25-jun-2017</p></div>
                </div>
                <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                <div class="moreInfo"><a class="link">MoreInfo</a></div>
            </div>
            <div class="flexDetail400">
                    <p class="rate1">5 </p>
                    <div class="det1">
                    <p class="name1"><strong>COCO</strong></p>
                    <p class="release1">25-jun-2017</p></div>
                </div>
            </div>
            <div class="movieDetail">
                    <div class="movImage">
                            <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                            </div>    
                <div class="flexContainer">
                    <div class="flexDetail">
                        <p class="rate">5 </p>
                        <div class="det">
                        <p class="name"><strong>COCO</strong></p>
                        <p class="release">25-jun-2017</p></div>
                    </div>
                    <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                    <div class="moreInfo"><a class="link">MoreInfo</a></div>
                </div>
                <div class="flexDetail400">
                        <p class="rate1">5 </p>
                        <div class="det1">
                        <p class="name1"><strong>COCO</strong></p>
                        <p class="release1">25-jun-2017</p></div>
                    </div>
                </div>
                <div class="movieDetail">
                        <div class="movImage">
                        <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                        </div>
                        <div class="flexContainer">
                        <div class="flexDetail">
                            <p class="rate">5 </p>
                            <div class="det">
                            <p class="name"><strong>COCO</strong></p>
                            <p class="release">25-jun-2017</p></div>
                        </div>
                        <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                        <div class="moreInfo"><a class="link">MoreInfo</a></div>
                    </div>
                    <div class="flexDetail400">
                            <p class="rate1">5 </p>
                            <div class="det1">
                            <p class="name1"><strong>COCO</strong></p>
                            <p class="release1">25-jun-2017</p></div>
                        </div>
                    </div>
                    <div class="movieDetail">
                            <div class="movImage">
                                <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                            </div>
                            <div class="flexContainer">
                            <div class="flexDetail">
                                <p class="rate">5 </p>
                                <div class="det">
                                <p class="name"><strong>COCO</strong></p>
                                <p class="release">25-jun-2017</p></div>
                            </div>
                            <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                            <div class="moreInfo"><a class="link">MoreInfo</a></div>
                        </div>
                        <div class="flexDetail400">
                                <p class="rate1">5 </p>
                                <div class="det1">
                                <p class="name1"><strong>COCO</strong></p>
                                <p class="release1">25-jun-2017</p></div>
                            </div>    
                    </div>
                    <div class="movieDetail">
                <div class="movImage">
                        <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                        </div>
            <div class="flexContainer">
            <div class="flexDetail">
                <p class="rate">5 </p>
                <div class="det">
                <p class="name"><strong>COCO</strong></p>
                <p class="release">25-jun-2017</p></div>
            </div>
            <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
            <div class="moreInfo"><a class="link">MoreInfo</a></div>
        </div>
        <div class="flexDetail400">
                <p class="rate1">5 </p>
                <div class="det1">
                <p class="name1"><strong>COCO</strong></p>
                <p class="release1">25-jun-2017</p></div>
            </div>
        </div>
        <div class="movieDetail">
                <div class="movImage">
                        <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                        </div>
                        <div class="flexContainer">
                <div class="flexDetail">
                    <p class="rate">5 </p>
                    <div class="det">
                    <p class="name"><strong>COCO</strong></p>
                    <p class="release">25-jun-2017</p></div>
                </div>
                <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                <div class="moreInfo"><a class="link">MoreInfo</a></div>
            </div>
            <div class="flexDetail400">
                    <p class="rate1">5 </p>
                    <div class="det1">
                    <p class="name1"><strong>COCO</strong></p>
                    <p class="release1">25-jun-2017</p></div>
                </div>
            </div>
            <div class="movieDetail">
                    <div class="movImage">
                            <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                            </div>    
                <div class="flexContainer">
                    <div class="flexDetail">
                        <p class="rate">5 </p>
                        <div class="det">
                        <p class="name"><strong>COCO</strong></p>
                        <p class="release">25-jun-2017</p></div>
                    </div>
                    <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                    <div class="moreInfo"><a class="link">MoreInfo</a></div>
                </div>
                <div class="flexDetail400">
                        <p class="rate1">5 </p>
                        <div class="det1">
                        <p class="name1"><strong>COCO</strong></p>
                        <p class="release1">25-jun-2017</p></div>
                    </div>
                </div>
                <div class="movieDetail">
                        <div class="movImage">
                        <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                        </div>
                        <div class="flexContainer">
                        <div class="flexDetail">
                            <p class="rate">5 </p>
                            <div class="det">
                            <p class="name"><strong>COCO</strong></p>
                            <p class="release">25-jun-2017</p></div>
                        </div>
                        <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                        <div class="moreInfo"><a class="link">MoreInfo</a></div>
                    </div>
                    <div class="flexDetail400">
                            <p class="rate1">5 </p>
                            <div class="det1">
                            <p class="name1"><strong>COCO</strong></p>
                            <p class="release1">25-jun-2017</p></div>
                        </div>
                    </div>
                    <div class="movieDetail">
                            <div class="movImage">
                                <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                            </div>
                            <div class="flexContainer">
                            <div class="flexDetail">
                                <p class="rate">5 </p>
                                <div class="det">
                                <p class="name"><strong>COCO</strong></p>
                                <p class="release">25-jun-2017</p></div>
                            </div>
                            <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                            <div class="moreInfo"><a class="link">MoreInfo</a></div>
                        </div>
                        <div class="flexDetail400">
                                <p class="rate1">5 </p>
                                <div class="det1">
                                <p class="name1"><strong>COCO</strong></p>
                                <p class="release1">25-jun-2017</p></div>
                            </div>    
                    </div>
                    <div class="movieDetail">
                <div class="movImage">
                        <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                        </div>
            <div class="flexContainer">
            <div class="flexDetail">
                <p class="rate">5 </p>
                <div class="det">
                <p class="name"><strong>COCO</strong></p>
                <p class="release">25-jun-2017</p></div>
            </div>
            <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
            <div class="moreInfo"><a class="link">MoreInfo</a></div>
        </div>
        <div class="flexDetail400">
                <p class="rate1">5 </p>
                <div class="det1">
                <p class="name1"><strong>COCO</strong></p>
                <p class="release1">25-jun-2017</p></div>
            </div>
        </div>
        <div class="movieDetail">
                <div class="movImage">
                        <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                        </div>
                        <div class="flexContainer">
                <div class="flexDetail">
                    <p class="rate">5 </p>
                    <div class="det">
                    <p class="name"><strong>COCO</strong></p>
                    <p class="release">25-jun-2017</p></div>
                </div>
                <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                <div class="moreInfo"><a class="link">MoreInfo</a></div>
            </div>
            <div class="flexDetail400">
                    <p class="rate1">5 </p>
                    <div class="det1">
                    <p class="name1"><strong>COCO</strong></p>
                    <p class="release1">25-jun-2017</p></div>
                </div>
            </div>
            <div class="movieDetail">
                    <div class="movImage">
                            <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                            </div>    
                <div class="flexContainer">
                    <div class="flexDetail">
                        <p class="rate">5 </p>
                        <div class="det">
                        <p class="name"><strong>COCO</strong></p>
                        <p class="release">25-jun-2017</p></div>
                    </div>
                    <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                    <div class="moreInfo"><a class="link">MoreInfo</a></div>
                </div>
                <div class="flexDetail400">
                        <p class="rate1">5 </p>
                        <div class="det1">
                        <p class="name1"><strong>COCO</strong></p>
                        <p class="release1">25-jun-2017</p></div>
                    </div>
                </div>
                <div class="movieDetail">
                        <div class="movImage">
                        <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                        </div>
                        <div class="flexContainer">
                        <div class="flexDetail">
                            <p class="rate">5 </p>
                            <div class="det">
                            <p class="name"><strong>COCO</strong></p>
                            <p class="release">25-jun-2017</p></div>
                        </div>
                        <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                        <div class="moreInfo"><a class="link">MoreInfo</a></div>
                    </div>
                    <div class="flexDetail400">
                            <p class="rate1">5 </p>
                            <div class="det1">
                            <p class="name1"><strong>COCO</strong></p>
                            <p class="release1">25-jun-2017</p></div>
                        </div>
                    </div>
                    <div class="movieDetail">
                            <div class="movImage">
                                <img class="movImage1" src="Images/coco-2017-wallpapers-desktop-For-Iphone-Wallpaper-HD.png.jpg" alt="">
                            </div>
                            <div class="flexContainer">
                            <div class="flexDetail">
                                <p class="rate">5 </p>
                                <div class="det">
                                <p class="name"><strong>COCO</strong></p>
                                <p class="release">25-jun-2017</p></div>
                            </div>
                            <div class="synopsis"><p class"movSyn">daosndjasbcihasbchjsbcjkhasbc ahsdghavdg hjsdbhjavdd jhsadgjhadg hjadgadkhasj absbdkahjbd sahdgahsd hsdbhajsd hasdhas ksjbchskbckasbdbjaccjsa c vssmcdcscbscs chsddbcjsjhc sdbcjhscj hschasbc sbchsahbckasdc sbcsjbcc</p></div>
                            <div class="moreInfo"><a class="link">MoreInfo</a></div>
                        </div>
                        <div class="flexDetail400">
                                <p class="rate1">5 </p>
                                <div class="det1">
                                <p class="name1"><strong>COCO</strong></p>
                                <p class="release1">25-jun-2017</p></div>
                            </div>    
                    </div>
                    <div id="pageNo" style="margin:auto;width:auto;">
                        
                        </div>        
    </div>
    <footer>
    <p> <script> var date = new Date(); document.getElementsByTagName('footer')[0].getElementsByTagName('p')[0].innerHTML = "Movie Chronicle Database Copyright &copy; "+ date.getFullYear();  </script></p>
    </footer>
</body>
</html>
<style>
    *{
        font-family: 'Arapey','Wendy One','Sofia','Times New Roman', Times, serif;
    }
    body{
        width:100%;
        height:auto;
        background-color:rgba(0, 0, 0, 0.7 ); 
        overflow: auto;
        
        }
    .login:hover
    {
        cursor: pointer;
    }
   a{
       font-size: 1.3em;
       transition: 0.2s;
       font-family: 'Ubuntu','Wendy One','Sofia','Times New Roman', Times, serif;
   }
    h1{
        
        transition: 0.2s;
        cursor: pointer;
        font-family: 'Ubuntu','Wendy One','Sofia','Times New Roman', Times, serif;
    }
    h1:hover{
        font-size: 2.5em;
    }
    .pageNumber{
        border:2px rgb(187, 70,49 ) solid;
        padding:5px;
        margin:10px;
        margin-top:100px;
        text-decoration:none;
    }
    #pageActive{
        background-color:rgba(187, 70,49,0.9 );
        color:white;
    }
    .main{
        
        width: 85%;
        margin:auto;
        
        
    }
    .container{
        width:85%;
        margin: auto;
        display: flex;
        flex-wrap: wrap;

    }
    .flexDetail400{display: none;}
    .movieDetail{
        width:47%;
        position: relative;
        height: 300px;
        display:flex;
        justify-content: space-between;
        background-color: rgba(50, 50, 50, 0.7 );
        margin:1%; 
        margin-top: 30px; 
        box-shadow: 4px 4px 10px black;
        cursor: pointer;
        transition: 0.2s;
        overflow: hidden;
        margin-bottom: 2%;
    }
    .movieDetail:hover{
        width:48%;
        box-shadow: 10px 10px 50px black;
    }
    a:hover{
        color: rgb(187, 70,49 );
    }
    .movImage{
        width:45%;
        
        height:300px;
        overflow: hidden;
        
    }
    .movImage1{
        object-fit: cover;
        object-position: center;
        width: 100%;
        height: 100%;
        transition: 0.3s;
    }
    .movImage1:hover{
        width: 150%;
        height: 150%;
        object-position: center;
    }
    .flexContainer{
        width: 55%;
        position: relative;
    }
    *{
        color: white;
        
    }
    .flexDetail{
        width: 95%;
        display: flex;
        
   }
   .rate{
       margin-left: 4%;
       font-size:2.5em;
   }
   .det{
       margin:20px;
       margin-top: 0;

   }
   .name{
       font-size:1.4em;
        width: 100%;
        font-weight:bold;
    }
   .synopsis,.movSyn{
       margin: 2%;
       margin-left:4%;
       width: 90%;
       height: 70%;
        max-height: 135px;
       line-height: 1.2;
       line-clamp: 3;
       overflow: hidden;
   }
   .movSyn{
       line-height: 1.6;
       overflow: hidden;
   }
.moreInfo{
    position: absolute;
    bottom:0;
    padding:5%;
    padding-bottom: 2%;
    width:90%;
    border-top: 2px rgb(187, 70,49 ) solid;
    background-color:rgba(0, 0, 0, 0.7 );
}
.link{
    display: block
}
footer
{
    width: 100%;
    height: 5%;
    position: sticky;
    position: -webkit-sticky;
    top: 95%;
    margin-top: 2%;
    background-color: #303030;
}

footer p
{
    position: relative;
    top: calc(50% - 0.6em);
    text-align: center;
    font-size: 1.2em;
}
@media screen and (max-width:450px){
    .synopsis,movSyn,.moreInfo,.flexContainer{
        display: none;
    }
    
    .movImage,.movImage1,.movieDetail{
        width: 100%;
        height:200px;
        object-position: center;
    }
    .movieDetail:hover{
        width: 102%;
        margin-bottom: 8%;
    }
    .flexDetail400{
        width: 100%;
        height:50px;
        display: flex;
        position: absolute;
        bottom: 0px;
        background-color: rgba(50, 50, 50, 0.9 );
        border-top:2px rgb(187, 70,49 ) solid;
    }
    .rate1{
        font-size: 1.3em;
        display: inline;
        margin-top:0px;
        margin-right:10px;
        margin-left:10px;
        padding:11px;
        border:2px rgb(187, 70,49 ) solid;
    }
    .name1{
    font-size: 01em;
    margin-top:10px;
    }
    .release1{
        font-size:0.8em; 
    }
    footer
    {
        margin-top: 5%;
    }
    footer p
    {
    top: calc(50% - 0.5em);
    font-size: 1em;
    }
}

@media screen and (max-width:900px){
    .movieDetail{
        width:100%;
    }
    .movieDetail:hover{
        width:101%;
    }
    footer p
    {
    top: calc(50% - 0.5em);
    font-size: 1em;
    }
}
</style>
<?php
    $servername="localhost";
    $username="root";
    $oneMovie=array();
    $allMovies=array();

    try{
    $connect=new PDO("mysql:host=$servername;dbname=dbmsp",$username);
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $page=$_GET['page']*20;

    if($_GET['type']=="pop" && $_GET['media']=="movies")
    $theatreQuery="select * from movie where isTvSeries=0 order by popularity desc limit ".$page.",20 ";
    else if($_GET['type']=="pop" && $_GET['media']=="tv")
    $theatreQuery="select * from movie where isTvSeries=1 order by popularity desc limit ".$page.",20 ";
    else if($_GET['type']=="top" && $_GET['media']=="movies"){
    $theatreQuery="select * from movie where isTvSeries=0 order by rating desc limit ".$page.",20";
    }
    else if($_GET['type']=="top" && $_GET['media']=="tv"){
    $theatreQuery="select * from movie where isTvSeries=1 order by rating desc limit ".$page.",20";
    }
    if($_GET['media']=="movies"){
        $queryCount="select count(id) from movie where isTvseries=0";
        $result=$connect->query($queryCount)->fetch();
        
    }
    else{
        $queryCount="select count(id) from movie where isTvseries=1";
        $result=$connect->query($queryCount)->fetch();
    }
    
    echo "<script> pageReturn(".$result['count(id)'].",".$_GET['page'].",\"".$_GET['type']."\",\"".$_GET['media']."\"); </script>";

    $resultTheater = $connect->query($theatreQuery);
    while ($row=$resultTheater->fetch()) {
        array_push($oneMovie,$row);
        
        
    }
     //   array_push($allMovies,$oneMovie);
        $movieJson=json_encode($oneMovie);
    
        echo "<script>setMovieDetail(".$movieJson."); </script>";
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