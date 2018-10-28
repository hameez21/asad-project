function searchMovieAdv(searchQuery){
    if(searchQuery.length==0){
        document.getElementById("searchListAdv").innerHTML="";
    }
    else{
        var selectBox = document.getElementById("searchBy");
        var searchBy=selectBox.options[selectBox.selectedIndex].text;
        console.log("search.php?q="+searchQuery+"&searchBy="+searchBy);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                document.getElementById("searchListAdv").innerHTML = this.responseText;
            }
            else{
                console.log("error");
            }
        }
        
        xmlhttp.open("GET", "search.php?q="+searchQuery+"&searchBy="+searchBy, true);
        
        xmlhttp.send();

    }
}
function scrollMob(){
    if(window.innerWidth<900){
        var div=document.getElementsByClassName('searchResultAdv');
        console.log(div[0].scrollTop);
        var input=document.getElementsByClassName('searchBar2');
        var select1=document.getElementsByClassName('list');
        var label=document.getElementById('myLabel');
        if(div[0].scrollTop>230){
            
            input[0].classList.add('mob');
            
            select1[0].style.height='auto';
            select1[0].style.fontSize='0.4em';
            label.style.fontSize="0.4em";
            console.log(input[0].classList);
        }
        else{
            input[0].classList.remove('mob');
            select1[0].style.fontSize='1.2em';
            label.style.fontSize="1.2em"
        }
    }
    else{
        input[0].classList.remove('mob');
            select1[0].style.fontSize='1.2em';
            label.style.fontSize="1.2em"
    }
}