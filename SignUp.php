<?php

session_start();

if(isset($_SESSION["username"],$_SESSION["userEmail"]))
echo "<script> window.location = 'index.php'; </script>";

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup - MCDB</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="navBar.css">
    <link rel="stylesheet" href="LoginCSS.css">
    <script src="navBar.js"></script>
    <script src="SignUpJS.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Wendy One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Arapey' rel='stylesheet'>
</head>
<body>
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
                                        <img src="search-3-xxl.png" alt="Search" class="searchButton" width="24px" height="24px" onclick="openSearch()" >
                                        <input type="text" name="search" id="search" placeholder="Search Movies..." oninput="searchMovie(this.value)">  
                                        <div class="searchResult" style="width:100%;">
                                        <ul id="searchList" >
                                        </ul>
                                        <a style="font-size:1em; margin-left:2%; color:white" href="advsearch.php">ADVANCED SEARCH</a>
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
                        <div id="loginForm">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                    <label for="email" class="formElem">
                                        <h1>Email</h1>
                                    </label><br>
                                    <input type="email" autofocus placeholder="Enter Email..." name="email" class="formElem formInput" required><br>
                                    <label for="name" class="formElem">
                                        <h1>Name</h1>
                                    </label><br>
                                    <input type="text" placeholder="Enter Display Name..." name="name" class="formElem formInput" max="30" pattern="[a-zA-Z0-9]+" oninput="setCustomValidity('')" oninvalid="setNameError(this)" required><br>
                                    <label for="Password" class="formElem">
                                        <h1>Password</h1>
                                    </label><br>
                                    <input type="password" placeholder=" Enter Password..." name="password" class="formElem formInput" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" oninput="setCustomValidity('')" oninvalid="setPassError(this)" min="8" required><br>
                                    <input type="submit" id="submitBtn" value="Signup"><br>
                                    <div id="switchLS">
                                        <a href="Login.php">Login To MCDB ?</a>
                                    </div>
                                </form>
                        </div>

                </div>
                <footer>
                    <p> <script> var date = new Date(); document.getElementsByTagName('footer')[0].getElementsByTagName('p')[0].innerHTML = "Movie Chronicle Database Copyright &copy; "+ date.getFullYear();  </script></p>
                </footer>
</body>
</html>

<?php

if($_SERVER['REQUEST_METHOD'] == "POST")
        if(@verifyCredentials())        //Same Server-Side Validation
            echo completeSignUp();        
        
        else
            echo "<script> displayErrorMessage('Please verify your credentials to match MCDB requirements.'); </script>";

function completeSignUp()
{
    $serverName = "localhost:3306";
    $userName = "root";
                        
    try
    {
        $connect = new PDO("mysql:host=$serverName;dbname=DBMSP",$userName);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(checkUserExistence() && verifyDomainExistence())
        {     
            $sqlQuery = $connect->prepare("INSERT INTO guest(name) VALUES(:userName);
            INSERT INTO user(userID,email,password) VALUES((SELECT id FROM guest ORDER BY id DESC LIMIT 1),:userEmail,:userPass);");
            $sqlQuery->bindParam(':userEmail',$_POST["email"]);
            $sqlQuery->bindParam('userPass',$_POST["password"]);
            $sqlQuery->bindParam('userName',$_POST["name"]);
                
            $sqlQuery->execute();
                
            if($sqlQuery->rowCount() == 1)
            echo "<script> displayErrorMessage('Your account has been created successfully.'); </script>";
            else
            echo "<script> displayErrorMessage('There was a problem while creating your account.'); </script>";
        }
    }
                        
    catch(PDOException $e)
    {
    echo $e->getMessage();
    }
                
    $connect = null;
}

function checkUserExistence()
{
    $serverName = "localhost:3306";
    $userName = "root";
                        
    try
    {
        $connect = new PDO("mysql:host=$serverName;dbname=DBMSP",$userName);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
        $sqlQuery = $connect->prepare("SELECT * FROM User WHERE email=:userEmail");
        $sqlQuery->bindParam(':userEmail',$_POST["email"]);
                
        $sqlQuery->execute();
                
        if($sqlQuery->rowCount() == 0)          //Email Existence Check   
        return true;
        else
        echo "<script> displayErrorMessage('This email address already exists.'); </script>";
    }
                        
    catch(PDOException $e)
    {
        echo "<script> displayErrorMessage('".trim($e->getMessage())."'); </script>";
    }
                
    $connect = null;
}

function verifyDomainExistence()
{
    if(checkdnsrr(explode('@',$_POST["email"])[1],'MX'))
    return true;
    else
    echo "<script> displayErrorMessage('Your email domain could not be verified.'); </script>";
}

function verifyCredentials()
{
    $emailFlag = $nameFlag = $passFlag = false;

    //Check Email
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
    $emailFlag = true;

    //Check Name
    $name = $_POST["name"];

    if(!empty($name) && preg_match("/[a-zA-Z0-9]+/",$name))
    $nameFlag = true;

    //Check Password
    $password = $_POST["password"];

    if(!empty($password) && preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/",$password))
    $passFlag = true;

    return $emailFlag && $nameFlag && $passFlag;
}

?>