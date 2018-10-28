function setPassError(passField)
{
passField.setCustomValidity("Password must contain atlease 1 uppercase letter and a number and should be atlease 8 characters long");       //Pattern Doesn't Match FB standard.
}

function setNameError(nameField)
{
nameField.setCustomValidity("Name must not contain any special characters like +,-,% etc..");       //Pattern Doesn't Match FB standard.
}

function displayErrorMessage(Message)
{
    document.getElementById('errorMessage').getElementsByTagName('p')[0].innerHTML = Message;
    document.getElementById('errorMessage').style.opacity = "1";
    document.getElementById('errorMessage').style.visibility = "visible";
}