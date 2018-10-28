<?php

session_start();

if(isset($_SESSION["username"],$_SESSION["userEmail"]))
echo "<script> window.location = 'index.php'; </script>";

if(!isset($_GET['return'])){
        $_GET['return']="index.php";
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
    <title>Login - MCDB</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="LoginCSS.css">
    <link rel="stylesheet" href="navBar.css">
    <script src="navBar.js"></script>
    <script src="LoginJS.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Wendy One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Arapey' rel='stylesheet'>
</head>
<body id="body">
        <div id="backgroundImg"></div>
        <div id="errorMessage">
                <p>
                              
                </p>
        </div>
        <div id="content">
                <div class="topFlex">
                        <header>
                                <div class="navBar" style="background-color: #303030">
                                        <a href="#top" class="hamButton" onclick="openMenu()">☰</a>
                                        <a class="pageTitle" href="index.php">MCDB</a>
                                        <a class="navItems" href="toppop.php?type=top&media=movies">Top Movies</a>
                                        <a class="navItems" href="toppop.php?type=pop&media=movies">Popular Movies</a>
                                        <a class="navItems" href="toppop.php?type=top&media=tv">Top TV Shows</a>
                                        <a class="navItems" href="toppop.php?type=pop&media=tv">Popular TV Shows</a>
                                        <a class="navItems" href="moviegenre.php">Genrefy</a>
                                        <a class="searchClose" onclick="closeSearch()">&times;</a>
                                        <img src="search-3-xxl.png" alt="SearchW" class="searchButton" width="24px" height="24px" onclick="openSearch()" >
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
                                <a class="hamMenuItems" href="index.php">In Theater</a>
                                <a class="hamMenuItems" href="toppop.php?type=top&media=movies">Top Movies</a>
                                <a class="hamMenuItems" href="toppop.php?type=pop&media=movies">Popular Movies</a>
                                <a class="hamMenuItems" href="toppop.php?type=top&media=tv">Top TV Shows</a>
                                <a class="hamMenuItems" href="toppop.php?type=pop&media=tv">Popular TV Shows</a>
                                <a class="hamMenuItems" href="moviegenre.php">Genrefy</a>
                        </div>
                        
      
                        <div id="loginForm">
                                <form action="<?php echo 'loginT.php?return='.htmlspecialchars($_GET['return']);?>" method="POST">
                                <?php if($_GET['LFail']==1)
                                {
                                        echo '<script> displayErrorMessage("Invalid email or password"); </script>'; 
                                }
                                ?>
                                    <label for="Name" class="formElem">
                                        <h1>Email</h1>
                                    </label><br>
                                    <input type="email" autofocus placeholder="Enter Email..." name="email" class="formElem formInput" required onchange="hideErrorMessage()"><br>
                                    <label for="Password" class="formElem">
                                        <h1>Password</h1>
                                    </label><br>
                                    <input type="password" placeholder=" Enter Password..." name="password" class="formElem formInput" required><br>
                                    <input type="submit" id="submitBtn" value="Login"><br>
                                    <div id="switchLS">
                                    <a href="SignUp.php">Signup To MCDB ?</a>
                                    </div>
                                </form>
                        </div>
                </div>
                <footer>
                        <p> <script> var date = new Date(); document.getElementsByTagName('footer')[0].getElementsByTagName('p')[0].innerHTML = "Movie Chronicle Database Copyright &copy; "+ date.getFullYear();  </script></p>
                </footer>
        </div>
</body>
</html>

