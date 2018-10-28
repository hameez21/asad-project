<?php

session_start();

if(isset($_GET["signOut"],$_SESSION["username"]))
{
    session_unset();
    session_destroy();

    if(isset($_GET["page"]))
    echo "<script> window.location = '".$_GET['page']."'; </script>";

    else
    echo "<script> window.location = 'index.php'; </script>";
}