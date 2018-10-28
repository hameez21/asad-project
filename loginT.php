<?php
session_start();
if(!isset($_GET['return'])){
        $_GET['return']="index.php";
}
$_GET['return']="'".$_GET['return']."'";

if($_SERVER['REQUEST_METHOD'] == "POST")
        if(empty($_POST["password"]) || empty($_POST["email"]))
                echo  "<script> displayErrorMessage('Please enter all the credentials.'); </script>";
        else
                echo verifyLogin();

function verifyLogin()
{
        $serverName = "localhost:3306";
        $userName = "root";
        
        try
        {       
                $connect = new PDO("mysql:host=$serverName;dbname=DBMSP",$userName);
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sqlQuery = $connect->prepare("SELECT * FROM guest,user WHERE email=:userEmail AND password=:userPass AND guest.id=user.userID;");
                $sqlQuery->bindParam(':userEmail',$_POST["email"]);
                $sqlQuery->bindParam('userPass',$_POST["password"]);

                $sqlQuery->execute();
                $userInfo = $sqlQuery->fetch();
                if($sqlQuery->rowCount() == 1)
                {
                $_SESSION['username']=$userInfo['name'];
                $_SESSION["userEmail"] = $userInfo["email"];
                $_SESSION["userID"] = $userInfo["id"];
                
                echo "<script> function openLink(){window.location=".$_GET['return'].";}
                openLink(); </script>";
                }
                else
                {
                    echo "<script> window.location='login.php?LFail=1'; </script>";
                }
        }
        
        catch(PDOException $e)
        {
                echo "<script> displayErrorMessage('".trim($e->getMessage())."'); </script>";
                echo 'error';
        }

        $connect = null;
}

?>