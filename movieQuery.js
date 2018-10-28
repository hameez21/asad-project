var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        jsonParsing(this.responseText);
        
    }
    else{
        console.log("error");
    }
}

xmlhttp.open("GET", "search.php?q="+searchQuery, true);

xmlhttp.send();
function jsonParsing(jsonData){
     var list = JSON.parse(jsonData);
     
}