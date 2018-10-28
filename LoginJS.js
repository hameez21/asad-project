function incorrectData()
{
    document.getElementById('incorrectData').style.display = "block";
}

window.load = function()
{
    document.getElementById('incorrectData').style.display = "none";
}

function displayErrorMessage(Message)
{
    document.getElementById('errorMessage').getElementsByTagName('p')[0].innerHTML = Message;
    document.getElementById('errorMessage').style.opacity = "1";
    document.getElementById('errorMessage').style.visibility = "visible";
}

function hideErrorMessage()
{
    document.getElementById('errorMessage').style.opacity = "0";
    document.getElementById('errorMessage').style.visibility = "hidden";
}
