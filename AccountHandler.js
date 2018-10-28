function bossIsIn()
{
    document.getElementsByClassName('login')[0].parentNode.removeChild(document.getElementsByClassName('login')[0]);
    document.getElementById('user').style.display = "inline-block";
}

function showSignOut()
{
    var signOutBtn = document.getElementById('signOut');
    
    if(signOutBtn.style.display == "block")
    signOutBtn.style.display = "none";

    else
    signOutBtn.style.display = "block";
}